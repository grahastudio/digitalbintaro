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
                <?php foreach ($products as $products) : ?>

                    <div class="col-md-4">
                        <figure class="card card-product">
                            <?php if ($products->product_img == NULL) : ?>
                                <div class="img-wrap"><img class="img-fluid" src="<?php echo base_url('assets/img/product/empty_image.jpg'); ?>"></div>
                            <?php else : ?>
                                <div class="img-wrap"><img class="img-fluid" src="<?php echo base_url('assets/img/product/') . $products->product_img; ?>"></div>
                            <?php endif; ?>

                            <figcaption class="info-wrap">
                                <h5 class="title"><?php echo substr($products->product_name, 0, 25); ?></h5>

                                <div class="rating-wrap">
                                    <div class="label-rating">
                                        <?php if ($products->product_stock == 0) : ?>
                                            Stok : <span class="badge badge-danger"> Habis</span>
                                        <?php else : ?>
                                            Stok : <span class="badge badge-success"><?php echo $products->product_stock; ?></span>
                                        <?php endif; ?>


                                    </div>
                                    <div class="label-rating">
                                        <?php if ($products->product_price == Null) { ?>
                                        <?php } else {; ?>
                                            Rp. <?php echo $products->product_price; ?>
                                        <?php }; ?>

                                    </div>
                                </div> <!-- rating-wrap.// -->
                            </figcaption>
                            <div class="bottom-wrap text-center">
                                <a href="<?php echo base_url('products/detail/') . $products->product_slug; ?>" class="btn btn-sm btn-primary">Detail Produk</a>


                            </div> <!-- bottom-wrap.// -->
                        </figure>
                    </div> <!-- col // -->
                <?php endforeach; ?>

            </div> <!-- row.// -->

        </div>

        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">Category Produk</div>
                <div class="card-body">
                    <?php foreach ($listcategory_products as $listcategory_products) : ?>
                        <ul>
                            <li><a href="<?php echo base_url('products/category_products/' . $listcategory_products->id); ?>"> <?php echo $listcategory_products->category_product_name; ?></a></li>
                        </ul>

                    <?php endforeach; ?>

                </div>
            </div>
        </div>


    </div>
</div>