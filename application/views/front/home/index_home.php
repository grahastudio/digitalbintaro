<section class="boot-elemant-bg py-md-5 py-4" style="background-color:darkblue;height: 350px; background-image: linear-gradient(to right, rgba(0,0,0,.0), rgba(0,0,0,0)), url('assets/img/galery/bg.jpg');">
    <div class="container position-relative py-md-5 py-0">
        <div class="row">
            <div class="container" style="position: absolute;">
                <div class="row">
                    <div class="col-md-6">
                        <img class="img-fluid" src="<?php echo base_url('assets/img/galery/gambar.png');?>">
                    </div>
                    <div class="col-md-6">
                        <div class="text-right text-dark">
                            <h1><b>Example headline.</b></h1>
                            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                            <!-- <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="elemant-bg-overlay black"></div>
</section>


<section class="bg-white">
    <div class="container">

        <div class="row">
            <div class="counter col-md-12">
                
                    <div class="row">
                        <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div style="font-size:50px;color:#00a2e9;">
                                        <i class="ti-thumb-up"></i>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <h4>Hasil Cetak Bagus</h4>
                                    Kami memberikan hasil cetak maksimal
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-4">
                        <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div style="font-size:50px;color:#00a2e9;">
                                        <i class="ti-wallet"></i>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <h4>Harga Kompetitif</h4>
                                    Harga murah dan sangat terjangkau
                                </div>
                            </div>
                        </div>
                        </div>
                        </div>
                        <div class="col-md-4">
                        <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div style="font-size:50px;color:#00a2e9;">
                                        <i class="ti-headphone-alt"></i>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <h4>Support 1x24 Jam</h4>
                                    Kami siap melayani anda kapanpun
                                </div>
                            </div>
                        </div>
                        </div>
                        </div>
                    </div>
                
            </div>
        </div>




    </div>
</section>


<section class="bg-white">
    <div class="container">
        <div class="row">



            <div class="col-md-8">
                <h3 class="my-3">Produk & Layanan</h3>
                <div class="row">

                <?php foreach ($product_home as $product_home) :?>
                    <div class="col-md-4">
                        <div class="card">
                            <img class="card-img-top" src="<?php echo base_url('assets/img/product/' .$product_home->product_img);?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">Banner</h5>
                                <a href="#" class="btn btn-primary btn-sm">Order Sekarang</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>  

                </div>
            </div>
            <div class="col-md-4 form-signup my-3">
                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title">Daftar jadi Pelanggan</h5>
                        <hr>

                        <?php
                        echo form_open('auth/register')
                        ?>
                        <div class="form-group">
                            <select class="form-control form-control-chosen" name="user_title" value="">
                                <option value='Bapak'>Bapak</option>
                                <option value='Ibu'>Ibu</option>
                                <option value='Saudara'>Saudara</option>
                                <option value='Saudari'>Saudari</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="user_name" placeholder="Nama Lengkap" value="<?php echo set_value('user_name'); ?>">
                            <?php echo form_error('user_name', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="user_phone" placeholder="Nomor Handphone" value="<?php echo set_value('user_phone'); ?>">
                            <?php echo form_error('user_phone', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" placeholder="Email Address" value="<?php echo set_value('email'); ?>">
                            <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control" name="password1" placeholder="Password">
                                <?php echo form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" name="password2" placeholder="Repeat Password">

                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">
                            Register Account
                        </button>

                        <?php echo form_close() ?>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="<?php echo base_url('auth/forgotpassword'); ?>">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="<?php echo base_url('auth') ?>">Already have an account? Login!</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>