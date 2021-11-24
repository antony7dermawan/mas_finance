<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_t_ak_faktur_penjualan_diskon extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('m_t_ak_faktur_penjualan_rincian');
    $this->load->model('m_t_ak_faktur_penjualan_diskon');


    $this->load->model('m_t_ak_faktur_penjualan');

    $this->load->model('m_t_t_t_penjualan_jasa_3');
    $this->load->model('m_t_t_t_penjualan_jasa_rincian_3');
  }


  public function index($id, $pelanggan_id)
  {
    $data = [
      "c_t_ak_faktur_penjualan_diskon" => $this->m_t_ak_faktur_penjualan_diskon->select($id),
      "c_t_ak_faktur_penjualan" => $this->m_t_ak_faktur_penjualan->select_by_id($id),




      "faktur_penjualan_id" => $id,
      "pelanggan_id" => $pelanggan_id,
      
      "title" => "Rincian Diskon Invoice",
      "description" => ""
    ];
    $this->render_backend('template/backend/pages/t_ak_faktur_penjualan_diskon', $data);
  }



  function tambah($faktur_penjualan_id,$pelanggan_id)
  {
    $qty = floatval($this->input->post("qty"));
    $harga = floatval($this->input->post("harga"));

    $keterangan = substr($this->input->post("keterangan"), 0, 50);

    $value_diskon = $qty * $harga;


   
      $data = array(
        'QTY' => $qty,
        'HARGA' => $harga,
        'VALUE_DISKON' => $value_diskon,

        'FAKTUR_PENJUALAN_ID' => $faktur_penjualan_id,
        'KETERANGAN' => $keterangan,
        'CREATED_BY' => $this->session->userdata('username'),
        'UPDATED_BY' => '',
        'MARK_FOR_DELETE' => FALSE
      );

      $this->m_t_ak_faktur_penjualan_diskon->tambah($data);

      
      $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Ditambahkan!</strong></p></div>');

      
    
  


    redirect('c_t_ak_faktur_penjualan_diskon/index/' . $faktur_penjualan_id. '/' . $pelanggan_id);
  }















  public function delete($id,$faktur_penjualan_id,$pelanggan_id)
  {
      $data = array(
        'ENABLE_EDIT' => 1
      );
      $this->m_t_t_t_penjualan_jasa_rincian_3->update($data, $penjualan_jasa_rincian_id);

    $this->m_t_ak_faktur_penjualan_diskon->delete($id);
    $this->session->set_flashdata('notif', '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Success!</strong> Data Berhasil DIhapus!</p></div>');
    redirect('c_t_ak_faktur_penjualan_diskon/index/' . $faktur_penjualan_id. '/' . $pelanggan_id);
  }



}
