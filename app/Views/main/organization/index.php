<?= $this->extend('partials/header_layout') ?>

<?= $this->section('content') ?>

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Organization Data</h3>
                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <div class="drodown">
                                                <a href="" title="tambah data" class="dropdown-toggle btn btn-icon btn-primary" data-bs-toggle="modal" data-bs-target="#modaltambah"><em class="icon ni ni-plus"></em></a>
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

                        <table class=" nk-tb-list nk-tb-ulist table nowrap" data-auto-responsive="false" id="example" style="width:100%;">
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
                                    <th class="nk-tb-col"><span class="sub-text">Nama Himpunan</span></th>
                                    <th class="nk-tb-col"><span class="sub-text">Deskripsi Himpunan</span></th>
                                    <th class="nk-tb-col"><span class="sub-text">Ketua</span></th>
                                    <th class="nk-tb-col"><span class="sub-text">Pembina 1</span></th>
                                    <th class="nk-tb-col"><span class="sub-text">Pembina 2</span></th>
                                    <th class="nk-tb-col"><span class="sub-text">Loan Permission</span></th>
                                    
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


<div class="modal fade " role="dialog" aria-hidden="true" id="modaltambah">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Add Organization</h5>
            </div>
            <div class="modal-body">

                <form id="frmtambah">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="full-name-1">Nama Himpunan</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="full-name-1" name="assoc_name" value="<?php echo set_value('assoc_name') ?>" placeholder="Enter Name">
                                    <div id="assoc_name-error">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="email-address-1">Deskripsi Himpunan</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="email-address-1" name="description_assoc" value="<?php echo set_value('description_assoc') ?>" placeholder="Enter Description">
                                </div>
                                <div id="description_assoc-error">

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="asset_type_select">Ketua Himpunan</label>
                                <div class="form-control-wrap">
                                    <select class="form-select" id="ketua_himpunan" name="ketua_himpunan" onchange="">
                                        <option value="">- Pilih Ketua -</option>
                                        
                                    </select>
                                </div>
                                <div id="ketua_himpunan-error">

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="asset_type_select">Pembina 1</label>
                                <div class="form-control-wrap">
                                    <select class="form-select" id="pembina_a" name="pembina_a" onchange="">
                                        <option value="">- Pilih Pembina 1 -</option>
                                        
                                    </select>
                                </div>
                                <div id="pembina_a-error">

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="asset_type_select">Pembina 2</label>
                                <div class="form-control-wrap">
                                    <select class="form-select" id="pembina_b" name="pembina_b" onchange="">
                                        <option value="">- Pilih Pembina 2 -</option>
                                        
                                    </select>
                                </div>
                                <div id="pembina_b-error">

                                </div>
                            </div>
                        </div>
                   
                        <div class="col-12">
                            <div class="form-group">
                                <button type="button" class="btn btn-lg btn-primary" id="buttonsave" onclick="addOrg()">Save</button>
                                <span class="loader" id="loader" style="display: none;"></span>

                            </div>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>

