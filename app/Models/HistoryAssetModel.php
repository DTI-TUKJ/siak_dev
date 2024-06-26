<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class HistoryAssetModel extends Model
{
    protected $table = "loan";
    protected $column_order = array(null,null,null, null, null,null);
    protected $column_search = array('activity', 'name_emp');
    protected $column_search_classroom = array('activity', 'name_emp');

    protected $order = array('' => '');
    protected $request;
    protected $db;
    protected $dt;
    protected $dt_c;
 
    function __construct(RequestInterface $request)
    {
        parent::__construct();
        // $this->db = db_connect();
        $this->request = $request;
 
        $this->dt = $this->db->table($this->table);
        $this->dt_c = $this->db->table('room_class_loan');
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
            $this->dt->where('status', 3);
            $this->dt->orderBy('id_loan', 'DESC');
       
        $query = $this->dt->get();
      
        return $query->getResultArray();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();
        
            $this->dt->join('ms_assets', $this->table.'.id_asset_loan=ms_assets.id_asset');
            $this->dt->join('employe_master', $this->table.'.nip=employe_master.nip_emp');
            $this->dt->where('status', 3);

            $this->dt->orderBy('id_loan', 'DESC');

        return $this->dt->countAllResults();
    }

    public function count_all()
    {
        $tbl_storage = $this->db->table($this->table);

        return $tbl_storage->countAllResults();
    }


    private function _get_datatables_query_class()
    {
        $i = 0;
        foreach ($this->column_search_classroom as $item) {
            if ($this->request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt_c->groupStart();
                    $this->dt_c->like($item, $this->request->getPost('search')['value']);
                } else {
                    $this->dt_c->orLike($item, $this->request->getPost('search')['value']);
                }
                if (count($this->column_search_classroom) - 1 == $i)
                    $this->dt_c->groupEnd();
            }
            $i++;
        }
 
        if ($this->request->getPost('order')) {
            $this->dt_c->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dt_c->orderBy(key($order), $order[key($order)]);
        }
    }
    public function get_datatables_class($showTab)
    {
        $this->_get_datatables_query_class();
        if ($this->request->getPost('length') != -1){
            $this->dt_c->limit($this->request->getPost('length'), $this->request->getPost('start'));
        }
        $this->dt_c->select('room_class_loan.*, employe_master.*, ROOMS.*, association.*,s2.fullname as name_leader_assoc, student.*');
        $this->dt_c->join('student', 'room_class_loan.nim_loaner=student.numberid','LEFT');
        $this->dt_c->join('employe_master','room_class_loan.nim_loaner=employe_master.nip_emp', 'LEFT');
        $this->dt_c->join('ROOMS', 'room_class_loan.class_id=ROOMS.ROOMID');
        $this->dt_c->join('association','room_class_loan.id_association=association.assoc_id', 'LEFT');
        $this->dt_c->join('student s2', 'association.assoc_leader_id=s2.numberid','LEFT');
       
        if ($showTab=='classroomNonAcad'){
            $this->dt_c->where('request_type !=', 'kelas pengganti');
        }else{
            $this->dt_c->where('request_type', 'kelas pengganti');
        }
        $this->dt_c->orderBy('id_class_loan', 'DESC');
        $query = $this->dt_c->get();
      
        return $query->getResultArray();
    }

    public function count_filtered_class($showTab)
    {
        $this->_get_datatables_query_class();
        
        $this->dt_c->select('room_class_loan.*, employe_master.*, ROOMS.*, association.*,s2.fullname as name_leader_assoc, student.*');
        $this->dt_c->join('student', 'room_class_loan.nim_loaner=student.numberid','LEFT');
        $this->dt_c->join('employe_master','room_class_loan.nim_loaner=employe_master.nip_emp', 'LEFT');
        $this->dt_c->join('ROOMS', 'room_class_loan.class_id=ROOMS.ROOMID');
        $this->dt_c->join('association','room_class_loan.id_association=association.assoc_id', 'LEFT');
        $this->dt_c->join('student s2', 'association.assoc_leader_id=s2.numberid','LEFT');
        if ($showTab=='classroomNonAcad'){
            $this->dt_c->where('request_type !=', 'kelas pengganti');
        }else{
            $this->dt_c->where('request_type', 'kelas pengganti');
        }
        $this->dt_c->orderBy('id_class_loan', 'DESC');

        return $this->dt_c->countAllResults();
    }


    
    public function count_all_class($showTab)
    {
        $tbl_storage = $this->db->table('room_class_loan');
        if ($showTab=='classroomNonAcad'){
            $tbl_storage->where('request_type !=', 'kelas pengganti');
        }else{
            $tbl_storage->where('request_type', 'kelas pengganti');
        }

        return $tbl_storage->countAllResults();
    }
}