<!DOCTYPE html>
<html>
<head>
	<title>Halaman Admin</title>
    <link rel="icon" type="image/png" href="<?php echo base_url()?>assets/images/logo.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/sidebar.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/fonts_awesome/css/all.css'); ?>">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/DataTables/datatables.css'); ?>">
    <script type="text/javascript" charset="utf8" src="<?php echo base_url('assets/DataTables/datatables.js'); ?>"></script>
    
</head>
<body>
	<!-- Start Sidebar -->
	<nav class="navbar navbar-expand-md navbar-dark bg-danger">
	  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <a class="navbar-brand" href="<?= base_url() ?>index.php/C_Home/admin_home">
	    <img src="<?php echo base_url()?>assets/images/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
	    <span class="menu-collapsed">Admin</span>
	  </a>
	  <div class="collapse navbar-collapse" id="navbarNavDropdown">
	    <ul class="navbar-nav">
	      
	      <li class="nav-item dropdown d-sm-block d-md-none">
	        <a class="nav-link dropdown-toggle" href="" id="smallerscreenmenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          Menu
	        </a>
	        <div class="dropdown-menu" aria-labelledby="smallerscreenmenu">
	            <a class="dropdown-item" href="<?= base_url() ?>index.php/C_Home/admin_home">Dashboard</a>
	            <a class="dropdown-item" href="#submenu2">Profile</a>
	            <a class="dropdown-item" href="#submenu2">Profile</a>
	            <a class="dropdown-item" href="#submenu2">Profile</a>
	            <a class="dropdown-item" href="#submenu2">Profile</a>
	            <a class="dropdown-item" href="#submenu2">Profile</a>
	            <a class="dropdown-item" href="#submenu2">Profile</a>
	            <a class="dropdown-item" href="#submenu2">Profile</a>
	            <a class="dropdown-item" href="#submenu2">Profile</a>
	            <a class="dropdown-item" href="#submenu2">Profile</a>
	            <a class="dropdown-item" href="#submenu2">Profile</a>
	        </div>
	      </li>
	      
	    </ul>
	  </div>
	</nav>


	<div class="row" id="body-row">
	    <div id="sidebar-container" class="sidebar-expanded d-none d-md-block">
	        <ul class="list-group">
	            <a href="<?= base_url() ?>index.php/C_Home/admin_home" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
	                    <span class="fa fa-tachometer-alt fa-fw mr-3"></span>
	                    <span class="menu-collapsed">Dashboard</span> 
	            </a> 
	            <a href="#submenu2" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
	                <div class="d-flex w-100 justify-content-start align-items-center">
	                    <span class="fa fa-users fa-fw mr-3"></span>
	                    <span class="menu-collapsed">User</span>
	                    <span class="fa fa-caret-down ml-auto"></span>
	                </div>
	            </a>
	            <div id='submenu2' class="collapse sidebar-submenu">
	                <a href="<?= base_url() ?>index.php/C_Home/admin_add_user" class="list-group-item list-group-item-action bg-dark text-white">
	                    <span class="menu-collapsed">Daftarkan User</span>
	                </a>
	                <a href="<?= base_url() ?>index.php/C_Home/admin_list_pengguna" class="list-group-item list-group-item-action bg-dark text-white">
	                    <span class="menu-collapsed">Data user</span>
	                </a>
	            </div>
	            <a href="#submenu3" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
	                <div class="d-flex w-100 justify-content-start align-items-center">
	                    <span class="fa fa-list fa-fw mr-3"></span>
	                    <span class="menu-collapsed">Layanan</span>
	                    <span class="fa fa-caret-down ml-auto"></span>
	                </div>
	            </a>
	            <div id='submenu3' class="collapse sidebar-submenu">
	                <a href="<?= base_url() ?>index.php/C_Home/admin_add_layanan" class="list-group-item list-group-item-action bg-dark text-white">
	                    <span class="menu-collapsed">Tambah Layanan</span>
	                </a>
	                <a href="<?= base_url() ?>index.php/C_Home/admin_layanan" class="list-group-item list-group-item-action bg-dark text-white">
	                    <span class="menu-collapsed">Data Layanan</span>
	                </a>
	            </div>
	            <a href="#submenu4" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
	                <div class="d-flex w-100 justify-content-start align-items-center">
	                    <span class="fas fa-users-cog fa-fw mr-3"></span>
	                    <span class="menu-collapsed">Divisi</span>
	                    <span class="fa fa-caret-down ml-auto"></span>
	                </div>
	            </a>
	            <div id='submenu4' class="collapse sidebar-submenu">
	                <a href="<?= base_url() ?>index.php/C_Home/admin_add_Divisi" class="list-group-item list-group-item-action bg-dark text-white">
	                    <span class="menu-collapsed">Tambah Divisi</span>
	                </a>
	                <a href="<?= base_url() ?>index.php/C_Home/admin_list_divisi" class="list-group-item list-group-item-action bg-dark text-white">
	                    <span class="menu-collapsed">Data Divisi</span>
	                </a>
	            </div>
	           	<a href="<?= base_url() ?>index.php/C_Home/admin_home" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
	                    <span class="fa fa-user fa-fw mr-3"></span>
	                    <span class="menu-collapsed">Profil</span> 
	            </a> 
	            <a href="<?= base_url() ?>index.php/C_Login/logout" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
	                <div class="d-flex w-100 justify-content-start align-items-center">
	                    <span class="fa fa-sign-out-alt fa-fw mr-3"></span>
	                    <span class="menu-collapsed">Logout</span>
	                </div>
	            </a>
	        </ul> 
    </div> 
    <!-- End Sidebar -->
</body>
</html>