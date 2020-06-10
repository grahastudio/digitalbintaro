<?php $meta = $this->meta_model->get_meta();?>
<?php
//Notifikasi
if ($this->session->flashdata('message')) {
    echo '<div class="alert alert-success alert-dismissable fade show">';
    echo '<button class="close" data-dismiss="alert" aria-label="Close">×</button>';
    echo $this->session->flashdata('message');
    echo '</div>';
}
?>
<div class="card">
  <div id="printableArea">
    <div class="card-body row">
        <div class="col-sm-6">
            <h5>Telah terima Dari :</h5>
            <address>
                <strong><?php echo $view_pemasukan->client_title;?> <?php echo $view_pemasukan->client_name;?></strong><br>
                <i class="fas fa-home"></i> <?php echo $view_pemasukan->client_address;?><br>
                <i class="fas fa-phone"></i>  <?php echo $view_pemasukan->client_phone;?>
            </address>
        </div>
        <div class="col-sm-6 text-right">
            <h4>No. Invoice : <b><?php echo $view_pemasukan->no_invoice;?></b></h4>
            <h4 class="text-navy"></h4>
            <span>Status Pembayaran :</span><br>
            <span class="badge badge-success py-2 pl-3 pr-3"><?php echo $view_pemasukan->status_invoice;?></span>

            <p>
                <span><strong>Invoice Date:</strong> <?php echo date('D, d F Y', $view_pemasukan->date_created); ?></span><br/>
            </p>
        </div>

        <div class="table-responsive m-t">
            <table class="table invoice-table">
                <thead>
                <tr>
                    <th>Jenis Cetakan</th>
                    <th>Banyaknya</th>
                    <th>Total Harga</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><div><strong><?php echo $view_pemasukan->product_name;?></strong></div>
                        <small><?php echo $view_pemasukan->product_desc;?></small></td>
                    <td><?php echo $view_pemasukan->product_qty;?></td>
                    <td>Rp. <?php echo number_format($view_pemasukan->nominal, '0', ',', '.');?></td>
                </tr>

                </tbody>
                <tfoot>
                  <tr>
                      <th></th>
                      <th></th>
                      <th></th>
                  </tr>
                </tfood>

            </table>
        </div><!-- /table-responsive -->
    </div>
    <div class="card-body">Terima Kasih telah menggunakan jasa <?php echo $meta->title;?> - <?php echo $meta->tagline;?><br>
    Phone : <?php echo $meta->telepon;?><br>
    Email : <?php echo $meta->email;?><br>
    Email : <?php echo $meta->alamat;?><br>
    </div>

</div>
                            <div class="card-body">
                            <div>
                              <?php if ($view_pemasukan->status_invoice == 'Hutang') :?>
                                <?php echo form_open('admin/home/update_lunas/' .$view_pemasukan->id);?>
                                <button class="btn btn-danger bg-gradient-danger"><i class="fa fa-dollar"></i> Lunas</button>
                                <?php echo form_close();?>
                              <?php else:?>
                              <?php endif;?>
                                <button class="btn btn-primary bg-gradient-primary" type="button" onclick="printDiv('printableArea')"><i class="ti-printer"></i> Print</button>
                            </div>
                          </div>


                        </div>
