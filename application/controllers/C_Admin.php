<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class C_Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Admin');
        $this->load->model('M_Login');
        $this->load->model('M_Layanan');
        $this->load->helper('url');
    }
 
    public function index()
    {   
        if ($this->M_Login->logged_in()){
            $this->load->view('template_admin/sidebar');
            $this->load->view('Admin/list_pengguna');
        }else{
            redirect('C_Home');
        }
    }
 
    public function ajax_list_user()
    {
        $list = $this->M_Admin->get_datatables();

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $us) {
            $no++;
            $id_us = $us->id_user;
            $row = array();
            $row[] = $no;
            $row[] = $us->username;
            $row[] = $us->nama;
            $row[] = $us->nip;
            $row[] = $us->email;
            $row[] = $us->password;
            $row[] = $us->level;
            $row[] = $us->nama_divisi;

            if ($us->level == 'Admin' || $us->level == 'admin') {
                $row[] = 'No Action';
            }else{
                $row[] = '<a href="'.'C_Admin/update/'.$id_us.''.'"><button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</button></a>
                          <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapus'.$id_us.'"><i class="fa fa-trash"></i> Hapus</button>
   
                            <form style="padding:0" method="post" action="'.base_url("/index.php/C_Admin/delete_action").'">
                                <div class="modal fade" id="modalHapus'.$id_us.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus User</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <input type="hidden" name="id_user" value="'.$id_us.'">
                                            <div class="modal-body">
                                                <h6>Anda yakin ingin Menghapus user ini ?</h6>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>';
            }
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->M_Admin->count_all(),
                        "recordsFiltered" => $this->M_Admin->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
    /////////////////////////////////////////////////////////////////////
    
    public function create() 
    {
        if ($this->M_Login->logged_in()){
            $divisi = $this->M_Admin->get_divisi();
            $data = array( 
                'button' => 'Daftar',
                'action' => site_url('C_Admin/create_action'),
                'username' => set_value('username'),
                'nip' => set_value('nip'),
                'password' => set_value('password'),
                'nama' => set_value('nama'),
                'email' => set_value('email'),
                'level' => set_value('level'),
                'divisi' => set_value('divisi'),
                'div' => $divisi
            );
            $this->load->view('template_admin/sidebar');
            $this->load->view('Admin/add_user', $data);
        }else{
            redirect('C_Home');
        }
    }
    

    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
    		'username' => $this->input->post('username',TRUE),
    		'nip' => $this->input->post('nip',TRUE),
    		'password' => $this->input->post('password',TRUE),
    		'nama' => $this->input->post('nama',TRUE),
    		'email' => $this->input->post('email',TRUE),
    		'level' => $this->input->post('level',TRUE),
    		'divisi' => $this->input->post('divisi',TRUE),
	    );

            $aksi = $this->M_Admin->insert($data);
            if ($aksi == TRUE) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert" style="width: 84%;margin-left: 8%">Berhasil Menambahkan User,  <a style="text-decoration-line:none" href="'.site_url("C_Admin").'"> <strong>Buka List User</strong></a>');
                redirect('C_Admin/create');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">ERROR</div>');
                redirect('C_Home/admin_add_user');
            }
        }
    }
    
    public function update($id_us) 
    {
        $row = $this->M_Admin->get_by_id($id_us);
        $divisi = $this->M_Admin->get_divisi();

        if ($row) {
            $data = array(
                'button' => 'Simpan',
                'action' => site_url('C_Admin/update_action'),
        		'id_user' => $row->id_user,
        		'username' => set_value('username', $row->username),
        		'nip' => set_value('nip', $row->nip),
        		'password' => set_value('password', $row->password),
        		'nama' => set_value('nama', $row->nama),
        		'email' => set_value('email', $row->email),
        		'level' => $row->level,
                'id_divisi' => $row->divisi,
                'select' => $row->nama_divisi,
                'list_divisi' => $divisi
            );
            $this->load->view('template_admin/sidebar');
            $this->load->view('Admin/Detail_User', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('C_Admin'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules(); 

        if ($this->form_validation->run() == FALSE) {
            $idd = $this->input->post('id_user');
            $this->update($idd);    
        } else {
            $idd = $this->input->post('id_user');
            $data = array(
        		'username' => $this->input->post('username',TRUE),
        		'nip' => $this->input->post('nip',TRUE),
        		'password' => $this->input->post('password',TRUE),
        		'nama' => $this->input->post('nama',TRUE),
        		'email' => $this->input->post('email',TRUE),
                'divisi' => $this->input->post('divisi')
	        );

            $cek = $this->M_Admin->update($idd, $data);

            if ($cek == TRUE) {
                $this->session->set_flashdata('sukses', '<div class="alert alert-success" role="alert" style="width: 84%;margin-left: 8%">Berhasil Edit User, <a style="text-decoration-line:none" href="'.site_url("C_Admin").'"> <strong>Kembali</strong></a></div>');
                $this->update($idd);
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert" style="width: 84%;margin-left: 8%">Gagal Edit User</div>');
                $this->update($idd);
            }
        } 
    }
    
    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////

    public function delete_action() 
    {
        $idd = $this->input->post('id_user');

        $aksi = $this->M_Admin->delete($idd);
        if ($aksi == TRUE) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Hapus User</div>');
            redirect(site_url('C_Admin'));
        }else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal Edit User</div>');
            redirect(site_url('C_Admin'));
        }
    }

    public function _rules() 
    {

    	$this->form_validation->set_rules('nama', 'nama', 'trim|required|min_length[3]|alpha_numeric_spaces');
    	$this->form_validation->set_rules('username', 'username', 'trim|required|min_length[3]|alpha_numeric');
    	$this->form_validation->set_rules('nip', 'nip', 'trim|required|numeric|min_length[3]');
    	$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[8]');
    	$this->form_validation->set_rules('email', 'email', 'required|valid_email|min_length[3]'); 

    	$this->form_validation->set_error_delimiters('<span class="text-default"><small>', '</small></span>');
    }

}

/* End of file C_Admin.php */
/* Location: ./application/controllers/C_Admin.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-23 05:47:25 */
/* http://harviacode.com */