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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/DataTables/datatables.css'); ?>">
    <script type="text/javascript" charset="utf8" src="<?php echo base_url('assets/DataTables/datatables.js'); ?>"></script>
</head>
<body>
	<!-- Header Start -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a style="margin-left: 6%" class="navbar-brand" href="<?php echo base_url()?>index.php/C_Operator">
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
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url()?>index.php/C_Operator/operator_rekapData">Rekap Data</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo base_url()?>index.php/C_Operator/list_opr">List Ticket</a>
                </li>
                <li class="nav-item ">
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
                    <a href="<?php echo base_url()?>index.php/C_Notifikasi/list_opr">Tandai Semua Dibaca</a>
            </div> 
                <span><a style="text-decoration-line: none; color: black;margin-right: 150px;" href="<?= base_url() ?>index.php/C_Login/logout">Log Out</a></span>
            </div>
        </div>
    </nav>
    <!-- Header End -->
    
    <!-- Content Start -->
    <div style="background-color: rgba(255, 255, 255, 0.96);padding : 2% 2% 2% 2%;margin-top : 6%;" class="container">
        <h3 class="text-center">Tiket Masuk</h3>
        <hr> 
        <?= $this->session->flashdata('message')  ?>
        <table align="" id="table_id" class="display table table-hover" cellspacing="0" width="100%">
            <thead>
                <tr>

                    <th>No</th>
                    <th>Id Tiket</th>
                    <th>Nama</th>
                    <th>Ruang</th> 
                    <th>Target Perbaikan</th> 
                    <th>Asignee</th>
                    <th>Expired</th>
                    <th>Status</th>
                    <th style="width: 15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        
    </div> 
    <!-- Content End -->   
    <script type="text/javascript">
        $(document).ready(function() {
            $("#tombol2").click(function() {
                $("#box2").slideToggle("medium");
            })
        });
        var table;
     
        $(document).ready(function() {
         
            //datatables
            table = $('#table_id').DataTable({

                responsive: {
                    details: true
                },
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
         
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('C_Operator/operator_list')?>",
                    "type": "POST"
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                    { 
                        "targets": [ 0 ], //first column / numbering column
                        "orderable": false, //set not orderable
                    },
                ], 
            }); 
        }); 
    </script>
</body>
</html>