<?php
class M_Notifikasi extends CI_Model{


    public function hitung_data_unread() {
        $this->db->where('notif_status', '1');
        $this->db->where('penerima',$this->session->userdata('divisi'));
        $jum = $this->db->get('ticket');

        if($jum->num_rows()>0)
        {
          return $jum->num_rows();
        }
        else
        {
          return 0;
        }
    }

    public function ambil_data_unread() {
        $this->db->where('notif_status','1');
        $this->db->limit(3);
        $data = $this->db->get('ticket');

        return $data; 
    } 

    public function update()
    {
        $this->db->where('notif_status', '1');
        $data = $this->db->get('ticket');

        if ($data->num_rows()>0) {
            $data = array(
                'notif_status' => '0'
            );
            $this->db->update('ticket', $data); 
        }
    }
}
?>