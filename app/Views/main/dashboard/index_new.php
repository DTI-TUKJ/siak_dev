<?= $this->extend('partials/header_layout' ) ?>

<?= $this->section('content') ?>
	        <div class="nk-content ">
                <div class="container-fluid">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            <div class="nk-block-head nk-block-head-sm">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h3 class="nk-block-title page-title">Asset Used</h3>
                                        <div class="nk-block-des text-soft">
                                            <p>Hubung admin untuk info asset</p>
                                        </div> 
                                    </div><!-- .nk-block-head-content -->
                                    <div class="nk-block-head-content">
                                       <!--  <div class="toggle-wrap nk-block-tools-toggle">
                                            <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                            <div class="toggle-expand-content" data-content="pageMenu">
                                                <ul class="nk-block-tools g-3">
                                                    <li> 
                                                        
                                                        <input type="text" class="form-control"  name="search_loan" id="search_loan" placeholder="Search Asset in loan">
                                                    </li>
                                                    <li>
                                                    <select class="form-select" id="s_cat_loan" name="s_cat_loan" onchange="">
                                                         <option value="All">All</option>
                                                         <option value="Ruangan">Ruangan</option>
                                                            <option value="Kendaraan">Kendaraan</option>
                                                         <option value="Zoom">Zoom</option>

                                                    </select>
                                                    </li>
                                                   
                                                </ul>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->
                            <div class="nk-block">
                                <div class="card card-bordered card-preview">
                                        <div class="card-inner">
                                            <ul class="nav nav-tabs mt-n3">
                                                <li class="nav-item nav-item-loan">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem1_used " onclick="tabShow('','Loan')">All</a>
                                                </li>
                                                <li class="nav-item nav-item-loan">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem2_used" onclick="tabShow('_car','Loan')">Kendaraan</a>
                                                </li>
                                                <li class="nav-item nav-item-loan">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem3_used" onclick="tabShow('_room','Loan')">Ruangan</a>
                                                </li>
                                                <li class="nav-item nav-item-loan">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem4_used" onclick="tabShow('_zoom','Loan')">Zoom</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                  <div class="toggle-wrap nk-block-tools-toggle mb-2">
                                                       
                                                            <ul class="nk-block-tools g-3">
                                                                  <li> 
                                                                    
                                                                    <input type="text" class="form-control"  name="search_loan" id="search_loan" placeholder="Search Available Asset">
                                                                </li>   
                                                               
                                                            </ul>
                                                     
                                                      </div>
                                                <div class="tab-pane active" id="tabItem1_used">
                                                    <div class="row g-gs kontenproduk_loan"  id="kontenproduk_loan" style="justify-content: center;">
                                                                
                                                            
                                                         
                                                      </div>
                                                         <div class="row g-gs" id="loader_container_loan" style="justify-content: center;">
                                                                    <span class="loader_front" id="loader_front_loan" style="display: none;"></span>
                                                         </div>
                                                     <nav class="mt-4 pagination-wrap_loan" id="pagination-wrap_loan">
                                   
                                                      </nav>
                                                </div>
                                                <div class="tab-pane" id="tabItem2_used">
                                                        <div class="row g-gs kontenproduk_loan_car"  id="kontenproduk_loan_car" style="justify-content: center;">
                                                                
                                                            
                                                         
                                                      </div>
                                                         <div class="row g-gs" id="loader_container_loan_car" style="justify-content: center;">
                                                                    <span class="loader_front" id="loader_front_loan_car" style="display: none;"></span>
                                                         </div>
                                                     <nav class="mt-4 pagination-wrap_loan_car" id="pagination-wrap_loan_car">
                                   
                                                      </nav>
                                                </div>
                                                <div class="tab-pane" id="tabItem3_used">
                                                      <div class="row g-gs kontenproduk_loan_room"  id="kontenproduk_loan_room" style="justify-content: center;">
                                                                
                                                            
                                                         
                                                      </div>
                                                         <div class="row g-gs" id="loader_container_loan_room" style="justify-content: center;">
                                                                    <span class="loader_front" id="loader_front_loan_room" style="display: none;"></span>
                                                         </div>
                                                     <nav class="mt-4 pagination-wrap_loan_room" id="pagination-wrap_loan_room">
                                   
                                                      </nav>
                                                </div>
                                                <div class="tab-pane" id="tabItem4_used">
                                                      <div class="row g-gs kontenproduk_loan_zoom"  id="kontenproduk_loan_zoom" style="justify-content: center;">
                                                                
                                                            
                                                         
                                                      </div>
                                                         <div class="row g-gs" id="loader_container_loan_zoom" style="justify-content: center;">
                                                                    <span class="loader_front" id="loader_front_loan_zoom" style="display: none;"></span>
                                                         </div>
                                                     <nav class="mt-4 pagination-wrap_loan_zoom" id="pagination-wrap_loan_zoom">
                                   
                                                      </nav>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            
                            </div>
                        </div>
                        <div class="nk-content-body" style="margin-top:30px">
                            <div class="nk-block-head nk-block-head-sm">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h3 class="nk-block-title page-title">Available Asset</h3>
                                        <div class="nk-block-des text-soft">
                                            <p>Hubung admin untuk info asset</p>
                                        </div>
                                    </div><!-- .nk-block-head-content -->
                                    <div class="nk-block-head-content">
                                      
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->
                            <div class="nk-block">
                        
                                  <div class="card card-bordered card-preview">
                                        <div class="card-inner" >
                                            <ul class="nav nav-tabs mt-n3">
                                                <li class="nav-item nav-item-available ">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem1" onclick="tabShow('','Available')">All</a>
                                                </li>
                                                <li class="nav-item nav-item-available">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem2" onclick="tabShow('_car','Available')">Kendaraan</a>
                                                </li>
                                                <li class="nav-item nav-item-available">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem3" onclick="tabShow('_room','Available')">Ruangan</a>
                                                </li>
                                                <li class="nav-item nav-item-available">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem4" onclick="tabShow('_zoom','Available')">Zoom</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                 <div class="toggle-wrap nk-block-tools-toggle mb-2">
                                                    
                                                            <ul class="nk-block-tools g-3">
                                                                  <li> 
                                                                    
                                                                    <input type="text" class="form-control"  name="search_All" id="search_All" placeholder="Search Available Asset">
                                                                </li>   
                                                               
                                                            </ul>
                                                       
                                                      </div>
                                                <div class="tab-pane active" id="tabItem1">
                                                         
                                                      <div class="row g-gs kontenproduk"  id="kontenproduk" style="justify-content: center;">
                                                                
                                                            
                                                         
                                                      </div>
                                                         <div class="row g-gs" id="loader_container" style="justify-content: center;">
                                                                    <span class="loader_front" id="loader_front" style="display: none;"></span>
                                                         </div>
                                                     <nav class="mt-4 pagination-wrap" id="pagination-wrap">
                                   
                                                      </nav>
                                                </div>
                                                <div class="tab-pane" id="tabItem2">

                                                      <div class="row g-gs kontenproduk_car"  id="kontenproduk_car" style="justify-content: center;">
                                                              
                                                          
                                                         
                                                     </div>
                                                            <div class="row g-gs" id="loader_container_car" style="justify-content: center;">
                                                                <span class="loader_front" id="loader_front_car" style="display: none;"></span>
                                                            </div>
                                                      <nav class="mt-4 pagination-wrap_car" id="pagination-wrap_car">
                                     
                                                      </nav>
                                                </div>
                                                <div class="tab-pane" id="tabItem3">
                                                
                                                      <div class="row g-gs kontenproduk_room"  id="kontenproduk_room" style="justify-content: center;">
                                                    
                                                         
                                                     </div>
                                                      <div class="row g-gs" id="loader_container_room" style="justify-content: center;">
                                                                <span class="loader_front" id="loader_front_room" style="display: none;"></span>
                                                      </div>
                                                       <nav class="mt-4 pagination-wrap_room" id="pagination-wrap_room">
                                   
                                                      </nav>                                                
                                                 </div>
                                                <div class="tab-pane" id="tabItem4">
                                                

                                                      <div class="row g-gs kontenproduk_zoom"  id="kontenproduk_zoom" style="justify-content: center;">
                                  
                                                            
                                                         
                                                     </div>
                                                      <div class="row g-gs" id="loader_container_zoom" style="justify-content: center;">
                                                                <span class="loader_front" id="loader_front_zoom" style="display: none;"></span>
                                                            </div>
                                                     <nav class="mt-4 pagination-wrap_zoom" id="pagination-wrap_zoom">
                                   
                                                      </nav>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                          
                            </div>
                        </div>
                        <?php if (session()->lectur || session()->type=='admin akademik' || session()->type=='superadmin') { ?>
                        <div class="nk-content-body" style="margin-top:30px">
                            <div class="nk-block-head nk-block-head-sm">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h3 class="nk-block-title page-title">Class Room</h3>
                                        <div class="nk-block-des text-soft">
                                            <p>Hubung admin untuk info asset</p>
                                        </div> 
                                    </div><!-- .nk-block-head-content -->
                                    <div class="nk-block-head-content">
                               
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->
                            <div class="nk-block">
                                <div class="card card-bordered card-preview">
                                        <div class="card-inner" style="padding-bottom:5px">
                                            <ul class="nav nav-tabs mt-n3">
                                                <li class="nav-item nav-item-loan_classroom">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem1_classroom1" onclick="reloadtable('example', 'KAMPUS A')" >Kampus A</a>
                                                </li>
                                               
                                                <li class="nav-item nav-item-loan_classroom">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem2_classroom2" onclick="reloadtable('example2', 'KAMPUS B')" >Kampus B</a>
                                                </li>
                                                <li class="nav-item nav-item-loan_classroom">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem2_classroom3"  onclick="reloadtable('example3', 'KAMPUS C')" >Kampus C</a>
                                                </li>
                                            
                                            </ul>
                                            <div class="tab-content">
                                             
                                                <div class="tab-pane active" id="tabItem1_classroom1">
                                                    <div class=" row toggle-wrap nk-block-tools-toggle mb-4  g-gs">

                                                       <div class="col-sm-2" style="min-width: 125px;">

                                                
                                                                <input type="text" class="form-control" id="flatpickr-range_classroom" name="loan_date_start" placeholder="Enter start date loan"> 
                                                            
                                                         

                                                        </div>
                                                        <div class="col-sm-2" style="min-width: 175px;">
                                                    
                                                                <select class="form-select" id="room_name" name="room_name" style="width: 300px;">
                                                            
                                                                </select>
                                                        </div>
                                                        <div class="col-sm-1" style="min-width: 125px;">

                                                            <div class="form-control-wrap dash-room">
                                                                <a class="btn btn-round btn-sm btn-primary" onclick="bookRoom()">Book Room</a>
                                                                
                                                            </div>
                                                         
                                                           
                                                        </div>
                                                        <div class="col-sm-3" style="min-width: 325px;">
                                                            <div class="example-alert">
                                                                <div class="alert alert-info alert-icon">
                                                                   <em class="icon ni ni-alert-circle"></em> Peminjaman dilakukan minimal H-3
                                                               </div>
                                                            </div>
                                                        </div>
                                                    
                                                    </div>
                                                    <div class="row g-gs"style="justify-content: center;">
                                                                
                                                    <table class=" nk-tb-list nk-tb-ulist table table-bordered " data-auto-responsive="false" id="example" style="min-width:1425px;">
                                                        <thead>
                                                            <tr class="nk-tb-item nk-tb-head">
                                                                <th class="nk-tb-col" style=""><span class="sub-text">Day</span></th>
                                                                <?php 
                                                                 foreach ($dataHour as $val) {
                                                                   ?>
                                                                    <th class="nk-tb-col"><span class="sub-text"><?= date('H:i',strtotime($val['HOURNAME'])) ;?></span></th>
                                                                   <?php 
                                                                 }
                                                                ?>
                                                                
                                                               
                                                            </tr>
                                                        </thead>
                                                        <tbody>


                                                   
                                                        </tbody>

                                                    </table>
                                                         
                                                      </div>
                                                      
                                                </div>
                                                <div class="tab-pane" id="tabItem2_classroom2">
                                                    <div class="row toggle-wrap nk-block-tools-toggle mb-4  g-gs">
                                                            
                                                        <div class="col-sm-2" style="min-width: 125px;">
                                                                    <input type="text" class="form-control" id="flatpickr-range2" name="loan_date_start" placeholder="Enter start date loan"> 
                                                                
                                                        </div>
                                                        <div class="col-sm-2" style="min-width: 175px;">
                                                                <div class="form-control-wrap dash-room">
                                                                    <select class="form-select" id="room_name2" name="room_name2" style="width: 300px;">
                                                                
                                                                    </select>

                                                                
                                                                </div>
                                                        </div>
                                                        <div class="col-sm-1" style="min-width: 125px;">
                                                                    <div class="form-control-wrap dash-room">
                                                                    <a class="btn btn-round btn-sm btn-primary" onclick="bookRoom()">Book Room</a>
                                                                    
                                                                    </div>
                                                              </div>
                                                        <div class="col-sm-2" style="min-width: 325px;">
                                                                    <div class="example-alert">
                                                                        <div class="alert alert-info alert-icon">
                                                                            <em class="icon ni ni-alert-circle"></em> Peminjaman dilakukan minimal H-3
                                                                        </div>
                                                                    </div>
                                                        </div>
                                                        
                                                        </div>
                                                        <div class="row g-gs" style="justify-content: center;">
                                                                
                                                        <table class=" nk-tb-list nk-tb-ulist table table-bordered " data-auto-responsive="false" id="example2" style="min-width:1425px;">
                                                            <thead>
                                                                <tr class="nk-tb-item nk-tb-head">
                                                                    <th class="nk-tb-col" style=""><span class="sub-text">Day</span></th>
                                                                    <?php 
                                                                    foreach ($dataHour as $val) {
                                                                    ?>
                                                                        <th class="nk-tb-col"><span class="sub-text"><?= date('H:i',strtotime($val['HOURNAME'])) ;?></span></th>
                                                                    <?php 
                                                                    }
                                                                    ?>
                                                                    
                                                                
                                                                </tr>
                                                            </thead>
                                                            <tbody>


                                                    
                                                            </tbody>

                                                        </table>
                                                         
                                                      </div>
                                                      
                                                </div>
                                                <div class="tab-pane" id="tabItem2_classroom3">
                                                    <div class="row toggle-wrap nk-block-tools-toggle mb-4  g-gs">
                                                            
                                                        <div class="col-sm-2" style="min-width: 125px;">
                                                                    <input type="text" class="form-control" id="flatpickr-range3" name="loan_date_start" placeholder="Enter start date loan"> 
                                                                
                                                        </div>
                                                        <div class="col-sm-2" style="min-width: 175px;">
                                                                <div class="form-control-wrap dash-room">
                                                                    <select class="form-select" id="room_name3" name="room_name3" style="width: 300px;">
                                                                
                                                                    </select>

                                                                
                                                                </div>
                                                        </div>
                                                        <div class="col-sm-1" style="min-width: 125px;">
                                                                    <div class="form-control-wrap dash-room">
                                                                    <a class="btn btn-round btn-sm btn-primary" onclick="bookRoom()">Book Room</a>
                                                                    
                                                                    </div>
                                                              </div>
                                                        <div class="col-sm-2" style="min-width: 325px;">
                                                                    <div class="example-alert">
                                                                        <div class="alert alert-info alert-icon">
                                                                            <em class="icon ni ni-alert-circle"></em> Peminjaman dilakukan minimal H-3
                                                                        </div>
                                                                    </div>
                                                        </div>
                                                        
                                                        </div>
                                                        <div class="row g-gs" style="justify-content: center;">
                                                                
                                                        <table class=" nk-tb-list nk-tb-ulist table table-bordered " data-auto-responsive="false" id="example3" style="min-width:1425px;">
                                                            <thead>
                                                                <tr class="nk-tb-item nk-tb-head">
                                                                    <th class="nk-tb-col" style=""><span class="sub-text">Day</span></th>
                                                                    <?php 
                                                                    foreach ($dataHour as $val) {
                                                                    ?>
                                                                        <th class="nk-tb-col"><span class="sub-text"><?= date('H:i',strtotime($val['HOURNAME'])) ;?></span></th>
                                                                    <?php 
                                                                    }
                                                                    ?>
                                                                    
                                                                
                                                                </tr>
                                                            </thead>
                                                            <tbody>


                                                    
                                                            </tbody>

                                                        </table>
                                                         
                                                      </div>
                                                      
                                                </div>
                                               
                                            </div>
                                        </div>
                                        <div class="row footer-table g-gs">
                                         <div class="col-sm-3 " style="display:flex;min-width: 375px;">
                                            <div style="height: 20px;width: 75px;background-color:#e90e15;margin-right:5px">

                                            </div>
                                            <div>
                                                jadwal sudah terisi oleh jam perkuliahan
                                            </div>
                                         </div>
                                         <div class="col-sm-3" style="display:flex;min-width: 350px;"" >
                                            <div style="height: 20px;width: 75px;background-color:#eaff00;margin-right:5px">

                                            </div>
                                            <div>
                                                jadwal sudah terisi oleh peminjam lain
                                            </div>
                                         </div>
                                         <div class="col-sm-3" style="display:flex;min-width: 225px;"" >
                                            <div style="height: 20px;width: 75px;background-color:#7ff743;margin-right:5px">

                                            </div>
                                            <div>
                                                jadwal bisa dipilih
                                            </div>
                                         </div>
                                         
                                         
                                        </div> 
                                        
                                    </div>
                                <!-- <div class="row g-gs" id="loader_container_status" style="justify-content: center;">
                                    <span class="loader_front" id="loader_front_status" style="margin-top:5%;display: none;"></span>
                                </div>
                                <div class="row g-gs kontenproduk_loan"  id="kontenproduk_loan" style="justify-content: center;">
                              
                                  
                                </div>
                                 <nav class="mt-4 pagination-wrap_loan" id="pagination-wrap_loan">
                                   
                                 </nav> -->
                            </div>
                        </div>
                        <?php } ;?>
                    </div>
                </div>
            </div>


