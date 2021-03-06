<?php
defined('BASEPATH') or exit('No direct script access allowed');

class c_t_ak_faktur_penjualan_pph extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('m_t_ak_faktur_penjualan_rincian');
    $this->load->model('m_t_ak_faktur_penjualan_pph');


    $this->load->model('m_t_ak_faktur_penjualan');

    $this->load->model('m_t_t_t_penjualan_jasa_3');
    $this->load->model('m_t_t_t_penjualan_jasa_rincian_3');
  }


  public function index($id, $pelanggan_id)
  {
    $data = [
      "c_t_ak_faktur_penjualan_pph" => $this->m_t_ak_faktur_penjualan_pph->select($id),
      "c_t_ak_faktur_penjualan" => $this->m_t_ak_faktur_penjualan->select_by_id($id),




      "faktur_penjualan_id" => $id,
      "pelanggan_id" => $pelanggan_id,
      
      "title" => "Rincian Diskon Invoice",
      "description" => ""
    ];
    $this->render_backend('template/backend/pages/t_ak_faktur_penjualan_pph', $data);
  }



  function tambah($faktur_penjualan_id,$pelanggan_id)
  {
    $percentage_pph = floatval($this->input->post("percentage_pph"));


    $read_select = $this->m_t_ak_faktur_penjualan->select_by_id($faktur_penjualan_id);
    foreach ($read_select as $key => $value) 
    {
      $sum_total_tagihan=$value->SUM_TOTAL_TAGIHAN;
      $sum_total_tagihan_ppn=$value->SUM_TOTAL_TAGIHAN_PPN;

      $sum_value_diskon=$value->SUM_VALUE_DISKON;
      $sum_value_pph=$value->SUM_VALUE_PPH;
    }
    $keterangan = substr($this->input->post("keterangan"), 0, 50);

    $value_pph =(($sum_total_tagihan - $sum_value_diskon)*$percentage_pph)/100;


   
      $data = array(

        'VALUE_PPH' => $value_pph,
        'PERCENTAGE_PPH' => $percentage_pph,

        'FAKTUR_PENJUALAN_ID' => $faktur_penjualan_id,
        'KETERANGAN' => $keterangan,
        'CREATED_BY' => $this->session->userdata('username'),
        'UPDATED_BY' => '',
        'MARK_FOR_DELETE' => FALSE
      );

      $this->m_t_ak_faktur_penjualan_pph->tambah($data);

      
      $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Ditambahkan!</strong></p></div>');

      
    
  


    redirect('c_t_ak_faktur_penjualan_pph/index/' . $faktur_penjualan_id. '/' . $pelanggan_id);
  }















  public function delete($id,$faktur_penjualan_id,$pelanggan_id)
  {
      $data = array(
        'ENABLE_EDIT' => 1
      );
      $this->m_t_t_t_penjualan_jasa_rincian_3->update($data, $penjualan_jasa_rincian_id);

    $this->m_t_ak_faktur_penjualan_pph->delete($id);
    $this->session->set_flashdata('notif', '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Success!</strong> Data Berhasil DIhapus!</p></div>');
    redirect('c_t_ak_faktur_penjualan_pph/index/' . $faktur_penjualan_id. '/' . $pelanggan_id);
  }



}
