<?php
defined('BASEPATH') or exit('No direct script access allowed');


class C_t_t_t_po_manual_rincian extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('m_t_t_t_po_manual');
    $this->load->model('m_t_m_d_company');
    $this->load->model('m_t_m_d_barang');
    $this->load->model('m_t_m_d_supplier');
    $this->load->model('m_t_t_t_po_manual_rincian'); 
    $this->load->model('m_t_t_t_pembelian_rincian'); 
  }

  public function index($po_manual_id)
  {

    $this->session->set_userdata('t_t_t_po_manual_delete_logic', '1');
    
    $this->session->set_userdata('t_m_d_barang_delete_logic', '0');

    $this->session->set_userdata('master_barang_kategori_id', '0');
    $this->session->set_userdata('master_barang_company_id', $this->session->userdata('company_id'));


    $data = [
      //"select_barang_with_supplier" => $this->m_t_t_t_po_manual_rincian->select_barang_with_supplier(),
      "c_t_t_t_po_manual_rincian" => $this->m_t_t_t_po_manual_rincian->select($po_manual_id),
      "c_t_t_t_po_manual_by_id" => $this->m_t_t_t_po_manual->select_by_id($po_manual_id),
      "c_t_m_d_barang" => $this->m_t_m_d_barang->select(),
      "c_t_m_d_supplier" => $this->m_t_m_d_supplier->select(),
      "pembelian_id" => $po_manual_id,
      "title" => "Rincian Transaksi PO Manual",
      "description" => "form PO Manual"
    ];
    $this->render_backend('template/backend/pages/t_t_t_po_manual_rincian', $data);
  }



  public function delete($id,$retur_pembelian_id)
  {
    $data = array(
        'UPDATED_BY' => $this->session->userdata('username'),
        'MARK_FOR_DELETE' => TRUE
    );
    $this->m_t_t_t_po_manual_rincian->update($data, $id);
    $this->session->set_flashdata('notif', '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Success!</strong> Data Berhasil DIhapus!</p></div>');

    redirect('c_t_t_t_po_manual_rincian/index/' . $retur_pembelian_id);
  }

  public function undo_delete($id,$retur_pembelian_id)
  {
    $data = array(
        'UPDATED_BY' => $this->session->userdata('username'),
        'MARK_FOR_DELETE' => FALSE
    );
    $this->m_t_t_t_po_manual_rincian->update($data, $id);
    
    $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Dikembalikan!</strong></p></div>');
    redirect('c_t_t_t_po_manual_rincian/index/' . $retur_pembelian_id);
  }

 







  function tambah($po_manual_id)
  {
    $barang_id = intval($this->input->post("barang_id"));
    $qty = floatval($this->input->post("qty"));
    $harga = floatval($this->input->post("harga"));
    //$qty_datang = floatval($this->input->post("qty_datang"));
    $ppn_percentage = floatval($this->input->post("ppn_percentage"));

    $sub_total = $qty * $harga;
    
    $ppn_value = ($sub_total*$ppn_percentage)/100;

    $read_select = $this->m_t_t_t_po_manual->select_by_id($po_manual_id);
    foreach ($read_select as $key => $value) 
    {
      $supplier_id = $value->SUPPLIER_ID;
    }

    $sisa_qty_tt = 0;
    $read_select = $this->m_t_t_t_po_manual_rincian->select_sisa_qty_for_1_barang_id($barang_id);
    foreach ($read_select as $key => $value) 
    {
      $sisa_qty_tt = $value->SUM_SISA_QTY;
    }




    if($barang_id!=0 )
    {
      $data = array(
        'PEMBELIAN_ID' => $po_manual_id,
        'BARANG_ID' => $barang_id,
        'QTY' => $qty,
        'SISA_QTY_RB' => $qty,
        'SISA_QTY' => $qty,
        'HARGA' => $harga,
        'SUB_TOTAL' => $sub_total,
        'SISA_QTY_TT' => $sisa_qty_tt,
        'SPECIAL_CASE_ID' => 123, //nol kode barang indent
        'SUPPLIER_ID' => $supplier_id,
        'CREATED_BY' => $this->session->userdata('username'),
        'UPDATED_BY' => '',
        'MARK_FOR_DELETE' => FALSE,
        'COMPANY_ID' => $this->session->userdata('company_id'),
        'QTY_DATANG' => 0,
        'PPN_PERCENTAGE' => $ppn_percentage,
        'PPN_VALUE' => $ppn_value
      );

      $this->m_t_t_t_po_manual_rincian->tambah($data);

      $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Ditambahkan!</strong></p></div>');
    }

    else
    {
      $this->session->set_flashdata('notif', '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Gagal!</strong> Data Tidak Lengkap/Stok Kurang!</p></div>');
    }
    

    
    redirect('c_t_t_t_po_manual_rincian/index/'.$po_manual_id);
  }






  public function edit_action($po_manual_id)
  {
    $id = $this->input->post("id");
   
    $qty = floatval($this->input->post("qty"));
    $harga = floatval($this->input->post("harga"));
    //$qty_datang = floatval($this->input->post("qty_datang"));
    $ppn_percentage = floatval($this->input->post("ppn_percentage"));

    $sub_total = $qty * $harga;

    
    $sisa_qty_tt = 0;


    $ppn_value = ($sub_total*$ppn_percentage)/100;

    if($qty_datang<=$qty)
    {
      $read_select = $this->m_t_t_t_pembelian_rincian->select_by_id($id);
      foreach ($read_select as $key => $value) 
      {
        $e_qty_datang = $value->QTY_DATANG;
        $e_sisa_qty = $value->SISA_QTY;
      }

      $update_sisa_qty = ($qty_datang-$e_qty_datang)+$e_sisa_qty;


        $data = array(
          'SISA_QTY_RB' => $qty,
          'QTY' => $qty,
          'SISA_QTY' => $qty,
          'HARGA' => $harga,
          'SUB_TOTAL' => $sub_total,
          'SISA_QTY_TT' => $sisa_qty_tt,
          'UPDATED_BY' => $this->session->userdata('username'),
          'QTY_DATANG' => 0
        );

        $this->m_t_t_t_po_manual_rincian->update($data,$id);

        $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Ditambahkan!</strong></p></div>');
    

    }
    else
    {
      $this->session->set_flashdata('notif', '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Gagal!</strong> QTY Datang > QTY Pembelian!</p></div>');
    }


    
    redirect('c_t_t_t_po_manual_rincian/index/'.$po_manual_id);
  }
}
