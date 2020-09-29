<!DOCTYPE html>
<html>
<head> 
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
                <h3 class="text-center">Tambah Divisi</h3>
                <hr style="border :0.2px solid white">
                <?= $this->session->flashdata('message') ?>
                <div class="form-group"> 
                    <label for="varchar">Nama Divisi </label>
                    <input type="text" class="form-control" name="divisi" id="divisi" placeholder="nama divisi" />
                    <?php echo form_error('divisi'); ?>
                </div> 
                <div class="form-group"> 
                    <button style="width: 20%;margin-left: 40%" type="submit" class="btn btn-primary"><?php echo $button; ?></button> 
                </div>
                
                <?= $this->session->flashdata('back') ?> 
            </form>
        </div>
    <!-- Content End --> 
</body>
</html>