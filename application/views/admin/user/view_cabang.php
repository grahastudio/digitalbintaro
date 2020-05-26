<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Edit<?php echo $list_cabang->id; ?>">
    <i class="ti-eye"></i> Lihat
</button>

<div class="modal modal-default fade" id="Edit<?php echo $list_cabang->id ?>">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Cabang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3">
                        <img src="<?php echo base_url('assets/img/avatars/' . $list_cabang->user_image); ?>" class="img-thumbnail img-fluid" />
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <label class="col-4">Nama</label>
                            <div class="col-8">
                                : <b><?php echo $list_cabang->user_name ?></b>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-4">Email</label>
                            <div class="col-8">
                                : <b><?php echo $list_cabang->email ?></b>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-4">Nomor HP</label>
                            <div class="col-8">
                                : <b><?php echo $list_cabang->user_phone ?></b>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-4">Alamat</label>
                            <div class="col-8">
                                : <b><?php echo $list_cabang->user_address ?></b>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->