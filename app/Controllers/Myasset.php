<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use \App\Models\MyassetModel;
use App\Models\LoginModel;
use App\Models\LoanModel;
class Myasset extends BaseController
{
    public function __construct()
    {
        // session_start();
        $this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->req = \Config\Services::request();
        $this->email = \Config\Services::email();
        $this->MAM = new MyassetModel($this->req);
        $this->LM = new LoginModel();
        $this->LNM = new LoanModel($this->req);
        //   helper('cookie');

        // set_cookie('my_cookie', 'nilai_cookie', 3600, '', '', false, true);
 
   
    }

    public function index()
    {
              if (session()->id==null || session()->type=='pegawai'|| session()->type=='admin akadmik'){
                return redirect()->to(base_url('Siak'));
            }
             $data=array(
                        "data_owner"=>$this->LM->findAll(),
                        );
         return view('main/ms_assets/index', $data);
    }

     public function dataJson()
    {
      
            // $periode = $this->request->getPost("periode");
            $lists = $this->MAM->get_datatables();
            //print_r($lists);
            $data = [];
            //$no = $this->request->getPost("start");

            foreach ($lists as $val) {
               // $no++;
                $row = [];
                $ur_img= base_url('').'/assets/images/item/'.$val['asset_image'];
                  

                $row[]='<div class="user-card">
                            <div class="user-avatar bg-dim-primary d-none d-sm-flex">
                              <img class="user-avatar" src="'.$ur_img.'" alt="" srcset="" class="profile-img" style="object-fit: cover;">
                            </div>
                            <div class="user-info">
                                <span class="tb-lead">'.$val['asset_name'].'<span class="dot dot-success d-md-none ms-1"></span></span>
                                                                 
                            </div>
                        </div>';
                        $row[]='<span class="currency">'.$val['description'].'</span>';
                $row[]='<span class="currency">'.$val['asset_type'].'</span>';
                if($val['asset_status']=='Ready'){

                  $status=' <span class="tb-status text-success">'.$val['asset_status'].'</span>';
                }else{
                    $status=' <span class="tb-status text-warning">'.$val['asset_status'].'</span>';
                }
                $row[]=$status;
                $row[]=' <span>'.$val['amount_asset'].'</span>';
                $row[]=' <span>'.$val['capacity'].'</span>';
                $row[]=' <span class="tb-amount">'.$val['id_owner'].' </span>';
                $row[]='<a class="btn btn-secondary" onclick="popupedit(\''.$val['id_asset'].'\')"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a class="btn btn-danger" onclick="deletedata(\''.$val['id_asset'].'\',\''.$val['asset_image'].'\')"><i class="fa-solid fa-trash"></i></a>';
                
                $data[] = $row;
            }
            $output = [
                "draw" => $this->request->getPost('draw'),
                "recordsTotal" => $this->MAM->count_all(),
                "recordsFiltered" => $this->MAM->count_filtered(),
                "data" => $data
            ];
            echo json_encode($output);
 
    }

    public function insertAsset()
    {    
    // detail =$this->request->getPost('manager');
        // print_r($detail);

    if (session()->id==null){
            return false;
        }

    
        $this->validation->setRules($this->MAM->rules());
        $isDataValid = $this->validation->withRequest($this->request)->run();
         $image = $this->request->getFile('asset_image');

        if ($isDataValid) {
            
           
               $directoryPath = 'assets/images/item/';

               if (!is_dir($directoryPath)) {
                        mkdir($directoryPath, 0777, true); //Create directory recursively
                      }

             if ($image->isValid() && !$image->hasMoved()) {
            // Generate a unique name for the uploaded file
                $newName = 'Assets_'.$this->request->getPost('asset_owner'). '_'.date('YmdHis').'.' . $image->getExtension();
                $image->move($directoryPath, $newName);

                // // Move the uploaded file to the desired location
                // $image->move('./uploads', $newName);

                } else {
                    if ($this->request->getPost('asset_type')=='Ruangan'){
                         $newName='default_room.jpg';
                    }else if ($this->request->getPost('asset_type')=='Kendaraan'){
                         $newName='car_default.jpg';
                    }else{
                         $newName='zoom_default.png';
                    }
                   
                   
                }

            $data = array(
                'asset_name'            => $this->request->getPost('asset_name'),
                'description'           => $this->request->getPost('description'),
                'asset_type'            => $this->request->getPost('asset_type'),
                'asset_status'          => $this->request->getPost('asset_status'),
                'id_owner'              => $this->request->getPost('asset_owner'),
                'amount_asset'          => $this->request->getPost('asset_amount'),
                'capacity'              => $this->request->getPost('capacity'),
                'asset_image'        => $newName,
                         
            );
            $this->MAM->createAsset($data);
           
            echo json_encode(array('status' => 'ok;', 'text' => ''));
        } else {
           $validation = $this->validation;
            $error=$validation->getErrors();
           
            $dataname=$_POST;
                  //print_r($error);
            echo json_encode(array('status' => 'error;', 'text' => '', 'data'=>$error,'dataname'=>$dataname));
        }
    }

