<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_t_m_d_pelanggan extends CI_Model {
    
   

public function update($data, $id)
{
    $this->db->where('ID', $id);
    return $this->db->update('T_M_D_PELANGGAN', $data);
}

public function select_id($id)
{
  $this->db->select('ID');
  $this->db->from('T_M_D_PELANGGAN');
  $this->db->where('PELANGGAN', $id);
  $akun = $this->db->get ();
  return $akun->result ();
}





  public function select_by_id($id)
  {
    $this->db->select('*');
    $this->db->from('T_M_D_PELANGGAN');

    
    $this->db->where('ID',$id);
    
    
    $akun = $this->db->get ();
    return $akun->result ();
  }




  public function select_rekap_hutang_pelanggan()
  {
    $this->db->select("T_M_D_PELANGGAN.ID");
    $this->db->select("T_M_D_PELANGGAN.PELANGGAN");


    $this->db->select("SUM_TOTAL_TAGIHAN");
    $this->db->select("SUM_TOTAL_TAGIHAN_PPN");

    

    $this->db->from('T_M_D_PELANGGAN');

    



    $this->db->join("(select \"T_AK_FAKTUR_PENJUALAN\".\"PELANGGAN_ID\",sum(\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"SUB_TOTAL\")\"SUM_TOTAL_TAGIHAN\" from \"T_T_T_PENJUALAN_JASA_RINCIAN\"LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\" ON \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"ID\"=\"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"PENJUALAN_RINCIAN_ID\" LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN\" ON \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"ID\" = \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"FAKTUR_PENJUALAN_RINCIAN_ID\" LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN\" ON \"T_AK_FAKTUR_PENJUALAN\".\"ID\" = \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"FAKTUR_PENJUALAN_ID\"     where \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"MARK_FOR_DELETE\"=false group by \"T_AK_FAKTUR_PENJUALAN\".\"PELANGGAN_ID\") as t_sum5", 'T_M_D_PELANGGAN.ID = t_sum5.PELANGGAN_ID', 'left');

    $this->db->join("(select \"T_AK_FAKTUR_PENJUALAN\".\"PELANGGAN_ID\",sum(\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"PPN_VALUE\")\"SUM_TOTAL_TAGIHAN_PPN\" from \"T_T_T_PENJUALAN_JASA_RINCIAN\"LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\" ON \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"ID\"=\"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"PENJUALAN_RINCIAN_ID\" LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN\" ON \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"ID\" = \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"FAKTUR_PENJUALAN_RINCIAN_ID\" LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN\" ON \"T_AK_FAKTUR_PENJUALAN\".\"ID\" = \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"FAKTUR_PENJUALAN_ID\"     where \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"MARK_FOR_DELETE\"=false group by \"T_AK_FAKTUR_PENJUALAN\".\"PELANGGAN_ID\") as t_sum6", 'T_M_D_PELANGGAN.ID = t_sum6.PELANGGAN_ID', 'left');





    $this->db->where('T_M_D_PELANGGAN.MARK_FOR_DELETE',FALSE);
    
    
    $this->db->order_by("PELANGGAN", "asc");
    $akun = $this->db->get ();
    return $akun->result ();
  }





  public function select()
  {
    $this->db->select('*');
    $this->db->from('T_M_D_PELANGGAN');

    if($this->session->userdata('t_m_d_pelanggan_delete_logic')==0)
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
    $this->db->delete('T_M_D_PELANGGAN');
  }

  function tambah($data)
  {
    $this->db->insert('T_M_D_PELANGGAN', $data);
    return TRUE;
  }

}


