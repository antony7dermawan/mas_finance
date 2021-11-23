<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_t_ak_faktur_penjualan_diskon extends CI_Model {
    
    

public function update($data, $id)
{
    $this->db->where('ID', $id);
    return $this->db->update('T_AK_FAKTUR_PENJUALAN_DISKON', $data);
}





  public function select($id)
  {
    $this->db->select("T_AK_FAKTUR_PENJUALAN_DISKON.ID");
    $this->db->select("T_AK_FAKTUR_PENJUALAN_DISKON.FAKTUR_PENJUALAN_ID");
    $this->db->select("T_AK_FAKTUR_PENJUALAN_DISKON.VALUE_DISKON");
    $this->db->select("T_AK_FAKTUR_PENJUALAN_DISKON.CREATED_BY");
    $this->db->select("T_AK_FAKTUR_PENJUALAN_DISKON.UPDATED_BY");
    $this->db->select("T_AK_FAKTUR_PENJUALAN_DISKON.KETERANGAN");
    $this->db->select("T_AK_FAKTUR_PENJUALAN_DISKON.MARK_FOR_DELETE");
    $this->db->select("T_AK_FAKTUR_PENJUALAN_DISKON.QTY");
    $this->db->select("T_AK_FAKTUR_PENJUALAN_DISKON.HARGA");



    
    $this->db->from('T_AK_FAKTUR_PENJUALAN_DISKON');

    $this->db->join('T_AK_FAKTUR_PENJUALAN', 'T_AK_FAKTUR_PENJUALAN.ID = T_AK_FAKTUR_PENJUALAN_DISKON.FAKTUR_PENJUALAN_ID', 'left');




    
    $this->db->where('T_AK_FAKTUR_PENJUALAN_DISKON.FAKTUR_PENJUALAN_ID', $id);


    $this->db->order_by("ID", "asc");

    $akun = $this->db->get ();
    return $akun->result ();
  }


  public function delete_id($id)
  {
    $this->db->where('FAKTUR_PENJUALAN_ID',$id);
    $this->db->delete('T_AK_FAKTUR_PENJUALAN_DISKON');
  }

  public function delete($id)
  {
    $this->db->where('ID',$id);
    $this->db->delete('T_AK_FAKTUR_PENJUALAN_DISKON');
  }

  function tambah($data)
  {
        $this->db->insert('T_AK_FAKTUR_PENJUALAN_DISKON', $data);
        return TRUE;
  }

}


