<?php
class M_Tiket extends CI_Model{

    public $table = 'ticket';
    public $id = 'id';
    public $order = 'DESC';

	public function add_ticket($data,$table) { 
        $aksi = $this->db->insert($table,$data);

        if ($aksi) {
            return TRUE;
        }else{
            return False;
        }
    } 

    public function getnama() { 
        $data = $this->db->get('user');

        return $data;
    } 

    

    public function show($idnya) { 
        $this->db->where('id_user', $idnya);
        $data = $this->db->get('ticket');

        return $data->result_array();
    } 

    public function jumlah_tiket($q = NULL) {
        $this->db->like('id', $q);
        $this->db->or_like('id_user', $q);
        $this->db->or_like('nama', $q);
        $this->db->or_like('ruang', $q);
        $this->db->or_like('jenis_kerusakan', $q);
        $this->db->or_like('target_perbaikan', $q);
        $this->db->or_like('penanggungjawab', $q);
        $this->db->or_like('deskripsi', $q); 
        $this->db->or_like('status', $q);
        $this->db->or_like('notif_status', $q);
        $this->db->or_like('isi_feedback', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    } 

    public function tiket_ditutup() {
        $this->db->where('status','Tiket ditutup');

        return $this->db->get($this->table)->num_rows();
    }

    public function tiket_diterima() {
        $this->db->where('status','Tiket terkirim');

        return $this->db->get($this->table)->num_rows();
    }

    public function tiket_pending() {
        $this->db->where('status','Pending');

        return $this->db->get($this->table)->num_rows();
    }

    public function tiket_diteruskan() {
        $this->db->where('status','Diteruskan');
        $this->db->where('penerima',$this->session->userdata('divisi'));

        return $this->db->get($this->table)->num_rows();
    }

    public function tiket_diteruskan_helpdesk() {
        $this->db->where('status !=','Tiket terkirim');

        return $this->db->get($this->table)->num_rows();
    }

    public function update_status($getId,$data,$table)
    {	
    	$this->db->where('id' , $getId); 
		$this->db->update($table,$data);
	}

    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->or_like('id_user', $q);
        $this->db->or_like('nama', $q);
        $this->db->or_like('ruang', $q);
        $this->db->or_like('jenis_kerusakan', $q);
        $this->db->or_like('target_perbaikan', $q);
        $this->db->or_like('penanggungjawab', $q);
        $this->db->or_like('deskripsi', $q); 
        $this->db->or_like('status', $q);
        $this->db->or_like('notif_status', $q);
        $this->db->or_like('isi_feedback', $q);
        $this->db->limit($limit, $start);


        return $this->db->get($this->table)->result_array();
    }
}
?>