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
                <div class="col-md-6">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $title; ?></h6>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-primary btn-block bg-gradient-primary" href="<?php echo base_url('admin/pemasukan/filter_pemasukan'); ?>"> Lihat Data Asrama<i class="fas fa-store ml-3"></i></a>
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-primary btn-block bg-gradient-primary" href="<?php echo base_url('admin/pemasukan/filter_alpemasukan'); ?>">Lihat Data per tanggal <i class="fa fa-calendar ml-3"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Tanggal</th>
                        <th>Cabang</th>
                        <th>Nama Donatur</th>
                        <th>Kategori</th>
                        <th>Nominal</th>
                        <th width="22%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($pemasukan as $pemasukan) : ?>
                        <tr>
                            <td class="text-info"><?php echo $no; ?></td>
                            <td><?php echo date("d/m/Y", strtotime($pemasukan->tanggal)); ?></td>
                            <td><i class="fas fa-store"></i>
                                <?php echo $pemasukan->asrama_name; ?><br>
                                <i class="far fa-user"></i> <?php echo $pemasukan->user_name; ?>
                            </td>
                            <td><?php echo $pemasukan->donatur_title; ?> <?php echo $pemasukan->donatur_name; ?></td>
                            <td><span class="badge badge-success"><?php echo $pemasukan->category_name; ?></span></td>
                            <td>
                                <?php if ($pemasukan->nominal == NULL) : ?>
                                    Rp. <?php echo '0'; ?>
                                <?php else : ?>
                                    Rp. <?php echo number_format($pemasukan->nominal, '0', ',', '.') ?>
                                <?php endif; ?>

                            </td>
                            <td>
                                <?php include "view_pemasukan.php"; ?>
                                <!-- <a href="<?php echo base_url('admin/pemasukan/update/' . $pemasukan->id); ?>" class="btn btn-sm btn-info"><i class="ti-pencil-alt"></i> edit</a> -->
                                <?php include "delete_pemasukan.php"; ?>
                            </td>
                        </tr>
                    <?php $no++;
                    endforeach; ?>

                </tbody>
                <tfoot>
                    <tr>
                        <th width="5%"></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th style="font-size: 30px;">Jumlah</th>
                        <th style="font-size: 30px;">Rp. <?php echo number_format($total_pemasukan, '0', ',', '.'); ?></th>
                        <th width="22%"></th>
                    </tr>
                </tfoot>
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