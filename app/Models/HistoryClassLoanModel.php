<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class HistoryClassLoanModel extends Model
{
    protected $table = "room_class_loan";
    protected $column_order = array(null,null,null, null, null,null);
    protected $column_search = array('activity_class');
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
            $this->dt->select($this->table.'.*, employe_master.*, ROOMS.*, association.*,s2.fullname as name_leader_assoc, student.*');
            $this->dt->join('student', $this->table.'.nim_loaner=student.numberid','LEFT');
            $this->dt->join('employe_master', $this->table.'.nim_loaner=employe_master.nip_emp', 'LEFT');
            $this->dt->join('ROOMS', $this->table.'.class_id=ROOMS.ROOMID');
            $this->dt->join('association', $this->table.'.id_association=association.assoc_id', 'LEFT');
            $this->dt->join('student s2', 'association.assoc_leader_id=s2.numberid','LEFT');
            
   
            $this->dt->orderBy('id_class_loan', 'DESC');
       
        $query = $this->dt->get();
      
        return $query->getResultArray();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();
        $this->dt->select($this->table.'.*, employe_master.*, ROOMS.*, association.*,s2.fullname as name_leader_assoc, student.*');
        $this->dt->join('student', $this->table.'.nim_loaner=student.numberid', 'LEFT');
        $this->dt->join('employe_master', $this->table.'.nim_loaner=employe_master.nip_emp', 'LEFT');
        $this->dt->join('ROOMS', $this->table.'.class_id=ROOMS.ROOMID');
        $this->dt->join('association', $this->table.'.id_association=association.assoc_id', 'LEFT');
        $this->dt->join('student s2', 'association.assoc_leader_id=s2.numberid','LEFT');
        


        $this->dt->orderBy('id_class_loan', 'DESC');

        return $this->dt->countAllResults();
    }
    public function count_all()
    {
        $tbl_storage = $this->db->table($this->table);

        return $tbl_storage->countAllResults();
    }
}