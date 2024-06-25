<?= $this->extend('partials/header_layout') ?>

<?= $this->section('content') ?>

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Student List</h3>
                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                          
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="card card-bordered card-preview">
                    <div class="card-inner">

                        <table class=" nk-tb-list nk-tb-ulist table table-bordered " data-auto-responsive="false" id="example" style="width:100%;">
                            <thead>
                                <tr class="nk-tb-item nk-tb-head">
                                    <th class="nk-tb-col ">action
                                    </th>
                                    <th class="nk-tb-col"><span class="sub-text">NIM</span></th>
                                    <th class="nk-tb-col"><span class="sub-text">Student Name</span></th>
                                    <th class="nk-tb-col"><span class="sub-text">Prodi</span></th>
                                    <th class="nk-tb-col"><span class="sub-text">School Year</span></th>
                                    <th class="nk-tb-col"><span class="sub-text">Class</span></th>
                                    <th class="nk-tb-col"><span class="sub-text">Phone</span></th>
                                   
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




<div class="modal fade " tabindex="-1" id="modaledit">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Edit Asset</h5>
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
                url: '<?php echo base_url('callDataJsonStudent') ?>',
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

    $(document).ready(function() {
        calldata();

    })



    function permissionUp(id, permission) {
        Swal.fire({
            title: 'Yakin Ingin mengubah izin peminjaman ?',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?php echo base_url('upPerStuent') ?>",
                    global: false,
                    async: true,
                    type: 'post',
                    dataType: 'json',
                    data: ({
                        student_id: id,
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



</script>

<?= $this->endSection() ?>


<?= $this->extend('partials/footer_layout') ?>