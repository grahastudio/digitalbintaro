<div class="breadcrumb-default">
    <div class="container">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url('') ?>"><i class="ti ti-home"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url('berita') ?>"> Berita</a></li>

            <li class="breadcrumb-item active"><?php echo $title ?></li>
        </ul>
    </div>
</div>
<div class="container">
    <div class="margin-top row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <img class="img-fluid" src="<?php echo base_url('assets/img/artikel/' . $berita->berita_gambar); ?>">
                    <h2><?php echo $berita->berita_title; ?></h2>
                    <?php echo $berita->berita_desc; ?>
                    <?php echo $berita->berita_views; ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">

                    Sidebar
                </div>
            </div>
        </div>
    </div>
</div>