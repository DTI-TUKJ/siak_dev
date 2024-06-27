<?= $this->extend('partials/header_layout') ?>

<?= $this->section('content') ?>

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title"><?= $title; ?> Lists</h3>
                            <div class="nk-block-des text-soft">
                                <p>You have total <?= $total; ?> admin users.</p>
                            </div>
                            <?= session()->getFlashdata('errorAdminName') ?>
                            <?= session()->getFlashdata('errorUsername') ?>
                            <?= session()->getFlashdata('errorPassword') ?>
                            <?= session()->getFlashdata('errorUserType') ?>
                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-primary" title="tambah data" data-bs-toggle="modal" data-bs-target="#modaltambah"><em class="icon ni ni-plus"></em></a>
                                                
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div><!-- .toggle-wrap -->
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <table class="datatable-init table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Type</th>
                                        <th>Input date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data as $u) {; ?>
                                        <tr>
                                            <td><?= $no++;; ?></td>
                                            <td><?= $u['name_emp'] ?></td>
                                            <td><?= $u['username'] ?></td>
                                            <td><?= $u['type'] ?></td>
                                            <td><?= $u['input_date'] ?></td>
                                            <td>
                                             
                                                <a class="btn btn-danger" onclick="deletedata('<?php echo $u['Admin_name'] ?>')"><i class="fa-solid fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php }; ?>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- .card-preview -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>


<div class="modal fade " role="dialog" aria-hidden="true" id="modaltambah">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
            </div>
            <div class="modal-body">
                <!-- <form id="frmtambah"> -->
                <?= form_open('User/simpanData'); ?>
                <div class="row g-4">
                                          <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="nip">Pilih Pegawai</label>
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
                            <label class="form-label" for="username">Username</label>
                            <div class="form-control-wrap">
                                <!-- <input type="text" class="form-control" id="username" name="username" value="<?php echo set_value('asset_name') ?>" placeholder="Enter Name"> -->
                                <?= form_input('username', '', [
                                    'class'         => 'form-control',
                                    'id'            => 'username',
                                    'placeholder'   => 'Enter Username..'
                                ]); ?>
                                <!-- <div id="nama-error"></div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="password">Password</label>
                            <div class="form-control-wrap">
                                <!-- <input type="text" class="form-control" id="email-address-1" name="description" value="<?php echo set_value('email') ?>" placeholder="Enter Description"> -->
                                <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                    <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                </a>
                                <?= form_input('password', '', [
                                    'class'         => 'form-control',
                                    'id'            => 'password',
                                    'placeholder'   => 'Enter Password..'
                                ]); ?>
                            </div>
                            <!-- <div id="description-error"></div> -->
                        </div>
                    </div>
                    <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="userType">User Type</label>
                                <div class="form-control-wrap">
                                    <select class="form-select" id="userType" name="userType" onchange="">
                                        <option value="">-Pilih Type-</option>
                                        <option value="admin logistik">Admin Logistik</option>
                                        <option value="admin purel">Admin Purel</option>
                                        <option value="admin akademik">Admin akademik</option>
                                        <option value="superadmin">Super Admin</option>
                                    </select>
                                </div>
                                <div id="userType-error">

                                </div>
                            </div>
                        </div>
                    <div class="col-12">
                        <div class="form-group">
                            <!-- <button type="button" class="btn btn-lg btn-primary" id="buttonsave" onclick="addAsset()">Save</button> -->
                            <?= form_submit('', 'submit', [
                                'class' => 'btn btn-lg btn-primary'
                            ]) ;?>
                            <span class="loader" id="loader" style="display: none;"></span>

                        </div>
                    </div>
                </div>
                <?= form_close() ;?>
                <!-- </form> -->
            </div>

        </div>
    </div>
    <script src="<?php echo base_url('') ?>/js/select2/js/select2.full.min.js"></script>
    <script type="text/javascript">
        $("#nip").select2({
                                    dropdownParent: $("#modaltambah"),
                                    ajax: {
                                        url: "getNipId",
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
                                    minimumInputLength: 3,

                                  }).on('select2:open', function(e){
                                        $('.select2-search__field').attr('placeholder', 'Search NIP or Name');
                                    });


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
                    url: "<?php echo base_url('UserDelete') ?>",
                    global: false,
                    async: true,
                    type: 'post',
                    dataType: 'json',
                    data: ({
                        id_user: id
                    }),
                    success: function(e) {
                        if (e.status == 'ok;') {

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
                    error: function(xhr, status, error) {
                        alert(xhr.responseText);
                    }

                });


            }
        })
    }
    </script>
    <?= $this->endSection() ?>


    <?= $this->extend('partials/footer_layout') ?>