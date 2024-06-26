<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Dukungan Teknologi Informasi Telkom University Jakarta">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Solusi Administrasi Peminjaman Logistik Telkom University Jakarta: Pengelolaan efisien untuk kebutuhan logistik di lingkungan kampus.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="<?php echo base_url('') ?>images/logo_telkom_university.png">
    <!-- Page Title  -->
    <title>Siak ( Sistem Informasi Asset Kampus) | Telkom University Jakarta</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="<?php echo base_url('') ?>assets/css/dashlite.css?ver=3.2.0">
    <link id="skin-red" rel="stylesheet" href="<?php echo base_url('') ?>assets/css/skins/theme-red.css?ver=3.2.0">
    <link rel="stylesheet" href="<?php echo base_url('') ?>assets/extension/filepond/filepond.css">
      
    <link rel="stylesheet" href="<?php echo base_url('') ?>assets/extension/toastify-js/src/toastify.css">
    <link rel="stylesheet" href="<?php echo base_url('') ?>assets/extension/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
    <link rel="stylesheet" href="<?php echo base_url('') ?>assets/css/custom.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/brands.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/fontawesome.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/solid.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/regular.min.css" />
<!-- <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
<script defer src="https://use.fontawesome.com/releases/v5.15.4/js/solid.js" integrity="sha384-/BxOvRagtVDn9dJ+JGCtcofNXgQO/CCCVKdMfL115s3gOgQxWaX/tSq5V8dRgsbc" crossorigin="anonymous"></script>
<script defer src="https://use.fontawesome.com/releases/v5.15.4/js/fontawesome.js" integrity="sha384-dPBGbj4Uoy1OOpM4+aRGfAOc0W37JkROT+3uynUgTHZCHZNMHfGXsmmvYTffZjYO" crossorigin="anonymous"></script> -->

    <!-- <script type="text/javascript" src="<?php echo base_url('') ?>jquery/jquery-2.1.1.min.js"></script> -->
     <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

   <!--  <script src="<?php echo base_url('') ?>assets/sweetalert/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url('') ?>assets/sweetalert/sweetalert2.min.css">
    <link rel="stylesheet" href="<?php echo base_url('') ?>assets/extension/flatpcker/monthselect/style.css">
    <link rel="stylesheet" href="<?php echo base_url('') ?>assets/extension/flatpcker/flatpickr.min.css" /> -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css">
    <link rel=stylesheet href=https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/style.css>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css"
        integrity="sha512-MQXduO8IQnJVq1qmySpN87QQkiR1bZHtorbJBD0tzy7/0U9+YIC93QWHeGTEoojMVHWWNkoCp8V6OzVSYrX0oQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- DataTables -->
        <link href="<?php echo base_url('') ?>assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo base_url('') ?>assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />


        <!-- Responsive datatable examples -->
        <link href="<?php echo base_url('') ?>assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" /> 

         <?php if  ($_SERVER['REQUEST_URI']!='/Siak/User' && $_SERVER['REQUEST_URI']!='/Siak/loanHistory') {?>
         <style type="text/css">     
            .dataTables_wrapper .dataTables_filter {
                float: right;
                position: relative;
                right: 50px;
            /*    right: 30px;*/
            /*    text-align: right*/

            }
            .dataTables_wrapper .dataTables_filter  {
                float: right;
                position: relative;
                right: 50px;
            /*    right: 30px;*/
            /*    text-align: right*/

            }
            .dataTables_wrapper .dataTables_paginate{
              float: right;
                position: relative;
                right: 3px;
                top: 5px;
            }
            .dataTables_wrapper .dataTables_length,
                .dataTables_wrapper .dataTables_filter {
                    margin-bottom: 10px;
                }

            .dataTables_wrapper .dataTables_filter input {
                border: 1px solid #aaa;
                border-radius: 3px;
                padding: 5px;
                background-color: transparent;
                margin-left: 3px;

            }
            @media screen and (max-width: 640px) {

                .dataTables_wrapper .dataTables_length,
                .dataTables_wrapper .dataTables_filter {
                    float: none;
                    text-align: center
                }

                .dataTables_wrapper .dataTables_filter {
                    margin-top: .5em
                }
            }
         </style>
     <?php  } ?>
      <style type="text/css">
            .cut-text{
              max-width: 180px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
    /*        transition:  white-space 5s ease;*/
        }

        .cut-text:hover{
             white-space: normal;
        }

     </style>
</head>

