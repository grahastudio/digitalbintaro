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
                <div class="col-md-3">
                    <a class="m-0 float-right btn btn-primary bg-gradient-primary btn-block" href="<?php echo base_url('admin/pengeluaran/filter_pengeluaran'); ?>"> Lihat Data Asrama <i class="fas fa-store ml-3"></i></a>
                </div>
                <div class="col-md-3">
                    <a class="m-0 float-right btn btn-primary bg-gradient-primary btn-block" href="<?php echo base_url('admin/pengeluaran/filter_alpengeluaran'); ?>">Filter Data Per tanggal <i class="fa fa-calendar ml-3"></i></a>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Tanggal</th>
                        <th>Asrama</th>
                        <th>Kategory</th>
                        <th>Tipe</th>
                        <th>Nominal</th>
                        <th width="22%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($pengeluaran as $pengeluaran) : ?>
                        <tr>
                            <td class="text-info"><?php echo $no; ?></td>
                            <td><?php echo date("d/m/Y", strtotime($pengeluaran->tanggal)); ?></td>
                            <td>
                                <i class="fas fa-store"></i> <?php echo $pengeluaran->asrama_name; ?><br>
                                <i class="far fa-user"></i> <?php echo $pengeluaran->user_name; ?><br>
                            </td>
                            <td><?php echo $pengeluaran->category_name; ?></td>
                            <td><span class="badge badge-danger"><?php echo $pengeluaran->type; ?></span></td>
                            <td>
                                <?php if ($pengeluaran->pengeluaran == NULL) : ?>
                                    Rp. <?php echo "0"; ?>
                                <?php else : ?>
                                    Rp. <?php echo number_format($pengeluaran->pengeluaran, '0', ',', '.') ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php include "view_pengeluaran.php"; ?>
                                <!-- <a href="<?php echo base_url('admin/pengeluaran/update/' . $pengeluaran->id); ?>" class="btn btn-sm btn-info"><i class="ti-pencil-alt"></i> edit</a> -->
                                <?php include "delete_pengeluaran.php"; ?>
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
                        <th style="font-size: 30px;">Rp. <?php echo number_format($total_pengeluaran, '0', ',', '.'); ?></th>
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