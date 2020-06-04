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
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">Detail Produk</div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6">
                            <?php if ($product->product_img == NULL) : ?>
                                <div class="img-wrap"><img class="img-fluid" src="<?php echo base_url('assets/img/product/empty_image.jpg'); ?>"></div>
                            <?php else : ?>
                                <div class="img-wrap"><img class="img-fluid" src="<?php echo base_url('assets/img/product/') . $product->product_img; ?>"></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <h2><?php echo $product->product_name; ?></h2>
                           
                            Ukuran :
                            <div class="alert alert-info"><?php echo $product->product_price; ?></div>
                            Kategori Produk :
                            <div class="alert alert-info"><?php echo $product->category_name; ?></div>
                        </div>

                        <hr>
                        <div class="col-md-12">

                            <h3>Deskripsi Produk</h3>

                            <?php echo $product->product_desc; ?>
                            <a class="btn btn-primary btn-block" href="<?php echo base_url('product/order/' .$product->id);?>">Order</a>
                        </div>
                    </div>
                </div>
            </div>


            <h3> Produk Lainnya </h3>

            <div class="row">

            <?php foreach ($new_product as $new_product) : ?>

<div class="col-md-3">
        <div class="card">
        <?php if ($new_product->product_img == NULL) : ?>
                <div class="img-wrap"><img class="img-fluid card-img-top" src="<?php echo base_url('assets/img/product/empty_image.jpg'); ?>"></div>
            <?php else : ?>
                <div class="img-wrap"><img class="img-fluid card-img-top" src="<?php echo base_url('assets/img/product/') . $new_product->product_img; ?>"></div>
            <?php endif; ?>
            <div class="card-body">
                <h5 class="card-title"><?php echo substr($new_product->product_name, 0, 25); ?></h5>
                Rp. <?php echo $new_product->product_price; ?>
                <a href="<?php echo base_url('product/detail/') . $new_product->product_slug; ?>" class="btn btn-sm btn-primary">Detail Produk</a>
            </div>
        </div>
    </div>

    


    <?php endforeach; ?>

    </div>



        </div>


        
    </div>

</div>