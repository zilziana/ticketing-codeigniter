<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Login extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->database();
		$this->load->library('session'); 
		$this->load->helper(array('url'));
		$this->load->model('M_Login');
	}


	public function auth()
	{
		//Mengambil value dari view
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$check_login = $this->M_Login->checkLogin($username, $password);
 
		if ($check_login->num_rows()>0) {
			$data=$check_login->row_array();
			
			$this->session->set_userdata('logged_in', true);
			
			if ($data['level'] == 'Admin' || $data['level'] == 'admin'){
				$data_user = array(
				'idnya' => $data['id_user'],
				'username'  => $username,
				'nama'     => $data['nama'],
				'imel'     => $data['email'],
				'logged_in' => TRUE
			);
			$this->session->set_userdata($data_user);
			redirect('C_Home/admin_home');
			
			}else if ($data['level'] == 'Pegawai' || $data['level'] == 'pegawai') {
				$data_user = array(
				'idnya' => $data['id_user'],
				'username'  => $username,
				'nama'     => $data['nama'],
				'imel'     => $data['email'],
				'logged_in' => TRUE
				);
				$this->session->set_userdata($data_user);
				redirect('C_Home/inputTiket');
			}else if ($data['level'] == 'Opr' || $data['level'] == 'opr') { 
				$data_user = array(
					'idnya' => $data['id_user'],
					'username'  => $username,
					'nama'     	=> $data['nama'],
					'imel'     	=> $data['email'], 
					'divisi'	=> $data['divisi'],
					'logged_in' => TRUE 
				);
				
				$this->session->set_userdata($data_user);
				redirect('C_Operator');
			
			}else if ($data['level'] == 'Helpdesk' || $data['level'] == 'helpdesk') {
				$data_user = array(
				'idnya' => $data['id_user'],
				'username'  => $username,
				'nama'     => $data['nama'],
				'imel'     => $data['email'],
				'logged_in' => TRUE
				);
				$this->session->set_userdata($data_user);
				redirect('C_Home/helpdesk_home');
			}

		} else {
			$this->session->set_userdata('logged_in', false);
			$this->session->set_flashdata('msg', 'Username / Password Yang anda masukan salah');
			redirect(base_url());
		}
	}


	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
}