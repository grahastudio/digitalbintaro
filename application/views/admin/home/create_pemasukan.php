<div class="card">
    <div class="card-header">
        <?php echo $title; ?>
    </div>
    <div class="text-center">
        <?php
        echo $this->session->flashdata('message');
        if (isset($error_upload)) {
            echo '<div class="alert alert-warning">' . $error_upload . '</div>';
        }
        ?>
    </div>


    <div class="card-body">
        <?php
        echo form_open_multipart('admin/home/create_pemasukan');
        ?>

        <?php
        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        ?>
        <input type="hidden" name="asrama_id" value="<?php echo $user->asrama_id; ?>">
<h3>Data Cetakan</h3>
<hr>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Tanggal <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" name="tanggal" class="form-control" placeholder="Tanggal" id="datepicker">
                <?php echo form_error('tanggal', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Kategori Cetakan <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <select name="category_id" class="form-control form-control-chosen">
                    <option></option>
                    <?php foreach ($category as $category) { ?>
                        <option value="<?php echo $category->id ?>">
                            <?php echo $category->category_name ?>
                        </option>
                    <?php } ?>
                </select>
                <?php echo form_error('category_id', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Jenis Cetakan <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <select name="product_id" class="form-control form-control-chosen">
                    <option></option>
                    <?php foreach ($product as $product) { ?>
                        <option value="<?php echo $product->id ?>">
                            <?php echo $product->product_name ?>
                        </option>
                    <?php } ?>
                </select>
                <?php echo form_error('category_id', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Ukuran Cetakan <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" name="product_size" class="form-control" placeholder="Contoh ; 3 x 1 m / A4 / Medium etc." value="<?php echo set_value('product_size'); ?>">
                <?php echo form_error('product_size', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">QTY Cetakan <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" name="product_qty" class="form-control" placeholder="Jumlah Cetakan" value="<?php echo set_value('product_qty'); ?>">
                <?php echo form_error('product_qty', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Nominal Rp. <span class="text-danger"> *</span>
            </label>
            <div class="col-lg-6">
                <input type="text" name="nominal" class="form-control" placeholder="Nominal" value="<?php echo set_value('nominal'); ?>">
                <?php echo form_error('nominal', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

<h3>Data Klient</h3>
<hr>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Title <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <select name="client_title" class="form-control form-control-chosen">

                    <option></option>
                    <option value="Bapak">Bapak</option>
                    <option value="Ibu">Ibu</option>
                </select>
                <?php echo form_error('client_title', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Nama Klient <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" name="client_name" class="form-control" id="client_name" placeholder="Nama client" value="<?php echo set_value('client_name'); ?>">
                <?php echo form_error('client_name', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Nomor Handphone <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" name="client_phone" class="form-control" placeholder="Nomor Handphone" value="<?php echo set_value('client_phone'); ?>">
                <?php echo form_error('client_phone', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Email <span class="text-success">( Boleh Kosong )</span>
            </label>
            <div class="col-lg-6">
                <input type="text" name="client_email" class="form-control" placeholder="Email Klient" value="<?php echo set_value('client_email'); ?>">
                <?php echo form_error('client_email', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Alamat Klient <span class="text-success"> (Boleh Kosong)</span>
            </label>
            <div class="col-lg-6">
                <input type="text" name="client_address" class="form-control" placeholder="Alamat client" value="<?php echo set_value('client_address'); ?>">
                <?php echo form_error('client_address', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        

        <!-- <div class="form-group row">
            <label class="col-lg-3 col-form-label">Upload Gambar <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" name="foto">
                    <label class="custom-file-label" for="customFile"><i class="ti-camera"></i> Ambil Foto</label>
                </div>
                <img id="blah" src="#" alt="Gambar Akan Muncul Disini" class="img-fluid" />
            </div>
        </div> -->

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Keterangan <span class="text-danger"> *</span>
            </label>
            <div class="col-lg-6">
                <textarea class="form-control" id="summernote" name="keterangan"><?php echo set_value('keterangan'); ?></textarea>
                <?php echo form_error('keterangan', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>



        <div class="form-group row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Simpan
                </button>
            </div>
        </div>

        <?php echo form_close() ?>


    </div>
</div>