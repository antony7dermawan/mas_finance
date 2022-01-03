<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_t_ak_faktur_penjualan extends CI_Model {
    
    

public function update($data, $id)
{
    $this->db->where('ID', $id);
    return $this->db->update('T_AK_FAKTUR_PENJUALAN', $data);
}


public function select_inv_int()
  {
    $date_before = date('Y-m',(strtotime ( '-30 day' , strtotime ( date('Y-m-d')) ) ));
    $this_year = $date_before.'-01';

    $this->db->limit(1);
    $this->db->select("INV_INT");
    $this->db->from('T_AK_FAKTUR_PENJUALAN');
    $this->db->where("COMPANY_ID={$this->session->userdata('company_id')}");
    $this->db->where("DATE>='{$this_year}'");
    $this->db->order_by("ID", "desc");

    $akun = $this->db->get ();
    return $akun->result ();
  }

public function select_no_faktur()
{

    $this->db->select("T_AK_FAKTUR_PENJUALAN.ID");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.DATE");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.TIME");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.PELANGGAN_ID");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.CREATED_BY");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.UPDATED_BY");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.KETERANGAN");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.NO_FAKTUR");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.ENABLE_EDIT");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.PAYMENT_T");


    $this->db->select("T_AK_FAKTUR_PENJUALAN.NO_FAKTUR_PAJAK");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.NO_KONTRAK");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.KET_2");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.ATTENTION");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.DEPARTMENT");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.TELP_NO");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.PO_NO");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.DN_NO");











    $this->db->select("T_M_D_PELANGGAN.ID as PELANGGAN_ID");
    $this->db->select("T_M_D_PELANGGAN.PELANGGAN");

    $this->db->select("T_M_D_PELANGGAN.ALAMAT");
    $this->db->select("T_M_D_PELANGGAN.NPWP");
    $this->db->select("T_M_D_PELANGGAN.NIK");
    $this->db->select("T_M_D_PELANGGAN.NO_TELP");


    $this->db->select("T_AK_FAKTUR_PENJUALAN.PAYMENT_T");

    $this->db->select("SUM_TOTAL_PENJUALAN");
    $this->db->select("SUM_PPN_VALUE");
    $this->db->select("SUM_TOTAL_TAGIHAN");
    $this->db->select("SUM_TOTAL_TAGIHAN_PPN");
    $this->db->select("SUM_VALUE_DISKON");
    $this->db->select("SUM_VALUE_PPH");


    $this->db->from("T_AK_FAKTUR_PENJUALAN");
    //$this->db->join('T_AK_TERIMA_PELANGGAN_NO_FAKTUR', 'T_AK_TERIMA_PELANGGAN_NO_FAKTUR.FAKTUR_PENJUALAN_ID = T_AK_FAKTUR_PENJUALAN.ID', 'left');

    $this->db->join('T_M_D_PELANGGAN', 'T_M_D_PELANGGAN.ID = T_AK_FAKTUR_PENJUALAN.PELANGGAN_ID', 'left');


    $this->db->join("(select \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"FAKTUR_PENJUALAN_ID\",sum(\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"SUB_TOTAL\")\"SUM_TOTAL_PENJUALAN\" from \"T_T_T_PENJUALAN_JASA_RINCIAN\"LEFT OUTER JOIN \"T_T_T_PENJUALAN_JASA\" ON \"T_T_T_PENJUALAN_JASA\".\"ID\"=\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"PENJUALAN_JASA_ID\" LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN\" ON \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"PENJUALAN_ID\" = \"T_T_T_PENJUALAN_JASA\".\"ID\" where \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"MARK_FOR_DELETE\"=false group by \"FAKTUR_PENJUALAN_ID\") as t_sum", 'T_AK_FAKTUR_PENJUALAN.ID = t_sum.FAKTUR_PENJUALAN_ID', 'left');


    $this->db->join("(select \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"FAKTUR_PENJUALAN_ID\",sum(\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"PPN_VALUE\")\"SUM_PPN_VALUE\" from \"T_T_T_PENJUALAN_JASA_RINCIAN\"LEFT OUTER JOIN \"T_T_T_PENJUALAN_JASA\" ON \"T_T_T_PENJUALAN_JASA\".\"ID\"=\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"PENJUALAN_JASA_ID\" LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN\" ON \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"PENJUALAN_ID\" = \"T_T_T_PENJUALAN_JASA\".\"ID\" where \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"MARK_FOR_DELETE\"=false group by \"FAKTUR_PENJUALAN_ID\") as t_sum2", 'T_AK_FAKTUR_PENJUALAN.ID = t_sum2.FAKTUR_PENJUALAN_ID', 'left');



    $this->db->join("(select \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"FAKTUR_PENJUALAN_ID\",sum(\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"SUB_TOTAL\")\"SUM_TOTAL_TAGIHAN\" from \"T_T_T_PENJUALAN_JASA_RINCIAN\"LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\" ON \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"ID\"=\"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"PENJUALAN_RINCIAN_ID\" LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN\" ON \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"ID\" = \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"FAKTUR_PENJUALAN_RINCIAN_ID\" where \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"MARK_FOR_DELETE\"=false group by \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"FAKTUR_PENJUALAN_ID\") as t_sum5", 'T_AK_FAKTUR_PENJUALAN.ID = t_sum5.FAKTUR_PENJUALAN_ID', 'left');


    $this->db->join("(select \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"FAKTUR_PENJUALAN_ID\",sum(\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"PPN_VALUE\")\"SUM_TOTAL_TAGIHAN_PPN\" from \"T_T_T_PENJUALAN_JASA_RINCIAN\"LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\" ON \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"ID\"=\"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"PENJUALAN_RINCIAN_ID\" LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN\" ON \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"ID\" = \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"FAKTUR_PENJUALAN_RINCIAN_ID\" where \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"MARK_FOR_DELETE\"=false group by \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"FAKTUR_PENJUALAN_ID\") as t_sum6", 'T_AK_FAKTUR_PENJUALAN.ID = t_sum6.FAKTUR_PENJUALAN_ID', 'left');



    $this->db->join("(select \"FAKTUR_PENJUALAN_ID\",sum(\"VALUE_DISKON\")\"SUM_VALUE_DISKON\" from \"T_AK_FAKTUR_PENJUALAN_DISKON\" where \"MARK_FOR_DELETE\"=false group by \"FAKTUR_PENJUALAN_ID\") as t_sum_7", 'T_AK_FAKTUR_PENJUALAN.ID = t_sum_7.FAKTUR_PENJUALAN_ID', 'left');


    $this->db->join("(select \"FAKTUR_PENJUALAN_ID\",sum(\"VALUE_PPH\")\"SUM_VALUE_PPH\" from \"T_AK_FAKTUR_PENJUALAN_PPH\" where \"MARK_FOR_DELETE\"=false group by \"FAKTUR_PENJUALAN_ID\") as t_sum_8", 'T_AK_FAKTUR_PENJUALAN.ID = t_sum_8.FAKTUR_PENJUALAN_ID', 'left');



    //$this->db->where("(((\"SUM_TOTAL_TAGIHAN\"+\"SUM_TOTAL_TAGIHAN_PPN\")-\"SUM_VALUE_DISKON\")-\"SUM_VALUE_PPH\")<>T_AK_FAKTUR_PENJUALAN.PAYMENT_T");

    $this->db->where("T_AK_FAKTUR_PENJUALAN.PAYMENT_T<SUM_TOTAL_TAGIHAN");
    $this->db->where("T_AK_FAKTUR_PENJUALAN.COMPANY_ID={$this->session->userdata('company_id')}");

    $akun = $this->db->get ();
    return $akun->result ();
}


 public function read_no_faktur($no_faktur)
 {
    $this->db->select("NO_FAKTUR");
    $this->db->from('T_AK_FAKTUR_PENJUALAN');
    $this->db->where('NO_FAKTUR',$no_faktur);
    $akun = $this->db->get ();
    return $akun->result ();
 }












