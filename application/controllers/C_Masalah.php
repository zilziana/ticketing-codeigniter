<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Masalah extends CI_Controller {


	public function __construct(){
    parent::__construct();
    	$this->load->database();
	    $this->load->library('session'); 
		$this->load->helper(array('url'));

    	$this->load->model('M_Login');
		$this->load->model('M_Masalah');
		$this->load->model('M_Tiket');
	}
	
	public function getPilihanKeluhan(){ 
	    $id = $this->input->post('id');
	    $point = $this->M_Masalah->viewJenis($id); 
	    $lists = "<option disabled selected>Pilih Layanan</option>";
	    
	    foreach($point as $data){
	      $lists .= "<option value='".$data->masalah."' name='two' >".$data->masalah."</option>";
	    }
	    
	    $callback = array('listKel'=>$lists);
	    echo json_encode($callback); 
  	}
}
