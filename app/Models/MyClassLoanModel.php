<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class MyClassLoanModel extends Model
{
    protected $table = "room_class_loan";
    protected $column_order = array(null,null,null, null, null,null);
    protected $column_search = array('activity_class', 'assoc_name', 'student.fullname', 'name_emp');
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
    public function get_datatables($type='', $showTab='')
    {
        $this->_get_datatables_query();
        if ($this->request->getPost('length') != -1){
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        }
            $this->dt->select($this->table.'.*, employe_master.*, ROOMS.*, association.*,s2.fullname as name_leader_assoc, student.*');
            $this->dt->join('student', $this->table.'.nim_loaner=student.numberid','LEFT');
            $this->dt->join('employe_master', $this->table.'.nim_loaner=employe_master.nip_emp', 'LEFT');
            $this->dt->join('ROOMS', $this->table.'.class_id=ROOMS.ROOMID');
            $this->dt->join('association', $this->table.'.id_association=association.assoc_id', 'LEFT');
            $this->dt->join('student s2', 'association.assoc_leader_id=s2.numberid','LEFT');
            if (isset(session()->numberid)){
                $this->dt->where('nim_loaner', session()->numberid);
            }
            if ($type!='all' && $type!=''){
                $this->dt->where('request_type', $type);
            }
            
            if ($showTab=='non-academic'){
                $this->dt->where('request_type !=', 'kelas pengganti');
                if (session()->pembina && session()->type!='admin akademik'){
                    $this->dt->where('assoc_lecturer_id', session()->nip_emp);
                    $this->dt->orWhere('assoc_lecturer_id_b', session()->nip_emp);
                }
                
            }else if($showTab=='academic'){

                $this->dt->where('request_type', 'kelas pengganti');
                if (session()->lectur && session()->type!='admin akademik'){
                    $this->dt->orWhere('nip_emp', session()->nip_emp);
                }
            }
            
            if(session()->lectur && session()->type!='admin akademik'){
                $this->dt->where('nim_loaner', session()->nip_emp);
            }
            

            
            $this->dt->orderBy('id_class_loan', 'DESC');
       
        $query = $this->dt->get();
      
        return $query->getResultArray();
    }

    public function count_filtered($type='', $showTab='')
    {
        $this->_get_datatables_query();
        $this->dt->select($this->table.'.*, employe_master.*, ROOMS.*, association.*,s2.fullname as name_leader_assoc, student.*');
        $this->dt->join('student', $this->table.'.nim_loaner=student.numberid', 'LEFT');
        $this->dt->join('employe_master', $this->table.'.nim_loaner=employe_master.nip_emp', 'LEFT');
        $this->dt->join('ROOMS', $this->table.'.class_id=ROOMS.ROOMID');
        $this->dt->join('association', $this->table.'.id_association=association.assoc_id', 'LEFT');
        $this->dt->join('student s2', 'association.assoc_leader_id=s2.numberid','LEFT');
        if (isset(session()->numberid)){
            $this->dt->where('nim_loaner', session()->numberid);
        }else if (session()->pembina && session()->type!='admin akademik'){
            $this->dt->where('assoc_lecturer_id', session()->nip_emp);
            $this->dt->orWhere('assoc_lecturer_id_b', session()->nip_emp);
            if (session()->lectur){
                $this->dt->orWhere('nim_loaner', session()->nip_emp);
            }
        }else if(session()->lectur && session()->type!='admin akademik'){
            $this->dt->where('nim_loaner', session()->nip_emp);
        }

        
        if ($type!='all' && $type!=''){
            $this->dt->where('request_type', $type);
        }

        
        if ($showTab=='non-academic'){
            $this->dt->where('request_type !=', 'kelas pengganti');
        }else if($showTab=='academic'){

        }

        $this->dt->orderBy('id_class_loan', 'DESC');

        return $this->dt->countAllResults();
    }
    public function count_all()
    {
        $tbl_storage = $this->db->table($this->table);

        return $tbl_storage->countAllResults();
    }

    public function deleteLoan($id)
    {
        $query = $this->db->table($this->table)->delete(array('id_class_loan' => $id));
        return $query;
    }
    public function upStatusLoan($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id_class_loan' => $id));
        return $query;
    }

    public function getClassLoanByid($id){
        $this->dt->select($this->table.'.*, em_loaner.*, ROOMS.*, association.*,s2.fullname as name_leader_assoc, student.*,  em1.name_emp as pembina_a, em2.name_emp as pembina_b, em1.no_tlp as no_tlp_pembina_a, em2.no_tlp as no_tlp_pembina_b');
        $this->dt->join('student', $this->table.'.nim_loaner=student.numberid', 'LEFT');
        $this->dt->join('employe_master em_loaner', $this->table.'.nim_loaner=em_loaner.nip_emp', 'LEFT');
        $this->dt->join('ROOMS', $this->table.'.class_id=ROOMS.ROOMID');
        $this->dt->join('association', $this->table.'.id_association=association.assoc_id', 'LEFT');
        $this->dt->join('student s2', 'association.assoc_leader_id=s2.numberid','LEFT');
        $this->dt->join('employe_master em1','association.assoc_lecturer_id=em1.nip_emp', 'LEFT');
        $this->dt->join('employe_master em2', 'association.assoc_lecturer_id_b=em2.nip_emp', 'LEFT');
        $this->dt->where('id_class_loan', $id);
       
        $query = $this->dt->get();
      
        return $query->getRowArray();
    }

    public function getClassLoanBySchoolyearSemester($schoolyear, $semester,$period, $type=''){
        $this->dt->select($this->table.'.*, em_loaner.*, ROOMS.*, association.*,s2.fullname as name_leader_assoc, student.*,  em1.name_emp as pembina_a, em2.name_emp as pembina_b, em1.no_tlp as no_tlp_pembina_a, em2.no_tlp as no_tlp_pembina_b');
        $this->dt->join('student', $this->table.'.nim_loaner=student.numberid', 'LEFT');
        $this->dt->join('employe_master em_loaner', $this->table.'.nim_loaner=em_loaner.nip_emp', 'LEFT');
        $this->dt->join('ROOMS', $this->table.'.class_id=ROOMS.ROOMID');
        $this->dt->join('association', $this->table.'.id_association=association.assoc_id', 'LEFT');
        $this->dt->join('student s2', 'association.assoc_leader_id=s2.numberid','LEFT');
        $this->dt->join('employe_master em1','association.assoc_lecturer_id=em1.nip_emp', 'LEFT');
        $this->dt->join('employe_master em2', 'association.assoc_lecturer_id_b=em2.nip_emp', 'LEFT');
        $this->dt->where($this->table.'.schoolyear', $schoolyear);
        $this->dt->where($this->table.'.semester', $semester);
        $this->dt->where('status_class_loan', 4);
    
         if($period!='-'){
           $this->dt->where('loan_class_date >=', date('Y-m-d', strtotime($period[0]))); 
           $this->dt->where('loan_class_date <=', date('Y-m-d', strtotime($period[1]))); 
         }
          
        if ($type=='kelas pengganti'){
            $this->dt->where('request_type', $type);
        }else{
            $this->dt->where('request_type !=', 'kelas pengganti');
        }
        
       
        $query = $this->dt->get();
      
        return $query->getResultArray();
    }

   
}