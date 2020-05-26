</div>
<!---Container Fluid-->
</div>
<!-- Footer -->
<footer class="sticky-footer bg-white mt-3">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Application Version 1.0
            </span>
        </div>
    </div>
</footer>
<!-- Footer -->
</div>
</div>

<!-- Scroll to top -->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<script src="<?php echo base_url('assets/admin/vendor/jquery/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/js/myscript.min.js') ?>"></script>
<!-- <script src="<?php echo base_url('assets/admin/js/Chart.js-2.9.3/dist/chart.min.js'); ?>"></script> -->



<script src="<?php echo base_url('assets/template/js/chosen.jquery.min.js'); ?>"></script>

<!-- AUTOCOMPLETE -->
<script src="<?php echo base_url('assets/admin/js/autocomplete/jquery-3.3.1.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/js/autocomplete/jquery-ui.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $('#donatur_name').autocomplete({
            source: "<?php echo base_url('admin/home/get_autocomplete'); ?>",

            select: function(event, ui) {
                $('[name="donatur_name"]').val(ui.item.label);
                $('[name="donatur_phone"]').val(ui.item.donatur_phone);
            }
        });

    });
</script>

<!-- SUMMERNOTE -->
<link href="<?php echo base_url('assets/admin/js/summernote/summernote-lite.min.css'); ?>" rel="stylesheet">
<script src="<?php echo base_url('assets/admin/js/summernote/summernote-lite.min.js'); ?>"></script>
<script>
    $('#summernote').summernote({
        placeholder: 'Keterangan ..',
        tabsize: 2,
        height: 130,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
</script>


<script src="<?php echo base_url('assets/admin/vendor/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
            // dateFormat: 'Y-m-d'
        });
        $('#start_date').datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
            // dateFormat: 'Y-m-d'
        });
        $('#end_date').datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
            // dateFormat: 'Y-m-d'
        });
    });
</script>
<!-- Image Upload preview -->
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $("#customFile").change(function() {
        readURL(this);
    });
</script>

<!-- PriNt Area -->
<script type="text/javascript">
    function printDiv(printableArea) {
        var printContents = document.getElementById(printableArea).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>





</body>

</html>