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
            $acc      =  array('username' => $this->request->getPost('username'),'password' => $this->request->getPost('password'));
            $getToken = GetToken($acc);

            if (isset($getToken->token)){
                $cekusername = true;
                $cekpasword = true;
            }else{
                if (strpos($getToken->message, "password") !== false) {
                   
                     $cekpasword=false;
                     $cekusername=null;
                } else {
                    $cekpasword=null;
                    $cekusername = false;
                   
                  
                }
            }
                $checkTUJ=null;
                if($cekusername && $cekpasword){
                    $profile  = GetProfile($getToken->token);
                    $position = GetPosition($profile->identitynumber, $getToken->token );
                    $contact  = GetContact($profile->identitynumber, $getToken->token );
                    
                    if(strpos($position[0]->positionname, "JAKARTA") !== false  || $position[0]->positionname==null){
                        $checkAuth=true; 

                    }else{
                        $checkAuth=false;
                        $checkTUJ=false;
                    }
                }else{
                     $checkAuth=false;
                }
              
            if ($isDataValid &&  $checkAuth) {
               
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
                            $email=$profile->user.'@telkomuniversity.ac.id';
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
                    'nip_emp'=> $profile->numberid,
                    'name_emp'=>$profile->fullname,
                    'unit_emp'=> $unitEmp,
                    'positionname'=>$position[0]->positionname,
                    'worklocationparent'=>$position[0]->worklocationparent,
                    'worklocationname'=>$position[0]->worklocationname,
                    'email'=>$email,
                    'position'=>'Pegawai',
                    'no_tlp'=>isset($wa)?$wa:$phone,
                    
                 );
                 $checkData=$this->LM->Chekdata($profile->numberid);
                 if(count($checkData)==0){
                    $this->LM->addEmployee($dataEmp);
                 }else{
                   $getDataPgw=$this->LM->getDataEmpByNip($profile->numberid);
                    if($position[0]->employmentstatusname!='MAGANG' || !isset($getDataPgw['unit_emp']) ){
                      $this->LM->updateEmployee($dataEmp,$profile->numberid );  
                    }
                 }
                   $getDataPgw=$this->LM->getDataEmpByNip($profile->numberid);
                  $checkDataAdmin=$this->LM->getDataAdminByIdEmp($getDataPgw['id']);
                  $checkDataPbb=$this->LM->getDataPbb($profile->numberid);
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
            } else {

                $data['validation'] = $this->validation;
                $data['cekusername'] = $cekusername;
                $data['cekpasword'] = $cekpasword;
                 $data['checkTUJ'] = $checkTUJ;
                //print_r($data['validation']->getErrors());
                  echo view('partials/login/index', $data);
            }
        }
    }

    public function pgwSigninByNik($nik)
    {   

            $isDataValid = $this->validation->withRequest($this->request)->run();
            $acc      =  array('username' => 'sofyanhadihidayat','password' => 'Hady@0305');
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
   

    public function redirect(){
        $token=$_GET['token'];
    
        $profile  = GetProfile($token);
        $position = GetPosition($profile->identitynumber, $token );
        $contact  = GetContact($profile->identitynumber, $token );
                    
        if(strpos($position[0]->positionname, "JAKARTA") !== false  || $position[0]->positionname==null){
                  
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
                            $email=$profile->user.'@telkomuniversity.ac.id';
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
                    'nip_emp'=> $profile->numberid,
                    'name_emp'=>$profile->fullname,
                    'unit_emp'=> $unitEmp,
                    'positionname'=>$position[0]->positionname,
                    'worklocationparent'=>$position[0]->worklocationparent,
                    'worklocationname'=>$position[0]->worklocationname,
                    'email'=>$email,
                    'position'=>'Pegawai',
                    'no_tlp'=>isset($wa)?$wa:$phone,
                    
                 );
                 $checkData=$this->LM->Chekdata($profile->numberid);
                 if(count($checkData)==0){
                    $this->LM->addEmployee($dataEmp);
                 }else{
                   $getDataPgw=$this->LM->getDataEmpByNip($profile->numberid);
                    if($position[0]->employmentstatusname!='MAGANG' || !isset($getDataPgw['unit_emp']) ){
                      $this->LM->updateEmployee($dataEmp,$profile->numberid );  
                    }
                 }
                   $getDataPgw=$this->LM->getDataEmpByNip($profile->numberid);
                  $checkDataAdmin=$this->LM->getDataAdminByIdEmp($getDataPgw['id']);

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

                'email' => [
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
            $acc      =  array('username' => strtolower($this->request->getPost('email')),'password' => $this->request->getPost('password'));
            $getToken = GetToken($acc);

            if (isset($getToken->token)){
                $cekusername = true;
                $cekpasword = true;
            }else{
                if (strpos($getToken->message, "password") !== false) {
                
                    $cekpasword=false;
                    $cekusername=null;
                } else {
                    $cekpasword=null;
                    $cekusername = false;
                
                
                }
            }
           
                if($cekusername && $cekpasword){
                    $profile  = GetProfile($getToken->token);
                    $checkAuth=true; 
                }else{
                    $checkAuth=false;
                }
            
            if ($isDataValid &&  $checkAuth) {
            


                $dataEmp=array(
                    "numberid"=> $profile->numberid,
                    "fullname"=> $profile->fullname,
                    "studyprogram"=> $profile->studyprogram,
                    "faculty"=> $profile->faculty,
                    "schoolyear"=> $profile->schoolyear,
                    "photo"=> $profile->photo,
                    "phone"=> $profile->phone,
                    "emergencyphone"=> $profile->emergencyphone,
                    "studentclass"=> $profile->studentclass,
                    "lecturerguardian"=> $profile->lecturerguardian,
                    "address"=> $profile->address,
                    "zipcode"=> $profile->zipcode,
                    "idcardnumber"=> $profile->idcardnumber,
                    "user"=> $profile->user,
                    "email"=>$profile->email
                    
                );
                $checkData=$this->LM->ChekdataStudent($profile->numberid);
                if(count($checkData)==0){
                    $dataEmp['permission_loan']=1;
                    $this->LM->addStudent($dataEmp);
                }else{
              
                    $this->LM->updateStudent($dataEmp,$profile->numberid ); 
                    $dataEmp['permission_loan']=$checkData[0]['permission_loan'];
                    
                }
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

    public function signStudentbyAdmin($nim){
        $checkData=$this->LM->ChekdataStudentRow($nim);
      
        $checkData['type']='student';
        session()->set($checkData);
        // print_r(session()->get());
        return redirect()->to(base_url('Siak'));
    }

     public function Logout()
    {
        session()->destroy();
        return redirect()->to(base_url(''));
    }
      
}
