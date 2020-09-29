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
                    <a class="nav-link" href="<?php echo base_url() ?>index.php/C_Home/inputTiket">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url()?>index.php/C_Home/manualPengguna">Manual Pengguna</a>
                </li>
                <li class="nav-item dropdown active" >
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
    <div class="container-fluid" style="margin-top: 6%">
        <div style="background-color: rgba(255, 255, 255, 0.96);padding : 2% 2% 2% 2%;border-radius: 15px" class="container">
            <h3 style="margin : 0" class="text-center">DAFTAR TIKET</h3>
            <hr style="margin-bottom: 0">
            <?= $this->session->flashdata('msg') ?>
            <div class="row">
                <div class="col-md-4 form-inline">
                   
                    <form action="<?php echo site_url('C_Home/daftarTiket'); ?>" class="form-inline" method="get">
                        <div class="input-group">
                            
                        </div>
                    </form>
                    
                </div>
                <div class="col-md-4 text-center">
                    
                </div>
                <div class="col-md-4 text-right">
                    <form action="<?php echo site_url('C_Home/daftarTiket'); ?>" class="form-inline" method="get">
                        <div class="input-group">
                            <?php 
                                    if ($q <> '')
                                    {
                                        ?>
                                        <a href="<?php echo site_url('C_Home/daftarTiket'); ?>" class="btn btn-default">Reset</a>
                                        <?php
                                    }
                                ?>
                            <input type="search" class="form-control" name="q" value="<?php echo $q; ?>">
                            <span class="input-group-btn">
                              <button class="btn btn-primary" type="submit">Cari</button>
                            </span>
                                
                        </div>
                    </form>
                </div>
            </div>
            <table id="table" class="table table-striped table-hover table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>ID Tiket</th>
                  <th>Nama</th>
                  <th>Ruangan</th>
                  <th>Assignee</th>
                  <th style="width: 20%">Status</th>
                  <th>Feedback</th> 
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                    if( ! empty($ticket_data)){
                        foreach($ticket_data as $key):
                        $id=$key['id'];
                        $nama=$key['nama'];
                        $ruang=$key['ruang'];
                        $jenis=$key['jenis_kerusakan'];
                        $target=$key['target_perbaikan'];
                        $deskripsi=$key['deskripsi'];
                        $status=$key['status'];
                        $asignee=$key['penanggungjawab'];
                        $cek_feedback = $key['isi_feedback'];
                ?>
                  <tr>
                    <td><?= ++$start ?></td>
                    <td><?= $id ?></td>
                    <td><?= $nama ?></td>
                    <td><?= $ruang ?></td>
                    <?php if ($status == 'Tiket ditutup') {?>
                        <td><strong><?= $asignee ?></strong></td>
                        <?php if ($cek_feedback == 'Belum') {?>
                                <td><strong>Tiket Telah Ditutup</strong></td> 
                                <td><strong><a href="" style="text-decoration-line: none;" value="Konfirmasi" data-toggle="modal" data-target=".modalIsiFeedback<?= $id; ?>">Isi Feedback </a></strong></td>
                        <?php } else {?>
                                <td><strong>Tiket Telah Ditutup</strong></td>
                                <td><strong>Feedback Sudah Diisi</strong></td>
                        <?php }?>
                        <td><button class="btn btn-primary btn-sm" data-toggle="modal" data-target=".modalLihat<?= $id; ?>"><i class="fas fa-search-plus" ></i> Lihat</button></td>

                    <?php }else if($status == 'Tiket terkirim'){ ?>
                        <td><strong><?= $asignee ?></strong></td>
                        <td>Menunggu Konfirmasi</td>
                        <td>Menunggu Proses</td>
                        <td><button class="btn btn-primary btn-sm" data-toggle="modal" data-target=".modalLihat<?= $id; ?>"><i class="fas fa-search-plus" ></i> Lihat</button></td>
                    <?php }else if($status == 'Expired'){ ?>
                        <td><strong><?= $asignee ?></strong></td>
                        <td>Tiket <span style="color:red"><?= $status ?></span>.</td>
                        <td>Tiket <span style="color:red"><?= $status ?></span>.</td>
                        <td><button class="btn btn-primary btn-sm" data-toggle="modal" data-target=".modalLihat<?= $id; ?>"><i class="fas fa-search-plus" ></i> Lihat</button></td>
                    <?php }else{ ?>
                        <td><strong><?= $asignee ?></strong></strong></td> 
                        <td><?= $status ?></td>
                        <td>Menunggu Proses</td>
                        <td><button class="btn btn-primary btn-sm" data-toggle="modal" data-target=".modalLihat<?= $id; ?>"><i class="fas fa-search-plus" ></i> Lihat</button></td>
                    <?php } ?>
                  </tr>
                    <!-- Modal Lihat-->
                    <div class="modal fade modalLihat<?= $id; ?>" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Detail Tiket</h5>
                                </div>
                                <input type="hidden" name="id_tiket" value="<?=$id?>">
                                <input type="hidden" name="pnangan" value="<?= $this->session->userdata('nama') ?>">
                                <div class="modal-body mp">
                                    <span>Id tiket : <?= $id ?></span>
                                    <br>
                                        <span>Asignee : <?= $asignee ?></span>
                                    <br>
                                    <?php if ($status == 'Tiket terkirim'){ ?>
                                        <span>Status Tiket : <span style="color: red">Belum dikonfirmasi</span></span>
                                    <br>
                                    <?php } else { ?>
                                        <span>Status Tiket : <?= $status ?></span></span>
                                    <br>
                                    <?php } ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Lihat-->
                                    <form style="margin-top: 0" method="POST" action="<?= base_url()?>index.php/C_Feedback/tambahFeedback">
                    <div class="modal fade modalIsiFeedback<?= $id; ?>" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle"><strong>Isi Feedback</strong></h5>
                                </div>
                                <div class="modal-body mp">
                                        <div class="" lass="form-group">
                                            <input type="hidden" class="form-control" name="idus" value="<?= $this->session->userdata('idnya') ?>">
                                            <input type="hidden" class="form-control" name="idtik" value="<?= $id ?>">
                                        </div>
                                        <div class="form-group" read-only>
                                            <label>Nama :</label>
                                            <input type="text" class="form-control" name="nama" readonly value="<?= $this->session->userdata('nama') ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Email :</label>
                                            <input type="email" class="form-control" name="email" value="<?= $this->session->userdata('imel') ?>">
                                        </div>
                                       
                                        <div class="form-group">
                                            <label for="sel1">Apakah anda puas dengan pelayanan kami?</label>
                                            <div class="radio">
                                                <label><input value="Ya" type="radio" name="optradio" checked> Ya</label>
                                            </div>
                                            <div class="radio">
                                                <label><input value="Tidak" type="radio" name="optradio"> Tidak</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Deskripsi :</label>
                                            <textarea class="form-control" rows="5" name="deskripsi" placeholder="Write your feedback here ..."></textarea>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Kirim <i class="fas fa-paper-plane"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                                    </form>
                <?php 
                    endforeach;
                } else{
                            echo "<tr><td colspan='10' class='text-center'>Tidak Ada Data</td></tr>";
                        }
                ?>  
              </tbody>
            </table> 
            <div class="row">
                <div class="col-md-6">
                    <p>Total data : <?php echo $total_rows ?> Data</p>
                </div>
                <div class="col-md-6 text-right">
                    <?php echo $pagination ?>
                </div>
            </div>
        </div>
    </div> 

    <!-- Content End -->  
    <script type="text/javascript">
        $(document).ready(function() {
        $("#tombol").click(function() {
            $("#box").slideToggle("medium");
        })
    });
    </script>
</body>

</html>