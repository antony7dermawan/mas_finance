<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_t_ak_jurnal_create extends CI_Model {
    
    

public function update($data, $id)
{
  $this->db->where('ID', $id);
  return $this->db->update('T_AK_JURNAL_CREATE', $data);
}




public function update_all($data)
{
  $this->db->where('CREATED_BY', $this->session->userdata('username'));
  return $this->db->update('T_AK_JURNAL_CREATE', $data);
}





  public function select()
  {
    $this->db->select("T_AK_JURNAL_CREATE.ID");
    $this->db->select("AK_M_COA.NO_AKUN_1");
    $this->db->select("AK_M_COA.NO_AKUN_2");
    $this->db->select("AK_M_COA.NO_AKUN_3");
    $this->db->select("AK_M_COA.NAMA_AKUN");
    $this->db->select("AK_M_COA.FAMILY_ID");
    $this->db->select("T_AK_JURNAL_CREATE.COA_ID");
    $this->db->select("T_AK_JURNAL_CREATE.DEBIT");
    $this->db->select("T_AK_JURNAL_CREATE.KREDIT");
    $this->db->select("T_AK_JURNAL_CREATE.CATATAN");
    $this->db->select("T_AK_JURNAL_CREATE.DEPARTEMEN");
    $this->db->select("T_AK_JURNAL_CREATE.NO_VOUCER");
    $this->db->select("T_AK_JURNAL_CREATE.DATE");
    $this->db->select("T_AK_JURNAL_CREATE.TIME");
    $this->db->select("T_AK_JURNAL_CREATE.CREATED_BY");
    $this->db->select("T_AK_JURNAL_CREATE.UPDATED_BY");


    $this->db->select("T_AK_JURNAL_CREATE.NO_POLISI_ID");
    $this->db->select("T_AK_JURNAL_CREATE.SUPIR_ID");
    $this->db->select("T_AK_JURNAL_CREATE.PELANGGAN_ID");
    $this->db->select("T_AK_JURNAL_CREATE.FROM_NAMA_KOTA_ID");
    $this->db->select("T_AK_JURNAL_CREATE.TO_NAMA_KOTA_ID");
    $this->db->select("T_AK_JURNAL_CREATE.GANDENGAN_ID");

    $this->db->select("T_AK_JURNAL_CREATE.NO_DO_PENDAPATAN");
    $this->db->select("T_AK_JURNAL_CREATE.DATE_DO");
    $this->db->select("T_AK_JURNAL_CREATE.QTY_JURNAL");
    $this->db->select("T_AK_JURNAL_CREATE.HARGA_JURNAL");
    $this->db->select("T_AK_JURNAL_CREATE.DATE_MUAT");
    $this->db->select("T_AK_JURNAL_CREATE.LOKASI_ID");
    $this->db->select("T_AK_JURNAL_CREATE.PAYMENT_METHOD_ID");
    $this->db->select("T_AK_JURNAL_CREATE.DATE_BONGKAR");



    $this->db->select('T_M_D_NO_POLISI.NO_POLISI');
    $this->db->select('T_M_D_NO_POLISI.NO_UNIT');
    $this->db->select('T_M_D_SUPIR.SUPIR');
    $this->db->select("T_AK_JURNAL_CREATE.NO_SPB_PENDAPATAN");
    $this->db->select("T_AK_JURNAL_CREATE.NO_INVOICE_PENDAPATAN");
    $this->db->select("T_M_D_PELANGGAN.PELANGGAN");
    $this->db->select("T_M_D_FROM_NAMA_KOTA.FROM_NAMA_KOTA");
    $this->db->select("T_M_D_TO_NAMA_KOTA.TO_NAMA_KOTA");
    $this->db->select("T_M_D_GANDENGAN.GANDENGAN");

    $this->db->select("T_M_D_LOKASI.LOKASI");
    $this->db->select("T_M_D_PAYMENT_METHOD.PAYMENT_METHOD");

    $this->db->from('T_AK_JURNAL_CREATE');
    $this->db->join('AK_M_COA', 'AK_M_COA.ID = T_AK_JURNAL_CREATE.COA_ID', 'left');
    $this->db->join('T_M_D_NO_POLISI', 'T_M_D_NO_POLISI.ID = T_AK_JURNAL_CREATE.NO_POLISI_ID', 'left');
    $this->db->join('T_M_D_SUPIR', 'T_M_D_SUPIR.ID = T_AK_JURNAL_CREATE.SUPIR_ID', 'left');
    $this->db->join('T_M_D_PELANGGAN', 'T_M_D_PELANGGAN.ID = T_AK_JURNAL_CREATE.PELANGGAN_ID', 'left');
    $this->db->join('T_M_D_FROM_NAMA_KOTA', 'T_M_D_FROM_NAMA_KOTA.ID = T_AK_JURNAL_CREATE.FROM_NAMA_KOTA_ID', 'left');
    $this->db->join('T_M_D_TO_NAMA_KOTA', 'T_M_D_TO_NAMA_KOTA.ID = T_AK_JURNAL_CREATE.TO_NAMA_KOTA_ID', 'left');
    $this->db->join('T_M_D_GANDENGAN', 'T_M_D_GANDENGAN.ID = T_AK_JURNAL_CREATE.GANDENGAN_ID', 'left');

    $this->db->join('T_M_D_LOKASI', 'T_M_D_LOKASI.ID = T_AK_JURNAL_CREATE.LOKASI_ID', 'left');
    $this->db->join('T_M_D_PAYMENT_METHOD', 'T_M_D_PAYMENT_METHOD.ID = T_AK_JURNAL_CREATE.PAYMENT_METHOD_ID', 'left');


    $this->db->where("T_AK_JURNAL_CREATE.CREATED_BY='{$this->session->userdata('username')}'");
    $this->db->order_by("T_AK_JURNAL_CREATE.ID", "asc");

    $akun = $this->db->get ();
    return $akun->result ();
  }

  public function delete($id)
  {
    $this->db->where('ID',$id);
    $this->db->delete('T_AK_JURNAL_CREATE');
  }

  function tambah($data)
  {
        $this->db->insert('T_AK_JURNAL_CREATE', $data);
        return TRUE;
  }

}


