<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Feedback extends CI_Controller {

	public function __construct(){
    parent::__construct();
    
        $this->load->database();
        $this->load->library('session'); 
    	$this->load->helper(array('url'));
    	$this->load->model('M_Feedback');
    	$this->load->model('M_Login');
  	}

  	public function tambahFeedback()
	{
		$id_user = $this->input->post('idus');
		$id_tik = $this->input->post('idtik');
		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$kep = $this->input->post('optradio');
		$deskripsi = $this->input->post('deskripsi');

		$data = array(
			'id_user' => $id_user,
			'id_ticket' => $id_tik,
			'nama' => $nama,
			'email' => $email,
			'kepuasan' => $kep,
			'deskripsi' => $deskripsi
			);
		$cek1 = $this->M_Feedback->add_feedback($data,'feedback');

		$data2 = array(
			'isi_feedback' => 'Sudah',
			);
		$cek2 = $this->M_Feedback->update_statusIsi($id_tik,$data2,'ticket');


		if ($cek1 == TRUE && $cek2 == TRUE) {
        	$this->session->set_flashdata('msg', '<div style="margin-top: 2%;width: 70%;margin-left: 15%" class="alert alert-success text-center" role="alert">Feedback berhasil dikirim <i class="fas fa-paper-plane"></i></div>');
        	redirect('C_Home/daftarTiket');
        }else{
        	$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">EROR</div>');
        	redirect('C_Home/daftarTiket');
        }
	}
	
	public function feedback_list()
	{
		if ($this->M_Login->logged_in()){
			$x['pesan'] = $this->Model_Notif->hitung_data();
			$x['data_pesan'] = $this->Model_Notif->data_hit();
			$x['data_feedback'] = $this->M_Feedback->get_data();

    		$this->load->view('operator/hasil_Feedback', $x); 
		}else{
			redirect('C_Home');
		}
	}

} 