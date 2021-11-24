<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_t_ak_faktur_penjualan_pph extends CI_Model {
    
    

public function update($data, $id)
{
    $this->db->where('ID', $id);
    return $this->db->update('T_AK_FAKTUR_PENJUALAN_PPH', $data);
}





  public function select($id)
  {
    $this->db->select("T_AK_FAKTUR_PENJUALAN_PPH.ID");
    $this->db->select("T_AK_FAKTUR_PENJUALAN_PPH.FAKTUR_PENJUALAN_ID");
    $this->db->select("T_AK_FAKTUR_PENJUALAN_PPH.VALUE_PPH");
    $this->db->select("T_AK_FAKTUR_PENJUALAN_PPH.PERCENTAGE_PPH");
    $this->db->select("T_AK_FAKTUR_PENJUALAN_PPH.CREATED_BY");
    $this->db->select("T_AK_FAKTUR_PENJUALAN_PPH.UPDATED_BY");
    $this->db->select("T_AK_FAKTUR_PENJUALAN_PPH.KETERANGAN");
    $this->db->select("T_AK_FAKTUR_PENJUALAN_PPH.MARK_FOR_DELETE");



    
    $this->db->from('T_AK_FAKTUR_PENJUALAN_PPH');

    $this->db->join('T_AK_FAKTUR_PENJUALAN', 'T_AK_FAKTUR_PENJUALAN.ID = T_AK_FAKTUR_PENJUALAN_PPH.FAKTUR_PENJUALAN_ID', 'left');




    
    $this->db->where('T_AK_FAKTUR_PENJUALAN_PPH.FAKTUR_PENJUALAN_ID', $id);


    $this->db->order_by("ID", "asc");

    $akun = $this->db->get ();
    return $akun->result ();
  }


  public function delete_id($id)
  {
    $this->db->where('FAKTUR_PENJUALAN_ID',$id);
    $this->db->delete('T_AK_FAKTUR_PENJUALAN_PPH');
  }

  public function delete($id)
  {
    $this->db->where('ID',$id);
    $this->db->delete('T_AK_FAKTUR_PENJUALAN_PPH');
  }

  function tambah($data)
  {
        $this->db->insert('T_AK_FAKTUR_PENJUALAN_PPH', $data);
        return TRUE;
  }

}


