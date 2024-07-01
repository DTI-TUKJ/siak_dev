<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use \App\Models\MyassetModel;
use App\Models\MyClassLoanModel;
use App\Models\scheduleModel;
use App\Models\LoginModel;

//vendor php spreadsheet
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;


class ClassLoan extends BaseController
{
   protected $validation ;
   protected $session;
   protected $req;
   protected $email;
   protected $MAM ;
   protected $CLM;
    protected $LgM;
    protected $excel;
    protected $drawing;     
    public function __construct()
    {
        // session_start();
        $this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->req = \Config\Services::request();
        $this->email = \Config\Services::email();
        $this->excel = new Spreadsheet();
        $this->drawing = new Drawing();
        $this->MAM = new MyassetModel($this->req);
        $this->CLM = new MyClassLoanModel($this->req);
         $this->LgM = new LoginModel();
         $this->SM = new scheduleModel($this->req);

        //  helper('cookie');

        // set_cookie('my_cookie', 'nilai_cookie', 3600, '', '', false, true);
   
    }

    public function index()
    {
            if (!session()->pembina && session()->type!='admin akademik' && session()->type!='admin logistik'){
                
                return redirect()->to(base_url('Siak'));
            }

            $data=array(
                'schoolyear'=>$this->SM->getSchoolyear()
            );
    
         return view('main/loan/classloan_new', $data);
    }

