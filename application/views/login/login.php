<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login Page</title>
	<title>Ticketing</title>
    <link rel="icon" type="image/png" href="<?php echo base_url()?>assets/images/logo.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/login2.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/fonts_awesome/css/all.css'); ?>">

    <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
</head>
<body>
	<div id="cov">
		<?php if ($this->session->flashdata()) { ?>
        <div class="alert alert-warning">
            <?= $this->session->flashdata('msg'); ?>
        </div>
        <?php } ?>
		<div id="tx" class="text-center">
			<h4>Sistem Informasi</h4>
			<p>Area Bandung ISAS III</p>
			<h3>Silahkan Login</h3>
		</div> 
		<form method="post" action="<?php echo base_url()?>index.php/C_Login/auth">
			<input type="hidden" name="id" value="">
			<label for="Username" ><strong>Username</strong></label>
			<input type="text" class="form-control" name="username">
			<label for="Password" ><strong>Password</strong></label>
			<input type="password" class="form-control" name="password">
			<div id="cek">
				<input  type="checkbox" >
			    <label><small >Remember Me</small></label>
			    <input id="tombol" type="submit" class="btn btn-standart" value="Login">
			</div>		
		</form>
	</div>
</body>
</html>