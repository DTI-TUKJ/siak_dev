<?= $this->extend('partials/header_layout' ) ?>

<?= $this->section('content') ?>
	        <div class="nk-content ">
                <div class="container-fluid">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
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
                                                <li class="nav-item nav-item-loan">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem1_used" onclick="reloadtable('example', 'KAMPUS A')" >Kampus A</a>
                                                </li>
                                               
                                                <li class="nav-item nav-item-loan">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem2_used" onclick="reloadtable('example2', 'KAMPUS B')" >Kampus B</a>
                                                </li>
                                                <li class="nav-item nav-item-loan_classroom">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem3_used"  onclick="reloadtable('example3', 'KAMPUS C')" >Kampus C</a>
                                                </li>
                                            
                                            </ul>
                                            <div class="tab-content">
                                             
                                                <div class="tab-pane active" id="tabItem1_used">
                                                    <div class="row toggle-wrap nk-block-tools-toggle mb-2 g-gs">
                                                        
                                                      <div class="col-sm-2" style="min-width: 125px;">
                                                                
                                                                <input type="text" class="form-control" id="flatpickr-range" name="loan_date_start" placeholder="Enter start date loan"> 
                                                            
                                                      </div>
                                                      <div class="col-sm-2" style="min-width: 175px;">
                                                            <div class="form-control-wrap dash-room">
                                                                <select class="form-select" id="room_name" name="room_name" style="width: 300px;">
                                                            
                                                                </select>

                                                            
                                                            </div>
                                                         
                                                        </div>
                                                        <div class="col-sm-1" style="min-width: 125px;">
                                                            <div class="form-control-wrap dash-room">
                                                            <a class="btn btn-round btn-sm btn-primary" onclick="bookRoom('<?php echo session()->permission_loan; ?>')">Book Room</a>
                                                            
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1" style="min-width: 325px;">
                                                                    <div class="example-alert">
                                                                        <div class="alert alert-info alert-icon">
                                                                            <em class="icon ni ni-alert-circle"></em> Peminjaman dilakukan minimal H-3
                                                                        </div>
                                                                    </div>
                                                        </div>
                                              
                                                    
                                                    </div>
                                                    <div class="row g-gs kontenproduk_loan"  id="kontenproduk_loan" style="justify-content: center;">
                                                                
                                                    <table class=" nk-tb-list nk-tb-ulist table table-bordered " data-auto-responsive="false" id="example" style="width:100%;">
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
                                                <div class="tab-pane" id="tabItem2_used">
                                                        <div class="row toggle-wrap nk-block-tools-toggle mb-4 g-s">
                                                            
                                                        
                                                            <div class="col-sm-1" style="min-width: 125px;"> 
                                                                        
                                                                        <input type="text" class="form-control" id="flatpickr-range2" name="loan_date_start" placeholder="Enter start date loan"> 
                                                                    
                                                            </div>
                                                            <div class="col-sm-1" style="min-width: 175px;">
                                                                    <div class="form-control-wrap dash-room">
                                                                        <select class="form-select" id="room_name2" name="room_name2" style="width: 300px;">
                                                                    
                                                                        </select>

                                                                    
                                                                    </div>
                                                                
                                                            </div>
                                                            <div class="col-sm-1" style="min-width: 125px;">
                                                                        <div class="form-control-wrap dash-room">
                                                                        <a class="btn btn-round btn-sm btn-primary" onclick="bookRoom('<?php echo session()->permission_loan; ?>')">Book Room</a>
                                                                        
                                                                        </div>
                                                            </div>
                                                            <div class="col-sm-1" style="min-width: 325px;">
                                                                        <div class="example-alert">
                                                                            <div class="alert alert-info alert-icon">
                                                                                <em class="icon ni ni-alert-circle"></em> Peminjaman dilakukan minimal H-3
                                                                            </div>
                                                                        </div>
                                                            </div>
                                                        
                                                        </div>
                                                        <div class="row g-gs kontenproduk_loan_car"  id="kontenproduk_loan_car" style="justify-content: center;">
                                                                
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
                                                <div class="tab-pane" id="tabItem3_used">
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
                     
                    </div>
                </div>
            </div>



 <div class="modal fade " tabindex="-1" id="modalRequestRoomLoan">
    <div class="modal-dialog modal-lg" role="document">
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
                                    data.date=document.getElementById('flatpickr-range').value;
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


 
            
                    function reloadtable(table,kampus){
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

            function bookRoom(permission){
                    const waktuSekarang = new Date();
                    const jamSekarang = waktuSekarang.getHours();

                    if (jamSekarang >= 8 && jamSekarang <= 19){
                        if (permission=='1'){  
                            var checkedValues = [];
                            var count = $("input[type=checkbox]:checked").length;
                            if (count==0){
                                Swal.fire({
                            icon: 'error',
                            title: 'Pilih setidaknya satu jadwal',
                            })
                            }else{
                            
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
                                                
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="type_loan">Request Type</label>
                                                            <div class="form-control-wrap">
                                                                <select class="form-select" id="type_loan" name="type_loan">
                                                                    <option value="">- Choose Request Type -</option>
                                                                    <option value="other">Other</option>
                                                                    <option value="organization">Organization</option>
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

                                                    <div class="col-lg-12">
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
                                            dropdownParent: $("#modalRequestRoomLoan"),
                                            minimumResultsForSearch: -1

                                        })

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
                                            
                                        }else{
                                            $("#selectOrganization").addClass("none-view");
                                            
                                                
                                        }
                                        
                                        });

                                        // // get first value as start date
                                        // console.log(checkedValues[0])
                                        // //get last value as end date
                                        // console.log(checkedValues[checkedValues.length-1])
                                        
                                        // console.log(checkSametime.length)
                                    
                                            $("#modalRequestRoomLoan").modal('show');
                                        
                                    }else{
                                        Swal.fire({
                                        icon: 'warning',
                                        title: 'Terdapat jadwal yang terisi/tidak dipilih di rentang waktu yang anda pilih',
                                    })
                                    }
                                    
                                }else{
                                    Swal.fire({
                                    icon: 'warning',
                                    title: 'Harap pilih jadwal di hari yang sama',
                                    })
                                }
                            
                                
                            }
                        
                        }else{
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Akun Anda Tidak Memiliki izin silahkan hubungi Admin LAAK untuk membuka perizinan',
                                    })
                        } 
                    } else {
                        Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Request Peminjaman dapat dilakukan dari jam 08.00 - 16.00 WIB",
                                            
                        });
                    }   
                }


                    

               $(document).ready(function(){
                  // var param=document.getElementById('s_cat_available').value;
                  // var param_status=document.getElementById('s_cat_loan').value;
                  // console.log(param)

                 
                  
                    var curdate='<?php echo date('d M Y', strtotime(date('d M Y') . ' + 3 days')) ?>'
                     var MaksimalDate = '<?php echo $dataSettingApp['date_cutoff_req_set'] ?>'
                
                    
                    
                    flatpickr('#flatpickr-range', {
                            // dateFormat: "F j, Y", 
                            minDate:'<?php echo date('Y-m-d', strtotime(date('Y-m-d') . ' + 3 days')) ?>',
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
                            minDate:'<?php echo date('Y-m-d', strtotime(date('Y-m-d') . ' + 3 days')) ?>', 
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
                            minDate:'<?php echo date('Y-m-d', strtotime(date('Y-m-d') . ' + 3 days')) ?>', 
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

                            
                        calldata('example', 'KAMPUS A')
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

                // Given time string
              
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
                                // $('#buttonaddReqClass').show()
                                // $('#loaderaddReqClass').hide()
                                $("#modalRequestRoomLoan").modal('show');
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
