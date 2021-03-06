<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_t_t_t_pengeluaran_rincian extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('m_t_t_t_pengeluaran_rincian');
    $this->load->model('m_t_t_t_penjualan_jasa_rincian_1');
    $this->load->model('m_t_t_t_penjualan_jasa_1');
    $this->load->model('m_t_t_t_penjualan_jasa_rincian_3');
    $this->load->model('m_t_t_t_penjualan_jasa_3');
    $this->load->model('m_t_ak_jurnal');
    
    $this->load->model('m_ak_m_coa');
    $this->load->model('m_t_m_d_company');
  }

  public function index($penjualan_jasa_rincian_id,$penjualan_jasa_id)
  {
    $this->session->set_userdata('t_t_t_pengeluaran_rincian_delete_logic', '1');


    $data = [
      "c_t_t_t_pengeluaran_rincian" => $this->m_t_t_t_pengeluaran_rincian->select($penjualan_jasa_rincian_id),

      "c_t_t_t_penjualan_jasa_rincian_by_id" => $this->m_t_t_t_penjualan_jasa_rincian_1->select_by_id($penjualan_jasa_rincian_id),

      "c_t_t_t_penjualan_jasa_by_id" => $this->m_t_t_t_penjualan_jasa_1->select_by_id($penjualan_jasa_id),

      "no_akun_option" => $this->m_ak_m_coa->select_no_akun(),

      "penjualan_jasa_id" => $penjualan_jasa_id,
      "penjualan_jasa_rincian_id" => $penjualan_jasa_rincian_id,
      "title" => "Transaksi Pinjaman",
      "description" => "Input semua tunjangan disini"
    ];
    $this->render_backend('template/backend/pages/t_t_t_pengeluaran_rincian', $data);
  }



  public function delete($id,$penjualan_jasa_rincian_id,$penjualan_jasa_id)
  {
    $data = array(
        'UPDATED_BY' => $this->session->userdata('username'),
        'MARK_FOR_DELETE' => TRUE
    );
    $this->m_t_t_t_pengeluaran_rincian->update($data, $id);

    $read_select = $this->m_t_t_t_pengeluaran_rincian->select_by_id($id);
    foreach ($read_select as $key => $value) 
    {
      $no_voucer=$value->NO_VOUCER;
    }
    $this->m_t_ak_jurnal->delete_no_voucer($no_voucer);


    $this->session->set_flashdata('notif', '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Success!</strong> Data Berhasil DIhapus!</p></div>');


    redirect('c_t_t_t_pengeluaran_rincian/index/'.$penjualan_jasa_rincian_id.'/'.$penjualan_jasa_id);
  }







  function tambah($penjualan_jasa_rincian_id,$penjualan_jasa_id)
  {
    
    $coa_id_pengeluaran = intval($this->input->post("coa_id_pengeluaran"));

    $date = $this->input->post("date");
    $nilai_pengeluaran = floatval($this->input->post("value"));

    $coa_id = intval($this->input->post("coa_id"));

    if($date=='')
    {
      $date= date('Y-m-d');
    }

    

    $no_voucer = substr($this->input->post("no_voucer"), 0, 50);

    $no_voucer_logic = 0;
    $read_select = $this->m_t_ak_jurnal->select_where_no_voucer($no_voucer);
    foreach ($read_select as $key => $value) {
      $no_voucer_logic = 1;
      $this->session->set_flashdata('notif', '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Gagal!</strong> Nomor Voucer Sudah Digunakan!</p></div>');
    }


    $ket = substr($this->input->post("ket"), 0, 500);
    
 


    $created_id = strtotime(date('Y-m-d H:i:s'));

  
    $time_move = date('H:i:s');

    $minute_send = intval(substr(strtotime(date('H:i:s')), -5));
    if($date!=date('Y-m-d'))
    {
      $time_move = '23:59:00.'.$minute_send;
    }



    $read_select = $this->m_t_t_t_penjualan_jasa_3->select_by_id($penjualan_jasa_id);
    foreach ($read_select as $key => $value) 
    {
      $date_do=$value->DATE;
      $no_do_pendapatan=$value->NO_DO;
      $payment_method_id=$value->PAYMENT_METHOD_ID;
      $pelanggan_id=$value->PELANGGAN_ID;
    }

    $read_select = $this->m_t_t_t_penjualan_jasa_rincian_3->select_by_id($penjualan_jasa_rincian_id);
    foreach ($read_select as $key => $value) 
    {
      $no_spb_pendapatan=$value->NO_SPB;
      $no_polisi_id=$value->NO_POLISI_ID;
      $supir_id=$value->SUPIR_ID;
      $from_nama_kota_id=$value->FROM_NAMA_KOTA_ID;
      $to_nama_kota_id=$value->TO_NAMA_KOTA_ID;
      
      $gandengan_id=0;
      $date_muat=$value->DATE_MUAT;
      $date_bongkar=$value->DATE_BONGKAR;
    }


    if($no_voucer_logic == 0)
    {
        $data = array(
            'DATE' => $date,
            'TIME' => $time_move,
            'CREATED_BY' => $this->session->userdata('username'),
            'UPDATED_BY' => '',
            'COA_ID' => $coa_id,
            'DEBIT' => 0,
            'KREDIT' => floatval($nilai_pengeluaran),
            'CATATAN' => $ket,
            'DEPARTEMEN' => '',
            'NO_VOUCER' => $no_voucer,
            'CREATED_ID' => $created_id,
            'CHECKED_ID' => 1,
            'SPECIAL_ID' => 0,
            'COMPANY_ID' => $this->session->userdata('company_id'),
            'NO_SPB_PENDAPATAN' => $no_spb_pendapatan,
            'NO_INVOICE_PENDAPATAN' => '',
            'NO_POLISI_ID' => $no_polisi_id,
            'SUPIR_ID' => $supir_id,
            'FROM_NAMA_KOTA_ID' => $from_nama_kota_id,
            'TO_NAMA_KOTA_ID' => $to_nama_kota_id,
            'PELANGGAN_ID' => $pelanggan_id,
            'GANDENGAN_ID' => $gandengan_id,
            'NO_DO_PENDAPATAN' => $no_do_pendapatan,
            'DATE_DO' => $date_do,
            'QTY_JURNAL' => 0,
            'HARGA_JURNAL' => 0,
            'DATE_MUAT' => $date_muat,
            'LOKASI_ID' => 0,
            'PAYMENT_METHOD_ID' => $payment_method_id,
            'DATE_BONGKAR' => $date_bongkar

        );
        $this->m_t_ak_jurnal->tambah($data);

        $data = array(
            'DATE' => $date,
            'TIME' => $time_move,
            'CREATED_BY' => $this->session->userdata('username'),
            'UPDATED_BY' => '',
            'COA_ID' => $coa_id_pengeluaran,
            'DEBIT' => floatval($nilai_pengeluaran),
            'KREDIT' => 0,
            'CATATAN' => $ket,
            'DEPARTEMEN' => '',
            'NO_VOUCER' => $no_voucer,
            'CREATED_ID' => $created_id,
            'CHECKED_ID' => 1,
            'SPECIAL_ID' => 0,
            'COMPANY_ID' => $this->session->userdata('company_id'),
            'NO_SPB_PENDAPATAN' => $no_spb_pendapatan,
            'NO_INVOICE_PENDAPATAN' => '',
            'NO_POLISI_ID' => $no_polisi_id,
            'SUPIR_ID' => $supir_id,
            'FROM_NAMA_KOTA_ID' => $from_nama_kota_id,
            'TO_NAMA_KOTA_ID' => $to_nama_kota_id,
            'PELANGGAN_ID' => $pelanggan_id,
            'GANDENGAN_ID' => $gandengan_id,
            'NO_DO_PENDAPATAN' => $no_do_pendapatan,
            'DATE_DO' => $date_do,
            'QTY_JURNAL' => 0,
            'HARGA_JURNAL' => 0,
            'DATE_MUAT' => $date_muat,
            'LOKASI_ID' => 0,
            'PAYMENT_METHOD_ID' => $payment_method_id,
            'DATE_BONGKAR' => $date_bongkar
        );
        $this->m_t_ak_jurnal->tambah($data);

        //Dikiri nama kolom pada database, dikanan hasil yang kita tangkap nama formnya.
        $data = array(

          'DATE' => $date,
          'TIME' => $time_move,
          'COA_ID' => $coa_id,
          'COA_ID_PENGELUARAN' => $coa_id_pengeluaran,

          'KET' => $ket,

          'VALUE' => $nilai_pengeluaran,

          'CREATED_BY' => $this->session->userdata('username'),
          'UPDATED_BY' => '',
          'MARK_FOR_DELETE' => FALSE,
          
          'NO_VOUCER' => $no_voucer,
          'PENJUALAN_JASA_RINCIAN_ID' => $penjualan_jasa_rincian_id
        );

        $this->m_t_t_t_pengeluaran_rincian->tambah($data);

        $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Ditambahkan!</strong></p></div>');
    }

    
    


    redirect('c_t_t_t_pengeluaran_rincian/index/'.$penjualan_jasa_rincian_id.'/'.$penjualan_jasa_id);
  }





}
