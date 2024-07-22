<?php

namespace App\Controllers;
use App\Models\scheduleModel;
use App\Models\LoginModel;
// use App\Models\DBigraciasModel;

class Home extends BaseController
{
    public function __construct()
    {
        // session_start();
        // $this->validation =  \Config\Services::validation();\
        $this->req = \Config\Services::request();
        $this->SM = new scheduleModel($this->req);
        $this->LM = new LoginModel();
        // $this->DBM = new DBigraciasModel();
        //   helper('cookie');

        // set_cookie('my_cookie', 'nilai_cookie', 3600, '', '', false, true);
   
    }
    public function index()
    { 
        //  print_r($data);
        if (session()->nip_emp==null){
              if(session()->numberid==null){
                return redirect()->to(base_url('Signin'));
              }
            }
        $data=array(
          "dataHour"=>$this->SM->getHoursAll(),
        );
          //  print_r(session()->get());
       return session()->name_emp!=null?view('main/dashboard/index_new',$data):view('main/dashboard/index_student', $data);
    }

    public function index_old()
    { 
      return redirect()->to(base_url(''));
    }
}
