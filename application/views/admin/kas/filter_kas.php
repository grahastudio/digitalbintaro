<div class="mb-4">
    <div class="card">
        <div class="card-header bg-gradient-primary">
            <h6 class="m-0 font-weight-bold text-white">Pemasukan</h6>



        </div>

        <div class="col-md-12">
            <?php echo form_open('admin/kas/filter_kas'); ?>
            <div class="row my-3">

                <div class="col-lg-3 form-group">
                    <select name="asrama_id" class="form-control">
                        <option value="">Pilih Asrama</option>
                        <?php foreach ($listasrama as $listasrama) { ?>
                            <option value="<?php echo $listasrama->id ?>">
                                <?php echo $listasrama->asrama_name ?>
                            </option>
                        <?php } ?>
                    </select>

                </div>

                <div class="col-lg-3 form-group">
                    <input type="text" name="start_date" class="form-control" placeholder="Tanggal" id="start_date">

                </div>
                <div class="col-lg-3 form-group">
                    <input type="text" name="end_date" class="form-control" placeholder="Tanggal" id="end_date">

                </div>
                <div class="col-lg-3 form-group">
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
                            <th>Nama</th>
                            <th>kategori</th>
                            <th>Tipe</th>
                            <th>Pemasukan</th>
                            <th>Pengeluaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($searchkas as $searchkas) : ?>
                            <tr>
                                <td class="text-info"><?php echo $no; ?></td>
                                <td><?php echo date("d/m/Y", strtotime($searchkas->tanggal)); ?></td>

                                <td>
                                    <?php if ($searchkas->type == 'Pengeluaran') : ?>
                                        <div class="badge badge-danger bg-gradient-danger"><i class="fas fa-store"></i> <?php echo $searchkas->asrama_name; ?></div><br>
                                        <i class="far fa-user"></i> <?php echo $searchkas->user_name; ?>
                                    <?php else : ?>
                                        <div class="badge badge-danger bg-gradient-success"><i class="fas fa-store"></i> <?php echo $searchkas->asrama_name; ?></div><br>
                                        <?php echo $searchkas->donatur_title; ?> <?php echo $searchkas->donatur_name; ?>
                                    <?php endif; ?>

                                </td>

                                <td><?php echo $searchkas->category_name; ?></td>
                                <td>
                                    <?php if ($searchkas->type == 'Pemasukan') : ?>
                                        <span class="badge badge-success bg-gradient-success"><?php echo $searchkas->type; ?></span>
                                    <?php else : ?>
                                        <span class="badge badge-danger bg-gradient-danger"><?php echo $searchkas->type; ?></span>
                                    <?php endif; ?>

                                </td>
                                <td>
                                    <?php if ($searchkas->nominal == NULL) : ?>
                                        Rp. <?php echo '0'; ?>
                                    <?php else : ?>
                                        Rp. <?php echo number_format($searchkas->nominal, '0', ',', '.') ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($searchkas->pengeluaran == NULL) : ?>
                                        Rp. <?php echo '0'; ?>
                                    <?php else : ?>
                                        Rp. <?php echo number_format($searchkas->pengeluaran, '0', ',', '.') ?>
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
                            <th>Rp. <?php echo number_format($total_pemasukan_date, '0', ',', '.'); ?></th>
                            <th>Rp. <?php echo number_format($total_pengeluaran_date, '0', ',', '.'); ?></th>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="font-size:30px;"><b>SALDO</b></td>
                            <td colspan="3" style="font-size:30px;">
                                <?php $saldo = $total_pemasukan_date - $total_pengeluaran_date; ?>
                                <b> Rp. <?php echo number_format($saldo, '0', ',', '.'); ?></b>
                            </td>

                        </tr>
                    </tfoot>
                </table>

            </div>



        </div>





        <div class="card-footer">

            <button class="btn btn-primary bg-gradient-primary" type="button" onclick="printDiv('printableArea')">Print</button>


        </div>



    </div>


</div>