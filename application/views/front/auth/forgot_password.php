<?php $meta = $this->meta_model->get_meta(); ?>
<div class="container">
    <div class="col-md-6 mx-auto">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->

                <div class="p-5">
                    <div class="text-center">
                        <img width="70%" class="img-fluid" src="<?php echo base_url('assets/img/logo/' . $meta->logo) ?>">
                        <hr>
                        <h2 class="h5 text-gray-900 mb-4">Masukan Email Akun Anda?</h2>
                        <?php echo $this->session->flashdata('message'); ?>
                    </div>
                    <?php
                    $attributes = array('class' => 'user');
                    echo form_open('auth/forgotpassword', $attributes)
                    ?>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="email" id="email" placeholder="Enter Email Address..." value="<?php echo set_value('email'); ?>">
                        <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>


                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Reset Password
                    </button>

                    <?php echo form_close() ?>
                    <hr>

                    <div class="text-center">
                        <a class="small" href="<?php echo base_url('auth') ?> ">Back to Login</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>