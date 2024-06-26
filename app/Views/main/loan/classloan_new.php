<?= $this->extend('partials/header_layout') ?>

<?= $this->section('content') ?>

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
                 <div class="nk-content-body">
                            <div class="nk-block-head nk-block-head-sm">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h3 class="nk-block-title page-title">Classroom Loan</h3>
                                 
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
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem1_used "  onclick="reloadtable('example', 'non-academic', '<?php echo base_url('dataJsonClassroomLoan') ?>')">Non-Academic</a>
                                                </li>
                                                <?php if (session()->lectur || session()->type=='admin akademik'|| session()->type=='admin logistik') { ?>
                                                <li class="nav-item nav-item-loan">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem2_used" onclick="reloadtable('example2', 'academic', '<?php echo base_url('dataJsonClassroomLoanRep') ?>')" >Academic (Kelas Pengganti)</a>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                            <div class="tab-content">
                                                  
                                                <div class="tab-pane active" id="tabItem1_used">
                                                    <div class="toggle-wrap nk-block-tools-toggle mb-2">
                                                        
                                                        <ul class="nk-block-tools g-3">
                                                            <li> 
                                                                
                                                                <select class="form-select" id="type_filter" name="type_filter" >
                                                                <option value="all">All</option>
                                                                <option value="organization">Organization</option>
                                                                <option value="other">Other</option>
                                                        
                                                                </select>
                                                            </li>
                                                            <li>
                                                                <div class="form-control-wrap dash-room">
                                                                    <a class="btn btn-round btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalexport">Export to Excel</a>
                                                                    
                                                                </div>
                                                            </li>
                                                            
                                                        </ul>
                                                    
                                                    </div>
                                                    <div class="card card-bordered card-preview">
                                                        <div class="card-inner">
                                                        
                                                            <table class=" nk-tb-list nk-tb-ulist table nowrap table-bordered" data-auto-responsive="false" id="example" style="width:100%;">
                                                                <thead>
                                                                    <tr class="nk-tb-item nk-tb-head">
                                                                    <!--   <th class="nk-tb-col nk-tb-col-check">
                                                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                                <input type="checkbox" class="custom-control-input" id="uid">
                                                                                <label class="custom-control-label" for="uid"></label>
                                                                            </div>
                                                                        </th> -->
                                                                        <th class="nk-tb-col ">action
                                                                        </th>
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
                                                                        <th class="nk-tb-col"><span class="sub-text">organizer Aproval 1</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">organizer Aproval 2</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">LAAK Aproval</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">loan Status</span></th>
                                                                        
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
                                                <div class="tab-pane" id="tabItem2_used">
                                                <div class="toggle-wrap nk-block-tools-toggle mb-2">
                                                        
                                                        <ul class="nk-block-tools g-3">
                                                          
                                                            <li>
                                                                <div class="form-control-wrap dash-room">
                                                                    <a class="btn btn-round btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalexport">Export to Excel</a>
                                                                    
                                                                </div>
                                                            </li>
                                                            
                                                        </ul>
                                                    
                                                    </div>
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
                                                                        <th class="nk-tb-col ">action
                                                                        </th>
                                                                        <th class="nk-tb-col"><span class="sub-text">ID</span></th>
                                                                       
                                                                        <th class="nk-tb-col"><span class="sub-text">Room Name</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">Location</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">replacement Date</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">Start Hour</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">End Hour</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">PIC</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">Type Loan</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">Actual lecture date</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">Subject Name</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">Class Name</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">Study Program</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">Replacement Reason</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">Laak Aproval</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">Laak Aproval Date</span></th>
                                                                        <th class="nk-tb-col"><span class="sub-text">loan Status</span></th>
                                                                        
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


                        <div class="modal fade " tabindex="-1" id="modalEndloan">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <em class="icon ni ni-cross"></em>
                                    </a>
                                    <div class="modal-header">
                                        <h5 class="modal-title">End Loan</h5>
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

                        <div class="modal fade " tabindex="-1" id="modalNotesEndloan">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <em class="icon ni ni-cross"></em>
                                    </a>
                                    <div class="modal-header">
                                        <h5 class="modal-title">Notes End Loan</h5>
                                    </div>
                                    <div class="modal-body" id="mainNotesEndLoan">
                               
                                    </div>  
                                
                                </div>
                            </div>
                        </div>


                        <div class="modal fade " tabindex="-1" id="modalexport">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <em class="icon ni ni-cross"></em>
                                    </a>
                                    <div class="modal-header">
                                        <h5 class="modal-title">Export excel</h5>
                                    </div>
                                    <div class="modal-body" >
                                      
                                    <form id="frmexport">
                                        <div class="row g-4">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="full-name-1">Choose Schoolyear</label>
                                                    <div class="form-control-wrap">
                                                        <select class="form-select" id="schoolyear" name="schoolyear" onchange="">
                                                            <option value="">- pilih tahun ajar -</option>
                                                             <?php foreach ($schoolyear as $value) { ?>
                                                                 <option value="<?php echo $value['set_schoolyear'] ?>"><?php echo format_schoolyear($value['set_schoolyear']) ?></option>
                                                             <?php  } ?>
                                                        </select>
                                                        <div id="schoolyear-error">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="full-name-1">Choose Semester</label>
                                                    <div class="form-control-wrap">
                                                        <select class="form-select" id="semester" name="semester" onchange="">
                                                            <option value="">- pilih semester -</option>
                                                             <option value="1">1</option>
                                                             <option value="2">2</option>
                                                             <option value="antara">Antara</option>
                                                        </select>
                                                        <div id="semester-error">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="full-name-1">Choose Period</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="flatpickr-range" name="period"  placeholder="Enter start date loan" > 
                                                        <div>
                                                            <span class="badge badge-dim bg-info" style="">Kosongkan Jika ingin mencetak dalam 1 semester</span>
                                                        </div>
                                                        <div id="period-error">

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                             <div class="col-12">
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-lg btn-primary" id="buttonExport" onclick="exportExcel()">Check</button>
                                                    <span class="loader" id="loaderExport" style="display: none;"></span>

                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                       
                               
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
                data.type = $('#type_filter').val();
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
            calldata('example', 'non-academic', '<?php echo base_url('dataJsonClassroomLoan') ?>');
           // calldata('example2', 'academic', '<?php echo base_url('dataJsonClassroomLoanRep') ?>');
            $('#type_filter').on('change', function() {
                $('#example').dataTable().fnDraw(false)
            })

              flatpickr('#flatpickr-range', {
                        // dateFormat: "F j, Y", 
                        // maxDate:'<?php echo date('Y-m-d', strtotime('+1 days', strtotime(date('Y-m-d')))) ?>',
                        // minDate:'<?php echo date('Y-m-d', strtotime(date('Y-m-d') . ' + 1 days')) ?>',
                        mode: 'range',
                        static:true,
                        enableTime: false,
                        time_24hr:true,
                        dateFormat: "d M Y",
                        //  plugins: [
                        //     new minMaxTimePlugin({
                        //         table: {
                        //             '<?php echo date('Y-m-d') ?>':minmaxTime,
                        //         }
                        //     })
                        // ]

                    })
             $("#schoolyear").select2({
                         dropdownParent: $("#modalexport"),
                         
                })
             $("#semester").select2({
                         dropdownParent: $("#modalexport"),
                          minimumResultsForSearch: -1

                })
          
      })

      function upStatusClassLoan(aprovalFrom,action, id, type){
        
            if (action=='finish'){
                var titlealert='Yakin ingin akhiri Pinjaman ?'
                var textalert='Data pinjaman akan berakhir'
                var msgsuccess='Loan has been Ended';
            }else if(action=='accept'){
                var titlealert='Yakin ingin menerima Pinjaman Ruang Kelas ?'
                var textalert='Data pinjaman akan Diterima'
                var msgsuccess='Loan has been Accepted';
            }else{
                var titlealert='Yakin ingin menolak Pinjaman Ruang Kelas?'
                var textalert='Data pinjaman akan di tolak'
                var msgsuccess='Loan has been rejected'; 
            }

            Swal.fire({
                title: titlealert,
                text: textalert,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                            url:"<?php echo base_url('statusClassLoanUp') ?>",
                            global:false,
                            async:true,
                            type:'post',
                            dataType:'json',
                            data: ({
                                id_loan:id,
                                action : action,
                                aprovalFrom:aprovalFrom,
                                reqType:type,
                            }),
                            beforeSend: function () {
                                                        
                                            $("#modalLoader").modal('show');
                                                        
                                        },
                            success : function(e) {

                                    $("#modalLoader").modal('hide');
                                if(e.status == 'ok;') 
                                {

                                let timerInterval
                                Swal.fire({
                                    icon: 'success',
                                    title: msgsuccess,
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
                        },
                        error :function(xhr, status, error) {
                            alert(xhr.responseText);
                        }
                    });
                }
            })
      }


