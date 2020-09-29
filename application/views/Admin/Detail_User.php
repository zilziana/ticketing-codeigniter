<!DOCTYPE html>
<html>
<head>
    <title>Halaman Admin</title>
    <title>Ticketing</title>
    <link rel="icon" type="image/png" href="<?= base_url('assets/images/logo.png')?>">
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
                <h3 class="text-center">Edit User</h3>
                <hr style="border :0.2px solid white">
                <?= $this->session->flashdata('sukses') ?>
                <input type="hidden" class="form-control" name="id_user" id="id" value="<?php echo $id_user; ?>"/>
                <div class="form-group"> 
                    <label for="varchar">Nama </label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
                    <?php echo form_error('nama'); ?>
                </div>
                <div class="form-group"> 
                    <label for="varchar">Username </label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
                    <?php echo form_error('username'); ?>
                </div>
                <div class="form-group"> 
                    <label for="varchar">Nip </label>
                    <input type="text" class="form-control" name="nip" id="nip" placeholder="Nip" value="<?php echo $nip; ?>" />
                    <?php echo form_error('nip'); ?>
                </div>
                <div class="form-group"> 
                    <label for="varchar">Password </label>
                    <input type="text" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" />
                    <?php echo form_error('password'); ?>
                </div>
                <div class="form-group"> 
                    <label for="varchar">Email </label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
                    <?php echo form_error('email'); ?>
                </div>
                <div class="form-group"> 
                    <label for="varchar">Level </label>
                    <?php if ($level == 'Opr'){ 
                        $jjj = 'Operator'; ?>
                        <input type="text" class="form-control" name="level" id="level" placeholder="Level" value="<?php echo $jjj; ?>" disabled />
                    <?php }else{?>
                        <input type="text" class="form-control" name="level" id="level" placeholder="Level" value="<?php echo $level; ?>" disabled />
                    <?php } ?>
                    <?php echo form_error('level'); ?>
                </div>
                <div class="form-group"> 
                    <?php if ($level != 'Opr'){ ?>
                    <label for="divisi">Divisi </label><br>
                        <select class="form-control" name="divisi" required>
                            <option value="<?= $id_divisi ?>"><?= $select ?></option>
                        </select>
                    <?php }else{ ?>
                    <label for="divisi">Divisi </label><br>
                        <select class="form-control" name="divisi" required>
                            <option value="<?= $id_divisi ?>"><?= $select ?></option>
                            <?php foreach ($list_divisi as $key): 
                                $divisi = $key['nama_divisi'];
                                $id_div = $key['id_div'];
                                
                                if ($divisi == "NONE"){?>
                                    <option disabled value="<?= $id_div ?>"><?= $divisi  ?></option>        
                                <?php }else if($id_div != $id_divisi){?>
                                    <option value="<?= $id_div ?>"><?= $divisi  ?></option>
                                <?php } ?>
                            
                            <?php endforeach ?>
                        </select>
                    <?php } ?>
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