<!DOCTYPE html>
<html>
<head>
    <title>Ticketing</title>
    <link rel="icon" type="image/png" href="<?= base_url('assets/images/logo.png')?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/fonts_awesome/css/all.css'); ?>">

    <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
</head>
<body>
    <!-- Header Start -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a style="margin-left: 6%" class="navbar-brand" href="<?php echo base_url()?>index.php/C_Home/inputTiket">
            <img src="<?php echo base_url('assets/icon/brand.png'); ?>" width="100px">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
              
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto sub">
                <li class="nav-item ">
                    <a class="nav-link " href="<?php echo base_url() ?>index.php/C_Home/inputTiket">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo base_url()?>index.php/C_Home/manualPengguna">Manual Pengguna</a>
                </li>
                <li class="nav-item dropdown" >
                    <a id="tombol" class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ticketing
                    </a>
                    <div id="box" class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo base_url()?>index.php/C_Home/inputTiket">Input Ticket</a> 
                        <a class="dropdown-item" href="<?php echo base_url()?>index.php/C_Home/daftarTiket">Daftar Ticket</a>
                    </div>
                </li>
            </ul>
            <div class="nav-item my-2 my-lg-0"> 
                <div id="pojok"> 
                    <i class="fa fa-user" style="margin-right: 5px"></i><span>Hai , <?= $this->session->userdata('nama') ?></span>
                    <span><a style="text-decoration-line: none; color: black;margin-right: 100px;margin-left: 15px;" href="<?= base_url() ?>index.php/C_Login/logout">Log Out</a></span>
                </div>
            </div>
        </div>
    </nav>
    <!-- Header End -->
<div  style="background-color: white; padding: 0% 5% 0% 5%;border-radius: 3%;margin-bottom: 3%" class="container">
    <div class="row" style="margin-top: 14%;padding-top: 4%;">
        <div class="col-sm-6 text-right">
            <img src="<?php echo base_url('assets/images/helpdesk.png'); ?>" class="img-fluid" alt="" width="250px">
        </div>
        <div class="col-sm-6" style="margin-top: 50px">
            <h2>USER MANUAL</h2>
            <h4>HELPDESK SISFO APPLICATION</h4>
            <h5>for Employee</h5>
        </div>
    </div>
    <div style="margin-top: 50px">
        <h3 class="hr">APA ITU APLIKASI TICKETING HELPDESK SISFO</h3>
        <div class="text-justify" style="font-size: 20px">Aplikasi Helpdesk SISFO merupakan aplikasi yang terintegrasi pada 
            Hardware dan berfungsi sebagai media penyampaian keluhan dan permintaan 
            secara online. Aplikasi ini memfasilitasi pegawai ketika memiliki 
            permasalahan yang berkaitan dengan Hardware.</div>
        <img src="<?php echo base_url('assets/images/alur.png'); ?>" alt="" class="img-fluid" style="margin-top: 50px">
    </div>
    <button type="button" class="btn btn-danger btn-lg" data-toggle="collapse" data-target="#demo" style="margin: 100px 0">Cara Menggunakan</button>
    <div id="demo" class="collapse">
        <h5>Berikut langkah-langkah untuk menggunakan aplikasi Helpdesk SISFO:</h5>
        <p>1. Pilih aplikasi Helpdesk SISFO pada daftar menu aplikasi. Berikut tampilan sub-menu aplikasi Helpdesk SISFO</p>
        <img src="<?php echo base_url('assets/images/1.png'); ?>" alt="" class="img-fluid" width="80%">
        <p>2. Input Ticket</p>
        <img src="<?php echo base_url('assets/images/2 - Copy.png'); ?>" alt="" class="img-fluid" width="80%">
        <p>3. Daftar Ticket</p>
        <img src="<?php echo base_url('assets/images/3.png'); ?>" alt="" class="img-fluid" width="80%">
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#tombol").click(function() {
            $("#box").slideToggle("medium");
        })
    });
</script>
</body>
</html>