   public function deleteAsset()
    {

         if (session()->id==null){
            return false;
        }
        $img=$this->request->getPost('img');
        $path_file='assets/images/item/'.$img;
        if ($img!='car_default.jpg'&&$img!='default_room.jpg'&&$img!='zoom_default.png'){
            if (file_exists($path_file)) {
                    unlink($path_file);
            }  
        }

        $id = $this->request->getPost('id_asset');
        $this->MAM->deleteAsset($id);

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

    public function editAsset()
    {
    
    // $detail =$this->request->getPost('manager');
    //     print_r($detail);
    // if (!isset($detail)) {
    //     echo "ada isi";
    // }
     if (session()->id==null){
            return false;
        }

        $this->validation->setRules($this->MAM->rulesEdit());
       $isDataValid = $this->validation->withRequest($this->request)->run();

       $id=$this->request->getPost('id_asset');

       if ($isDataValid) {
        $data = array(
                'asset_name'            => $this->request->getPost('asset_name'),
                'description'           => $this->request->getPost('description'),
                'asset_type'            => $this->request->getPost('asset_type'),
                'asset_status'          => $this->request->getPost('asset_status'),
                'id_owner'              => $this->request->getPost('asset_owner'),
                'amount_asset'          => $this->request->getPost('asset_amount'),
                  'capacity'              => $this->request->getPost('capacity'),

           
        );
        
        $this->MAM->updateAsset($data, $id);
     

        $image = $this->request->getFile('asset_image');
        $oldimage = $this->request->getPost('asset_image');
        $old_img=$this->request->getPost('oldassetimg');
             // if ($image->isValid()){
             //    echo "valid";
             // }else{
             //    echo "gavalid";
             // }

         if (!isset($oldimage)) {
               
                   $directoryPath = 'assets/images/item/';

                   if (!is_dir($directoryPath)) {
                            mkdir($directoryPath, 0777, true); //Create directory recursively
                          }

                 if ($image->isValid() && !$image->hasMoved()) {
             
                    $newName = 'Assets_'.$this->request->getPost('asset_owner'). '_'.date('YmdHis').'.' . $image->getExtension();
                     $path_oldimg = 'assets/images/item/'.$old_img;
                     if ( $old_img!='car_default.jpg'&&$old_img!='default_room.jpg'&&$old_img!='zoom_default.png'){
                        unlink($path_oldimg);
                     }
                    $image->move($directoryPath, $newName);
                     $data = array(
                        'asset_image' => $newName,
                    );
                    // // Move the uploaded file to the desired location
                     //$image->move($directoryPath, $newName);
                    
                     $this->MAM->updateAsset($data, $id);
                      //session()->set($data);
                   
                    }else{
                        $path_oldimg = 'assets/images/item/'.$old_img;
                         if ( $old_img!='car_default.jpg'&&$old_img!='default_room.jpg'&&$old_img!='zoom_default.png'){
                            unlink($path_oldimg);
                         }

                         if ($this->request->getPost('asset_type')=='Ruangan'){
                                $newName='default_room.jpg';
                            }else if ($this->request->getPost('asset_type')=='Kendaraan'){
                                 $newName='car_default.jpg';
                            }else{
                                 $newName='zoom_default.png';
                            }

                        $data = array(
                            'asset_image' => $newName,
                        );
                        // // Move the uploaded file to the desired location
                         //$image->move($directoryPath, $newName);
                        
                         $this->MAM->updateAsset($data, $id);
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

    public function show_asset(){
        
        $this->MAM->updateEndloanlate();
        $data =$this->MAM->GetShowAssetCat($this->request->getPost('search'), $this->request->getPost('searchByName'));
        echo json_encode(array('status' => 'ok;', 'text' => '', 'data'=>$data));
        
    }

     public function show_asset_status(){
   
        $data =$this->LNM->GetShowAssetStatus($this->request->getPost('search'), $this->request->getPost('searchByName'));
      
        echo json_encode(array('status' => 'ok;', 'text' => '', 'data'=>$data));
        
    }

      public function loan_detail(){
        

        $data =$this->LNM->get_detail($this->request->getPost('id_loan'));
      
        echo json_encode(array('status' => 'ok;', 'text' => '', 'data'=>$data));
        
    }

     public function UpUnit()
    {
        if (session()->nip_emp==null){
            return false;
        }


      
        $this->validation->setRules([
            
                 'unit_emp' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'unit tidak boleh kosong',
                    ],
                ],
                
            

        ]);
        $isDataValid = $this->validation->withRequest($this->request)->run();
        
        if ($isDataValid) {
            
            $data = array(
                'unit_emp' => strtoupper($this->request->getPost('unit_emp')),
                
            );
            session()->set($data);
            $this->LM->updateEmployee($data, session()->nip_emp);
            echo json_encode(array('status' => 'ok;', 'text' => ''));
        }else {

            $validation = $this->validation;
            $error=$validation->getErrors();
            $dataname=$_POST;
            echo json_encode(array('status' => 'error;', 'text' => '', 'data'=>$error, 'dataname'=>$dataname));
         }

    
    }





}

?>