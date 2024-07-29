<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class scheduleModel extends Model
{
    protected $table = "DAYS";
    protected $column_order = array(null,null,null, null, null,null);
    protected $column_search = array('DAYID');
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
            // if ($this->request->getPost('search')['value']) {
            //     if ($i === 0) {
            //         $this->dt->groupStart();
            //         $this->dt->like($item, $this->request->getPost('search')['value']);
            //     } else {
            //         $this->dt->orLike($item, $this->request->getPost('search')['value']);
            //     }
            //     if (count($this->column_search) - 1 == $i)
            //         $this->dt->groupEnd();
            // }
            // $i++;
        }
 
        // if ($this->request->getPost('order')) {
        //     $this->dt->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
        // } else if (isset($this->order)) {
        //     $order = $this->order;
        //     $this->dt->orderBy(key($order), $order[key($order)]);
        // }
    }
    public function get_datatables()
    {
        $this->_get_datatables_query();
        if ($this->request->getPost('length') != -1){
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        }
    
 
       
        $query = $this->dt->get();
      
        return $query->getResultArray();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();


        return $this->dt->countAllResults();
    }
    public function count_all()
    {
        $tbl_storage = $this->db->table($this->table);

        return $tbl_storage->countAllResults();
    }

    public function getHoursAll(){
        $builder = $this->db->table('HOURS');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getIdclass($class)
    {   
         $builder = $this->db->table('ROOMS');
         $builder->select('*');
         
         $builder->where('ROOMNAME',$class);
         $query = $builder->get();
         return $query->getRowArray();
        
    }
    public function getRoomAll($nip, $c){
        $sql ="SELECT * FROM ROOMS where ROOMNAME like ? and BUILDINGNAME like ? order by ROOMNAME limit 15";
        
        return $query = $this->db->query($sql,["%".$nip."%","%".$c."%"])->getResult();
    }

        public function updateSchedule($data){
            $this->db->table('NEW_SCHEDULES_LECTURER')->truncate();
            return  $this->db->table('NEW_SCHEDULES_LECTURER')->insertBatch($data);
        }

    public function getSchedule($day, $campus, $hour,$room){
        $sql ="SELECT *  FROM NEW_SCHEDULES_LECTURER nsl WHERE nsl.INDONESIADAYNAME =? and nsl.BUILDINGNAME like ? and 
        ? >= nsl.STARTHOUR  and ? < nsl.ENDHOUR and ROOMNAME =?";
            
        return $query = $this->db->query($sql,[$day,"%".$campus."%", $hour,$hour, $room])->getResultArray();
    }

    public function getScheduleClassLoan($day, $campus, $hour,$room, $date){
        $sql ="SELECT * 
        FROM room_class_loan nsl 
        JOIN ROOMS r on nsl.class_id=r.ROOMID
        WHERE nsl.dayname = ? and r.BUILDINGNAME like ? and 
        ? >= nsl.starttime  and ? < nsl.endtime and r.ROOMNAME =? and nsl.loan_class_date= ? and nsl.status_class_loan !=2";
        
        return $query = $this->db->query($sql,[$day,"%".$campus."%", $hour,$hour, $room, $date])->getResultArray();
    }

    public function createLoanClass($data)
    {
        $query = $this->db->table('room_class_loan')->insert($data);
        return $query;
    }

    public function getActiveSchoolyear(){
        $builder = $this->db->table('SETTINGSEMESTER');
        $builder->where('set_status', 1);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function getSchoolyear(){
        $builder = $this->db->table('SETTINGSEMESTER');
         $builder->distinct()->select('set_schoolyear');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function updateActiveSemester($data){
   
        $this->db->table('SETTINGSEMESTER')->update(array('set_status'=>'0'), array('set_status' => '1'));
        $query = $this->db->table('SETTINGSEMESTER')->insert($data);
        return $query;
    }
}