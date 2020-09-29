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
                <h3 class="text-center">Pendaftaran User</h3>
                <hr style="border :0.2px solid white">
                <?= $this->session->flashdata('message') ?>
                
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
                    <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Password minimal 6 karakter ,harus mengandung huruf besar, huruf kecil, dan angka" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" />
                    
                </div>
                <div class="form-group"> 
                    <label for="varchar">Email </label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
                    <?php echo form_error('email'); ?>
                </div>
                <div class="form-group"> 
                    <label for="level">Jabatan </label> <br>
                    <select id="change" class="form-control" name="level" required>
                        <option selected disabled="">-- Silahkan Pilih --</option>
                        <option id="tombol_hide" value="Pegawai">Pegawai</option>
                        <option id="tombol_hide2" value="Helpdesk">Helpdesk</option>
                        <option id="tombol_show" value="Opr">Operator</option>
                    </select> 
                </div>
                <div class="form-group" id="divisi"> 
                    <label for="divisi">Divisi </label> <br>
                    <select class="form-control" name="divisi" required>
                        <option selected value="1">-- Silahkan Pilih --</option>
                        <?php foreach ($div as $key): 
                            $divisi = $key['nama_divisi'];
                            $id_div = $key['id_div'];
                        ?>
                        <option  value="<?= $id_div ?>" ><?= $divisi  ?></option>
                    <?php endforeach ?>
                    </select> 
                    
                </div>
                <div class="form-group"> 
                    <button style="width: 20%;margin-left: 40%" type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                </div>
            </form>
        </div>
    <!-- Content End --> 
    <script type="text/javascript">
        $(document).ready(function() {

            $("#divisi").hide();

            $("#tombol_hide").click(function() {
                $("#divisi").hide();
            })

            $("#tombol_hide2").click(function() {
                $("#divisi").hide();
            })
 
            $("#tombol_show").click(function() {
                $("#divisi").show();
            }) 

        });
    </script>
</body>
</html>