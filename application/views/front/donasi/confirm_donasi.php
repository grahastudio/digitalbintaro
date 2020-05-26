<div class="breadcrumb-donasi" style="background-color:darkblue;height: auto;min-height:100px; background-image: linear-gradient(rgba(0,0,0,.5), rgba(0,0,0,.5)), url('assets/img/donasi/gambar2.jpg');">
    <div class="container">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url('') ?>"><i class="ti ti-home"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url('donasi') ?>"> Donasi</a></li>
            <li class="breadcrumb-item active"><?php echo $title ?></li>
        </ul>
    </div>
</div>
<div class="container">
    <div class="content row">
        <div class="card">
            <h5 class="card-header"><?php echo $title; ?></h5>
            <div class="card-body">
                <h5 class="card-title">Silahkan masukan email dan kode donasi anda</h5>
                <div class="form-group">
                    <input class="form-control" name="email" placeholder="Email...">
                </div>
                <div class="form-group">
                    <input class="form-control" name="email" placeholder="Code Donasi...">
                </div>
                <a href="#" class="btn btn-info btn-block">Tampilkan</a>
            </div>
        </div>
    </div>
</div>