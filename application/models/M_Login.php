<?php
class M_Login extends CI_Model{

    public $table = 'user';

    public function checkLogin($username, $password) {

        $this->db->where('username', $username);
        $this->db->where('password', $password);

        $query = $this->db->get('user');

        return $query;
    } 
    
    public function logged_in(){
        return $this->session->userdata('logged_in');
    }
}
?>