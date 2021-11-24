<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_t_t_t_penjualan_jasa_rincian_3 extends CI_Model {
    
    
public function update($data, $id)
{
    $this->db->where('ID', $id);
    return $this->db->update('T_T_T_PENJUALAN_JASA_RINCIAN', $data);
}

  public function select($penjualan_jasa_id)
  {
    


    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.ID");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.PENJUALAN_JASA_ID");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.NO_SPB");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.DATE_MUAT");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.DATE_BONGKAR");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.FROM_NAMA_KOTA_ID");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.TO_NAMA_KOTA_ID");


    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.NO_POLISI_ID");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.SUPIR_ID");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.BRUTO_KEBUN");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.TARA_KEBUN");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.VALUE_KEBUN");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.BRUTO_PABRIK");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.TARA_PABRIK");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.VALUE_PABRIK");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.VALUE_SUSUT");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.PERCENTAGE_SUSUT");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.TOLERANSI");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.TOLERANSI_VALUE");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.CLAIM_SUSUT");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.HARGA_KEBUN");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.HARGA_PABRIK");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.SUB_TOTAL");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.PPN_PERCENTAGE");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.PPN_VALUE");


    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.CREATED_BY");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.UPDATED_BY");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.MARK_FOR_DELETE");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.KET");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.JARAK_KM");

    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.PC");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.HARGA_PC");



    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.PETAK_ID");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.NO_PETAK");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.BRUTO_KAYU");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.TARA_KAYU");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.TONASE");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.HARGA_PC");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.PINALTY_1");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.PINALTY_2");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.NETO_1");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.NETO_2");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.HARGA_KAYU");

    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.ENABLE_EDIT");



    $this->db->select('T_M_D_NO_POLISI.NO_POLISI');
    $this->db->select('T_M_D_NO_POLISI.NO_UNIT');
    $this->db->select('T_M_D_SUPIR.SUPIR');
    $this->db->select("T_M_D_FROM_NAMA_KOTA.FROM_NAMA_KOTA");
    $this->db->select("T_M_D_TO_NAMA_KOTA.TO_NAMA_KOTA");
    $this->db->select('T_M_D_PETAK.PETAK');


   
    
    $this->db->select("SUM_VALUE");


    $this->db->from('T_T_T_PENJUALAN_JASA_RINCIAN');


    $this->db->join('T_M_D_NO_POLISI', 'T_M_D_NO_POLISI.ID = T_T_T_PENJUALAN_JASA_RINCIAN.NO_POLISI_ID', 'left');
    $this->db->join('T_M_D_SUPIR', 'T_M_D_SUPIR.ID = T_T_T_PENJUALAN_JASA_RINCIAN.SUPIR_ID', 'left');
    $this->db->join('T_M_D_PETAK', 'T_M_D_PETAK.ID = T_T_T_PENJUALAN_JASA_RINCIAN.PETAK_ID', 'left');
    $this->db->join('T_M_D_FROM_NAMA_KOTA', 'T_M_D_FROM_NAMA_KOTA.ID = T_T_T_PENJUALAN_JASA_RINCIAN.FROM_NAMA_KOTA_ID', 'left');
    $this->db->join('T_M_D_TO_NAMA_KOTA', 'T_M_D_TO_NAMA_KOTA.ID = T_T_T_PENJUALAN_JASA_RINCIAN.TO_NAMA_KOTA_ID', 'left');



    $this->db->join("(select \"PENJUALAN_JASA_RINCIAN_ID\",sum(\"VALUE\")\"SUM_VALUE\" from \"T_T_T_PENGELUARAN_RINCIAN\" where \"MARK_FOR_DELETE\"=false group by \"PENJUALAN_JASA_RINCIAN_ID\") as t_sum_1", 'T_T_T_PENJUALAN_JASA_RINCIAN.ID = t_sum_1.PENJUALAN_JASA_RINCIAN_ID', 'left');




    if($this->session->userdata('t_t_t_penjualan_jasa_delete_logic')==0)
    {
      $this->db->where('T_T_T_PENJUALAN_JASA_RINCIAN.MARK_FOR_DELETE',FALSE);
    }

    
    $this->db->where('T_T_T_PENJUALAN_JASA_RINCIAN.PENJUALAN_JASA_ID',$penjualan_jasa_id);
    $this->db->order_by("ID", "desc");

    $akun = $this->db->get ();
    return $akun->result ();
  }




