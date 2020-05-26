<?php
//Notifikasi
if ($this->session->flashdata('message')) {
    echo '<div class="alert alert-success alert-dismissable fade show">';
    echo '<button class="close" data-dismiss="alert" aria-label="Close">×</button>';
    echo $this->session->flashdata('message');
    echo '</div>';
}
?>


<!-- Invoice Example -->
<div class="mb-4">
    <div class="card">
        <div class="card-header bg-gradient-primary">
            <h6 class="m-0 font-weight-bold text-white"><?php echo $title; ?></h6>

        </div>

        <div class="col-md-12">
            <?php echo form_open('admin/pemasukan/filter_pemasukan'); ?>
            <div class="row my-3">

                <div class="col-lg-3 form-group">
                    <select name="asrama" class="form-control">
                        <option value="">Pilih Asrama</option>
                        <?php foreach ($listasrama as $listasrama) { ?>
                            <option value="<?php echo $listasrama->id ?>">
                                <?php echo $listasrama->asrama_name ?>
                            </option>
                        <?php } ?>
                    </select>

                </div>

                <div class="col-lg-3 form-group">
                    <input type="text" name="start_date" class="form-control" placeholder="Dari Tanggal" id="start_date">

                </div>
                <div class="col-lg-3 form-group">
                    <input type="text" name="end_date" class="form-control" placeholder="Sampai Tanggal" id="end_date">

                </div>
                <div class="col-lg-3 form-group">
                    <button type="submit" class="btn btn-primary btn-block bg-gradient-primary"><i class="ti-search"></i> Tampilkan Data </button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>

        <div id="printableArea">

            <?php
            //Notifikasi
            if ($this->session->flashdata('messagefilter')) {
                echo '<div class="col-md-12"><div class="alert alert-info alert-dismissable fade show">';
                echo '<button class="close" data-dismiss="alert" aria-label="Close">×</button>';
                echo $this->session->flashdata('messagefilter');
                echo '</div></div>';
            }

            ?>

            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Tanggal</th>
                            <th>Asrama</th>
                            <th>Donatur</th>
                            <th>Kategori</th>
                            <th>Tipe</th>
                            <th>Nominal</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($filter_pemasukan as $filter_pemasukan) : ?>
                            <tr>
                                <td class="text-info"><?php echo $no; ?></td>
                                <td><?php echo date("d/m/Y", strtotime($filter_pemasukan->tanggal)); ?></td>
                                <td>
                                    <div class="badge badge-success bg-gradient-success"><i class="fas fa-store"></i> <?php echo $filter_pemasukan->asrama_name; ?></div><br>
                                    <i class="far fa-user"></i> <?php echo $filter_pemasukan->user_name; ?><br>
                                </td>
                                <td><?php echo $filter_pemasukan->donatur_title; ?> <?php echo $filter_pemasukan->donatur_name; ?></td>
                                <td><?php echo $filter_pemasukan->category_name; ?></td>
                                <td>
                                    <?php if ($filter_pemasukan->type == 'Pemasukan') : ?>
                                        <span class="badge badge-success bg-gradient-success"><?php echo $filter_pemasukan->type; ?></span>
                                    <?php else : ?>
                                        <span class="badge badge-danger"><?php echo $filter_pemasukan->type; ?></span>
                                    <?php endif; ?>

                                </td>
                                <td>
                                    <?php if ($filter_pemasukan->nominal == NULL) : ?>
                                        Rp. <?php echo '0'; ?>
                                    <?php else : ?>
                                        Rp. <?php echo number_format($filter_pemasukan->nominal, '0', ',', '.') ?>
                                    <?php endif; ?>

                                </td>
                                <td>
                                    <?php include "view_filter_pemasukan.php"; ?>
                                    <?php include "delete_filter_pemasukan.php"; ?>
                                </td>


                            </tr>
                            <tr>




                            </tr>
                        <?php $no++;

                        endforeach;
                        ?>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th width="5%"></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th style="font-size: 30px;">Jumlah</th>
                            <th style="font-size: 30px;">Rp. <?php echo number_format($total_pemasukan_date, '0', ',', '.'); ?></th>

                        </tr>

                    </tfoot>
                </table>
            </div>
        </div>
        <div class="card-footer">

            <button class="btn btn-primary bg-gradient-primary" type="button" onclick="printDiv('printableArea')"><i class="ti-printer"></i> Print</button>


        </div>



    </div>


</div>