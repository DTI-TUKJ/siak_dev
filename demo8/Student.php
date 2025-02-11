<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use \App\Models\EmployeeModel;
use App\Models\LoginModel;
use App\Models\LoanModel;
class Employee extends BaseController
{
    public function __construct()
    {
        // session_start();
        $this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->req = \Config\Services::request();
        $this->email = \Config\Services::email();
        $this->MAM = new EmployeeModel($this->req);
        $this->LM = new LoginModel();
        $this->LNM = new LoanModel($this->req);
 
   
    }

    public function index()
    {
            if (session()->id==null || session()->type=='pegawai'){
                return redirect()->to(base_url('Siak'));
            }
             $data=array(
                        "data_owner"=>$this->LM->findAll(),
                        );
         return view('main/employee/index', $data);
    }

     public function dataJson()
    {
      
            // $periode = $this->request->getPost("periode");
            $lists = $this->MAM->get_datatables();
            //print_r($lists);
            $data = [];
            //$no = $this->request->getPost("start");

            foreach ($lists as $val) {
               // $no++;
                $row = [];
                
                $row[]='<span class="currency">'.$val['nip_emp'].'</span>';
                $row[]='<span class="currency">'.$val['name_emp'].'</span>';

                $row[]=' <span>'.$val['unit_emp'].'</span>';
                $row[]=' <span>'.$val['no_tlp'].'</span>';
                $row[]=' <span class="tb-amount">'.$val['email'].' </span>';
                $row[]='<a class="btn btn-secondary" onclick="popupedit(\''.$val['nip_emp'].'\')"><i class="fa-solid fa-pen-to-square"></i></a>';
                
                $data[] = $row;
            }
            $output = [
                "draw" => $this->request->getPost('draw'),
                "recordsTotal" => $this->MAM->count_all(),
                "recordsFiltered" => $this->MAM->count_filtered(),
                "data" => $data
            ];
            echo json_encode($output);
 
    }
}