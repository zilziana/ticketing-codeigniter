<?php
class M_Operator extends CI_Model{

	public $table1 = 'ticket';
    public $table2 = 'user'; 
    public $table3 = 'divisi';
    public $id = 'id';
    var $column_order = array(null,'id','user.nama','ruang','target_perbaikan','penanggungjawab','','status',null);
    var $column_search = array('id','user.nama','ruang','target_perbaikan','penanggungjawab','status');
    var $order = array('id' => 'asc');

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {  
        $this->db->where('penerima',$this->session->userdata('divisi'));

        $this->db->from($this->table1);
        $this->db->join($this->table2, 'user.id_user = ticket.id_user');
        $this->db->join($this->table3, 'divisi.id_div = user.divisi');

 
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table1);
        $this->db->join($this->table2, 'user.id_user = ticket.id_user');

        return $this->db->count_all_results();
    }  

    function get_divisi(){

        $this->db->where('id !=', '1');
        $get = $this->db->get('divisi');

        return $get->result_array();
    }

    function get_by_id($id)
    {
        $this->db->from($this->table1);
        $this->db->join($this->table2, 'user.id_user = ticket.id_user');

        $this->db->where($this->id, $id);

        return $this->db->get()->row();
    }

    function get_history_by_id($id)
    {
        $this->db->from('riwayat_tiket');

        $this->db->where('id_tiket', $id);

        return $this->db->get()->result_array();
    }

    public function get_jenis()
    {
        $get = $this->db->get($this->table);

        return $get->result_array();
    }

    function update($id_tiket, $data)
    {
        $this->db->where($this->id, $id_tiket);
        $aksi = $this->db->update($this->table1, $data);

        if ($aksi) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    function delete($id)
    {
        $this->db->where($this->id, $id); 
        $aksi = $this->db->delete($this->table);

        if ($aksi) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

	public function ambil_dataRekap($tgl_awal,$tgl_akhir) {
        $this->db->where('masuk >=',$tgl_awal);
		$this->db->where('masuk <=',$tgl_akhir);
        $data = $this->db->get('ticket');

        return $data->result_array();
    }

    function add_histori($data)
    {
        $query = $this->db->insert('riwayat_tiket', $data);

        if ($query) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
?>