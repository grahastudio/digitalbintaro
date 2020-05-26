<div class="row">


    <div class="col-md-9">
        <div class="card">
            <div class="card-header bg-gradient-primary text-white">
                <?php echo $title; ?>
            </div>
            <div class="card-body">

                <?php
                echo form_open('admin/cabang/create')
                ?>


                <div class="form-group row">
                    <div class="col-md-3">Nama Lengkap</div>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="user_name" placeholder="Nama Lengkap" value="<?php echo set_value('user_name'); ?>">
                        <?php echo form_error('user_name', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">Nomor Hp</div>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="user_phone" placeholder="Nomor Handphone" value="<?php echo set_value('user_phone'); ?>">
                        <?php echo form_error('user_phone', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">Email</div>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="email" placeholder="Email Address" value="<?php echo set_value('email'); ?>">
                        <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3">Asrama</div>
                    <div class="col-md-9">
                        <select name="asrama_id" class="form-control form-control-chosen">

                            <option></option>
                            <?php foreach ($asrama as $asrama) { ?>
                                <option value="<?php echo $asrama->id ?>">
                                    <?php echo $asrama->asrama_name ?>
                                </option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('donatur_title', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3">Password</div>
                    <div class="col-md-9">
                        <input type="password" class="form-control" name="password1" placeholder="Password">
                        <?php echo form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">Ulangi Password</div>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" name="password2" placeholder="Repeat Password">

                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3"></div>
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary bg-gradient-primary">
                            Register Cabang
                        </button>
                    </div>

                    <?php echo form_close() ?>
                </div>

            </div>
        </div>
    </div>