<!-- Invoice Example -->
<?php
//Notifikasi
if ($this->session->flashdata('message')) {
    echo '<div class="alert alert-success">';
    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>';
    echo $this->session->flashdata('message');
    echo '</div>';
}
echo validation_errors('<div class="alert alert-warning">', '</div>');

?>

<div class="mb-4">
    <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Pemasukan</h6>
            <?php include "create_asrama.php"; ?>
        </div>
        <div class="table-responsive">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Asrama</th>
                        <th>Status</th>
                        <th width="23%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($asrama as $asrama) : ?>
                        <tr>
                            <td class="text-info"><?php echo $no; ?></td>
                            <td><?php echo $asrama->asrama_name; ?></td>
                            <td><?php echo $asrama->asrama_status; ?></td>
                            <td>

                                <?php include "view_asrama.php"; ?>
                                <?php include "update_asrama.php"; ?>
                                <?php include "delete_asrama.php"; ?>
                            </td>
                        </tr>
                    <?php $no++;
                    endforeach; ?>

                </tbody>
            </table>
        </div>
        <div class="card-footer"></div>
    </div>
</div>