<body class="nk-body bg-lighter no-touch nk-nio-theme ui-softy">
    <div class="nk-app-root">
        <!-- wrap @s -->
        <div class="nk-wrap ">
            <!-- main header @s -->
            <div class="nk-header nk-header-fixed is-theme">
                <div class="container-fluid">
                    <div class="nk-header-wrap">
                        <div class="nk-menu-trigger me-sm-2 d-lg-none">
                            <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em class="icon ni ni-menu"></em></a>
                        </div>
                        <div class="nk-header-brand">
                            <a href="html/index.html" class="logo-link">
                                <img class="logo-light logo-img"  src="<?php echo base_url('') ?>/images/logo_siak_putih.png" srcset="<?php echo base_url('') ?>/images/logo_siak_putih.png 2x" alt="logo">
                                <img class="logo-dark logo-img" src="<?php echo base_url('') ?>/images/logo_siak_putih.png" srcset="<?php echo base_url('') ?>/images/logo_siak_putih.png 2x" alt="logo-dark">
                            </a>
                        </div><!-- .nk-header-brand -->
                        <div class="nk-header-menu ms-auto" data-content="headerNav">
                            <div class="nk-header-mobile">
                                <div class="nk-header-brand">
                                    <a href="html/index.html" class="logo-link">
                                        <img class="logo-light logo-img" src="<?php echo base_url('') ?>/images/logo_siak.png" srcset="<?php echo base_url('') ?>/images/logo_siak.png 2x" alt="logo">
                                        <img class="logo-dark logo-img" src="<?php echo base_url('') ?>/images/logo_siak.png" srcset="<?php echo base_url('') ?>/images/logo_siak.png 2x" alt="logo-dark">
                                    </a>
                                </div>
                                <div class="nk-menu-trigger me-n2">
                                    <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em class="icon ni ni-arrow-left"></em></a>
                                </div>
                            </div>
                            <ul class="nk-menu nk-menu-main ui-s2">
                                <li class="nk-menu-item has-sub">
                                    <a href="<?php echo base_url('Siak') ?>" class="nk-menu-link">
                                        <span class="nk-menu-text">Dashboards</span>
                                    </a>
                                    
                                </li>
                            <?php if(session()->numberid==null) { ?>
                                <?php if(session()->type!='pegawai') { ?>
                                    <?php if(session()->type!='admin akademik') { ?>
                                    <li class="nk-menu-item has-sub">
                                        <a href="<?php echo base_url('Siak/MyAsset') ?>" class="nk-menu-link">
                                            <span class="nk-menu-text">My Asset</span>
                                        </a>
                                        
                                    </li>
                                    <li class="nk-menu-item has-sub">
                                        <a href="<?php echo base_url('Siak/DataLoan') ?>" class="nk-menu-link">
                                            <span class="nk-menu-text">Loan</span>
                                        </a>
                                        
                                    </li>
                                    <?php } ?><!-- .nk-menu-item -->
                                    <?php  if (session()->type=='superadmin') {?>
                                    <li class="nk-menu-item has-sub">
                                        <a href="<?php echo base_url('Siak/User') ?>" class="nk-menu-link">
                                            <span class="nk-menu-text">Users Admin</span>
                                        </a>
                                        
                                    </li><!-- .nk-menu-item -->
                                    <li class="nk-menu-item has-sub">
                                        <a href="<?php echo base_url('Siak/DataEmployee') ?>" class="nk-menu-link">
                                            <span class="nk-menu-text">Employee </span>
                                        </a>
                                        
                                    </li><!-- .nk-menu-item -->
                                    <?php } ?>
                                    <?php if (session()->type=='admin akademik'||session()->type=='superadmin') { ?>
                                    <li class="nk-menu-item has-sub">
                                        <a href="<?php echo base_url('Siak/Organization') ?>" class="nk-menu-link">
                                            <span class="nk-menu-text">Organization</span>
                                        </a>
                                        
                                    </li>
                                    <li class="nk-menu-item has-sub">
                                        <a href="<?php echo base_url('Siak/Student') ?>" class="nk-menu-link">
                                            <span class="nk-menu-text">Student</span>
                                        </a>
                                        
                                    </li>
                                        
                                <?php }
                                }  ?>

                               <?php if(session()->type=='pegawai' || session()->type=='admin akademik' ) { ?>
                                <li class="nk-menu-item has-sub">
                                    <a href="<?php echo base_url('Siak/MyLoan') ?>" class="nk-menu-link">
                                        <span class="nk-menu-text">My Loan </span>
                                    </a>
                                    
                                </li>
                               <?php }
                               
                         
                               } ?> 

                                <?php if (session()->type=='student' || (session()->lectur && !session()->pembina)){ ?>

                                    <li class="nk-menu-item has-sub">
                                        <a href="<?php echo base_url('Siak/MyClassLoan') ?>" class="nk-menu-link">
                                            <span class="nk-menu-text">My Classroom Loan </span>
                                        </a>
                                        
                                    </li>
                                <?php } ?>


                                <?php if (session()->pembina || session()->type=='admin akademik' || session()->type=='admin logistik'){ ?>

                                <li class="nk-menu-item has-sub">
                                    <a href="<?php echo base_url('Siak/Classroomloan') ?>" class="nk-menu-link">
                                        <span class="nk-menu-text">Classroom Loan </span>
                                    </a>
                                    
                                </li>
                                <?php } ?>

                              <li class="nk-menu-item has-sub">
                                    <a href="<?php echo session()->type!='student'?base_url('Siak/loanHistory'):base_url('Siak/HistoryClassLoan'); ?>" class="nk-menu-link">
                                        <span class="nk-menu-text">Loan History </span>
                                    </a>
                                    
                                </li>
                                <!-- <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-text">Components</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item has-sub">
                                            <a href="#" class="nk-menu-link">
                                                <span class="nk-menu-text">Ui Elements</span>
                                            </a>
                                            
                                        </li>
                                        
                                    </ul>
                                </li> -->
                            </ul><!-- .nk-menu -->
                        </div><!-- .nk-header-menu -->
                        <div class="nk-header-tools">
                            <ul class="nk-quick-nav">
                                <!--<li class="dropdown chats-dropdown">
                                    <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                                        <div class="icon-status icon-status-na"><i class="icon fa-solid fa-bell"></i></div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end">
                                        <div class="dropdown-head">
                                            <span class="sub-title nk-dropdown-title">Recent Chats</span>
                                            <a href="#">Setting</a>
                                        </div>
                                        <div class="dropdown-body">
                                            <ul class="chat-list">
                                                <li class="chat-item">
                                                    <a class="chat-link" href="html/apps-chats.html">
                                                        <div class="chat-media user-avatar">
                                                            <span>IH</span>
                                                            <span class="status dot dot-lg dot-gray"></span>
                                                        </div>
                                                        <div class="chat-info">
                                                            <div class="chat-from">
                                                                <div class="name">Iliash Hossain</div>
                                                                <span class="time">Now</span>
                                                            </div>
                                                            <div class="chat-context">
                                                                <div class="text">You: Please confrim if you got my last messages.</div>
                                                                <div class="status delivered">
                                                                    <em class="icon ni ni-check-circle-fill"></em>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
 
                                            </ul>
                                        </div>
                                         <div class="dropdown-foot center">
                                            <a href="html/apps-chats.html">View All</a>
                                        </div>
                                    </div>
                                </li> -->
                               <?php if(isset(session()->name_emp)||isset(session()->numberid)) {?>
                                <li class="dropdown user-dropdown">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <div class="user-toggle">
                                            <div class="user-avatar sm">
                                                <em class="icon ni ni-user-alt"></em>
                                            </div>
                                        </div>
                                         <div class="user-info d-none d-xl-block" style="padding-left:10px">
                                                <div class="user-status" style="color:white;"><?php echo session()->name_emp!=null?session()->name_emp: session()->fullname ?></div>
                                                <?php  if (session()->name_emp!=null){ ?>
                                                <div class="user-name dropdown-indicator" style="color: #fafafa;"><?php echo session()->type=='pegawai'? str_replace('BAGIAN','',str_replace(' KAMPUS JAKARTA', '', session()->unit_emp)):session()->type ?></div>
                                                <?php } else {
                                                    ?>
                                                    <div class="user-name dropdown-indicator" style="color: #fafafa;"><?php echo session()->studyprogram ?></div>
                                                <?php } ;?>
                                            </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1 is-light">
                                        <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                            <div class="user-card">
                                                <div class="user-avatar">
                                                    <em class="icon ni ni-user-alt"></em>
                                                </div>
                                                <div class="user-info">
                                                    <span class="lead-text"><?php echo session()->name_emp!=null?session()->name_emp: session()->fullname ?></span>
                                                    <!-- <span class="sub-text">sofyan@gmail.com</span> -->
                                                </div>
                                              <!--   <div class="user-action">
                                                    <a class="btn btn-icon me-n2" href="html/user-profile-setting.html"><em class="icon ni ni-setting"></em></a>
                                                </div> -->
                                            </div>
                                        </div>
                                       <div class="dropdown-inner">
                                         <?php if (session()->status_pgw=='MAGANG') {?>
                                        
                                    <!--         <ul class="link-list">
                                           
                                                 <li><a type="button" class="li-menu-user" data-bs-toggle="modal" data-bs-target="#modalunit"><i class="icon fa-solid fa-people-roof"></i><span>My Unit</span></a></li>
                                            </ul> -->
                                      
                                        <?php } ?>
                                      </div>
                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li><a href="<?php echo base_url('Logout') ?>"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                                <?php if(session()->type=='admin akademik' ) { ?>
                                                <li><a href="#" onclick="activatedBeetweenSemester(event)"><i class="fa-solid fa-calendar-days" style="padding-right:15px"></i><span>Aktifkan Semester Antara</span></a></li>
                                                <?php } ;?>
                                                <?php if(session()->type=='superadmin' && base_url('')=='http://localhost:8080/') {?>  
                                                <li><a href="<?php echo base_url('SchUpdate') ?>"><em class="icon ni ni-signout"></em><span>Update Schedule</span></a></li>
                                                <?php } ?>                          
                                            </ul>
                                        </div>
                                    </div>
                                </li><!-- .dropdown -->
                             <?php } ?>
                            </ul><!-- .nk-quick-nav -->
                        </div><!-- .nk-header-tools -->
                    </div><!-- .nk-header-wrap -->
                </div><!-- .container-fliud -->
            </div>

     
            <!-- main header @e -->
            <!-- content @s -->
            <?= $this->renderSection('content') ?>
            <!-- content @e -->
            <!-- footer @s -->
            <?= $this->renderSection('footer') ?>
            <!-- footer @e -->
        </div>
        <!-- wrap @e -->
    </div>
    <!-- app-root @e -->
    <!-- select region modal -->
           <div class="modal fade " tabindex="-1" id="modalunit">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <em class="icon ni ni-cross"></em>
                                    </a>
                                    <div class="modal-header">
                                        <h5 class="modal-title">Change Unit</h5>
                                    </div>
                                    <div class="modal-body">
                                      
                                            <form id="frmupunit">
                                               
                                                <div class="form-group">
                                                    <label class="form-label" for="cf-full-name">Unit Name</label>
                                                    <input type="text" class="form-control" id="unit_emp" name="unit_emp" value="<?php echo session()->unit_emp; ?>">
                                                    
                                                    <div id="unit_emp-error">
                                                    </div>
                                                </div>
                                                
                                              
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-lg btn-primary" id="buttonChangeUnit" onclick="ChangeUnit()">Save</button>
                                                    <span class="loader" id="loaderChangeUnit" style="display: none;"></span>

                                                </div>
                                            </form>
                                       
                               
                                </div>  
                              
                            </div>
                        </div>
                </div>

