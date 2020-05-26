<div class="text-center">
    <?php
    echo $this->session->flashdata('message');
    if (isset($error_upload)) {
        echo '<div class="alert alert-warning alert-dismissable"><button class="close" data-dismiss="alert" aria-label="Close">×</button>' . $error_upload . '</div>';
    }
    ?>
</div>
<div class="card">
    <div class="card-header">
        <?php echo $title; ?>
    </div>



    <div class="card-body">
        <?php
        echo form_open_multipart('admin/pengeluaran/update/' . $pengeluaran->id);
        ?>


        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Tanggal <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" name="tanggal" class="form-control" value="<?php echo date("d/m/Y", strtotime($pengeluaran->tanggal)); ?>" readonly>

            </div>
        </div>


        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Kategori <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <select name="category_id" class="form-control form-control-chosen">
                    <option></option>
                    <?php foreach ($category as $category) { ?>
                        <option value="<?php echo $category->id ?>" <?php if ($pengeluaran->category_id == $category->id) {
                                                                        echo "selected";
                                                                    } ?>>
                            <?php echo $category->category_name ?>
                        </option>
                    <?php } ?>
                </select>
                <?php echo form_error('category_id', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Nominal Rp. <span class="text-danger"> *</span>
            </label>
            <div class="col-lg-6">
                <input type="text" name="pengeluaran" class="form-control" placeholder="Nominal" value="<?php echo $pengeluaran->pengeluaran; ?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Upload Foto <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" name="foto">
                    <label class="custom-file-label" for="customFile"><i class="ti-camera"></i> Ambil Foto</label>
                </div>
                <img id="blah" src="<?php echo base_url('assets/img/donatur/' . $pengeluaran->foto); ?>" alt="Gambar Akan Muncul Disini" class="img-fluid" />
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Keterangan <span class="text-danger"> *</span>
            </label>
            <div class="col-lg-6">
                <textarea class="form-control" id="summernote" name="keterangan"><?php echo $pengeluaran->keterangan; ?></textarea>
                <?php echo form_error('keterangan', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>



        <div class="form-group row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Update
                </button>
            </div>
        </div>

        <?php echo form_close() ?>


    </div>
</div>