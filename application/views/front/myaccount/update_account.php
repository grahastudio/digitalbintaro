<?php if ($this->session->userdata('id')) : ?>

    <div class="breadcrumb-default">
        <div class="container">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('') ?>"><i class="ti ti-home"></i> Home</a></li>
                <li class="breadcrumb-item active"><?php echo $title ?></li>
            </ul>
        </div>
    </div>

    <div class="margin-top container">
        <div class="row">
            <div class="col-md-3">

            </div>

            <div class="col-md-9">
                <div class="card">

                    <?php
                    echo form_open_multipart('myaccount/update');
                    ?>

                    <div class="card-body">
                        <h2>Ubah Profile, <?php echo $user->user_name; ?></h2>

                        <div class="row">

                            <div class="col-3">
                                Foto
                            </div>
                            <div class="col-9">
                                <div class="input-group">
                                    <input type="file" name="user_image">
                                    <img src="<?php echo base_url('assets/img/avatars/' . $user->user_image); ?>" width="50%" class="img img-thumbnail">
                                </div>

                            </div>

                            <div class="col-3">
                                Nama
                            </div>
                            <div class="col-9">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="user_name" placeholder="Nama" value="<?php echo $user->user_name; ?>">
                                    <?php echo form_error('user_name', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>

                            </div>
                            <div class="col-3">
                                Email
                            </div>
                            <div class="col-9">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="email" value="<?php echo $user->email; ?>" readonly>
                                </div>

                            </div>
                            <div class="col-3">
                                Phone
                            </div>
                            <div class="col-9">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="user_phone" placeholder="No. Handphone" value="<?php echo $user->user_phone; ?>">
                                    <?php echo form_error('user_phone', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>

                            </div>
                            <div class="col-3">
                                Alamat
                            </div>
                            <div class="col-9">
                                <div class="form-group">
                                    <textarea class="form-control" name="user_address" placeholder="Alamat"><?php echo $user->user_address; ?></textarea>
                                    <?php echo form_error('user_phone', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="col-3">

                            </div>
                            <div class="col-9">
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Update Profile
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>


<?php else : ?>

    <?php redirect('auth'); ?>

<?php endif; ?>