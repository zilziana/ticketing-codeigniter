<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Layanan extends CI_Controller {


	public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_Layanan');
        $this->load->model('M_Login');
    }

    public function index()
    {   if ($this->M_Login->logged_in()){
            
            $this->load->view('template_admin/sidebar');
            $this->load->view('Admin/layanan');
        }else{
            redirect('C_Home');
        }
    }
	
	public function ajax_list_layanan()
    {
        $list = $this->M_Layanan->get_datatables();
   
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $us) {
            $no++;
            $id_kel = $us->id;
            $id_jen = $us->id_jenis;
            $jenis = $us->jenis;

            $row = array();
            $row[] = $no;
            $row[] = $jenis;
            $row[] = $us->masalah;
            
            
                $row[] = '
                          <a href="'.'C_Layanan/update/'.$id_kel.''.'"><button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</button></a>
                          <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapus'.$id_kel.'"><i class="fa fa-trash"></i> Hapus</button>
                         
                            <form style="padding:0" method="post" action="'.base_url("/index.php/C_Layanan/delete").'">
                                    <div class="modal fade" id="modalHapus'.$id_kel.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Layanan</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <input type="hidden" name="id_kel" value="'.$id_kel.'">
                                                <div class="modal-body">
                                                    <h6>Anda yakin ingin Menghapus Layanan ini ?</h6>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </form>
                            
                            
                            <form style="padding:0" method="post" action="'.base_url("/index.php/C_Layanan/delete").'">
                                    <div class="modal fade" id="modalEdit'.$id_kel.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Layanan</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <input type="hidden" name="id_kel" value="'.$id_kel.'">
                                                <div class="form-group"> 
                                                    <label for="varchar">Jenis Perangkat </label>
                                                    <select class="form-control" name="jenis" required>
                                                        <option disabled selected value="'.$id_jen.'">'.$jenis.'</option>

                                                    </select>
                                                </div>
                                                <div class="form-group"> 
                                                    <label for="varchar">Nama Layanan </label>
                                                    <input type="text" class="form-control" name="layanan" id="layanan" placeholder="Nama Layanan" value="'.$us->masalah.'" />
                                                    <?php echo form_error("layanan"); ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </form>';
                            
                            
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->M_Layanan->count_all(),
                        "recordsFiltered" => $this->M_Layanan->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
   
    public function create_layanan() 
    {
        if ($this->M_Login->logged_in()){
            $data = array( 
                'button' => 'Tambah',
                'action' => site_url('C_Layanan/create_action'),
            );
            $this->load->view('template_admin/sidebar');
            $this->load->view('Admin/add_layanan', $data);
        }else{
            redirect('C_Home');
        }
    }
    

    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create_layanan();
        } else {
            $data = array( 
        		'id_jenis' => $this->input->post('jenis',TRUE),
        		'masalah' => $this->input->post('layanan',TRUE),
    	    );

            $aksi = $this->M_Layanan->insert($data);
            if ($aksi == TRUE) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert" style="width: 84%;margin-left: 8%">Berhasil Menambahkan Layanan, <a style="text-decoration-line:none" href="'.site_url("C_Layanan").'"> <strong>Buka List Layanan</strong></a> </div>');
                redirect('C_Layanan/create_layanan');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">ERROR</div>');
                redirect('C_Home/admin_add_layanan');
            }
        }
    } 
    
    public function update($id_lay) 
    {
        $row = $this->M_Layanan->get_by_id($id_lay);
        $list = $this->M_Layanan->get_jenis();

        if ($row) {
            $data = array(
                'button' => 'Simpan',
                'action' => site_url('C_Layanan/update_action'),
        		'id_kel' => $row->id,
                'masalah' => $row->masalah,
                'id_jen' => $row->id_jenis,
                'jenis' => $row->jenis,
                'list_jenis' => $list
            );
            $this->load->view('template_admin/sidebar');
            $this->load->view('Admin/Detail_Edit_layanan', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('C_Layanan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules(); 

        if ($this->form_validation->run() == FALSE) {
            $idd = $this->input->post('id_kel');
            $this->update($idd);    
        } else {
            $idd = $this->input->post('id_kel');
            $data = array(
        		'id_jenis' => $this->input->post('jenis',TRUE),
                'masalah' => $this->input->post('layanan',TRUE)
	        );

            $cek = $this->M_Layanan->update($idd, $data);

            if ($cek == TRUE) {
                $this->session->set_flashdata('sukses', '<div class="alert alert-success" role="alert" style="width: 84%;margin-left: 8%">Berhasil Edit Layanan, <a style="text-decoration-line:none" href="'.site_url("C_Layanan").'"> <strong>Kembali</strong></a></div>');
                $this->update($idd);
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert" style="width: 84%;margin-left: 8%">Gagal Edit Layanan</div>');
                $this->update($idd);
            }
        } 
    }
    
    /////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////
    public function delete_detail($id_lay) 
    {
        $row = $this->M_Layanan->get_by_id($id_lay);

        if ($row) {
            $data = array(
                'button' => 'Hapus',
                'action' => site_url('C_Layanan/delete'),
                'id_kel' => $row->id,
                'jenis' => $row->jenis,
                'masalah' => $row->masalah,
            );
            $this->load->view('template_admin/sidebar');
            $this->load->view('Admin/Detail_Delete_layanan', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('C_Layanan'));
        }
    }

    public function delete()
    {
        $idd = $this->input->post('id_kel');

        $aksi = $this->M_Layanan->delete($idd);
        if ($aksi == TRUE) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Hapus Layanan</div>');
            redirect(site_url('C_Layanan'));
        }else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal Edit Layanan</div>');
            redirect(site_url('C_Layanan'));
        }
    }
    

    public function _rules() 
    {

    	$this->form_validation->set_rules('layanan', 'layanan', 'trim|required|min_length[3]|alpha_numeric_spaces');

    	$this->form_validation->set_error_delimiters('<span class="text-default"><small>', '</small></span>');
    }

}