function deletedata(id) {
     Swal.fire({
      title: 'Yakin Ingin menghapus data ?',
      text: "Data tidak akan bisa kembali",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
         url:"<?php echo base_url('CLassloanDelete') ?>",
         global:false,
         async:true,
         type:'post',
         dataType:'json',
         data: ({
            id_loan:id,
           
        }),
         success : function(e) {
             if(e.status == 'ok;') 
             {

              let timerInterval
              Swal.fire({
                icon: 'success',
                title: ' Data has been Deleted',
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
      },
      error :function(xhr, status, error) {
          alert(xhr.responseText);
      }

  });


    }
 })
}

    function exportExcel() {
        var form_data = new FormData($('#frmexport')[0]);
        $.ajax({
            url: "<?php echo base_url('exportExcel') ?>",
            global: false,
            async: true,
            type: 'post',
            processData: false,
            contentType: false,
            dataType: 'json',
            enctype: "multipart/form-data",
            data: form_data,
            beforeSend: function() {
                $('#buttonExport').hide()
                $('#loaderExport').show()
            },
            success: function(e) {
                if (e.status == 'ok;') {
                    $('#buttonExport').show()
                    $('#loaderExport').hide()
                    let timerInterval
                   
                                window.location.href=e.path
                

                } else {
                    // console.log(e.dataname);
                    $('#buttonExport').show()
                    $('#loaderExport').hide()
                    $.each(e.dataname, function(key, value) {
                        document.getElementById(key + "-error").innerHTML = "";
                    });
                    $.each(e.data, function(key, value) {


                        document.getElementById(key + "-error").innerHTML = `<span class="badge badge-dim bg-danger" style="">` + value + `
                                                                        </span>`;
                    });
                    // document.getElementById("signature_m-error").innerHTML ="";

                    $('#buttonExport').show()
                    $('#loaderExport').hide()
                    $("#modaltambah").modal('show');
                }
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }

        });
    }



