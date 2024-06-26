<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use \App\Models\EmployeeModel;
use App\Models\LoginModel;
use App\Models\StudentModel;
class Student extends BaseController
{
    public function __construct()
    {
        // session_start();
        $this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->req = \Config\Services::request();
        $this->email = \Config\Services::email();
        $this->MAM = new EmployeeModel($this->req);
        $this->SM = new StudentModel($this->req);
        // $this->LNM = new LoanModel($this->req);
 
   
    }

    public function index()
    {
            if (session()->type!='admin akademik' && session()->type!='superadmin'){
                return redirect()->to(base_url('Siak'));
            }
  
         return view('main/student/index');
    }

     public function dataJson()
    {
      
        if (session()->type!='admin akademik' && session()->type!='superadmin'){
            return false;
        }
            // $periode = $this->request->getPost("periode");
            $lists = $this->SM->get_datatables();
            //print_r($lists);
            $data = [];
            //$no = $this->request->getPost("start");

            foreach ($lists as $val) {
               // $no++;
                $row = [];
                $icon =' fa-handshake';
                $colorBtnPer='success';
                $titlePer='Authorized';
                $permisionUp=1;
                if ($val['permission_loan']==1){
                    $icon =' fa-handshake-slash';
                    $colorBtnPer='danger';
                    $titlePer='Unauthorized';
                    $permisionUp=2;
                }

                $row[]=' <a class="btn btn-xs btn-'.$colorBtnPer.'" onclick="permissionUp(\''.$val['numberid'].'\', \''.$permisionUp.'\')" data-title="'.$titlePer.'"><i class="icon fa-solid '.$icon.'"></i></a>';
                $row[]='<span class="currency">'.$val['numberid'].'</span>';
                $row[]='<span class="currency">'.$val['fullname'].'</span>';

                $row[]=' <span>'.$val['studyprogram'].'</span>';
                $row[]=' <span>'.$val['schoolyear'].'</span>';
                 $row[]=' <span>'.$val['studentclass'].'</span>';
                $row[]=' <span class="tb-amount">'.$val['phone'].' </span>';
                
                
                $data[] = $row;
            }
            $output = [
                "draw" => $this->request->getPost('draw'),
                "recordsTotal" => $this->SM->count_all(),
                "recordsFiltered" => $this->SM->count_filtered(),
                "data" => $data
            ];
            echo json_encode($output);
 
    }

    
    public function upPerStuent()
    {  
        
      
        if (session()->type!='admin akademik' && session()->type!='superadmin'){
            return false;
        }

        $id=$this->request->getPost('student_id');
                $data = array(
                    'permission_loan'       =>$this->request->getPost('permission'),
                 );
                    $this->SM->updateStudent($data,$id);
                 
                    $callback=json_encode(array('status' => 'ok;', 'text' => ''));
            
                echo $callback;
    }

}