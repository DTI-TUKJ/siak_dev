<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

use App\Models\ApiModel;
use App\Models\scheduleModel;


class Api extends ResourceController
{
    protected $AM;

    public function __construct()
    {
        // Load the model in the constructor
        $this->AM = new ApiModel();
        // $this->req = \Config\Services::request();
        // $this->SM = new scheduleModel($this->req);
    }

    public function createBatch()
    {
        $data = $this->request->getVar('schedule');
        $dataActiveSemester = $this->request->getVar('settingSemester');
        // print_r($data);
       $update = $this->AM->updateSchedule($data);
        // print_r($dataActiveSemester);
        $updateActiveSenester = $this->AM->updateActiveSemester($dataActiveSemester);

        $response = [
            'status'   => 201,
            'error'    => null,
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