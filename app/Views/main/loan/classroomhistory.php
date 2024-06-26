<?= $this->extend('partials/header_layout') ?>

<?= $this->section('content') ?>

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">My Loan</h3>
       
                        </div><!-- .nk-block-head-content -->
                       
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="card card-bordered card-preview">
                                        <div class="card-inner">
                                           
                                            <table class=" nk-tb-list nk-tb-ulist table" data-auto-responsive="false" id="example" style="min-width:1575px;">
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

                                                    
                                                      <!--  <td class="nk-tb-col nk-tb-col-check">
                                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                <input type="checkbox" class="custom-control-input" id="uid1">
                                                                <label class="custom-control-label" for="uid1"></label>
                                                            </div>
                                                        </td> -->
                                                         <!--       <ul class="list-status">
                                                                <li><em class="icon text-success ni ni-check-circle"></em> <span>Email</span></li>
                                                                <li><em class="icon ni ni-alert-circle"></em> <span>KYC</span></li>
                                                            </ul> -->
                                                   
                                                </tbody>

                                            </table>
                                          <!--   <div class="row g-gs" id="loader_container" style="justify-content: center;">
                                                        <span class="loader_front" id="loader_front" style="margin-top:5%;"></span>
                                            </div> -->
                                        </div>
                                    </div>
            </div>
        </div>
    </div>
</div>

                        <div class="modal fade " tabindex="-1" id="modalEndloan">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <em class="icon ni ni-cross"></em>
                                    </a>
                                    <div class="modal-header">
                                        <h5 class="modal-title">Form End Loan</h5>
                                    </div>
                                    <div class="modal-body" id="mainEndLoan">
                                      
                                           
                                       
                               
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
     function calldata() {
         
        $('#example').DataTable({
        scrollX:true,
        "processing":true,
        "serverSide":true,
        "order":false,
        "lengthMenu": [30, 60, 90, 120], 
        "pageLength": 30,
        "ajax" : {
            url : '<?php echo base_url('dataJsonHistoriClassLoan') ?>',
            type: "POST",
            // success : function(e) {
            //         // $('#loader_front').hide()
            //         // $('#loader_container').hide()
            // },
            // data : function(data){
            //     // data.periode =document.getElementById('bulan').value;
            // }

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

     function reloadtable() {
                                         
        $('#example').dataTable().fnDraw(false)

    }

      $(document).ready(function () {
            calldata();

            

      })



</script>

<?= $this->endSection() ?>


<?= $this->extend('partials/footer_layout') ?>