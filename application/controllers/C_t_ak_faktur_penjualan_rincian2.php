<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_t_ak_faktur_penjualan_rincian2 extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('m_t_ak_faktur_penjualan_rincian');
    $this->load->model('m_t_ak_faktur_penjualan_rincian2');


    $this->load->model('m_t_ak_faktur_penjualan');

    $this->load->model('m_t_t_t_penjualan_jasa_3');
    $this->load->model('m_t_t_t_penjualan_jasa_rincian_3');
  }


  public function index($faktur_penjualan_rincian_id, $faktur_penjualan_id,$penjualan_jasa_id,$pelanggan_id)
  {
    $data = [
      "c_t_ak_faktur_penjualan_rincian2" => $this->m_t_ak_faktur_penjualan_rincian2->select($faktur_penjualan_rincian_id),
      "c_t_ak_faktur_penjualan" => $this->m_t_ak_faktur_penjualan->select_by_id($faktur_penjualan_id),



      "option_spb" => $this->m_t_t_t_penjualan_jasa_rincian_3->select_fp($penjualan_jasa_id),


      "faktur_penjualan_id" => $faktur_penjualan_id,
      "faktur_penjualan_rincian_id" => $faktur_penjualan_rincian_id,
      "penjualan_jasa_id" => $penjualan_jasa_id,
      "pelanggan_id" => $pelanggan_id,
      
      "title" => "Rincian Tagihan SPB",
      "description" => ""
    ];
    $this->render_backend('template/backend/pages/t_ak_faktur_penjualan_rincian2', $data);
  }



  function tambah($faktur_penjualan_rincian_id, $faktur_penjualan_id,$penjualan_jasa_id,$pelanggan_id)
  {
    $penjualan_jasa_rincian_id = intval($this->input->post("penjualan_jasa_rincian_id"));

    if($penjualan_jasa_rincian_id!=0)
    {
      $data = array(
        'DATE' => date('Y-m-d'),
        'TIME' => date('H:i:s'),
        'FAKTUR_PENJUALAN_RINCIAN_ID' => $faktur_penjualan_rincian_id,
        'PENJUALAN_RINCIAN_ID' => $penjualan_jasa_rincian_id,
        'CREATED_BY' => $this->session->userdata('username'),
        'UPDATED_BY' => '',
        'KETERANGAN' => 'PENDAPATAN SPB'
      );

      $this->m_t_ak_faktur_penjualan_rincian2->tambah($data);

      $data = array(
        'ENABLE_EDIT' => 0
      );
      $this->m_t_t_t_penjualan_jasa_rincian_3->update($data, $penjualan_jasa_rincian_id);

      $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Ditambahkan!</strong></p></div>');

      redirect('c_t_ak_faktur_penjualan_rincian2/index/' . $faktur_penjualan_rincian_id . '/' . $faktur_penjualan_id. '/' . $penjualan_jasa_id. '/' . $pelanggan_id);
    }
    else
    {
      $this->session->set_flashdata('notif', '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Gagal!</strong> Data Tidak Lengkap!</p></div>');
    }
  }















  public function delete($id,$penjualan_jasa_rincian_id,$faktur_penjualan_rincian_id, $faktur_penjualan_id,$penjualan_jasa_id,$pelanggan_id)
  {
      $data = array(
        'ENABLE_EDIT' => 1
      );
      $this->m_t_t_t_penjualan_jasa_rincian_3->update($data, $penjualan_jasa_rincian_id);

    $this->m_t_ak_faktur_penjualan_rincian2->delete($id);
    $this->session->set_flashdata('notif', '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Success!</strong> Data Berhasil DIhapus!</p></div>');
    redirect('c_t_ak_faktur_penjualan_rincian2/index/' . $faktur_penjualan_rincian_id . '/' . $faktur_penjualan_id. '/' . $penjualan_jasa_id. '/' . $pelanggan_id);
  }



}
