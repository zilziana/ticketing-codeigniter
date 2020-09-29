<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_Admin extends CI_Model
{

    public $table1 = 'user';
    public $table2 = 'divisi';
    
    public $id = 'id_user';
    var $column_order = array(null, 'username','user.nama','nip','email','password','level','user.divisi','');
    var $column_search = array('username','user.nama','nip','email','password','level','user.divisi');
    var $order = array('id_user' => 'asc');
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query()
    {
         
        $this->db->from($this->table1);
        $this->db->join($this->table2, 'divisi.id_div = user.divisi');
 
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
        $this->db->join($this->table2, 'divisi.id_div = user.divisi');
        return $this->db->count_all_results();
    }
/////////////////////////////////////////////// 

    public function get_all()
    {
        $this->db->from($this->table1);
        $get_data = $this->db->get();

        return $get_data->num_rows();
    }

    public function get_all_user()
    {
        $this->db->where('level !=','Admin');
        $this->db->from($this->table1);
        $get_data = $this->db->get();

        return $get_data->num_rows();
    }

    public function get_all_admin()
    {
        $this->db->where('level','Admin');
        $this->db->from($this->table1);
        $get_data = $this->db->get();

        return $get_data->num_rows();
    }

    public function get_divisi()
    {
        $get = $this->db->get('divisi');

        return $get->result_array();
    }

    // insert data
    function insert($data)
    {
        $query = $this->db->insert($this->table1, $data);

        if ($query) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    // update data
    function update($idd, $data)
    {
        $this->db->where($this->id, $idd);
        $aksi = $this->db->update($this->table1, $data);

        if ($aksi) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->from($this->table1);
        $this->db->join($this->table2, 'divisi.id_div = user.divisi');
        $this->db->where($this->id, $id);

        return $this->db->get()->row();
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $aksi = $this->db->delete($this->table1);

        if ($aksi) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function get_data_layanan(){
        $this->db->select('jenis.id_jenis,keluhan.id,jenis.jenis,keluhan.masalah');
        $this->db->from('jenis');
        $this->db->join('keluhan', 'keluhan.id_jenis = jenis.id_jenis');
        $result = $this->db->get();
        
        return $result; 
    }

}
