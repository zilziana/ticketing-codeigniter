<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Notifikasi extends CI_Controller {

	public function __construct(){
	    parent::__construct();
	    
	    $this->load->database();
	    $this->load->library('session'); 
		$this->load->helper(array('url'));

		$this->load->model('M_Notifikasi');

  	}

  	public function see_all_home()
	{ 
		$this->M_Notifikasi->update();
		redirect('C_Operator/operator_home');
	}

	public function see_all_list()
	{ 
		$this->M_Notifikasi->update();
		redirect('C_Operator/list_opr');
	}

	public function operator_rekapData()
	{ 
		$this->M_Notifikasi->update();
		redirect('C_Operator/operator_rekapData');
	}

	public function list_opr()
	{ 
		$this->M_Notifikasi->update();
		redirect('C_Operator/list_opr');
	}

	public function operator_home()
	{ 
		$this->M_Notifikasi->update();
		redirect('C_Operator');
	}
}