<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\HistoryClassLoanModel;
use App\Models\MyClassLoanModel;
use App\Models\LoginModel;

class MyClassLoan extends BaseController
{
    public function __construct()
    {
        // session_start();
        $this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->req = \Config\Services::request();
        $this->email = \Config\Services::email();

        $this->CLM = new MyClassLoanModel($this->req);
        $this->HM = new HistoryClassLoanModel($this->req);
        $this->LgM = new LoginModel();

   
    }

    public function index()
    {
            if (session()->type!='student' &&  (!session()->lectur || session()->pembina) ){
                return redirect()->to(base_url('Siak'));
            }
        //   print_r(session()->get());
         return view('main/loan/myclasloan_new');
    }

    public function history()
    {
            if (session()->type!='student' ){
                return redirect()->to(base_url('Siak'));
            }
     
         
         return view('main/loan/classroomhistory');
    }

    public function dataJsonHistory()
    {
               if (session()->type!='student' ){
                return false;
            }
            
      $lists = $this->HM->get_datatables();
           //print_r($lists);
           $data = [];
           //$no = $this->request->getPost("start");

           foreach ($lists as $val) {
              // $no++;
               $row = [];

               $row[]=' <span class="tb-amount">'.$val['id_class_loan'].' </span>';
            
               $row[]=' <span class="currency">'.$val['activity_class'].' </span>';
                 
               $row[]='<span class="tb-lead">'.$val['ROOMNAME'].'<span class="dot dot-success d-md-none ms-1"></span></span>';
               $row[]='<span class="currency">'.$val['BUILDINGNAME'].'</span>';
               
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
               $assocname=$val['assoc_name']==null?' - ':$val['assoc_name'];
               $row[]=' <span class="tb-amount">'.$assocname.' </span>';

               
               $data[] = $row;
           }
           $output = [
               "draw" => $this->request->getPost('draw'),
               "recordsTotal" => $this->HM->count_all(),
               "recordsFiltered" => $this->HM->count_filtered(),
               "data" => $data
           ];
           echo json_encode($output);
    }

     public function dataJson()
    {
          if (session()->type!='student' &&  (!session()->lectur || session()->pembina) ){
            return false;
            }

            // $type = $this->request->getPost("type");
            $showTab= $this->request->getPost("showTab");
            $lists = $this->CLM->get_datatables('', $showTab );
            //print_r($lists);
            $data = [];
            //$no = $this->request->getPost("start");

            foreach ($lists as $val) {
               // $no++;
                $row = [];

                $btndis='';
                    if ($val['status_class_loan']!=0 ){
                         $btndis='disabled';
                    }
                
                 $sizeFileEvidence='';
                if(isset($val['evidence_end_loan'])){
                    $sizeFileEvidence=file_exists('assets/evidance_end_loan/'.$val['evidence_end_loan'])?filesize('assets/evidance_end_loan/'.$val['evidence_end_loan']):0;
                }
                $disBtnEnd=$val['status_class_loan']==1 ||$val['status_class_loan']==3 ?'':'disabled';
                $btnEnd='<button class="btn btn-xs btn-warning " onclick="EndLoan(\''.$val['id_class_loan'].'\',\''.$val['evidence_end_loan'].'\', \''.$sizeFileEvidence.'\')" data-title="End Loan" '. $disBtnEnd.'><i class="icon fa-solid fa-door-open"></i></button> ';

                $row[]='<div style="display:flex">'.$btnEnd.'<button class="btn btn-xs btn-danger mr-5 '.$btndis.'" onclick="deletedata(\''.$val['id_class_loan'].'\')"><i class="icon fa-solid fa-trash"></i></button> </div>';

                $row[]=' <span class="tb-amount">'.$val['id_class_loan'].' </span>';
             
                $row[]=' <span class="currency">'.$val['activity_class'].' </span>';
                  
                $row[]='<span class="tb-lead">'.$val['ROOMNAME'].'<span class="dot dot-success d-md-none ms-1"></span></span>';
                $row[]='<span class="currency">'.$val['BUILDINGNAME'].'</span>';
                $row[]=' <span class="tb-amount">'.date('d/m/Y',strtotime($val['loan_class_date'])).' </span>';
                $row[]=' <span class="tb-amount">'.date('H:i',strtotime($val['starttime'])).' </span>';
                $row[]=' <span class="tb-amount">'.date('H:i',strtotime($val['endtime'])).' </span>';

                $row[]=' <span class="tb-amount">'.$val['request_type'].' </span>';
                $assocname=$val['assoc_name']==null?' - ':$val['assoc_name'];
                if (!session()->lectur) {
                    $row[]=' <span class="tb-amount">'.$assocname.' </span>';

                    if($val['aproval_lecturer_a']==1){

                    $status=' <span class="tb-status text-success">Accepted</span>';
                    }else if($val['aproval_lecturer_a']==0){
                        $status=' <span class="tb-status text-warning">Pending</span>';
                    }else if($val['aproval_lecturer_a']==4){
                        $status=' <span class="tb-status "> - </span>';
                    }else{
                        $status=' <span class="tb-status text-danger">Rejected</span>';
                    }
                    $row[]=$status;

                    if($val['aproval_lecturer_b']==1){

                        $statusb=' <span class="tb-status text-success">Accepted</span>';
                    }else if($val['aproval_lecturer_b']==0){
                        $statusb=' <span class="tb-status text-warning">Pending</span>';
                    }else if($val['aproval_lecturer_b']==4){
                        $statusb=' <span class="tb-status"> - </span>';
                    }else
                    {
                        $statusb=' <span class="tb-status text-danger">Rejected</span>';
                    }

                    $row[]=$statusb;
                }

                  if($val['aproval_lak']==1){

                    $statuslaak=' <span class="tb-status text-success">Accepted</span>';
                  }else if($val['aproval_lak']==0){
                      $statuslaak=' <span class="tb-status text-warning">Pending</span>';
                  }else{
                       $statuslaak=' <span class="tb-status text-danger">Rejected</span>';
                  }
                  
                  $row[]=$statuslaak;

                  if($val['status_class_loan']==1){

                    $statusloan=' <span class="tb-status text-success">Accepted</span>';
                  }else if($val['status_class_loan']==0){
                      $statusloan=' <span class="tb-status text-warning">Pending</span>';
                  }else if($val['status_class_loan']==3){
                       $statusloan=' <span class="tb-status text-info">Checking</span>';
                  }else if($val['status_class_loan']==4){
                    $statusloan=' <span class="tb-status text-info">Finish</span>';
                  }else{
                       $statusloan=' <span class="tb-status text-danger">Rejected</span>';
                  }

                  $row[]=$statusloan;

                
                
                $data[] = $row;
            }
            $output = [
                "draw" => $this->request->getPost('draw'),
                "recordsTotal" => $this->CLM->count_all(),
                "recordsFiltered" => $this->CLM->count_filtered('', $showTab ),
                "data" => $data
            ];
            echo json_encode($output);
 
    }

