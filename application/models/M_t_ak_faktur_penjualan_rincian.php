<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_t_ak_faktur_penjualan_rincian extends CI_Model {
    
    

public function update($data, $id)
{
    $this->db->where('ID', $id);
    return $this->db->update('T_AK_FAKTUR_PENJUALAN_RINCIAN', $data);
}




  public function select($id)
  {
    $this->db->select("T_AK_FAKTUR_PENJUALAN_RINCIAN.ID");
    $this->db->select("T_AK_FAKTUR_PENJUALAN_RINCIAN.FAKTUR_PENJUALAN_ID");
    $this->db->select("T_AK_FAKTUR_PENJUALAN_RINCIAN.PENJUALAN_ID");
    $this->db->select("T_AK_FAKTUR_PENJUALAN_RINCIAN.CREATED_BY");
    $this->db->select("T_AK_FAKTUR_PENJUALAN_RINCIAN.UPDATED_BY");
    $this->db->select("T_AK_FAKTUR_PENJUALAN_RINCIAN.KETERANGAN");



    $this->db->select("T_T_T_PENJUALAN_JASA.DATE");
    $this->db->select("T_T_T_PENJUALAN_JASA.TIME");

    $this->db->select("T_T_T_PENJUALAN_JASA.NO_DO");
    $this->db->select("T_T_T_PENJUALAN_JASA.KET");

    $this->db->select("T_AK_FAKTUR_PENJUALAN.ENABLE_EDIT");

    $this->db->select("SUM_SUB_TOTAL");
    $this->db->select("SUM_PPN_VALUE");
    $this->db->select("SUM_TOTAL_SPB");
    $this->db->select("SUM_TOTAL_SPB_PPN");



    $this->db->select("SUM_VALUE_KEBUN");
    $this->db->select("SUM_PC");
    $this->db->select("SUM_TONASE");

    
    $this->db->from('T_AK_FAKTUR_PENJUALAN_RINCIAN');

    $this->db->join('T_T_T_PENJUALAN_JASA', 'T_T_T_PENJUALAN_JASA.ID = T_AK_FAKTUR_PENJUALAN_RINCIAN.PENJUALAN_ID', 'left');

    $this->db->join('T_AK_FAKTUR_PENJUALAN', 'T_AK_FAKTUR_PENJUALAN.ID = T_AK_FAKTUR_PENJUALAN_RINCIAN.FAKTUR_PENJUALAN_ID', 'left');


    $this->db->join("(select \"PENJUALAN_JASA_ID\",sum(\"SUB_TOTAL\")\"SUM_SUB_TOTAL\" from \"T_T_T_PENJUALAN_JASA_RINCIAN\" where \"MARK_FOR_DELETE\"=false group by \"PENJUALAN_JASA_ID\") as t_sum_1", 'T_T_T_PENJUALAN_JASA.ID = t_sum_1.PENJUALAN_JASA_ID', 'left');

    $this->db->join("(select \"PENJUALAN_JASA_ID\",sum(\"PPN_VALUE\")\"SUM_PPN_VALUE\" from \"T_T_T_PENJUALAN_JASA_RINCIAN\" where \"MARK_FOR_DELETE\"=false group by \"PENJUALAN_JASA_ID\") as t_sum_2", 'T_T_T_PENJUALAN_JASA.ID = t_sum_2.PENJUALAN_JASA_ID', 'left');






    $this->db->join("(select \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"FAKTUR_PENJUALAN_RINCIAN_ID\",sum(\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"SUB_TOTAL\")\"SUM_TOTAL_SPB\" from \"T_T_T_PENJUALAN_JASA_RINCIAN\" LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\" on \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"ID\"=\"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"PENJUALAN_RINCIAN_ID\" group by \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"FAKTUR_PENJUALAN_RINCIAN_ID\") as t_sum_5", 'T_AK_FAKTUR_PENJUALAN_RINCIAN.ID = t_sum_5.FAKTUR_PENJUALAN_RINCIAN_ID', 'left');


    $this->db->join("(select \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"FAKTUR_PENJUALAN_RINCIAN_ID\",sum(\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"PPN_VALUE\")\"SUM_TOTAL_SPB_PPN\" from \"T_T_T_PENJUALAN_JASA_RINCIAN\" LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\" on \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"ID\"=\"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"PENJUALAN_RINCIAN_ID\" group by \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"FAKTUR_PENJUALAN_RINCIAN_ID\") as t_sum_6", 'T_AK_FAKTUR_PENJUALAN_RINCIAN.ID = t_sum_6.FAKTUR_PENJUALAN_RINCIAN_ID', 'left');




    $this->db->join("(select \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"FAKTUR_PENJUALAN_RINCIAN_ID\",sum(\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"VALUE_KEBUN\")\"SUM_VALUE_KEBUN\" from \"T_T_T_PENJUALAN_JASA_RINCIAN\" LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\" on \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"ID\"=\"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"PENJUALAN_RINCIAN_ID\" group by \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"FAKTUR_PENJUALAN_RINCIAN_ID\") as t_sum_10", 'T_AK_FAKTUR_PENJUALAN_RINCIAN.ID = t_sum_10.FAKTUR_PENJUALAN_RINCIAN_ID', 'left');


    $this->db->join("(select \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"FAKTUR_PENJUALAN_RINCIAN_ID\",sum(\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"PC\")\"SUM_PC\" from \"T_T_T_PENJUALAN_JASA_RINCIAN\" LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\" on \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"ID\"=\"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"PENJUALAN_RINCIAN_ID\" group by \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"FAKTUR_PENJUALAN_RINCIAN_ID\") as t_sum_11", 'T_AK_FAKTUR_PENJUALAN_RINCIAN.ID = t_sum_11.FAKTUR_PENJUALAN_RINCIAN_ID', 'left');

    $this->db->join("(select \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"FAKTUR_PENJUALAN_RINCIAN_ID\",sum(\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"TONASE\")\"SUM_TONASE\" from \"T_T_T_PENJUALAN_JASA_RINCIAN\" LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\" on \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"ID\"=\"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"PENJUALAN_RINCIAN_ID\" group by \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"FAKTUR_PENJUALAN_RINCIAN_ID\") as t_sum_12", 'T_AK_FAKTUR_PENJUALAN_RINCIAN.ID = t_sum_12.FAKTUR_PENJUALAN_RINCIAN_ID', 'left');


    
    $this->db->where('T_AK_FAKTUR_PENJUALAN_RINCIAN.FAKTUR_PENJUALAN_ID', $id);


    $this->db->order_by("ID", "asc");

    $akun = $this->db->get ();
    return $akun->result ();
  }


  public function delete_id($id)
  {
    $this->db->where('FAKTUR_PENJUALAN_ID',$id);
    $this->db->delete('T_AK_FAKTUR_PENJUALAN_RINCIAN');
  }

  public function delete($id)
  {
    $this->db->where('ID',$id);
    $this->db->delete('T_AK_FAKTUR_PENJUALAN_RINCIAN');
  }

  function tambah($data)
  {
        $this->db->insert('T_AK_FAKTUR_PENJUALAN_RINCIAN', $data);
        return TRUE;
  }

}


