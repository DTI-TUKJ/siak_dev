<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use \App\Models\MyassetModel;
use App\Models\LoanModel;
use App\Models\LoginModel;
use App\Models\HistoryAssetModel;

class Loan extends BaseController
{
    public function __construct()
    {
        // session_start();
        $this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->req = \Config\Services::request();
        $this->email = \Config\Services::email();
        
        $this->MAM = new MyassetModel($this->req);
        $this->LM = new LoanModel($this->req);
        $this->HAM = new HistoryAssetModel($this->req);
         $this->LgM = new LoginModel();

        //  helper('cookie');

        // set_cookie('my_cookie', 'nilai_cookie', 3600, '', '', false, true);
   
    }

    public function index()
    {
            if (session()->id==null || session()->type=='pegawai' || session()->type=='admin akadmik'){
                return redirect()->to(base_url('Siak'));
            }
             $data=array(
                        "data_asset"=>$this->MAM->getAssetByOwner(),
                        );
         return view('main/loan/index', $data);
    }

     public function dataJson()
    {
      
            // $periode = $this->request->getPost("periode");
            $lists = $this->LM->get_datatables();
            //print_r($lists);
            $data = [];
            //$no = $this->request->getPost("start");

            foreach ($lists as $val) {
               // $no++;
                $row = [];
                $btnacc='';
                    if ($val['status']==1){
                        if (date('Y-m-d H:i:s')>=$val['tanggal_pinjam']){

                           $btnacc='<a class="btn btn-sm btn-warning "  onclick="upStatusLoan(\''.$val['id_loan'].'\',\'finish\')">End Loan</a>';
                        }
                    }else if ($val['status']==0){
                        if (session()->nip_emp!=$val['nip']){
                               $btnacc='<a class="btn btn-sm btn-success " title="Accept"  onclick="upStatusLoan(\''.$val['id_loan'].'\',\'accept\', \''.$val['email'].'\',\''.$val['no_telepon'].'\')"><i class="icon fa-solid fa-check"></i></a>
                                    <a class="btn btn-sm btn-danger " title="Reject" onclick="upStatusLoan(\''.$val['id_loan'].'\',\'reject\', \''.$val['email'].'\',\''.$val['no_telepon'].'\')"><i class="icon fa-solid fa-xmark"></i></a>';
                        }
                    }
                  

                $row[]=$btnacc.'
                        <a class="btn btn-danger" onclick="deletedata(\''.$val['id_loan'].'\')"><i class="fa-solid fa-trash"></i></a>';
                $row[]=' <span class="tb-amount">'.$val['nip'].' </span>';
                $row[]=' <span class="tb-amount">'.$val['name'].' </span>';
                $row[]=' <div class="currency cut-text">'.$val['activity'].' </div>';
                $row[]=' <div class="currency cut-text">'.$val['destination_city'].' </div>';
                $row[]=' <div class="currency cut-text">'.$val['pickup_point'].' </div>';
                $row[]='<div class="currency cut-text">'.str_replace('PROGRAM STUDI','',str_replace('BAGIAN','',str_replace(' KAMPUS JAKARTA', '', $val['unit'] ))).'</div>';


                $ur_img= base_url('').'/assets/images/item/'.$val['asset_image'];
                  

                $row[]='<div class="user-card">
                            <div class="user-avatar bg-dim-primary d-none d-sm-flex">
                              <img class="user-avatar" src="'.$ur_img.'" alt="" srcset="" class="profile-img" style="object-fit: cover;">
                            </div>
                            <div class="user-info">
                                <span class="tb-lead">'.$val['asset_name'].'<span class="dot dot-success d-md-none ms-1"></span></span>
                                                                 
                            </div>
                        </div>';
                // $row[]='<span class="currency">'.$val['amount_loan'].'</span>';
                  $row[]=' <span class="tb-amount">'.date('d/m/Y',strtotime($val['inputdate'])).' </span>';
                $row[]=' <span class="tb-amount">'.date('d/m/Y - H:i',strtotime($val['tanggal_pinjam'])).' </span>';
                $row[]=' <span class="tb-amount">'.date('d/m/Y - H:i',strtotime($val['tanggal_kembali'])).' </span>';

                (!isset($val['loan_asset_aproval_date']))?$date_aproval = '-':$date_aproval=date('d/m/Y - H:i',strtotime($val['loan_asset_aproval_date']));

                $row[]=' <span class="tb-amount">'.$date_aproval.' </span>';

                (!isset($val['tanggal_masuk']))?$date_in = '-':$date_in=date('d/m/Y - H:i',strtotime($val['tanggal_masuk']));

                $row[]=' <span class="tb-amount">'.$date_in.' </span>';

                if($val['status']==1){

                  $status=' <span class="tb-status text-success">Accepted</span>';
                }else if($val['status']==0){
                    $status=' <span class="tb-status text-warning">Pending</span>';
                }else if($val['status']==3){
                     $status=' <span class="tb-status text-info">Finish</span>';
                }else{
                     $status=' <span class="tb-status text-danger">Rejected</span>';
                }
                $row[]=$status;
                    
                
                $data[] = $row;
            }
            $output = [
                "draw" => $this->request->getPost('draw'),
                "recordsTotal" => $this->LM->count_all(),
                "recordsFiltered" => $this->LM->count_filtered(),
                "data" => $data
            ];
            echo json_encode($output);
 
    }

