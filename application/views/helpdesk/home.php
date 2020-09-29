    <!DOCTYPE html>
<html>
<head>
	<title>Halaman helpdesk</title>
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/images/logo.png'); ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/fonts_awesome/css/all.css'); ?>">

    <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
    <style type="text/css">
        .mb-3 {
            max-width: 25rem;
            cursor: default;
        }
        .col-5 i{
            color: white;
        }

    </style>
</head>
<body>
	<!-- Header Start -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">

        <a style="margin-left: 6%" class="navbar-brand" href="<?php echo base_url()?>index.php/C_Home/helpdesk_home">
            <img src="<?php echo base_url('assets/icon/brand.png'); ?>" width="100px">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
              
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link active" href="<?php echo base_url()?>index.php/C_Home/helpdesk_home">Home <span class="sr-only">(current)</span></a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url()?>index.php/C_Home/helpdesk_tiketMasuk">Tiket masuk</a>
                </li> 
            </ul>
            <div style="margin-right: 1%">Hai, <strong><?= $this->session->userdata('nama') ?> :)</strong> </div>
            <div class="nav-item my-2 my-lg-0 dropdown"> 
            <button id="tombol2" id="dropdownMenuButton" type="button" class="btn btn-standart" style="margin-right: 30px" data-toggle="dropdown"><i class="fa fa-bell" aria-hidden="true"></i> <span><?= $pesan?></span></button>
                <div id="box2" class="dropdown-menu" aria-labelledby="navbarDropdown" style="padding-left: 20px;padding-right: 20px">

                <?php
                    if ($pesan == 0){
                        echo "<p>Tidak ada Notifikasi</p>";
                    }else{
                        foreach($data_pesan->result_array() as $key):
                            $id = $key['id'];
                            $nama = $key['nama'];
                            $ruangan = $key['ruang'];
                            $rusak = $key['target_perbaikan'];
                            $status = $key['notif_status'];
                            if ($status == 1) {?>
                                <div class="dropdown-item">
                                    <p style="margin: 0 0 0 0">Nama : <?=$nama?></p>
                                    <p style="margin: 0 0 0 0">Ruangan : <?=$ruangan?></p>
                                    <p style="margin: 0 0 0 0">Keluhan : <?=$rusak?></p>
                                </div>
                                <hr style="width:100%"> 
                <?php            }   
                        endforeach;
                    }
                ?>
                    <a href="<?php echo base_url()?>index.php/C_Helpdesk">Lihat Semua Tiket</a>
                    <br>
                    <a href="<?php echo base_url()?>index.php/C_Helpdesk/edit_notif_home">Tandai Semua Dibaca</a>
            </div> 
                <span><a style="text-decoration-line: none; color: black;margin-right: 150px;" href="<?= base_url() ?>index.php/C_Login/logout">Log Out</a></span>
            </div>
        </div>
    </nav>
    <!-- Header End -->

    <!-- Content Start -->
    <div class="container" style="margin-top: 1%">
        <div class="alert alert-primary" role="alert">
            <h5>Selamat datang , <?= $this->session->userdata('nama')  ?></h5>
        </div>  
        <div class="row" style="margin-top: 2%"> 
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body" style="display: flex;">
                        <div class="col-5">
                            <i class="far fa-clipboard fa-3x"></i>
                        </div>
                        <div class="col-7">
                            <p style="margin: 0">Tiket Masuk</p>
                            <h4><?= $tiket_diterima ?></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body" style="display: flex;">
                        <div class="col-5">
                            <i class="far fa-check-circle fa-3x"></i>
                        </div>
                        <div class="col-7">
                            <p style="margin: 0">Tiket Diteruskan</p>
                            <h4><?= $tiket_diteruskan ?></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-body" style="display: flex;">
                        <div class="col-5">
                            <i class="far fa-clock fa-3x"></i>
                        </div>
                        <div class="col-7">
                            <p style="margin: 0">Tiket Selesai</p>
                            <h4><?= $tiket_ditutup ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content End --> 

    <script type="text/javascript">
        $(document).ready(function() {
            $("#tombol2").click(function() {
                $("#box2").slideToggle("medium");
            })
        });
    </script>
</body>
</html>