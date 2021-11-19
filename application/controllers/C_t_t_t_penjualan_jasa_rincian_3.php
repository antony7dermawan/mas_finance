<?php
defined('BASEPATH') or exit('No direct script access allowed');


class C_t_t_t_penjualan_jasa_rincian_3 extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('m_t_t_t_penjualan_jasa_2');

    $this->load->model('m_t_t_t_penjualan_jasa_rincian_3'); 

    
    $this->load->model('m_t_m_d_satuan');
    $this->load->model('m_t_m_d_company');
    $this->load->model('m_t_m_d_petak');


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
    $this->session->set_userdata('t_m_d_petak_delete_logic', '0');
    $this->session->set_userdata('t_m_d_from_nama_kota_delete_logic', '0');
    $this->session->set_userdata('t_m_d_to_nama_kota_delete_logic', '0');


    $data = [
      //"select_barang_with_supplier" => $this->m_t_t_t_pembelian_rincian->select_barang_with_supplier(),
      "c_t_t_t_penjualan_jasa_rincian_3" => $this->m_t_t_t_penjualan_jasa_rincian_3->select($penjualan_jasa_id),

      "c_t_t_t_penjualan_jasa_by_id" => $this->m_t_t_t_penjualan_jasa_2->select_by_id($penjualan_jasa_id),


      "c_t_m_d_from_nama_kota" => $this->m_t_m_d_from_nama_kota->select(),
      "c_t_m_d_to_nama_kota" => $this->m_t_m_d_to_nama_kota->select(),
      "c_t_m_d_no_polisi" => $this->m_t_m_d_no_polisi->select(),
      "c_t_m_d_supir" => $this->m_t_m_d_supir->select(),
      "c_t_m_d_petak" => $this->m_t_m_d_petak->select(),

      "penjualan_jasa_id" => $penjualan_jasa_id,
      "title" => "Rincian Nomor SPB / Nomor Faktur",
      "description" => ""
    ];
    $this->render_backend('template/backend/pages/t_t_t_penjualan_jasa_rincian_3', $data);
  }



  public function delete($id,$penjualan_jasa_id)
  {
    $data = array(
        'UPDATED_BY' => $this->session->userdata('username'),
        'MARK_FOR_DELETE' => TRUE
    );
    $this->m_t_t_t_penjualan_jasa_rincian_3->update($data, $id);



    $this->session->set_flashdata('notif', '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Success!</strong> Data Berhasil DIhapus!</p></div>');

    redirect('c_t_t_t_penjualan_jasa_rincian_3/index/' . $penjualan_jasa_id);
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



  
    
    $no_petak = substr($this->input->post("no_petak"), 0, 50);
    $petak_id = intval($this->input->post("petak_id"));
    $bruto_kayu = floatval($this->input->post("bruto_kayu"));
    $tara_kayu = floatval($this->input->post("tara_kayu"));
    $tonase = $bruto_kayu - $tara_kayu;
    $pinalty_1 = floatval($this->input->post("pinalty_1"));
    $pinalty_2 = floatval($this->input->post("pinalty_2"));
    $neto_1 = floatval($this->input->post("neto_1"));
    $neto_2 = floatval($this->input->post("neto_2"));
    $harga_kayu = floatval($this->input->post("harga_kayu"));


    $sub_total = ($tonase*$harga_kayu) ;


    $ppn_percentage = floatval($this->input->post("ppn_percentage"));
    $ppn_value = ($ppn_percentage / 100)*$sub_total;



    $jarak_km = floatval($this->input->post("jarak_km"));


    $data = array(
        'PENJUALAN_JASA_ID' => $penjualan_jasa_id,
        'NO_SPB' => $no_spb,
        'DATE_MUAT' => $date_muat,
        'DATE_BONGKAR' => $date_bongkar,
        'FROM_NAMA_KOTA_ID' => $from_nama_kota_id,
        'TO_NAMA_KOTA_ID' => $to_nama_kota_id,
        'NO_POLISI_ID' => $no_polisi_id,
        'SUPIR_ID' => $supir_id,
        
        'NO_PETAK' => $no_petak,
        'PETAK_ID' => $petak_id,
        'BRUTO_KAYU' => $bruto_kayu,
        'TARA_KAYU' => $tara_kayu,
        'TONASE' => $tonase,
        'PINALTY_1' => $pinalty_1,
        'PINALTY_2' => $pinalty_2,
        'NETO_1' => $neto_1,
        'NETO_2' => $neto_2,
        'HARGA_KAYU' => $harga_kayu,

        'SUB_TOTAL' => $sub_total,
        'PPN_PERCENTAGE' => $ppn_percentage,
        'PPN_VALUE' => $ppn_value,

        'COMPANY_ID' => $this->session->userdata('company_id'),
        'MARK_FOR_DELETE' => FALSE,
        'CREATED_BY' => $this->session->userdata('username'),
        'UPDATED_BY' => '',
        'KET' => $ket,
        'TOLERANSI_VALUE' => $toleransi_value,
        'JARAK_KM' => $jarak_km,
        'ENABLE_EDIT' => 1
    );

    $this->m_t_t_t_penjualan_jasa_rincian_3->tambah($data);



      $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Ditambahkan!</strong></p></div>');
      redirect('c_t_t_t_penjualan_jasa_rincian_3/index/' . $penjualan_jasa_id);
    
    

    
    redirect('c_t_t_t_penjualan_jasa_rincian_3/index/'.$penjualan_jasa_id);
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

    $no_polisi_id = 0;
    $read_select = $this->m_t_m_d_no_polisi->select_id($no_polisi);
    foreach ($read_select as $key => $value) {
      $no_polisi_id = $value->ID;
    }

    $supir_id = 0;
    $read_select = $this->m_t_m_d_supir->select_id($supir);
    foreach ($read_select as $key => $value) {
      $supir_id = $value->ID;
    }

    $from_nama_kota_id = 0;
    $read_select = $this->m_t_m_d_from_nama_kota->select_id($from_nama_kota);
    foreach ($read_select as $key => $value) {
      $from_nama_kota_id = $value->ID;
    }
    $to_nama_kota_id = 0;
    $read_select = $this->m_t_m_d_to_nama_kota->select_id($to_nama_kota);
    foreach ($read_select as $key => $value) {
      $to_nama_kota_id = $value->ID;
    }



    $petak_id = 0;
    $petak = intval($this->input->post("petak"));
    $read_select = $this->m_t_m_d_petak->select_id($petak);
    foreach ($read_select as $key => $value) {
      $petak_id = $value->ID;
    }
  
    $no_petak = substr($this->input->post("no_petak"), 0, 50);
    
    $bruto_kayu = floatval($this->input->post("bruto_kayu"));
    $tara_kayu = floatval($this->input->post("tara_kayu"));
    $tonase = $bruto_kayu - $tara_kayu;
    $pinalty_1 = floatval($this->input->post("pinalty_1"));
    $pinalty_2 = floatval($this->input->post("pinalty_2"));
    $neto_1 = floatval($this->input->post("neto_1"));
    $neto_2 = floatval($this->input->post("neto_2"));
    $harga_kayu = floatval($this->input->post("harga_kayu"));


    $sub_total = ($tonase*$harga_kayu) ;



    $ppn_percentage = floatval($this->input->post("ppn_percentage"));
    $ppn_value = ($ppn_percentage / 100)*$sub_total;


    
    $jarak_km = floatval($this->input->post("jarak_km"));

    $data = array(
        'PENJUALAN_JASA_ID' => $penjualan_jasa_id,
        'NO_SPB' => $no_spb,
        'DATE_MUAT' => $date_muat,
        'DATE_BONGKAR' => $date_bongkar,
        'FROM_NAMA_KOTA_ID' => $from_nama_kota_id,
        'TO_NAMA_KOTA_ID' => $to_nama_kota_id,
        'NO_POLISI_ID' => $no_polisi_id,
        'SUPIR_ID' => $supir_id,
        
        'NO_PETAK' => $no_petak,
        'PETAK_ID' => $petak_id,
        'BRUTO_KAYU' => $bruto_kayu,
        'TARA_KAYU' => $tara_kayu,
        'TONASE' => $tonase,
        'PINALTY_1' => $pinalty_1,
        'PINALTY_2' => $pinalty_2,
        'NETO_1' => $neto_1,
        'NETO_2' => $neto_2,
        'HARGA_KAYU' => $harga_kayu,


        'SUB_TOTAL' => $sub_total,
        'PPN_PERCENTAGE' => $ppn_percentage,
        'PPN_VALUE' => $ppn_value,

        'COMPANY_ID' => $this->session->userdata('company_id'),
        'MARK_FOR_DELETE' => FALSE,
        'CREATED_BY' => $this->session->userdata('username'),
        'UPDATED_BY' => '',
        'KET' => $ket,
        'TOLERANSI_VALUE' => $toleransi_value,
        'JARAK_KM' => $jarak_km
    );

    $this->m_t_t_t_penjualan_jasa_rincian_3->update($data, $id);
      $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Diupdate!</strong></p></div>');



      $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Ditambahkan!</strong></p></div>');
      redirect('c_t_t_t_penjualan_jasa_rincian_3/index/' . $penjualan_jasa_id);
    
    

    
    redirect('c_t_t_t_penjualan_jasa_rincian_3/index/'.$penjualan_jasa_id);
  }


}