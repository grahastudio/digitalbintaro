<div class="mb-4">
    <div class="card">
        <div class="card-header bg-gradient-primary">
            <h6 class="m-0 font-weight-bold text-white"><?php echo $title; ?></h6>
        </div>

        <div class="col-md-12">
            <?php echo form_open('admin/kas/filter_alkas'); ?>
            <div class="row my-3">



                <div class="col-lg-4 form-group">
                    <input type="text" name="start_date" class="form-control" placeholder="Dari Tanggal" id="start_date">

                </div>
                <div class="col-lg-4 form-group">
                    <input type="text" name="end_date" class="form-control" placeholder="Sampai Tanggal" id="end_date">

                </div>
                <div class="col-lg-4 form-group">
                    <button type="submit" class="btn btn-primary btn-block bg-gradient-primary"><i class="ti-search"></i> Tampilkan Data</button>
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
                            <th>kategori</th>
                            <th>Tipe</th>
                            <th>Pemasukan</th>
                            <th>Pengeluaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($searchalkas as $searchalkas) : ?>
                            <tr>
                                <td class="text-info"><?php echo $no; ?></td>
                                <td><?php echo date("d/m/Y", strtotime($searchalkas->tanggal)); ?></td>

                                <td>
                                    <?php if ($searchalkas->type == 'Pengeluaran') : ?>
                                        <div class="badge badge-danger bg-gradient-danger"><i class="fas fa-store"></i> <?php echo $searchalkas->asrama_name; ?></div><br>
                                        <i class="far fa-user"></i> <?php echo $searchalkas->user_name; ?>
                                    <?php else : ?>
                                        <div class="badge badge-danger bg-gradient-success"><i class="fas fa-store"></i> <?php echo $searchalkas->asrama_name; ?></div><br>
                                        <?php echo $searchalkas->donatur_title; ?> <?php echo $searchalkas->donatur_name; ?>
                                    <?php endif; ?>

                                </td>

                                <td><?php echo $searchalkas->category_name; ?></td>
                                <td>
                                    <?php if ($searchalkas->type == 'Pemasukan') : ?>
                                        <span class="badge badge-success bg-gradient-success"><?php echo $searchalkas->type; ?></span>
                                    <?php else : ?>
                                        <span class="badge badge-danger bg-gradient-danger"><?php echo $searchalkas->type; ?></span>
                                    <?php endif; ?>

                                </td>
                                <td>
                                    <?php if ($searchalkas->nominal == NULL) : ?>
                                        Rp. <?php echo '0'; ?>
                                    <?php else : ?>
                                        Rp. <?php echo number_format($searchalkas->nominal, '0', ',', '.') ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($searchalkas->pengeluaran == NULL) : ?>
                                        Rp. <?php echo '0'; ?>
                                    <?php else : ?>
                                        Rp. <?php echo number_format($searchalkas->pengeluaran, '0', ',', '.') ?>
                                    <?php endif; ?>
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
                            <th>Jumlah</th>
                            <th>Rp. <?php echo number_format($total_pemasukan_aldate, '0', ',', '.'); ?></th>
                            <th>Rp. <?php echo number_format($total_pengeluaran_aldate, '0', ',', '.'); ?></th>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="font-size:30px;"><b>SALDO</b></td>
                            <td colspan="3" style="font-size:30px;">
                                <?php $saldo = $total_pemasukan_aldate - $total_pengeluaran_aldate; ?>
                                <b> Rp. <?php echo number_format($saldo, '0', ',', '.'); ?></b>
                            </td>

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