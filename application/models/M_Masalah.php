<?php
class M_Masalah extends CI_Model{


	public function getNamaJenis() { 
        $data = $this->db->get('jenis');

        return $data;
    } 

    public function viewJenis($id){
    	$this->db->where('id_jenis', $id);
    	$result = $this->db->get('keluhan')->result();
    	
		return $result; 
  	} 
}