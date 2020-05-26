<div class="mb-4">
    <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo $title; ?></h6>

            <a class="m-0 float-right btn btn-primary btn-md bg-gradient-primary" href="<?php echo base_url('admin/cabang/create'); ?>"> <i class="ti-plus mr-3"></i> Tambah FO </a>

        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <!-- <th>No</th> -->
                        <th>Nama</th>
                        <th>No. Handphone</th>
                        <th>Asrama</th>
                        <th>Status</th>

                        <th>Action</th>
                    </tr>
                </thead>
                <?php $no = 1;
                foreach ($list_cabang as $list_cabang) { ?>
                    <tr>
                        <!-- <td><?php echo $no; ?></td> -->
                        <td><?php echo $list_cabang->user_name; ?></td>
                        <td><?php echo $list_cabang->user_phone; ?></td>
                        <td><?php echo $list_cabang->asrama_name; ?></td>

                        <td>

                            <?php if ($list_cabang->is_active == 1) : ?>
                                <span class="badge badge-success">Aktif</span>
                            <?php else : ?>
                                <span class="badge badge-danger">Nonactive</span>
                            <?php endif; ?>

                        </td>

                        <td>
                            <?php if ($list_cabang->is_active == 0) : ?>
                                <a class="btn btn-success btn-sm" href="<?php echo base_url('admin/cabang/activated/' . $list_cabang->id); ?>"><i class="fas fa-user-times"></i> Activated</a>
                            <?php else : ?>
                                <a class="btn btn-danger btn-sm" href="<?php echo base_url('admin/cabang/banned/' . $list_cabang->id); ?>"><i class="fas fa-user-times"></i> Banned</a>

                            <?php endif; ?>

                            <?php include "hapus_cabang.php"; ?>
                            <?php include "view_cabang.php"; ?>





                        </td>
                    </tr>

                <?php $no++;
                }; ?>
            </table>

            <div class="pagination col-md-12 text-center">
                <?php if (isset($pagination)) {
                    echo $pagination;
                } ?>
            </div>

        </div>

    </div>
</div>