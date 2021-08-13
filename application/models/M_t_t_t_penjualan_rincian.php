<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_t_t_t_penjualan_rincian extends CI_Model {
    
    
public function update($data, $id)
{
    $this->db->where('ID', $id);
    return $this->db->update('T_T_T_PENJUALAN_RINCIAN', $data);
}

  public function select($penjualan_id)
  {
    


    $this->db->select("T_T_T_PENJUALAN_RINCIAN.ID");
    $this->db->select("T_T_T_PENJUALAN_RINCIAN.PENJUALAN_ID");
    $this->db->select("T_T_T_PENJUALAN_RINCIAN.BARANG_ID");
    $this->db->select("T_T_T_PENJUALAN_RINCIAN.QTY");
    $this->db->select("T_T_T_PENJUALAN_RINCIAN.SISA_QTY");
    $this->db->select("T_T_T_PENJUALAN_RINCIAN.HARGA");
    $this->db->select("T_T_T_PENJUALAN_RINCIAN.SUB_TOTAL");
    $this->db->select("T_T_T_PENJUALAN_RINCIAN.SISA_QTY_TT");
    $this->db->select("T_T_T_PENJUALAN_RINCIAN.CREATED_BY");
    $this->db->select("T_T_T_PENJUALAN_RINCIAN.UPDATED_BY");
    $this->db->select("T_T_T_PENJUALAN_RINCIAN.MARK_FOR_DELETE");
    $this->db->select("T_T_T_PENJUALAN_RINCIAN.DISKON_P_1");
    $this->db->select("T_T_T_PENJUALAN_RINCIAN.DISKON_P_2");
    $this->db->select("T_T_T_PENJUALAN_RINCIAN.DISKON_HARGA");



    $this->db->select('T_M_D_BARANG.KODE_BARANG');
    $this->db->select('T_M_D_BARANG.BARANG');
    $this->db->select('T_M_D_BARANG.PART_NUMBER');
    $this->db->select('T_M_D_BARANG.MERK_BARANG');
    $this->db->select('T_M_D_BARANG.POSISI');
    $this->db->select('T_M_D_BARANG.MINIMUM_STOK');


    $this->db->select('T_M_D_SATUAN.SATUAN');
   


    $this->db->from('T_T_T_PENJUALAN_RINCIAN');


    $this->db->join('T_M_D_BARANG', 'T_M_D_BARANG.BARANG_ID = T_T_T_PENJUALAN_RINCIAN.BARANG_ID', 'left');

    $this->db->join('T_M_D_SATUAN', 'T_M_D_BARANG.SATUAN_ID = T_M_D_SATUAN.ID', 'left');

    
    $this->db->where("T_M_D_BARANG.COMPANY_ID={$this->session->userdata('company_id')}");


    if($this->session->userdata('t_t_t_penjualan_delete_logic')==0)
    {
      $this->db->where('T_T_T_PENJUALAN_RINCIAN.MARK_FOR_DELETE',FALSE);
    }

    
    $this->db->where('T_T_T_PENJUALAN_RINCIAN.PENJUALAN_ID',$penjualan_id);
    $this->db->order_by("ID", "desc");

    $akun = $this->db->get ();
    return $akun->result ();
  }


public function select_qty_before_date($limit_date,$barang_id)
  {
    $this->db->select('SUM_QTY');
    $this->db->from('T_M_D_BARANG');
    $this->db->join("(select \"T_T_T_PENJUALAN_RINCIAN\".\"BARANG_ID\",sum(\"QTY\")\"SUM_QTY\" from \"T_T_T_PENJUALAN_RINCIAN\" LEFT OUTER JOIN \"T_T_T_PENJUALAN\" on \"T_T_T_PENJUALAN\".\"ID\"=\"T_T_T_PENJUALAN_RINCIAN\".\"PENJUALAN_ID\" where  \"T_T_T_PENJUALAN_RINCIAN\".\"MARK_FOR_DELETE\"=false and \"T_T_T_PENJUALAN\".\"DATE\"<'{$limit_date}' and \"T_T_T_PENJUALAN\".\"COMPANY_ID\"='{$this->session->userdata('company_id')}'  group by \"T_T_T_PENJUALAN_RINCIAN\".\"BARANG_ID\") as t_sum_1", 'T_M_D_BARANG.BARANG_ID = t_sum_1.BARANG_ID', 'left');
    $this->db->where('T_M_D_BARANG.BARANG_ID',$barang_id);
    $akun = $this->db->get ();
    return $akun->result ();
  }




  
  public function select_by_penjualan_id_and_barang_id($penjualan_id,$barang_id)
  {
    $this->db->select("SISA_QTY");
    $this->db->from('T_T_T_PENJUALAN_RINCIAN');

    $this->db->where('T_T_T_PENJUALAN_RINCIAN.PENJUALAN_ID',$penjualan_id);
    $this->db->where('T_T_T_PENJUALAN_RINCIAN.BARANG_ID',$barang_id);

    $akun = $this->db->get ();
    return $akun->result ();
  }

  public function select_by_id($id)
  {
    


    $this->db->select("T_T_T_PENJUALAN_RINCIAN.ID");
    $this->db->select("T_T_T_PENJUALAN_RINCIAN.PENJUALAN_ID");
    $this->db->select("T_T_T_PENJUALAN_RINCIAN.BARANG_ID");
    $this->db->select("T_T_T_PENJUALAN_RINCIAN.QTY");
    $this->db->select("T_T_T_PENJUALAN_RINCIAN.HARGA");
    $this->db->select("T_T_T_PENJUALAN_RINCIAN.SUB_TOTAL");
    $this->db->select("T_T_T_PENJUALAN_RINCIAN.SISA_QTY_TT");
    $this->db->select("T_T_T_PENJUALAN_RINCIAN.CREATED_BY");
    $this->db->select("T_T_T_PENJUALAN_RINCIAN.UPDATED_BY");
    $this->db->select("T_T_T_PENJUALAN_RINCIAN.MARK_FOR_DELETE");



    $this->db->select('T_M_D_BARANG.KODE_BARANG');
    $this->db->select('T_M_D_BARANG.BARANG');
    $this->db->select('T_M_D_BARANG.PART_NUMBER');
    $this->db->select('T_M_D_BARANG.MERK_BARANG');
    $this->db->select('T_M_D_BARANG.POSISI');
    $this->db->select('T_M_D_BARANG.MINIMUM_STOK');

   


    $this->db->from('T_T_T_PENJUALAN_RINCIAN');


    $this->db->join('T_M_D_BARANG', 'T_M_D_BARANG.BARANG_ID = T_T_T_PENJUALAN_RINCIAN.BARANG_ID', 'left');

    $this->db->where("T_M_D_BARANG.COMPANY_ID={$this->session->userdata('company_id')}");

    
    $this->db->where('T_T_T_PENJUALAN_RINCIAN.ID',$id);

    $akun = $this->db->get ();
    return $akun->result ();
  }



  public function select_rekap_pelanggan($from_date,$to_date)
  {
    $this->db->select("T_M_D_PELANGGAN.ID");
    $this->db->select("T_M_D_PELANGGAN.PELANGGAN");
   
    $this->db->select("SUM_QTY");

    $this->db->select("SUM_SUB_TOTAL");

    


    $this->db->from('T_M_D_PELANGGAN');


 

    $this->db->join("(select \"T_T_T_PENJUALAN\".\"PELANGGAN_ID\",sum(\"T_T_T_PENJUALAN_RINCIAN\".\"QTY\")\"SUM_QTY\" from \"T_T_T_PENJUALAN_RINCIAN\" LEFT OUTER JOIN \"T_T_T_PENJUALAN\" on \"T_T_T_PENJUALAN\".\"ID\"=\"T_T_T_PENJUALAN_RINCIAN\".\"PENJUALAN_ID\" where \"T_T_T_PENJUALAN\".\"DATE\">='{$from_date}' and \"T_T_T_PENJUALAN\".\"DATE\"<='{$to_date}' and \"T_T_T_PENJUALAN_RINCIAN\".\"MARK_FOR_DELETE\"=false group by \"T_T_T_PENJUALAN\".\"PELANGGAN_ID\") as t_sum_1", 'T_M_D_PELANGGAN.ID = t_sum_1.PELANGGAN_ID', 'left');


    $this->db->join("(select \"T_T_T_PENJUALAN\".\"PELANGGAN_ID\",sum(\"T_T_T_PENJUALAN_RINCIAN\".\"SUB_TOTAL\")\"SUM_SUB_TOTAL\" from \"T_T_T_PENJUALAN_RINCIAN\" LEFT OUTER JOIN \"T_T_T_PENJUALAN\" on \"T_T_T_PENJUALAN\".\"ID\"=\"T_T_T_PENJUALAN_RINCIAN\".\"PENJUALAN_ID\" where \"T_T_T_PENJUALAN\".\"DATE\">='{$from_date}' and \"T_T_T_PENJUALAN\".\"DATE\"<='{$to_date}' and \"T_T_T_PENJUALAN_RINCIAN\".\"MARK_FOR_DELETE\"=false group by \"T_T_T_PENJUALAN\".\"PELANGGAN_ID\") as t_sum_2", 'T_M_D_PELANGGAN.ID = t_sum_2.PELANGGAN_ID', 'left');

    
    $this->db->where('T_M_D_PELANGGAN.MARK_FOR_DELETE',false);
    $this->db->order_by("PELANGGAN", "asc");

    $akun = $this->db->get ();
    return $akun->result ();
  }




  public function select_rekap_sales($from_date,$to_date)
  {
    $this->db->select("T_M_D_SALES.ID");
    $this->db->select("T_M_D_SALES.SALES");
   
    $this->db->select("SUM_QTY");

    $this->db->select("SUM_SUB_TOTAL");

    


    $this->db->from('T_M_D_SALES');


 

    $this->db->join("(select \"T_T_T_PENJUALAN\".\"SALES_ID\",sum(\"T_T_T_PENJUALAN_RINCIAN\".\"QTY\")\"SUM_QTY\" from \"T_T_T_PENJUALAN_RINCIAN\" LEFT OUTER JOIN \"T_T_T_PENJUALAN\" on \"T_T_T_PENJUALAN\".\"ID\"=\"T_T_T_PENJUALAN_RINCIAN\".\"PENJUALAN_ID\" where \"T_T_T_PENJUALAN\".\"DATE\">='{$from_date}' and \"T_T_T_PENJUALAN\".\"DATE\"<='{$to_date}' and \"T_T_T_PENJUALAN_RINCIAN\".\"MARK_FOR_DELETE\"=false group by \"T_T_T_PENJUALAN\".\"SALES_ID\") as t_sum_1", 'T_M_D_SALES.ID = t_sum_1.SALES_ID', 'left');


    $this->db->join("(select \"T_T_T_PENJUALAN\".\"SALES_ID\",sum(\"T_T_T_PENJUALAN_RINCIAN\".\"SUB_TOTAL\")\"SUM_SUB_TOTAL\" from \"T_T_T_PENJUALAN_RINCIAN\" LEFT OUTER JOIN \"T_T_T_PENJUALAN\" on \"T_T_T_PENJUALAN\".\"ID\"=\"T_T_T_PENJUALAN_RINCIAN\".\"PENJUALAN_ID\" where \"T_T_T_PENJUALAN\".\"DATE\">='{$from_date}' and \"T_T_T_PENJUALAN\".\"DATE\"<='{$to_date}' and \"T_T_T_PENJUALAN_RINCIAN\".\"MARK_FOR_DELETE\"=false group by \"T_T_T_PENJUALAN\".\"SALES_ID\") as t_sum_2", 'T_M_D_SALES.ID = t_sum_2.SALES_ID', 'left');

    
    $this->db->where('T_M_D_SALES.MARK_FOR_DELETE',false);
    $this->db->order_by("SALES", "asc");

    $akun = $this->db->get ();
    return $akun->result ();
  }








  public function select_barang_id($retur_pembelian_id)
  {
    
    $this->db->select('T_M_D_BARANG.BARANG_ID');
    $this->db->select('T_M_D_BARANG.KODE_BARANG');
    $this->db->select('T_M_D_BARANG.BARANG');
    $this->db->select('T_M_D_BARANG.PART_NUMBER');
    $this->db->select('T_M_D_BARANG.MERK_BARANG');
    $this->db->select('T_M_D_BARANG.POSISI');
    $this->db->select('T_M_D_BARANG.MINIMUM_STOK');

   
    $this->db->select('T_T_T_PEMBELIAN_RINCIAN.SISA_QTY');

    $this->db->from('T_T_T_PENJUALAN');

    $this->db->join('T_T_T_PEMBELIAN', 'T_T_T_PEMBELIAN.ID = T_T_T_PENJUALAN.PEMBELIAN_ID', 'left');


    $this->db->join('T_T_T_PEMBELIAN_RINCIAN', 'T_T_T_PEMBELIAN.ID = T_T_T_PEMBELIAN_RINCIAN.PEMBELIAN_ID', 'left');

    $this->db->join('T_M_D_BARANG', 'T_M_D_BARANG.BARANG_ID = T_T_T_PEMBELIAN_RINCIAN.BARANG_ID', 'left');

    $this->db->where("T_M_D_BARANG.COMPANY_ID={$this->session->userdata('company_id')}");

    $this->db->where('T_T_T_PEMBELIAN_RINCIAN.MARK_FOR_DELETE',FALSE);
    $this->db->where('T_T_T_PENJUALAN.ID',$retur_pembelian_id);


    $akun = $this->db->get ();
    return $akun->result ();
  }




  public function select_barang_id_only_one($retur_pembelian_id,$barang_id)
  {
    
    $this->db->select('T_M_D_BARANG.BARANG_ID');
    $this->db->select('T_M_D_BARANG.KODE_BARANG');
    $this->db->select('T_M_D_BARANG.BARANG');
    $this->db->select('T_M_D_BARANG.PART_NUMBER');
    $this->db->select('T_M_D_BARANG.MERK_BARANG');
    $this->db->select('T_M_D_BARANG.POSISI');
    $this->db->select('T_M_D_BARANG.MINIMUM_STOK');


    $this->db->select('T_T_T_PEMBELIAN_RINCIAN.ID as PEMBELIAN_RINCIAN_ID');
    $this->db->select('T_T_T_PEMBELIAN_RINCIAN.QTY');
    $this->db->select('T_T_T_PEMBELIAN_RINCIAN.HARGA');
    $this->db->select('T_T_T_PEMBELIAN_RINCIAN.SISA_QTY');




    $this->db->from('T_T_T_PENJUALAN');

    $this->db->join('T_T_T_PEMBELIAN', 'T_T_T_PEMBELIAN.ID = T_T_T_PENJUALAN.PEMBELIAN_ID', 'left');


    $this->db->join('T_T_T_PEMBELIAN_RINCIAN', 'T_T_T_PEMBELIAN.ID = T_T_T_PEMBELIAN_RINCIAN.PEMBELIAN_ID', 'left');

    $this->db->join('T_M_D_BARANG', 'T_M_D_BARANG.BARANG_ID = T_T_T_PEMBELIAN_RINCIAN.BARANG_ID', 'left');


    $this->db->where("T_M_D_BARANG.COMPANY_ID={$this->session->userdata('company_id')}");

    $this->db->where('T_T_T_PEMBELIAN_RINCIAN.BARANG_ID',$barang_id);
    
    $this->db->where('T_T_T_PENJUALAN.ID',$retur_pembelian_id);


    $akun = $this->db->get ();
    return $akun->result ();
  }







  public function delete($id)
  {
    $this->db->where('ID',$id);
    $this->db->delete('T_T_T_PENJUALAN_RINCIAN');
  }

  function tambah($data)
  {
        $this->db->insert('T_T_T_PENJUALAN_RINCIAN', $data);
        return TRUE;
  }

}


