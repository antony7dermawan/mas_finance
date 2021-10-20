<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_t_ak_jurnal_edit extends CI_Model {
    
    

public function update($data, $id)
{
  $this->db->where('ID', $id);
  return $this->db->update('T_AK_JURNAL_EDIT', $data);
}


public function update_all($data)
{
  $this->db->where('CREATED_BY',$this->session->userdata('username'));
  return $this->db->update('T_AK_JURNAL_EDIT', $data);
}



public function select_last_id()
{
  $this->db->select_max("ID");
  $this->db->from('T_AK_JURNAL_EDIT');
  $this->db->order_by("ID", "DESC");
  $akun = $this->db->get ();
  return $akun->result ();
}
public function select_created_id()
{
  $this->db->limit(1);
  $this->db->select("CREATED_ID");
  $this->db->select("DATE");
  $this->db->select("TIME");
  $this->db->from('T_AK_JURNAL_EDIT');
  $this->db->where('CREATED_BY',$this->session->userdata('username'));
  $akun = $this->db->get ();
  return $akun->result ();
}



  public function select()
  {
    $this->db->select("T_AK_JURNAL_EDIT.ID");
    $this->db->select("AK_M_COA.NO_AKUN_1");
    $this->db->select("AK_M_COA.NO_AKUN_2");
    $this->db->select("AK_M_COA.NO_AKUN_3");
    $this->db->select("AK_M_COA.NAMA_AKUN");
    $this->db->select("AK_M_COA.FAMILY_ID");
    $this->db->select("T_AK_JURNAL_EDIT.COA_ID");
    $this->db->select("T_AK_JURNAL_EDIT.DEBIT");
    $this->db->select("T_AK_JURNAL_EDIT.KREDIT");
    $this->db->select("T_AK_JURNAL_EDIT.CATATAN");
    $this->db->select("T_AK_JURNAL_EDIT.DEPARTEMEN");
    $this->db->select("T_AK_JURNAL_EDIT.NO_VOUCER");
    $this->db->select("T_AK_JURNAL_EDIT.DATE");
    $this->db->select("T_AK_JURNAL_EDIT.TIME");
    $this->db->select("T_AK_JURNAL_EDIT.CREATED_BY");
    $this->db->select("T_AK_JURNAL_EDIT.UPDATED_BY");
    $this->db->select("T_AK_JURNAL_EDIT.CREATED_ID");
    $this->db->select("T_AK_JURNAL_EDIT.CHECKED_ID");
    $this->db->select("T_AK_JURNAL_EDIT.SPECIAL_ID");
    $this->db->select("T_AK_JURNAL_EDIT.COMPANY_ID");


    $this->db->select("T_AK_JURNAL_EDIT.NO_POLISI_ID");
    $this->db->select("T_AK_JURNAL_EDIT.SUPIR_ID");
    $this->db->select("T_AK_JURNAL_EDIT.PELANGGAN_ID");
    $this->db->select("T_AK_JURNAL_EDIT.FROM_NAMA_KOTA_ID");
    $this->db->select("T_AK_JURNAL_EDIT.TO_NAMA_KOTA_ID");
    $this->db->select("T_AK_JURNAL_EDIT.GANDENGAN_ID");


    $this->db->select('T_M_D_NO_POLISI.NO_POLISI');
    $this->db->select('T_M_D_NO_POLISI.NO_UNIT');
    $this->db->select('T_M_D_SUPIR.SUPIR');
    $this->db->select("T_AK_JURNAL_EDIT.NO_SPB_PENDAPATAN");
    $this->db->select("T_AK_JURNAL_EDIT.NO_INVOICE_PENDAPATAN");
    $this->db->select("T_M_D_PELANGGAN.PELANGGAN");
    $this->db->select("T_M_D_FROM_NAMA_KOTA.FROM_NAMA_KOTA");
    $this->db->select("T_M_D_TO_NAMA_KOTA.TO_NAMA_KOTA");
    $this->db->select("T_M_D_GANDENGAN.GANDENGAN");

    

    $this->db->from('T_AK_JURNAL_EDIT');
    $this->db->join('AK_M_COA', 'AK_M_COA.ID = T_AK_JURNAL_EDIT.COA_ID', 'left');

    $this->db->join('T_M_D_NO_POLISI', 'T_M_D_NO_POLISI.ID = T_AK_JURNAL_EDIT.NO_POLISI_ID', 'left');
    $this->db->join('T_M_D_SUPIR', 'T_M_D_SUPIR.ID = T_AK_JURNAL_EDIT.SUPIR_ID', 'left');
    $this->db->join('T_M_D_PELANGGAN', 'T_M_D_PELANGGAN.ID = T_AK_JURNAL_EDIT.PELANGGAN_ID', 'left');
    $this->db->join('T_M_D_FROM_NAMA_KOTA', 'T_M_D_FROM_NAMA_KOTA.ID = T_AK_JURNAL_EDIT.FROM_NAMA_KOTA_ID', 'left');
    $this->db->join('T_M_D_TO_NAMA_KOTA', 'T_M_D_TO_NAMA_KOTA.ID = T_AK_JURNAL_EDIT.TO_NAMA_KOTA_ID', 'left');
    $this->db->join('T_M_D_GANDENGAN', 'T_M_D_GANDENGAN.ID = T_AK_JURNAL_EDIT.GANDENGAN_ID', 'left');


    $this->db->where("T_AK_JURNAL_EDIT.CREATED_BY='{$this->session->userdata('username')}'");
    $this->db->order_by("T_AK_JURNAL_EDIT.ID", "asc");

    $akun = $this->db->get ();
    return $akun->result ();
  }

  public function delete($id)
  {
    $this->db->where('ID',$id);
    $this->db->delete('T_AK_JURNAL_EDIT');
  }

  function tambah($data)
  {
        $this->db->insert('T_AK_JURNAL_EDIT', $data);
        return TRUE;
  }

}


