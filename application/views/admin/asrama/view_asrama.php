<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#View<?php echo $asrama->id; ?>">
    <i class="fa fa-eye"></i> View
</button>

<div class="modal modal-default fade" id="View<?php echo $asrama->id ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Data Asrama</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label>Nama Asrama</label><br>
                    <b><?php echo $asrama->asrama_name ?></b>
                </div>
                <div class="form-group">
                    <label>No. Telp</label><br>
                    <b><?php echo $asrama->telp ?></b>
                </div>
                <div class="form-group">
                    <label>Alamat Asrama</label><br>
                    <b><?php echo $asrama->alamat ?></b>
                </div>
                <div class="form-group">
                    <label>Status Asrama</label><br>
                    <b>
                        <?php if ($asrama->asrama_status == 'Aktif') : ?>
                            <div class="badge badge-success"><?php echo $asrama->asrama_status ?></div>
                        <?php else : ?>
                            <div class="badge badge-danger"><?php echo $asrama->asrama_status ?></div>
                        <?php endif; ?>

                    </b>
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