     public function dataJson()
    {
         if (!session()->pembina && session()->type!='admin akademik' && session()->type!='admin logistik'){
                
            return false;
            }
    
           $type = $this->request->getPost("type");
           $showTab= $this->request->getPost("showTab");
           $lists = $this->CLM->get_datatables($type, $showTab);
      
           $data = [];
           //$no = $this->request->getPost("start");

           foreach ($lists as $val) {
              // $no++;
               $row = [];

               $btndis='';
                    if ($val['status_class_loan']==3 || $val['status_class_loan']==2 ){
                            $btndis='disabled';
                    }
                 
                    
                    $url='';
                    $sizeFileEvidence='';
                    $btnDisEndloan=$val['status_class_loan']==1?'':'disabled';
                    if($val['evidence_end_loan']!=null){
                        $url=base_url('assets/evidance_end_loan/'.$val['evidence_end_loan']);
                        $sizeFileEvidence=file_exists('assets/evidance_end_loan/'.$val['evidence_end_loan'])?filesize('assets/evidance_end_loan/'.$val['evidence_end_loan']):0;
                        $btnDisEndloan=$val['status_class_loan']==4?'disabled':'';
                    }
                    
                    $btnEndloan='';
                    if (session()->type=='admin akademik'|| session()->nip_emp==$val['nim_loaner']){
                        
                        $employeLoaner=isset($val['name_emp'])?true:false;

                        $onclick='endLoanForm(\''.$val['id_class_loan'].'\',\''.$url.'\', '.$employeLoaner.')';

                        $btnEndloan='<button type="button" class="btn btn-xs btn-warning mr-5"   onclick="'.$onclick.'" data-title="End Loan" '.$btnDisEndloan.'><i class="icon fa-solid fa-door-closed" ></i></button>';
                    }

                    $btnacc=$btnEndloan.'<button class="btn btn-xs  btn-danger mr-5 '.$btndis.'" onclick="deletedata(\''.$val['id_class_loan'].'\')"><i class="icon fa-solid fa-trash"></i></button>';

                    if (session()->nip_emp!=$val['nim_loaner']) {

                        $btnDisAcc='';
                        $tittleAcc='Accept Button';
                        $tittleDis='Reject Button';
                        switch (session()->nip_emp) {
                            case $val['assoc_lecturer_id']:
                                if ($val['aproval_lecturer_a']>=1){
                                    $btnDisAcc='disabled';
                                    
                                }
                                $aprovalFrom='aproval_lecturer_a';
                                break;
                            case $val['assoc_lecturer_id_b']:
                                if ($val['aproval_lecturer_a']==0 || $val['aproval_lecturer_b']>=1){
                                    $btnDisAcc='disabled';
                                    $tittleAcc=$val['aproval_lecturer_b']>=1?'Accept Button':'Pembina 1 belum melakukan aproval';
                                    $tittleDis=$val['aproval_lecturer_b']>=1?'Reject Button':'Pembina 1 belum melakukan aproval';
                                }
                                $aprovalFrom='aproval_lecturer_b';
                                break;
                            default:
                                if ($val['aproval_lecturer_b']==0 || $val['aproval_lak']>=1 || $val['aproval_lecturer_a']==0 ){
                                    $btnDisAcc='disabled';
                                    $tittleAcc=$val['aproval_lak']>=1?'Accept Button':'salah satu pembina belum melakukan aproval';
                                    $tittleDis=$val['aproval_lak']>=1?'Reject Button':'salah satu pembina melakukan aproval';
                                    
                                }
                                $aprovalFrom='adminlaak';
                        }
                       
                        $btnacc=$btnEndloan.' 
                        <button class="btn btn-xs btn-success mr-5"  onclick="upStatusClassLoan(\''.$aprovalFrom.'\',\'accept\', \''.$val['id_class_loan'].'\',\''.$val['request_type'].'\')" data-title="'.$tittleAcc.'" '.$btnDisAcc.'><i class="icon fa-solid fa-check" ></i></button>
                        <button type="button" class="btn btn-xs btn-danger mr-5"   onclick="upStatusClassLoan(\''.$aprovalFrom.'\', \'reject\', \''.$val['id_class_loan'].'\',\''.$val['request_type'].'\')" data-title="'.$tittleDis.'" '.$btnDisAcc.'><i class="icon fa-solid fa-xmark"></i></button>
                       ';
                    }

                    $row[]=session()->type=='admin logistik'? '-' : '<div style="display:flex">'. $btnacc.'</div>';
            //    '';

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

               if($val['aproval_lecturer_a']==1 ){

                 $status=' <span class="tb-status text-success">Accepted</span>';
               }else if($val['aproval_lecturer_a']==0){
                   $status=' <span class="tb-status text-warning">Pending</span>';
               }else if($val['aproval_lecturer_a']==4){
                   $status=' <span class="tb-status "> - </span>';
               }else{
                    $status=' <span class="tb-status text-danger">Rejected</span>';
               }
               $row[]=$status;

               if($val['aproval_lecturer_b']==1 ){

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
               "recordsFiltered" => $this->CLM->count_filtered($type, $showTab),
               "data" => $data
           ];
           echo json_encode($output);
 
    }
    
    public function dataJsonAcadmic()
    {
         if (!session()->pembina && session()->type!='admin akademik' && session()->type!='admin logistik'){
               if (!session()->lectur){
                return false;
               } 
            
            }
    
           $type = $this->request->getPost("type");
           $showTab= $this->request->getPost("showTab");
           
           $lists = $this->CLM->get_datatables($type, $showTab);

           //print_r($lists);
           $data = [];
           //$no = $this->request->getPost("start");

           foreach ($lists as $val) {
              // $no++;
               $row = [];

               $btndis='';
                    if ($val['status_class_loan']!=0 && session()->type='admin akademik' ){
                          
                            $btndis='disabled';
                    }
                 
                    
                    $url='';
                    $sizeFileEvidence='';
                    $btnDisEndloan=$val['status_class_loan']==1?'':'disabled';
                    if($val['evidence_end_loan']!=null){
                        $url=base_url('assets/evidance_end_loan/'.$val['evidence_end_loan']);
                        $sizeFileEvidence= file_exists('assets/evidance_end_loan/'.$val['evidence_end_loan'])?filesize('assets/evidance_end_loan/'.$val['evidence_end_loan']):0;
                        $btnDisEndloan=$val['status_class_loan']==4?'disabled':'';
                    }
                    
                    $btnEndloan='';
                    if (session()->type=='admin akademik'||session()->nip_emp==$val['nim_loaner']){
                        

                        $employeLoaner=isset($val['name_emp'])?true:false;

                        $onclick='endLoanForm(\''.$val['id_class_loan'].'\',\''.$url.'\', '.$employeLoaner.')';

                        $btnEndloan='<button type="button" class="btn btn-xs btn-warning mr-5"   onclick="'.$onclick.'" data-title="End Loan" '.$btnDisEndloan.'><i class="icon fa-solid fa-door-closed" ></i></button>';
                    }

                    $btnacc=$btnEndloan.'<button class="btn btn-xs  btn-danger mr-5 " onclick="deletedata(\''.$val['id_class_loan'].'\')" '.$btndis.'><i class="icon fa-solid fa-trash"></i></button>';

                    if (session()->nip_emp!=$val['nim_loaner']){

                        $btnDisAcc='';
                        $tittleAcc='Accept Button';
                        $tittleDis='Reject Button';
                        switch (session()->nip_emp) {
                            case $val['assoc_lecturer_id']:
                                if ($val['aproval_lecturer_a']>=1){
                                    $btnDisAcc='disabled';
                                    
                                }
                                $aprovalFrom='aproval_lecturer_a';
                                break;
                            case $val['assoc_lecturer_id_b']:
                                if ($val['aproval_lecturer_a']==0 || $val['aproval_lecturer_b']>=1){
                                    $btnDisAcc='disabled';
                                    $tittleAcc=$val['aproval_lecturer_b']>=1?'Accept Button':'Pembina 1 belum melakukan aproval';
                                    $tittleDis=$val['aproval_lecturer_b']>=1?'Reject Button':'Pembina 1 belum melakukan aproval';
                                }
                                $aprovalFrom='aproval_lecturer_b';
                                break;
                            default:
                                if ($val['aproval_lecturer_b']==0 || $val['aproval_lak']>=1 || $val['aproval_lecturer_a']==0 ){
                                    $btnDisAcc='disabled';
                                    $tittleAcc=$val['aproval_lak']>=1?'Accept Button':'salah satu pembina belum melakukan aproval';
                                    $tittleDis=$val['aproval_lak']>=1?'Reject Button':'salah satu pembina melakukan aproval';
                                    
                                }
                                $aprovalFrom='adminlaak';
                        }
                       
                        $btnacc=$btnEndloan.' 
                        <button class="btn btn-xs btn-success mr-5"  onclick="upStatusClassLoan(\''.$aprovalFrom.'\',\'accept\', \''.$val['id_class_loan'].'\',\''.$val['request_type'].'\')" data-title="'.$tittleAcc.'" '.$btnDisAcc.'><i class="icon fa-solid fa-check" ></i></button>
                        <button  class="btn btn-xs btn-danger mr-5"   onclick="upStatusClassLoan(\''.$aprovalFrom.'\', \'reject\', \''.$val['id_class_loan'].'\',\''.$val['request_type'].'\')" data-title="'.$tittleDis.'" '.$btnDisAcc.'><i class="icon fa-solid fa-xmark"></i></button>
                       ';
                    }

               $row[]=session()->type=='admin logistik'? '-' : '<div style="display:flex">'. $btnacc.'</div>';
            //    '';

               $row[]=' <span class="tb-amount">'.$val['id_class_loan'].' </span>';
                 
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
            
               $row[]=' <span class="tb-amount">'.date('d/m/Y H:i',strtotime($val['actual_lecture_date'])).' </span>';
               $row[]=' <span class="tb-amount">'.$val['subject_name'].' </span>';
               $row[]=' <span class="tb-amount">'.$val['class_name'].' </span>';
               $row[]=' <span class="tb-amount">'.$val['studyprogram_loan'].' </span>';
               $row[]=' <span class="tb-amount">'.$val['replacement_reason'].' </span>';

                 if($val['aproval_lak']==1){

                   $statuslaak=' <span class="tb-status text-success">Accepted</span>';
                 }else if($val['aproval_lak']==0){
                     $statuslaak=' <span class="tb-status text-warning">Pending</span>';
                 }else{
                      $statuslaak=' <span class="tb-status text-danger">Rejected</span>';
                 }
                 
                 $row[]=$statuslaak;
                 $row[]=' <span class="tb-amount">'.date('d/m/Y H:i',strtotime($val['aproval_date_lak'])).' </span>';

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
               "recordsFiltered" => $this->CLM->count_filtered($type, $showTab),
               "data" => $data
           ];
           echo json_encode($output);
 
    }

    public function updateStatusClassLoan()
    {

       if (!session()->pembina && session()->type!='admin akademik'){
                return false;
            }
       
        $id = $this->request->getPost('id_loan');
        $action= $this->request->getPost('action');
        $aprovalFrom  = $this->request->getPost('aprovalFrom');
        $reqType  = $this->request->getPost('reqType');
        $getDataClassLoan=$this->CLM->getClassLoanByid($id);
        // print_r($getDataClassLoan);
        // die();
        $data=[];
        $st=$action=='accept'?1:2;
        if (session()->type=='admin akademik'){
            $data['aproval_lak']=$st;
            $data['aproval_date_lak']= date('Y-m-d H:i:s');
            if ($getDataClassLoan['pembina_b']==null){
                $data['status_class_loan']= $st;
            }
            
         }
       
        switch ($aprovalFrom) {
            case 'aproval_lecturer_a':
                $data['aproval_lecturer_a']= $st;
                $data['aproval_date_lecture_a']= date('Y-m-d H:i:s');
                if ($st==2){

                    $data['aproval_lecturer_b']=$getDataClassLoan['aproval_lecturer_b']==4?4: $st;
                    $data['aproval_lak']= $st;
                    $data['status_class_loan']= $st;
                }
                
                break;
            case 'aproval_lecturer_b':
                $data['aproval_lecturer_b']= $st;
                $data['aproval_date_lecture_b']= date('Y-m-d H:i:s');
                if ($st==2){

                    $data['aproval_lak']= $st;
                    $data['status_class_loan']= $st;
                }
                    if ($getDataClassLoan['aproval_lecturer_a']==1 && $getDataClassLoan['aproval_lak']==1 ){
                        $data['status_class_loan']=$st;
                        $data['aproval_lecturer_a']=$st;
                    }
                break;
            default:
                $data['aproval_lak']=$st;
                $data['aproval_date_lak']= date('Y-m-d H:i:s');
                $data['status_class_loan']= $st;
                
        }

       
        $this->CLM->upStatusLoan($data,$id);
        // print_r($getDataClassLoan);
        
        $Telephone=$getDataClassLoan['phone']!=''||$getDataClassLoan['phone']!=null?$getDataClassLoan['phone']:$getDataClassLoan['no_tlp'];
        // echo $Telephone;
        if ($st==2){
            if ($Telephone!='' || $Telephone!=null){
                $this->SendWaReq($getDataClassLoan, $st, $Telephone,'sendAproval' );
            }
        }else{
            $name_loaner= isset($getDataClassLoan['fullname'])?$getDataClassLoan['fullname']:$getDataClassLoan['name_emp'];
            $getOwner = $this->LgM->getOwner('admin akademik');
            $getOwnerLogistik = $this->LgM->getOwner('admin logistik');
            $i=1;
            $waNum='';
            $waNumLog='';
            foreach ($getOwner as $val) {
                $mark=count($getOwner)==$i?'':'|';
               $waNum=$waNum.convert_num($val['no_tlp']).$mark;
               $i++;
            }

            foreach ($getOwnerLogistik as $val1) {
                $mark1=count($getOwner)==$i?'':'|';
               $waNumLog=$waNumLog.convert_num($val1['no_tlp']).$mark1;
               $i++;
            }
            
            if($aprovalFrom=='aproval_lecturer_a'){ 
                if($getDataClassLoan['no_tlp_pembina_b']!='' || $getDataClassLoan['no_tlp_pembina_b']!=null){
                    $this->SendWaReq($getDataClassLoan,$st, $getDataClassLoan['no_tlp_pembina_b'],'sendAccept', $getDataClassLoan['activity_class'], $name_loaner  );
                }else{
                    if (session()->type!='admin akademik'){
                        $this->SendWaReq($getDataClassLoan, $st,$waNum,'sendAccept', $getDataClassLoan['activity_class'], $name_loaner, $aprovalFrom ); 
                    }

                    if (isset($data['status_class_loan'])){
                        if ($data['status_class_loan']==1){
                            $this->SendWaReq($getDataClassLoan, $st, $Telephone,'sendAproval' );
                            $this->SendWaReq($getDataClassLoan, $st, $waNumLog,'sendAprovalToAdminLogistik' );
                        }
                    }
                }
            }
         
            if($aprovalFrom=='aproval_lecturer_b'){
                // echo $waNum; 
                if (session()->type!='admin akademik'){
                $this->SendWaReq($getDataClassLoan, $st,$waNum,'sendAccept', $getDataClassLoan['activity_class'], $name_loaner, $aprovalFrom );
                }

                if (isset($data['status_class_loan'])){
                    if ($data['status_class_loan']==1){
                        $this->SendWaReq($getDataClassLoan, $st, $Telephone,'sendAproval' );
                        $this->SendWaReq($getDataClassLoan, $st, $waNumLog,'sendAprovalToAdminLogistik' );
                    }
                }
            }

            if($aprovalFrom=='adminlaak'){
                // echo $waNum; 
                $this->SendWaReq($getDataClassLoan, $st, $Telephone,'sendAproval' );
                $this->SendWaReq($getDataClassLoan, $st, $waNumLog,'sendAprovalToAdminLogistik' );
            }
        }

        echo json_encode(array('status' => 'ok;', 'text' => ''));
    }

    public function EndCLassLoan()
    {

       
        if (!session()->pembina && session()->type!='admin akademik'){
            return false;
        }
     
        $id = $this->request->getPost('id_class_loan');
        $data=array(
            'status_class_loan'=>4,
            'date_end_loan'=>date('Y-m-d H:i:s')
        );
        $this->CLM->upStatusLoan($data,$id);

        echo json_encode(array('status' => 'ok;', 'text' => ''));

    }

    public function sendNotesLoan(){
        if (!session()->pembina && session()->type!='admin akademik'){
            return false;
        }


            $this->validation->setRules([
              
                      'Notes' =>[
                        'rules'=>'required',
                        // rules greater_than_equal_to sudah dirubah defaultnya
                        'errors'=>[
                               'required'=>'Notes loan Belum diisi',
                              
                        ],
                        
                    ]

                ]);
      
        $isDataValid = $this->validation->withRequest($this->request)->run();
         

        if ($isDataValid) {
            $id_class_loan = $this->request->getPost('id_class_loan');
            $getDataClassLoan=$this->CLM->getClassLoanByid($id_class_loan);
            $waNum=$getDataClassLoan['phone']!=''||$getDataClassLoan['phone']!=null?$getDataClassLoan['phone']:$getDataClassLoan['no_tlp'];
            // print_r( $getDataClassLoan);
            $this->SendWaReq($getDataClassLoan, '', $waNum,'SendNotes','','','', $this->request->getPost('Notes'));
            echo json_encode(array('status' => 'ok;', 'text' => ''));
        } else {
           $validation = $this->validation;
            $error=$validation->getErrors();
           
            $dataname=$_POST;
                  //print_r($error);
            echo json_encode(array('status' => 'error;', 'text' => '', 'data'=>$error,'dataname'=>$dataname));
        }
    }


    public function exportExcel(){
         $this->validation->setRules([
                    'schoolyear' =>
                    [
                        'label'  => 'Tahun ajar',
                        'rules'  => 'required',
                        'errors' => [
                            'required' => ' {field} mohon diisi',
                        ],
                    ],
                
                    'semester' =>
                    [
                        'label'  => 'Semester',
                        'rules'  => 'required',
                        'errors' => [
                            'required' => ' {field} mohon diisi',
                        ],
                    ],
                ]);
            $isDataValid = $this->validation->withRequest($this->request)->run();
            

            if ($isDataValid) {
        
                $sheet = $this->excel->getActiveSheet();
        
                // $dataatasan=$this->PM->getMangerForAbsensi(session()->id_pegawai,$this->request->getPost('date'));
        
                // print_r($dataatasan);
                // die();
                $sheet->setTitle('Non-Academic Classroom Loan');
                $this->excel->createSheet();
                $sheet2 = $this->excel->setActiveSheetIndex(1);
                $sheet2->setTitle('Academic Classroom Loan');
                $sheet->getPageMargins()->setTop(0)->setLeft(0)->setRight(0)->setBottom(0);
                $sheet->getPageSetup()->setPaperSize(PageSetup::PAPERSIZE_A4);
               // $sheet->getStyle('C12:D42')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_TEXT);
               // $sheet->getCell('C14:D44')->getStyle()->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_TEXT);
                
                $sheet->setShowGridlines(false);
                $sheet->getPageSetup()->setScale(85);
               
                 $sheet->getColumnDimension('B')->setWidth(40);
                 $sheet->getColumnDimension('C')->setWidth(15);
                 $sheet->getColumnDimension('D')->setWidth(17);
                 $sheet->getColumnDimension('E')->setWidth(17);
                 $sheet->getColumnDimension('F')->setWidth(17);
                 $sheet->getColumnDimension('G')->setWidth(40);
                 $sheet->getColumnDimension('H')->setWidth(17);
                 $sheet->getColumnDimension('I')->setWidth(50);
                 $sheet->getColumnDimension('J')->setWidth(30);
                 $sheet->getColumnDimension('K')->setWidth(30);
                 $sheet->getColumnDimension('L')->setWidth(30);
                 $sheet->getColumnDimension('M')->setWidth(17);
                 $sheet->getColumnDimension('N')->setWidth(17);
                 $sheet->getColumnDimension('O')->setWidth(17);

                
                 $headerImage = 'images/bg/ish-logo.png';
                
        
                $sheet->mergeCells('A2:O2')->getStyle('A2:O2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->setCellValue('A2', 'DATA PEMINJAMAN RUANG KELAS UNTUK KEGIATAN NON AKADEMIK');
                $sheet->mergeCells('A3:O3')->getStyle('A3:O3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $period=$this->request->getPost('period')!=''?explode(" to ", $this->request->getPost('period')):"-";
                if ($period=="-"){
                    $subhead='';
                }else{
                    $subhead=', Periode '.date('d/m/Y', strtotime($period[0])).' - '.date('d/m/Y', strtotime($period[1]));
                }

               
                $sheet->setCellValue('A3', 'TAHUN AJAR '.format_schoolyear($this->request->getPost('schoolyear')).' SEMESTER '.$this->request->getPost('semester').$subhead);
               
                  $sheet->getStyle('A5:O5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)
                  ->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);
                  $sheet->setCellValue('A5', 'NO');
                  $sheet->setCellValue('B5', 'KEGIATAN');
                  $sheet->setCellValue('C5', 'NAMA RUANGAN');
                  $sheet->setCellValue('D5', 'LOKASI');
                  $sheet->setCellValue('E5', 'TANGGAL PEMINJAMAN');
                  $sheet->setCellValue('F5', 'WAKTU PEMINJAMAN');
                  $sheet->setCellValue('G5', 'PIC');
                  $sheet->setCellValue('H5', 'JENIS PEMINJAMAN');
                  $sheet->setCellValue('I5', 'NAMA ORGANISASI');
                  $sheet->setCellValue('J5', 'PEMBINA 1');
                  $sheet->setCellValue('K5', 'PEMBINA 2');
                  $sheet->setCellValue('L5', 'KETUA HIMPUNAN');
                  $sheet->setCellValue('M5', 'TANGGAL APROVAL P 1');
                  $sheet->setCellValue('N5', 'TANGGAL APROVAL P 2');
                  $sheet->setCellValue('O5', 'TANGGAL APROVAL ADMIN');
                  
                //   $period=$this->request->getPost('period')!=''?explode(" to ", $this->request->getPost('period')):"-";
                  $ClasroomLoanData=$this->CLM->getClassLoanBySchoolyearSemester($this->request->getPost('schoolyear'), $this->request->getPost('semester'),$period);
                  $c=6;
                  $i=1;
                  foreach ($ClasroomLoanData as $val) {
                    $sheet->setCellValue('A'.$c, $i);
                    $sheet->setCellValue('B'.$c, $val['activity_class']);
                    $sheet->setCellValue('C'.$c, $val['ROOMNAME']);
                    $sheet->setCellValue('D'.$c, $val['BUILDINGNAME']);
                    $sheet->setCellValue('E'.$c, date('d/m/Y',strtotime($val['loan_class_date'])));
                    $sheet->setCellValue('F'.$c, date('H:i',strtotime($val['starttime'])).' - '.date('H:i',strtotime($val['endtime'])));
                    $sheet->setCellValue('G'.$c, ifNull($val['fullname'], $val['name_emp']));
                    $sheet->setCellValue('H'.$c, $val['request_type']);
                    $sheet->setCellValue('I'.$c, ifNull($val['assoc_name']));
                    $sheet->setCellValue('J'.$c, ifNull($val['pembina_a']));
                    $sheet->setCellValue('K'.$c, ifNull($val['pembina_b']));
                    $sheet->setCellValue('L'.$c, ifNull($val['name_leader_assoc']));
                    $sheet->setCellValue('M'.$c, ifNullDate($val['aproval_date_lecture_a'], 'd/m/Y - H:i'));
                    $sheet->setCellValue('N'.$c, ifNullDate($val['aproval_date_lecture_b'], 'd/m/Y - H:i'));
                    $sheet->setCellValue('O'.$c, ifNullDate($val['aproval_date_lak'], 'd/m/Y - H:i'));
                    $c++;$i++;
                    

                  }
                

                  $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'], // Set the border color code here (e.g., black)
                        ],
                    ],
                ];
                if(count($ClasroomLoanData)==0){
                    $sheet->mergeCells('A6:O6')->getStyle('A6:O6')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    $sheet->setCellValue('A6', 'DATA PEMINJAMAN RUANG KELAS TIDAK TERSEDIA');
                    $sheet->getStyle('A2:O'.$c)->getFont()->setName('Times New Roman');
                    $sheet->getStyle('A5:O'.$c)->applyFromArray($styleArray);
                }else{
                     $sheet->getStyle('A2:O'.$c-1)->getFont()->setName('Times New Roman');
                    $sheet->getStyle('A5:O'.$c-1)->applyFromArray($styleArray);

                }
                $sheet->getStyle('A5:O5')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('808026'); 
                $sheet->getStyle('A5:O5')->getFont()->getColor()->setRGB('FFFFFF'); // Set the font color code here (e.g., white)
            
               

                //END OF SHEET 1

                $sheet2->getPageMargins()->setTop(0)->setLeft(0)->setRight(0)->setBottom(0);
                $sheet2->getPageSetup()->setPaperSize(PageSetup::PAPERSIZE_A4);
               // $sheet2->getStyle('C12:D42')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_TEXT);
        
               // $sheet2->getCell('C14:D44')->getStyle()->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_TEXT);
                
                $sheet2->setShowGridlines(false);
                $sheet2->getPageSetup()->setScale(85);
               
                 $sheet2->getColumnDimension('B')->setWidth(40);
                 $sheet2->getColumnDimension('C')->setWidth(17);
                 $sheet2->getColumnDimension('D')->setWidth(17);
                 $sheet2->getColumnDimension('E')->setWidth(17);
                 $sheet2->getColumnDimension('F')->setWidth(40);
                 $sheet2->getColumnDimension('G')->setWidth(17);
                 $sheet2->getColumnDimension('H')->setWidth(20);
                 $sheet2->getColumnDimension('I')->setWidth(15);
                 $sheet2->getColumnDimension('J')->setWidth(30); 
                 $sheet2->getColumnDimension('K')->setWidth(50);
                 $sheet2->getColumnDimension('L')->setWidth(17);

                 

                
                 $headerImage = 'images/bg/ish-logo.png';
                
        
                $sheet2->mergeCells('A2:O2')->getStyle('A2:O2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet2->setCellValue('A2', 'DATA PEMINJAMAN RUANG KELAS UNTUK KEGIATAN AKADEMIK ( KELAS PENGGANTI )');
                
                
                $sheet2->mergeCells('A3:O3')->getStyle('A3:O3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet2->setCellValue('A3', 'TAHUN AJAR '.format_schoolyear($this->request->getPost('schoolyear')).' SEMESTER '.$this->request->getPost('semester').$subhead);
               
                  $sheet2->getStyle('A5:O5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)
                  ->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);
                  $sheet2->setCellValue('A5', 'NO');
                  $sheet2->setCellValue('B5', 'NAMA RUANGAN');
                  $sheet2->setCellValue('C5', 'LOKASI');
                  $sheet2->setCellValue('D5', 'TANGGAL PEMINJAMAN');
                  $sheet2->setCellValue('E5', 'WAKTU PEMINJAMAN');
                  $sheet2->setCellValue('F5', 'PIC');
                  $sheet2->setCellValue('G5', 'JADWAL PERKULIAHAN SEBENARNYA');
                  $sheet2->setCellValue('H5', 'MATA KULIAH');
                  $sheet2->setCellValue('I5', 'NAMA KELAS');
                  $sheet2->setCellValue('J5', 'PROGRAM STUDI');
                  $sheet2->setCellValue('K5', 'ALASAN MENGGANTI KELAS');
                  $sheet2->setCellValue('L5', 'TANGGAL APROVAL ADMIN');

                  $ClasroomLoanData1=$this->CLM->getClassLoanBySchoolyearSemester($this->request->getPost('schoolyear'), $this->request->getPost('semester'),$period, 'kelas pengganti');
                  $c1=6;
                  $i1=1;
                  foreach ($ClasroomLoanData1 as $val1) {
                    $sheet2->setCellValue('A'.$c1, $i1);
                    $sheet2->setCellValue('B'.$c1, $val1['ROOMNAME']);
                    $sheet2->setCellValue('C'.$c1, $val1['BUILDINGNAME']);
                    $sheet2->setCellValue('D'.$c1, date('d/m/Y',strtotime($val1['loan_class_date'])));
                    $sheet2->setCellValue('E'.$c1, date('H:i',strtotime($val1['starttime'])).' - '.date('H:i',strtotime($val1['endtime'])));
                    $sheet2->setCellValue('F'.$c1, ifNull($val1['fullname'], $val1['name_emp']));
                    $sheet2->setCellValue('G'.$c1, date('d/m/Y H:i', strtotime($val1['actual_lecture_date'])));
                    $sheet2->setCellValue('H'.$c1, ifNull($val1['subject_name']));
                    $sheet2->setCellValue('I'.$c1, ifNull($val1['class_name']));
                    $sheet2->setCellValue('J'.$c1, ifNull($val1['studyprogram_loan']));
                    $sheet2->setCellValue('K'.$c1, ifNull($val1['replacement_reason']));
                    $sheet2->setCellValue('L'.$c1, ifNullDate($val1['aproval_date_lak'], 'd/m/Y - H:i'));
                    $c1++;$i1++;
                    

                  }
                  
                  $sheet2->getStyle('A5:L5')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('808026'); 
                  $sheet2->getStyle('A5:L5')->getFont()->getColor()->setRGB('FFFFFF'); // Set the font color code here (e.g., white)
                  if (count($ClasroomLoanData1)==0){
                    $sheet2->mergeCells('A6:O6')->getStyle('A6:O6')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    $sheet2->setCellValue('A6', 'DATA PEMINJAMAN RUANG KELAS TIDAK TERSEDIA');

                    $sheet2->getStyle('A2:L'.$c1)->getFont()->setName('Times New Roman');
                    $sheet2->getStyle('A5:L'.$c1)->applyFromArray($styleArray);
                  }else{
                    $sheet2->getStyle('A2:L'.$c1-1)->getFont()->setName('Times New Roman');
                    $sheet2->getStyle('A5:L'.$c1-1)->applyFromArray($styleArray);
                  }
                 

                  $this->excel->setActiveSheetIndex(0);
        
                $writer = IOFactory::createWriter($this->excel, 'Xlsx');
                $pathfile='assets/report_classroom/Classroom_loan_report_1.xlsx';
                $writer->save($pathfile);
        
             
               echo json_encode(array('status' => 'ok;', 'path' => $pathfile));
           }else{
                $validation = $this->validation;
                $error=$validation->getErrors();
            
                $dataname=$_POST;
                    
                echo json_encode(array('status' => 'error;', 'text' => '', 'data'=>$error,'dataname'=>$dataname));
           }
    
            
        
    }

    protected function SendWaReq($alldata, $statusLoan, $num, $act, $activity='', $name='', $aprovalFrom='',$notes='')
    {
        $testing='';
        if (base_url('')=='http://localhost:8080/'){
            $testing=" - WHATSAPP TESTING";
        }
        $stText=$statusLoan==1?'Diterima':'Ditolak';
        if ($act=='sendAproval'){
            $activity=$alldata['request_type']=='kelas pengganti'? 'kelas pengganti Matakuliah '.$alldata['subject_name']:$alldata['activity_class'];
            $reasonRep=null;
            if ($alldata['request_type']=='kelas pengganti'){
              $reasonRep="Alasan Mengganti Kelas : *".$alldata['replacement_reason']."*";
            }
         $data=array(
            "api_key" => "S5lpTgiaUFhigWCLyUYNfcZwyGfZb0",
             "sender" => "6281319800200",
             "number" => convert_num($num),
             "message" => 
"[SIAK] Permintaan peminjaman ruang kelas sudah  ".$stText.$testing."

Terdapat permintaan peminjaman yang sudah ".$stText.", berikut rincian data peminjamanya
 
Kegiatan               : *".$activity."*
Ruang Kelas            :  *".$alldata['ROOMNAME']."* 
Tanggal Pemakaian      : *".date('d/m/Y', strtotime($alldata['loan_class_date']))."*
Waktu Peminjaman       : *".date('H:i',strtotime($alldata['starttime']))." - ".date('H:i',strtotime($alldata['endtime']))."*
Organization           : *".$alldata['assoc_name']."*
".$reasonRep."
Silahkan masuk ke akun siak anda dengan link dibawah

dti-jkt.telkomuniversity.ac.id/Siak/StudentSignin

Notifikasi Siak" ); 
         }else if($act=='sendAccept'){
            $activity=$alldata['request_type']=='kelas pengganti'? 'kelas pengganti Matakuliah '.$alldata['subject_name']:$alldata['activity_class'];
            $reasonRep=null;
            if ($alldata['request_type']=='kelas pengganti'){
              $reasonRep="Alasan Mengganti Kelas : *".$alldata['replacement_reason']."*";
            };
            $nama=isset($alldata['fullname'])?$alldata['fullname']:$alldata['name_emp'];
            $data=array(
                "api_key" => "S5lpTgiaUFhigWCLyUYNfcZwyGfZb0",
                 "sender" => "6281319800200",
                 "number" =>  $aprovalFrom=='aproval_lecturer_a' && $alldata['pembina_b']!=null ? convert_num($num):$num,
                 "message" => 
"[SIAK] Anda Memiliki Request Peminjaman Ruangan yang membutuhkan Aproval ".$testing."

Terdapat Request Peminjaman Ruang kelas dengan rincian dibawah, 
PIC                    : *".$nama."* 
Kegiatan               : *".$activity."*
Ruang Kelas            :  *".$alldata['ROOMNAME']."* 
Tanggal Pemakaian      : *".date('d/m/Y', strtotime($alldata['loan_class_date']))."*
Waktu Peminjaman       : *".date('H:i',strtotime($alldata['starttime']))." - ".date('H:i',strtotime($alldata['endtime']))."*
Organization           : *".$alldata['assoc_name']."*
".$reasonRep."
Silahkan masuk ke akun siak anda dengan link dibawah
    
dti-jkt.telkomuniversity.ac.id/Siak/Signin
    
Notifikasi Siak" ); 
         }else if($act=='SendNotes'){
            $data=array(
                "api_key" => "S5lpTgiaUFhigWCLyUYNfcZwyGfZb0",
                 "sender" => "6281319800200",
                 "number" =>  $aprovalFrom=='aproval_lecturer_b'?$num:convert_num($num),
                 "message" => 
"[SIAK] Anda Memiliki Request end loan yang ditunda ".$testing."
    
Terdapat Request end loan yang ditunda dengan catatan : ".$notes." , 
Silahkan masuk ke akun siak anda dengan link dibawah
    
dti-jkt.telkomuniversity.ac.id/Siak/Signin
    
Notifikasi Siak" ); 
         }else if ($act=='sendAprovalToAdminLogistik'){
            $activity=$alldata['request_type']=='kelas pengganti'? 'kelas pengganti Matakuliah '.$alldata['subject_name']:$alldata['activity_class'];
            $reasonRep=null;
            if ($alldata['request_type']=='kelas pengganti'){
              $reasonRep="Alasan Mengganti Kelas : *".$alldata['replacement_reason']."*";
            }
         $data=array(
            "api_key" => "S5lpTgiaUFhigWCLyUYNfcZwyGfZb0",
             "sender" => "6281319800200",
             "number" => $num,
             "message" => 
"[SIAK] Permintaan peminjaman ruang kelas sudah  ".$stText.$testing."

Terdapat permintaan peminjaman yang sudah ".$stText.", berikut rincian data peminjamanya
 
Kegiatan               : *".$activity."*
Ruang Kelas            :  *".$alldata['ROOMNAME']."* 
Tanggal Pemakaian      : *".date('d/m/Y', strtotime($alldata['loan_class_date']))."*
Waktu Peminjaman       : *".date('H:i',strtotime($alldata['starttime']))." - ".date('H:i',strtotime($alldata['endtime']))."*
Organization           : *".$alldata['assoc_name']."*
".$reasonRep."
Silahkan masuk ke akun siak anda dengan link dibawah

dti-jkt.telkomuniversity.ac.id/Siak/StudentSignin

Notifikasi Siak" ); 
         }
            
       
        return NotifReqWa($data);
    }
}