<div class="modal fade " tabindex="-1" id="modalLoaderHead">
    <div class="modal-dialog modal-sm"  role="document">
        <div class="modal-content" style="background: transparent; box-shadow: none;">
            <div class="row g-gs" id="loader_container_loan" style="justify-content: center;">
            <span class="loader_front" id="loader_front_loan" ></span>
            </div>
        </div>
    </div>
</div>
                   <script type="text/javascript">
                function ChangeUnit()
                    {
                        var form_data = new FormData($('#frmupunit')[0]);

                       $.ajax({
                         url:"<?php echo base_url('changeUnit') ?>",
                         global:false,
                         async:true,
                         type:'post',
                        processData: false,
                         contentType: false,
                         dataType:'json',
                         enctype: "multipart/form-data",
                         data: form_data,
                         beforeSend: function () {
                                    $('#buttonChangeUnit').hide()
                                    $('#loaderChangeUnit').show()
                                  },
                         success : function(e) {
                           if(e.status == 'ok;') 
                           {
                            $('#buttonChangeUnit').show()
                            $('#loaderChangeUnit').hide()
                             let timerInterval
                              Swal.fire({
                                icon: 'success',
                                title: ' Data has been Updated',
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
                             $('#buttonChangeUnit').show()
                            $('#loaderChangeUnit').hide()
                            var msgeror='';
                            console.log(e.data)
                             $.each(e.dataname, function(key, value) {
                                document.getElementById(key+"-error").innerHTML ="";
                              });

                            $.each(e.data, function(key, value) {
                             document.getElementById(key+"-error").innerHTML = `<span class="badge badge-dim bg-danger">`+value+`
                                                                                </span>`;
                          });
                            $('#buttonChangeUnit').show()
                            $('#loaderChangeUnit').hide()
                            $("#modalunit").modal('show');
                         }
                      },
                      error :function(xhr, status, error) {
                       alert(xhr.responseText);
                    }

                 });
                }

                function activatedBeetweenSemester(event){
                    event.preventDefault()
                    Swal.fire({
                        title: 'Yakin Ingin mengaktifkan Semester antara ?',
                        // text: "Data tidak akan bisa kembali",
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "<?php echo base_url('activatedBetweenSem') ?>",
                                global: false,
                                async: true,
                                type: 'post',
                                dataType: 'json',
                                beforeSend: function () {
                                    
                                    $("#modalLoaderHead").modal('show');
                                             
                             },
                                data: ({
                                }),
                                success: function(e) {
                                    if (e.status == 'ok;') {

                                        let timerInterval
                                        Swal.fire({
                                            icon: 'success',
                                            title: ' Data has been Update',
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
                                error: function(xhr, status, error) {
                                    alert(xhr.responseText);
                                }

                            });


                        }
                    })
                }

                $(document).ready(function() {
                    
                });
           </script>
  
</body>

</html>
 
   

