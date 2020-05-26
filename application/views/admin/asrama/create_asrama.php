<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Tambah">
    <i class="fa fa-plus"></i> Tambah Baru
</button>

<div class="modal modal-default fade" id="Tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Asrama</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <?php
                //Form Open
                echo form_open(base_url('admin/asrama'));
                ?>

                <div class="form-group">
                    <label>Nama Asrama</label>
                    <input type="text" class="form-control" name="asrama_name" placeholder="Nama Asrama">
                    <?php echo form_error('asrama_name', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label>No. Telp. Asrama</label>
                    <input type="text" class="form-control" name="telp" placeholder="Telepon Asrama">
                    <?php echo form_error('telp', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label>Alamat Asrama</label>
                    <textarea class="form-control" name="alamat" placeholder="Alamat Asrama"></textarea>
                    <?php echo form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <label>Status Asrama <span class="text-danger">*</span>
                    </label>

                    <select name="asrama_status" class="form-control form-control-chosen">
                        <option value="Aktif">Aktif</option>
                        <option value="Nonaktif">Nonaktif</option>
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