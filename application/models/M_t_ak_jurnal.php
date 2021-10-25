<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_t_ak_jurnal extends CI_Model {
    



public function update($data, $id)
{
  $this->db->where('ID', $id);
  return $this->db->update('T_AK_JURNAL', $data);
}


public function select_no_voucer()
{
    $this->db->limit(1);
    $this->db->select("NO_VOUCER");
    $this->db->from('T_AK_JURNAL');
    $this->db->order_by("ID", "desc");

    $akun = $this->db->get ();
    return $akun->result ();
}




public function select_used_jurnal($type_id,$from_date,$to_date)
{

    $this->db->select("AK_M_COA.ID");
    $this->db->select("AK_M_COA.NO_AKUN_1");
    $this->db->select("AK_M_COA.NO_AKUN_2");
    $this->db->select("AK_M_COA.NO_AKUN_3");
    $this->db->select("AK_M_COA.DB_K_ID");
    $this->db->select("AK_M_COA.TYPE_ID");
    $this->db->select("AK_M_COA.NAMA_AKUN");

    $this->db->select("T_AK_JURNAL.NO_VOUCER");
    $this->db->select("T_AK_JURNAL.DEBIT");
    $this->db->select("T_AK_JURNAL.KREDIT");
    $this->db->select("T_AK_JURNAL.COMPANY_ID");

    $this->db->from('AK_M_COA');


    $this->db->join('T_AK_JURNAL', 'AK_M_COA.ID = T_AK_JURNAL.COA_ID', 'left');
    


    
    



    $this->db->where("(T_AK_JURNAL.DEBIT>0 or T_AK_JURNAL.KREDIT>0) and AK_M_COA.TYPE_ID={$type_id} and AK_M_COA.FAMILY_ID=3 and T_AK_JURNAL.DATE>='{$from_date}' and T_AK_JURNAL.DATE<='{$to_date}'");
    $this->db->where("AK_M_COA.CASH_FLOW=true");

    $this->db->where("(T_AK_JURNAL.NO_VOUCER like 'JBB%' or T_AK_JURNAL.NO_VOUCER like 'JKP%' or T_AK_JURNAL.NO_VOUCER like 'KBN%' )");

    
    $this->db->order_by("NAMA_AKUN", "desc");

    $akun = $this->db->get ();
    return $akun->result ();
}


public function select_sum_kredit_detail($coa_id)
{
    $this->db->select_sum('KREDIT');
    $this->db->from('T_AK_JURNAL');

    $this->db->where("COA_ID='{$coa_id}'");

    $akun = $this->db->get ();
    return $akun->result ();
}

public function select_sum_debit_detail($coa_id)
{
    $this->db->select_sum('DEBIT');
    $this->db->from('T_AK_JURNAL');

    $this->db->where("COA_ID='{$coa_id}'");

    $akun = $this->db->get ();
    return $akun->result ();
}

public function select_created_id($created_id)
  {
    $this->db->select("T_AK_JURNAL.ID");
    $this->db->select("AK_M_COA.NO_AKUN_1");
    $this->db->select("AK_M_COA.NO_AKUN_2");
    $this->db->select("AK_M_COA.NO_AKUN_3");
    $this->db->select("AK_M_COA.NAMA_AKUN");
    $this->db->select("AK_M_COA.FAMILY_ID");
    $this->db->select("T_AK_JURNAL.COA_ID");
    $this->db->select("T_AK_JURNAL.DEBIT");
    $this->db->select("T_AK_JURNAL.KREDIT");
    $this->db->select("T_AK_JURNAL.CATATAN");
    $this->db->select("T_AK_JURNAL.DEPARTEMEN");
    $this->db->select("T_AK_JURNAL.NO_VOUCER");
    $this->db->select("T_AK_JURNAL.DATE");
    $this->db->select("T_AK_JURNAL.TIME");
    $this->db->select("T_AK_JURNAL.CREATED_BY");
    $this->db->select("T_AK_JURNAL.UPDATED_BY");
    $this->db->select("T_AK_JURNAL.CREATED_ID");
    $this->db->select("T_AK_JURNAL.CHECKED_ID");
    $this->db->select("T_AK_JURNAL.SPECIAL_ID");
    $this->db->select("T_AK_JURNAL.COMPANY_ID");


    $this->db->select("T_AK_JURNAL.NO_POLISI_ID");
    $this->db->select("T_AK_JURNAL.SUPIR_ID");
    $this->db->select("T_AK_JURNAL.PELANGGAN_ID");
    $this->db->select("T_AK_JURNAL.FROM_NAMA_KOTA_ID");
    $this->db->select("T_AK_JURNAL.TO_NAMA_KOTA_ID");
    $this->db->select("T_AK_JURNAL.GANDENGAN_ID");

    $this->db->select("T_AK_JURNAL.NO_DO_PENDAPATAN");
    $this->db->select("T_AK_JURNAL.DATE_DO");
    $this->db->select("T_AK_JURNAL.QTY_JURNAL");
    $this->db->select("T_AK_JURNAL.HARGA_JURNAL");
    $this->db->select("T_AK_JURNAL.DATE_MUAT");
    $this->db->select("T_AK_JURNAL.LOKASI_ID");
    $this->db->select("T_AK_JURNAL.PAYMENT_METHOD_ID");
    $this->db->select("T_AK_JURNAL.DATE_BONGKAR");




    $this->db->select('T_M_D_NO_POLISI.NO_POLISI');
    $this->db->select('T_M_D_NO_POLISI.NO_UNIT');
    $this->db->select('T_M_D_SUPIR.SUPIR');
    $this->db->select("T_AK_JURNAL.NO_SPB_PENDAPATAN");
    $this->db->select("T_AK_JURNAL.NO_INVOICE_PENDAPATAN");
    $this->db->select("T_M_D_PELANGGAN.PELANGGAN");
    $this->db->select("T_M_D_FROM_NAMA_KOTA.FROM_NAMA_KOTA");
    $this->db->select("T_M_D_TO_NAMA_KOTA.TO_NAMA_KOTA");
    $this->db->select("T_M_D_GANDENGAN.GANDENGAN");



    $this->db->select("T_M_D_LOKASI.LOKASI");
    $this->db->select("T_M_D_PAYMENT_METHOD.PAYMENT_METHOD");


    $this->db->from('T_AK_JURNAL');
    $this->db->join('AK_M_COA', 'AK_M_COA.ID = T_AK_JURNAL.COA_ID', 'left');
    $this->db->join('T_M_D_NO_POLISI', 'T_M_D_NO_POLISI.ID = T_AK_JURNAL.NO_POLISI_ID', 'left');
    $this->db->join('T_M_D_SUPIR', 'T_M_D_SUPIR.ID = T_AK_JURNAL.SUPIR_ID', 'left');
    $this->db->join('T_M_D_PELANGGAN', 'T_M_D_PELANGGAN.ID = T_AK_JURNAL.PELANGGAN_ID', 'left');
    $this->db->join('T_M_D_FROM_NAMA_KOTA', 'T_M_D_FROM_NAMA_KOTA.ID = T_AK_JURNAL.FROM_NAMA_KOTA_ID', 'left');
    $this->db->join('T_M_D_TO_NAMA_KOTA', 'T_M_D_TO_NAMA_KOTA.ID = T_AK_JURNAL.TO_NAMA_KOTA_ID', 'left');
    $this->db->join('T_M_D_GANDENGAN', 'T_M_D_GANDENGAN.ID = T_AK_JURNAL.GANDENGAN_ID', 'left');

    $this->db->join('T_M_D_LOKASI', 'T_M_D_LOKASI.ID = T_AK_JURNAL.LOKASI_ID', 'left');
    $this->db->join('T_M_D_PAYMENT_METHOD', 'T_M_D_PAYMENT_METHOD.ID = T_AK_JURNAL.PAYMENT_METHOD_ID', 'left');



    $this->db->where("T_AK_JURNAL.CREATED_ID='{$created_id}'");


    $this->db->order_by("T_AK_JURNAL.ID", "asc");

    $akun = $this->db->get ();
    return $akun->result ();
  }



  public function select($date_from_select_jurnal,$date_to_select_jurnal)
  {
    $level_user_id = $this->session->userdata('level_user_id');
    $username = $this->session->userdata('username');

    $this->db->select("T_AK_JURNAL.ID");
    $this->db->select("AK_M_COA.NO_AKUN_1");
    $this->db->select("AK_M_COA.NO_AKUN_2");
    $this->db->select("AK_M_COA.NO_AKUN_3");
    $this->db->select("AK_M_COA.NAMA_AKUN");
    $this->db->select("AK_M_COA.FAMILY_ID");
    $this->db->select("AK_M_COA.DB_K_ID");
    $this->db->select("T_AK_JURNAL.COA_ID");
    $this->db->select("T_AK_JURNAL.DEBIT");
    $this->db->select("T_AK_JURNAL.KREDIT");
    $this->db->select("T_AK_JURNAL.CATATAN");
    $this->db->select("T_AK_JURNAL.DEPARTEMEN");
    $this->db->select("T_AK_JURNAL.NO_VOUCER");
    $this->db->select("T_AK_JURNAL.DATE");
    $this->db->select("T_AK_JURNAL.TIME");
    $this->db->select("T_AK_JURNAL.CREATED_BY");
    $this->db->select("T_AK_JURNAL.UPDATED_BY");
    $this->db->select("T_AK_JURNAL.CREATED_ID");

    $this->db->select("T_AK_JURNAL.CHECKED_ID");
    $this->db->select("T_AK_JURNAL.SPECIAL_ID");
    $this->db->select("T_AK_JURNAL.COMPANY_ID");




    $this->db->select("T_AK_JURNAL.NO_POLISI_ID");
    $this->db->select("T_AK_JURNAL.SUPIR_ID");
    $this->db->select("T_AK_JURNAL.PELANGGAN_ID");
    $this->db->select("T_AK_JURNAL.FROM_NAMA_KOTA_ID");
    $this->db->select("T_AK_JURNAL.TO_NAMA_KOTA_ID");
    $this->db->select("T_AK_JURNAL.GANDENGAN_ID");


    $this->db->select('T_M_D_NO_POLISI.NO_POLISI');
    $this->db->select('T_M_D_NO_POLISI.NO_UNIT');
    $this->db->select('T_M_D_SUPIR.SUPIR');
    $this->db->select("T_AK_JURNAL.NO_SPB_PENDAPATAN");
    $this->db->select("T_AK_JURNAL.NO_INVOICE_PENDAPATAN");
    $this->db->select("T_M_D_PELANGGAN.PELANGGAN");
    $this->db->select("T_M_D_FROM_NAMA_KOTA.FROM_NAMA_KOTA");
    $this->db->select("T_M_D_TO_NAMA_KOTA.TO_NAMA_KOTA");
    $this->db->select("T_M_D_GANDENGAN.GANDENGAN");


    $this->db->select("T_AK_JURNAL.NO_DO_PENDAPATAN");
    $this->db->select("T_AK_JURNAL.DATE_DO");
    $this->db->select("T_AK_JURNAL.QTY_JURNAL");
    $this->db->select("T_AK_JURNAL.HARGA_JURNAL");
    $this->db->select("T_AK_JURNAL.DATE_MUAT");
    $this->db->select("T_AK_JURNAL.LOKASI_ID");
    $this->db->select("T_AK_JURNAL.PAYMENT_METHOD_ID");
    $this->db->select("T_AK_JURNAL.DATE_BONGKAR");



    $this->db->from('T_AK_JURNAL');
    $this->db->join('AK_M_COA', 'AK_M_COA.ID = T_AK_JURNAL.COA_ID', 'left');

    $this->db->join('T_M_D_NO_POLISI', 'T_M_D_NO_POLISI.ID = T_AK_JURNAL.NO_POLISI_ID', 'left');
    $this->db->join('T_M_D_SUPIR', 'T_M_D_SUPIR.ID = T_AK_JURNAL.SUPIR_ID', 'left');
    $this->db->join('T_M_D_PELANGGAN', 'T_M_D_PELANGGAN.ID = T_AK_JURNAL.PELANGGAN_ID', 'left');
    $this->db->join('T_M_D_FROM_NAMA_KOTA', 'T_M_D_FROM_NAMA_KOTA.ID = T_AK_JURNAL.FROM_NAMA_KOTA_ID', 'left');
    $this->db->join('T_M_D_TO_NAMA_KOTA', 'T_M_D_TO_NAMA_KOTA.ID = T_AK_JURNAL.TO_NAMA_KOTA_ID', 'left');
    $this->db->join('T_M_D_GANDENGAN', 'T_M_D_GANDENGAN.ID = T_AK_JURNAL.GANDENGAN_ID', 'left');


    $this->db->join('T_M_D_LOKASI', 'T_M_D_LOKASI.ID = T_AK_JURNAL.LOKASI_ID', 'left');
    $this->db->join('T_M_D_PAYMENT_METHOD', 'T_M_D_PAYMENT_METHOD.ID = T_AK_JURNAL.PAYMENT_METHOD_ID', 'left');



    $this->db->where("T_AK_JURNAL.DATE>='{$date_from_select_jurnal}'");
    $this->db->where("T_AK_JURNAL.DATE<='{$date_to_select_jurnal}'");

    if($level_user_id==4 or $level_user_id==9)
    {
        $this->db->where("T_AK_JURNAL.CREATED_BY='{$username}'");
    }

    if($level_user_id>=8)
    {
        $this->db->where("T_AK_JURNAL.COMPANY_ID='{$this->session->userdata('company_id')}'");
    }


    
    $this->db->order_by("T_AK_JURNAL.DATE,T_AK_JURNAL.TIME", "asc");

    $akun = $this->db->get ();
    return $akun->result ();
  }










  public function select_by_sub_akun($date_from_select_jurnal,$date_to_select_jurnal,$sub_id)
  {
    $level_user_id = $this->session->userdata('level_user_id');
    $username = $this->session->userdata('username');

    $this->db->select("T_AK_JURNAL.ID");
    $this->db->select("AK_M_COA.NO_AKUN_1");
    $this->db->select("AK_M_COA.NO_AKUN_2");
    $this->db->select("AK_M_COA.NO_AKUN_3");
    $this->db->select("AK_M_COA.NAMA_AKUN");
    $this->db->select("AK_M_COA.FAMILY_ID");
    $this->db->select("AK_M_COA.DB_K_ID");
    $this->db->select("T_AK_JURNAL.COA_ID");
    $this->db->select("T_AK_JURNAL.DEBIT");
    $this->db->select("T_AK_JURNAL.KREDIT");
    $this->db->select("T_AK_JURNAL.CATATAN");
    $this->db->select("T_AK_JURNAL.DEPARTEMEN");
    $this->db->select("T_AK_JURNAL.NO_VOUCER");
    $this->db->select("T_AK_JURNAL.DATE");
    $this->db->select("T_AK_JURNAL.TIME");
    $this->db->select("T_AK_JURNAL.CREATED_BY");
    $this->db->select("T_AK_JURNAL.UPDATED_BY");
    $this->db->select("T_AK_JURNAL.CREATED_ID");

    $this->db->select("T_AK_JURNAL.CHECKED_ID");
    $this->db->select("T_AK_JURNAL.SPECIAL_ID");
    $this->db->select("T_AK_JURNAL.COMPANY_ID");


    $this->db->select("T_AK_JURNAL.NO_POLISI_ID");
    $this->db->select("T_AK_JURNAL.SUPIR_ID");
    $this->db->select("T_AK_JURNAL.PELANGGAN_ID");
    $this->db->select("T_AK_JURNAL.FROM_NAMA_KOTA_ID");
    $this->db->select("T_AK_JURNAL.TO_NAMA_KOTA_ID");
    $this->db->select("T_AK_JURNAL.GANDENGAN_ID");


    $this->db->select("T_AK_JURNAL.NO_DO_PENDAPATAN");
    $this->db->select("T_AK_JURNAL.DATE_DO");
    $this->db->select("T_AK_JURNAL.QTY_JURNAL");
    $this->db->select("T_AK_JURNAL.HARGA_JURNAL");
    $this->db->select("T_AK_JURNAL.DATE_MUAT");
    $this->db->select("T_AK_JURNAL.LOKASI_ID");
    $this->db->select("T_AK_JURNAL.PAYMENT_METHOD_ID");
    $this->db->select("T_AK_JURNAL.DATE_BONGKAR");


    $this->db->select('T_M_D_NO_POLISI.NO_POLISI');
    $this->db->select('T_M_D_NO_POLISI.NO_UNIT');
    $this->db->select('T_M_D_SUPIR.SUPIR');
    $this->db->select("T_AK_JURNAL.NO_SPB_PENDAPATAN");
    $this->db->select("T_AK_JURNAL.NO_INVOICE_PENDAPATAN");
    $this->db->select("T_M_D_PELANGGAN.PELANGGAN");
    $this->db->select("T_M_D_FROM_NAMA_KOTA.FROM_NAMA_KOTA");
    $this->db->select("T_M_D_TO_NAMA_KOTA.TO_NAMA_KOTA");
    $this->db->select("T_M_D_GANDENGAN.GANDENGAN");


    $this->db->from('T_AK_JURNAL');
    $this->db->join('AK_M_COA', 'AK_M_COA.ID = T_AK_JURNAL.COA_ID', 'left');

    $this->db->join('T_M_D_NO_POLISI', 'T_M_D_NO_POLISI.ID = T_AK_JURNAL.NO_POLISI_ID', 'left');
    $this->db->join('T_M_D_SUPIR', 'T_M_D_SUPIR.ID = T_AK_JURNAL.SUPIR_ID', 'left');
    $this->db->join('T_M_D_PELANGGAN', 'T_M_D_PELANGGAN.ID = T_AK_JURNAL.PELANGGAN_ID', 'left');
    $this->db->join('T_M_D_FROM_NAMA_KOTA', 'T_M_D_FROM_NAMA_KOTA.ID = T_AK_JURNAL.FROM_NAMA_KOTA_ID', 'left');
    $this->db->join('T_M_D_TO_NAMA_KOTA', 'T_M_D_TO_NAMA_KOTA.ID = T_AK_JURNAL.TO_NAMA_KOTA_ID', 'left');
    $this->db->join('T_M_D_GANDENGAN', 'T_M_D_GANDENGAN.ID = T_AK_JURNAL.GANDENGAN_ID', 'left');


    $this->db->join('T_M_D_LOKASI', 'T_M_D_LOKASI.ID = T_AK_JURNAL.LOKASI_ID', 'left');
    $this->db->join('T_M_D_PAYMENT_METHOD', 'T_M_D_PAYMENT_METHOD.ID = T_AK_JURNAL.PAYMENT_METHOD_ID', 'left');
    

    $this->db->where("T_AK_JURNAL.DATE>='{$date_from_select_jurnal}'");
    $this->db->where("T_AK_JURNAL.DATE<='{$date_to_select_jurnal}'");

    $this->db->where("AK_M_COA.SUB_ID='{$sub_id}'");

    if($level_user_id==4 or $level_user_id==9)
    {
        $this->db->where("T_AK_JURNAL.CREATED_BY='{$username}'");
    }

    if($level_user_id>=8)
    {
        $this->db->where("T_AK_JURNAL.COMPANY_ID='{$this->session->userdata('company_id')}'");
    }


    
    $this->db->order_by("T_AK_JURNAL.DATE,T_AK_JURNAL.TIME", "asc");

    $akun = $this->db->get ();
    return $akun->result ();
  }






  public function delete($created_id)
  {
    $this->db->where('CREATED_ID',$created_id);
    $this->db->delete('T_AK_JURNAL');
  }

  public function delete_no_voucer($no_voucer)
  {
    $this->db->where('NO_VOUCER',$no_voucer);
    $this->db->delete('T_AK_JURNAL');
  }


  public function delete_created_by()
  {
    $this->db->where('CREATED_BY',$this->session->userdata('username'));
    $this->db->delete('T_AK_JURNAL_EDIT');
  }
  public function delete_created_id($created_id)
  {
    $this->db->where('CREATED_ID',$created_id);
    $this->db->delete('T_AK_JURNAL');
  }

    public function update_tutup_buku($data, $date_from_select_jurnal,$date_to_select_jurnal)
    {
        $this->db->where("DATE>='{$date_from_select_jurnal}'");
        $this->db->where("DATE<='{$date_to_select_jurnal}'");
        return $this->db->update('T_AK_JURNAL', $data);
    }

  

  function tambah($data)
  {
        $this->db->insert('T_AK_JURNAL', $data);
        return TRUE;
  }

}


