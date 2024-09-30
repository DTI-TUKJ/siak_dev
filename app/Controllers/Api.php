<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

use App\Models\ApiModel;
use App\Models\scheduleModel;


class Api extends ResourceController
{
    protected $AM;
    protected $SM;
    protected $req;

    public function __construct()
    {
        // Load the model in the constructor
        $this->AM = new ApiModel();
        // $this->req = \Config\Services::request();
        $this->SM = new scheduleModel($this->req);
    }

    public function createBatch()
    {
        $data = $this->request->getVar('schedule');
        $dataActiveSemester = $this->request->getVar('settingSemester');
        $dataMhw=  $this->request->getVar('dataMhw');
        $dataRooms=  $this->request->getVar('dataClassroom');
        $getSemesterActive = $this->SM->getActiveSchoolyear();
        // print_r($data);
        $update = $this->AM->updateSchedule($data);
        // print_r($dataActiveSemester);
        if ($getSemesterActive['set_schoolyear']!=$dataActiveSemester->SCHOOLYEAR){

           
            if($dataMhw!='none'){
                $updateDataMhw = $this->SM->updateTableMhw($dataMhw);
            }
        }
        $updateActiveSenester = $this->AM->updateActiveSemester($dataActiveSemester);
        $updateRooms = $this->AM->updateDataRoom($dataRooms); 

        $response = [
            'status'   => 200,
            'error'    => false,
            'messages' => [
                'success' => 'Data Mahasiswa berhasil ditambahkan.'
            ]
        ];
        return $this->respondCreated($response);
        
        // if ($this->AM->updateSchedule($data)) {
        //     return $this->respondCreated(['status' => 'success', 'message' => 'Batch insert successful']);
        // } else {
        //     return $this->failValidationErrors($this->model->errors());
        // }
    }
}