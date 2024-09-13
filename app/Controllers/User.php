<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LoginModel;
use App\Models\scheduleModel;
use App\Models\DBigraciasModel;

class User extends BaseController
{
    protected $LoginModel;
    
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->LM = new LoginModel();
        $this->req = \Config\Services::request();
        $this->SM = new scheduleModel($this->req);
        if ( base_url('')=='http://localhost:8080/'){
            $this->DBM = new DBigraciasModel();
        }
    }

    public function index()
    {
          if (session()->nip_emp==null){
                return redirect()->to(base_url('Siak/Signin'));
            }
         if (session()->type!='superadmin'){
                return redirect()->to(base_url('Siak'));
            }

        $data = [
            'title' => 'Users',
            'data' => $this->LM->getUsersAll(),
            'total' => $this->LM->countAll()
        ];
        return view('main/User/index', $data);
    }

  public function simpanData()
    {
          if (session()->nip_emp==null){
                return redirect()->to(base_url('Siak/Signin'));
            }

        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'nip' => [
                'label' => 'Nama Admin',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'username' => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'userType' => [
                'label' => 'Type',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
        ]);

        $adminName  = $this->request->getPost('nip');
        $username   = $this->request->getPost('username');
        $password   = md5(md5($this->request->getPost('password')));
        $userType   = $this->request->getPost('userType');
        // dd($adminName,$username,$password,$userType);

        if (!$valid) {
            // dd('fail');
            $pesan = [
                'errorAdminName'=> '<div class="validate text-danger"><strong>' . $validation->getError('nip') . '</strong></div>',
                'errorUsername' => '<div class="validate text-danger"><strong>' . $validation->getError('username') . '</strong></div>',
                'errorPassword' => '<div class="validate text-danger"><strong>' . $validation->getError('password') . '</strong></div>',
                'errorUserType' => '<div class="validate text-danger"><strong>' . $validation->getError('userType') . '</strong></div>',
            ];
            session()->setFlashdata($pesan);
            return redirect()->to('Siak/User');
        }else {
            // dd('success');
            $this->LM->createUser(array(
                'username'  => $username,
                'password'  => $password,
                'type'      => $userType,
                'Admin_name'=> $adminName,
            ));
            $pesan = [
                'sukses' => '<div class="alert alert-primary">User berhasil ditambahkan...</div>'
            ];
            session()->setFlashdata($pesan);
            return redirect()->to('Siak/User');
        }
    }

       public function deleteUser()
    {

         if (session()->id==null){
            return false;
        }
     
        $id = $this->request->getPost('id_user');
        $this->LM->deleteUser($id);

        echo json_encode(array('status' => 'ok;', 'text' => ''));

    }

    public function updateSchedulefromDBI(){

        if ( base_url('')!='http://localhost:8080/'){
            return redirect()->to(base_url('Siak'));
        }

        $activeSemester =$this->DBM->getSemesterActive();
        // print_r($activeSemester);
        // die();
        $data=$this->DBM->GetSchedule($activeSemester['SCHOOLYEAR'], $activeSemester['SEMESTER']);
        $dataNewMhswa= $activeSemester['SEMESTER']==1? $this->DBM->getAllDataMhw($activeSemester['SCHOOLYEAR']):'none';
        $dataClassroom=$this->DBM->getClassRoom();
        
        $dataApi=array(
            "schedule"=>$data,
            "token"=>'',
            "settingSemester"=> $activeSemester,
            "dataMhw"=>$dataNewMhswa,
            "dataClassroom"=>$dataClassroom
        );
        // echo json_encode($dataApi);
         $res =updateTableSchedule($dataApi);
        //  $update = $this->SM->updateSchedule($data);
        // print_r($dataNewMhswa);
        print_r($res);
    }
}
