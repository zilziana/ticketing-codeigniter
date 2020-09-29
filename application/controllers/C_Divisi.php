<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Divisi extends CI_Controller {


	public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_Divisi');
        $this->load->model('M_Login');
    }

    public function index()
    {
        if ($this->M_Login->logged_in()){
            $this->load->view('template_admin/sidebar');
            $this->load->view('Admin/dataDivisi');
        }else{
            redirect('C_Home');
        }
    }
	
	public function ajax_list_divisi()
    {
        $list = $this->M_Divisi->get_datatables();

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $us) {
            $id_div = $us->id_div;
            $no++; 
            $row = array(); 
            $row[] = $no;
            $row[] = $us->nama_divisi;
            if($us->nama_divisi == "NONE"){
                $row[] = "No Action";    
            }else{
                $row[] = ' 
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalEdit'.$id_div.'"><i class="fa fa-edit"></i> Edit</button>
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapus'.$id_div.'"><i class="fa fa-trash"></i> Hapus</button>
                      
                        <form style="padding:0" method="post" action="'.base_url("/index.php/C_Divisi/delete").'">
                            <div class="modal fade" id="modalHapus'.$id_div.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Divisi</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <input type="hidden" name="id_div" value="'.$id_div.'">
                                        <div class="modal-body">
                                            <h6>Anda yakin ingin Menghapus Divisi ini ?</h6>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        
                        
                        <form style="padding:0" method="post" action="'.base_url("/index.php/C_Divisi/update_action").'">
                            <div class="modal fade" id="modalEdit'.$id_div.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Divisi</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <input type="hidden" name="id_div" value="'.$id_div.'">
                                        <div class="modal-body">
                                             <div class="form-group"> 
                                                <label for="varchar">Nama Divisi </label>
                                                <input type="text" class="form-control" name="divisi" placeholder="Nama Divisi" value="'.$us->nama_divisi.'" />
                                                
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
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
                        "recordsTotal" => $this->M_Divisi->count_all(),
                        "recordsFiltered" => $this->M_Divisi->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
   
    public function create_divisi() 
    {
        if ($this->M_Login->logged_in()){
            $data = array( 
                'button' => 'Tambah',
                'action' => site_url('C_Divisi/create_action'),
            );
            $this->load->view('template_admin/sidebar');
            $this->load->view('Admin/add_divisi', $data);
        }else{
            redirect('C_Home');
        }
    }
    

    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create_divisi();
        } else {
            $data = array( 
        		'nama_divisi' => $this->input->post('divisi',TRUE)
    	    );

            $aksi = $this->M_Divisi->insert($data);
            if ($aksi == TRUE) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert" style="width: 84%;margin-left: 8%">Berhasil Tambah Divisi, <a style="text-decoration-line:none" href="'.site_url("C_Divisi").'"> <strong>Buka List Divisi</strong></a></div>');
                redirect('C_Divisi/create_divisi');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">ERROR</div>');
                redirect('C_Divisi/create_divisi');
            }
        }
    } 
    
    public function update_action() 
    {
        $this->_rules(); 

        if ($this->form_validation->run() == FALSE) {
            $idd = $this->input->post('id_div');
            $this->session->set_flashdata('gagal','<div class="alert alert-danger" role="alert" style="width: 100%; ">'.form_error("divisi").'</div>');
            redirect(site_url('C_Divisi')); 
        } else {
            $idd = $this->input->post('id_div');
            $data = array(
        		'nama_divisi' => $this->input->post('divisi',TRUE),
	        );

            $cek = $this->M_Divisi->update($idd, $data);

            if ($cek == TRUE) {
                $this->session->set_flashdata('sukses', '<div class="alert alert-success" role="alert" style="width: 100%; ">Berhasil Edit Divisi</div>');
                redirect(site_url('C_Divisi'));
            }else{
                $this->session->set_flashdata('gagal', '<div class="alert alert-danger" role="alert" style="width: 100%; ">Gagal Edit Divisi</div>');
                $this->update($idd);
            }
        } 
    }
    
    /////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////
 
    public function delete()
    {
        $idd = $this->input->post('id_div');

        $aksi = $this->M_Divisi->delete($idd);
        if ($aksi == TRUE) {
            $this->session->set_flashdata('sukses', '<div class="alert alert-success" role="alert">Berhasil Hapus Divisi</div>');
            redirect(site_url('C_Divisi'));
        }else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal Edit Divisi</div>');
            redirect(site_url('C_Divisi'));
        }
    }
    

    public function _rules() 
    {

    	$this->form_validation->set_rules('divisi', 'divisi', 'trim|required|min_length[3]|alpha_numeric_spaces');

    	$this->form_validation->set_error_delimiters('<span class="text-default"><small>', '</small></span>');
    }

}