function endLoanForm(id,pathEvidence, EmpLoaner){
    console.log(EmpLoaner)
    if (EmpLoaner){
        Swal.fire({
            title: 'Yakin Ingin Mengakhiri pinjaman ?',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Yes!'
            }).then((result) => {
            if (result.isConfirmed) {
                EndLoan(id)
            }
        })
    }else{
        var html=`  <div class="example-alert">
                        <div class="alert alert-warning alert-icon">
                        <em class="icon ni ni-alert-circle"></em> Request Belum Dilakukan oleh peminjam
                    </div>
                </div>`
        if (pathEvidence!=''){
        html = ` <img src="${pathEvidence}" alt="Deskripsi gambar"  style="border: 0px solid black;">
                    <div class="form-group pt-2">
                    <button type="button" id="buttonEndLoan" class="btn btn-md btn-success" onclick="EndLoan('${id}')">End Loan</button>
                    <span class="loader" id="loaderEndLoan" style="display: none;"></span>
                    <button type="button" id="buttonSendNote" class="btn btn-md btn-warning" onclick="NotesReqLoan(${id})">Send Whatsapp Note</button>
                    <span class="loader" id="loaderSendNote" style="display: none;"></span>
                </div>`
        }

    
        $('#mainEndLoan').html(html);
        $("#modalEndloan").modal('show');
    }
}

