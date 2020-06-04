<?php
$id             = $this->session->userdata('id');
$user           = $this->user_model->user_detail($id);
?>
<div class="breadcrumb-default">
  <div class="container">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url('') ?>"><i class="ti ti-home"></i> Home</a></li>
      <li class="breadcrumb-item active"><?php echo $title ?></li>
    </ul>
  </div>
</div>

<div class="margin-top container">
  <div class="row">
    <div class="col-md-8">

      <div class="card">
        <div class="card-header">Order <b><?php echo $product->product_name;?></b></div>
        <div class="card-body">
          <div class="alert alert-success">
            Sebelum anda melakukan order silahkan ini data berikut ini untuk mendapatkan penawaran harga sesuai spesifikasi dan kuantitas order
          </div>
          <h3> Info Cetakan</h3>
          <div class="row">
            <div class="col-md-4">
              <img class="img-fluid" src="<?php echo base_url('assets/img/product/') .$product->product_img;?>">
            </div>
            <div class="col-md-8">
              Jenis Cetakan : <b><?php echo $product->product_name;?></b><br>
              Harga Cetakan : <b><?php echo $product->product_price;?> (Tergantung Jumlah Cetak)<br>
              </div>
            </div>
            <hr>
            <?php
            echo form_open_multipart('product/order/' .$product->id);
            ?>

            <div class="form-group row">
              <label class="col-lg-3 col-form-label">Ukuran <span class="text-danger">*</span>
              </label>
              <div class="col-lg-8">
                <input type="text" name="product_size" class="form-control" placeholder="Ukuran Produk">
                <?php echo form_error('product_name', '<small class="text-danger">', '</small>'); ?>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-lg-3 col-form-label"> Quantity <span class="text-danger">*</span>
              </label>
              <div class="col-lg-8">
                <input type="text" name="product_size" class="form-control" placeholder="Banyaknya">
                <?php echo form_error('product_name', '<small class="text-danger">', '</small>'); ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label"> Bahan <span class="text-danger">*</span>
              </label>
              <div class="col-lg-8">
                <input type="text" name="product_size" class="form-control" placeholder="Banyaknya">
                <?php echo form_error('product_name', '<small class="text-danger">', '</small>'); ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label"> Finishing <span class="text-danger">*</span>
              </label>
              <div class="col-lg-8">
                <input type="text" name="product_size" class="form-control" placeholder="Banyaknya">
                <?php echo form_error('product_name', '<small class="text-danger">', '</small>'); ?>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-lg-3 col-form-label">Upload Desain <span class="text-danger">*</span><br>

              </label>
              <div class="col-lg-8">

                <div class="custom-file">
                  <input type="file" id="customFile" name="product_img"><br>


                </div>

                <img id="blah" src="#" alt="cdr, ai, jpg, pdf, psd" class="img-fluid" />

              </div>
            </div>

            <h3> Info Pelanggan</h3>
            <hr>
            <?php if ($this->session->userdata('id')) :?>

              <div class="form-group row">
                <label class="col-lg-3 col-form-label"> Nama Lengkap <span class="text-danger">*</span>
                </label>
                <div class="col-lg-8">
                  <input type="text" name="nama_pelanggan" class="form-control" value="<?php echo $user->user_name;?>">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-lg-3 col-form-label"> No. Handphone <span class="text-danger">*</span>
                </label>
                <div class="col-lg-8">
                  <input type="text" name="nomor_hp" class="form-control" value="<?php echo $user->user_phone;?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-lg-3 col-form-label"> Email <span class="text-danger">*</span>
                </label>
                <div class="col-lg-8">
                  <input type="text" name="email" class="form-control" value="<?php echo $user->email;?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-lg-3 col-form-label"> Alamat <span class="text-danger">*</span>
                </label>
                <div class="col-lg-8">
                  <textarea name="alamat" class="form-control" placeholder="Alamat"><?php echo $user->user_address;?></textarea>

                </div>
              </div>

            <?php else:?>

              <div class="form-group row">
                <label class="col-lg-3 col-form-label"> Nama Lengkap <span class="text-danger">*</span>
                </label>
                <div class="col-lg-8">
                  <input type="text" name="nama_pelanggan" class="form-control" placeholder="Nama Lengkap">
                  <?php echo form_error('nama_pelanggan', '<small class="text-danger">', '</small>'); ?>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-lg-3 col-form-label"> No. Handphone <span class="text-danger">*</span>
                </label>
                <div class="col-lg-8">
                  <input type="text" name="nomor_hp" class="form-control" placeholder="Nomor Handphone">
                  <?php echo form_error('nomor_hp', '<small class="text-danger">', '</small>'); ?>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-lg-3 col-form-label"> Email <span class="text-danger">*</span>
                </label>
                <div class="col-lg-8">
                  <input type="text" name="email" class="form-control" placeholder="Email">
                  <?php echo form_error('email', '<small class="text-danger">', '</small>'); ?>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-lg-3 col-form-label"> Alamat <span class="text-danger">*</span>
                </label>
                <div class="col-lg-8">
                  <textarea name="alamat" class="form-control" placeholder="Alamat"></textarea>
                  <?php echo form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                </div>
              </div>

            <?php endif;?>



            <div class="form-group row">
              <div class="col-lg-3"></div>
              <div class="col-lg-8">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                  Kirim
                </button>
              </div>
            </div>

            <?php echo form_close();?>


          </div>
        </div>
      </div>
    </div>
  </div>
