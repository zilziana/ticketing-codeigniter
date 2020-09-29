<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Operator extends CI_Controller {

    public function __construct(){
        parent::__construct();

        $this->load->database();
        $this->load->library('session'); 
        $this->load->helper(array('url','form'));
        $this->load->model('M_Login');
        $this->load->model('M_Notifikasi');
        $this->load->model('M_Tiket'); 
        $this->load->model('M_Operator');
        $this->load->model('M_Feedback');
    }

    public function index()
    {
        $x = array(
            'pesan' => $this->M_Notifikasi->hitung_data_unread(),
            'data_pesan' => $this->M_Notifikasi->ambil_data_unread(),
            'tiket_diterima' => $this->M_Tiket->tiket_diteruskan(),
            'tiket_ditutup' => $this->M_Tiket->tiket_ditutup(),
            'tiket_pending' => $this->M_Tiket->tiket_pending()
        );
        $this->load->view('operator/home',$x);
    }

    public function list_opr()
    {
        $x = array(
            'pesan' => $this->M_Notifikasi->hitung_data_unread(),
            'data_pesan' => $this->M_Notifikasi->ambil_data_unread(), 
        );

        $this->load->view('operator/list_tiket',$x);
    }

    public function operator_list()
    {
        $list = $this->M_Operator->get_datatables();
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $us) {
            
            $id_tik = $us->id;
            $penerima = $us->penerima;
            $masuk = $us->masuk;
            $expired = $us->expired;
            $awal  = date_create($expired);
            $akhir = date_create(); // waktu sekarang
            $diff  = date_diff( $awal, $akhir );
            $status = $us->status;
            $jsnya = '<script type="text/javascript">
                                    $(document).ready(function() {
                                        $("#label'.$id_tik.'").hide();
                                        $("#boxx'.$id_tik.'").hide();

                                        $("#proses'.$id_tik.'").click(function(){
                                            $("#label'.$id_tik.'").hide();
                                            $("#boxx'.$id_tik.'").hide();
                                        });

                                        $("#ditangani'.$id_tik.'").click(function(){
                                            $("#label'.$id_tik.'").hide();
                                            $("#boxx'.$id_tik.'").hide();
                                        });

                                        $("#tutup'.$id_tik.'").click(function(){
                                            $("#label'.$id_tik.'").hide();
                                            $("#boxx'.$id_tik.'").hide();
                                        });

                                        $("#selesai'.$id_tik.'").click(function(){
                                            $("#label'.$id_tik.'").hide();
                                            $("#boxx'.$id_tik.'").hide();
                                        });

                                        $("#pending'.$id_tik.'").click(function(){
                                            $("#label'.$id_tik.'").show();
                                            $("#boxx'.$id_tik.'").show();
                                        });
                                    });
                                </script>';
///////////////////////////////////////////////////////////////////            
            $no++; 
            $row = array(); 
            $row[] = $no;
            $row[] = $id_tik;
            $row[] = $us->nama;
            $row[] = $us->ruang; 
            $row[] = $us->target_perbaikan; 
            if($status == 'Diteruskan'){
                if ($now > $expired) {
                    $row[] = 'Tiket telah Expired';
                    $row[] = 'Tiket telah Expired';
                }else{
/////////////////////////////////////////////////////modal  konfirmasi///////////////////////////////////////////////////////////////////////////////////                    
                    $row[] = '<span style="color: blue;cursor: pointer;" value="Konfirmasi" data-toggle="modal" data-target="#modalKonfirmasi'.$id_tik.'">Konfirmasi Tiket </span>
                                <form style="padding:0" method="post" action="'.base_url("/index.php/C_Operator/konfirmasi").'">
                                <!-- Modal Konfirmasi-->
                                    <div class="modal fade" id="modalKonfirmasi'.$id_tik.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Tiket</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <input type="hidden" name="id_tiket" value="'.$id_tik.'">
                                                <input type="hidden" name="awal" value="'.$masuk.'">
                                                <input type="hidden" name="pnangan" value="'.$this->session->userdata('nama').'">
                                                <div class="modal-body">
                                                    <h6>Anda yakin ingin mengkonfirmasi Tiket ?</h6>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>';
                    $row[] = ''.$diff->h.' jam : '.$diff->i.' menit ';
                    $row[] = 'Menunggu Konfirmasi';
/////////////////////////////////////////////////////modal lihat tiket belum konfirmasi///////////////////////////////////////////////////////////////////
                    $row[] = ' <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Modal_Lihat'.$id_tik.'"><i class="fas fa-search-plus"></i> Lihat</button>
                                <!-- Modal Delete tiket -->
                                <!-- Modal Start -->
                                <div class="modal fade" id="Modal_Lihat'.$id_tik.'" tabindex="-1" data-toggle="modal role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalScrollableTitle">Detail Tiket</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                             <p style="margin: 0">Id Tiket : '.$id_tik.'</p>
                                                <p style="margin: 0">Nama User : '.$us->nama.'</p>
                                                <p style="margin: 0">Ruang : '.$us->ruang.'</p> 
                                                <p style="margin: 0">Jenis Perangkat : '.$us->jenis_kerusakan.'</p>
                                                <p style="margin: 0">Masalah : '.$us->target_perbaikan.'</p>
                                                <p style="margin: 0">Deskripsi : '.$us->deskripsi.'</p>
                                                <p style="margin: 0">Deskripsi : '.$us->status.'</p>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        <button type="button" class="btn btn-primary" data-dismiss="modal" data-dismiss="modal" data-toggle="modal" data-target="#modalKonfirmasi'.$id_tik.'">Konfirmasi Tiket</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!-- Modal End -->
                                <!-- Modal Delete tiket -->';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                }
            }else if ($status == 'Tiket ditutup') {
               $row[] = $us->penanggungjawab;
               $row[] = '<strong>Tiket Telah Ditutup</strong>';
               $row[] = '<strong>Tiket Telah Ditutup</strong>';
               $row[] = '<a href="'.base_url("/index.php/C_Operator/read/".$id_tik."").'">History tiket --></a>';
            }else{
                $row[] = $us->penanggungjawab;
                if ($now > $expired) {
                    $row[] = '<span style="color:red">Tiket '.$status.'</span>';
                    $row[] = '<span style="color:red">Tiket '.$status.'</span>';
                    $row[] = '<a href="'.base_url("/index.php/C_Operator/read/".$id_tik."").'">History tiket --></a>';
                }else{
                    $row[] = ''.$diff->h.' jam : '.$diff->i.' menit ';
                }
                $row[] = $status;
/////////////////////////////////////////////////////modal edit tiket///////////////////////////////////////////////////////////////////////////////////////////////////////
                $row[] = '<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Modal_Edit'.$id_tik.'"><i class="fas fa-edit"></i> Edit</button>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Modal_Lihat'.$id_tik.'"><i class="fas fa-search-plus"></i> Lihat</button>
                                <!-- Modal Edit tiket -->
                                <!-- Modal Start -->
                                <form style="padding:0" method="post" action="'.base_url("/index.php/C_Operator/update_action").'">
                                      <div class="modal fade" id="Modal_Edit'.$id_tik.'" tabindex="-1" data-toggle="modal role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                  <div class="modal-content">
                                                        <div class="modal-header">
                                                              <h5 class="modal-title" id="exampleModalScrollableTitle">Ubah Status</h5>
                                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <input type="hidden" name="id_tiket" value="'.$id_tik.'">
                                                        <input type="hidden" name="pnangan" value="'.$this->session->userdata('nama').'">
                                                        <div class="modal-body"> 
                                                              <h6>Silahkan pilih status</h6>
                                                              <select name="status" class="form-control">
                                                                    <option id="proses'.$id_tik.'" value="Dalam proses">Dalam Proses</option>
                                                                    <option id="ditangani'.$id_tik.'" value="Sedang ditangani">Masalah sedang ditangani</option>
                                                                    <option id="pending'.$id_tik.'" value="Tiket Pending">Tertunda</option>
                                                                    <option id="selesai'.$id_tik.'" value="Selesai">Selesai</option>
                                                                    <option id="tutup'.$id_tik.'" value="Tiket ditutup">Tutup Tiket</option>
                                                              </select>
                                                                    <label id="label'.$id_tik.'">Alasan Pending</label>
                                                                    <textarea id="boxx'.$id_tik.'" class="form-control" name="alasan" placeholder="masukkan alasan anda"></textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                  </div>
                                            </div>
                                      </div>
                                </form>'
                                .$jsnya.
                                '<!-- Modal End -->
                                <!-- Modal Edit tiket -->
                                
                                <!-- Modal Lihat tiket -->
                                <!-- Modal Start -->
                                <div class="modal fade" id="Modal_Lihat'.$id_tik.'" tabindex="-1" data-toggle="modal role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalScrollableTitle">Detail Tiket</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                                <p style="margin: 0">Id Tiket : '.$id_tik.'</p>
                                                <p style="margin: 0">Nama User : '.$us->nama.'</p>
                                                <p style="margin: 0">Ruang : '.$us->ruang.'</p> 
                                                <p style="margin: 0">Jenis Perangkat : '.$us->jenis_kerusakan.'</p>
                                                <p style="margin: 0">Masalah : '.$us->target_perbaikan.'</p>
                                                <p style="margin: 0">Deskripsi : '.$us->deskripsi.'</p>
                                                <p style="margin: 0">Status : '.$us->status.'</p>
                                                <a href="'.base_url("/index.php/C_Operator/read/".$id_tik."").'">Lihat History tiket --></a>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#Modal_Edit'.$id_tik.'">Ubah Status</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!-- Modal End -->
                                <!-- Modal Lihat tiket -->';
            }
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->M_Operator->count_all(),
                        "recordsFiltered" => $this->M_Operator->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    
    public function read($id_us) 
    {
        $data = array(
            'data_his' => $this->M_Operator->get_history_by_id($id_us),
            'pesan' => $this->M_Notifikasi->hitung_data_unread(),
            'data_pesan' => $this->M_Notifikasi->ambil_data_unread(), 
            'data_pesan' => $this->M_Notifikasi->ambil_data_unread()
            
        );
        $this->load->view('operator/history', $data);
    }

    public function update_action() 
    {
        date_default_timezone_set('Asia/Jakarta');
        $now = date('H:i:s | d-m-Y');
        $idnya = $this->input->post('id_tiket');
        $status = $this->input->post('status');
        $pnangan = $this->input->post('pnangan');
        $pending = $this->input->post('alasan');

        $data = array(
            'status' => $status,
            'penanggungjawab' => $pnangan,
        );

        $data2 = array(
            'id_tiket' => $idnya,
            'perubahan' => 'Tiket telah diubah menjadi '.$status.' oleh '.$pnangan.'',
            'waktu' => date('Y-m-d H:i:s'),
            'alasan' => $pending
        );
        $add = $this->M_Operator->add_histori($data2);
        $cek = $this->M_Operator->update($idnya,$data);

        if ($cek == TRUE && $add == TRUE) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Status tiket diubah menjadi <strong> '.$status.'</strong>,  Waktu : '.$now.'</div>');
            redirect('C_Operator/list_opr');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert" style="width: 84%;margin-left: 8%">Gagal Edit User</div>');
            redirect('C_Operator/list_opr');
        } 
    }

    public function konfirmasi()
    { 
        date_default_timezone_set('Asia/Jakarta');
        $now = date('H:i:s | d-m-Y');
        $tgl_masuk = $this->input->post('awal');
        $nambah = date('Y-m-d H:i:s', strtotime('+1 days', strtotime($tgl_masuk)));
        $idnya = $this->input->post('id_tiket');
        $status = $this->input->post('status');
        $pnangan = $this->input->post('pnangan');

        $data = array(
            'expired' => $nambah,
            'status' => 'dikonfirmasi',
            'penanggungjawab' => $pnangan
        );

        $data2 = array(
            'id_tiket' => $idnya,
            'perubahan' => 'Tiket telah Dikonfirmasi oleh '.$pnangan.'',
            'waktu' => date('Y-m-d H:i:s'),
            'alasan' => '',
        );

        $add = $this->M_Operator->add_histori($data2);
        $cek = $this->M_Operator->update($idnya,$data);
        if ($cek == TRUE && $add == TRUE) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tiket telah <strong> Dikonfirmasi</strong>,  Waktu : '.$now.'</div>');
            redirect('C_Operator/list_opr');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal Konfirmasi</div>');
            redirect('C_Operator/list_opr');
        }
    }

    public function operator_rekapData()
    {
        $x = array(
            'pesan' => $this->M_Notifikasi->hitung_data_unread(),
            'data_pesan' => $this->M_Notifikasi->ambil_data_unread(),
        );

        $this->load->view('operator/rekapData',$x);
    } 

    public function operator_rekapData_result()
    {
        if ($this->M_Login->logged_in()){ 
            $awal = $this->input->post('tgl_awal');
            $akhir = $this->input->post('tgl_akhir');

            $x = array(
                'pesan' => $this->M_Notifikasi->hitung_data_unread(),
                'data_pesan' => $this->M_Notifikasi->ambil_data_unread(),
                'rekap' => $this->M_Operator->ambil_dataRekap($awal,$akhir),
                'data_pesan' => $this->M_Notifikasi->ambil_data_unread()
            );
            
            $this->load->view('operator/rekapData_result',$x); 
        }else{
            redirect('C_Home');
        } 
    }
    
    public function list_feedback()
    {
        $x = array(
            'pesan' => $this->M_Notifikasi->hitung_data_unread(),
            'data_pesan' => $this->M_Notifikasi->ambil_data_unread(), 
        );

        $this->load->view('operator/hasil_Feedback',$x);
    }
    
    public function lihat_feedback()
    {
        if ($this->M_Login->logged_in()){
            $list = $this->M_Feedback->get_datatables();

            $data = array();
            $no = $_POST['start'];
            foreach ($list as $us) {
                $no++; 
                $row = array(); 
                $row[] = $no;
                $row[] = $us->nama;
                $row[] = $us->email;
                $row[] = $us->kepuasan;
                $row[] = $us->deskripsi;
            }
            $data[] = $row;
            $output = array(
                            "draw" => $_POST['draw'],
                            "recordsTotal" => $this->M_Feedback->count_all(),
                            "recordsFiltered" => $this->M_Feedback->count_filtered(),
                            "data" => $data,
                    );
            //output to json format
            echo json_encode($output);
        }else{
            redirect('C_Home');
        } 
    }

    /*public function operator_daftar_keluhan()
    {
        if ($this->M_Login->logged_in()){   
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));

            if ($q <> '') {
                $config['base_url'] = base_url() . 'index.php/C_Operator/operator_daftar_keluhan?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'index.php/C_Operator/operator_daftar_keluhan?q=' . urlencode($q);
            } else {
                $config['base_url'] = base_url() . 'index.php/C_Operator/operator_daftar_keluhan';
                $config['first_url'] = base_url() . 'index.php/C_Operator/operator_daftar_keluhan';
            }

            $config['per_page'] = 10;
            $config['page_query_string'] = TRUE;
            $config['total_rows'] = $this->M_Tiket->jumlah_tiket($q);
            $ticket = $this->M_Tiket->get_limit_data($config['per_page'], $start, $q);

            $this->load->library('pagination');
            $this->pagination->initialize($config);
            $x = array(
                'ticket_data' => $ticket,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
                'pesan' => $this->M_Notifikasi->hitung_data_unread(),
                'data_pesan' => $this->M_Notifikasi->ambil_data_unread(),
            );

        $this->load->view('operator/daftar_Keluhan',$x);
    }else{
            redirect('C_Home');
        }
    } */
}