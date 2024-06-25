<?= $this->extend('partials/header_layout') ?>

<?= $this->section('content') ?>
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
                 <div class="nk-content-body">
                            <div class="nk-block-head nk-block-head-sm">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h3 class="nk-block-title page-title">History Loan</h3>
                                    </div>
                                    <div class="nk-block-head-content">
                                      
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->
                            <div class="nk-block">
                                <div class="card card-bordered card-preview">
                                        <div class="card-inner">
                                            <ul class="nav nav-tabs mt-n3">
                                                <li class="nav-item nav-item-loan">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem1_used "  onclick="reloadtable('example', 'asset loan', '<?php echo base_url('historyAssetLoan') ?>')">Asset Loan</a>
                                                </li>
                                        
                                                <li class="nav-item nav-item-loan">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem2_used" onclick="reloadtable('example2', 'classroomNonAcad', '<?php echo base_url('historyClassroomLoan') ?>')" >Classroom Loan (non-acadedmic)</a>
                                                </li>
                                                <li class="nav-item nav-item-loan">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem3_used" onclick="reloadtable('example3', 'classroomAcad', '<?php echo base_url('historyClassroomLoan') ?>')" >Classroom Loan (Kelas Pengganti)</a>
                                                </li>
                                     
                                            </ul>
                                            <div class="tab-content">
                                                  
                                                <div class="tab-pane active" id="tabItem1_used">
                                                   
                                                    <div class="card card-bordered card-preview">
                                                        <div class="card-inner">
                                                        
                                                        <table class=" nk-tb-list nk-tb-ulist table" data-auto-responsive="false" id="example" style="width: 100%;">
                                                            <thead>
                                                                <tr class="nk-tb-item nk-tb-head">
                                                                     <th>Id</th>
                                                                     <th>Activity</th>
                                                                    <th>Asset</th>
                                                                    <th>Peminjam</th>
                                                                    <th>NIP</th>
                                                                    <th>Unit</th>
                                                                
                                                                    <th>Tanggal Peminjaman</th>
                                                                    <th>Tanggal Dikembalikan</th>
                                                                    
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                               
                                                            
                                                            </tbody>

                                                        </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="tabItem2_used">
                                                 <div class="card card-bordered card-preview">
                                                        <div class="card-inner">
                                                        
                                                            <table class=" nk-tb-list nk-tb-ulist table nowrap table-bordered" data-auto-responsive="false" id="example2" style="width:100%;">
                                                                <thead>
                                                                    <tr class="nk-tb-item nk-tb-head">
                                                                    <!--   <th class="nk-tb-col nk-tb-col-check">
                                                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                                <input type="checkbox" class="custom-control-input" id="uid">
                                                                                <label class="custom-control-label" for="uid"></label>
                                                                            </div>
                                                                        </th> -->
                                                                       
                                                                        <th class="nk-tb-col"><span class="sub-text">ID</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">Activity</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">Room Name</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">Location</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">Loan Date</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">Start Hour</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">End Hour</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">PIC</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">Type Loan</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">Organization</span></th>
                                                                       
                                                                        
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                    
                                                         
                                                                </tbody>

                                                            </table>
                                                       
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="tabItem3_used">
                                                 <div class="card card-bordered card-preview">
                                                        <div class="card-inner">
                                                        
                                                            <table class=" nk-tb-list nk-tb-ulist table nowrap table-bordered" data-auto-responsive="false" id="example3" style="width:100%;">
                                                                <thead>
                                                                    <tr class="nk-tb-item nk-tb-head">
                                                                    <!--   <th class="nk-tb-col nk-tb-col-check">
                                                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                                <input type="checkbox" class="custom-control-input" id="uid">
                                                                                <label class="custom-control-label" for="uid"></label>
                                                                            </div>
                                                                        </th> -->
                                                                       
                                                                        <th class="nk-tb-col"><span class="sub-text">ID</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">Replacement Reason</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">Room Name</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">Location</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">Loan Date</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">Start Hour</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">End Hour</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">PIC</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">Type Loan</span></th>
                                                                   
                                                                         <th class="nk-tb-col"><span class="sub-text">Actual lecture date</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">Subject Name</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">Class Name</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">Study Program</span></th>
                                                                        
                                                                       
                                                                        
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                    
                                                         
                                                                </tbody>

                                                            </table>
                                                       
                                                        </div>
                                                    </div>
                                                </div>
                                              
                                            </div>
                                        </div>
                                    </div>
                            
                            </div>
                        </div>
                </div>
    </div>
</div>




<div class="modal fade " tabindex="-1" id="modalLoader">
    <div class="modal-dialog modal-sm"  role="document">
        <div class="modal-content" style="background: transparent; box-shadow: none;">
            <div class="row g-gs" id="loader_container_loan" style="justify-content: center;">
            <span class="loader_front" id="loader_front_loan" ></span>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
     function calldata(table, Tab, ajaxUrl) {
         
        $('#'+table).DataTable({
        scrollX:true,
        "processing":true,
        "serverSide":true,
        "order":false,
        "lengthMenu": [30, 60, 90, 120], 
        "pageLength": 30,
        "ajax" : {
            url : ajaxUrl,
            type: "POST",
            // success : function(e) {
            //         // $('#loader_front').hide()
            //         // $('#loader_container').hide()
            // },
            data : function(data){
      
                data.showTab=Tab;
            }

        },
        "columnDefs":[{
            "targets":'_all',
            "orderable":false,
            // render: $.fn.dataTable.render.html()
        }],
        "language": 
        {          
        "processing": "<span class=\"loader_front\"></span>",
        }
     });

        
    }

    function reloadtable(table, tabName, ajaxUrl){
     
        $('#'+table).DataTable().clear().destroy();
        //  $('#'+table).DataTable().ajax.reload()
        calldata(table, tabName, ajaxUrl);
                            console.log('hai y')
     }

      $(document).ready(function () {
            calldata('example','asset loan', '<?php echo base_url('historyAssetLoan') ?>' );

            

      })




</script>

<?= $this->endSection() ?>


<?= $this->extend('partials/footer_layout') ?> 