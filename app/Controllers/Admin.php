<?php

namespace App\Controllers;
use App\Models\TestingModel;
use App\Models\LoginModel;


class Admin extends BaseController
{
    public function __construct()
    {
        // session_start();
         $this->validation =  \Config\Services::validation();
         $this->session = \Config\Services::session();
        $this->email = \Config\Services::email();
        $this->TM = new TestingModel();
        $this->LM = new LoginModel();
   
    }
    public function index()
    {   
        
         if (session()->nip_emp!=null){
                return redirect()->to(base_url('Siak'));
        }
        

        

        if (!isset($_POST['simpan'])) {
            $data = [
                'titletab' => 'Mitra',
                'activemitra' => 'active',
            ];
            // echo env;
             echo view('partials/login/index', $data);
        } else {
     
            $this->validation->setRules([

                'username' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'username tidak boleh kosong',
                    ],
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'password tidak boleh kosong',

                    ],

                ],

            ]);

            $isDataValid = $this->validation->withRequest($this->request)->run();
            $getuser = $this->LM->getUsers($this->request->getPost('username'));
            $getDataSession=$this->LM->getDataSession($this->request->getPost('username'));
            // print_r($getuser);
            if (isset($getuser)) {
                $cekusername = true;
                if ($getuser['password'] == md5(md5($this->request->getPost('password')))) {
                    $cekpasword = true;
                } else {
                    $cekpasword = false;
                }
            } else {
                $cekusername = false;
                $cekpasword = null;

            }
        
            if ($isDataValid && $cekusername && $cekpasword) {

                session()->set($getDataSession);
                //print_r(session()->get());
                return redirect()->to(base_url('Siak'));
            } else {

                $data['validation'] = $this->validation;
                $data['cekusername'] = $cekusername;
                $data['cekpasword'] = $cekpasword;
                //print_r($data['validation']->getErrors());
                  echo view('partials/login/index', $data);
            }
        }
    }

    public function formSignin(){
        if (!isset($_POST['simpan'])) {
            $data = [
                'titletab' => 'Mitra',
                'activemitra' => 'active',
            ];
            // echo ENVIRONMENT;
            echo view('partials/login/index', $data);
        } else {
            
        }

    }

     public function pgwSignin()
    {   
        if (session()->nip_emp!=null){
                return redirect()->to(base_url('Siak'));
        }

        if (!isset($_POST['simpan'])) {
            $data = [
                'titletab' => 'Mitra',
                'activemitra' => 'active',
            ];
            // echo ENVIRONMENT;
            echo view('partials/login/index', $data);
        } else {
     
            $this->validation->setRules([

                'username' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'username tidak boleh kosong',
                    ],
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'password tidak boleh kosong',

                    ],

                ],

            ]);

            $isDataValid = $this->validation->withRequest($this->request)->run();
          

            if ($this->request->getPost('username')=='employee' && $this->request->getPost('password') =='employee'){
                $cekusername = true;
                $cekpasword = true;
            }else{

                   
                    //  $cekpasword=false;
                     $cekusername=false;
               
            }
               if($cekusername && $cekpasword){
                  
                        $checkAuth=true; 
                }else{
                     $checkAuth=false;
                }
              
            if ($isDataValid &&  $checkAuth) {
               

                  $dataEmp=array(
                    'nip_emp'=>'22980002 ',
                    'name_emp'=>'employe dummy',
                    'unit_emp'=> 'BAGIAN SEKRETARIS PIMPINAN, PUBLIC RELATION, DAN LEGAL KAMPUS JAKARTA',
                    'positionname'=>'STAFF URUSAN SEKRETARIS PIMPINAN DAN PUBLIC RELATION KAMPUS JAKARTA',
                    'worklocationparent'=>'BAGIAN SEKRETARIS PIMPINAN, PUBLIC RELATION, DAN LEGAL KAMPUS JAKARTA',
                    'worklocationname'=>'URUSAN SEKRETARIS PIMPINAN DAN PUBLIC RELATION KAMPUS JAKARTA',
                    'email'=>'employe dummy@gmail.com',
                    'position'=>'Pegawai',
                    'no_tlp'=>'098435797944',
                    
                 );
                
                 $dataEmp['pembina']=false;
                 $dataEmp['lectur']=false;
                 $dataEmp['unit_emp']='purel';
                 $dataEmp['type']='TPA PROFESIONAL FULL TIME';
               
                 $dataEmp['status_pgw']='fultime';
                 session()->set($dataEmp);
                //print_r(session()->get());
                return redirect()->to(base_url('Siak'));
            } else {

                $data['validation'] = $this->validation;
                $data['cekusername'] = $cekusername;
        
                //print_r($data['validation']->getErrors());
                  echo view('partials/login/index', $data);
            }
        }
    }

    public function pgwSigninByNik($nik)
    {   

            $isDataValid = $this->validation->withRequest($this->request)->run();
            $acc      =  array('username' => 'sofyanhadihidayat','password' => 'Hady@11223');
            $getToken = GetToken($acc);

                $profile  = GetProfile($getToken->token);
                $position = GetPosition($nik, $getToken->token );
                $contact  = GetContact($nik, $getToken->token );
               
                $email ='';
                $wa ='';
                $phone ='';
                foreach ($contact as $value) {
                    if ($value->id_contacttype==8 ){
                      $wa = $value->account_value;
                    }else if($value->id_contacttype==11 ){
                      $phone = $value->account_value;
                    }else if ($value->id_contacttype==1 ){
                        if (strpos($value->account_value, "@gmail.com") !== false){
                            $email=$value->account_value;
                        }else{
                            $email="";
                        }
                    }
                }
                    if ($position[0]->stucturalpositionname==null){
                     if ($position[0]->worklocationparent==null){
                            $unitEmp=$position[0]->worklocationname;
                        }else{
                            $unitEmp=$position[0]->worklocationparent;
                        }
                    }else{
                      $unitEmp=$position[0]->structuralworklocationname;
                    }


                  $dataEmp=array(
                    'nip_emp'=> $position[0]->employeeidentifynumber,
                    'name_emp'=>$position[0]->fullname,
                    'unit_emp'=> $unitEmp,
                    'positionname'=>$position[0]->positionname,
                    'worklocationparent'=>$position[0]->worklocationparent,
                    'worklocationname'=>$position[0]->worklocationname,
                    'email'=>$email,
                    'position'=>'Pegawai',
                    'no_tlp'=>isset($wa)?$wa:$phone,
                    
                 );
                 $checkData=$this->LM->Chekdata($position[0]->employeeidentifynumber);
                 if(count($checkData)==0){
                    // $this->LM->addEmployee($dataEmp);
                 }else{
                   $getDataPgw=$this->LM->getDataEmpByNip($position[0]->employeeidentifynumber);
                    if($position[0]->employmentstatusname!='MAGANG' || !isset($getDataPgw['unit_emp']) ){
                    //   $this->LM->updateEmployee($dataEmp,$position[0]->employeeidentifynumber );  
                    }
                 }
                   $getDataPgw=$this->LM->getDataEmpByNip($position[0]->employeeidentifynumber);
                  $checkDataAdmin=$this->LM->getDataAdminByIdEmp($getDataPgw['id']);
                  $checkDataPbb=$this->LM->getDataPbb($position[0]->employeeidentifynumber);
                 $dataEmp['pembina']=count($checkDataPbb)>=1?true:false;
                 $dataEmp['lectur']=strpos($position[0]->positionname, "DOSEN") !== false?true:false;
                 $dataEmp['unit_emp']=$getDataPgw['unit_emp'];
                 $dataEmp['type']=(count($checkDataAdmin)==0)?'pegawai':$checkDataAdmin[0]['type'];
                 if (count($checkDataAdmin)!=0){
                  $dataEmp['id']=$checkDataAdmin[0]['id'];
                 }
                 $dataEmp['status_pgw']=$position[0]->employmentstatusname;
                 session()->set($dataEmp);
                //print_r(session()->get());
                return redirect()->to(base_url('Siak'));
           
        
    }

    public function studentSignin(){
        if (session()->numberid!=null){
                return redirect()->to(base_url('Siak'));
        }

        if (!isset($_POST['simpan'])) {
            $data = [
                'titletab' => 'Mitra',
                'activemitra' => 'active',
            ];
            echo view('partials/login/index_student', $data);
        } else {
    
            $this->validation->setRules([

                'username' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'email/username tidak boleh kosong',
                    ],
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'password tidak boleh kosong',

                    ],

                ],

            ]);

            $isDataValid = $this->validation->withRequest($this->request)->run();
            
            if ( $this->request->getPost('username')=='student' && $this->request->getPost('password') =='student'){
                $cekusername = true;
                $cekpasword = true;
            }else{
                if ($this->request->getPost('username') !== 'student') {
                    $cekpasword=null;
                    $cekusername = false;
                  
                } else {
                    
                    $cekpasword=false;
                    $cekusername=null;
                
                }
            }
           
                if($cekusername && $cekpasword){
                   
                    $checkAuth=true; 
                }else{
                    $checkAuth=false;
                }
            if ($isDataValid && $checkAuth) {
            


                $dataEmp=array(
                    "numberid"=> '1201222064 ',
                    "fullname"=> 'Student Dummy',
                    "studyprogram"=> 'S1 Sistem Informasi - Kampus Jakarta',
                    "faculty"=> 'REKAYASA INDUSTRI',
                    "schoolyear"=> '2025',
                    "photo"=> '',
                    "phone"=> '0983473003459',
                    "emergencyphone"=> '989374846',
                    "studentclass"=>'S1SI-22-001',
                    "lecturerguardian"=> 'DEKI SATRIA',
                    "address"=> 'jakarta',
                    "zipcode"=> '',
                    "idcardnumber"=> '35462787256862543',
                    "user"=> 'studentdummmy',
                    "email"=>'studentdummmy@student.telkomuniversity.ac.id'
                    
                );
               
                    $dataEmp['permission_loan']=1;
                 
                $dataEmp['type']='student';
                session()->set($dataEmp);
                //print_r(session()->get());
                return redirect()->to(base_url('Siak'));
            } else {

                $data['validation'] = $this->validation;
                $data['cekusername'] = $cekusername;
                $data['cekpasword'] = $cekpasword;
            
                //print_r($data['validation']->getErrors());
                echo view('partials/login/index_student', $data);
            }
        }
    }

    // public function signStudentbyAdmin($nim){
    //     $checkData=$this->LM->ChekdataStudentRow($nim);
      
    //     $checkData['type']='student';
    //     session()->set($checkData);
    //     // print_r(session()->get());
    //     return redirect()->to(base_url('Siak'));
    // }

     public function Logout()
    {
        session()->destroy();
        return redirect()->to(base_url(''));
    }
      
}
