<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_t_m_d_level_user extends CI_Model {
    
    public function get($username){
        $this->db->where('USERNAME', $username); // Untuk menambahkan Where Clause : username='$username'
        $result = $this->db->get('T_M_D_LEVEL_USER')->row(); // Untuk mengeksekusi dan mengambil data hasil query
        return $result;
    }

public function update($data, $id)
{
    $this->db->where('ID', $id);
    return $this->db->update('T_M_D_LEVEL_USER', $data);
}

public function select_id($id)
{
  $this->db->select('LEVEL_USER_ID');
  $this->db->from('T_M_D_LEVEL_USER');
  $this->db->where('LEVEL_USER', $id);
  $akun = $this->db->get ();
  return $akun->result ();
}






  public function select()
  {
    $this->db->select('*');
    $this->db->from('T_M_D_LEVEL_USER');
    $this->db->order_by("ID", "asc");
    $akun = $this->db->get ();
    return $akun->result ();
  }

  public function delete($id)
  {
    $this->db->where('ID',$id);
    $this->db->delete('T_M_D_LEVEL_USER');
  }

  function tambah($data)
  {
    $this->db->insert('T_M_D_LEVEL_USER', $data);
    return TRUE;
  }

}


