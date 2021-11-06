<?php
defined('BASEPATH') or exit('No direct script access allowed');


class C_t_t_t_penjualan_jasa_rincian extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('m_t_t_t_penjualan_jasa');

    $this->load->model('m_t_t_t_penjualan_jasa_rincian'); 

    
    $this->load->model('m_t_m_d_satuan');
    $this->load->model('m_t_m_d_company');


    $this->load->model('m_t_m_d_no_polisi');
    $this->load->model('m_t_m_d_supir');
    $this->load->model('m_t_m_d_from_nama_kota');
    $this->load->model('m_t_m_d_to_nama_kota');
    
  }


  public function index($penjualan_jasa_id)
  {
    $this->session->set_userdata('t_t_t_penjualan_jasa_delete_logic', '1');
    $this->session->set_userdata('t_m_d_satuan_delete_logic', '0');

    $this->session->set_userdata('t_m_d_no_polisi_delete_logic', '0');
    $this->session->set_userdata('t_m_d_supir_delete_logic', '0');
    $this->session->set_userdata('t_m_d_from_nama_kota_delete_logic', '0');
    $this->session->set_userdata('t_m_d_to_nama_kota_delete_logic', '0');


    $data = [
      //"select_barang_with_supplier" => $this->m_t_t_t_pembelian_rincian->select_barang_with_supplier(),
      "c_t_t_t_penjualan_jasa_rincian" => $this->m_t_t_t_penjualan_jasa_rincian->select($penjualan_jasa_id),

      "c_t_t_t_penjualan_jasa_by_id" => $this->m_t_t_t_penjualan_jasa->select_by_id($penjualan_jasa_id),


      "c_t_m_d_from_nama_kota" => $this->m_t_m_d_from_nama_kota->select(),
      "c_t_m_d_to_nama_kota" => $this->m_t_m_d_to_nama_kota->select(),
      "c_t_m_d_no_polisi" => $this->m_t_m_d_no_polisi->select(),
      "c_t_m_d_supir" => $this->m_t_m_d_supir->select(),

      "penjualan_jasa_id" => $penjualan_jasa_id,
      "title" => "Rincian Nomor SPB",
      "description" => ""
    ];
    $this->render_backend('template/backend/pages/t_t_t_penjualan_jasa_rincian', $data);
  }



  public function delete($id,$penjualan_jasa_id)
  {
    $data = array(
        'UPDATED_BY' => $this->session->userdata('username'),
        'MARK_FOR_DELETE' => TRUE
    );
    $this->m_t_t_t_penjualan_jasa_rincian->update($data, $id);



    $this->session->set_flashdata('notif', '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Success!</strong> Data Berhasil DIhapus!</p></div>');

    redirect('c_t_t_t_penjualan_jasa_rincian/index/' . $penjualan_jasa_id);
  }


 

  function tambah($penjualan_jasa_id)
  {
    $no_spb = substr($this->input->post("no_spb"), 0, 50);
    $ket = substr($this->input->post("ket"), 0, 500);

    

    $from_nama_kota_id = intval($this->input->post("from_nama_kota_id"));
    $to_nama_kota_id = intval($this->input->post("to_nama_kota_id"));


    $date_muat = ($this->input->post("date_muat"));
    $date_bongkar = ($this->input->post("date_bongkar"));

    if($date_muat=='')
    {
      $date_muat = date('Y-m-d');
    }


    if($date_bongkar=='')
    {
      $date_bongkar = date('Y-m-d');
    }


    $no_polisi_id = intval($this->input->post("no_polisi_id"));
    $supir_id = intval($this->input->post("supir_id"));



    $bruto_kebun = floatval($this->input->post("bruto_kebun"));
    $tara_kebun = floatval($this->input->post("tara_kebun"));

    $value_kebun = $bruto_kebun - $tara_kebun;

    $bruto_pabrik = floatval($this->input->post("bruto_pabrik"));
    $tara_pabrik = floatval($this->input->post("tara_pabrik"));

    $value_pabrik = $bruto_pabrik - $tara_pabrik;


    $value_susut = $value_kebun - $value_pabrik;

    $percentage_susut = (($value_kebun - $value_pabrik)/$value_kebun)*100;


    $toleransi = floatval($this->input->post("toleransi"));

    $toleransi_value = ($toleransi * $value_kebun)/100;


    $claim_susut = $toleransi_value - $value_susut;

    
    $harga_kebun = floatval($this->input->post("harga_kebun"));
    $harga_pabrik = floatval($this->input->post("harga_pabrik"));


    $sub_total = ($value_kebun*$harga_kebun) + ($value_pabrik*$harga_pabrik);


    $ppn_percentage = floatval($this->input->post("ppn_percentage"));
    $ppn_value = ($ppn_percentage / 100)*$sub_total;


    $data = array(
        'PENJUALAN_JASA_ID' => $penjualan_jasa_id,
        'NO_SPB' => $no_spb,
        'DATE_MUAT' => $date_muat,
        'DATE_BONGKAR' => $date_bongkar,
        'FROM_NAMA_KOTA_ID' => $from_nama_kota_id,
        'TO_NAMA_KOTA_ID' => $to_nama_kota_id,
        'NO_POLISI_ID' => $no_polisi_id,
        'SUPIR_ID' => $supir_id,
        'BRUTO_KEBUN' => $bruto_kebun,
        'TARA_KEBUN' => $tara_kebun,
        'VALUE_KEBUN' => $value_kebun,
        'BRUTO_PABRIK' => $bruto_pabrik,
        'TARA_PABRIK' => $tara_pabrik,
        'VALUE_PABRIK' => $value_pabrik,
        'VALUE_SUSUT' => $value_susut,
        'PERCENTAGE_SUSUT' => $percentage_susut,
        'TOLERANSI' => $toleransi,
        'CLAIM_SUSUT' => $claim_susut,
        'HARGA_KEBUN' => $harga_kebun,
        'HARGA_PABRIK' => $harga_pabrik,
        'SUB_TOTAL' => $sub_total,
        'PPN_PERCENTAGE' => $ppn_percentage,
        'PPN_VALUE' => $ppn_value,

        'COMPANY_ID' => $this->session->userdata('company_id'),
        'MARK_FOR_DELETE' => FALSE,
        'CREATED_BY' => $this->session->userdata('username'),
        'UPDATED_BY' => '',
        'KET' => $ket,
        'TOLERANSI_VALUE' => $toleransi_value
    );

    $this->m_t_t_t_penjualan_jasa_rincian->tambah($data);



      $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Ditambahkan!</strong></p></div>');
      redirect('c_t_t_t_penjualan_jasa_rincian/index/' . $penjualan_jasa_id);
    
    

    
    redirect('c_t_t_t_penjualan_jasa_rincian/index/'.$penjualan_jasa_id);
  }





  function edit_action($penjualan_jasa_id)
  {
    $id = $this->input->post("id");


    $no_spb = substr($this->input->post("no_spb"), 0, 50);

    
    $ket = substr($this->input->post("ket"), 0, 500);

    $from_nama_kota = ($this->input->post("from_nama_kota"));
    $to_nama_kota = ($this->input->post("to_nama_kota"));


    $date_muat = ($this->input->post("date_muat"));
    $date_bongkar = ($this->input->post("date_bongkar"));

    if($date_muat=='')
    {
      $date_muat = date('Y-m-d');
    }


    if($date_bongkar=='')
    {
      $date_bongkar = date('Y-m-d');
    }


    $no_polisi = ($this->input->post("no_polisi"));
    $supir = ($this->input->post("supir"));


    $read_select = $this->m_t_m_d_no_polisi->select_id($no_polisi);
    foreach ($read_select as $key => $value) {
      $no_polisi_id = $value->ID;
    }

    $read_select = $this->m_t_m_d_supir->select_id($supir);
    foreach ($read_select as $key => $value) {
      $supir_id = $value->ID;
    }

    $read_select = $this->m_t_m_d_from_nama_kota->select_id($from_nama_kota);
    foreach ($read_select as $key => $value) {
      $from_nama_kota_id = $value->ID;
    }
    $read_select = $this->m_t_m_d_to_nama_kota->select_id($to_nama_kota);
    foreach ($read_select as $key => $value) {
      $to_nama_kota_id = $value->ID;
    }



    $bruto_kebun = floatval($this->input->post("bruto_kebun"));
    $tara_kebun = floatval($this->input->post("tara_kebun"));

    $value_kebun = $bruto_kebun - $tara_kebun;

    $bruto_pabrik = floatval($this->input->post("bruto_pabrik"));
    $tara_pabrik = floatval($this->input->post("tara_pabrik"));

    $value_pabrik = $bruto_pabrik - $tara_pabrik;


    $value_susut = $value_kebun - $value_pabrik;

    $percentage_susut = (($value_kebun - $value_pabrik)/$value_kebun)*100;


    $toleransi = floatval($this->input->post("toleransi"));


    $toleransi_value = ($toleransi * $value_kebun)/100;


    $claim_susut = $toleransi_value - $value_susut;
    $harga_kebun = floatval($this->input->post("harga_kebun"));
    $harga_pabrik = floatval($this->input->post("harga_pabrik"));


    $sub_total = ($value_kebun*$harga_kebun) + ($value_pabrik*$harga_pabrik);


    $ppn_percentage = floatval($this->input->post("ppn_percentage"));
    $ppn_value = ($ppn_percentage / 100)*$sub_total;


    $data = array(
        'PENJUALAN_JASA_ID' => $penjualan_jasa_id,
        'NO_SPB' => $no_spb,
        'DATE_MUAT' => $date_muat,
        'DATE_BONGKAR' => $date_bongkar,
        'FROM_NAMA_KOTA_ID' => $from_nama_kota_id,
        'TO_NAMA_KOTA_ID' => $to_nama_kota_id,
        'NO_POLISI_ID' => $no_polisi_id,
        'SUPIR_ID' => $supir_id,
        'BRUTO_KEBUN' => $bruto_kebun,
        'TARA_KEBUN' => $tara_kebun,
        'VALUE_KEBUN' => $value_kebun,
        'BRUTO_PABRIK' => $bruto_pabrik,
        'TARA_PABRIK' => $tara_pabrik,
        'VALUE_PABRIK' => $value_pabrik,
        'VALUE_SUSUT' => $value_susut,
        'PERCENTAGE_SUSUT' => $percentage_susut,
        'TOLERANSI' => $toleransi,
        'CLAIM_SUSUT' => $claim_susut,
        'HARGA_KEBUN' => $harga_kebun,
        'HARGA_PABRIK' => $harga_pabrik,
        'SUB_TOTAL' => $sub_total,
        'PPN_PERCENTAGE' => $ppn_percentage,
        'PPN_VALUE' => $ppn_value,

        'COMPANY_ID' => $this->session->userdata('company_id'),
        'MARK_FOR_DELETE' => FALSE,
        'CREATED_BY' => $this->session->userdata('username'),
        'UPDATED_BY' => '',
        'KET' => $ket,
        'TOLERANSI_VALUE' => $toleransi_value
    );

    $this->m_t_t_t_penjualan_jasa_rincian->update($data, $id);
      $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Diupdate!</strong></p></div>');



      $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Ditambahkan!</strong></p></div>');
      redirect('c_t_t_t_penjualan_jasa_rincian/index/' . $penjualan_jasa_id);
    
    

    
    redirect('c_t_t_t_penjualan_jasa_rincian/index/'.$penjualan_jasa_id);
  }








}