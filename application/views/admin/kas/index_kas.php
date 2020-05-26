<div class="mb-4">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="m-0 font-weight-bold text-primary">Pemasukan</h6>
                </div>
                <div class="col-md-3">
                    <a class="m-0 float-right btn btn-primary btn-md btn-block bg-gradient-primary" href="<?php echo base_url('admin/kas/filter_kas'); ?>"> Filter per Asrama <i class="fas fa-store ml-3"></i></a>

                </div>
                <div class="col-md-3">
                    <a class="m-0 float-right btn btn-primary btn-md btn-block bg-gradient-primary" href="<?php echo base_url('admin/kas/filter_alkas'); ?>"> Filter Data Per tanggal <i class="fa fa-calendar ml-3"></i></a>
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
                        <th>Kategori</th>
                        <th>Tipe</th>
                        <th>Pemasukan</th>
                        <th>Pengeluaran</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($kas as $kas) : ?>
                        <tr>
                            <td class="text-info"><?php echo $no; ?></td>
                            <td><?php echo date("d/m/Y", strtotime($kas->tanggal)); ?></td>
                            <td>
                                <?php if ($kas->type == 'Pengeluaran') : ?>
                                    <div class="badge badge-danger bg-gradient-danger"><i class="fas fa-store"></i> <?php echo $kas->asrama_name; ?></div><br>
                                    <i class="far fa-user"></i> <?php echo $kas->user_name; ?>
                                <?php else : ?>
                                    <div class="badge badge-success bg-gradient-success"><i class="fas fa-store"></i> <?php echo $kas->asrama_name; ?></div><br>
                                    <?php echo $kas->donatur_title; ?> <?php echo $kas->donatur_name; ?>
                                <?php endif; ?>

                            </td>
                            <td><?php echo $kas->category_name; ?></td>
                            <td>
                                <?php if ($kas->type == 'Pemasukan') : ?>
                                    <span class="badge badge-success bg-gradient-success"><?php echo $kas->type; ?></span>
                                <?php else : ?>
                                    <span class="badge badge-danger bg-gradient-danger"><?php echo $kas->type; ?></span>
                                <?php endif; ?>

                            </td>
                            <td>
                                <?php if ($kas->nominal == NULL) : ?>
                                    Rp. <?php echo '0'; ?>
                                <?php else : ?>
                                    Rp. <?php echo number_format($kas->nominal, '0', ',', '.') ?>
                                <?php endif; ?>
                            </td>
                            <td><?php if ($kas->pengeluaran == NULL) : ?>
                                    Rp. <?php echo '0'; ?>
                                <?php else : ?>
                                    Rp. <?php echo number_format($kas->pengeluaran, '0', ',', '.') ?>
                                <?php endif; ?></td>

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
                        <th>Jumlah</th>

                        <th>Rp. <?php echo number_format($total_pemasukan, '0', ',', '.'); ?></th>
                        <th>Rp. <?php echo number_format($total_pengeluaran, '0', ',', '.'); ?></th>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="font-size:30px;"><b>SALDO</b></td>
                        <td colspan="2" style="font-size:30px;">
                            <?php $saldo = $total_pemasukan - $total_pengeluaran; ?>
                            <b> Rp. <?php echo number_format($saldo, '0', ',', '.'); ?></b>
                        </td>

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