<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_t_ak_terima_pelanggan extends CI_Model {
    
    
public function update($data, $id)
{
    $this->db->where('ID', $id);
    return $this->db->update('T_AK_TERIMA_PELANGGAN', $data);
}

    public function read_no_form($no_form)
 {
    $this->db->select("NO_FORM");
    $this->db->from('T_AK_TERIMA_PELANGGAN');
    $this->db->where('NO_FORM',$no_form);
    $akun = $this->db->get ();
    return $akun->result ();
 }
  public function select($date_terima_pelanggan)
  {
    $this->db->select("T_AK_TERIMA_PELANGGAN.ID");
    $this->db->select("T_AK_TERIMA_PELANGGAN.DATE");
    $this->db->select("T_AK_TERIMA_PELANGGAN.TIME");
    $this->db->select("T_AK_TERIMA_PELANGGAN.KET");
    $this->db->select("T_AK_TERIMA_PELANGGAN.ENABLE_EDIT");
    $this->db->select("T_AK_TERIMA_PELANGGAN.NO_FORM");
    $this->db->select("T_AK_TERIMA_PELANGGAN.PELANGGAN_ID");


    $this->db->select("SUM_TOTAL_PENJUALAN");

    $this->db->select("SUM_JUMLAH");

    $this->db->select("SUM_DISKON");

    $this->db->select("SUM_ADM_BANK");
    
    $this->db->select("SUM_PAYMENT_T");
    

    $this->db->select("T_M_D_PELANGGAN.NO_TELP");
    $this->db->select("T_M_D_PELANGGAN.PELANGGAN");
    $this->db->select("T_M_D_PELANGGAN.ALAMAT");
    $this->db->select("T_M_D_PELANGGAN.NPWP");
    $this->db->select("T_M_D_PELANGGAN.EMAIL");
    $this->db->select("T_M_D_PELANGGAN.NIK");


    $this->db->from('T_AK_TERIMA_PELANGGAN');


    $this->db->join('T_M_D_PELANGGAN', 'T_M_D_PELANGGAN.ID = T_AK_TERIMA_PELANGGAN.PELANGGAN_ID', 'left');

    $this->db->join("(select \"TERIMA_PELANGGAN_ID\",sum(\"TOTAL_PENJUALAN\")\"SUM_TOTAL_PENJUALAN\" from \"T_AK_TERIMA_PELANGGAN_NO_FAKTUR\" group by \"TERIMA_PELANGGAN_ID\") as t_sum_1", 'T_AK_TERIMA_PELANGGAN.ID = t_sum_1.TERIMA_PELANGGAN_ID', 'left');

    $this->db->join("(select \"TERIMA_PELANGGAN_ID\",sum(\"JUMLAH\")\"SUM_JUMLAH\" from \"T_AK_TERIMA_PELANGGAN_METODE_BAYAR\" group by \"TERIMA_PELANGGAN_ID\") as t_sum_2", 'T_AK_TERIMA_PELANGGAN.ID = t_sum_2.TERIMA_PELANGGAN_ID', 'left');


    $this->db->join("(select \"TERIMA_PELANGGAN_ID\",sum(\"JUMLAH\")\"SUM_DISKON\" from \"T_AK_TERIMA_PELANGGAN_DISKON\" group by \"TERIMA_PELANGGAN_ID\") as t_sum_3", 'T_AK_TERIMA_PELANGGAN.ID = t_sum_3.TERIMA_PELANGGAN_ID', 'left');

    $this->db->join("(select \"TERIMA_PELANGGAN_ID\",sum(\"ADM_BANK\")\"SUM_ADM_BANK\" from \"T_AK_TERIMA_PELANGGAN_METODE_BAYAR\" group by \"TERIMA_PELANGGAN_ID\") as t_sum_4", 'T_AK_TERIMA_PELANGGAN.ID = t_sum_4.TERIMA_PELANGGAN_ID', 'left');

    $this->db->join("(select \"T_AK_TERIMA_PELANGGAN_NO_FAKTUR\".\"TERIMA_PELANGGAN_ID\",sum(\"T_AK_FAKTUR_PENJUALAN\".\"PAYMENT_T\")\"SUM_PAYMENT_T\" from \"T_AK_TERIMA_PELANGGAN_NO_FAKTUR\" LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN\" on \"T_AK_FAKTUR_PENJUALAN\".\"ID\"=\"T_AK_TERIMA_PELANGGAN_NO_FAKTUR\".\"FAKTUR_PENJUALAN_ID\" group by \"T_AK_TERIMA_PELANGGAN_NO_FAKTUR\".\"TERIMA_PELANGGAN_ID\") as t_sum_5", 'T_AK_TERIMA_PELANGGAN.ID = t_sum_5.TERIMA_PELANGGAN_ID', 'left');



    $date_before = date('Y-m-d',(strtotime ( '-30 day' , strtotime ( $date_terima_pelanggan) ) ));

    $this->db->where("T_AK_TERIMA_PELANGGAN.DATE<='{$date_terima_pelanggan}' and T_AK_TERIMA_PELANGGAN.DATE>='{$date_before}'");
    $this->db->order_by("ID", "desc");

    $akun = $this->db->get ();
    return $akun->result ();
  }


  public function select_by_id($id)
  {
    $this->db->select("T_AK_TERIMA_PELANGGAN.ID");
    $this->db->select("T_AK_TERIMA_PELANGGAN.DATE");
    $this->db->select("T_AK_TERIMA_PELANGGAN.TIME");
    $this->db->select("T_AK_TERIMA_PELANGGAN.KET");
    $this->db->select("T_AK_TERIMA_PELANGGAN.ENABLE_EDIT");
    $this->db->select("T_AK_TERIMA_PELANGGAN.NO_FORM");
    $this->db->select("T_AK_TERIMA_PELANGGAN.PELANGGAN_ID");


    $this->db->select("SUM_TOTAL_PENJUALAN");

    $this->db->select("SUM_JUMLAH");

    $this->db->select("SUM_DISKON");

    $this->db->select("SUM_ADM_BANK");
    
    $this->db->select("SUM_PAYMENT_T");
    

    $this->db->select("T_M_D_PELANGGAN.NO_TELP");
    $this->db->select("T_M_D_PELANGGAN.PELANGGAN");
    $this->db->select("T_M_D_PELANGGAN.ALAMAT");
    $this->db->select("T_M_D_PELANGGAN.NPWP");
    $this->db->select("T_M_D_PELANGGAN.EMAIL");
    $this->db->select("T_M_D_PELANGGAN.NIK");


    $this->db->from('T_AK_TERIMA_PELANGGAN');


    $this->db->join('T_M_D_PELANGGAN', 'T_M_D_PELANGGAN.ID = T_AK_TERIMA_PELANGGAN.PELANGGAN_ID', 'left');

    $this->db->join("(select \"TERIMA_PELANGGAN_ID\",sum(\"TOTAL_PENJUALAN\")\"SUM_TOTAL_PENJUALAN\" from \"T_AK_TERIMA_PELANGGAN_NO_FAKTUR\" group by \"TERIMA_PELANGGAN_ID\") as t_sum_1", 'T_AK_TERIMA_PELANGGAN.ID = t_sum_1.TERIMA_PELANGGAN_ID', 'left');

    $this->db->join("(select \"TERIMA_PELANGGAN_ID\",sum(\"JUMLAH\")\"SUM_JUMLAH\" from \"T_AK_TERIMA_PELANGGAN_METODE_BAYAR\" group by \"TERIMA_PELANGGAN_ID\") as t_sum_2", 'T_AK_TERIMA_PELANGGAN.ID = t_sum_2.TERIMA_PELANGGAN_ID', 'left');


    $this->db->join("(select \"TERIMA_PELANGGAN_ID\",sum(\"JUMLAH\")\"SUM_DISKON\" from \"T_AK_TERIMA_PELANGGAN_DISKON\" group by \"TERIMA_PELANGGAN_ID\") as t_sum_3", 'T_AK_TERIMA_PELANGGAN.ID = t_sum_3.TERIMA_PELANGGAN_ID', 'left');

    $this->db->join("(select \"TERIMA_PELANGGAN_ID\",sum(\"ADM_BANK\")\"SUM_ADM_BANK\" from \"T_AK_TERIMA_PELANGGAN_METODE_BAYAR\" group by \"TERIMA_PELANGGAN_ID\") as t_sum_4", 'T_AK_TERIMA_PELANGGAN.ID = t_sum_4.TERIMA_PELANGGAN_ID', 'left');

    $this->db->join("(select \"T_AK_TERIMA_PELANGGAN_NO_FAKTUR\".\"TERIMA_PELANGGAN_ID\",sum(\"T_AK_FAKTUR_PENJUALAN\".\"PAYMENT_T\")\"SUM_PAYMENT_T\" from \"T_AK_TERIMA_PELANGGAN_NO_FAKTUR\" LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN\" on \"T_AK_FAKTUR_PENJUALAN\".\"ID\"=\"T_AK_TERIMA_PELANGGAN_NO_FAKTUR\".\"FAKTUR_PENJUALAN_ID\" group by \"T_AK_TERIMA_PELANGGAN_NO_FAKTUR\".\"TERIMA_PELANGGAN_ID\") as t_sum_5", 'T_AK_TERIMA_PELANGGAN.ID = t_sum_5.TERIMA_PELANGGAN_ID', 'left');

    

    $this->db->where('T_AK_TERIMA_PELANGGAN.ID',$id);

    $akun = $this->db->get ();
    return $akun->result ();
  }




  public function select_no_faktur_terutang($faktur_penjualan_id)
  {
    

    $this->db->select("SUM_JUMLAH");
    $this->db->select("SUM_ADM_BANK");

    $this->db->select("SUM_DISKON");


    $this->db->select("SUM_PAYMENT_T");
    

    $this->db->select("T_AK_TERIMA_PELANGGAN_NO_FAKTUR.ID");


    $this->db->from('T_AK_TERIMA_PELANGGAN_NO_FAKTUR');

    $this->db->join("(select \"TERIMA_PELANGGAN_ID\",sum(\"JUMLAH\")\"SUM_JUMLAH\" from \"T_AK_TERIMA_PELANGGAN_METODE_BAYAR\" group by \"TERIMA_PELANGGAN_ID\") as t_sum_2", 'T_AK_TERIMA_PELANGGAN_NO_FAKTUR.TERIMA_PELANGGAN_ID = t_sum_2.TERIMA_PELANGGAN_ID', 'left');


    $this->db->join("(select \"TERIMA_PELANGGAN_ID\",sum(\"JUMLAH\")\"SUM_DISKON\" from \"T_AK_TERIMA_PELANGGAN_DISKON\" group by \"TERIMA_PELANGGAN_ID\") as t_sum_3", 'T_AK_TERIMA_PELANGGAN_NO_FAKTUR.TERIMA_PELANGGAN_ID = t_sum_3.TERIMA_PELANGGAN_ID', 'left');


    $this->db->join("(select \"TERIMA_PELANGGAN_ID\",sum(\"ADM_BANK\")\"SUM_ADM_BANK\" from \"T_AK_TERIMA_PELANGGAN_METODE_BAYAR\" group by \"TERIMA_PELANGGAN_ID\") as t_sum_1", 'T_AK_TERIMA_PELANGGAN_NO_FAKTUR.TERIMA_PELANGGAN_ID = t_sum_1.TERIMA_PELANGGAN_ID', 'left');


    $this->db->join("(select \"T_AK_TERIMA_PELANGGAN_NO_FAKTUR\".\"TERIMA_PELANGGAN_ID\",sum(\"T_AK_FAKTUR_PENJUALAN\".\"PAYMENT_T\")\"SUM_PAYMENT_T\" from \"T_AK_TERIMA_PELANGGAN_NO_FAKTUR\" LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN\" on \"T_AK_FAKTUR_PENJUALAN\".\"ID\"=\"T_AK_TERIMA_PELANGGAN_NO_FAKTUR\".\"FAKTUR_PENJUALAN_ID\" group by \"T_AK_TERIMA_PELANGGAN_NO_FAKTUR\".\"TERIMA_PELANGGAN_ID\") as t_sum_5", 'T_AK_TERIMA_PELANGGAN_NO_FAKTUR.TERIMA_PELANGGAN_ID = t_sum_5.TERIMA_PELANGGAN_ID', 'left');


    //$this->db->join("(select \"TERIMA_PELANGGAN_ID\",sum(\"PAYMENT_T\")\"SUM_PAYMENT_T\" from \"T_AK_TERIMA_PELANGGAN_NO_FAKTUR\" group by \"TERIMA_PELANGGAN_ID\") as t_sum_5", 'T_AK_TERIMA_PELANGGAN_NO_FAKTUR.TERIMA_PELANGGAN_ID = t_sum_5.TERIMA_PELANGGAN_ID', 'left');

    

    $this->db->where('T_AK_TERIMA_PELANGGAN_NO_FAKTUR.FAKTUR_PENJUALAN_ID',$faktur_penjualan_id);

    $akun = $this->db->get ();
    return $akun->result ();
  }



  public function delete($id)
  {
    $this->db->where('ID',$id);
    $this->db->delete('T_AK_TERIMA_PELANGGAN');
  }

  function tambah($data)
  {
        $this->db->insert('T_AK_TERIMA_PELANGGAN', $data);
        return TRUE;
  }

}


