<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_t_ak_faktur_penjualan_rincian2 extends CI_Model {
    
    

public function update($data, $id)
{
    $this->db->where('ID', $id);
    return $this->db->update('T_AK_FAKTUR_PENJUALAN_RINCIAN2', $data);
}





  public function select($id)
  {
    $this->db->select("T_AK_FAKTUR_PENJUALAN_RINCIAN2.ID");
    $this->db->select("T_AK_FAKTUR_PENJUALAN_RINCIAN2.FAKTUR_PENJUALAN_RINCIAN_ID");
    $this->db->select("T_AK_FAKTUR_PENJUALAN_RINCIAN2.PENJUALAN_RINCIAN_ID");
    $this->db->select("T_AK_FAKTUR_PENJUALAN_RINCIAN2.CREATED_BY");
    $this->db->select("T_AK_FAKTUR_PENJUALAN_RINCIAN2.UPDATED_BY");
    $this->db->select("T_AK_FAKTUR_PENJUALAN_RINCIAN2.KETERANGAN");



    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.DATE_MUAT");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.DATE_BONGKAR");

    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.NO_SPB");

    $this->db->select("T_AK_FAKTUR_PENJUALAN.ENABLE_EDIT");

    $this->db->select("SUB_TOTAL");
    $this->db->select("PPN_VALUE");

    
    $this->db->from('T_AK_FAKTUR_PENJUALAN_RINCIAN2');

    $this->db->join('T_T_T_PENJUALAN_JASA_RINCIAN', 'T_T_T_PENJUALAN_JASA_RINCIAN.ID = T_AK_FAKTUR_PENJUALAN_RINCIAN2.PENJUALAN_RINCIAN_ID', 'left');



    $this->db->join('T_AK_FAKTUR_PENJUALAN_RINCIAN', 'T_AK_FAKTUR_PENJUALAN_RINCIAN.ID = T_AK_FAKTUR_PENJUALAN_RINCIAN2.FAKTUR_PENJUALAN_RINCIAN_ID', 'left');

    $this->db->join('T_AK_FAKTUR_PENJUALAN', 'T_AK_FAKTUR_PENJUALAN.ID = T_AK_FAKTUR_PENJUALAN_RINCIAN.FAKTUR_PENJUALAN_ID', 'left');




    
    $this->db->where('T_AK_FAKTUR_PENJUALAN_RINCIAN2.FAKTUR_PENJUALAN_RINCIAN_ID', $id);


    $this->db->order_by("ID", "asc");

    $akun = $this->db->get ();
    return $akun->result ();
  }


  public function delete_id($id)
  {
    $this->db->where('FAKTUR_PENJUALAN_ID',$id);
    $this->db->delete('T_AK_FAKTUR_PENJUALAN_RINCIAN2');
  }

  public function delete($id)
  {
    $this->db->where('ID',$id);
    $this->db->delete('T_AK_FAKTUR_PENJUALAN_RINCIAN2');
  }

  function tambah($data)
  {
        $this->db->insert('T_AK_FAKTUR_PENJUALAN_RINCIAN2', $data);
        return TRUE;
  }

}