    public function deleteClassLoan()
    {

        if (session()->type!='student' &&  (!session()->lectur || session()->pembina) ){
            return false;
            }
     
        $id = $this->request->getPost('id_loan');
        $this->CLM->deleteLoan($id);

        echo json_encode(array('status' => 'ok;', 'text' => ''));

    }

    public function reqEndLoan()
    {  

        
        if (session()->nip_emp==null){
            if(session()->numberid==null){
                return false;
            }
          }
     
       
        $id_class_loan = $this->request->getPost('id_class_loan');
        
        $image = $this->request->getFile('file_evidence');
        $oldimage = $this->request->getPost('file_evidence');
        $old_img=$this->request->getPost('oldevidence');
        $getDataClassLoan=$this->CLM->getClassLoanByid($id_class_loan);

         $callback=json_encode(array('status' => 'ok;', 'text' => ''));
         if (!isset($oldimage)) {
                   
                    $path ='assets/evidance_end_loan/';

                        if (!is_dir($path)) {
                            mkdir($path, 0777, true); //Create directory recursively
                        }
                    $nip_nim_loaner=isset(session()->numberid)?session()->numberid:session()->nip_emp;
                    $directoryPath = 'assets/evidance_end_loan/'.$nip_nim_loaner.'/';
                   if ($old_img!=''){
                    
                    $path_oldimg = 'assets/evidance_end_loan/'.$old_img;
     
                    unlink($path_oldimg);

                   }
                   

                 if ($image->isValid() && !$image->hasMoved()) {
             
                    $newName = 'Evidence_endloan_'.$nip_nim_loaner. '_'.$id_class_loan.'_'.date('YmdHis').'.' . $image->getExtension();

                    $image->move($directoryPath, $newName);
                     $data = array(
                        'evidence_end_loan' => $nip_nim_loaner.'/'.$newName,
                        'status_class_loan'=>session()->type=='admin akademik' && $this->request->getPost('nip_nim_loaner')==session()->nip_emp? 4 : 3,
                    );
                    // // Move the uploaded file to the desired location
                     //$image->move($directoryPath, $newName);
                    
                    $this->CLM->upStatusLoan($data, $id_class_loan);
                    $getOwner = $this->LgM->getOwner('admin akademik');
                    $i=1;
                    $waNum='';
                    foreach ($getOwner as $val) {
                        $mark=count($getOwner)==$i?'':'|';
                    $waNum=$waNum.convert_num($val['no_tlp']).$mark;
                    $i++;
                    }

                    $name_loaner= isset($getDataClassLoan['fullname'])?$getDataClassLoan['fullname']:$getDataClassLoan['name_emp'];
                    $this->SendWaReq($waNum,'sendReqEnd', $getDataClassLoan['activity_class'],  $name_loaner);
                    
                    }else{
                     $callback=json_encode(array('status' => 'error;','text' => 'File Dokomen tidak boleh kosong'));
                    } 
               
            }

        echo $callback;
    }

    protected function SendWaReq($num, $act, $activity='', $name='')
    {
        $testing='';
        if (base_url('')=='http://localhost:8080/'){
            $testing=" - WHATSAPP TESTING";
        }

        if($act=='sendReqEnd'){
            $data=array(
                "api_key" => "S5lpTgiaUFhigWCLyUYNfcZwyGfZb0",
                 "sender" => "6281319800200",
                 "number" => $num,
                 "message" => 
"[SIAK] Anda Memiliki Request End Loan ".$testing."
    
Terdapat Request untuk Mengakhiri Peminjaman Ruangan Oleh  *".$name."* untuk Kegiatan *".$activity."*, 
Silahkan masuk ke akun siak anda dengan link dibawah
    
siak-jkt.telkomuniversity.ac.id/Signin
    
Notifikasi Siak" ); 
         }
            
       
        return NotifReqWa($data);
    }

}