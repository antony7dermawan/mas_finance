<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_t_t_t_penjualan_jasa extends CI_Model {
    
    
public function update($data, $id)
{
    $this->db->where('ID', $id);
    return $this->db->update('T_T_T_PENJUALAN_JASA', $data);
}



public function select_inv_penjualan_jasa()
{
    $this->db->limit(100000);
    $this->db->select("ID");
    $this->db->select("INV");
    $this->db->from('T_T_T_PENJUALAN_JASA');
    $this->db->where('MARK_FOR_DELETE',false);
    $this->db->order_by("ID", "desc");
    $akun = $this->db->get ();
    return $akun->result ();
}








  public function select($date_penjualan_jasa,$type_id)
  {
    $this->db->select("T_T_T_PENJUALAN_JASA.ID");
    $this->db->select("T_T_T_PENJUALAN_JASA.DATE");
    $this->db->select("T_T_T_PENJUALAN_JASA.TIME");
    $this->db->select("T_T_T_PENJUALAN_JASA.NO_DO");
  

    $this->db->select("T_T_T_PENJUALAN_JASA.PELANGGAN_ID");


    $this->db->select("T_T_T_PENJUALAN_JASA.COMPANY_ID");
    $this->db->select("T_T_T_PENJUALAN_JASA.PAYMENT_METHOD_ID");

    $this->db->select("T_T_T_PENJUALAN_JASA.CREATED_BY");
    $this->db->select("T_T_T_PENJUALAN_JASA.UPDATED_BY");
    $this->db->select("T_T_T_PENJUALAN_JASA.MARK_FOR_DELETE");

    $this->db->select("T_T_T_PENJUALAN_JASA.KET");


    $this->db->select("T_T_T_PENJUALAN_JASA.ENABLE_EDIT");


    $this->db->select("T_M_D_PAYMENT_METHOD.PAYMENT_METHOD");
    $this->db->select("T_M_D_PELANGGAN.PELANGGAN");

    $this->db->select("T_T_T_PENJUALAN_JASA.NO_FAKTUR_PAJAK");
    $this->db->select("T_T_T_PENJUALAN_JASA.TYPE_ID");
    $this->db->select("T_T_T_PENJUALAN_JASA.TARGET_PARTY");





    $this->db->select("SUM_SUB_TOTAL");

   


    $this->db->from('T_T_T_PENJUALAN_JASA');


    $this->db->join('T_M_D_PAYMENT_METHOD', 'T_M_D_PAYMENT_METHOD.ID = T_T_T_PENJUALAN_JASA.PAYMENT_METHOD_ID', 'left');
    $this->db->join('T_M_D_PELANGGAN', 'T_M_D_PELANGGAN.ID = T_T_T_PENJUALAN_JASA.PELANGGAN_ID', 'left');





    $this->db->join("(select \"PENJUALAN_JASA_ID\",sum(\"SUB_TOTAL\")\"SUM_SUB_TOTAL\" from \"T_T_T_PENJUALAN_JASA_RINCIAN\" where \"MARK_FOR_DELETE\"=false group by \"PENJUALAN_JASA_ID\") as t_sum_1", 'T_T_T_PENJUALAN_JASA.ID = t_sum_1.PENJUALAN_JASA_ID', 'left');

    

    $date_before = date('Y-m-d',(strtotime ( '-30 day' , strtotime ( $date_penjualan_jasa) ) ));

    $this->db->where("T_T_T_PENJUALAN_JASA.DATE<='{$date_penjualan_jasa}' and T_T_T_PENJUALAN_JASA.DATE>='{$date_before}'");

    $this->db->where("T_T_T_PENJUALAN_JASA.COMPANY_ID={$this->session->userdata('company_id')}");
    $this->db->where("T_T_T_PENJUALAN_JASA.TYPE_ID={$type_id}");


    $this->db->order_by("ID", "desc");

    $akun = $this->db->get ();
    return $akun->result ();
  }



  public function select_by_id($id)
  {
    $this->db->select("T_T_T_PENJUALAN_JASA.ID");
    $this->db->select("T_T_T_PENJUALAN_JASA.DATE");
    $this->db->select("T_T_T_PENJUALAN_JASA.TIME");
    $this->db->select("T_T_T_PENJUALAN_JASA.NO_DO");
  

    $this->db->select("T_T_T_PENJUALAN_JASA.PELANGGAN_ID");


    $this->db->select("T_T_T_PENJUALAN_JASA.COMPANY_ID");
    $this->db->select("T_T_T_PENJUALAN_JASA.PAYMENT_METHOD_ID");

    $this->db->select("T_T_T_PENJUALAN_JASA.CREATED_BY");
    $this->db->select("T_T_T_PENJUALAN_JASA.UPDATED_BY");
    $this->db->select("T_T_T_PENJUALAN_JASA.MARK_FOR_DELETE");

    $this->db->select("T_T_T_PENJUALAN_JASA.KET");


    $this->db->select("T_T_T_PENJUALAN_JASA.ENABLE_EDIT");


    $this->db->select("T_M_D_PAYMENT_METHOD.PAYMENT_METHOD");
    $this->db->select("T_M_D_PELANGGAN.PELANGGAN");

    $this->db->select("T_T_T_PENJUALAN_JASA.NO_FAKTUR_PAJAK");
    $this->db->select("T_T_T_PENJUALAN_JASA.TYPE_ID");
    $this->db->select("T_T_T_PENJUALAN_JASA.TARGET_PARTY");





    $this->db->select("SUM_SUB_TOTAL");

   


    $this->db->from('T_T_T_PENJUALAN_JASA');


    $this->db->join('T_M_D_PAYMENT_METHOD', 'T_M_D_PAYMENT_METHOD.ID = T_T_T_PENJUALAN_JASA.PAYMENT_METHOD_ID', 'left');
    $this->db->join('T_M_D_PELANGGAN', 'T_M_D_PELANGGAN.ID = T_T_T_PENJUALAN_JASA.PELANGGAN_ID', 'left');





    $this->db->join("(select \"PENJUALAN_JASA_ID\",sum(\"SUB_TOTAL\")\"SUM_SUB_TOTAL\" from \"T_T_T_PENJUALAN_JASA_RINCIAN\" where \"MARK_FOR_DELETE\"=false group by \"PENJUALAN_JASA_ID\") as t_sum_1", 'T_T_T_PENJUALAN_JASA.ID = t_sum_1.PENJUALAN_JASA_ID', 'left');

    



    $this->db->where("T_T_T_PENJUALAN_JASA.ID={$id}");



    $akun = $this->db->get ();
    return $akun->result ();
  }


  public function select_inv_int()
  {
    $date_before = date('Y-m',(strtotime ( '-30 day' , strtotime ( date('Y-m-d')) ) ));
    $this_year = $date_before.'-01';

    $this->db->limit(1);
    $this->db->select("INV_INT");
    $this->db->from('T_T_T_PENJUALAN_JASA');
    $this->db->where("COMPANY_ID={$this->session->userdata('company_id')}");
    $this->db->where("DATE>='{$this_year}'");
    $this->db->order_by("ID", "desc");

    $akun = $this->db->get ();
    return $akun->result ();
  }

   




  public function delete($id)
  {
    $this->db->where('ID',$id);
    $this->db->delete('T_T_T_PENJUALAN_JASA');
  }

  function tambah($data)
  {
        $this->db->insert('T_T_T_PENJUALAN_JASA', $data);
        return TRUE;
  }

}