<div class="modal fade " role="dialog" aria-hidden="true" id="modalcheck">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Check Schedule</h5>
            </div>
            <div class="modal-body" id="maincheck">


        </div>

    </div>
</div>
</div>

<div class="modal fade " role="dialog" aria-hidden="true" id="modaldetail">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Detail Schedule</h5>
            </div>
            <div class="modal-body pt-0" id="maindetail">
             
        </div>

    </div>
</div>
</div>

<div class="modal fade " tabindex="-1" id="modalRequestRoomLoan">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Request Form</h5>
            </div>
            <div class="modal-body" id="mainRequestRoomLoan">

                
       
        </div>  
      
    </div>
</div>
</div>

<div class="modal fade " tabindex="-1" id="modalAdd">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Request Loan</h5>
            </div>
            <div class="modal-body" id="mainAdd">

                
       
        </div>  
      
    </div>
</div>
</div>




            <script type="text/javascript">
               function calldata(table, kampus) {

                    $('#'+table).DataTable({
                        scrollX: true,
                        "processing": true,
                        // // "serverSide": true,
                        "order": false,
                        // "lengthMenu": [30, 60, 90, 120],
                        // "pageLength": 30,
                        "paging":   false,
                        "ordering": false,
                        "info":     false,
                        "searching": false,
                        "ajax" : {
                            url : '<?php echo base_url('dataScheduleClass') ?>',
                            type: "POST",
                            // success : function(e) {
                            //         // $('#loader_front').hide()
                            //         // $('#loader_container').hide()
                            // },
                            data : function(data){
                                data.campus = kampus;
                                if(kampus=='KAMPUS A'){
                                    data.date=document.getElementById('flatpickr-range_classroom').value;
                                    data.room=$('#room_name').val();
                                }else if (kampus=='KAMPUS B'){
                                    data.date=document.getElementById('flatpickr-range2').value;
                                    data.room=$('#room_name2').val();
                                }else{
                                    data.date=document.getElementById('flatpickr-range3').value;
                                    data.room=$('#room_name3').val();
                                }
                            
                            }

                        },
                        "columnDefs":[{
                            "targets":'_all',
                            "orderable":false,
                            "className":"custom-td"
                            // render: $.fn.dataTable.render.html()
                            },
                            {
                                "targets":0,
                            
                                "className":"custom-td-day"
                            }
                        ],
                        "language": 
                        {          
                        "processing": "<span class=\"loader_front\"></span>",
                        }
                    });
                }


                        function reloadtable(table, kampus){
                            
                       	     $('#'+table).DataTable().clear().destroy();

                            calldata(table, kampus)
                            
                        }

                function select2Generate(id, kampus){
                    $("#"+id).select2({ 
                            ajax: {
                                            url: "getRoom",
                                            dataType: 'json',
                                            type: 'POST',
                                            data: function (params) {
                                            return {
                                                searchTerm: params.term,
                                                campus:kampus
                                            };
                                            },
                                            processResults: function (data) {
                                                return { results:
                                                    $.map(data, function(item) {
                                                        return {
                                                            id: item.id,
                                                            text: item.text
                                                        };
                                                    })
                                                };
                                            }
                                        },

                        }).on('select2:open', function(e){
                                            $('.select2-search__field').attr('placeholder', 'Search Room');
                                        });
                }

                function bookRoom(){
                        var checkedValues = [];
                        var count = $("input[type=checkbox]:checked").length;
                        if (count==0){
                            Swal.fire({
                          icon: 'error',
                          title: 'Pilih setidaknya satu jadwal',
                        })
                        }else{
                            var sessionLectur='<?php echo session()->lectur ?>';
                            var sessionadmin='<?php echo session()->type ?>';
                            var checkedValues = [];
                            var checkSameday = [];
                            var checkSametime=[];
                            var i=0;
                            var s=1;
                            var t=1;
                              $("input[type=checkbox]:checked").each(function(){
                                checkedValues.push($(this).val());
                                if (i>=1){
                                    var day1=checkedValues[checkedValues.length-2].split('|')
                                     var day2=checkedValues[i].split('|')
                                   
                                    if (day1[0]!=day2[0]){
                                        checkSameday.push(s);
                                        s++
                                    }

                                    if (day2[2]!=timeIncrease(day1[2])){
                                        checkSametime.push(t);
                                        t++;
                                    }
                                }
                                
                                i++;
                            });
                            var html ='';
                            if (checkSameday.length==0){
                                if(checkSametime.length==0){
                                        var dataLoan =checkedValues[0].split("|");
                                        var lastDataLoan=checkedValues[checkedValues.length-1].split("|");
                                        var optionType= `<option value="other">Other</option>
                                                         <option value="organization">Organization</option>
                                                         <option value="kelas pengganti">Kelas Pengganti</option>`
                                        var viewOptionPic='';
                                        if (sessionLectur && sessionadmin!='admin akademik' ){
                                            optionType= `<option value="other">Other</option>
                                                         <option value="kelas pengganti">Kelas Pengganti</option>`
                                            viewOptionPic='none-view'
                                        }
                                        html +=`
                                            <form id="frmAddReqRoom">
                                            <div class="row g-4"  >
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label" >Class Room Name</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" value="${dataLoan[3]}" name="room_name" placeholder="Enter Amount" style="background-color:#F5F6FA;" readonly>
                                                        </div>
                                                        <div id="room_name-error">

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="date_loan">Loan Date</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" value="${dataLoan[4]}" name="date_loan" id="date_loan" placeholder="Enter date_loan" style="background-color:#F5F6FA;" readonly >
                                                        </div>
                                                        <div id="date_loan-error">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="start_time">Start Hour</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" value="${dataLoan[2]}" name="start_time" id="start_time" placeholder="Enter start time" style="background-color:#F5F6FA;" readonly >
                                                        </div>
                                                        <div id="start_time-error">

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="end_time">End Hour</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" value="${timeIncrease(lastDataLoan[2])}" name="end_time" id="end_time" placeholder="Enter end time" style="background-color:#F5F6FA;" readonly >
                                                        </div>
                                                        <div id="end_time-error">

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 ${viewOptionPic}">
                                                    <div class="form-group">
                                                        <label class="form-label" for="pic_loan">PIC</label>
                                                        <div class="form-control-wrap">
                                                            <select class="form-select" id="pic_loan" name="pic_loan">
                                                                <option value="">- Choose PIC -</option>
                                                          
                                                            </select>
                                                        </div>
                                                        <div id="pic_loan-error">

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="type_loan">Request Type</label>
                                                        <div class="form-control-wrap">
                                                            <select class="form-select" id="type_loan" name="type_loan">
                                                                <option value="">- Choose Request Type -</option>
                                                                ${optionType}
                                                            </select>
                                                        </div>
                                                        <div id="type_loan-error">

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 none-view"  id="selectOrganization">
                                                    <div class="form-group">
                                                        <label class="form-label" for="organization">Chosee Organization</label>
                                                        <div class="form-control-wrap">
                                                            <select class="form-select" id="organization" name="organization">
                                                            <option value="">- Choose Organization -</option>
                                                            </select>
                                                        </div>
                                                        <div id="organization-error">

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 input-data-perkuliahan none-view"  id="inputlectDate">
                                                    <div class="form-group">
                                                        <label class="form-label" for="lecDate">Actual Lecture Date</label>
                                                        <div class="form-control-wrap">
                                                       
                                                        <input type="text" id="lecDate" name="lecDate" class="form-control" value=""
                                                            placeholder="Masukan Tanggal perkuliahan sebenernya">
                                                        </div>
                                                        <div id="lecDate-error">

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 input-data-perkuliahan none-view" id="selectStudyProgram">
                                                    <div class="form-group">
                                                        <label class="form-label" for="study_program">Study Program</label>
                                                        <div class="form-control-wrap">
                                                            <select class="form-select" id="study_program" name="study_program">
                                                                <option value="">- Choose study program -</option>
                                                                <option value="D3 Teknik Telekomunikasi">D3 Teknik Telekomunikasi</option>
                                                                <option value="S1 Teknik Telekomunikasi">S1 Teknik Telekomunikasi</option>
                                                                <option value="S1 Teknologi Informasi">S1 Teknologi Informasi</option>
                                                                <option value="S1 Sistem Informasi">S1 Sistem Informasi</option>
                                                                <option value="S1 Desain Komunikasi Visual">S1 Desain Komunikasi Visual</option>
                                                            
                                                            </select>
                                                        </div>
                                                        <div id="study_program-error">

                                                        </div>
                                                     
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 input-data-perkuliahan none-view" id="inputSubject">
                                                    <div class="form-group">
                                                        <label class="form-label" for="subject">Subject Name</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" value="" name="subject" id="subject" placeholder="Masukan Nama Mata Kuliah">
                                                        </div>
                                                        <div id="subject-error">

                                                        </div>
                                                     
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 input-data-perkuliahan none-view" id="inputCLassName">
                                                    <div class="form-group">
                                                        <label class="form-label" for="classname">Class Name</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" value="" name="classname" id="classname" placeholder="Masukan Nama Kelas, contoh : D3TT-KJ-21-001 ">
                                                        </div>
                                                        <div id="classname-error">

                                                        </div>
                                                     
                                                    </div>
                                                </div>

                                                
                                                <div class="col-lg-12 input-data-perkuliahan none-view" id="inputReplacementReason">
                                                    <div class="form-group">
                                                        <label class="form-label" for="reason">Replacement Reason</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" value="" name="reason" id="reason" placeholder="Masukan Alasan Mengganti kelas" >
                                                        </div>
                                                        <div id="reason-error">

                                                        </div>
                                                     
                                                    </div>
                                                </div>

                                                <div class="col-lg-12" id="inputActivity">
                                                    <div class="form-group">
                                                        <label class="form-label" for="activity">Activity Name</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" value="" name="activity" id="activity" placeholder="Enter Activity" >
                                                        </div>
                                                        <div id="activity-error">

                                                        </div>
                                                     
                                                    </div>
                                                </div>
                                              
                                        
                                              

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-lg btn-primary" id="buttonAddReqClass" onclick="addReqClass()">Request</button>
                                                        <span class="loader" id="loaderAddReqClass" style="display: none;"></span>

                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                `
                                    $('#mainRequestRoomLoan').html(html);
                                    $("#type_loan").select2({
                                        dropdownParent: $("#mainRequestRoomLoan"),
                                        minimumResultsForSearch: -1

                                    })

                                    $("#study_program").select2({
                                        dropdownParent: $("#mainRequestRoomLoan"),
                                        minimumResultsForSearch: -1,
                                        dropdownPosition: 'below'

                                    })

                                    flatpickr('#lecDate', {

                                    static: false,
                                    enableTime: true,
                                    time_24hr: true,
                                    dateFormat: "d M Y H:i",
                                    minuteIncrement: 30,  // Sets the minute increment to 30 minutes
                                    // mode: 'multiple',  // Allows multiple date/time selection
                                    defaultMinute: 30,
                                    
                                    // defaultDate:defaulttgl,
                                    //  plugins: [
                                    //     new minMaxTimePlugin({
                                    //         table: {
                                    //             '<?php echo date('Y-m-d') ?>':minmaxTime,
                                    //         }
                                    //     })
                                    // ]

                                })

                                    $("#pic_loan").select2({
                                            dropdownParent: $("#mainRequestRoomLoan"),
                                            ajax: {
                                                url: "getPicClassLoan",
                                                dataType: 'json',
                                                type: 'POST',
                                                data: function (params) {
                                                return {
                                                    searchTerm: params.term
                                                };
                                                },
                                                processResults: function (data) {
                                                return { results: data };
                                                }
                                            },
                                            minimumInputLength: 3
                                        }).on('select2:open', function(e){
                                                $('.select2-search__field').attr('placeholder', 'Search NIP/Nim/Name  ');
                                            });


                                    $("#organization").select2({
                                            dropdownParent: $("#modalRequestRoomLoan"),
                                            ajax: {
                                                url: "getOrg",
                                                dataType: 'json',
                                                type: 'POST',
                                                data: function (params) {
                                                return {
                                                    searchTerm: params.term
                                                };
                                                },
                                                processResults: function (data) {
                                                return { results: data };
                                                }
                                            },
                                            minimumInputLength: -1
                                        }).on('select2:open', function(e){
                                                $('.select2-search__field').attr('placeholder', 'Search Organization');
                                            });
                               
                                        $('#type_loan').on('change', function() {
                                            if ($(this).val()=='organization'){
                                                $("#selectOrganization").removeClass("none-view");
                                                $("#inputActivity").removeClass("none-view");
                                                $(".input-data-perkuliahan").addClass("none-view");
                                              
                                                
                                            }else if($(this).val()=='kelas pengganti'){
                                                $(".input-data-perkuliahan").removeClass("none-view");
                                                $("#selectOrganization").addClass("none-view");
                                                $("#inputActivity").addClass("none-view");
                                                
                                                
                                            }
                                            else {
                                                $("#selectOrganization").addClass("none-view");
                                                $(".input-data-perkuliahan").addClass("none-view");
                                            
                                                $("#inputActivity").removeClass("none-view");
                                                
                                                    
                                            }
                                        
                                        });
                                    
                                    // // get first value as start date
                                    // console.log(checkedValues[0])
                                    // //get last value as end date
                                    // console.log(checkedValues[checkedValues.length-1])
                                     $("#modalRequestRoomLoan").modal('show');
                                    // console.log(checkSametime.length)
                                }else{
                                    Swal.fire({
                                    icon: 'warning',
                                    title: 'Terdapat jadwal yang terisi di rentang waktu yang anda pilih',
                                })
                                }
                                
                            }else{
                                Swal.fire({
                                icon: 'warning',
                                title: 'Harap pilih jadwal di hari yang sama',
                                })
                            }
                         
                            
                        }
                      
                    }

                $(document).ready(function(){
                  // var param=document.getElementById('s_cat_available').value;
                  // var param_status=document.getElementById('s_cat_loan').value;
                  // console.log(param)
                  showproduk();
                  showprodukstatus();
                 
                  var curdate='<?php echo session()->type!='admin akademik'? date('d M Y', strtotime(date('d M Y') . ' + 3 days')) : date('d M Y') ?>'
                  var Minimaldate='<?php echo session()->type!='admin akademik'? date('Y-m-d', strtotime(date('Y-m-d') . ' + 3 days')) :'' ?>'
                  var MaksimalDate = '<?php echo $dataSettingApp['date_cutoff_req_set'] ?>'
                  console.log(MaksimalDate)
                
                    
                    
                    flatpickr('#flatpickr-range_classroom', {
                            // dateFormat: "F j, Y", \
                            minDate:Minimaldate,
                            maxDate:MaksimalDate,
                            enableTime: false,
                            dateFormat: "d M Y",
                            defaultDate:curdate,
                            onChange: function(selectedDates, dateStr, instance) {
                                // Reload DataTables with new date
                                console.log('hai')
                                $('#example').DataTable().ajax.reload()
                            }
                        })

                        flatpickr('#flatpickr-range2', {
                            // dateFormat: "F j, Y", 
                            minDate:Minimaldate,
                            maxDate:MaksimalDate,
                            enableTime: false,
                            dateFormat: "d M Y",
                            defaultDate:curdate,
                            onChange: function(selectedDates, dateStr, instance) {
                                // Reload DataTables with new date
                                console.log('hai')
                                $('#example2').DataTable().ajax.reload()
                            }
                        })

                        flatpickr('#flatpickr-range3', {
                            // dateFormat: "F j, Y", 
                            minDate:Minimaldate,
                            maxDate:MaksimalDate,
                            enableTime: false,
                            dateFormat: "d M Y",
                            defaultDate:curdate,
                            onChange: function(selectedDates, dateStr, instance) {
                                // Reload DataTables with new date
                                console.log('hai')
                                $('#example3').DataTable().ajax.reload()
                            }
                        })
                        
                        select2Generate('room_name', 'Kampus A')
                        select2Generate('room_name2', 'Kampus B')
                        select2Generate('room_name3', 'Kampus C')

                        
                            // Set the selected value in Select2
                        $('#room_name').select2('trigger', 'select', {data: {id: "RKA.KJ.01.001", text: "RKA.KJ.01.001"}});
                        $('#room_name2').select2('trigger', 'select', {data: {id: "RKB.KJ.01.001", text: "RKB.KJ.01.001"}});
                        $('#room_name3').select2('trigger', 'select', {data: {id: "RKC.KJ.03.001", text: "RKC.KJ.03.001"}});

                            var defdate1=document.getElementById('flatpickr-range_classroom').value;
                            // var room1=$('#room_name').val();
                           
                        calldata('example', 'KAMPUS A')
                        // calldata('example2', 'KAMPUS A',defdate1,room1)
                        $('#room_name').on('change', function() {
                            
                         $('#example').DataTable().ajax.reload()
                    
                        });
                         $('#room_name2').on('change', function() {
                        $('#example2').DataTable().ajax.reload()
                    
                        });
                        $('#room_name3').on('change', function() {
                        $('#example3').DataTable().ajax.reload()
                    
                        });
            
                })

         
                function timeIncrease(time){
                    var timeString = time;

       
                    var timeParts = timeString.split(":");
                    var hours = parseInt(timeParts[0]);
                    var minutes = parseInt(timeParts[1]);
                    var seconds = parseInt(timeParts[2]);

                    // Add 60 minutes (1 hour)
                    hours += 1;

                    // Convert back to string format
                    var newTimeString = padZero(hours) + ":" + padZero(minutes) + ":" + padZero(seconds);

                    return newTimeString; // Output: "07:30:00"
                }
                // Function to pad zero if the number is less than 10
                function padZero(num) {
                    return (num < 10 ? "0" : "") + num;
                }

            function addReqClass()
                    {
                    var form_data = new FormData($('#frmAddReqRoom')[0]);

                    $.ajax({
                        url:"<?php echo base_url('addReqLoan') ?>",
                        global:false,
                        async:true,
                        type:'post',
                        processData: false,
                        contentType: false,
                        dataType:'json',
                        enctype: "multipart/form-data",
                        data: form_data,
                        beforeSend: function () {
                                    $('#buttonAddReqClass').hide()
                                    $('#loaderAddReqClass').show()
                                },
                        success : function(e) {
                        if(e.status == 'ok;') 
                        {
                            $('#buttonAddReqClass').show()
                            $('#loaderAddReqClass').hide()
                            let timerInterval
                            Swal.fire({
                                icon: 'success',
                                title: ' Request has been send',
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: true,
                                didOpen: () => {
                                timerInterval = setInterval(() => {

                                }, 100)
                                },
                                willClose: () => {
                                clearInterval(timerInterval)
                                }
                            }).then((result) => {
                                /* Read more about handling dismissals below */
                                if (result.dismiss === Swal.DismissReason.timer) {
                                location.reload();
                                }
                            })
                        } 
                        else{ 
                            $('#buttonAddReqClass').show()
                            $('#loaderAddReqClass').hide()
                            var msgeror='';
                                $.each(e.dataname, function(key, value) {
                                    document.getElementById(key+"-error").innerHTML ="";
                                });

                                $.each(e.data, function(key, value) {
                                document.getElementById(key+"-error").innerHTML = `<span class="badge badge-dim bg-danger">`+value+`
                                                                                    </span>`;
                            });
                     
                            $("#modalRequestRoomLoan").modal('show');
                        }
                    },
                    error :function(xhr, status, error) {
                        $('#buttonAddReqClass').show()
                            $('#loaderAddReqClass').hide()
                    alert(xhr.responseText);
                    }

                });
            }

                function tabShow(tabName, viewName){
                        if (viewName=='Available'){
                            document.getElementById("kontenproduk"+tabName).innerHTML = "";
                            document.getElementById("pagination-wrap"+tabName).innerHTML = "";
                            $('#loader_container'+tabName).show()
                        }else{
                            //console.log(viewName)
                            document.getElementById("kontenproduk_loan"+tabName).innerHTML = "";
                            document.getElementById("pagination-wrap_loan"+tabName).innerHTML = "";
                            $('#loader_container_loan'+tabName).show()
                        }
                       
                        var originalString = tabName;
                        var cat = originalString.replace(/_/g, '');
                        
                        if(cat=='car'){
                            cat='Kendaraan';
                        }else if(cat=='room'){
                             cat='Ruangan';
                        }else if(cat=='zoom'){
                            cat='Zoom';
                        }

                        (viewName=='Available')?showproduk(cat, tabName):showprodukstatus(cat, tabName);
                }
                  // let autorelod = setInterval(function () {
                  //       var param_status_new=document.getElementById('s_cat_loan').options[document.getElementById('s_cat_loan').selectedIndex].value
                  //       var param_new=document.getElementById('s_cat_available').options[document.getElementById('s_cat_available').selectedIndex].value
                  //       var paramName_new = document.getElementById('search_available').value;
                  //       var paramName_status = document.getElementById('search_loan').value;
                        
                        
                  //        var page_active = parseInt($('.pagination-wrap li.current-page.active').text())
                  //        var page_active_loan = parseInt($('.pagination-wrap_loan li.current-page.active').text())
                  //       console.log(page_active);

                  //       showprodukstatus(param_status_new,page_active_loan,paramName_status,'onreload' );
                  //       //showproduk(param_new, page_active ,paramName_new );
                  //  }, 5000)


         const source = document.getElementById('search_All');
         const source_status = document.getElementById('search_loan');


          const inputHandler = function(e) {
                        var type = $('.nav li.nav-item-available a.nav-link.active').text()
                             if(type=='All'){
                                var tabName='';
                             }else if (type=='Kendaraan'){
                                var tabName='_car';
                             }else if (type=='Ruangan'){
                                var tabName='_room'
                             }else{
                                var tabName='_zoom'
                             }

                        $('#loader_container'+tabName).show()
                        var page_active = 1
                        document.getElementById("kontenproduk"+tabName).innerHTML = "";
                        document.getElementById("pagination-wrap"+tabName).innerHTML = "";

              //showproduk(e.target.value);
                        
                        $.ajax({
                              url:"<?php echo base_url('showAsset') ?>",
                              global:false,
                              async:true,
                              type:'post',
                              dataType:'json',
                              data: ({
                               searchByName : e.target.value,
                               search : type,

                              }),
                              beforeSend: function () {
                                    $('#loader_front'+tabName).show()
                                   // $('.subkonten').hide()
                              },
                              success : function(e) {
                                  var html ='';
                                    $('#loader_front'+tabName).hide()
                                    $('#loader_container'+tabName).hide()
                                    // $('.subkonten').show()
                                    if (e.data.length!=0){
                                    $.each(e.data, function(key, value) {
                                      // console.log(`ini${value.amount_asset}`)
                                         var labelCap='Capacity';

                                        if(value.asset_type=='Kendaraan'){
                                            labelCap='Seat Capacity &emsp;&emsp;&emsp;&nbsp;&nbsp;'
                                        }else if(value.asset_type=='Zoom' || value.asset_type=='Ruangan'){
                                            labelCap='Participant Capacity'
                                        }
                                       html +=`
                                        <div class="col-md-4 subkonten" style="cursor: pointer;">
                                                <div class="card card-bordered card-full">
                                                    <div class="card-inner">
                                                        <div class="row g-gs">
                                                            <div class="col-md-3">
                                                                <div class="image-item ">
                                                                  <img class="image-content" src="<?php echo base_url('').'/assets/images/item/' ?>${value.asset_image}" alt="" srcset="" class="profile-img" style="width: 110px;height: 100px;object-fit: cover;margin: 0 auto;">
                                                                  </div>
                                                                    
                                                            </div>
                                                            <div class="col-md-9" >
                                                         
                                                                    <div class="card-title-group align-start mb-0" style="margin-top: 10px;">
                                                                        <div class="card-title">
                                                                            <h6 class="subtitle">Asset Name</h6>
                                                                        </div>
                                                                      
                                                                    </div>
                                                                    <div class="card-amount">
                                                                        <span class="amount" style="font-size:20px">${value.asset_name}
                                                                        </span>
                                                                        
                                                                    </div>
                                                                  
                                                                    <div class="invest-data mt-1"  style=" display: inline-block;word-break: break-word;">
                                                                        <div class="invest-data-amount g-2">
                                                                            <div class="invest-data-history">
                                                                                <div class="title">Description</div>
                                                                                <div class="amount">${value.description}</div>
                                                                            </div>
                                                                       
                                                                        </div>
                                                                      
                                                                    </div> 
                                                                    <div class="invest-data mt-1">
                                                                        <div class="invest-data-amount g-2">
                                                                            
                                                                            <div class="invest-data-history">
                                                                                <div class="title">${labelCap}</div>
                                                                                 <div class="amount" style="display:flex"><p>  ${value.capacity}</p><i class="icon fa-solid fa-users " style="margin-left:15px"></i></div>
                                                                            </div>
                                                                    
                                                                        </div>

                                                                      
                                                                    </div>
                                                                       <div class="invest-data mt-0">
                                                                 
                                                                            <div class="invest-data-history" style="display:flex; justify-content:right" >
                                                                                
                                                                                <div class="amount" style="">
                                                                                <a class="btn btn-round btn-sm btn-primary" onclick="modalcheck('${value.id_asset}', '${value.id_owner}')">Check Schedule</a>
                                                                                </div>
                                                                            </div>
                                                                      
                                                                    </div> 
                                                            </div>
                                                        </div>
                                                       
                                                    </div>
                                                </div><!-- .card -->
                                            </div><!-- .col -->

                                            `;
                                    });
                                    }else{
                                        html +=` <div class="col-md-4 subkonten">
                                         <div class="card card-bordered card-full">
                                            <div class="card-inner" style="justify-content:center;display: flex;">
                                                <span>There's no Available Asset</span>
                                               
                                            </div>
                                        </div><!-- .card -->
                                    </div>`
                                    }  
                                     $('#kontenproduk'+tabName).html(html);
                                       //document.getElementById("kontenproduk_loan").innerHTML = "";
                                     document.getElementById("pagination-wrap"+tabName).innerHTML = "";
                                     produk_pagination_available(page_active, tabName);
                                    

                                      
                                  
                              },
                              error :function(xhr, status, error) {
                               alert(xhr.responseText);
                              }

                            })
                }

          const inputHandlerLoan = function(e) {
            var type = $('.nav li.nav-item-loan a.nav-link.active').text()
                             if(type=='All'){
                                var tabName='';
                             }else if (type=='Kendaraan'){
                                var tabName='_car';
                             }else if (type=='Ruangan'){
                                var tabName='_room'
                             }else{
                                var tabName='_zoom'
                             }

                        $('#loader_container_loan'+tabName).show()
                        
                          var page_active_loan = 1
                       document.getElementById("kontenproduk_loan"+tabName).innerHTML = "";
                       document.getElementById("pagination-wrap_loan"+tabName).innerHTML = "";
                        
                       
                        // console.log(type)
                        $.ajax({
                              url:"<?php echo base_url('showAssetStatus') ?>",
                              global:false,
                              async:true,
                              type:'post',
                              dataType:'json',
                              data: ({
                               searchByName : e.target.value,
                               search : type,

                              }),
                              beforeSend: function () {
                                    $('#loader_front_loan'+tabName).show()
                                   // $('.subkonten').hide()
                              },
                              success : function(e) {
                                  var html ='';
                                    $('#loader_front_loan'+tabName).hide()
                                    $('#loader_container_loan'+tabName).hide()
                                    // $('.subkonten').show()
                                    if (e.data.length!=0){
                                     var datenow=new Date('<?php echo date('Y-m-d H:i:s') ?>')
                                       
                                      $.each(e.data, function(key, value) {
                                         var date_start=new Date(value['tanggal_pinjam'])
                                         var date_end=new Date(value['tanggal_kembali'])
                                         if (datenow>=date_start && value.status==1 ){
                                         status=`<span class=" text-success">In Use  </span> until <b>${formatDate(date_end)}</b>`
                                         }else{
                                            if(value.status!=0){
                                                status=`<span class="text-info">Scheduled on</span><p ><b>${formatDate(date_start)} - ${formatDate(date_end)}</b></p>`
                                            }else{
                                                status=`<span class="text-warning"> Requested in </span><p ><b>${formatDate(date_start)} - ${formatDate(date_end)}</b></p>`
                                            }
                                         }
                                         html +=`
                                                
                                                    <div class="col-md-4 subkonten_loan" id="subkonten_loan" style="cursor:pointer">
                                                            <div class="card card-bordered card-full  shadow-cus">
                                                                <div class="card-inner shadow-cus">
                                                                    <div class="row g-gs">
                                                                        <div class="col-md-3">
                                                                            <div class="image-item ">
                                                                              <img class="image-content" src="<?php echo base_url('').'/assets/images/item/' ?>${value.asset_image}" alt="" srcset="" class="profile-img" style="width: 110px;height: 100px;object-fit: cover;margin: 0 auto;">
                                                                              </div>
                                                                                
                                                                        </div>
                                                                        <div class="col-md-9" >
                                                                     
                                                                                <div class="card-title-group align-start mb-0" style="margin-top: 10px;">
                                                                                    <div class="card-title">
                                                                                        <h6 class="subtitle">Asset Name</h6>
                                                                                    </div>
                                                                                  
                                                                                </div>
                                                                                <div class="card-amount">
                                                                                    <span class="amount" style="font-size:20px">${value.asset_name}
                                                                                    </span>
                                                                                    
                                                                                </div>
                                                                                
                                                                                <div class="invest-data ">
                                                                                    <div class="invest-data-amount g-2">
                                                                                        <div class="invest-data-history">
                                                                                            <div class="title">status</div>
                                                                                            <div class="amount">${status}</div>
                                                                                        </div>
                                                                                   
                                                                                    </div>
                                                                                  
                                                                                </div>   
                                                                                
                                                                                 
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div><!-- .card -->
                                                        </div><!-- .col -->

                                              `;
                                      });
                                    }else{
                                        html +=` <div class="col-md-4 subkonten_loan">
                                         <div class="card card-bordered card-full">
                                            <div class="card-inner" style="justify-content:center;display: flex;">
                                                <span>There's no Available Asset</span>
                                               
                                            </div>
                                        </div><!-- .card -->
                                    </div>`
                                    } 
                                   // console.log(html)  
                                     $('#kontenproduk_loan'+tabName).html(html);

                                     document.getElementById("pagination-wrap_loan"+tabName).innerHTML = "";
                                     produk_pagination_loan(page_active_loan, tabName);
  
                                  
                              },
                              error :function(xhr, status, error) {
                               alert(xhr.responseText);
                              }

                            })
                }
                      
          source.addEventListener('input', inputHandler);
          source.addEventListener('propertychange', inputHandler);
          source_status.addEventListener('input', inputHandlerLoan);
          source_status.addEventListener('propertychange', inputHandlerLoan);

        function showprodukstatus(search='', tabName='', select=1, paramName=null){
            var status='';
                  $.ajax({
                    url:"<?php echo base_url('showAssetStatus') ?>",
                    global:false,
                    async:true,
                    type:'post',
                    dataType:'json',
                    data: ({
                     search : search,
                     searchByName:paramName
                    }),
                     beforeSend: function () {
              
                                        $('#loader_front_loan'+tabName).show()
                                    
                              },
                    success : function(e) {
                        var html ='';
                       
                            $('#loader_front_loam'+tabName).hide()
                             $('#loader_container_loan'+tabName).hide()
                          
                             
                         if (e.data.length!=0){
                            var datenow=new Date('<?php echo date('Y-m-d H:i:s') ?>')
                           
                          $.each(e.data, function(key, value) {
                             var date_start=new Date(value['tanggal_pinjam'])
                             var date_end=new Date(value['tanggal_kembali'])
                             if (datenow>=date_start && value.status==1 ){
                             status=`<span class=" text-success">In Use  </span> until <b>${formatDate(date_end)}</b>`
                             }else{
                                if(value.status!=0){
                                     status=`<span class="text-info">Scheduled on</span><p ><b>${formatDate(date_start)} - ${formatDate(date_end)}</b></p>`
                                }else{
                                     status=`<span class="text-warning">Requested in </span><p ><b>${formatDate(date_start)} - ${formatDate(date_end)}</b></p>`
                                }
                             }
                             html +=`
                                    
                                        <div class="col-md-4 subkonten_loan" id="subkonten_loan" style="cursor:pointer" onclick="detail_loan(${value.id_loan})">
                                                <div class="card card-bordered card-full  shadow-cus">
                                                    <div class="card-inner">
                                                        <div class="row g-gs">
                                                            <div class="col-md-3">
                                                                <div class="image-item ">
                                                                  <img class="image-content" src="<?php echo base_url('').'/assets/images/item/' ?>${value.asset_image}" alt="" srcset="" class="profile-img" style="width: 110px;height: 100px;object-fit: cover;margin: 0 auto;">
                                                                  </div>
                                                                    
                                                            </div>
                                                            <div class="col-md-9" >
                                                         
                                                                    <div class="card-title-group align-start mb-0" style="margin-top: 10px;">
                                                                        <div class="card-title">
                                                                            <h6 class="subtitle">Asset Name</h6>
                                                                        </div>
                                                                      
                                                                    </div>
                                                                    <div class="card-amount">
                                                                        <span class="amount" style="font-size:20px">${value.asset_name}
                                                                        </span>
                                                                        
                                                                    </div>
                                                                    
                                                                    <div class="invest-data ">
                                                                        <div class="invest-data-amount g-2">
                                                                            <div class="invest-data-history">
                                                                                <div class="title">Status</div>
                                                                                <div class="amount">${status}</div>
                                                                            </div>
                                                                       
                                                                        </div>
                                                                      
                                                                    </div>   
                                                                    
                                                                     
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- .card -->
                                            </div><!-- .col -->

                                  `;
                          });
                        }else{
                            html +=` <div class="col-md-4 subkonten_loan">
                                         <div class="card card-bordered card-full">
                                            <div class="card-inner" style="justify-content:center;display: flex;">
                                                <span>There's no Available Asset</span>
                                               
                                            </div>
                                        </div><!-- .card -->
                                    </div>`
                        }

                           $('#kontenproduk_loan'+tabName).html(html);
                            //document.getElementById("pagination-wrap_loan").innerHTML = "";
                            produk_pagination_loan(select, tabName);
                            
                        
                    },
                    error :function(xhr, status, error) {
                     alert(xhr.responseText);
                    }

                  })

        }
        function detail_loan(id){
            let html=''
            $.ajax({
                    url:"<?php echo base_url('detailLoan') ?>",
                    global:false,
                    async:true,
                    type:'post',
                    dataType:'json',
                    data: ({
                     id_loan : id,
                   
                    }),
                    success : function(e) {
                                
                             let date_start=new Date(e.data.tanggal_pinjam)
                             let date_end=new Date(e.data.tanggal_kembali)
                             let driver=''
                                 if (e.data.asset_type=='Kendaraan'){
                                    if (e.data.driver==1){
                                        driver +=' ( With Driver )'
                                    }else{
                                         driver +='( Without Driver )'
                                    }
                                 }
                             html +=`  <div class="tab-pane " id="overview">
                                          <div class="invest-ov gy-2 pb-1 pt-1">
                                              <div class="subtitle mb-0 pb-0">Activity Name</div>
                                              <div class="invest-ov-details">
                                                  
                                                      <div class="amount">${e.data.activity}</div>
                                                
                                            
                                               </div>
                                             
                                           </div>
                                           <div class="invest-ov gy-2 pb-1 pt-1">
                                              <div class="subtitle mb-0 pb-0">Schedule Activity</div>
                                              <div class="invest-ov-details">
                                                  
                                                      <div class="amount"> <span class="badge badge-dim badge-md bg-info">${formatDate(date_start)}</span> - <span class="badge badge-dim badge-md bg-info">${formatDate(date_end)}</span></div>
                                                 
                                                  
                                            
                                               </div>
                                             <div class="amount">${driver}</div>
                                           </div>
                                           <div class="invest-ov gy-2 pb-1 pt-1">
                                              <div class="subtitle mb-0 pb-0">PIC Name</div>
                                              <div class="invest-ov-details">
                                                  
                                                      <div class="amount">${e.data.name} ( ${e.data.nip} )</div>
                                                 
                                                  
                                            
                                               </div>
                                             
                                           </div>
                                           <div class="invest-ov gy-2 pb-1 pt-1">
                                              <div class="subtitle mb-0 pb-0">Unit</div>
                                              <div class="invest-ov-details">
                                                  
                                                      <div class="amount">${e.data.unit}</div>
                                                 
                                                  
                                            
                                               </div>
                                             
                                           </div>
                                           <div class="invest-ov gy-2 pb-1 pt-1">
                                              <div class="subtitle mb-0 pb-0">PIC contact</div>
                                              <div class="invest-ov-details">
                                                  
                                                      <div class="amount">${e.data.no_telepon}<a href="https://wa.me/${convertphonenumber(e.data.no_telepon)}" class="btn btn-dim btn-success"><i class="icon fa-brands fa-whatsapp"></i></a></div>
                                                 
                                                
                                            
                                               </div>
                                             
                                           </div>
                                           
                                       </div>
                                     `;
                         
                    

                           $('#maindetail').html(html);
                           $('#modaldetail').modal('show');
                    
                        
                    },
                    error :function(xhr, status, error) {
                     alert(xhr.responseText);
                    }

                  })
        }

        function showproduk(search='', tabName='', select=1, paramName=null){
           
           
                  $.ajax({
                    url:"<?php echo base_url('showAsset') ?>",
                    global:false,
                    async:true,
                    type:'post',
                    dataType:'json',
                    data: ({
                     search : search,
                     searchByName:paramName
                    }),
                     beforeSend: function () {
                                    
                                   $('#loader_front'+tabName).show()
                                    
                              },
                    success : function(e) {
                        var html ='';
                             $('#loader_front'+tabName).hide()
                             $('#loader_container'+tabName).hide()
                         if (e.data.length!=0){
                          $.each(e.data, function(key, value) {
                                var labelCap='Capacity';
                                var emsp='';
                                if(value.asset_type=='Kendaraan'){
                                    labelCap='Seat Capacity'
                                 
                                }else if(value.asset_type=='Zoom' || value.asset_type=='Ruangan'){
                                    labelCap='Participant Capacity'
                                    
                                }
                             html +=`
                                        <div class="col-md-4 subkonten" id="subkonten">
                                                <div class="card card-bordered card-full">
                                                    <div class="card-inner">
                                                        <div class="row g-gs" >
                                                            <div class="col-md-3">
                                                                <div class="image-item ">
                                                                  <img class="image-content" src="<?php echo base_url('').'/assets/images/item/' ?>${value.asset_image}" alt="" srcset="" class="profile-img" style="width: 110px;height: 100px;object-fit: cover;margin: 0 auto;">
                                                                  </div>
                                                                    
                                                            </div>
                                                            <div class="col-md-9" >
                                                         
                                                                    <div class="card-title-group align-start mb-0" style="margin-top: 10px;">
                                                                        <div class="card-title">
                                                                            <h6 class="subtitle">Asset Name</h6>
                                                                        </div>
                                                                      
                                                                    </div>
                                                                    <div class="card-amount">
                                                                        <span class="amount" style="font-size:20px">${value.asset_name}
                                                                        </span>
                                                                        
                                                                    </div>
                                                                    
                                                                    <div class="invest-data " style=" display: inline-block;word-break: break-word;">
                                                                        <div class="invest-data-amount g-2" >
                                                                            <div class="invest-data-history" style="">
                                                                                <div class="title">Description</div>
                                                                                <p class="amount" >${value.description}</p>
                                                                            </div>
                                                                       
                                                                        </div>
                                                                      
                                                                    </div>   
                                                                    
                                                                     <div class="invest-data mt-1" >
                                                                        <div class="invest-data-amount g-2">
                                                                            
                                                                            <div class="invest-data-history">
                                                                                <div class="title">${labelCap}</div>
                                                                                 <div class="amount" style="display:flex; height:17px"><p>  ${value.capacity}</p><i class="icon fa-solid fa-users " style="margin-left:15px"></i></div>
                                                                            </div>
                                                                        
                                                                        </div>  
                                                                        
                                                                    </div>
                                                                    <div class="invest-data mt-0">
                                                              
                                                                            <div class="invest-data-history" style="display:flex; justify-content:right" >
                                                                                
                                                                                <div class="amount" style="">
                                                                                <a class="btn btn-round btn-sm btn-primary" onclick="modalcheck('${value.id_asset}', '${value.id_owner}')">Check Schedule</a>
                                                                                </div>
                                                                            </div>
                                                                
                                                                    </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- .card -->
                                            </div><!-- .col -->

                                  `;
                          });
                        }else{
                            html +=` <div class="col-md-4 subkonten">
                                         <div class="card card-bordered card-full">
                                            <div class="card-inner" style="justify-content:center;display: flex;">
                                                <span>There's no Available Asset</span>
                                               
                                            </div>
                                        </div><!-- .card -->
                                    </div>`
                        }

                           $('#kontenproduk'+tabName).html(html);
                         
                           produk_pagination_available(select, tabName);
                            

                            
                        
                    },
                    error :function(xhr, status, error) {
                     alert(xhr.responseText);
                    }

                  })

        }

        function produk_pagination_available(pageShow, tabName) {
                $(function () {
                            var numberOfitem=$('.kontenproduk'+tabName+' .subkonten ').length;
                            var limitPerpage=9;
                            var totalPages=Math.ceil(numberOfitem/limitPerpage);
                            var paginationSize=5;
                            var currentPage;

                            function showPage_available(whichPage) {
                                if(whichPage<1 || whichPage>totalPages) return false;

                                currentPage = whichPage;

                                $('.kontenproduk'+tabName+' .subkonten ').hide().slice((currentPage-1)*limitPerpage, currentPage*limitPerpage).show();
                                $('.pagination-wrap'+tabName+' li').slice(1,-1).remove();

                                // var halaman=1;
                                // var cek=getPageList(totalPages, currentPage, paginationSize);
                                // console.log(cek);
                                getPageList(totalPages, currentPage, paginationSize).forEach(item => {

                                  $("<li>").addClass("page-item").addClass(item ? "current-page" : "dots").toggleClass("active", item === currentPage).append($("<a>").addClass("page-link")
                                  .attr({href: "javascript:void(0)"}).text(item || "...")).insertBefore(".next");

                                });

                                 $(".prev").toggleClass("disable", currentPage === 1);
                                $(".next").toggleClass("disable", currentPage === totalPages);
                                return true;
                            }
                           //console.log(numberOfitem); 

                            $(".pagination-wrap"+tabName).append(
                                 $("<ul>").append(
                                    $("<li>").addClass("page-item").addClass("prev").append($("<a>").addClass('page-link').attr({href: "javascript:void(0)"}).append($("<i>").addClass("icon fa-solid fa-circle-arrow-left"))),
                                 $("<li>").addClass("page-item").addClass("next").append($("<a>").addClass('page-link').attr({href: "javascript:void(0)"}).append($("<i>").addClass("icon fa-solid fa-circle-arrow-right")))
                                    ).addClass("pagination justify-content-center"));

                            $(".kontenproduk"+tabName).show();
                            if(pageShow==''){
                                pageShow=1;
                            }
                            showPage_available(pageShow); 
                            $(document).on("click", ".pagination-wrap"+tabName+" li.current-page:not(.active)", function(){
                               // clearInterval(autorelod)
                                return showPage_available(+$(this).text());
                              });
                            
                              $(".next").on("click", function(){
                                
                                return showPage_available(currentPage + 1);
                              });
                            
                              $(".prev").on("click", function(){
                               
                                return showPage_available(currentPage - 1);
                              });      
                        });
            }

        function produk_pagination_loan(pageShow,tabName) {
                $(function () {
                            var numberOfitem=$('.kontenproduk_loan'+tabName+' .subkonten_loan ').length;
                            var limitPerpage=9;
                            var totalPages=Math.ceil(numberOfitem/limitPerpage);
                            var paginationSize=5;
                            var currentPage;

                            function showPage_loan(whichPage) {
                                if(whichPage<1 || whichPage>totalPages) return false;

                                currentPage = whichPage;

                                $('.kontenproduk_loan'+tabName+' .subkonten_loan').hide().slice((currentPage-1)*limitPerpage, currentPage*limitPerpage).show();
                                $('.pagination-wrap_loan'+tabName+' li').slice(1,-1).remove();

                                // var halaman=1;
                                // var cek=getPageList(totalPages, currentPage, paginationSize);
                                // console.log(cek);
                                getPageList(totalPages, currentPage, paginationSize).forEach(item => {

                                  $("<li>").addClass("page-item").addClass(item ? "current-page" : "dots").toggleClass("active", item === currentPage).append($("<a>").addClass("page-link")
                                  .attr({href: "javascript:void(0)"}).text(item || "...")).insertBefore(".next_loan");

                                });

                                 $(".prev_loan").toggleClass("disable", currentPage === 1);
                                $(".next_loan").toggleClass("disable", currentPage === totalPages);
                                return true;
                            }
                           //console.log(numberOfitem); 

                            $(".pagination-wrap_loan"+tabName).append(
                                 $("<ul>").append(
                                    $("<li>").addClass("page-item").addClass("prev_loan").append($("<a>").addClass('page-link').attr({href: "javascript:void(0)"}).append($("<i>").addClass("icon fa-solid fa-circle-arrow-left"))),
                                    $("<li>").addClass("page-item").addClass("next_loan").append($("<a>").addClass('page-link').attr({href: "javascript:void(0)"}).append($("<i>").addClass("icon fa-solid fa-circle-arrow-right")))
                                ).addClass("pagination justify-content-center"));

                            $(".kontenproduk_loan"+tabName).show();
                             if(pageShow==''){
                                pageShow=1;
                            }
                            showPage_loan(pageShow); 

                            $(document).on("click", ".pagination-wrap_loan"+tabName+" li.current-page:not(.active)", function(){
                                return showPage_loan(+$(this).text());
                              });
                            
                              $(".next_loan").on("click", function(){
                                return showPage_loan(currentPage + 1);
                              });
                            
                              $(".prev_loan").on("click", function(){
                                return showPage_loan(currentPage - 1);
                              });      
                        });
            }

        function getPageList(totalPages, page, maxLength){
                  function range(start, end){
                    return Array.from(Array(end - start + 1), (_, i) => i + start);
                  }
                
                  var sideWidth = maxLength < 9 ? 1 : 2;
                  var leftWidth = (maxLength - sideWidth * 2 - 3) >> 1;
                  var rightWidth = (maxLength - sideWidth * 2 - 3) >> 1;
                  //console.log(sideWidth);
                
                  if(totalPages <= maxLength){
                    return range(1, totalPages);
                  }
                
                  if(page <= maxLength - sideWidth - 1 - rightWidth){
                    return range(1, maxLength - sideWidth - 1).concat(0, range(totalPages - sideWidth + 1, totalPages));
                  }
                
                  if(page >= totalPages - sideWidth - 1 - rightWidth){
                    return range(1, sideWidth).concat(0, range(totalPages- sideWidth - 1 - rightWidth - leftWidth, totalPages));
                  }
                
                  return range(1, sideWidth).concat(0, range(page - leftWidth, page + rightWidth), 0, range(totalPages - sideWidth + 1, totalPages));
                }

        function formatDate(date) {
              var day = date.getDate().toString().padStart(2, '0');
              var month = (date.getMonth() + 1).toString().padStart(2, '0'); // Months are zero-based, so add 1
              var year = date.getFullYear();
              var hours = date.getHours().toString().padStart(2, '0');
              var minutes = date.getMinutes().toString().padStart(2, '0');
              var seconds = date.getSeconds().toString().padStart(2, '0');

               return `${day}/${month}/${year}  ${hours}:${minutes}`;
            }

        function modalcheck(id, owner){
            var html = `
                        <form id="frmcheck">
                              <div class="row g-0">

                                <div class="form-group">
                                       
                                        
                                        <label class="form-label" for="flatpickr-range">Loan Date</label>
                                    
                                            <input type="hidden" name="asset_name" value="${id}">
                                        <div class="form-control-wrap">
                                           <div class="form-control-wrap">   
                                                <div class="input-group">        
                                                    <div class="col-lg-5">    
                                                     <input type="text" class="form-control" id="flatpickr-range" name="loan_date_start" value="<?php echo set_value('loan_date') ?>" placeholder="Enter start date loan" onchange="formDate()"> 
                                                     </div> 
                                                         <div class="input-group-prepend">           
                                                         <span class="input-group-text">To</span>        
                                                         </div> 
                                                     <div class="col-lg-6">      
                                                      <input type="text" class="form-control" id="loan_date_end" name="loan_date_end" placeholder="Enter end date loan" readonly style="background-color: #F5F6FA">    
                                                     </div>
                                                </div>
                                           </div>
                                            <div id="loan_date_start-error">

                                            </div>
                                             <div id="loan_date_end-error">

                                            </div>
                                    </div>
                                        
                                </div>
                                

                                <div class="col-12">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-lg btn-primary" id="buttonsave" onclick="CheckSchedule('${owner}')">Check</button>
                                        <span class="loader" id="loader" style="display: none;"></span>

                                    </div>
                                </div>
                            </div>
                        </form>
                     `
                     $('#maincheck').html(html);
                     flatpickr('#flatpickr-range', {
                        // dateFormat: "F j, Y", 
                        // maxDate:'<?php echo date('Y-m-d', strtotime('+1 days', strtotime(date('Y-m-d')))) ?>',
                        minDate:'<?php echo date('Y-m-d', strtotime(date('Y-m-d') . ' + 1 days')) ?>',
                        mode: 'range',
                        static:true,
                        enableTime: true,
                        time_24hr:true,
                        dateFormat: "d M Y H:i",
                        //  plugins: [
                        //     new minMaxTimePlugin({
                        //         table: {
                        //             '<?php echo date('Y-m-d') ?>':minmaxTime,
                        //         }
                        //     })
                        // ]

                    })

                    const waktuSekarang = new Date();

                    // Mendapatkan jam dari waktu saat ini
                    const jamSekarang = waktuSekarang.getHours();
                    if (jamSekarang >= 8 && jamSekarang <= 16) {
                         $("#modalcheck").modal('show');
                    } else {
                        console.log(jamSekarang)
                        Swal.fire({
                          icon: "error",
                          title: "Oops...",
                          text: "Request Peminjaman dapat dilakukan dari jam 08.00 - 16.00 WIB",
                         
                        });
                    }
        }

    function CheckSchedule(owner){
       var html='';
       var option='';
           var driver='';
           var destination=''
           var pickup=''
        var form_data = new FormData($('#frmcheck')[0]);
               $.ajax({
                 url:"<?php echo base_url('checkSchedule') ?>",
                 global: false,
                async: true,
                type: 'post',
                processData: false,
                contentType: false,
                dataType: 'json',
                enctype: "multipart/form-data",
                data: form_data,
                beforeSend: function () {
                    $('#buttonsave').hide()
                    $('#loader').show()
                  },
                 success : function(e) {
                   if(e.status == 'ok;') 
                   {  if (e.status_check!='unavailable'){
                        $('#buttonsave').show()
                         $('#loader').hide()
                        let timerInterval
                        Swal.fire({
                          title: 'Schedule Available',
                          icon: 'success',
                          showCancelButton: true,
                          confirmButtonColor: '#3085d6',
                          cancelButtonColor: '#d33',
                          confirmButtonText: 'Next'
                        }).then((result) => {
                             if (result.isConfirmed) {
                               $.each(e.data.data_asset, function(key, value) {
                                    if(value.id_asset==e.data.id_asset){
                                        option+=` <option value="${value.id_asset}">${value.asset_name}</option>`
                                        if(value.asset_type=='Kendaraan'){
                                            var disabled = '';
                                            var nb ='';
                                        
                                          
                                            destination+=` <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="destination">Destination City</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" value="" name="destination" id="destination" placeholder="Enter destination" >
                                                    </div>
                                                    <div id="destination-error">

                                                    </div>
                                                </div>
                                            </div>`
                                            pickup+=` <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="pick_up_loc">Pick Up Location</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" value="" name="pick_up_loc" id="pick_up_loc" placeholder="Masukan Lokasi penjemputan" >
                                                    </div>
                                                    
                                                    <div id="pick_up_loc-error">

                                                    </div>
                                                </div>
                                            </div>`
                                        }
                                    }
                                });

                               html +=`
                                        <form id="frmAdd">
                                          <div class="row g-4"  >
                                         
                                             <input type="hidden" name="id_asset" value="${e.data.id_asset}">
                                             <input type="hidden" name="owner" value="${owner}">
                                             
                                           
                                            
                                             <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="asset_name_add">Asset Name</label>
                                                    <div class="form-control-wrap">
                                                         <select class="form-select" id="asset_name_add" name="asset_name_add" disabled>
                                                           ${option}
                                                        </select>
                                                    </div>
                                                    <div id="asset_name_add-error">

                                                    </div>
                                                     <div id="id_asset-error">

                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="WhatsApp">Loan Date</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" value="${e.data.date_loan}" name="loan_date" id="WhatsApp" placeholder="Enter Amount" style="background-color:#F5F6FA;"  readonly>
                                                    </div>
                                                    <div id="loan_date-error">

                                                    </div>
                
                                                  
                                                </div>
                                            </div>
                                       
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="activity">Activity Name</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" value="" name="activity" id="activity" placeholder="Enter Activity" >
                                                    </div>
                                                    <div id="activity-error">

                                                    </div>
                                                      <div id="owner-error">

                                                    </div> 
                                                </div>
                                            </div>
                                            ${destination}
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                 <input type="hidden" name="max_req" value="${e.data.max_req}">
                                                    <label class="form-label" for="amount_loan">Amount Loan</label>
                                                    <div class="form-control-wrap">
                                                        <input type="number" class="form-control" value="1" name="amount_loan" id="amount_loan" placeholder="Enter Amount" >
                                                    </div>
                                                    <div id="amount_loan-error">

                                                    </div>
                                                    <div id="max_req-error">

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="activity">Choose Driver</label>
                                                    <div class="form-control-wrap">
                                                           <select class="form-select" id="driver" name="driver">
                                                                <option value="0">- Pilih Driver -</option>
                                                                  ${e.driver} 
                                                                
                                                            </select>
                                                    </div>
                                                    <div>
                                                        <span class="badge badge-dim bg-warning">Kosongkan Driver dan Pick up Jika Tidak Memakai driver</span>
                                                    </div>
                                                    <div id="driver-error">

                                                    </div>
                                                </div>
                                            </div>
                                          
                                            ${pickup}

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-lg btn-primary" id="buttonAddLoan" onclick="addLoan()">Save</button>
                                                    <span class="loader" id="loaderAddLoan" style="display: none;"></span>

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                               `

                              
                                $('#mainAdd').html(html);

                                $("#driver").select2({
                                        dropdownParent: $("#modalAdd"),
                                        minimumResultsForSearch: -1

                                    })
                                    
                                $("#modaltambah").modal('hide');
                            <?php  if (isset(session()->unit_emp)) { ?>
                                $("#modalAdd").modal('show');
                            <?php }else{ ?>

                                $("#modalcheck").modal('hide');
                                Swal.fire({
                     
                                  text: "Hubungi Helpdesk DTI untuk, Lengkapi data unit terlebih dahulu",
                                  icon: "warning",
                                  showCancelButton: false,
                                  confirmButtonColor: "#3085d6",
                                  cancelButtonColor: "#d33",
                                  confirmButtonText: "Ok!"
                                }).then((result) => {
                                  if (result.isConfirmed) {
                                    

                                    $("#modalunit").modal('show');
                                  }
                                });

                               
                             <?php } ?>
                          }
                        })
                    }else{
                         $('#buttonsave').show()
                        $('#loader').hide()
                        Swal.fire({
                          icon: 'error',
                          title: 'Schedule Unavailable',
                        })


                    }
                  } 
                  else{ 
                   // console.log(e.dataname);
                     $('#buttonsave').show()
                         $('#loader').hide()
                      $.each(e.dataname, function(key, value) {
                        document.getElementById(key+"-error").innerHTML ="";
                      });
                    $.each(e.data, function(key, value) {
                     
                      
                     document.getElementById(key+"-error").innerHTML = `<span class="badge badge-dim bg-danger" style="">`+value+`
                                                                        </span>`;
                  });
                       // document.getElementById("signature_m-error").innerHTML ="";
                       
                    $('#buttonsave').show()
                    $('#loader').hide()
                    $("#modaltambah").modal('show');
                 }
              },
              error :function(xhr, status, error) {
               alert(xhr.responseText);
            }

         });
    }


     function formDate() {

       var date= document.getElementById('flatpickr-range').value
      
        let dateArray = date.split(' to ');
      

        if (typeof dateArray[1] !== 'undefined') {
            console.log('Variabel sudah didefinisikan');
            document.getElementById('loan_date_end').value=dateArray[1];
            document.getElementById('flatpickr-range').value=dateArray[0];
        } else {
             console.log('Variabel belum didefinisikan');
            document.getElementById('flatpickr-range').value=dateArray[0];
            document.getElementById('loan_date_end').value='';
        }
       //console.log(dateArray)
    }

    function convertphonenumber(phoneNumber) {
      // Hapus karakter non-digit dari nomor telepon (seperti spasi, tanda "-", atau karakter lainnya)
      phoneNumber = phoneNumber.replace(/\D/g, '');

      // Periksa apakah nomor telepon sudah dimulai dengan '62'. Jika belum, tambahkan '62' di depan nomor.
      if (!phoneNumber.startsWith('62')) {
        phoneNumber = '62' + phoneNumber;
      }

      return phoneNumber;
    }

