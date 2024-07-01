<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\scheduleModel;
use App\Models\DBigraciasModel;
use App\Models\OrganizationModel;
use App\Models\StudentModel;
use App\Models\LoginModel;
use App\Models\LoanModel;

class ScheduleClass extends BaseController
{
    protected $validation;
    protected $session;
    // protected $req;
    protected $email;
    protected $SM;  
    protected $req;

    protected $DIM;
    public function __construct()
    {
        // session_start();
        $this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->req = \Config\Services::request();
        $this->email = \Config\Services::email();
        $this->SM = new scheduleModel($this->req);
        $this->OM = new OrganizationModel($this->req);
        $this->StM = new StudentModel($this->req);
        $this->LgM = new LoginModel();
        $this->LM = new LoanModel($this->req);
        

        //   helper('cookie');

        // set_cookie('my_cookie', 'nilai_cookie', 3600, '', '', false, true);
 
   
    }


     public function dataJson()
    {
          if (session()->nip_emp==null){
                if(session()->numberid==null){
                  return false;
                }
              }
                
            $lists = $this->SM->get_datatables();
            //print_r($lists);
            $data = [];
            //$no = $this->request->getPost("start");
            $hours = $this->SM->getHoursAll();
             $campus = $this->request->getPost("campus");
             $date = date('Y-m-d H:i:s',strtotime($this->request->getPost("date")));
             $room =$this->request->getPost("room");
             $getSemesterActive=$this->SM->getActiveSchoolyear();
            //   echo $room;
            //   die();
            for ($i=0; $i < 7 ; $i++) { 
                # code...
            // }
            // foreach ($lists as $val) {
               // $no++;
                $row = [];
                $days=strtoupper(getDayNameIndonesian(date('Y-m-d H:i:s', strtotime($date.'+'.$i.' days'))));
                $row[]= $days.', '.date('d M Y', strtotime($date.'+'.$i.' days'));
                
                foreach ($hours as $value) {
                    $jum_sch = $this->SM->getSchedule($days,$campus, $value['HOURNAME'], $room);
                    $jum_sch_class = $this->SM->getScheduleClassLoan($days,$campus, $value['HOURNAME'], $room,date('Y-m-d', strtotime($date.'+'.$i.' days')));
                    if ($getSemesterActive['set_semester']!='antara'){
                     if (count($jum_sch)==0){
                        if(count($jum_sch_class)>=1){
                            $row[]= '<input type="button" class="custom-checkbox " data-parsley-multiple="groups" data-parsley-mincheck="2" name="dataSchChosed[]" disabled style="background-color: #eaff00; border: 2px solid #eaff00; ">';
                        }else{
                            $row[]= '<input type="checkbox" class="custom-checkbox" value="'.$days.'|'.$campus.'|'.$value['HOURNAME'].'|'.$room.'|'.date('d M Y', strtotime($date.'+'.$i.' days')).'" data-parsley-multiple="groups" data-parsley-mincheck="2" name="dataSchChosed[]">';
                        }
                     }else{
                        $row[]= '<input type="button" class="custom-checkbox" data-parsley-multiple="groups" data-parsley-mincheck="2" name="dataSchChosed[]" disabled>';
                     }
                   }else{
                    
                        if(count($jum_sch_class)==0){
                            $row[]= '<input type="checkbox" class="custom-checkbox" value="'.$days.'|'.$campus.'|'.$value['HOURNAME'].'|'.$room.'|'.date('d M Y', strtotime($date.'+'.$i.' days')).'" data-parsley-multiple="groups" data-parsley-mincheck="2" name="dataSchChosed[]">';
                        }else{
                            $row[]= '<input type="button" class="custom-checkbox " data-parsley-multiple="groups" data-parsley-mincheck="2" name="dataSchChosed[]" disabled style="background-color: #eaff00; border: 2px solid #eaff00; ">';
                        }

                    
                   }
                }
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

    public function getRoom()
    {
        if (session()->nip_emp==null){
            if(session()->numberid==null){
              return false;
            }
          }

        $s = $this->request->getPost('searchTerm');
        $c = $this->request->getPost('campus');
        $dbs = $this->SM->getRoomAll($s, $c);

        $result = array();
        foreach ($dbs as $db)
            $result[] = array(
                'id' => $db->ROOMNAME,
                'text' => $db->ROOMNAME
            );

        echo json_encode($result);
    }

    public function getOrg()
    {
        if (session()->nip_emp==null){
            if(session()->numberid==null){
              return false;
            }
          }
        $s = $this->request->getPost('searchTerm');
     
        $dbs = $this->OM->getListOrganization($s);

        $result = array();
        foreach ($dbs as $db){
            $permission=$db->assoc_permission_loan==0?' ( Himpunan Tidak Memiliki Izin peminjaman )':'';
            $result[] = array(
                'id' => $db->assoc_id.'|'.$db->assoc_lecturer_id.'|'.$db->assoc_lecturer_id_b.'|'.$db->assoc_name,
                'text' => $db->assoc_desc.' ('.$db->assoc_name.') '.$permission,
                'disabled'=>$db->assoc_permission_loan==0?true:false,
            );
        }
        echo json_encode($result);
    }

    public function addClassLoan()
    {    
    

        if (session()->nip_emp==null){
            if(session()->numberid==null){
              return false;
            }
          }

        $type_loan=$this->request->getPost('type_loan');
        $rules=array(
                
            'type_loan' =>[
                'rules'=>'required',
                // rules greater_than_equal_to sudah dirubah defaultnya
                'errors'=>[
                       'required'=>'Tipe pinjaman Belum diisi',
                ],
                
            ],
            'activity'=>[
                 'rules'=>'required',
                 'errors'=>[
                        'required'=>'Aktivitas Belum diisi',
                    ],

                ],
            );
        
        $org_rules=[];
        
        if ($type_loan=='organization'){
            $org_rules=array(
                'organization' =>[
                    'rules'=>'required',
                    // rules greater_than_equal_to sudah dirubah defaultnya
                    'errors'=>[
                           'required'=>'Organisasi Belum diisi',
                    ],
                    
                ],
                );
        }

        $rules=array_merge($rules,$org_rules);
       
        $replacement_rules=[];
        if ($type_loan=='kelas pengganti'){
            unset($rules['activity']);

            $replacement_rules=array(
                'lecDate' =>[
                    'rules'=>'required',
                    // rules greater_than_equal_to sudah dirubah defaultnya
                    'errors'=>[
                           'required'=>'Tanggal perkuliahan tidak boleh kosong',
                    ],
                    
                ],

                'subject'=>[
                    'rules'=>'required',
                    // rules greater_than_equal_to sudah dirubah defaultnya
                    'errors'=>[
                           'required'=>'Mata Kuliah tidak boleh kosong',
                    ],
                ],

                'classname'=>[
                    'rules'=>'required',
                    // rules greater_than_equal_to sudah dirubah defaultnya
                    'errors'=>[
                           'required'=>'Nama Kelas tidak boleh kosong',
                    ],
                ],
                'study_program'=>[
                    'rules'=>'required',
                    // rules greater_than_equal_to sudah dirubah defaultnya
                    'errors'=>[
                           'required'=>'Program Studi tidak boleh kosong',
                    ],
                ],
                'reason'=>[
                    'rules'=>'required',
                    // rules greater_than_equal_to sudah dirubah defaultnya
                    'errors'=>[
                           'required'=>'Alasan mengganti kelas tidak boleh kosong',
                    ],
                ]
            );
        }

        $rules=array_merge($rules, $replacement_rules);
      
        $admin_rules=[];
        if(session()->type=='admin akademik'){
            $admin_rules=array(
                'pic_loan' =>[
                    'rules'=>'required',
                    // rules greater_than_equal_to sudah dirubah defaultnya
                    'errors'=>[
                           'required'=>'PIC Belum diisi',
                    ],
                    
                ],
                );
        }

        $rules=array_merge($rules,  $admin_rules);

        $this->validation->setRules($rules);
        $isDataValid = $this->validation->withRequest($this->request)->run();
         

        if ($isDataValid) {
            $date_start=date('Y-m-d H:i:s', strtotime($this->request->getPost('date_loan')));
            $id_class=$this->SM->getIdclass($this->request->getPost('room_name'));
            $orgData=explode("|", $this->request->getPost('organization'));
            $aproval_lec_a=$type_loan=='organization'?0:4;
            $aproval_lec_b=$type_loan!='organization'||$orgData[2]==''?4:0;

             if (session()->type=='admin akademik'){
                $nim_loaner=$this->request->getPost('pic_loan');
                $aproval_lak=$type_loan=='organization'?0:1;
                $st_class_loan=$type_loan=='organization'?0:1;
                if ($type_loan=='organization'){
                    $aproval_lec_a=session()->nip_emp==$orgData[1]?1:$aproval_lec_a;
                    $aproval_lec_b=session()->nip_emp==$orgData[2]?1:$aproval_lec_b;
                    if ($aproval_lec_b==4){
                        $st_class_loan=$aproval_lec_a==1?1:$st_class_loan;
                        $aproval_lak=$aproval_lec_a==1?1:$aproval_lak;
                    }
                }
             }else{
                $nim_loaner=isset(session()->numberid)?session()->numberid:session()->nip_emp;
                $aproval_lak=0;
                $st_class_loan=0;
               
             }
           
             $activeYear=$this->SM->getActiveSchoolyear();

            $data = array(
                'activity_class'    =>$this->request->getPost('activity'),
                'loan_class_date'   =>$date_start,
                'dayname'           =>strtoupper(getDayNameIndonesian(date('Y-m-d H:i:s', strtotime($date_start)))),
                'class_id'          =>$id_class['ROOMID'],
                'starttime'         =>$this->request->getPost('start_time'),
                'endtime'           =>$this->request->getPost('end_time'),
                'nim_loaner'        =>$nim_loaner,
                'id_association'    =>$type_loan=='organization'?$orgData[0]:'',
                'request_type'      =>$this->request->getPost('type_loan'),
                'aproval_lecturer_a'=>$aproval_lec_a,
                'aproval_lecturer_b'=>$aproval_lec_b,
                'aproval_lak'       =>$aproval_lak,
                'status_class_loan' =>$st_class_loan,
                'schoolyear'        =>$activeYear['set_schoolyear'],
                'semester'          =>$activeYear['set_semester']
                
            );

            $data_replacement_class=[];
            if ($data['request_type']=='kelas pengganti'){
                unset($data['activity_class']);
                $data_replacement_class=array(
                    'actual_lecture_date'=>date('Y-m-d H:i:s', strtotime( $this->request->getPost('lecDate'))),
                    'subject_name'=>$this->request->getPost('subject'),
                    'class_name'=>$this->request->getPost('classname'),
                    'studyprogram_loan'=>$this->request->getPost('study_program'),
                    'replacement_reason'=>$this->request->getPost('reason')
                );
            }
            $data=array_merge($data, $data_replacement_class);

            $dataLoaner=$this->StM->getStudentbyId($data['nim_loaner']);
            $dataLoanerEmp=$this->LM->getPgwbyId($data['nim_loaner']);
            $this->SM->createLoanClass($data);
            $data['name_room']=$id_class['ROOMNAME'];
            $data['org_name']=isset($orgData[3])?$orgData[3]:'-';
            $loaner=isset($dataLoaner['fullname'])?$dataLoaner['fullname']:$dataLoanerEmp['name_emp'];
            if ($data['request_type']=='organization'){
                $dataOrg=$this->OM->getById($data['id_association']);
                if ($dataOrg['no_tlp_pembina_a']!='' || $dataOrg['no_tlp_pembina_a']!=null){
                    $this->SendWaReq( $loaner, $dataOrg['no_tlp_pembina_a'] ,'addClassRoomLoan',$this->request->getPost('activity'),'', $data);
                }
            }else{
                $getOwner = $this->LgM->getOwner('admin akademik');
                $i=1;
                $waNum='';
                foreach ($getOwner as $val) {
                    $mark=count($getOwner)==$i?'':'|';
                $waNum=$waNum.convert_num($val['no_tlp']).$mark;
                $i++;
                }
                 
                if (session()->type!='admin akademik'){
                     $this->SendWaReq( $loaner, $waNum ,'addClassRoomLoan',$this->request->getPost('activity'),$data['request_type'], $data);
                 }
            }
           

            echo json_encode(array('status' => 'ok;', 'text' => ''));
        } else {
           $validation = $this->validation;
            $error=$validation->getErrors();
           
            $dataname=$_POST;

                  //print_r($error);
            echo json_encode(array('status' => 'error;', 'text' => '', 'data'=>$error,'dataname'=>$dataname));
        }
    }

    public function beetweenSemester(){
        if (session()->type!=='admin akademik'){
            return false;
          }

        $getSemesterActive=$this->SM->getActiveSchoolyear();
        $data=array(
            "set_schoolyear"=>$getSemesterActive['set_schoolyear'],
            "set_semester"=>"antara",
            "set_status"=>1,
        );
      $this->SM->updateActiveSemester($data);
      echo json_encode(array('status' => 'ok;', 'text' => ''));
    }

    protected function SendWaReq($nama, $num,$act, $activity='', $type='', $alldata='')
    {
        $testing='';
        if (base_url('')=='http://localhost:8080/'){
            $testing=" - WHATSAPP TESTING";
        }
        if ($act=='addClassRoomLoan'){
          $activity=$alldata['request_type']=='kelas pengganti'? 'kelas pengganti Matakuliah '.$alldata['subject_name']:$activity;
          $reasonRep=null;
          if ($alldata['request_type']=='kelas pengganti'){
            $reasonRep="Alasan Mengganti Kelas : *".$alldata['replacement_reason']."*";
          }
         $data=array(
            "api_key" => "S5lpTgiaUFhigWCLyUYNfcZwyGfZb0",
             "sender" => "6281319800200",
             "number" =>$type==''? convert_num($num):$num,
             "message" => 
"[SIAK] Anda Menerima Permintaan Peminjaman ruang Kelas ".$testing."

Terdapat permintaan peminjaman ruang kelas dengan rincian sebagai brikut
PIC                    : *".$nama."* 
Kegiatan               : *".$activity."*
Ruang Kelas            :  *".$alldata['name_room']."* 
Tanggal Pemakaian      : *".date('d/m/Y', strtotime($alldata['loan_class_date']))."*
Waktu Peminjaman       : *".date('H:i',strtotime($alldata['starttime']))." - ".date('H:i',strtotime($alldata['endtime']))."*
Organization           : *".$alldata['org_name']."*
".$reasonRep."
Silahkan cek akun siak anda untuk menerima atau menolak permintaan dengan login link dibawah

dti-jkt.telkomuniversity.ac.id/Siak/Signin

Notifikasi Siak" ); 
         }
            
       
        return NotifReqWa($data);
    }
}