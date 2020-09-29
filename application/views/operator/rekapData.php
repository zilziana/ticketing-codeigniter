<!DOCTYPE html>
<html>
<head>
	<title>Halaman operator</title>
    <title>Ticketing</title>
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/images/logo.png'); ?>"> 
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

        <a style="margin-left: 6%" class="navbar-brand" href="<?php echo base_url()?>index.php/C_Home/operator_home">
            <img src="<?php echo base_url('assets/icon/brand.png'); ?>" width="100px">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
              
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url()?>index.php/C_Operator">Home <span class="sr-only">(current)</span></a>
                </li> 
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo base_url()?>index.php/C_Operator/operator_rekapData">Rekap Data</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url()?>index.php/C_Operator/list_opr">List Ticket</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url()?>index.php/C_Operator/list_feedback">Feedback Pengguna</a>
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
                    <a href="<?php echo base_url()?>index.php/C_Notifikasi/see_all_list">Lihat Semua Tiket</a>
                    <br>
                    <a href="<?php echo base_url()?>index.php/C_Notifikasi/operator_rekapData">Tandai Semua Dibaca</a>
            </div> 
                <span><a style="text-decoration-line: none; color: black;margin-right: 150px;" href="<?= base_url() ?>index.php/login_Controller/logout">Log Out</a></span>
            </div>
        </div>
    </nav>
    <!-- Header End -->

    <!-- Content Start -->
    <div class="container" style="margin-top: 6%">
        <div class="container-fluid"> 
            <form method="POST" action="<?= base_url()?>index.php/C_Operator/operator_rekapData_result" class="wrap">
                <h3 class="text-center">Rekap Data</h3>
                <hr style="border :0.2px solid white;width: 40%">
                <div class="form-group"> 
                    <label for="nama">Tanggal Awal :</label> 
                    <input type="date" class="form-control" name="tgl_awal" required>
                </div>
                <div class="form-group"> 
                    <label for="usern">Tanggal Akhir :</label> 
                    <input type="date" class="form-control" name="tgl_akhir" required>
                </div>

                <div class="form-group"> 
                    <input value="Submit" style="width: 20%;margin-left: 40%" type="submit" class="btn btn-standart">
                </div> 
            </form>
        </div>
    </div>
    <!-- Content End --> 
    <script type="text/javascript">
        $(document).ready(function() {
            $("#tombol").click(function() {
                $("#box").slideToggle("slow");
            })
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#tombol2").click(function() {
                $("#box2").slideToggle("slow");
            })
        });
    </script>
</body>
</html>