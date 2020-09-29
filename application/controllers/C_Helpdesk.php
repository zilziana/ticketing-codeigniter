<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Helpdesk extends CI_Controller {


	public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Helpdesk');
        $this->load->model('M_Tiket');
        $this->load->model('M_Notifikasi');
        $this->load->helper('url');
    }

    public function index()
    {
        $x = array( 
            'pesan' => $this->M_Notifikasi->hitung_data_unread(),
            'data_pesan' => $this->M_Notifikasi->ambil_data_unread()
        );

        $this->load->view('helpdesk/tiketMasuk',$x);
    }

    public function home()
    {
        $x = array(
            'tiket_diterima' => $this->M_Tiket->tiket_diterima(),
            'tiket_ditutup' => $this->M_Tiket->tiket_ditutup(),
            'tiket_diteruskan' => $this->M_Tiket->tiket_diteruskan_helpdesk(),
            'pesan' => $this->M_Notifikasi->hitung_data_unread(),
            'data_pesan' => $this->M_Notifikasi->ambil_data_unread()
        );

        $this->load->view('helpdesk/home',$x);
    }

	public function edit_notif_home(){
        $this->M_Notifikasi->update();
        redirect('C_Helpdesk/home');
    }

    public function edit_notif_list(){
        $this->M_Notifikasi->update();
        redirect('C_Helpdesk');
    }

	public function ajax_list_tiket()
    {
        $list = $this->M_Helpdesk->get_datatables();
        $divv = $this->M_Helpdesk->get_divisi();

        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $data = array();
        $no = $_POST['start'];

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
///////////////////////////////////////////////////////////////////            
            $no++; 
            $row = array(); 
            $row[] = $no;
            $row[] = $us->nama; 
            $row[] = $us->nip;
            $row[] = $us->ruang;
            $row[] = $us->jenis_kerusakan;
            $row[] = $us->target_perbaikan;
            if ($now > $expired) {
                $row[] = $us->penanggungjawab;
                $row[] = 'Tiket telah ditutup';
                $row[] = 'Tiket telah ditutup';
            }else if($status == 'Diteruskan'){
                if ($now > $expired) {
                    $row[] = 'Tiket telah Expired';
                    $row[] = 'Tiket telah Expired';
                }else{
                    $row[] = '<span style="color: blue;cursor: pointer;" value="Konfirmasi" data-toggle="modal" data-target="#modalKonfirmasi<?= $id; ?>">Konfirmasi Tiket </span>';
                    $row[] = ''.$diff->h.' jam : '.$diff->i.' menit ';
                    $row[] = 'Menunggu Konfirmasi';
                }
            }else{ 
                $row[] = $us->penanggungjawab;
                if ($now > $expired) {
                    $row[] = 'Tiket expired';
                }else{
                    $row[] = ''.$diff->h.' jam : '.$diff->i.' menit ';

                }
                $row[] = $status;
            }
            $row[] = '  
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Modal_Lihat'.$id_tik.'"><i class="fas fa-search-plus"></i> Lihat</button> 
                        <a href="'.'C_Helpdesk/update/'.$id_tik.''.'"><button class="btn btn-danger btn-sm"><i class="fas fa-share"></i> Teruskan</button></a>

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
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Modal End -->
                        <!-- Modal Delete tiket -->
                      ';

            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->M_Helpdesk->count_all(),
                        "recordsFiltered" => $this->M_Helpdesk->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }


    public function update($id_us) 
    {
        $row = $this->M_Helpdesk->get_by_id($id_us);
        $divisi = $this->M_Helpdesk->get_divisi();

        if ($row) {
            $data = array(
                'button' => 'Kirim',
                'action' => site_url('C_Helpdesk/update_action'),
                'id_tik' => $row->id,
                'nama' => set_value('nama', $row->nama),
                'nip' => set_value('nip', $row->nip),
                'ruang' => set_value('ruang', $row->ruang),
                'jenis_kerusakan' => set_value('jenis_kerusakan', $row->jenis_kerusakan),
                'target_perbaikan' => set_value('target_perbaikan', $row->target_perbaikan),
                'deskripsi' => $row->deskripsi,
                'status' => $row->status,
                'penerima' => $row->nama_divisi,
                'list_divisi' => $divisi
            );
            $this->load->view('helpdesk/Detail_Tiket', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('C_Helpdesk'));
        }
    }

    public function update_action() 
    {
        $idd = $this->input->post('id_tik');
        $data = array(
    		'penerima' => $this->input->post('penerima',TRUE),
            'masuk' => $this->input->post('masuk',TRUE),
            'expired' => $this->input->post('expired',TRUE),
            'status' => 'Diteruskan',
            'notif_status' => '1'
        );

        $cek = $this->M_Helpdesk->update($idd, $data);

        if ($cek == TRUE) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert" style="width: 84%;margin-left: 8%">Berhasil Teruskan Tiket</div>');
            $this->update($idd);
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert" style="width: 84%;margin-left: 8%">Gagal Teruskan Tiket</div>');
            $this->update($idd);
        } 
    }
    
    /////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////
    public function delete_detail($id_lay) 
    {
        $row = $this->M_Helpdesk->get_by_id($id_lay);

        if ($row) {
            $data = array(
                'button' => 'Hapus',
                'action' => site_url('C_Helpdesk/delete'),
                'id_kel' => $row->id,
                'id_div' => $row->id,
                'nama_div' => $row->nama_divisi,
                
            );
            $this->load->view('template_admin/sidebar');
            $this->load->view('Admin/Detail_Delete_Divisi', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('C_Helpdesk'));
        }
    }

    public function delete()
    {
        $idd = $this->input->post('id_div');

        $aksi = $this->M_Helpdesk->delete($idd);
        if ($aksi == TRUE) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Hapus Divisi</div>');
            redirect(site_url('C_Helpdesk'));
        }else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal Edit Divisi</div>');
            redirect(site_url('C_Helpdesk'));
        }
    } 

}
