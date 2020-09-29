<!DOCTYPE html>
<html>
<head>
	<title>Halaman Operator</title>
    <link rel="icon" type="image/png" href="assets/img/logo.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/fonts_awesome/css/all.css'); ?>">
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
                            <p style="margin: 0">Total User</p>
                            <h4><?= $user_total ?></h4>
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
                            <p style="margin: 0">Jumlah Admin</p>
                            <h4><?= $admin_total ?></h4>
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
                            <p style="margin: 0">Jumlah Pegawai</p>
                            <h4><?= $user_total ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <!-- Content End -->  
</body>
</html>