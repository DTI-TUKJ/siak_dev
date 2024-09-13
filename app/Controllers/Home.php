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
        $this->validation =  \Config\Services::validation();
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
        $datajbt=$this->LM->getDataSetting();
        $datajbt['date_cutoff_req_set']=date('Y-m-d', strtotime($datajbt['date_cutoff_req_set']));
        $data=array(
          "dataHour"=>$this->SM->getHoursAll(),
          "dataSettingApp"=>$datajbt
        );

        // $filePath = base_url('assets/json/settingWeb.json');

        // Memanggil file JSON
        //  $jsonData = file_get_contents($filePath);

        // // Mengubah data JSON menjadi array asosiatif
        // $data = json_decode($jsonData);

        // Menyimpan data ke variabel, lalu passing ke view (jika diperlukan)
        // return view('data_view', ['users' => $data['users']]);
        // echo $filePath;
        // print_r($data);
       return session()->name_emp!=null?view('main/dashboard/index_new',$data):view('main/dashboard/index_student', $data);
    }

    public function index_old()
    { 
      return redirect()->to(base_url(''));
    }

    public function getDataSetting(){

      if (session()->nip_emp==null){
        if(session()->numberid==null){
          return false;
        }
      }
       $datajbt=$this->LM->getDataSetting();
       $datajbt['date_cutoff_req_set']=date('d M Y', strtotime($datajbt['date_cutoff_req_set']));
       echo json_encode(array('status' => 'ok;', 'data'=>$datajbt,));
    }

    public function UpMakDateReq()
    {
        if (session()->nip_emp==null){
            return false;
        }


      
        $this->validation->setRules([
            
                 'dateMaksReq' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'tanggal tidak boleh kosong',
                    ],
                ],
                
            

        ]);
        $isDataValid = $this->validation->withRequest($this->request)->run();
        
        if ($isDataValid) {
            
            $data = array(
                'date_cutoff_req_set' => date ('Y-m-d', strtotime($this->request->getPost('dateMaksReq'))),
                
            );
            session()->set($data);
            $this->LM->updateDataSetting($data, 1);
            echo json_encode(array('status' => 'ok;', 'text' => ''));
        }else {

            $validation = $this->validation;
            $error=$validation->getErrors();
            $dataname=$_POST;
            echo json_encode(array('status' => 'error;', 'text' => '', 'data'=>$error, 'dataname'=>$dataname));
         }

    
    }
}