public function select_by_date_payment_method($date_from,$date_to,$payment_method_id)
  {
    $this->db->select("T_AK_FAKTUR_PENJUALAN.ID");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.DATE");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.TIME");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.CREATED_BY");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.UPDATED_BY");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.KETERANGAN");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.NO_FAKTUR");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.ENABLE_EDIT");


    $this->db->select("T_AK_FAKTUR_PENJUALAN.NO_FAKTUR_PAJAK");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.NO_KONTRAK");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.KET_2");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.ATTENTION");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.DEPARTMENT");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.TELP_NO");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.PO_NO");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.DN_NO");



    $this->db->select("T_AK_TERIMA_PELANGGAN.DATE as DATE_PELUNASAN");






    $this->db->select("T_M_D_PELANGGAN.ID as PELANGGAN_ID");
    $this->db->select("T_M_D_PELANGGAN.PELANGGAN");



    $this->db->select("T_AK_FAKTUR_PENJUALAN.PAYMENT_T");


    





    $this->db->select("SUM_VALUE_KEBUN");

    $this->db->select("SUM_TOTAL_PENJUALAN");
    $this->db->select("SUM_PPN_VALUE");
    $this->db->select("SUM_TOTAL_TAGIHAN");
    $this->db->select("SUM_TOTAL_TAGIHAN_PPN");
    $this->db->select("SUM_VALUE_DISKON");
    $this->db->select("SUM_VALUE_PPH");



    

    $this->db->from('T_AK_FAKTUR_PENJUALAN');

    $this->db->join('T_M_D_PELANGGAN', 'T_M_D_PELANGGAN.ID = T_AK_FAKTUR_PENJUALAN.PELANGGAN_ID', 'left');





    $this->db->join('T_AK_TERIMA_PELANGGAN_NO_FAKTUR', 'T_AK_FAKTUR_PENJUALAN.ID = T_AK_TERIMA_PELANGGAN_NO_FAKTUR.FAKTUR_PENJUALAN_ID', 'left');

    $this->db->join('T_AK_TERIMA_PELANGGAN', 'T_AK_TERIMA_PELANGGAN.ID = T_AK_TERIMA_PELANGGAN_NO_FAKTUR.TERIMA_PELANGGAN_ID', 'left');






    $this->db->join("(select \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"FAKTUR_PENJUALAN_ID\",sum(\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"SUB_TOTAL\")\"SUM_TOTAL_PENJUALAN\" from \"T_T_T_PENJUALAN_JASA_RINCIAN\"LEFT OUTER JOIN \"T_T_T_PENJUALAN_JASA\" ON \"T_T_T_PENJUALAN_JASA\".\"ID\"=\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"PENJUALAN_JASA_ID\" LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN\" ON \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"PENJUALAN_ID\" = \"T_T_T_PENJUALAN_JASA\".\"ID\" where \"T_T_T_PENJUALAN_JASA\".\"PAYMENT_METHOD_ID\"={$payment_method_id} and \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"MARK_FOR_DELETE\"=false group by \"FAKTUR_PENJUALAN_ID\") as t_sum", 'T_AK_FAKTUR_PENJUALAN.ID = t_sum.FAKTUR_PENJUALAN_ID', 'left');


    $this->db->join("(select \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"FAKTUR_PENJUALAN_ID\",sum(\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"PPN_VALUE\")\"SUM_PPN_VALUE\" from \"T_T_T_PENJUALAN_JASA_RINCIAN\"LEFT OUTER JOIN \"T_T_T_PENJUALAN_JASA\" ON \"T_T_T_PENJUALAN_JASA\".\"ID\"=\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"PENJUALAN_JASA_ID\" LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN\" ON \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"PENJUALAN_ID\" = \"T_T_T_PENJUALAN_JASA\".\"ID\" where \"T_T_T_PENJUALAN_JASA\".\"PAYMENT_METHOD_ID\"={$payment_method_id} and  \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"MARK_FOR_DELETE\"=false group by \"FAKTUR_PENJUALAN_ID\") as t_sum2", 'T_AK_FAKTUR_PENJUALAN.ID = t_sum2.FAKTUR_PENJUALAN_ID', 'left');





    $this->db->join("(select \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"FAKTUR_PENJUALAN_ID\",sum(\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"SUB_TOTAL\")\"SUM_TOTAL_TAGIHAN\" from \"T_T_T_PENJUALAN_JASA_RINCIAN\"LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\" ON \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"ID\"=\"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"PENJUALAN_RINCIAN_ID\" LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN\" ON \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"ID\" = \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"FAKTUR_PENJUALAN_RINCIAN_ID\" 

        LEFT OUTER JOIN \"T_T_T_PENJUALAN_JASA\" ON \"T_T_T_PENJUALAN_JASA\".\"ID\" = \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"PENJUALAN_JASA_ID\"

        where \"T_T_T_PENJUALAN_JASA\".\"PAYMENT_METHOD_ID\"={$payment_method_id} and \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"MARK_FOR_DELETE\"=false group by \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"FAKTUR_PENJUALAN_ID\") as t_sum5", 'T_AK_FAKTUR_PENJUALAN.ID = t_sum5.FAKTUR_PENJUALAN_ID', 'left');


    $this->db->join("(select \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"FAKTUR_PENJUALAN_ID\",sum(\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"PPN_VALUE\")\"SUM_TOTAL_TAGIHAN_PPN\" from \"T_T_T_PENJUALAN_JASA_RINCIAN\"LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\" ON \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"ID\"=\"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"PENJUALAN_RINCIAN_ID\" LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN\" ON \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"ID\" = \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"FAKTUR_PENJUALAN_RINCIAN_ID\" 

        LEFT OUTER JOIN \"T_T_T_PENJUALAN_JASA\" ON \"T_T_T_PENJUALAN_JASA\".\"ID\" = \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"PENJUALAN_JASA_ID\"

        where \"T_T_T_PENJUALAN_JASA\".\"PAYMENT_METHOD_ID\"={$payment_method_id} and  \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"MARK_FOR_DELETE\"=false group by \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"FAKTUR_PENJUALAN_ID\") as t_sum6", 'T_AK_FAKTUR_PENJUALAN.ID = t_sum6.FAKTUR_PENJUALAN_ID', 'left');





    $this->db->join("(select \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"FAKTUR_PENJUALAN_ID\",sum(\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"VALUE_KEBUN\")\"SUM_VALUE_KEBUN\" from \"T_T_T_PENJUALAN_JASA_RINCIAN\"LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\" ON \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"ID\"=\"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"PENJUALAN_RINCIAN_ID\" LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN\" ON \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"ID\" = \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"FAKTUR_PENJUALAN_RINCIAN_ID\" where \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"MARK_FOR_DELETE\"=false group by \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"FAKTUR_PENJUALAN_ID\") as t_sum7", 'T_AK_FAKTUR_PENJUALAN.ID = t_sum7.FAKTUR_PENJUALAN_ID', 'left');





    $this->db->join("(select \"FAKTUR_PENJUALAN_ID\",sum(\"VALUE_DISKON\")\"SUM_VALUE_DISKON\" from \"T_AK_FAKTUR_PENJUALAN_DISKON\" where \"MARK_FOR_DELETE\"=false group by \"FAKTUR_PENJUALAN_ID\") as t_sum_7", 'T_AK_FAKTUR_PENJUALAN.ID = t_sum_7.FAKTUR_PENJUALAN_ID', 'left');


    $this->db->join("(select \"FAKTUR_PENJUALAN_ID\",sum(\"VALUE_PPH\")\"SUM_VALUE_PPH\" from \"T_AK_FAKTUR_PENJUALAN_PPH\" where \"MARK_FOR_DELETE\"=false group by \"FAKTUR_PENJUALAN_ID\") as t_sum_8", 'T_AK_FAKTUR_PENJUALAN.ID = t_sum_8.FAKTUR_PENJUALAN_ID', 'left');


    

    $this->db->where("T_AK_FAKTUR_PENJUALAN.DATE<='{$date_to}' and T_AK_FAKTUR_PENJUALAN.DATE>='{$date_from}'");

    $this->db->where("T_AK_FAKTUR_PENJUALAN.COMPANY_ID={$this->session->userdata('company_id')}");



    $this->db->where("SUM_TOTAL_TAGIHAN>0");

    


    $this->db->order_by("ID", "desc");

    $akun = $this->db->get ();
    return $akun->result ();
  }






