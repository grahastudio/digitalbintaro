<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete<?php
                                                                                            echo $pengeluaran->id ?>">
    <i class="ti-trash"></i> Hapus
</button>

<div class="modal fade" id="Delete<?php echo $pengeluaran->id ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title"> Menghapus Data</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-window-close"></i></span></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda Yakin Ingin Menghapus Data Pemasukan Tanggal <b><?php echo date("d/m/Y", strtotime($pengeluaran->tanggal)); ?></b>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
                <a href="<?php echo base_url('admin/pengeluaran/delete/' . $pengeluaran->id); ?>" class="btn btn-danger pull-right"><i class="fa fa-close"></i> Ya, Hapus Data</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->