<!DOCTYPE html>
<html>
<head>
    <title>Halaman Admin</title>
    <title>Ticketing</title>
    <link rel="icon" type="image/png" href="assets/img/logo.png">
    <meta charset="utf-8">
    <meta width, initial-scale=1, shrink-to-fit="no">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/fonts_awesome/css/all.css'); ?>">
</head>
<body>

    <!-- Content Start -->
        <div class="container" style="margin-top: 1%"> 
            <form method="POST" action="<?= $action ?>" class="wrap bg-danger">
                <?php 
                    date_default_timezone_set('Asia/Jakarta');
                    $now = date('Y-m-d H:i:s');
                    $expired = date('Y-m-d H:i:s', strtotime('second hour'));
                ?>
                <input type="hidden" name="masuk" value="<?= $now ?>">
                <input type="hidden" name="expired" value="<?= $expired ?>"> 
                <h3 class="text-center">Detail Tiket</h3>
                <hr style="border :0.2px solid white">
                <?= $this->session->flashdata('message') ?>
                <input type="hidden" class="form-control" name="id_tik" value="<?php echo $id_tik; ?>"/>
                <div class="form-group" style="margin: 0"> 
                    <label for="varchar">Nama </label>
                    <input type="text" class="form-control" placeholder="<?php echo $nama; ?>" disabled />
                </div>
                <div class="form-group" style="margin: 0">                    
                    <label for="varchar">Nip </label>
                    <input type="text" class="form-control" placeholder="<?php echo $nip; ?>" disabled />
                </div>
                <div class="form-group" style="margin: 0"> 
                    <label for="varchar">ruang </label>
                    <input type="text" class="form-control" placeholder="<?php echo $ruang; ?>" disabled />
                </div>
                <div class="form-group" style="margin: 0"> 
                    <label for="varchar">Jenis Kerusakan </label>
                    <input type="text" class="form-control" placeholder="<?php echo $jenis_kerusakan; ?>" disabled />
                    <?php echo form_error('jenis_kerusakan'); ?>
                </div>
                <div class="form-group" style="margin: 0"> 
                    <label for="varchar">Target Perbaikan </label>
                    <input type="text" class="form-control" placeholder="<?php echo $target_perbaikan; ?>" disabled />
                </div>
                <div class="form-group" style="margin: 0"> 
                    <label for="varchar">Deskripsi </label>
                    <textarea class="form-control" disabled placeholder="<?php echo $jenis_kerusakan; ?>"></textarea>
                </div>
                <div class="form-group" style="margin: 0"> 
                    <label for="varchar">Status </label>
                    <input type="text" class="form-control" disabled placeholder="<?php echo $status; ?>">
                </div>
                <div class="form-group"> 
                    <label for="varchar">Teruskan Ke </label>
                    <select class="form-control" name="penerima">
                        <option disabled selected><?= $penerima ?></option>
                        <?php foreach ($list_divisi as $key): 
                            $id_div = $key['id_div'];
                            $nama_divisi = $key['nama_divisi'];
                        ?>
                            <option value="<?=  $id_div ?>"><?= $nama_divisi ?></option>
                            
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="form-group"> 
                    <a style="width: 20%" class="btn btn-secondary" href="<?= base_url('index.php/C_Helpdesk');  ?>">Batal</a>
                    <button style="width: 20%;float: right;" type="submit" class="btn btn-primary"><?= $button ?></button>
                </div>
            </form>
        </div>
    <!-- Content End --> 
</body>
</html>