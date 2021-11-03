<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_t_t_t_pengeluaran_rincian extends CI_Model {
    
  

public function update($data, $id)
{
    $this->db->where('ID', $id);
    return $this->db->update('T_T_T_PENGELUARAN_RINCIAN', $data);
}








  public function select($penjualan_jasa_rincian_id)
  {
    $this->db->select('T_T_T_PENGELUARAN_RINCIAN.ID');

    $this->db->select('T_T_T_PENGELUARAN_RINCIAN.DATE');
    $this->db->select('T_T_T_PENGELUARAN_RINCIAN.TIME');
    $this->db->select('T_T_T_PENGELUARAN_RINCIAN.KET');



    $this->db->select('T_T_T_PENGELUARAN_RINCIAN.COA_ID_PENGELUARAN');
    $this->db->select('T_T_T_PENGELUARAN_RINCIAN.NO_VOUCER');
    $this->db->select('T_T_T_PENGELUARAN_RINCIAN.VALUE');



    $this->db->select('T_T_T_PENGELUARAN_RINCIAN.CREATED_BY');
    $this->db->select('T_T_T_PENGELUARAN_RINCIAN.UPDATED_BY');
    $this->db->select('T_T_T_PENGELUARAN_RINCIAN.MARK_FOR_DELETE');
    $this->db->select('T_T_T_PENGELUARAN_RINCIAN.COA_ID');



    $this->db->select("AK_M_COA.NAMA_AKUN");


    $this->db->select("t_1.NAMA_AKUN as NAMA_AKUN_PENGELUARAN");


    $this->db->from('T_T_T_PENGELUARAN_RINCIAN');


    $this->db->join('AK_M_COA as t_1', 't_1.ID = T_T_T_PENGELUARAN_RINCIAN.COA_ID_PENGELUARAN', 'left');

    $this->db->join('AK_M_COA', 'AK_M_COA.ID = T_T_T_PENGELUARAN_RINCIAN.COA_ID', 'left');


    if($this->session->userdata('t_t_t_pengeluaran_rincian_delete_logic')==0)
    {
      $this->db->where('T_T_T_PENGELUARAN_RINCIAN.MARK_FOR_DELETE',FALSE);
    }
    $this->db->where('T_T_T_PENGELUARAN_RINCIAN.PENJUALAN_JASA_RINCIAN_ID',$penjualan_jasa_rincian_id);




    $this->db->order_by("T_T_T_PENGELUARAN_RINCIAN.ID", "desc");
    $akun = $this->db->get ();
    return $akun->result ();
  }





  public function select_by_id($id)
  {
    $this->db->select('T_T_T_PENGELUARAN_RINCIAN.ID');

    $this->db->select('T_T_T_PENGELUARAN_RINCIAN.DATE');
    $this->db->select('T_T_T_PENGELUARAN_RINCIAN.TIME');
    $this->db->select('T_T_T_PENGELUARAN_RINCIAN.KET');



    $this->db->select('T_T_T_PENGELUARAN_RINCIAN.COA_ID_PENGELUARAN');
    $this->db->select('T_T_T_PENGELUARAN_RINCIAN.NO_VOUCER');
    $this->db->select('T_T_T_PENGELUARAN_RINCIAN.VALUE');



    $this->db->select('T_T_T_PENGELUARAN_RINCIAN.CREATED_BY');
    $this->db->select('T_T_T_PENGELUARAN_RINCIAN.UPDATED_BY');
    $this->db->select('T_T_T_PENGELUARAN_RINCIAN.MARK_FOR_DELETE');
    $this->db->select('T_T_T_PENGELUARAN_RINCIAN.COA_ID');



    $this->db->select("AK_M_COA.NAMA_AKUN");


    $this->db->select("t_1.NAMA_AKUN as NAMA_AKUN_PENGELUARAN");


    $this->db->from('T_T_T_PENGELUARAN_RINCIAN');


    $this->db->join('AK_M_COA as t_1', 't_1.ID = T_T_T_PENGELUARAN_RINCIAN.COA_ID_PENGELUARAN', 'left');

    $this->db->join('AK_M_COA', 'AK_M_COA.ID = T_T_T_PENGELUARAN_RINCIAN.COA_ID', 'left');


   
    $this->db->where('T_T_T_PENGELUARAN_RINCIAN.ID',$id);
    
    $akun = $this->db->get ();
    return $akun->result ();
  }



  public function delete($id)
  {
    $this->db->where('ID',$id);
    $this->db->delete('T_T_T_PENGELUARAN_RINCIAN');
  }

  function tambah($data)
  {
    $this->db->insert('T_T_T_PENGELUARAN_RINCIAN', $data);
    return TRUE;
  }

}


