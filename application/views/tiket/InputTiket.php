<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>Ticketing</title>
    <link rel="icon" type="image/png" href="<?= base_url('assets/images/logo.png')?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/fonts_awesome/css/all.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.css')?> ">

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
                    <a class="nav-link active" href="<?php echo base_url() ?>index.php/C_Home/inputTiket">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url()?>index.php/C_Home/manualPengguna">Manual Pengguna</a>
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

    <!-- Content Start -->
    <div id="one" class="container-fluid">
        <div class="container"> 
            <form method="POST" action="<?= base_url()?>index.php/C_Tiket/aksi_tambahTiket" class="wrap">
                <h3 class="text-center">INPUT TICKETING</h3> 
                <hr>
                <?php 
                    date_default_timezone_set('Asia/Jakarta');
                    $now = date('Y-m-d H:i:s');
                    $expired = date('Y-m-d H:i:s', strtotime('second hour'));
                ?>
                <input type="hidden" name="masuk" value="<?= $now ?>">
                <input type="hidden" name="expired" value="<?= $expired ?>"> 
                <div class="form-group">
                <?= $this->session->flashdata('info'); ?>
                </div>
                <div class="form-group"> 
                    <label for="nama">Nama :</label> 
                    <input type="text" class="form-control" name="nama" readonly value="<?= $this->session->userdata('nama') ?>" required>
                    <input type="hidden" class="form-control" name="id_user" value="<?= $this->session->userdata('idnya') ?>">
                </div>
                <div class="form-group">
                    <label for="ruang">Ruang : </label>
                    <input type="" class="form-control" name="ruang">
                </div>

                <div class="form-group">
                    <label for="sel1">Kategori :</label>
                    <select class="form-control" name="one" id="select1">
                        <option value="0" disabled selected>Pilih Kategori Perangkat</option>
                        <?php
                            foreach($data->result_array() as $i):
                                $id=$i['id_jenis'];
                                $nama=$i['jenis'];
                        ?>
                        <option value="<?php echo $id ?>"><?= $nama ?></option>
                        <?php endforeach;?>
                    </select>
                    
                </div>  

                <div class="form-group">
                    <label for="sel1">Layanan : </label>
                    <select class="two form-control" id="select2" name="two">
                        <option value="0" disabled selected>Pilih Layanan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi Masalah :</label>
                    <textarea class="form-control" rows="3" name="deskripsi"></textarea>
                </div>

                <div class="form-group"> 
                    <input style="width: 20%;margin-left: 40%" type="submit" value="Input Tiket" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
    </div>
    <!-- Content End --> 

    <script>
    $(document).ready(function(){ 
        $("#loading").hide();
        $("#select1").change(function(){ 
            $("#select2").hide(); 
            $("#loading").show(); 

            $.ajax({
                type: "POST", 
                url: "<?php echo base_url("index.php/C_Masalah/getPilihanKeluhan"); ?>", 
                data: {id : $("#select1").val()}, 
                dataType: "json",
                beforeSend: function(e) {
                    if(e && e.overrideMimeType) {
                    e.overrideMimeType("application/json;charset=UTF-8");
                    }
                },
                success: function(response){
                    $("#loading").hide(); 
                    $("#select2").html(response.listKel).show();
                    },
                error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    });
    $(document).ready(function() {
        $("#tombol").click(function() {
            $("#box").slideToggle("medium");
        })
    });


</script>

</body>

</html>