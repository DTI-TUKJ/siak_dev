<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class LoanModel extends Model
{
    protected $table = "loan";
    protected $column_order = array(null,null,null, null, null,null);
    protected $column_search = array('name', 'unit', 'nip');
    protected $order = array('' => '');
    protected $request;
    protected $db;
    protected $dt;
 
    function __construct(RequestInterface $request)
    {
        parent::__construct();
        // $this->db = db_connect();
        $this->request = $request;
 
        $this->dt = $this->db->table($this->table);
    }
    private function _get_datatables_query()
    {
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($this->request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $this->request->getPost('search')['value']);
                } else {
                    $this->dt->orLike($item, $this->request->getPost('search')['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }
 
        if ($this->request->getPost('order')) {
            $this->dt->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }
    public function get_datatables()
    {
        $this->_get_datatables_query();
        if ($this->request->getPost('length') != -1){
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        }
            $this->dt->join('ms_assets', $this->table.'.id_asset_loan=ms_assets.id_asset');
            $this->dt->join('employe_master', $this->table.'.nip=employe_master.nip_emp');
            if(session()->type!='superadmin'){      
             $this->dt->where('id_owner', session()->type);
             $this->dt->orWhere('nip', session()->nip_emp);
            }
            $this->dt->orderBy('id_loan', 'DESC');
       
        $query = $this->dt->get();
      
        return $query->getResultArray();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();
        
            $this->dt->join('ms_assets', $this->table.'.id_asset_loan=ms_assets.id_asset');
            $this->dt->join('employe_master', $this->table.'.nip=employe_master.nip_emp');
            if(session()->type!='superadmin'){      
             $this->dt->where('id_owner', session()->type);
             $this->dt->orWhere('nip', session()->nip_emp);
            }
            $this->dt->orderBy('id_loan', 'DESC');

        return $this->dt->countAllResults();
    }
    public function count_all()
    {
        $tbl_storage = $this->db->table($this->table);

        return $tbl_storage->countAllResults();
    }

   

     public function createLoan($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }
    public function deleteLoan($id)
    {
        $query = $this->db->table($this->table)->delete(array('id_loan' => $id));
        return $query;
    }
    public function getById($id_asset)
    {
        return $this->where(['id_asset' => $id_asset])->first();
    }
     public function upStatusLoan($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id_loan' => $id));
        return $query;
    }
     public function checkScheduleAvailable($id_asset,$date_start, $date_end)
    {  
        $sql="SELECT * FROM loan l join ms_assets ma on l.id_asset_loan =ma.id_asset
                where ((( '$date_start' BETWEEN l.tanggal_pinjam  and l.tanggal_kembali) or 
                        ('$date_end'BETWEEN l.tanggal_pinjam  and l.tanggal_kembali))
                        or ((l.tanggal_pinjam  BETWEEN '$date_start' and '$date_end' )
                             and(l.tanggal_kembali  BETWEEN '$date_start' and '$date_end')) )  
                        and l.id_asset_loan =$id_asset and l.status!=2 and l.status!=3
                union 
                SELECT * FROM loan l join ms_assets ma on l.id_asset_loan =ma.id_asset
                WHERE NOW() > l.tanggal_pinjam and l.tanggal_masuk IS NULL and l.status=1 
                and DATE_FORMAT(l.tanggal_pinjam, '%Y-%m-%d')=DATE_FORMAT('$date_start', '%Y-%m-%d') and l.id_asset_loan =$id_asset  ";
       
        return $this->db->query($sql)->getResultArray();

        
        
    }

      public function checkScheduleDriver($id_asset,$date_start, $date_end)
    {  
        $sql="SELECT * FROM loan l join ms_assets ma on l.id_asset_loan =ma.id_asset
                where ((( '$date_start' BETWEEN l.tanggal_pinjam  and l.tanggal_kembali) or 
                        ('$date_end'BETWEEN l.tanggal_pinjam  and l.tanggal_kembali))
                        or ((l.tanggal_pinjam  BETWEEN '$date_start' and '$date_end' )
                             and(l.tanggal_kembali  BETWEEN '$date_start' and '$date_end')) )  
                         and l.status!=2 and l.status!=3
                union 
                SELECT * FROM loan l join ms_assets ma on l.id_asset_loan =ma.id_asset
                WHERE NOW() > l.tanggal_pinjam and l.tanggal_masuk IS NULL and l.status=1 
                and DATE_FORMAT(l.tanggal_pinjam, '%Y-%m-%d')=DATE_FORMAT('$date_start', '%Y-%m-%d')";
       
        return $this->db->query($sql)->getResultArray();

        
        
    }
    
     public function GetShowAssetStatus($param,$paramByName)
    {  
       if($param=='All' || $param==''){
                if (isset($paramByName)){
                   $sql="SELECT * FROM loan l 
                        join ms_assets ma on l.id_asset_loan=ma.id_asset
                        WHERE l.status = 1 and now() > l.tanggal_pinjam and ma.asset_name like '%$paramByName%'
                        UNION
                        SELECT * FROM loan l 
                        join ms_assets ma on l.id_asset_loan=ma.id_asset
                        WHERE l.status = 1 and now() <= l.tanggal_pinjam and ma.asset_name like '%$paramByName%'
                        UNION
                        SELECT * FROM loan l 
                        join ms_assets ma on l.id_asset_loan=ma.id_asset
                        WHERE l.status = 0 and ma.asset_name like '%$paramByName%'";
                }else{
                     $sql="SELECT * FROM loan l 
                     join ms_assets ma on l.id_asset_loan=ma.id_asset
                     WHERE l.status = 1 and now() > l.tanggal_pinjam 
                        UNION
                        SELECT * FROM loan l 
                        join ms_assets ma on l.id_asset_loan=ma.id_asset
                        WHERE l.status = 1 and now() <= l.tanggal_pinjam 
                        UNION
                        SELECT * FROM loan l
                        join ms_assets ma on l.id_asset_loan=ma.id_asset WHERE l.status = 0";
                }
                
                return $this->db->query($sql)->getResultArray();
            }else{
               
                if (isset($paramByName)){
                   $sql="SELECT * FROM loan l 
                        join ms_assets ma on l.id_asset_loan=ma.id_asset
                        WHERE l.status = 1 and now() > l.tanggal_pinjam and ma.asset_name like '%$paramByName%' and ma.asset_type = '$param'
                        UNION
                        SELECT * FROM loan l 
                        join ms_assets ma on l.id_asset_loan=ma.id_asset
                        WHERE l.status = 1 and now() <= l.tanggal_pinjam and ma.asset_name like '%$paramByName%' and ma.asset_type = '$param'
                        UNION
                        SELECT * FROM loan l 
                        join ms_assets ma on l.id_asset_loan=ma.id_asset
                        WHERE l.status = 0 and ma.asset_name like '%$paramByName%' and ma.asset_type = '$param' ";
                }else{
                     $sql="SELECT * FROM loan l 
                     join ms_assets ma on l.id_asset_loan=ma.id_asset
                     WHERE l.status = 1 and now() > l.tanggal_pinjam and ma.asset_type = '$param'
                        UNION
                        SELECT * FROM loan l 
                        join ms_assets ma on l.id_asset_loan=ma.id_asset
                        WHERE l.status = 1 and now() <= l.tanggal_pinjam and ma.asset_type = '$param'
                        UNION
                        SELECT * FROM loan l
                        join ms_assets ma on l.id_asset_loan=ma.id_asset WHERE l.status = 0 and ma.asset_type = '$param'";
                }
                
                return $this->db->query($sql)->getResultArray();
            }
    }

    public function loanHistory()
    {
        $sql="SELECT * FROM loan l join ms_assets ma on l.id_asset_loan =ma.id_asset
                where l.status=3";
       
        return $this->db->query($sql)->getResultArray();
    }

    public function get_detail($param)
    {  
         
                $builder = $this->db->table($this->table);
                $builder->select('*');
                $builder->join('ms_assets', $this->table.'.id_asset_loan=ms_assets.id_asset');
                $builder->where('id_loan', $param);
                $query = $builder->get();
                return $query->getRowArray();
          
        
        
    }

     public function getNip($nip)
    {


        $sql ="SELECT * FROM employe_master  where nip_emp like '%$nip%' or  name_emp like '%$nip%' and position='Pegawai' and unit_emp is not null order by nip_emp limit 15";
        
        return $query = $this->db->query($sql)->getResult();
    }

    public function getNipForAdduser($nip)
    {


        $sql ="SELECT * FROM employe_master  where nip_emp like '%$nip%' or  name_emp like '%$nip%' and unit_emp is not null order by nip_emp limit 15";
        
        return $query = $this->db->query($sql)->getResult();
    }


    public function getPgwbyId($nip)
    {   
         $builder = $this->db->table('employe_master');
         $builder->select('*');
         
         $builder->where('nip_emp',$nip);
         $query = $builder->get();
         return $query->getRowArray();
        
    }

    
}
