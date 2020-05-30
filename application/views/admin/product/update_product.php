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
        echo form_open_multipart('admin/product/update/' .$product->id);
        ?>


        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Nama Produk <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" name="product_name" class="form-control" value="<?php echo $product->product_name ?>">
                <?php echo form_error('product_name', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Harga Produk <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" name="product_price" class="form-control" value="<?php echo $product->product_price ?>">
                <?php echo form_error('product_price', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>


        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Kategori <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <select name="category_id" class="form-control form-control-chosen">
                    <option></option>
                    <?php foreach ($category_product as $category_product) { ?>
                        <option value="<?php echo $category_product->id ?>" <?php if ($product->category_id == $category_product->id) {
                                                                        echo "selected";
                                                                    } ?>>
                            <?php echo $category_product->category_name ?>
                        </option>
                    <?php } ?>
                </select>
                <?php echo form_error('category_id', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Status Produk <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <select name="product_status" class="form-control form-control-chosen">
                    <option value="Publish">Publish</option>
                    <option value="Draft" <?php if ($product->product_status == "Draft") {
                                                echo "selected";
                                            } ?>>Draft</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Upload Gambar <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">

                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" name="product_img">
                    <label class="custom-file-label" for="customFile"><i class="ti-camera"></i> Ambil Gamabr</label>
                </div>

                <img id="blah" src="<?php echo base_url('assets/img/product/' .$product->product_img); ?>" alt="Gambar Akan Muncul Disini" class="img-fluid" />

            </div>
        </div>

        <div class="form-group row">
        <label class="col-lg-3 col-form-label">Kategori <span class="text-danger">*</span></label>
        <div class="col-lg-6">
            <textarea class="form-control" name="product_desc" id="summernote"><?php echo $product->product_desc ?></textarea>
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