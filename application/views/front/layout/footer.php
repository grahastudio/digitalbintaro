<?php
$meta      = $this->meta_model->get_meta();

?>






<section class="bantuan py-md-3 mt-md-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8 text-light"><span style="font-size:35px;font-weight:700;">Butuh Bantuan ? Hubungi Kami</span></div>
            <div class="col-md-4 text-light"><span style="font-size:30px;font-weight:700;"><i class="fas fa-phone"></i> <?php echo $meta->telepon; ?></span></div>
        </div>
    </div>
</section>
<footer class="pt-4 pt-md-5 pb-md-5 border-top bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md">
                <a href="<?php echo base_url(); ?>"><img class="mb-2" src="<?php echo base_url('assets/img/logo/' . $meta->logo) ?>" alt="" width="250"></a>
                <span style="font-size:18px;"><br>
                    <i class="fa fa-phone"></i> <?php echo $meta->telepon ?><br>
                    <i class="fa fa-envelope"></i> <?php echo $meta->email ?>
                </span>
            </div>
            <div class="col-6 col-md ml-md-5">
                <h5>Produk Utama</h5>
                <ul class="list-unstyled text-small">

                    <li><a class="text-muted" href="#sec1">Cetak Spanduk</a></li>
                    <li><a class="text-muted" href="#sec2">Cetak Kartu nama</a></li>
                    <li><a class="text-muted" href="#sec3">Cetak Brosur</a></li>

                </ul>
            </div>
            <div class="col-5 col-md">
                <h5>Halaman</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="<?php echo base_url('about') ?>">About Us</a></li>
                    <li><a class="text-muted" href="<?php echo base_url('contact') ?>">Contact Us</a></li>
                    <li><a class="text-muted" href="<?php echo base_url('products') ?>">Produk</a></li>
                    <li><a class="text-muted" href="<?php echo base_url('berita') ?>">Berita</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>Alamat</h5>
                <?php echo $meta->alamat ?>

            </div>
        </div>
    </div>
</footer>

<div class="credit text-light pb-md-3">
<div class="container py-md-3">
    <span class="float-left">Copyright &copy; <?php echo date('Y') ?> - <?php echo $meta->title ?> - <?php echo $meta->tagline ?></span> <span class="float-right"> Developed by <a href="https://www.grahastudio.com/" target="blank"> Grahastudio</a></span>
</div>
</div>
<!-- Load javascript Jquery -->
<script src="<?php echo base_url() ?>assets/template/js/jquery.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/template/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/template/js/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url() ?>assets/template/js/chosen.jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/template/assets/js/vendor/popper.min.js"></script>
<script src="<?php echo base_url() ?>assets/template/js/moment-with-locales.js"></script>
<script src="<?php echo base_url() ?>assets/template/js/bootstrap-datetimepicker.js"></script>
<script src="<?php echo base_url() ?>assets/template/js/timepicker.js"></script>


<script>
    $(function() {
        $('#id_tanggal').datetimepicker({
            locale: 'id',
            format: 'D MMMM YYYY',
            minDate: new Date(),
        });
    });
    $('.form-control-chosen').chosen({});
    $('#timepicker').timepicker();
</script>



<script type="text/javascript">
    $('#menu-utama').affix({
        offset: {
            top: 500
        }
    })
</script>

<!-- Google Analitycs -->
<?php echo $meta->google_analytics; ?>
<!-- End Google Analitycs -->




<!-- SUMMERNOTE -->
<link href="<?php echo base_url('assets/admin/js/summernote/summernote-lite.min.css'); ?>" rel="stylesheet">
<script src="<?php echo base_url('assets/admin/js/summernote/summernote-lite.min.js'); ?>"></script>

<script>
    $('#summernote').summernote({
        placeholder: 'Deskripsi Produk ..',
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

</body>

</html>
