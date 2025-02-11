<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use \App\Models\MyassetModel;
use App\Models\MyLoanModel;

class MyLoan extends BaseController
{
    public function __construct()
    {
        // session_start();
        $this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->req = \Config\Services::request();
        $this->email = \Config\Services::email();
        $this->MAM = new MyassetModel($this->req);
        $this->LM = new MyLoanModel($this->req);

   
    }

    public function index()
    {
            if (session()->type!='pegawai' && session()->type !='admin akademik'){
                return redirect()->to(base_url('Siak'));
            }
         
         return view('main/loan/myloan');
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

                $row[]=' <span class="tb-amount">'.$val['id_loan'].' </span>';
             
                $row[]=' <span class="currency">'.$val['activity'].' </span>';



                $ur_img= base_url('').'/assets/images/item/'.$val['asset_image'];
                  

                $row[]='<div class="user-card">
                            <div class="user-avatar bg-dim-primary d-none d-sm-flex">
                              <img class="user-avatar" src="'.$ur_img.'" alt="" srcset="" class="profile-img" style="object-fit: cover;">
                            </div>
                            <div class="user-info">
                                <span class="tb-lead">'.$val['asset_name'].'<span class="dot dot-success d-md-none ms-1"></span></span>
                                                                 
                            </div>
                        </div>';
                $row[]='<span class="currency">'.$val['amount_loan'].'</span>';
                $row[]=' <span class="tb-amount">'.date('d/m/Y - H:i',strtotime($val['tanggal_pinjam'])).' </span>';
                $row[]=' <span class="tb-amount">'.date('d/m/Y - H:i',strtotime($val['tanggal_kembali'])).' </span>';

                (!isset($val['tanggal_masuk']))?$date_in = '-':$date_in=date('d/m/Y - H:i',strtotime($val['tanggal_masuk']));

       

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
                    $btnacc='';
                    $btndis='';
                    if ($val['status']==1){
                       
                        if (date('Y-m-d H:i:s')>=$val['tanggal_pinjam']){

                           $btnacc='<a class="btn btn-sm btn-warning "  onclick="upStatusLoan(\''.$val['id_loan'].'\',\'finish\', \'\',\'\')">End Loan</a>';
                        }
                    }

                    if ($val['status']==3 || $val['status']==2 ){
                         $btndis='disabled';
                    }
                  

                $row[]=$btnacc.'
                        <a class="btn btn-danger '.$btndis.'" onclick="deletedata(\''.$val['id_loan'].'\')"><i class="fa-solid fa-trash"></i></a>';
                
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
}