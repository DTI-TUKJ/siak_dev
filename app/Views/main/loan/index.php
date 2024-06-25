<?= $this->extend('partials/header_layout') ?>

<?= $this->section('content') ?>

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Data Loan</h3>
       
                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <div class="drodown">
                                                <a title="tambah data" class="dropdown-toggle btn btn-icon btn-primary" onclick="modalTambah()"><em class="icon ni ni-plus"></em></a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div><!-- .toggle-wrap -->
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="card card-bordered card-preview">
                                        <div class="card-inner">
                                           
                                            <table class=" nowrap table" data-auto-responsive="false" id="example" style="min-width:1425px;">
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
                                                        <th class="nk-tb-col"><span class="sub-text">Nip</span></th>
                                                       <th class="nk-tb-col"><span class="sub-text">Name</span></th>
                                                        <th class="nk-tb-col"><span class="sub-text">Activity</span></th>
                                                        <th class="nk-tb-col"><span class="sub-text">Destination </span></th>
                                                        <th class="nk-tb-col"><span class="sub-text">Unit</span></th>
                                                        <th class="nk-tb-col"><span class="sub-text">Asset Name</span></th>
                                                          <!-- <th class="nk-tb-col"><span class="sub-text">Loan Amount</span></th> -->
                                                        <th class="nk-tb-col"><span class="sub-text">Request Date</span></th>
                                                        <th class="nk-tb-col"><span class="sub-text">Loan Date start</span></th>
                                                        <th class="nk-tb-col"><span class="sub-text">Loan Date End</span></th>
                                                        <th class="nk-tb-col"><span class="sub-text">Date in</span></th>
                                                        
                                                       
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


<div class="modal fade " role="dialog" aria-hidden="true" id="modaltambah">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Check Schedule</h5>
            </div>
            <div class="modal-body" id="mainTambah">

         

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
                <h5 class="modal-title">Add Loan</h5>
            </div>
            <div class="modal-body" id="mainAdd">

                
       
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
            url : '<?php echo base_url('dataJsonLoan') ?>',
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


    function modalTambah(){
         console.log("modalopen")
        var data =<?php echo json_encode($data_asset) ?>;
        var option=``;
        $.each(data, function(key, value) {
            option+=`<option value="${value['id_asset']}">${value['asset_name']}</option>`
        })
       
        let html =`           <form id="frmcheck">
                      <div class="row g-4">

                         <div class="form-group">
                                <label class="form-label " for="asset_name">Choose Item</label>
                                <div class="form-control-wrap">
                                     <select class="form-select" id="asset_name" name="asset_name" >
                                        <option value="">-Pilih Asset-</option>
                                       ${option}
                                        
                                    </select>
                                </div>
                                <div id="asset_name-error">

                                </div>
                                <label class="form-label mt-3" for="full-name-1">Loan Date</label>
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
                                <button type="button" class="btn btn-lg btn-primary" id="buttonsave" onclick="CheckSchedule()">Check</button>
                                <span class="loader" id="loader" style="display: none;"></span>

                            </div>
                        </div>
                    </div>
                </form>`
                $('#mainTambah').html(html);
               $("#asset_name").select2({
                dropdownParent: $("#modaltambah"),
                // disabled:true
              });

                flatpickr('#flatpickr-range', {
                    // dateFormat: "F j, Y", 
                    // maxDate:'<?php echo date('Y-m-d', strtotime('+1 days', strtotime(date('Y-m-d')))) ?>',
                    minDate:'<?php echo date('Y-m-d') ?>',
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
                  $("#modaltambah").modal('show');
    }

      $(document).ready(function () {
            calldata();


     FilePond.registerPlugin(FilePondPluginFileValidateType);
     FilePond.registerPlugin(FilePondPluginImagePreview);
     FilePond.registerPlugin(FilePondPluginFileValidateSize);

     FilePond.create(document.querySelector(".image-preview-filepond"), {
          credits: null,
          allowImagePreview: true,
          allowImageFilter: false,
          allowImageExifOrientation: false,
          required: true,
          allowImageCrop: false,
          name: 'asset_image',
          storeAsFile:true,
          labelIdle:  'Upload Asset Image (jpg,png,jpeg)',
          acceptedFileTypes: ["image/png", "image/jpg", "image/jpeg"],
          fileValidateTypeDetectType: (source, type) =>
            new Promise((resolve, reject) => {
              // Do custom type detection here and return with promise
              resolve(type);
            }),
        });
      })

function CheckSchedule(){
       var html='';
       var option='';
      var driver='';
      var destination=''
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
                                            driver +=`<div class="col-lg-6">
                                                <div class="form-group">
                                                  
                                                    <div class="custom-control custom-checkbox">
                                                         <input type="checkbox" class="custom-control-input" id="driver" name="driver" value="1">    
                                                         <label class="custom-control-label" for="driver">Driver</label>
                                                    </div>
                                                    <div id="driver-error">

                                                    </div>
                                                </div>
                                            </div>`

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
                                        }
                                    }
                                });

                               html +=`
                                        <form id="frmAdd">
                                          <div class="row g-4"  >
                                         
                                             <input type="hidden" name="id_asset" value="${e.data.id_asset}">
                                            
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
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="nip">PIC</label>
                                                    <div class="form-control-wrap">
                                                  
                                                            <select class="form-select" id="nip" name="nip" >
                                                                <option value="">- Pilih PIC -</option>
                                                            
                                                                
                                                            </select>
                                                    </div>
                                                    <div id="nip-error">

                                                    </div>
                                                </div>
                                            </div>
                                     
                                        
                                            
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="activity">Activity Name</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" value="" name="activity" id="activity" placeholder="Enter Activity" >
                                                    </div>
                                                    <div id="activity-error">

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
                                            
                                              ${driver}
                                           

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
                                $("#nip").select2({
                                    dropdownParent: $("#modalAdd"),
                                    ajax: {
                                        url: "getNip",
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
                                        $('.select2-search__field').attr('placeholder', 'Search NIP or Name');
                                    });
                                $("#modaltambah").modal('hide');
                                $("#modalAdd").modal('show');
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
         url:"<?php echo base_url('loanDelete') ?>",
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
                title: ' Data has been Save',
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

function upStatusLoan(id,action, email, notlp){

   if (action=='finish'){
     var titlealert='Yakin ingin akhiri Pinjaman ?'
     var textalert='Data pinjaman akan berakhir'
     var msgsuccess='Loan has been Ended';
   }else if(action=='accept'){
     var titlealert='Yakin ingin menerima Pinjaman ?'
     var textalert='Data pinjaman akan Diterima'
     var msgsuccess='Loan has been Accepted';
   }else{
     var titlealert='Yakin ingin menolak Pinjaman ?'
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
         url:"<?php echo base_url('statusLoanUp') ?>",
         global:false,
         async:true,
         type:'post',
         dataType:'json',
         data: ({
            id_loan:id,
            action : action,
            email:email,
            no_tlp:notlp
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


</script>

<?= $this->endSection() ?>


<?= $this->extend('partials/footer_layout') ?>