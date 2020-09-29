<!DOCTYPE html>
<html>
<head>
    <title>Halaman Admin</title>
    <title>Ticketing</title>
    <link rel="icon" type="image/png" href="assets/img/logo.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/fonts_awesome/css/all.css'); ?>">
</head>
<body> 
    <!-- Content Start -->
        <div class="container" style="margin-top: 1%"> 
            <form method="POST" action="<?= $action ?>" class="wrap bg-danger">
                <h3 class="text-center">Edit Layanan</h3>
                <hr style="border :0.2px solid white">
                <?= $this->session->flashdata('sukses') ?>
                <input type="hidden" class="form-control" name="id_kel" id="id" value="<?php echo $id_kel; ?>"/>
                <div class="form-group"> 
                    <label for="varchar">Jenis Perangkat </label>
                    <select class="form-control" name="jenis" required>
                        <option value="<?= $id_jen ?>"><?php echo $jenis; ?></option>
                        <?php foreach ($list_jenis as $key): 
                            $jenis = $key['jenis'];
                            $id_jenis = $key['id_jenis'];
                        ?>
                        <option value="<?= $id_jenis ?>"><?= $jenis  ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group"> 
                    <label for="varchar">Nama Layanan </label>
                    <input type="text" class="form-control" name="layanan" id="layanan" placeholder="Nama Layanan" value="<?php echo $masalah; ?>" />
                    <?php echo form_error('layanan'); ?>
                </div>
                <div class="form-group"> 
                    <a style="width: 20%" class="btn btn-secondary" href="<?= base_url('index.php/C_Admin');  ?>">Batal</a>
                    <button style="width: 20%;float: right;" type="submit" class="btn btn-primary"><?= $button ?></button>
                </div>
            </form>
        </div>
    <!-- Content End --> 
</body>
</html>