public function read_nomor($no_spb)
{
    $this->db->select("NO_SPB");
    $this->db->from('T_T_T_PENJUALAN_JASA_RINCIAN');
    $this->db->where('NO_SPB',$no_spb);
    $akun = $this->db->get ();
    return $akun->result ();
}











  public function select_fp($penjualan_jasa_id)
  {
    


    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.ID");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.PENJUALAN_JASA_ID");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.NO_SPB");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.DATE_MUAT");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.DATE_BONGKAR");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.FROM_NAMA_KOTA_ID");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.TO_NAMA_KOTA_ID");


    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.NO_POLISI_ID");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.SUPIR_ID");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.BRUTO_KEBUN");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.TARA_KEBUN");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.VALUE_KEBUN");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.BRUTO_PABRIK");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.TARA_PABRIK");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.VALUE_PABRIK");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.VALUE_SUSUT");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.PERCENTAGE_SUSUT");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.TOLERANSI");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.TOLERANSI_VALUE");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.CLAIM_SUSUT");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.HARGA_KEBUN");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.HARGA_PABRIK");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.SUB_TOTAL");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.PPN_PERCENTAGE");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.PPN_VALUE");


    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.CREATED_BY");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.UPDATED_BY");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.MARK_FOR_DELETE");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.KET");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.JARAK_KM");

    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.PC");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.HARGA_PC");



    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.PETAK_ID");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.NO_PETAK");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.BRUTO_KAYU");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.TARA_KAYU");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.TONASE");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.HARGA_PC");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.PINALTY_1");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.PINALTY_2");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.NETO_1");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.NETO_2");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.HARGA_KAYU");

    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.ENABLE_EDIT");



    $this->db->select('T_M_D_NO_POLISI.NO_POLISI');
    $this->db->select('T_M_D_NO_POLISI.NO_UNIT');
    $this->db->select('T_M_D_SUPIR.SUPIR');
    $this->db->select("T_M_D_FROM_NAMA_KOTA.FROM_NAMA_KOTA");
    $this->db->select("T_M_D_TO_NAMA_KOTA.TO_NAMA_KOTA");
    $this->db->select('T_M_D_PETAK.PETAK');


   
    
    $this->db->select("SUM_VALUE");


    $this->db->from('T_T_T_PENJUALAN_JASA_RINCIAN');


    $this->db->join('T_M_D_NO_POLISI', 'T_M_D_NO_POLISI.ID = T_T_T_PENJUALAN_JASA_RINCIAN.NO_POLISI_ID', 'left');
    $this->db->join('T_M_D_SUPIR', 'T_M_D_SUPIR.ID = T_T_T_PENJUALAN_JASA_RINCIAN.SUPIR_ID', 'left');
    $this->db->join('T_M_D_PETAK', 'T_M_D_PETAK.ID = T_T_T_PENJUALAN_JASA_RINCIAN.PETAK_ID', 'left');
    $this->db->join('T_M_D_FROM_NAMA_KOTA', 'T_M_D_FROM_NAMA_KOTA.ID = T_T_T_PENJUALAN_JASA_RINCIAN.FROM_NAMA_KOTA_ID', 'left');
    $this->db->join('T_M_D_TO_NAMA_KOTA', 'T_M_D_TO_NAMA_KOTA.ID = T_T_T_PENJUALAN_JASA_RINCIAN.TO_NAMA_KOTA_ID', 'left');



    $this->db->join("(select \"PENJUALAN_JASA_RINCIAN_ID\",sum(\"VALUE\")\"SUM_VALUE\" from \"T_T_T_PENGELUARAN_RINCIAN\" where \"MARK_FOR_DELETE\"=false group by \"PENJUALAN_JASA_RINCIAN_ID\") as t_sum_1", 'T_T_T_PENJUALAN_JASA_RINCIAN.ID = t_sum_1.PENJUALAN_JASA_RINCIAN_ID', 'left');




    if($this->session->userdata('t_t_t_penjualan_jasa_delete_logic')==0)
    {
      $this->db->where('T_T_T_PENJUALAN_JASA_RINCIAN.MARK_FOR_DELETE',FALSE);
    }

    
    $this->db->where('T_T_T_PENJUALAN_JASA_RINCIAN.PENJUALAN_JASA_ID',$penjualan_jasa_id);
    $this->db->where('T_T_T_PENJUALAN_JASA_RINCIAN.ENABLE_EDIT',1);
    $this->db->order_by("ID", "desc");

    $akun = $this->db->get ();
    return $akun->result ();
  }







  public function select_by_id($id)
  {
    
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.ID");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.PENJUALAN_JASA_ID");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.NO_SPB");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.DATE_MUAT");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.DATE_BONGKAR");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.FROM_NAMA_KOTA_ID");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.TO_NAMA_KOTA_ID");


    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.NO_POLISI_ID");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.SUPIR_ID");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.BRUTO_KEBUN");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.TARA_KEBUN");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.VALUE_KEBUN");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.BRUTO_PABRIK");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.TARA_PABRIK");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.VALUE_PABRIK");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.VALUE_SUSUT");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.PERCENTAGE_SUSUT");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.TOLERANSI");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.TOLERANSI_VALUE");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.CLAIM_SUSUT");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.HARGA_KEBUN");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.HARGA_PABRIK");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.SUB_TOTAL");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.PPN_PERCENTAGE");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.PPN_VALUE");


    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.CREATED_BY");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.UPDATED_BY");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.MARK_FOR_DELETE");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.KET");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.JARAK_KM");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.PC");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.HARGA_PC");

    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.PETAK_ID");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.NO_PETAK");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.BRUTO_KAYU");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.TARA_KAYU");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.TONASE");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.HARGA_PC");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.PINALTY_1");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.PINALTY_2");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.NETO_1");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.NETO_2");
    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.HARGA_KAYU");

    $this->db->select("T_T_T_PENJUALAN_JASA_RINCIAN.ENABLE_EDIT");


    
    $this->db->select('T_M_D_NO_POLISI.NO_POLISI');
    $this->db->select('T_M_D_NO_POLISI.NO_UNIT');
    $this->db->select('T_M_D_SUPIR.SUPIR');
    $this->db->select("T_M_D_FROM_NAMA_KOTA.FROM_NAMA_KOTA");
    $this->db->select("T_M_D_TO_NAMA_KOTA.TO_NAMA_KOTA");

    $this->db->select('T_M_D_PETAK.PETAK');


   
   


    $this->db->from('T_T_T_PENJUALAN_JASA_RINCIAN');


    $this->db->join('T_M_D_NO_POLISI', 'T_M_D_NO_POLISI.ID = T_T_T_PENJUALAN_JASA_RINCIAN.NO_POLISI_ID', 'left');
    $this->db->join('T_M_D_SUPIR', 'T_M_D_SUPIR.ID = T_T_T_PENJUALAN_JASA_RINCIAN.SUPIR_ID', 'left');
    $this->db->join('T_M_D_PETAK', 'T_M_D_PETAK.ID = T_T_T_PENJUALAN_JASA_RINCIAN.PETAK_ID', 'left');
    $this->db->join('T_M_D_FROM_NAMA_KOTA', 'T_M_D_FROM_NAMA_KOTA.ID = T_T_T_PENJUALAN_JASA_RINCIAN.FROM_NAMA_KOTA_ID', 'left');
    $this->db->join('T_M_D_TO_NAMA_KOTA', 'T_M_D_TO_NAMA_KOTA.ID = T_T_T_PENJUALAN_JASA_RINCIAN.TO_NAMA_KOTA_ID', 'left');




    
    $this->db->where('T_T_T_PENJUALAN_JASA_RINCIAN.ID',$id);

    $akun = $this->db->get ();
    return $akun->result ();
  }









  public function delete($id)
  {
    $this->db->where('ID',$id);
    $this->db->delete('T_T_T_PENJUALAN_JASA_RINCIAN');
  }

  function tambah($data)
  {
        $this->db->insert('T_T_T_PENJUALAN_JASA_RINCIAN', $data);
        return TRUE;
  }

}


