<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class ApiModel extends Model
{
    protected $table = "NEW_SCHEDULES_LECTURER";
    function __construct()
    {
        parent::__construct();
        // $this->db = db_connect();
    
 
        $this->dt = $this->db->table($this->table);
    }
    public function updateSchedule($data){
        $this->dt->truncate();
        
        return  $this->dt->insertBatch($data);
    }

    public function updateActiveSemester($data){
        $dataInsert=array(
            'set_schoolyear'=>$data->SCHOOLYEAR,
            'set_semester'=>$data->SEMESTER,
            'set_status'=>1

        );
        $this->db->table('SETTINGSEMESTER')->update(array('set_status'=>'0'), array('set_status' => '1'));
        $query = $this->db->table('SETTINGSEMESTER')->insert($dataInsert);
        return $query;
    }

    public function updateTableMhw($data){
        // $this->db->table('student')->truncate();
        return  $this->db->table('student')->insertBatch($data);
    }

    public function updateDataRoom($data){
         $this->db->table('ROOMS')->truncate();
        return  $this->db->table('ROOMS')->insertBatch($data);
    }

    public function getSchoolyear(){
        $builder = $this->db->table('SETTINGSEMESTER');
         $builder->distinct()->select('set_schoolyear');
        $query = $builder->get();
        return $query->getResultArray();
    }


}