function EndLoanAsLoaner(id, subpathEvidence, sizeFile, loaner){
            var sessionLectur='<?php echo session()->nip_emp ?>';
             var sessionadmin='<?php echo session()->type ?>';
            var btnName=sessionLectur==loaner &&sessionadmin=='admin akademik'?'End Loan': 'Request End Loan';
           var html=` <form id="frmendloan">
                    
                  <div class="form-group">
                      <label class="form-label " for="cf-full-name">Photo Room</label>
                      <input type="hidden" name="id_class_loan" value="${id}">
                      <input type="hidden" name="nip_nim_loaner" value="${loaner}">
                       <input type="hidden" name="oldevidence" value="${subpathEvidence}"> 
                      <input type="file" class="FilePond-photoroom" accept="image/*">
                   <div id="photo_room-error">
                      </div>
               </div>
               
             
               <div class="form-group">
                   <button type="button" id="buttonEndLoan" class="btn btn-lg btn-primary" onclick="reqEndLoan()">${btnName}</button>
                   <span class="loader" id="loaderEndLoan" style="display: none;"></span>
               </div>
            </form>`
        $("#mainEndLoan").html(html);

          
                var EvidencePath=''
                if (subpathEvidence!='' ){
                    var evidance_end_loan='assets/evidance_end_loan/'+subpathEvidence
                    var filename=subpathEvidence.split('/')
                    var size = sizeFile
                    EvidencePath=[{
                        source:evidance_end_loan,
                        options:{
                            type:'local',
                            file:{
                                name:filename[1],
                                size:size
                            }
                        }
                    }]
                }
            FilePond.registerPlugin(FilePondPluginFileValidateType);
            FilePond.registerPlugin(FilePondPluginImagePreview);
            FilePond.registerPlugin(FilePondPluginFileValidateSize);

            FilePond.create(document.querySelector(".FilePond-photoroom"), {
                credits: null,
                allowImagePreview: true,
                allowImageFilter: false,
                allowImageExifOrientation: false,
                required: true,
                allowImageCrop: false,
                name: 'file_evidence',
                storeAsFile: true,
                labelIdle: 'Upload Evidence Condition Room (jpg,png,jpeg)',
                acceptedFileTypes: ["image/png", "image/jpg", "image/jpeg"],
                fileValidateTypeDetectType: (source, type) =>
                    new Promise((resolve, reject) => {
                        // Do custom type detection here and return with promise
                        resolve(type);
                    }),
                files:EvidencePath,
                server: {
                    load: (source, load, error, progress, abort, headers) => {
                   
                        error('oh my goodness');

                    
                        progress(true, 0, 1024);
                        var file='<?php echo base_url('assets/evidance_end_loan/')  ?>';
                    
                        load(file);

                        return {
                            abort: () => {
                          
                                abort();
                            },
                        };
                    },
                },
            });
        $("#modalEndloan").modal('show');
      }

      function reqEndLoan()
        {
            var form_data = new FormData($('#frmendloan')[0]);
               $.ajax({
                 url:"<?php echo base_url('reqEndLoan') ?>",
                 global: false,
                async: true,
                type: 'post',
                processData: false,
                contentType: false,
                dataType: 'json',
                enctype: "multipart/form-data",
                data: form_data,
                beforeSend: function () {
                    $('#buttonEndLoan').hide()
                    $('#loaderEndLoan').show()
                  },
                 success : function(e) {
                   if(e.status == 'ok;') 
                   {
                        $('#buttonEndLoan').show()
                        $('#loaderEndLoan').hide()
                    let timerInterval
                      Swal.fire({
                        icon: 'success',
                        title: ' Data has been Saved',
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
                   // console.log(e.dataname);
                     $('#buttonEndLoan').show()
                     $('#loaderEndLoan').hide()
                    
                     document.getElementById("photo_room-error").innerHTML =`<span class="badge badge-dim bg-danger" style="">${e.text}
                                                                        </span>`;
                       
                    $("#modalEndloan").modal('show');
                 }
              },
              error :function(xhr, status, error) {
               alert(xhr.responseText);
            }

         });
        }

function EndLoan(id){
    $.ajax({
         url:"<?php echo base_url('EndCLassLoan') ?>",
         global:false,
         async:true,
         type:'post',
         dataType:'json',
         data: ({
            id_class_loan:id,
           
        }),
         success : function(e) {
             if(e.status == 'ok;') 
             {

              let timerInterval
              Swal.fire({
                icon: 'success',
                title: ' Loan has been Ended',
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
      },
      error :function(xhr, status, error) {
          alert(xhr.responseText);
      }

  });

}


function NotesReqLoan(id){
    var html=` <form id="frmNotesendloan">
                    
                    <div class="form-group">
                        <label class="form-label " for="cf-full-name">Notes</label>
                        <input type="hidden" name="id_class_loan" value="${id}">
                         
                        <textarea name="Notes" class="form-control">  </textarea>
                     <div id="Notes-error">
                        </div>
                 </div>
                 
               
                 <div class="form-group">
                     <button type="button" id="buttonNotesLoan" class="btn btn-lg btn-primary" onclick="sendNotes()">Send Notes</button>
                     <span class="loader" id="loaderNotesLoan" style="display: none;"></span>
                 </div>
              </form>`
          $("#mainNotesEndLoan").html(html);
          $("#modalNotesEndloan").modal('show');
}

function sendNotes(){
    var form_data = new FormData($('#frmNotesendloan')[0]);

    $.ajax({
        url:"<?php echo base_url('sendNotesLoan') ?>",
        global:false,
        async:true,
        type:'post',
        processData: false,
        contentType: false,
        dataType:'json',
        enctype: "multipart/form-data",
        data: form_data,
        beforeSend: function () {
                            $('#buttonNotesLoan').hide()
                            $('#loaderNotesLoan').show()
                },
        success : function(e) {
        if(e.status == 'ok;') 
        {
            $('#buttonAddReqClass').show()
            $('#loaderNotesLoan').hide()
            let timerInterval
            Swal.fire({
                icon: 'success',
                title: ' Notes has been send',
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
            $('#buttonNotesLoan').show()
            $('#loaderNotesLoan').hide()
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


<?= $this->extend('partials/footer_layout') ?>