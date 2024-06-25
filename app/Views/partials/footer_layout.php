<?php echo $this->extend('partials/header_layout') ?>

<!-- FOOTER: DEBUG INFO + COPYRIGHTS -->
<?= $this->section('footer') ?>
<div class="nk-footer bg-white">
    <div class="container-fluid">
        <div class="nk-footer-wrap">
            <div class="nk-footer-copyright"> &copy; 2023 SiLog. Template by <a href="<?php echo base_url('') ?>" target="_blank">DTI</a>
            </div>

        </div>
    </div>
</div>
<!-- JavaScript -->
<script src="<?php echo base_url('') ?>assets/js/bundle.js?ver=3.2.0"></script>
<script src="<?php echo base_url('') ?>assets/js/scripts.js?ver=3.2.0"></script>
<script src="<?php echo base_url('') ?>assets/js/charts/gd-invest.js?ver=3.2.0"></script>
<script src="<?php echo base_url('') ?>js/select2/js/select2.full.min.js"></script>
<script src="<?php echo base_url('') ?>assets/extension/filepond/filepond.js"></script>
<script src="<?php echo base_url('') ?>assets/extension/toastify-js/src/toastify.js"></script>
<script src="<?php echo base_url('') ?>jquery/jquery.mask.js"></script>
<!-- <script src="<php// echo base_url(''); ?>/assets/js/filepond.js"></script> -->
<!-- <script src="<?php echo base_url('') ?>assets/extension/plugin-filepond/filepond-plugin-file-validate-type.js"></script> -->
<!-- <script src="<?php echo base_url('') ?>assets/extension/filepond/filepond.js"></script> -->
<!-- <script src="<?php echo base_url('') ?>assets/extension/filepond-plugin-image-preview/filepond-plugin-image-preview.js"></script>
<script src="<?php echo base_url('') ?>assets/extension/plugin-filepond/filepond-plugin-file-validate-size.js"></script>
<script src="<?php echo base_url('') ?>assets/extension/flatpcker/flatpickr.min.js"></script>
<script src="<?php echo base_url('') ?>assets/extension/flatpcker/monthselect/index.js"></script>
<script src="<?php echo base_url('') ?>assets/extension/flatpcker/minmaxtimeplugin/minMaxTimePlugin.js"></script> -->

     <!-- Required datatable js -->
        <script src="<?php echo base_url('') ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url('') ?>/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js" integrity="sha512-K/oyQtMXpxI4+K0W7H25UopjM8pzq0yrVdFdG21Fh5dBe91I40pDd9A4lzNlHPHBIP2cwZuoxaUSX0GJSObvGA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/minMaxTimePlugin.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/rangePlugin.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/closeOnSelect.js"></script> -->

<script type="text/javascript">

</script>

<?= $this->endSection() ?>