<div class="modal fade " tabindex="-1" id="modaledit">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Edit Organization</h5>
            </div>
            <div class="modal-body" id="mainedit">



            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
    function calldata() {

        $('#example').DataTable({
            scrollX: true,
            "processing": true,
            "serverSide": true,
            "order": false,
            "lengthMenu": [30, 60, 90, 120],
            "pageLength": 30,
            "ajax": {
                url: '<?php echo base_url('callDataJsonOrg') ?>',
                type: "POST",
                // success : function(e) {
                //         // $('#loader_front').hide()
                //         // $('#loader_container').hide()
                // },
                // data : function(data){
                //     // data.periode =document.getElementById('bulan').value;
                // }

            },
            "columnDefs": [{
                "targets": '_all',
                "orderable": false,
                // render: $.fn.dataTable.render.html()
            }],
            "language": {
                "processing": "<span class=\"loader_front\"></span>",
            }
        });


    }

    function reloadtable() {

        $('#example').dataTable().fnDraw(false)

    }

    function dropDownSelect2(idselect,idmodal, urlAjax){
        $("#"+idselect).select2({
            dropdownParent: $("#"+idmodal),
            minimumInputLength: 3,
            ajax: {
                        url: urlAjax,
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
        }).on('select2:open', function(e){
           $('.select2-search__field').attr('placeholder', 'Search NIP/Nim/Name  ');
          });;
    }

    $(document).ready(function() {
         calldata();
         dropDownSelect2("ketua_himpunan", "modaltambah", "getLeader")
         dropDownSelect2("pembina_a", "modaltambah", "getNipEmp")
         dropDownSelect2("pembina_b", "modaltambah", "getNipEmp")
      
       
    })

    function addOrg() {
        var form_data = new FormData($('#frmtambah')[0]);
        $.ajax({
            url: "<?php echo base_url('addOrg') ?>",
            global: false,
            async: true,
            type: 'post',
            processData: false,
            contentType: false,
            dataType: 'json',
            enctype: "multipart/form-data",
            data: form_data,
            beforeSend: function() {
                $('#buttonsave').hide()
                $('#loader').show()
            },
            success: function(e) {
                if (e.status == 'ok;') {
                    $('#buttonsave').show()
                    $('#loader').hide()
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

                } else {
                    // console.log(e.dataname);
                    $('#buttonsave').show()
                    $('#loader').hide()
                    $.each(e.dataname, function(key, value) {
                        document.getElementById(key + "-error").innerHTML = "";
                    });
                    $.each(e.data, function(key, value) {


                        document.getElementById(key + "-error").innerHTML = `<span class="badge badge-dim bg-danger" style="">` + value + `
                                                                        </span>`;
                    });
                    // document.getElementById("signature_m-error").innerHTML ="";

                    $('#buttonsave').show()
                    $('#loader').hide()
                    $("#modaltambah").modal('show');
                }
            },
            error: function(xhr, status, error) {
                $('#buttonsave').show()
                    $('#loader').hide()
                alert(xhr.responseText);
            }

        });
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
                    url: "<?php echo base_url('OrgDelete') ?>",
                    global: false,
                    async: true,
                    type: 'post',
                    dataType: 'json',
                    data: ({
                        id_org: id,
                  
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

    function permissionUp(id, permission) {
        Swal.fire({
            title: 'Yakin Ingin mengubah izin peminjaman ?',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?php echo base_url('OrgPerUp') ?>",
                    global: false,
                    async: true,
                    type: 'post',
                    dataType: 'json',
                    data: ({
                        assoc_id: id,
                        permission:permission
                  
                    }),
                    success: function(e) {
                        if (e.status == 'ok;') {

                            let timerInterval
                            Swal.fire({
                                icon: 'success',
                                title: ' Data has been update',
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

    function popupedit(id) {

        $.ajax({
            url: "<?php echo base_url('modalEditOrg') ?>",
            global: false,
            async: true,
            type: 'post',
            dataType: 'json',
            data: ({
                id: id,
            }),
            success: function(e) {
                if (e.status == 'ok;') {
                    // console.log(e.data);
                    var optionpb2=e.data['assoc_lecturer_id_b']==''?'<option value="">- Pilih Pembina 2 -</option>':`<option value="${e.data['assoc_lecturer_id_b']}">${e.data['pembina_b']}</option>`;

                    var html = `    <form id="frmedit">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="full-name-1">Nama Himpunan</label>
                                <div class="form-control-wrap">
                                    <input type="hidden" name="assoc_id" value="${e.data['assoc_id']}" >
                                    <input type="text" class="form-control" id="assoc_name" name="assoc_name" value="${e.data['assoc_name']}" placeholder="Enter Name">
                                    <div id="assoc_name_edit-error">

                                    </div>
                                    <div id="assoc_id_edit-error">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="email-address-1">Deskripsi Himpunan</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="email-address-1" name="description_assoc" value="${e.data['assoc_desc']}" placeholder="Enter Description">
                                </div>
                                <div id="description_assoc_edit-error">

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="asset_type_select">Ketua Himpunan</label>
                                <div class="form-control-wrap">
                                    <select class="form-select" id="ketua_himpunan_edit" name="ketua_himpunan" onchange="">
                                        <option value="${e.data['numberid']}">${e.data['fullname']}</option>
                                        
                                    </select>
                                </div>
                                <div id="ketua_himpunan_edit-error">

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="asset_type_select">Pembina 1</label>
                                <div class="form-control-wrap">
                                    <select class="form-select" id="pembina_a_edit" name="pembina_a" onchange="">
                                        <option value="${e.data['assoc_lecturer_id']}">${e.data['pembina_a']}</option>
                                        
                                    </select>
                                </div>
                                <div id="pembina_a_edit-error">

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="asset_type_select">Pembina 2</label>
                                <div class="form-control-wrap">
                                    <select class="form-select" id="pembina_b_edit" name="pembina_b" onchange="">
                                       ${optionpb2}
                                        
                                    </select>
                                </div>
                                <div id="pembina_b_edit-error">

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                                                  
                                <div class="custom-control">
                                  <input type="checkbox" class="custom-control-input" id="delete_pb_2" name="delete_pb_2" value="1" >    
                                   <label class="custom-control-label" for="delete_pb_2">Hapus Pembina 2</label>
                                      </div>
                                     <div id="delete_pb_2-error">

                                    </div>
                           </div>
                         </div>
                   
                        <div class="col-12">
                            <div class="form-group">
                                <button type="button" class="btn btn-lg btn-primary" id="buttonedit" onclick="editOrg()">Save</button>
                                <span class="loader" id="loaderedit" style="display: none;"></span>

                            </div>
                        </div>
                    </div>
                </form>
                        `;
                    $('#mainedit').html(html);
                    dropDownSelect2("ketua_himpunan_edit", "modaledit", "getLeader")
                    dropDownSelect2("pembina_a_edit", "modaledit", "getNipEmp")
                    dropDownSelect2("pembina_b_edit", "modaledit", "getNipEmp")
                    $("#modaledit").modal('show');
                }
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }

        });
    }

    function editOrg() {
        var form_data = new FormData($('#frmedit')[0]);

        $.ajax({
            url: "<?php echo base_url('orgEdit') ?>",
            global: false,
            async: true,
            type: 'post',
            processData: false,
            contentType: false,
            dataType: 'json',
            enctype: "multipart/form-data",
            data: form_data,
            beforeSend: function() {
                $('#buttonedit').hide()
                $('#loaderedit').show()
            },
            success: function(e) {
                if (e.status == 'ok;') {
                    $('#buttonedit').show()
                    $('#loaderedit').hide()
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
                } else {
                    $('#buttonedit').show()
                    $('#loaderedit').hide()
                    var msgeror = '';
                    $.each(e.dataname, function(key, value) {
                        document.getElementById(key + "_edit-error").innerHTML = "";
                    });

                    $.each(e.data, function(key, value) {
                        document.getElementById(key + "_edit-error").innerHTML = `<span class="badge badge-dim bg-danger">` + value + `
                                                                </span>`;
                    });
                    $('#buttonedit').show()
                    $('#loaderedit').hide()
                    $("#modaledit").modal('show');
                }
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }

        });
    }
</script>

<?= $this->endSection() ?>


<?= $this->extend('partials/footer_layout') ?>