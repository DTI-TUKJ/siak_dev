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


}