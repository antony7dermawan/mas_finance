<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_t_ak_jurnal_edit extends MY_Controller
{
  public function __construct()
  {
    parent::__construct();

    $this->load->model('m_t_ak_jurnal_edit');
    $this->load->model('m_t_ak_jurnal');
    $this->load->model('m_ak_m_coa');
    $this->load->model('m_ak_m_family');
    $this->load->model('m_ak_m_type');
    $this->load->model('m_t_m_d_no_polisi');
    $this->load->model('m_t_m_d_supir');
    $this->load->model('m_t_m_d_from_nama_kota');
    $this->load->model('m_t_m_d_to_nama_kota');
    $this->load->model('m_t_m_d_pelanggan');
    $this->load->model('m_t_m_d_gandengan');
    $this->load->model('m_t_m_d_lokasi');
    $this->load->model('m_t_m_d_payment_method');
  }


  public function index()
  {

    $this->session->set_userdata('t_m_d_gandengan_delete_logic', '0');
    $this->session->set_userdata('t_m_d_pelanggan_delete_logic', '0');
    $this->session->set_userdata('t_m_d_no_polisi_delete_logic', '0');
    $this->session->set_userdata('t_m_d_supir_delete_logic', '0');
    $this->session->set_userdata('t_m_d_from_nama_kota_delete_logic', '0');
    $this->session->set_userdata('t_m_d_to_nama_kota_delete_logic', '0');
    $this->session->set_userdata('t_m_d_lokasi_delete_logic', '0');
    $this->session->set_userdata('t_m_d_payment_method_delete_logic', '0');

    $data = [
      "c_t_m_d_lokasi" => $this->m_t_m_d_lokasi->select(),
      "c_t_m_d_payment_method" => $this->m_t_m_d_payment_method->select(),
      "c_t_m_d_gandengan" => $this->m_t_m_d_gandengan->select(),
      "c_t_m_d_pelanggan" => $this->m_t_m_d_pelanggan->select(),

      "c_t_m_d_from_nama_kota" => $this->m_t_m_d_from_nama_kota->select(),
      "c_t_m_d_to_nama_kota" => $this->m_t_m_d_to_nama_kota->select(),
      "c_t_m_d_no_polisi" => $this->m_t_m_d_no_polisi->select(),
      "c_t_m_d_supir" => $this->m_t_m_d_supir->select(),

      "c_t_ak_jurnal_edit" => $this->m_t_ak_jurnal_edit->select(),
      "no_akun_option" => $this->m_ak_m_coa->select_no_akun(),
      "c_ak_m_family" => $this->m_ak_m_family->select(),
      "c_ak_m_type" => $this->m_ak_m_type->select(),
      "title" => "Edit Transaction",
      "description" => "Editing Mode"
    ];
    $this->render_backend('template/backend/pages/t_ak_jurnal_edit', $data);
  }


  public function delete($id)
  {
    $this->m_t_ak_jurnal_edit->delete($id);
    $this->session->set_flashdata('notif', '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Success!</strong> Data Berhasil DIhapus!</p></div>');
    redirect('/c_t_ak_jurnal_edit');
  }



  function tambah()
  {
    $coa_id = intval($this->input->post("coa_id"));
    $date = ($this->input->post("date"));

    $debit = intval($this->input->post("debit"));
    $kredit = intval($this->input->post("kredit"));
    $catatan = ($this->input->post("catatan"));
    $departemen = ($this->input->post("departemen"));



    $no_spb_pendapatan = substr(($this->input->post("no_spb_pendapatan")), 0, 50);
    $no_invoice_pendapatan = substr(($this->input->post("no_invoice_pendapatan")), 0, 50);
    $no_polisi_id = intval($this->input->post("no_polisi_id"));
    $supir_id = intval($this->input->post("supir_id"));
    $pelanggan_id = intval($this->input->post("pelanggan_id"));
    $gandengan_id = intval($this->input->post("gandengan_id"));
    $from_nama_kota_id = intval($this->input->post("from_nama_kota_id"));
    $to_nama_kota_id = intval($this->input->post("to_nama_kota_id"));

    $lokasi_id = intval($this->input->post("lokasi_id"));
    $payment_method_id = intval($this->input->post("payment_method_id"));


    $date_do = $this->input->post("date_do");
    $date_muat = $this->input->post("date_muat");
    $date_bongkar = $this->input->post("date_bongkar");
    $no_do_pendapatan = substr(($this->input->post("no_do_pendapatan")), 0, 50);
    
    $qty_jurnal = floatval($this->input->post("qty_jurnal"));
    $harga_jurnal = floatval($this->input->post("harga_jurnal"));

    $no_voucer = '';
    $read_select = $this->m_t_ak_jurnal_edit->select();
    foreach ($read_select as $key => $value) {
      if ($key == 0) {
        $no_voucer = $value->NO_VOUCER;
        $company_id = $value->COMPANY_ID;
      }
    }


    $new_id = 0;
    $read_select = $this->m_t_ak_jurnal_edit->select_last_id();
    foreach ($read_select as $key => $value) {
      $new_id = $value->ID + 1;
    }

    $created_id = 0;
    $read_select = $this->m_t_ak_jurnal_edit->select_created_id();
    foreach ($read_select as $key => $value) {
      $created_id = $value->CREATED_ID;

      $time = $value->TIME;
    }

    //Dikiri nama kolom pada database, dikanan hasil yang kita tangkap nama formnya.
    if($created_id != 0)
    {
      $data = array(
        'ID' => $new_id,
        'DATE' => $date,
        'TIME' => $time,
        'CREATED_BY' => $this->session->userdata('username'),
        'UPDATED_BY' => $this->session->userdata('username'),
        'COA_ID' => $coa_id,
        'DEBIT' => $debit,
        'KREDIT' => $kredit,
        'CATATAN' => $catatan,
        'DEPARTEMEN' => $departemen,
        'NO_VOUCER' => $no_voucer,
        'CREATED_ID' => $created_id,
        'CHECKED_ID' => 1,
        'SPECIAL_ID' => 0,
        'COMPANY_ID' => $company_id,
        'NO_SPB_PENDAPATAN' => $no_spb_pendapatan,
        'NO_INVOICE_PENDAPATAN' => $no_invoice_pendapatan,
        'NO_POLISI_ID' => $no_polisi_id,
        'SUPIR_ID' => $supir_id,
        'FROM_NAMA_KOTA_ID' => $from_nama_kota_id,
        'TO_NAMA_KOTA_ID' => $to_nama_kota_id,
        'PELANGGAN_ID' => $pelanggan_id,
        'GANDENGAN_ID' => $gandengan_id,

        'NO_DO_PENDAPATAN' => $no_do_pendapatan,
        'DATE_DO' => $date_do,
        'QTY_JURNAL' => $qty_jurnal,
        'HARGA_JURNAL' => $harga_jurnal,
        'DATE_MUAT' => $date_muat,
        'LOKASI_ID' => $lokasi_id,
        'PAYMENT_METHOD_ID' => $payment_method_id,
        'DATE_BONGKAR' => $date_bongkar
      );

      $this->m_t_ak_jurnal_edit->tambah($data);


      $data = array(
        'DATE' => $date
      );

      $this->m_t_ak_jurnal_edit->update_all($data);


      $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Ditambahkan!</strong></p></div>');
    }


    if($created_id == 0)
    {
      $this->session->set_flashdata('notif', '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Gagal Insert!</strong> Harus Create No Voucer Baru!</p></div>');
    }
    
    redirect('c_t_ak_jurnal_edit');
  }

  function move()
  {

    $read_select = $this->m_t_ak_jurnal_edit->select();
    foreach ($read_select as $key => $value) {
      if ($key == 0) {
        $this->m_t_ak_jurnal->delete_created_id($value->CREATED_ID);
      }
      $data = array(
        'DATE' => $value->DATE,
        'TIME' => $value->TIME,
        'CREATED_BY' => $this->session->userdata('username'),
        'UPDATED_BY' => $this->session->userdata('username'),
        'COA_ID' => $value->COA_ID,
        'DEBIT' => $value->DEBIT,
        'KREDIT' => $value->KREDIT,
        'CATATAN' => $value->CATATAN,
        'DEPARTEMEN' => $value->DEPARTEMEN,
        'NO_VOUCER' => $value->NO_VOUCER,
        'CREATED_ID' => $value->CREATED_ID,
        'CHECKED_ID' => $value->CHECKED_ID,
        'SPECIAL_ID' => $value->SPECIAL_ID,
        'COMPANY_ID' => $value->COMPANY_ID,
        'NO_SPB_PENDAPATAN' => $value->NO_SPB_PENDAPATAN,
        'NO_INVOICE_PENDAPATAN' => $value->NO_INVOICE_PENDAPATAN,
        'NO_POLISI_ID' => $value->NO_POLISI_ID,
        'SUPIR_ID' => $value->SUPIR_ID,
        'FROM_NAMA_KOTA_ID' => $value->FROM_NAMA_KOTA_ID,
        'TO_NAMA_KOTA_ID' => $value->TO_NAMA_KOTA_ID,
        'PELANGGAN_ID' => $value->PELANGGAN_ID,
        'GANDENGAN_ID' => $value->GANDENGAN_ID,
        'NO_DO_PENDAPATAN' => $value->NO_DO_PENDAPATAN,
        'DATE_DO' => $value->DATE_DO,
        'QTY_JURNAL' => $value->QTY_JURNAL,
        'HARGA_JURNAL' => $value->HARGA_JURNAL,
        'DATE_MUAT' => $value->DATE_MUAT,
        'LOKASI_ID' => $value->LOKASI_ID,
        'PAYMENT_METHOD_ID' => $value->PAYMENT_METHOD_ID,
        'DATE_BONGKAR' => $value->DATE_BONGKAR

      );

      $this->m_t_ak_jurnal->tambah($data);
      $this->update_coa_saldo($value->COA_ID);
      $this->m_t_ak_jurnal_edit->delete($value->ID);
    }
    redirect('c_t_ak_jurnal');
  }

  public function update_coa_saldo($coa_id)
  {
    $read_select = $this->m_ak_m_coa->select_coa_id($coa_id);
    foreach ($read_select as $key => $value) {
      $sum_kredit = 0;
      $sum_debit = 0;

      $read_select_1 = $this->m_t_ak_jurnal->select_sum_kredit_detail($coa_id);
      foreach ($read_select_1 as $key_1 => $value_1) {
        $sum_kredit = $value_1->KREDIT;
      }
      $read_select_1 = $this->m_t_ak_jurnal->select_sum_debit_detail($coa_id);
      foreach ($read_select_1 as $key_1 => $value_1) {
        $sum_debit = $value_1->DEBIT;
      }




      if ($value->DB_K_ID == 1) {
        $saldo = $sum_debit - $sum_kredit;
      }
      if ($value->DB_K_ID == 2) {
        $saldo = $sum_kredit - $sum_debit;
      }


      $data = array(
        'SALDO' => $saldo
      );
      $this->m_ak_m_coa->update($data, $coa_id);

      if ($value->NO_AKUN_2 != '' and $value->NO_AKUN_1 != '' and $value->NO_AKUN_3 != '') {
        $read_select_1 = $this->m_ak_m_coa->select_sum_saldo_no_akun_3($value->NO_AKUN_2);
        foreach ($read_select_1 as $key_1 => $value_1) {
          $sum_saldo_parent_2 = $value_1->SALDO;
        }
        $data = array(
          'SALDO' => $sum_saldo_parent_2
        );
        $this->m_ak_m_coa->update_saldo_parent_2($data, $value->NO_AKUN_2);

        $read_select_1 = $this->m_ak_m_coa->select_sum_saldo_no_akun_2($value->NO_AKUN_1);
        foreach ($read_select_1 as $key_1 => $value_1) {
          $sum_saldo_parent_1 = $value_1->SALDO;
        }
        $data = array(
          'SALDO' => $sum_saldo_parent_1
        );
        $this->m_ak_m_coa->update_saldo_parent_1($data, $value->NO_AKUN_1);
      }

      if ($value->NO_AKUN_1 != '' and $value->NO_AKUN_2 == '' and $value->NO_AKUN_3 != '') {
        $read_select_1 = $this->m_ak_m_coa->select_sum_saldo_no_akun_4($value->NO_AKUN_1);
        foreach ($read_select_1 as $key_1 => $value_1) {
          $sum_saldo_parent_1 = $value_1->SALDO;
        }
        $data = array(
          'SALDO' => $sum_saldo_parent_1
        );
        $this->m_ak_m_coa->update_saldo_parent_1($data, $value->NO_AKUN_1);
      }

      if ($value->NO_AKUN_1 != '' and $value->NO_AKUN_2 != '' and $value->NO_AKUN_3 == '') {
        $read_select_1 = $this->m_ak_m_coa->select_sum_saldo_no_akun_5($value->NO_AKUN_1);
        foreach ($read_select_1 as $key_1 => $value_1) {
          $sum_saldo_parent_1 = $value_1->SALDO;
        }
        $data = array(
          'SALDO' => $sum_saldo_parent_1
        );
        $this->m_ak_m_coa->update_saldo_parent_1($data, $value->NO_AKUN_1);
      }
    }
  }



  public function edit_action()
  {
    $id = $this->input->post("id");

    $date = $this->input->post("date");
    $debit = intval($this->input->post("debit"));
    $kredit = intval($this->input->post("kredit"));
    $catatan = ($this->input->post("catatan"));
    $departemen = ($this->input->post("departemen"));
    $no_spb_pendapatan = substr(($this->input->post("no_spb_pendapatan")), 0, 50);
    $no_invoice_pendapatan = substr(($this->input->post("no_invoice_pendapatan")), 0, 50);

    $no_voucer = ($this->input->post("no_voucer"));

    $no_polisi = ($this->input->post("no_polisi"));
    $supir = ($this->input->post("supir"));
    $pelanggan = ($this->input->post("pelanggan"));
    $gandengan = ($this->input->post("gandengan"));
    $from_nama_kota = ($this->input->post("from_nama_kota"));
    $to_nama_kota = ($this->input->post("to_nama_kota"));


    $lokasi = ($this->input->post("lokasi"));
    $payment_method = ($this->input->post("payment_method"));


    $date_do = $this->input->post("date_do");
    $date_muat = $this->input->post("date_muat");
    $date_bongkar = $this->input->post("date_bongkar");
    $no_do_pendapatan = substr(($this->input->post("no_do_pendapatan")), 0, 50);
    
    $qty_jurnal = floatval($this->input->post("qty_jurnal"));
    $harga_jurnal = floatval($this->input->post("harga_jurnal"));


    //$lokasi_id = 0;
    $read_select = $this->m_t_m_d_lokasi->select_id($lokasi);
    foreach ($read_select as $key => $value) {
      $lokasi_id = $value->ID;
    }


    //$payment_method_id = 0;
    $read_select = $this->m_t_m_d_payment_method->select_id($payment_method);
    foreach ($read_select as $key => $value) {
      $payment_method_id = $value->ID;
    }




 
    $read_select = $this->m_t_m_d_no_polisi->select_id($no_polisi);
    foreach ($read_select as $key => $value) {
      $no_polisi_id = $value->ID;
    }

    $read_select = $this->m_t_m_d_supir->select_id($supir);
    foreach ($read_select as $key => $value) {
      $supir_id = $value->ID;
    }

    $read_select = $this->m_t_m_d_pelanggan->select_id($pelanggan);
    foreach ($read_select as $key => $value) {
      $pelanggan_id = $value->ID;
    }

    $read_select = $this->m_t_m_d_gandengan->select_id($gandengan);
    foreach ($read_select as $key => $value) {
      $gandengan_id = $value->ID;
    }
    $read_select = $this->m_t_m_d_from_nama_kota->select_id($from_nama_kota);
    foreach ($read_select as $key => $value) {
      $from_nama_kota_id = $value->ID;
    }
    $read_select = $this->m_t_m_d_to_nama_kota->select_id($to_nama_kota);
    foreach ($read_select as $key => $value) {
      $to_nama_kota_id = $value->ID;
    }


    //Dikiri nama kolom pada database, dikanan hasil yang kita tangkap nama formnya.
    $data = array(
      'UPDATED_BY' => $this->session->userdata('username'),
      'DEBIT' => $debit,
      'KREDIT' => $kredit,
      'CATATAN' => $catatan,
      'DEPARTEMEN' => $departemen,
      'NO_SPB_PENDAPATAN' => $no_spb_pendapatan,
      'NO_INVOICE_PENDAPATAN' => $no_invoice_pendapatan,
      'NO_POLISI_ID' => $no_polisi_id,
      'SUPIR_ID' => $supir_id,
      'FROM_NAMA_KOTA_ID' => $from_nama_kota_id,
      'TO_NAMA_KOTA_ID' => $to_nama_kota_id,
      'PELANGGAN_ID' => $pelanggan_id,
      'GANDENGAN_ID' => $gandengan_id,

      'NO_DO_PENDAPATAN' => $no_do_pendapatan,
      'DATE_DO' => $date_do,
      'QTY_JURNAL' => $qty_jurnal,
      'HARGA_JURNAL' => $harga_jurnal,
      'DATE_MUAT' => $date_muat,
      'LOKASI_ID' => $lokasi_id,
      'PAYMENT_METHOD_ID' => $payment_method_id,
      'DATE_BONGKAR' => $date_bongkar
    );

    $this->m_t_ak_jurnal_edit->update($data, $id);


    $data = array(
        'DATE' => $date,
        'NO_VOUCER' => $no_voucer
    );
    $this->m_t_ak_jurnal_edit->update_all($data);


    $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Diupdate!</strong></p></div>');
    redirect('/c_t_ak_jurnal_edit');
  }
}
