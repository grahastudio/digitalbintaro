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
        echo form_open_multipart('admin/pemasukan/update/' . $pemasukan->id);
        ?>


        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Tanggal <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" name="tanggal" class="form-control" value="<?php echo date("d/m/Y", strtotime($pemasukan->tanggal)); ?>" readonly>
                <?php echo form_error('tanggal', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>


        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Kategori <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <select name="category_id" class="form-control form-control-chosen">

                    <?php foreach ($category as $category) { ?>
                        <option value="<?php echo $category->id ?>" <?php if ($pemasukan->category_id == $category->id) {
                                                                        echo "selected";
                                                                    } ?>>
                            <?php echo $category->category_name ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Title <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <select name="donatur_title" class="form-control form-control-chosen">
                    <option value="Bapak" <?php if ($pemasukan->donatur_title == "Bapak") {
                                                echo "selected";
                                            } ?>>Bapak</option>
                    <option value="Ibu">Ibu</option>
                </select>
                <?php echo form_error('donatur_title', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Nama Donatur <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" name="donatur_name" class="form-control" id="donatur_name" placeholder="Nama Donatur" value="<?php echo $pemasukan->donatur_name; ?>">
                <?php echo form_error('donatur_name', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Nomor Handphone <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" name="donatur_phone" class="form-control" placeholder="Nomor Handphone" value="<?php echo $pemasukan->donatur_phone; ?>">
                <?php echo form_error('donatur_phone', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Alamat Donatur <span class="text-success"> (Boleh Kosong)</span>
            </label>
            <div class="col-lg-6">
                <input type="text" name="donatur_address" class="form-control" placeholder="Alamat Donatur" value="<?php echo $pemasukan->donatur_address; ?>">
                <?php echo form_error('donatur_address', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Nominal Rp. <span class="text-danger"> *</span>
            </label>
            <div class="col-lg-6">
                <input type="text" name="nominal" class="form-control" placeholder="Nominal" value="<?php echo $pemasukan->nominal; ?>">
                <?php echo form_error('nominal', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Upload Gambar <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">



                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" name="foto">
                    <label class="custom-file-label" for="customFile"><i class="ti-camera"></i> Ambil Foto</label>
                </div>

                <img id="blah" src="<?php echo base_url('assets/img/donatur/' . $pemasukan->foto); ?>" alt="Gambar Akan Muncul Disini" class="img-fluid" />





            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Keterangan <span class="text-danger"> *</span>
            </label>
            <div class="col-lg-6">
                <textarea class="form-control" id="summernote" name="keterangan"><?php echo $pemasukan->keterangan; ?></textarea>
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