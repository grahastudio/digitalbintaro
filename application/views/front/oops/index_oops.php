<h4 class="cat-judul text-center"><?php echo $title ?></h4>

<div class="container">

    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url('') ?>"> Home</a></li>
        <li class="breadcrumb-item active"><?php echo $title ?></li>
    </ul>


    <div class="col-md-12 text-center" style="min-height:600px;">

        <div class="error_404">
            <div class="row">
                <div class="col-md-12">
                    <p>Maaf Halaman Yang anda Cari tidak di temukan</p>
                    <div class="text_404">404</div>

                </div>
            </div>
            <p> Silahkan Kembali ke <a href="<?php echo base_url() ?>">Home</a>
        </div>

    </div><!-- /.col-lg-4 -->



</div>