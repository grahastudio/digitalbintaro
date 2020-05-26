<section class="boot-elemant-bg py-md-5 py-4" style="background-color:darkblue;height: 500px; background-image: linear-gradient(rgba(0,0,0,.5), rgba(0,0,0,.5)), url('assets/img/galery/bg.jpg');">
    <div class="container position-relative py-md-5 py-0">
        <div class="row">
            <div class="container" style="position: absolute;">
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <div class="text-right text-white">
                            <h1><b>Example headline.</b></h1>
                            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                            <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
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
            <div class="card counter col-md-12">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-3">
                                    <div style="font-size:50px;">
                                        <i class="far fa-user"></i>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div style="font-size:50px;">9000</div>
                                    Anak Yatim
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-3">
                                    <div style="font-size:50px;">
                                        <i class="far fa-user"></i>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div style="font-size:50px;font-weight:700;">40</div>
                                    Cabang
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-3">
                                    <div style="font-size:50px;">
                                        <i class="far fa-user"></i>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div style="font-size:50px;">1200</div>
                                    Aktifitas
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



            <div class="col-md-8 p-md-5">
                <h1> Rasulullah shallallahu
                    ‘alaihi wa sallam
                    bersabda</h1>
                Sedekah dapat menghapus dosa
                sebagaimana air memadamkan api.”
                (HR. Tirmidzi, di shahihkan Al Albani
                dalam Shahih At Tirmidzi, 614)
            </div>
            <div class="col-md-4 form-signup">
                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title">Daftar jadi Donatur</h5>
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