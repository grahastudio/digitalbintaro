<?php
//Notifikasi
if ($this->session->flashdata('message')) {
    echo '<div class="alert alert-success alert-dismissable fade show">';
    echo '<button class="close" data-dismiss="alert" aria-label="Close">×</button>';
    echo $this->session->flashdata('message');
    echo '</div>';
}
echo validation_errors('<div class="alert alert-warning">', '</div>');

?>
<!-- Invoice Example -->
<div class="mb-4">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-9">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $title; ?></h6>
                </div>
                <div class="col-md-3">
                            <a class="btn btn-primary btn-block bg-gradient-primary" href="<?php echo base_url('admin/product/create'); ?>">Buat Produk Baru <i class="ti-plus ml-3"></i></a>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th width="5%">No</th>
                        <th width="10%">Gambar</th>
                        <th>Nama Produk</th>
                        <th>Kategory</th>
                        <th>pageviews</th>
                        <th width="22%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($product as $product) : ?>
                        <tr>
                            <td class="text-info"><?php echo $no; ?></td>
                            <td><img src="<?php echo base_url('assets/img/product/' .$product->product_img); ?>" class="img-fluid"></td>
                            <td><?php echo $product->product_name; ?></td>
                            <td><?php echo $product->category_name; ?></td>
                            <td><?php echo $product->product_views; ?></td>
                            
                            <td>
                               
                                <a href="<?php echo base_url('admin/product/update/' . $product->id); ?>" class="btn btn-sm btn-info"><i class="ti-pencil-alt"></i> edit</a>
                                <?php include "delete_product.php"; ?>
                           
                        </tr>
                    <?php $no++;
                    endforeach; ?>

                </tbody>
               
            </table>
        </div>
        <div class="card-footer">



        </div>



    </div>

    <div class="pagination col-md-12 text-center mt-3">
        <?php if (isset($pagination)) {
            echo $pagination;
        } ?>
    </div>
</div>