function addLoan()
    {
        var form_data = new FormData($('#frmAdd')[0]);

       $.ajax({
         url:"<?php echo base_url('addLoan') ?>",
         global:false,
         async:true,
         type:'post',
        processData: false,
         contentType: false,
         dataType:'json',
         enctype: "multipart/form-data",
         data: form_data,
         beforeSend: function () {
                    $('#buttonAddLoan').hide()
                    $('#loaderAddLoan').show()
                  },
         success : function(e) {
           if(e.status == 'ok;') 
           {
            $('#buttonAddLoan').show()
            $('#loaderAddLoan').hide()
             let timerInterval
              Swal.fire({
                icon: 'success',
                title: ' Request has been send',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: () => {
                  timerInterval = setInterval(() => {

                  }, 100)
                },
                willClose: () => {
                  clearInterval(timerInterval)
                }
              }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                  location.reload();
                }
              })
          } 
          else{ 
             $('#buttonAddLoan').show()
            $('#loaderAddLoan').hide()
            var msgeror='';
             $.each(e.dataname, function(key, value) {
                document.getElementById(key+"-error").innerHTML ="";
              });

            $.each(e.data, function(key, value) {
             document.getElementById(key+"-error").innerHTML = `<span class="badge badge-dim bg-danger">`+value+`
                                                                </span>`;
          });
            $('#buttonAddLoan').show()
            $('#loaderAddLoan').hide()
            $("#modalAdd").modal('show');
         }
      },
      error :function(xhr, status, error) {
       alert(xhr.responseText);
    }

 });
}
        
    </script>

<?= $this->endSection() ?>


<?= $this->extend('partials/footer_layout' ) ?>
