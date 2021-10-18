<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_t_m_d_to_nama_kota extends CI_Model {
    
  

public function update($data, $id)
{
    $this->db->where('ID', $id);
    return $this->db->update('T_M_D_TO_NAMA_KOTA', $data);
}

public function select_id($id)
{
  $this->db->select('ID');
  $this->db->from('T_M_D_TO_NAMA_KOTA');
  $this->db->where('TO_NAMA_KOTA', $id);
  $akun = $this->db->get ();
  return $akun->result ();
}


  public function select_option()
  {
    $this->db->select('*');
    $this->db->from('T_M_D_TO_NAMA_KOTA');
    $this->db->where("MARK_FOR_DELETE=false");
    $this->db->order_by("ID", "asc");
    $akun = $this->db->get ();
    return $akun->result ();
  } 


  public function select()
  {
    $this->db->select('*');
    $this->db->from('T_M_D_TO_NAMA_KOTA');

    if($this->session->userdata('t_m_d_to_nama_kota_delete_logic')==0)
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
    $this->db->delete('T_M_D_TO_NAMA_KOTA');
  }

  function tambah($data)
  {
    $this->db->insert('T_M_D_TO_NAMA_KOTA', $data);
    return TRUE;
  }

}


