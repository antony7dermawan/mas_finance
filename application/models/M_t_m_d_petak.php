<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_t_m_d_petak extends CI_Model {
    
  

public function update($data, $id)
{
    $this->db->where('ID', $id);
    return $this->db->update('T_M_D_PETAK', $data);
}

public function select_id($id)
{
  $this->db->select('ID');
  $this->db->from('T_M_D_PETAK');
  $this->db->where('PETAK', $id);
  $akun = $this->db->get ();
  return $akun->result ();
}


  public function select_option()
  {
    $this->db->select('*');
    $this->db->from('T_M_D_PETAK');
    $this->db->where("MARK_FOR_DELETE=false");
    $this->db->order_by("ID", "asc");
    $akun = $this->db->get ();
    return $akun->result ();
  } 


  public function select()
  {
    $this->db->select('*');
    $this->db->from('T_M_D_PETAK');

    if($this->session->userdata('t_m_d_petak_delete_logic')==0)
    {
      $this->db->where('MARK_FOR_DELETE',FALSE);
    }
    $this->db->order_by("ID", "asc");
    $akun = $this->db->get ();
    return $akun->result ();
  }

  public function delete($id)
  {
    $this->db->where('ID',$id);
    $this->db->delete('T_M_D_PETAK');
  }

  function tambah($data)
  {
    $this->db->insert('T_M_D_PETAK', $data);
    return TRUE;
  }

}


