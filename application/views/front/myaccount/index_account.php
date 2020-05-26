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
                    //Notifikasi
                    if ($this->session->flashdata('message')) {
                        echo '<div class="alert alert-success alert-dismissable fade show">';
                        echo '<button class="close" data-dismiss="alert" aria-label="Close">×</button>';
                        echo $this->session->flashdata('message');
                        echo '</div>';
                    }


                    ?>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="<?php echo base_url('assets/img/avatars/' . $user->user_image); ?>" class="img img-thumbnail rounded-circle img-fluid">
                            </div>
                            <div class="col-md-9">
                                <h2>Hallo, <?php echo $user->user_name; ?></h2>
                                <p>Selamat Datang di Web <b><?php echo $meta->title; ?></b></p>
                                <a href="<?php echo base_url('myaccount/update'); ?>" class="btn btn-primary btn-user ">
                                    Ubah Profile
                                </a>
                                <div class="row">
                                    <div class="col-3">
                                        Nama
                                    </div>
                                    <div class="col-9">
                                        : <?php echo $user->user_name; ?>
                                    </div>
                                    <div class="col-3">
                                        Email
                                    </div>
                                    <div class="col-9">
                                        : <?php echo $user->email; ?>
                                    </div>
                                    <div class="col-3">
                                        Phone
                                    </div>
                                    <div class="col-9">
                                        : <?php echo $user->user_phone; ?>
                                    </div>
                                    <div class="col-3">
                                        Alamat
                                    </div>
                                    <div class="col-9">
                                        : <?php echo $user->user_address; ?>
                                    </div>
                                    <div class="col-3">
                                        Tanggal Join
                                    </div>
                                    <div class="col-9">
                                        : Tanggal <?php echo date('d F Y', $user->date_created); ?>, Jam <?php echo date('h:i:s A', $user->date_created); ?>
                                    </div>
                                    <div class="col-3">
                                        Last Update
                                    </div>
                                    <div class="col-9">
                                        : Tanggal <?php echo date('d F Y', $user->date_updated); ?>, Jam <?php echo date('h:i:s A', $user->date_updated); ?>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php else : ?>

    <?php redirect('auth'); ?>


<?php endif; ?>