public function select_by_date($date_from,$date_to)
  {
    $this->db->select("T_AK_FAKTUR_PENJUALAN.ID");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.DATE");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.TIME");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.CREATED_BY");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.UPDATED_BY");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.KETERANGAN");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.NO_FAKTUR");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.ENABLE_EDIT");


    $this->db->select("T_AK_FAKTUR_PENJUALAN.NO_FAKTUR_PAJAK");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.NO_KONTRAK");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.KET_2");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.ATTENTION");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.DEPARTMENT");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.TELP_NO");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.PO_NO");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.DN_NO");



    $this->db->select("T_AK_TERIMA_PELANGGAN.DATE as DATE_PELUNASAN");






    $this->db->select("T_M_D_PELANGGAN.ID as PELANGGAN_ID");
    $this->db->select("T_M_D_PELANGGAN.PELANGGAN");



    $this->db->select("T_AK_FAKTUR_PENJUALAN.PAYMENT_T");


    





    $this->db->select("SUM_VALUE_KEBUN");

    $this->db->select("SUM_TOTAL_PENJUALAN");
    $this->db->select("SUM_PPN_VALUE");
    $this->db->select("SUM_TOTAL_TAGIHAN");
    $this->db->select("SUM_TOTAL_TAGIHAN_PPN");
    $this->db->select("SUM_VALUE_DISKON");
    $this->db->select("SUM_VALUE_PPH");



    

    $this->db->from('T_AK_FAKTUR_PENJUALAN');

    $this->db->join('T_M_D_PELANGGAN', 'T_M_D_PELANGGAN.ID = T_AK_FAKTUR_PENJUALAN.PELANGGAN_ID', 'left');





    $this->db->join('T_AK_TERIMA_PELANGGAN_NO_FAKTUR', 'T_AK_FAKTUR_PENJUALAN.ID = T_AK_TERIMA_PELANGGAN_NO_FAKTUR.FAKTUR_PENJUALAN_ID', 'left');

    $this->db->join('T_AK_TERIMA_PELANGGAN', 'T_AK_TERIMA_PELANGGAN.ID = T_AK_TERIMA_PELANGGAN_NO_FAKTUR.TERIMA_PELANGGAN_ID', 'left');






    $this->db->join("(select \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"FAKTUR_PENJUALAN_ID\",sum(\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"SUB_TOTAL\")\"SUM_TOTAL_PENJUALAN\" from \"T_T_T_PENJUALAN_JASA_RINCIAN\"LEFT OUTER JOIN \"T_T_T_PENJUALAN_JASA\" ON \"T_T_T_PENJUALAN_JASA\".\"ID\"=\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"PENJUALAN_JASA_ID\" LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN\" ON \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"PENJUALAN_ID\" = \"T_T_T_PENJUALAN_JASA\".\"ID\" where \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"MARK_FOR_DELETE\"=false group by \"FAKTUR_PENJUALAN_ID\") as t_sum", 'T_AK_FAKTUR_PENJUALAN.ID = t_sum.FAKTUR_PENJUALAN_ID', 'left');


    $this->db->join("(select \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"FAKTUR_PENJUALAN_ID\",sum(\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"PPN_VALUE\")\"SUM_PPN_VALUE\" from \"T_T_T_PENJUALAN_JASA_RINCIAN\"LEFT OUTER JOIN \"T_T_T_PENJUALAN_JASA\" ON \"T_T_T_PENJUALAN_JASA\".\"ID\"=\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"PENJUALAN_JASA_ID\" LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN\" ON \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"PENJUALAN_ID\" = \"T_T_T_PENJUALAN_JASA\".\"ID\" where \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"MARK_FOR_DELETE\"=false group by \"FAKTUR_PENJUALAN_ID\") as t_sum2", 'T_AK_FAKTUR_PENJUALAN.ID = t_sum2.FAKTUR_PENJUALAN_ID', 'left');





    $this->db->join("(select \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"FAKTUR_PENJUALAN_ID\",sum(\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"SUB_TOTAL\")\"SUM_TOTAL_TAGIHAN\" from \"T_T_T_PENJUALAN_JASA_RINCIAN\"LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\" ON \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"ID\"=\"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"PENJUALAN_RINCIAN_ID\" LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN\" ON \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"ID\" = \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"FAKTUR_PENJUALAN_RINCIAN_ID\" where \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"MARK_FOR_DELETE\"=false group by \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"FAKTUR_PENJUALAN_ID\") as t_sum5", 'T_AK_FAKTUR_PENJUALAN.ID = t_sum5.FAKTUR_PENJUALAN_ID', 'left');


    $this->db->join("(select \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"FAKTUR_PENJUALAN_ID\",sum(\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"PPN_VALUE\")\"SUM_TOTAL_TAGIHAN_PPN\" from \"T_T_T_PENJUALAN_JASA_RINCIAN\"LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\" ON \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"ID\"=\"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"PENJUALAN_RINCIAN_ID\" LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN\" ON \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"ID\" = \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"FAKTUR_PENJUALAN_RINCIAN_ID\" where \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"MARK_FOR_DELETE\"=false group by \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"FAKTUR_PENJUALAN_ID\") as t_sum6", 'T_AK_FAKTUR_PENJUALAN.ID = t_sum6.FAKTUR_PENJUALAN_ID', 'left');





    $this->db->join("(select \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"FAKTUR_PENJUALAN_ID\",sum(\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"VALUE_KEBUN\")\"SUM_VALUE_KEBUN\" from \"T_T_T_PENJUALAN_JASA_RINCIAN\"LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\" ON \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"ID\"=\"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"PENJUALAN_RINCIAN_ID\" LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN\" ON \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"ID\" = \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"FAKTUR_PENJUALAN_RINCIAN_ID\" where \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"MARK_FOR_DELETE\"=false group by \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"FAKTUR_PENJUALAN_ID\") as t_sum7", 'T_AK_FAKTUR_PENJUALAN.ID = t_sum7.FAKTUR_PENJUALAN_ID', 'left');





    $this->db->join("(select \"FAKTUR_PENJUALAN_ID\",sum(\"VALUE_DISKON\")\"SUM_VALUE_DISKON\" from \"T_AK_FAKTUR_PENJUALAN_DISKON\" where \"MARK_FOR_DELETE\"=false group by \"FAKTUR_PENJUALAN_ID\") as t_sum_7", 'T_AK_FAKTUR_PENJUALAN.ID = t_sum_7.FAKTUR_PENJUALAN_ID', 'left');


    $this->db->join("(select \"FAKTUR_PENJUALAN_ID\",sum(\"VALUE_PPH\")\"SUM_VALUE_PPH\" from \"T_AK_FAKTUR_PENJUALAN_PPH\" where \"MARK_FOR_DELETE\"=false group by \"FAKTUR_PENJUALAN_ID\") as t_sum_8", 'T_AK_FAKTUR_PENJUALAN.ID = t_sum_8.FAKTUR_PENJUALAN_ID', 'left');


    

    $this->db->where("T_AK_FAKTUR_PENJUALAN.DATE<='{$date_to}' and T_AK_FAKTUR_PENJUALAN.DATE>='{$date_from}'");

    $this->db->where("T_AK_FAKTUR_PENJUALAN.COMPANY_ID={$this->session->userdata('company_id')}");
    $this->db->order_by("ID", "desc");

    $akun = $this->db->get ();
    return $akun->result ();
  }












  public function select($date_faktur_penjualan)
  {
    $this->db->select("T_AK_FAKTUR_PENJUALAN.ID");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.DATE");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.TIME");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.CREATED_BY");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.UPDATED_BY");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.KETERANGAN");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.NO_FAKTUR");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.ENABLE_EDIT");


    $this->db->select("T_AK_FAKTUR_PENJUALAN.NO_FAKTUR_PAJAK");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.NO_KONTRAK");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.KET_2");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.ATTENTION");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.DEPARTMENT");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.TELP_NO");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.PO_NO");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.DN_NO");






    $this->db->select("T_M_D_PELANGGAN.ID as PELANGGAN_ID");
    $this->db->select("T_M_D_PELANGGAN.PELANGGAN");



    $this->db->select("T_AK_FAKTUR_PENJUALAN.PAYMENT_T");


    $this->db->select("SUM_TOTAL_PENJUALAN");


    $this->db->select("SUM_PPN_VALUE");
    $this->db->select("SUM_TOTAL_TAGIHAN");
    $this->db->select("SUM_TOTAL_TAGIHAN_PPN");
    $this->db->select("SUM_VALUE_DISKON");
    $this->db->select("SUM_VALUE_PPH");



    

    $this->db->from('T_AK_FAKTUR_PENJUALAN');

    $this->db->join('T_M_D_PELANGGAN', 'T_M_D_PELANGGAN.ID = T_AK_FAKTUR_PENJUALAN.PELANGGAN_ID', 'left');

    //$this->db->join('T_AK_TERIMA_PELANGGAN_NO_FAKTUR', 'T_AK_FAKTUR_PENJUALAN.ID = T_AK_TERIMA_PELANGGAN_NO_FAKTUR.FAKTUR_PENJUALAN_ID', 'left');

    $this->db->join("(select \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"FAKTUR_PENJUALAN_ID\",sum(\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"SUB_TOTAL\")\"SUM_TOTAL_PENJUALAN\" from \"T_T_T_PENJUALAN_JASA_RINCIAN\"LEFT OUTER JOIN \"T_T_T_PENJUALAN_JASA\" ON \"T_T_T_PENJUALAN_JASA\".\"ID\"=\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"PENJUALAN_JASA_ID\" LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN\" ON \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"PENJUALAN_ID\" = \"T_T_T_PENJUALAN_JASA\".\"ID\" where \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"MARK_FOR_DELETE\"=false group by \"FAKTUR_PENJUALAN_ID\") as t_sum", 'T_AK_FAKTUR_PENJUALAN.ID = t_sum.FAKTUR_PENJUALAN_ID', 'left');


    $this->db->join("(select \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"FAKTUR_PENJUALAN_ID\",sum(\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"PPN_VALUE\")\"SUM_PPN_VALUE\" from \"T_T_T_PENJUALAN_JASA_RINCIAN\"LEFT OUTER JOIN \"T_T_T_PENJUALAN_JASA\" ON \"T_T_T_PENJUALAN_JASA\".\"ID\"=\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"PENJUALAN_JASA_ID\" LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN\" ON \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"PENJUALAN_ID\" = \"T_T_T_PENJUALAN_JASA\".\"ID\" where \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"MARK_FOR_DELETE\"=false group by \"FAKTUR_PENJUALAN_ID\") as t_sum2", 'T_AK_FAKTUR_PENJUALAN.ID = t_sum2.FAKTUR_PENJUALAN_ID', 'left');





    $this->db->join("(select \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"FAKTUR_PENJUALAN_ID\",sum(\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"SUB_TOTAL\")\"SUM_TOTAL_TAGIHAN\" from \"T_T_T_PENJUALAN_JASA_RINCIAN\"LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\" ON \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"ID\"=\"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"PENJUALAN_RINCIAN_ID\" LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN\" ON \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"ID\" = \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"FAKTUR_PENJUALAN_RINCIAN_ID\" where \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"MARK_FOR_DELETE\"=false group by \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"FAKTUR_PENJUALAN_ID\") as t_sum5", 'T_AK_FAKTUR_PENJUALAN.ID = t_sum5.FAKTUR_PENJUALAN_ID', 'left');


    $this->db->join("(select \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"FAKTUR_PENJUALAN_ID\",sum(\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"PPN_VALUE\")\"SUM_TOTAL_TAGIHAN_PPN\" from \"T_T_T_PENJUALAN_JASA_RINCIAN\"LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\" ON \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"ID\"=\"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"PENJUALAN_RINCIAN_ID\" LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN\" ON \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"ID\" = \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"FAKTUR_PENJUALAN_RINCIAN_ID\" where \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"MARK_FOR_DELETE\"=false group by \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"FAKTUR_PENJUALAN_ID\") as t_sum6", 'T_AK_FAKTUR_PENJUALAN.ID = t_sum6.FAKTUR_PENJUALAN_ID', 'left');


    $this->db->join("(select \"FAKTUR_PENJUALAN_ID\",sum(\"VALUE_DISKON\")\"SUM_VALUE_DISKON\" from \"T_AK_FAKTUR_PENJUALAN_DISKON\" where \"MARK_FOR_DELETE\"=false group by \"FAKTUR_PENJUALAN_ID\") as t_sum_7", 'T_AK_FAKTUR_PENJUALAN.ID = t_sum_7.FAKTUR_PENJUALAN_ID', 'left');


    $this->db->join("(select \"FAKTUR_PENJUALAN_ID\",sum(\"VALUE_PPH\")\"SUM_VALUE_PPH\" from \"T_AK_FAKTUR_PENJUALAN_PPH\" where \"MARK_FOR_DELETE\"=false group by \"FAKTUR_PENJUALAN_ID\") as t_sum_8", 'T_AK_FAKTUR_PENJUALAN.ID = t_sum_8.FAKTUR_PENJUALAN_ID', 'left');


    
    $date_before = date('Y-m-d',(strtotime ( '-30 day' , strtotime ( $date_faktur_penjualan) ) ));

    $this->db->where("T_AK_FAKTUR_PENJUALAN.DATE<='{$date_faktur_penjualan}' and T_AK_FAKTUR_PENJUALAN.DATE>='{$date_before}'");

    $this->db->where("T_AK_FAKTUR_PENJUALAN.COMPANY_ID={$this->session->userdata('company_id')}");
    $this->db->order_by("ID", "desc");

    $akun = $this->db->get ();
    return $akun->result ();
  }


























  public function select_by_id($id)
  {
    $this->db->select("T_AK_FAKTUR_PENJUALAN.ID");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.DATE");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.TIME");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.CREATED_BY");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.UPDATED_BY");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.KETERANGAN");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.NO_FAKTUR");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.ENABLE_EDIT");



    $this->db->select("T_AK_FAKTUR_PENJUALAN.NO_FAKTUR_PAJAK");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.NO_KONTRAK");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.KET_2");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.ATTENTION");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.DEPARTMENT");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.TELP_NO");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.PO_NO");
    $this->db->select("T_AK_FAKTUR_PENJUALAN.DN_NO");







    $this->db->select("T_M_D_PELANGGAN.ID as PELANGGAN_ID");
    $this->db->select("T_M_D_PELANGGAN.PELANGGAN");

    $this->db->select("T_M_D_PELANGGAN.ALAMAT");
    $this->db->select("T_M_D_PELANGGAN.NPWP");
    $this->db->select("T_M_D_PELANGGAN.NIK");
    $this->db->select("T_M_D_PELANGGAN.NO_TELP");




    $this->db->select("T_AK_FAKTUR_PENJUALAN.PAYMENT_T");


    $this->db->select("SUM_TOTAL_PENJUALAN");


    $this->db->select("SUM_PPN_VALUE");

    
    $this->db->select("SUM_TOTAL_TAGIHAN");
    $this->db->select("SUM_TOTAL_TAGIHAN_PPN");
    $this->db->select("SUM_VALUE_DISKON");
    $this->db->select("SUM_VALUE_PPH");


    $this->db->from('T_AK_FAKTUR_PENJUALAN');

    $this->db->join('T_M_D_PELANGGAN', 'T_M_D_PELANGGAN.ID = T_AK_FAKTUR_PENJUALAN.PELANGGAN_ID', 'left');

    //$this->db->join('T_AK_TERIMA_PELANGGAN_NO_FAKTUR', 'T_AK_FAKTUR_PENJUALAN.ID = T_AK_TERIMA_PELANGGAN_NO_FAKTUR.FAKTUR_PENJUALAN_ID', 'left');

    $this->db->join("(select \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"FAKTUR_PENJUALAN_ID\",sum(\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"SUB_TOTAL\")\"SUM_TOTAL_PENJUALAN\" from \"T_T_T_PENJUALAN_JASA_RINCIAN\"LEFT OUTER JOIN \"T_T_T_PENJUALAN_JASA\" ON \"T_T_T_PENJUALAN_JASA\".\"ID\"=\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"PENJUALAN_JASA_ID\" LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN\" ON \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"PENJUALAN_ID\" = \"T_T_T_PENJUALAN_JASA\".\"ID\" where \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"MARK_FOR_DELETE\"=false group by \"FAKTUR_PENJUALAN_ID\") as t_sum", 'T_AK_FAKTUR_PENJUALAN.ID = t_sum.FAKTUR_PENJUALAN_ID', 'left');


    $this->db->join("(select \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"FAKTUR_PENJUALAN_ID\",sum(\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"PPN_VALUE\")\"SUM_PPN_VALUE\" from \"T_T_T_PENJUALAN_JASA_RINCIAN\"LEFT OUTER JOIN \"T_T_T_PENJUALAN_JASA\" ON \"T_T_T_PENJUALAN_JASA\".\"ID\"=\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"PENJUALAN_JASA_ID\" LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN\" ON \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"PENJUALAN_ID\" = \"T_T_T_PENJUALAN_JASA\".\"ID\" where \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"MARK_FOR_DELETE\"=false group by \"FAKTUR_PENJUALAN_ID\") as t_sum2", 'T_AK_FAKTUR_PENJUALAN.ID = t_sum2.FAKTUR_PENJUALAN_ID', 'left');



    
    $this->db->join("(select \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"FAKTUR_PENJUALAN_ID\",sum(\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"SUB_TOTAL\")\"SUM_TOTAL_TAGIHAN\" from \"T_T_T_PENJUALAN_JASA_RINCIAN\"LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\" ON \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"ID\"=\"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"PENJUALAN_RINCIAN_ID\" LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN\" ON \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"ID\" = \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"FAKTUR_PENJUALAN_RINCIAN_ID\" where \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"MARK_FOR_DELETE\"=false group by \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"FAKTUR_PENJUALAN_ID\") as t_sum5", 'T_AK_FAKTUR_PENJUALAN.ID = t_sum5.FAKTUR_PENJUALAN_ID', 'left');


    $this->db->join("(select \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"FAKTUR_PENJUALAN_ID\",sum(\"T_T_T_PENJUALAN_JASA_RINCIAN\".\"PPN_VALUE\")\"SUM_TOTAL_TAGIHAN_PPN\" from \"T_T_T_PENJUALAN_JASA_RINCIAN\"LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\" ON \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"ID\"=\"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"PENJUALAN_RINCIAN_ID\" LEFT OUTER JOIN \"T_AK_FAKTUR_PENJUALAN_RINCIAN\" ON \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"ID\" = \"T_AK_FAKTUR_PENJUALAN_RINCIAN2\".\"FAKTUR_PENJUALAN_RINCIAN_ID\" where \"T_T_T_PENJUALAN_JASA_RINCIAN\".\"MARK_FOR_DELETE\"=false group by \"T_AK_FAKTUR_PENJUALAN_RINCIAN\".\"FAKTUR_PENJUALAN_ID\") as t_sum6", 'T_AK_FAKTUR_PENJUALAN.ID = t_sum6.FAKTUR_PENJUALAN_ID', 'left');


    $this->db->join("(select \"FAKTUR_PENJUALAN_ID\",sum(\"VALUE_DISKON\")\"SUM_VALUE_DISKON\" from \"T_AK_FAKTUR_PENJUALAN_DISKON\" where \"MARK_FOR_DELETE\"=false group by \"FAKTUR_PENJUALAN_ID\") as t_sum_7", 'T_AK_FAKTUR_PENJUALAN.ID = t_sum_7.FAKTUR_PENJUALAN_ID', 'left');


    $this->db->join("(select \"FAKTUR_PENJUALAN_ID\",sum(\"VALUE_PPH\")\"SUM_VALUE_PPH\" from \"T_AK_FAKTUR_PENJUALAN_PPH\" where \"MARK_FOR_DELETE\"=false group by \"FAKTUR_PENJUALAN_ID\") as t_sum_8", 'T_AK_FAKTUR_PENJUALAN.ID = t_sum_8.FAKTUR_PENJUALAN_ID', 'left');
    
    $this->db->where('T_AK_FAKTUR_PENJUALAN.ID',$id);
    $this->db->order_by("ID", "desc");

    $akun = $this->db->get ();
    return $akun->result ();
  }












  public function delete($id)
  {
    $this->db->where('ID',$id);
    $this->db->delete('T_AK_FAKTUR_PENJUALAN');
  }

  function tambah($data)
  {
        $this->db->insert('T_AK_FAKTUR_PENJUALAN', $data);
        return TRUE;
  }

}


