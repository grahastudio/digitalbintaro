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

                <div class="card-header">Detail Produk</div>

                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6">
                            <?php if ($products->product_img == NULL) : ?>
                                <div class="img-wrap"><img class="img-fluid" src="<?php echo base_url('assets/img/product/empty_image.jpg'); ?>"></div>
                            <?php else : ?>
                                <div class="img-wrap"><img class="img-fluid" src="<?php echo base_url('assets/img/product/') . $products->product_img; ?>"></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <h2><?php echo $products->product_name; ?></h2>
                            <?php if ($products->product_stock == 0) : ?>
                                Stok : <span class="badge badge-danger"> Habis</span>
                            <?php else : ?>
                                Stok : <span class="badge badge-success"><?php echo $products->product_stock; ?></span>
                            <?php endif; ?><br>
                            Ukuran :
                            <div class="alert alert-info"><?php echo $products->product_size; ?></div>
                            Kategori Produk :
                            <div class="alert alert-info"><?php echo $products->category_product_name; ?></div>
                        </div>

                        <hr>
                        <div class="col-md-12">

                            <h3>Deskripsi Produk</h3>

                            <?php echo $products->product_desc; ?>


                            <!-- <div class="alert alert-primary">
                                <h3> Kirim Pesan ke Penjual </h3>
                                <div class="row">

                                    <div class="col-md-4">
                                        <label>Nama <span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>No. Whatsapp <span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Isi Komentar <span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <textarea class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block"> Kirim Komentar</button>
                                        </div>
                                    </div>
                                </div>

                            </div> -->





                        </div>



                    </div>



                </div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Hubungi Penjual</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4"><img src="<?php echo base_url('assets/img/avatars/' . $products->user_image); ?>" class="img img-thumbnail rounded-circle img-fluid"></div>
                        <div class="col-md-8">
                            <h2><a href="<?php echo base_url('products/user/' . $products->user_id); ?>"> <?php echo $products->user_name; ?></a></h2>
                            <?php
                            $whatsapp = substr($products->user_phone, 1);
                            ?>
                            <a class="btn btn-success" href="https://api.whatsapp.com/send?phone=62<?php echo $whatsapp; ?>&text=Halo%20mau%20order%20<?php echo $products->product_name; ?>"> <i class="fab fa-whatsapp"></i> Chat Whatsapp</a>

                        </div>

                    </div>



                </div>
            </div>


            <div class="card">
                <div class="card-header">Produk Lainya</div>
                <div class="card-body">


                    <?php foreach ($related_products as $related_products) : ?>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="row">
                                    <span class="col-md-4"><img src="<?php echo base_url('assets/img/product/' . $related_products->product_img); ?>" class="img img-thumbnail img-fluid"></span>


                                    <span class="col-md-8">
                                        <h5><a href="<?php echo base_url('products/detail/' . $related_products->product_slug); ?>"> <?php echo $related_products->product_name; ?></a></h5>
                                        <a class="btn btn-primary btn-sm" href="<?php echo base_url('products/detail/' . $related_products->product_slug); ?>"> Detail Produk</a>
                                    </span>
                                </div>

                            </li>
                        </ul>
                    <?php endforeach; ?>













                </div>
            </div>

        </div>
    </div>

</div>