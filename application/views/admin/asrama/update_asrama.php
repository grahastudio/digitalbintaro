<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Edit<?php echo $asrama->id; ?>">
    <i class="fa fa-edit"></i> Edit
</button>

<div class="modal modal-default fade" id="Edit<?php echo $asrama->id ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Asrama</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <?php
                //Error warning
                echo validation_errors('<div class="alert alert-warning">', '</div>');

                echo form_open(base_url('admin/asrama/update/' . $asrama->id));

                ?>

                <div class="form-group">
                    <label>Nama Asrama</label>
                    <input type="text" class="form-control" name="asrama_name" value="<?php echo $asrama->asrama_name ?>">
                </div>
                <div class="form-group">
                    <label>No. Telp</label>
                    <input type="text" class="form-control" name="telp" value="<?php echo $asrama->telp ?>">
                </div>
                <div class="form-group">
                    <label>Alamat Asrama</label>
                    <textarea class="form-control" name="alamat"><?php echo $asrama->alamat ?></textarea>
                </div>

                <div class="form-group">
                    <label>Status Asrama</label>
                    <select name="asrama_status" class="form-control form-control-chosen">
                        <option value="Aktif">Aktif</option>
                        <option value="Nonaktif" <?php if ($asrama->asrama_status == "Nonaktif") {
                                                        echo "selected";
                                                    } ?>>Nonaktif</option>
                    </select>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="submit" value="Simpan Data">
                </div>


                <?php
                //Form Close
                echo form_close();
                ?>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary pull-right" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->