<?php

class C_Tiket extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');

		$this->load->model('M_Tiket');
		$this->load->model('M_Login');
		$this->load->model('M_Masalah');
		$this->load->model('M_Notifikasi');
	}  
 
	public function home_input_tiket()
	{

		$x['data'] = $this->M_Masalah->getNamaJenis();
		$x['data_user'] = $this->M_Tiket->getnama($this->session->userdata('idnya'));
		$this->load->view('tiket/InputTiket',$x);
	}

	public function daftarTiket()
	{
		$q = urldecode($this->input->get('q', TRUE));
        	$start = intval($this->input->get('start'));

        	if ($q <> '') {
	            $config['base_url'] = base_url() . 'index.php/C_Tiket/daftarTiket?q=' . urlencode($q);
	            $config['first_url'] = base_url() . 'index.php/C_Tiket/daftarTiket?q=' . urlencode($q);
	        } else {
	            $config['base_url'] = base_url() . 'index.php/C_Tiket/daftarTiket';
	            $config['first_url'] = base_url() . 'index.php/C_Tiket/daftarTiket';
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
	            'start' => $start
	        );

    	$this->load->view('tiket/listTiket',$x);
	}

	function aksi_tambahTiket()
	{
		$id_user = $this->input->post('id_user');
		$nama = $this->input->post('nama');
		$ruang = $this->input->post('ruang');
		$jenis = $this->input->post('one');
		if ($jenis == '1') {
			$jenis = 'Hardware';
		}elseif ($jenis = '2') {
			$jenis = 'Software';
		};
		$target = $this->input->post('two');
		$deskripsi = $this->input->post('deskripsi');
		$masuk = $this->input->post('masuk'); 
		$expired = $this->input->post('expired'); 
		$data = array(
			'id_user' => $id_user,
			'nama' => $nama,
			'ruang' => $ruang,
			'jenis_kerusakan' => $jenis,
			'target_perbaikan' => $target,
			'deskripsi' => $deskripsi,
			'penanggungjawab' => 'Belum tersedia',
			'masuk' => $masuk,
			'expired' => $expired,
			'penerima' => '1',
			'status' => 'Tiket terkirim',
			'notif_status' => '1',
			'isi_feedback' => 'Belum'
			);
		$cek = $this->M_Tiket->add_ticket($data,'ticket');
		if ($cek == TRUE) {
			$this->session->set_flashdata('info','<div class="alert alert-success" role="alert">Berhasil Input Tiket</div>');
			redirect('C_Tiket/home_input_tiket');
		}else{
			$this->session->set_flashdata('info','<div class="alert alert-danger" role="alert">Gagal Input Tiket</div>');
			redirect('C_Home/InputTiket');
		}
	}

	public function konfirmasi()
	{ 
		date_default_timezone_set('Asia/Jakarta');
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

		$this->M_Tiket->update_status($idnya,$data,'ticket');
		redirect('C_Tiket/daftar_Keluhan');
	}

	public function edit_ticket()
	{ 
		$idnya = $this->input->post('id_tiket');
		$status = $this->input->post('status');
		$pnangan = $this->input->post('pnangan');

		$data = array(
            'status' => $status,
            'penanggungjawab' => $pnangan
        );

		$this->M_Tiket->update_status($idnya,$data,'ticket');
		redirect('C_Tiket/daftar_Keluhan');
	}

	public function daftar_keluhan()
	{
		if ($this->M_Login->logged_in()){	
			$q = urldecode($this->input->get('q', TRUE));
        	$start = intval($this->input->get('start'));

        	if ($q <> '') {
	            $config['base_url'] = base_url() . 'index.php/C_Tiket/daftar_keluhan?q=' . urlencode($q);
	            $config['first_url'] = base_url() . 'index.php/C_Tiket/daftar_keluhan?q=' . urlencode($q);
	        } else {
	            $config['base_url'] = base_url() . 'index.php/C_Tiket/daftar_keluhan';
	            $config['first_url'] = base_url() . 'index.php/C_Tiket/daftar_keluhan';
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
                'data_pesan' => $this->M_Notifikasi->ambil_data_unread()
	        );	
        	//////////////////////////////////////////////////////////////////
 
    		$this->load->view('operator/daftar_Keluhan', $x); 
		}else{
			redirect('C_Tiket');
		}
	}

}