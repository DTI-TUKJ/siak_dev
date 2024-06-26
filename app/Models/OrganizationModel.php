<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class OrganizationModel extends Model
{
    protected $table = "association";
    protected $column_order = array(null,null,null, null, null,null);
    protected $column_search = array('assoc_name');
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
        // $this->dt->distinct();
        $this->dt->distinct()->select($this->table.'.*, s.*, em1.name_emp as pembina_a, em2.name_emp as pembina_b');
        $this->dt->join('student s', $this->table.'.assoc_leader_id=s.numberid','LEFT');
        $this->dt->join('employe_master em1', $this->table.'.assoc_lecturer_id=em1.nip_emp', 'LEFT');
        $this->dt->join('employe_master em2', $this->table.'.assoc_lecturer_id_b=em2.nip_emp', 'LEFT');
        $this->dt->orderBy('assoc_name', 'ASC');
       
        $query = $this->dt->get();
      
        return $query->getResultArray();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();
        // $this->dt->distinct();
        $this->dt->distinct()->select($this->table.'.*, s.*, em1.name_emp as pembina_a, em2.name_emp as pembina_b');
        $this->dt->join('student s', $this->table.'.assoc_leader_id=s.numberid','LEFT');
        $this->dt->join('employe_master em1', $this->table.'.assoc_lecturer_id=em1.nip_emp', 'LEFT');
        $this->dt->join('employe_master em2', $this->table.'.assoc_lecturer_id_b=em2.nip_emp', 'LEFT');
        $this->dt->orderBy('assoc_name', 'ASC');

        return $this->dt->countAllResults();
    }
    public function count_all()
    {
        $tbl_storage = $this->db->table($this->table);

        return $tbl_storage->countAllResults();
    }

    public function getListOrganization($s) {
        $sql ="SELECT * FROM association  where (assoc_name like '%$s%' or  assoc_desc like '%$s%') order by assoc_name limit 15";
        
        return $query = $this->db->query($sql)->getResult();
    }

    public function insertOrg($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function deleteOrg($id)
    {
        $query = $this->db->table($this->table)->delete(array('assoc_id' => $id));
        return $query;
    }

    public function updateTableMhw($data){
        // $this->db->table('student')->truncate();
        return  $this->db->table('student')->insertBatch($data);
    }

    public function getLeader($nip)
    {

          $sql ="SELECT * FROM student  where numberid like '%$nip%' or  fullname like '%$nip%' order by fullname limit 15";
          
          return $query = $this->db->query($sql)->getResult();
      }
      public function getNip($nip)
      {
    
    
            $sql ="SELECT * FROM employe_master  where nip_emp like '%$nip%' or  name_emp like '%$nip%' and position='Pegawai' order by nip_emp limit 15";
            
            return $query = $this->db->query($sql)->getResult();
        }

        public function getById($id)
        {
            $this->dt->select($this->table.'.*, s.*, em1.name_emp as pembina_a, em2.name_emp as pembina_b, em1.no_tlp as no_tlp_pembina_a, em2.no_tlp as no_tlp_pembina_b ');
            $this->dt->join('student s', $this->table.'.assoc_leader_id=s.numberid','LEFT');
            $this->dt->join('employe_master em1', $this->table.'.assoc_lecturer_id=em1.nip_emp', 'LEFT');
            $this->dt->join('employe_master em2', $this->table.'.assoc_lecturer_id_b=em2.nip_emp', 'LEFT');
            $this->dt->where($this->table.'.assoc_id', $id);
            $this->dt->orderBy('assoc_name', 'ASC');
           
            $query = $this->dt->get();
          
            return $query->getRowArray();
        }

        public function updateOrg($data, $id)
        {
            $query = $this->db->table($this->table)->update($data, array('assoc_id' => $id));
            return $query;
        }


}