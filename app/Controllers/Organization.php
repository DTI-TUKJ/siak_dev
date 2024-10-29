<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use \App\Models\OrganizationModel;
 use App\Models\DBigraciasModel;
use App\Models\LoanModel;
use App\Models\LoginModel;
class Organization extends BaseController
{
    public function __construct()
    {
        // session_start();
        $this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->req = \Config\Services::request();
        $this->email = \Config\Services::email();
        $this->OM = new OrganizationModel($this->req);
        // $this->DIM = new DBigraciasModel();
        $this->LgM = new LoginModel();
        $this->LM = new LoanModel($this->req);

        //   helper('cookie');

        // set_cookie('my_cookie', 'nilai_cookie', 3600, '', '', false, true);
 
   
    }

    public function index()
    {
              if (session()->id==null || session()->type!='admin akademik'){
                return redirect()->to(base_url('Siak'));
            }
            //  $data=array(
            //             "data_owner"=>$this->LM->findAll(),
            //             );
         return view('main/organization/index');
    }

     public function dataJson()
    {
      
            // $periode = $this->request->getPost("periode");
            $lists = $this->OM->get_datatables();
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
                if ($val['assoc_permission_loan']==1){
                    $icon =' fa-handshake-slash';
                    $colorBtnPer='danger';
                    $titlePer='Unauthorized';
                    $permisionUp=0;
                }
                $row[]='<a class="btn btn-xs btn-secondary" onclick="popupedit(\''.$val['assoc_id'].'\')"><i class="icon fa-solid fa-pen-to-square"></i></a>
                        <a class="btn btn-xs btn-danger" onclick="deletedata(\''.$val['assoc_id'].'\')"><i class="icon fa-solid fa-trash"></i></a>
                        <a class="btn btn-xs btn-'.$colorBtnPer.'" onclick="permissionUp(\''.$val['assoc_id'].'\', \''.$permisionUp.'\')" data-title="'.$titlePer.'"><i class="icon fa-solid '.$icon.'"></i></a>';
                  

                $row[]='<span class="currency">'.$val['assoc_name'].'</span>';
                $row[]='<span class="currency">'.$val['assoc_desc'].'</span>';
                $row[]=' <span>'.$val['fullname'].'</span>';
                $row[]=' <span>'.$val['pembina_a'].'</span>';
                $row[]=' <span class="currency">'.$val['pembina_b'].' </span>';
                $permision=$val['assoc_permission_loan']==1?' <span class="tb-status text-success">Authorized</span>':'<span class="tb-status text-danger">Unauthorized</span>';
                $row[]=$permision;
                
                $data[] = $row;
            }
            $output = [
                "draw" => $this->request->getPost('draw'),
                "recordsTotal" => $this->OM->count_all(),
                "recordsFiltered" => $this->OM->count_filtered(),
                "data" => $data
            ];
            echo json_encode($output);
 
    }

    public function getLeader(){
         if (session()->id==null || session()->type!='admin akademik'){
            return false;
        }
         $s = strtoupper($this->request->getPost('searchTerm'));
     
        $dbs = $this->OM->getLeader($s);
        //  print_r($dbs);
        $result = array();
        foreach ($dbs as $db)
            $result[] = array(
                'id' => $db->numberid,
                'text' => $db->fullname.' ('.$db->numberid.') '
            );

        echo json_encode($result);
    }

    public function getPgwId()
    {
         if (session()->id==null || session()->type!='admin akademik'){
            return false;
        }
        $s = strtoupper($this->request->getPost('searchTerm'))  ;
        $dbs = $this->OM->getNip($s);
        // print_r($dbs);
        $result = array();

        foreach ($dbs as $db){
            // $nip=explode("-", $db->EMPLOYEEID);
            $result[] = array(
                'id' => $db->nip_emp,
                'text' => $db->name_emp.'( '.$db->nip_emp.' )'
            );
        }

        echo json_encode($result);
    }
    public function insertOrg()
    {    
    // detail =$this->request->getPost('manager');
        // print_r($detail);

        if (session()->id==null || session()->type!='admin akademik'){
            return false;
        }

        
        $this->validation->setRules([
                    'assoc_name' =>
                    [
                        'label'  => 'Nama Himpunan',
                        'rules'  => 'required',
                        'errors' => [
                            'required' => ' {field} mohon diisi',
                        ],
                    ],
                
                    'description_assoc' =>
                    [
                        'label'  => 'Deskripsi Himpunan',
                        'rules'  => 'required',
                        'errors' => [
                            'required' => ' {field} mohon diisi',
                        ],
                    ],

                    'ketua_himpunan' =>
                    [
                        'label'  => 'Kahim',
                        'rules'  => 'required',
                        'errors' => [
                            'required' => ' {field} mohon diisi',
                        ],
                    ],

                    'pembina_a' =>
                    [
                        'label'  => 'Pembina 1',
                        'rules'  => 'required',
                        'errors' => [
                            'required' => ' {field} mohon diisi',
                        ],
                    ],

                    
                ]);
            $isDataValid = $this->validation->withRequest($this->request)->run();
            

            if ($isDataValid) {
                // $dataMhw=$this->DIM->getStudentbyId($this->request->getPost('ketua_himpunan'));
                // $pembina=array($this->request->getPost('pembina_a'),$this->request->getPost('pembina_b'));
                // $dataEmp=[];
                // for ($i=0; $i < count($pembina) ; $i++) {
                //     if ($pembina[$i]!='') {
                //         $checkData=$this->LgM->Chekdata($pembina[$i]);
                //         $getDataEmp=$this->DIM->getEmpByNip($pembina[$i]);
                        
                //         if(count($checkData)==0){
                //             $nip=explode("-",$getDataEmp['EMPLOYEEID']);
                //             $dataEmp[]=array(
                //                 'nip_emp'=> $nip[0],
                //                 'name_emp'=>$getDataEmp['FULLNAME'],
                //                 'position'=>'Pegawai',

                //             );
                //         }
                //     } 
                     
                // }
                //  if(count($dataEmp)!=0){
                //     $this->LgM->addEmployeeBatch($dataEmp);
                //  }
                // //  print_r($dataEmp);
                // // die();
                // $dataInsertMhw=array(
                //     'numberid'=>$dataMhw['STUDENTID'],
                //     'fullname'=>$dataMhw['FULLNAME'],
                //     'schoolyear'=>$dataMhw['STUDENTSCHOOLYEAR'],
                //     'studentclass'=>$dataMhw['CLASS'],
                // );
                // $checkData=$this->LgM->ChekdataStudent($this->request->getPost('ketua_himpunan'));
                // if(count($checkData)==0){
                //     $this->LgM->addStudent($dataInsertMhw);
                // }
                $data = array(
                    'assoc_name'       =>strtoupper($this->request->getPost('assoc_name')),

                    'assoc_leader_id'     => $this->request->getPost('ketua_himpunan'),
                    'assoc_lecturer_id'   => $this->request->getPost('pembina_a'),
                    'assoc_lecturer_id_b' => $this->request->getPost('pembina_b'),
                    'assoc_desc'          => strtoupper($this->request->getPost('description_assoc')),
                    );
                    $this->OM->insertOrg($data);
                 
                    $callback=json_encode(array('status' => 'ok;', 'text' => ''));
            
                echo $callback;
            } else {
                $validation = $this->validation;
                $error=$validation->getErrors();
            
                $dataname=$_POST;
                    
                echo json_encode(array('status' => 'error;', 'text' => '', 'data'=>$error,'dataname'=>$dataname));
            }

    
    }

   public function deleteOrg()
    {

        if (session()->id==null || session()->type!='admin akademik'){
            return false;
        }


        $id = $this->request->getPost('id_org');
        $this->OM->deleteOrg($id);

        echo json_encode(array('status' => 'ok;', 'text' => ''));

    }

    public function updateTableStudent(){
        $dataMhw=$this->DIM->getAllDataMhw();
        $updateTable=$this->OM->updateTableMhw($dataMhw);
        echo "ok";
    }

    public function modalEdit()
    {
        if (session()->id==null || session()->type!='admin akademik'){
            return false;
        }


      $id=$this->request->getPost('id');
      $datajbt=$this->OM->getById($id);
   
       echo json_encode(array('status' => 'ok;', 'data'=>$datajbt));
    }

    public function editOrg()
    {    
    // detail =$this->request->getPost('manager');
        // print_r($detail);

        if (session()->id==null || session()->type!='admin akademik'){
            return false;
        }

        
        $this->validation->setRules([
                    'assoc_name' =>
                    [
                        'label'  => 'Nama Himpunan',
                        'rules'  => 'required',
                        'errors' => [
                            'required' => ' {field} mohon diisi',
                        ],
                    ],
                
                    'description_assoc' =>
                    [
                        'label'  => 'Deskripsi Himpunan',
                        'rules'  => 'required',
                        'errors' => [
                            'required' => ' {field} mohon diisi',
                        ],
                    ],

                    'ketua_himpunan' =>
                    [
                        'label'  => 'Kahim',
                        'rules'  => 'required',
                        'errors' => [
                            'required' => ' {field} mohon diisi',
                        ],
                    ],

                    'pembina_a' =>
                    [
                        'label'  => 'Pembina 1',
                        'rules'  => 'required',
                        'errors' => [
                            'required' => ' {field} mohon diisi',
                        ],
                    ],

                    
                ]);
            $isDataValid = $this->validation->withRequest($this->request)->run();
            
            $lecturer_b =$this->request->getPost('delete_pb_2')==1? null:$this->request->getPost('pembina_b');

            if ($isDataValid) {
                $id=$this->request->getPost('assoc_id');
                $data = array(
                    'assoc_name'       =>strtoupper($this->request->getPost('assoc_name')),

                    'assoc_leader_id'     => $this->request->getPost('ketua_himpunan'),
                    'assoc_lecturer_id'   => $this->request->getPost('pembina_a'),
                    'assoc_lecturer_id_b' => $lecturer_b,
                    'assoc_desc'          => strtoupper($this->request->getPost('description_assoc')),
                    );
                    $this->OM->updateOrg($data,$id);
                 
                    $callback=json_encode(array('status' => 'ok;', 'text' => ''));
            
                echo $callback;
            } else {
                $validation = $this->validation;
                $error=$validation->getErrors();
            
                $dataname=$_POST;
                    
                echo json_encode(array('status' => 'error;', 'text' => '', 'data'=>$error,'dataname'=>$dataname));
            }

    
    }

    public function upPerOrg()
    {  
        
        if (session()->id==null || session()->type!='admin akademik'){
            return false;
        }

        $id=$this->request->getPost('assoc_id');
                $data = array(
                    'assoc_permission_loan'       =>$this->request->getPost('permission'),
                 );
                    $this->OM->updateOrg($data,$id);
                 
                    $callback=json_encode(array('status' => 'ok;', 'text' => ''));
            
                echo $callback;
    }


}