    public function addLoan()
    {    
    

        if (session()->nip_emp==null){
            return false;
        }

        $max_req=$this->request->getPost('max_req');
        if ($this->request->getPost('owner')!==null){
            $this->validation->setRules([
              
                      'amount_loan' =>[
                        'rules'=>'required|greater_than_equal_to['.$max_req.']',
                        // rules greater_than_equal_to sudah dirubah defaultnya
                        'errors'=>[
                               'required'=>'jumlah loan Belum diisi',
                                'greater_than_equal_to'=>'Jumlah pinjaman lebih dari unit yang tersedia'
                        ],
                        
                    ],
                    'activity'=>[
                         'rules'=>'required',
                         'errors'=>[
                                'required'=>'Aktivitas Belum diisi',
                            ],

                        ],

                ]);
        }else{
                $this->validation->setRules([
                  
                    'nip'=>[
                         'rules'=>'required',
                         'errors'=>[
                                'required'=>'Nip Belum diisi',

                            ],

                        ],
                
                      'amount_loan' =>[
                        'rules'=>'required|greater_than_equal_to['.$max_req.']',
                        // rules greater_than_equal_to sudah dirubah defaultnya
                        'errors'=>[
                               'required'=>'jumlah loan Belum diisi',
                                'greater_than_equal_to'=>'Jumlah pinjaman lebih dari unit yang tersedia'
                        ]
                    ],
                    'activity'=>[
                         'rules'=>'required',
                         'errors'=>[
                                'required'=>'Aktivitas Belum diisi',
                            ],

                        ],



                ]);

            $dataPgw=$this->LM->getPgwbyId($this->request->getPost('nip'));
        }
        $isDataValid = $this->validation->withRequest($this->request)->run();
         

        if ($isDataValid) {
            
           
             $id_asset=$this->request->getPost('id_asset');
             $date_loan= explode(' to ', $this->request->getPost('loan_date'));

             $date_start=date('Y-m-d H:i:s', strtotime($date_loan[0]));
             $date_end=date('Y-m-d H:i:s', strtotime($date_loan[1]));
            
             $driver=explode("|",$this->request->getPost('driver') );
            $data = array(
               'nip'               => $this->request->getPost('owner')!==null? session()->nip_emp :$dataPgw['nip_emp'],
                'name'              => $this->request->getPost('owner')!==null? session()->name_emp :$dataPgw['name_emp'],
                'unit'              => $this->request->getPost('owner')!==null? session()->unit_emp :$dataPgw['unit_emp'],
                'tanggal_pinjam'    => $date_start,
                'tanggal_kembali'   =>$date_end,
                'status'            => $this->request->getPost('owner')!==null? 0 :1,
                'no_telepon'        => $this->request->getPost('owner')!==null? session()->no_tlp :$dataPgw['no_tlp'],
                'amount_loan'       => $this->request->getPost('amount_loan'),
                'id_asset_loan'     =>$this->request->getPost('id_asset'),
                'activity'          => $this->request->getPost('activity'),
                'destination_city'  => ($this->request->getPost('destination')!==null)?$this->request->getPost('destination'):null,
                'driver'            =>$driver[0],
                'pickup_point'      =>($this->request->getPost('pick_up_loc')!==null)?$this->request->getPost('pick_up_loc'):"-",
                         
            );
            $car=$this->MAM->getById($id_asset);

            $this->LM->createLoan($data);
            if ($this->request->getPost('owner')!==null){
               $getOwner = $this->LgM->getOwner($this->request->getPost('owner'));
                  // print_r($getOwner);

                $namapeminjam = $data['name'].' ('.$data['nip'].')';
                
             
                $i=1;
                $waNum='';
                foreach ($getOwner as $val) {
                    $mark=count($getOwner)==$i?'':'|';
                $waNum=$waNum.convert_num($val['no_tlp']).$mark;
                $i++;
                }

                if (base_url('')!='http://localhost:8080/'){

                
                    if(!$this->SendWaReq($namapeminjam,$waNum,'addloan',$this->request->getPost('activity'))){
                     $this->sendEmailRequest($namapeminjam, $val['email'],'addloan');
                    }
                
                    if ($this->request->getPost('driver')!==0){
                        $this->SendWaReq($namapeminjam, $driver[1],'driverNotif',$this->request->getPost('activity'), datetoindo(date('Y-m-d', strtotime($date_loan[0])))." Pukul ".date('H:i', strtotime($date_loan[0]))." (Waktu Dimulainya kegiatan), Dengan mobil ".$car['asset_name']."Serta Lokasi Penjemputan Di ".$this->request->getPost('pick_up_loc'));
                    }
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

    public function deleteLoan()
    {

         if (session()->nip_emp==null){
            return false;
        }
     
        $id = $this->request->getPost('id_loan');
        $this->LM->deleteLoan($id);

        echo json_encode(array('status' => 'ok;', 'text' => ''));

    }

    public function modalEdit()
    {
        if (session()->id==null){
            return false;
        }

      $id=$this->request->getPost('id');
      $datajbt=$this->MAM->getById($id);
      
      $imgsize=filesize('assets/images/item/'.$datajbt['asset_image']);
            // print_r($dataatasan); 
      //dd($datajbt);
       echo json_encode(array('status' => 'ok;', 'data'=>$datajbt, 'imgsize'=> $imgsize));
    }


    public function ScheduleCheck(){


        $this->validation->setRules([
          
            'asset_name'=>[
                 'rules'=>'required',
                 'errors'=>[
                        'required'=>'Nama Asset Belum diisi',

                    ],

                ],
            'loan_date_start'=>[
                 'rules'=>'required',
                 'errors'=>[
                        'required'=>'Tanggal Awal Pinjam Belum diisi',
                        
                    ],

                ], 
           'loan_date_end'=>[
                 'rules'=>'required',
                 'errors'=>[
                        'required'=>'Tanggal akhir Pinjam Belum diisi',
                        
                    ],

                ],      


        ]);
        $isDataValid = $this->validation->withRequest($this->request)->run();

        if ($isDataValid) {
             $id_asset=$this->request->getPost('asset_name');
             $dataasset=$this->MAM->getByIdRow($id_asset);
             //print_r($dataasset);
             //die();
           
             
             $date_start=date('Y-m-d H:i:s', strtotime($this->request->getPost('loan_date_start')));
             $date_end=date('Y-m-d H:i:s', strtotime($this->request->getPost('loan_date_end')));
             $check_asset =$this->LM->checkScheduleAvailable($id_asset, $date_start, $date_end);

            $check_driver =$this->LM->checkScheduleDriver($id_asset, $date_start, $date_end);
            $driver_list="";
            
            foreach ($check_driver as $value) {

                    $noteDis="";
                    $btnDisDriver="";
                    if(isset($value['id_loan'])){
                        $noteDis=' (Driver tidak tersedia ditanggal yang anda pilih)';
                        $btnDisDriver='disabled';
                    }

                $driver_list .='<option value="'.$value['id_driver'].'|'.$value['no_wa_driver'].'" '.$btnDisDriver.' >'.$value['nama_driver'].$noteDis.'</option>';
             }


             if(count($check_asset)==0){
                $data=array(
                        'id_asset'=>$id_asset,
                        'date_loan'=> $this->request->getPost('loan_date_start').' to '.$this->request->getPost('loan_date_end'),
                        'data_asset'=>$this->MAM->getAssetAll(),
                        'max_req'=>$dataasset['amount_asset']
                        );
               echo json_encode(array('status' => 'ok;', 'text' => '', 'data'=>$data, 'driver'=>$driver_list));
             }else{

                $in_loan=0;
                foreach ($check_asset as $value) {
                    $in_loan += $value['amount_loan'];
                }
                $max_req=$dataasset['amount_asset']-$in_loan;
                if ($max_req>0){
                   $data=array(
                        'id_asset'=>$id_asset,
                        'date_loan'=> $this->request->getPost('loan_date_start').' to '.$this->request->getPost('loan_date_end'),
                        'data_asset'=>$this->MAM->getAssetByOwner(),
                        'max_req'=>$max_req
                        );
                    echo json_encode(array('status' => 'ok;', 'text' => '', 'data'=>$data, 'driver'=>$driver_list));
                }else{
                    echo json_encode(array('status' => 'ok;','status_check'=>'unavailable', 'text' => '', 'data'=>null));
                }
                
             }

        }else{
            $validation = $this->validation;
            $error=$validation->getErrors();
            $dataname=$_POST;
                  //print_r($error);
            echo json_encode(array('status' => 'error;', 'text' => '', 'data'=>$error,'dataname'=>$dataname));
        
        }

       
        //print_r($date_loan);
         
        
        //echo json_encode(array('status' => 'ok;', 'text' => '', 'data'=>$data));
    }

     public function updateStatusLoan()
    {

         if (session()->nip_emp==null){
            return false;
        }
       
        $id = $this->request->getPost('id_loan');
        $action= $this->request->getPost('action');
         $email  = $this->request->getPost('email');
          $wa  = $this->request->getPost('no_tlp');
        
        if ($action=='finish'){
            $st=3;
             $data = array(
                'status'  => $st,
                'tanggal_masuk'=>date('Y-m-d H:i:s'),
                'updateby'=> session()->nip_emp
            );
        }else if ($action=='accept'){
            $st=1;
             $data = array(
                'status'  => $st,
                'loan_asset_aproval_date'=>date('Y-m-d H:i:s'),
                 'updateby'=> session()->nip_emp
                );
        }else{
            $st=2;
            $data = array(
                'status'  => $st,
                'loan_asset_aproval_date'=>date('Y-m-d H:i:s'),
                 'updateby'=> session()->nip_emp
             );
        }

       
         $this->LM->upStatusLoan($data,$id);
        if ($action!='finish'){
         //$this->sendEmailRequest('',  $email, $action );
         if(!$this->SendWaReq('',$wa, $action)){
                 $this->sendEmailRequest('',  $email, $action );
            }
        }

        echo json_encode(array('status' => 'ok;', 'text' => ''));
    }

    public function history()
    {
        if (session()->nip_emp==null && session()->studentid==null  ){
            return false;
        }

     return view('main/loan/history_new');
    }

    public function dataJsonhistory()
    {
         if (session()->nip_emp==null ){
                return false;
            }
            $lists = $this->HAM->get_datatables();
            //print_r($lists);
            $data = [];
            //$no = $this->request->getPost("start");

            foreach ($lists as $val) {
               // $no++;
                $row = [];
          
                $row[]=' <span class="tb-amount">'.$val['id_loan'].' </span>';
                $row[]=' <span class="tb-amount">'.$val['activity'].' </span>';
                $row[]=' <span class="tb-amount">'.$val['asset_name'].' </span>';
                $row[]=' <div class="currency cut-text">'.$val['name_emp'].' </div>';
                $row[]=' <div class="currency cut-text">'.$val['nip_emp'].' </div>';
                $row[]='<div class="currency cut-text">'.str_replace('PROGRAM STUDI','',str_replace('BAGIAN','',str_replace(' KAMPUS JAKARTA', '', $val['unit_emp'] ))).'</div>';
                $row[]=' <div class="currency cut-text">'.date('d/m/Y',strtotime($val['tanggal_pinjam'])).' </div>';
                $row[]=' <div class="currency cut-text">'.date('d/m/Y',strtotime($val['tanggal_masuk'])).' </div>';


             
                    
                
                $data[] = $row;
            }
            $output = [
                "draw" => $this->request->getPost('draw'),
                "recordsTotal" => $this->HAM->count_all(),
                "recordsFiltered" => $this->HAM->count_filtered(),
                "data" => $data
            ];
            echo json_encode($output);
    }

    public function dataJsonhistoryClassroom()
    {
         if (session()->nip_emp==null ){
                return false;
            }
            $showTab= $this->request->getPost('showTab');
            $lists = $this->HAM->get_datatables_class($showTab);
            //print_r($lists);
            $data = [];
            //$no = $this->request->getPost("start");

            foreach ($lists as $val) {
               // $no++;
                $row = [];
          
                $row[]=' <span class="tb-amount">'.$val['id_class_loan'].' </span>';
                if (  $showTab=='classroomNonAcad'){
                  $row[]=' <span class="tb-amount">'.$val['activity_class'].' </span>';
                }else{
                    $row[]=' <span class="tb-amount">'.$val['replacement_reason'].' </span>';
                }
                $row[]=' <span class="tb-amount">'.$val['ROOMNAME'].' </span>';
                $row[]=' <div class="currency cut-text">'.$val['BUILDINGNAME'].' </div>';
             
                $row[]=' <span class="tb-amount">'.date('d/m/Y',strtotime($val['loan_class_date'])).' </span>';
                $row[]=' <span class="tb-amount">'.date('H:i',strtotime($val['starttime'])).' </span>';
                $row[]=' <span class="tb-amount">'.date('H:i',strtotime($val['endtime'])).' </span>';
                if ($val['fullname']!=null){
                 $pic=$val['fullname'];
                }else{
                 $pic=$val['name_emp'];
                }
                $row[]=' <span class="tb-amount">'.$pic.' </span>';
 
                $row[]=' <span class="tb-amount">'.$val['request_type'].' </span>';
                if ($showTab=='classroomNonAcad'){
                    $assocname=$val['assoc_name']==null?' - ':$val['assoc_name'];
                    $row[]=' <span class="tb-amount">'.$assocname.' </span>';
                }else{
                    $row[]=' <span class="tb-amount">'.date('d/m/Y H:i',strtotime($val['actual_lecture_date'])).' </span>';
                    $row[]=' <span class="tb-amount">'.$val['subject_name'].' </span>';
                    $row[]=' <span class="tb-amount">'.$val['class_name'].' </span>';
                    $row[]=' <span class="tb-amount">'.$val['studyprogram_loan'].' </span>';
                 
                }
                $data[] = $row;
            }
            $output = [
                "draw" => $this->request->getPost('draw'),
                "recordsTotal" => $this->HAM->count_all_class($showTab),
                "recordsFiltered" => $this->HAM->count_filtered_class($showTab),
                "data" => $data
            ];
            // print_r($data);
            echo json_encode($output);
    }


     protected function sendEmailRequest($namapeminjam,$email,$act)
    {

        $this->email->setFrom('dtitelujkt@gmail.com', 'Siak');
        $this->email->setTo($email);
          if ($act=='addloan'){
                $subject= 'Incoming Loan Request';
            }else if($act=='accept'){
                $subject= 'Status Loan Request';
            }else{
                $subject= 'Status Loan Request';
            }
        $this->email->setSubject($subject);

        $filename = 'images/logo_silo.png';
        $this->email->attach($filename);

        $data=array(
             'cid' =>  $this->email->setAttachmentCID($filename),
             'name_loaner'=>$namapeminjam,
            );

         //print_r($data);
        if ($act=='addloan'){
             $this->email->setMessage(view('main/mail/request_mail', $data));
         }else if($act=='accept'){
             $this->email->setMessage(view('main/mail/accepted_email', $data));
         }else{
             $this->email->setMessage(view('main/mail/rejected_email', $data));
         }

        if (!$this->email->send()) {
            // echo "gagal";
            return false;
        } else {
           // echo "berhasil";
            return true;
        }
    }

    protected function SendWaReq($nama, $num,$act, $activity='', $tgl='')
    {

        if ($act=='addloan'){
         $data=array(
            "api_key" => "S5lpTgiaUFhigWCLyUYNfcZwyGfZb0",
             "sender" => "6281319800200",
             "number" => $num,
             "message" => 
"[SIAK] You Receive a Loan Request

There is request from *".$nama."* for activity *".$activity."*, 
Please check on your Siak account to accept/reject request or you can visit url bellow

https://siak-jkt.telkomuniversity.ac.id/AdminSignin (For admin account) 
Or
https://siak-jkt.telkomuniversity.ac.id/Signin (for SSO Account)

Notifikasi Siak" ); 
         }else if($act=='accept'){
              $data=array(
            "api_key" => "S5lpTgiaUFhigWCLyUYNfcZwyGfZb0",
             "sender" => "6281319800200",
             "number" => convert_num($num),
             "message" => 
"[SIAK] Loan Request has been Accepted

There is Loan request has been accepted, Please check on your Siak account or you can visit url bellow.

siak-jkt.telkomuniversity.ac.id

Notifikasi Siak" ); 
         }else if($act=='driverNotif'){
            $data=array(
            "api_key" => "S5lpTgiaUFhigWCLyUYNfcZwyGfZb0",
             "sender" => "6281319800200",
             "number" => convert_num($num),
             "message" => 
"[SIAK] Ada Tugas Mengantar

Anda mendapat Tugas Mengantar dari *".$nama."* untuk kegiatan *".$activity."* pada tanggal *".$tgl."*, Mohon untuk menghubungi pegawai terkait untuk info detail.

Notifikasi Siak" ); 
         }else{
              $data=array(
            "api_key" => "S5lpTgiaUFhigWCLyUYNfcZwyGfZb0",
             "sender" => "6281319800200",
             "number" => convert_num($num),
             "message" => 
"[SIAK] Loan Request has been Rejected

There is Loan request has been Rejected, Please check on your Siak account or you can visit url bellow.

siak-jkt.telkomuniversity.ac.id

Notifikasi Siak" ); 
         }
    
            
       
        return NotifReqWa($data);
    }

       public function getPgw()
    {
        $s = $this->request->getPost('searchTerm');
        $dbs = $this->LM->getNip($s);

        $result = array();
        foreach ($dbs as $db)
            $result[] = array(
                'id' => $db->nip_emp,
                'text' => $db->name_emp.'( '.$db->nip_emp.')'
            );

        echo json_encode($result);
    }

     public function getPgwId()
    {
        $s = $this->request->getPost('searchTerm');
        $dbs = $this->LM->getNipForAdduser($s);

        $result = array();
        foreach ($dbs as $db)
            $result[] = array(
                'id' => $db->id,
                'text' => $db->name_emp.'( '.$db->nip_emp.')'
            );

        echo json_encode($result);
    }

    public function waTesting(){
        $data=array(
            "api_key" => "S5lpTgiaUFhigWCLyUYNfcZwyGfZb0",
             "sender" => "6281319800200",
             "number" => convert_num('0811190944'),
             "message" => 
"[SIAK] Whatsapp Testing

" );
        return NotifReqWa($data);
    }

}

?>