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

        <div class="col-lg-9">

            <div class="row">
               

                <?php foreach ($product as $product) : ?>


                <div class="col-md-4">
                        <div class="card">
                        <?php if ($product->product_img == NULL) : ?>
                                <div class="img-wrap"><img class="img-fluid card-img-top" src="<?php echo base_url('assets/img/product/empty_image.jpg'); ?>"></div>
                            <?php else : ?>
                                <div class="img-wrap"><img class="img-fluid card-img-top" src="<?php echo base_url('assets/img/product/') . $product->product_img; ?>"></div>
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo substr($product->product_name, 0, 25); ?></h5>
                                Rp. <?php echo $product->product_price; ?>
                                <a href="<?php echo base_url('product/detail/') . $product->product_slug; ?>" class="btn btn-sm btn-primary">Detail Produk</a>
                            </div>
                        </div>
                    </div>


                    <?php endforeach; ?>



                

            </div> <!-- row.// -->

        </div>

        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">Category Produk</div>
                <div class="card-body">
                    <?php foreach ($listcategory_product as $listcategory_product) : ?>
                        <ul>
                            <li><a href="<?php echo base_url('product/category_product/' . $listcategory_product->id); ?>"> <?php echo $listcategory_product->category_name; ?></a></li>
                        </ul>

                    <?php endforeach; ?>

                </div>
            </div>
        </div>


    </div>
</div>