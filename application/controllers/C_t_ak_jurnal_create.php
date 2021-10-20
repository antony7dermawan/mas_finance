<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_t_ak_jurnal_create extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('m_t_ak_jurnal_create');
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
  }

  public function index()
  {

    $this->session->set_userdata('t_m_d_gandengan_delete_logic', '0');
    $this->session->set_userdata('t_m_d_pelanggan_delete_logic', '0');
    $this->session->set_userdata('t_m_d_no_polisi_delete_logic', '0');
    $this->session->set_userdata('t_m_d_supir_delete_logic', '0');
    $this->session->set_userdata('t_m_d_from_nama_kota_delete_logic', '0');
    $this->session->set_userdata('t_m_d_to_nama_kota_delete_logic', '0');

    $ada_data = '';
    $read_select = $this->m_t_ak_jurnal_create->select();
    foreach ($read_select as $key => $value) {
      $ada_data = $value->ID;
    }
    if ($ada_data == '') {
      $this->read_no_voucer();
    }


    $data = [

      "c_t_m_d_gandengan" => $this->m_t_m_d_gandengan->select(),
      "c_t_m_d_pelanggan" => $this->m_t_m_d_pelanggan->select(),

      "c_t_m_d_from_nama_kota" => $this->m_t_m_d_from_nama_kota->select(),
      "c_t_m_d_to_nama_kota" => $this->m_t_m_d_to_nama_kota->select(),
      "c_t_m_d_no_polisi" => $this->m_t_m_d_no_polisi->select(),
      "c_t_m_d_supir" => $this->m_t_m_d_supir->select(),
      "c_t_ak_jurnal_create" => $this->m_t_ak_jurnal_create->select(),
      "no_akun_option" => $this->m_ak_m_coa->select_no_akun(),
      "c_ak_m_family" => $this->m_ak_m_family->select(),
      "c_ak_m_type" => $this->m_ak_m_type->select(),
      "title" => "Create No Voucer Baru",
      "description" => "Harus isi nomor voucer dulu"
    ];
    $this->render_backend('template/backend/pages/t_ak_jurnal_create', $data);
  }

  public function create_no_voucer()
  {
    $no_voucer_textbox = ($this->input->post("no_voucer_textbox"));

    $this->session->set_userdata('now_no_voucer', $no_voucer_textbox);

    $data = array(
      'NO_VOUCER' => $this->session->userdata('now_no_voucer')
    );

    $this->m_t_ak_jurnal_create->update_all($data, $id);

    redirect('c_t_ak_jurnal_create');
  }


  public function read_no_voucer()
  {
    $read_last_no_voucer = '';
    $read_select = $this->m_t_ak_jurnal->select_no_voucer();
    foreach ($read_select as $key => $value) {
      $read_last_no_voucer = $value->NO_VOUCER;
    }
    $last_no_voucer = intval(substr($read_last_no_voucer, -4)) + 1;

    $now_no_voucer = substr($read_last_no_voucer, 0, -4) . sprintf('%04d', $last_no_voucer);
    $this->session->set_userdata('now_no_voucer_keep', $now_no_voucer);
  }

  public function delete($id)
  {
    $this->m_t_ak_jurnal_create->delete($id);
    $this->session->set_flashdata('notif', '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Success!</strong> Data Berhasil DIhapus!</p></div>');
    redirect('/c_t_ak_jurnal_create');
  }



  function tambah()
  {

    $date_jurnal_create = ($this->input->post("date"));
    $this->session->set_userdata('date_jurnal_create', $date_jurnal_create);


    $coa_id = intval($this->input->post("coa_id"));


    $debit = intval($this->input->post("debit"));
    $kredit = intval($this->input->post("kredit"));
    $catatan = substr(($this->input->post("catatan")), 0, 200);
    $departemen = substr(($this->input->post("departemen")), 0, 50);
    $no_voucer = $this->session->userdata('now_no_voucer');
    $date = $this->input->post("date");

    $no_spb_pendapatan = substr(($this->input->post("no_spb_pendapatan")), 0, 50);
    $no_invoice_pendapatan = substr(($this->input->post("no_invoice_pendapatan")), 0, 50);
    $no_polisi_id = intval($this->input->post("no_polisi_id"));
    $supir_id = intval($this->input->post("supir_id"));
    $pelanggan_id = intval($this->input->post("pelanggan_id"));
    $gandengan_id = intval($this->input->post("gandengan_id"));
    $from_nama_kota_id = intval($this->input->post("from_nama_kota_id"));
    $to_nama_kota_id = intval($this->input->post("to_nama_kota_id"));



    $read_select = $this->m_t_ak_jurnal_create->select();
    foreach ($read_select as $key => $value) {
      if ($key == 0) {
        $no_voucer = $value->NO_VOUCER;
        $this->session->set_userdata('now_no_voucer_keep', $no_voucer);
      }
    }


    if ($no_voucer != '') 
    {
      $data = array(
        'DATE' => $date,
        'TIME' => date('H:i:s'),
        'CREATED_BY' => $this->session->userdata('username'),
        'UPDATED_BY' => '',
        'COA_ID' => $coa_id,
        'DEBIT' => $debit,
        'KREDIT' => $kredit,
        'CATATAN' => $catatan,
        'DEPARTEMEN' => $departemen,
        'NO_VOUCER' => $no_voucer,

        'NO_SPB_PENDAPATAN' => $no_spb_pendapatan,
        'NO_INVOICE_PENDAPATAN' => $no_invoice_pendapatan,
        'NO_POLISI_ID' => $no_polisi_id,
        'SUPIR_ID' => $supir_id,
        'FROM_NAMA_KOTA_ID' => $from_nama_kota_id,
        'TO_NAMA_KOTA_ID' => $to_nama_kota_id,
        'PELANGGAN_ID' => $pelanggan_id,
        'GANDENGAN_ID' => $gandengan_id

      );

      $this->m_t_ak_jurnal_create->tambah($data);



      $data = array(
        'DATE' => $date
      );

      $this->m_t_ak_jurnal_create->update_all($data);




      $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Ditambahkan!</strong></p></div>');
    }
    if ($no_voucer == '') {
      $this->session->set_flashdata('notif', '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>GAGAL!</strong> NO VOUCER BELUM DIISI!</p></div>');
    }

    redirect('c_t_ak_jurnal_create');
  }

  function move()
  {
    $this->session->set_userdata('now_no_voucer', '');
    $read_select = $this->m_t_ak_jurnal_create->select();
    foreach ($read_select as $key => $value) {
      if ($key == 0) {
        $created_id = strtotime(date('Y-m-d H:i:s'));
      }
      $data = array(
        'DATE' => $value->DATE,
        'TIME' => $value->TIME,
        'CREATED_BY' => $this->session->userdata('username'),
        'UPDATED_BY' => '',
        'COA_ID' => $value->COA_ID,
        'DEBIT' => $value->DEBIT,
        'KREDIT' => $value->KREDIT,
        'CATATAN' => $value->CATATAN,
        'DEPARTEMEN' => $value->DEPARTEMEN,
        'NO_VOUCER' => $value->NO_VOUCER,
        'CREATED_ID' => $created_id,
        'CHECKED_ID' => 1,
        'SPECIAL_ID' => 0,
        'COMPANY_ID' => $this->session->userdata('company_id'),
        'NO_SPB_PENDAPATAN' => $value->NO_SPB_PENDAPATAN,
        'NO_INVOICE_PENDAPATAN' => $value->NO_INVOICE_PENDAPATAN,
        'NO_POLISI_ID' => $value->NO_POLISI_ID,
        'SUPIR_ID' => $value->SUPIR_ID,
        'FROM_NAMA_KOTA_ID' => $value->FROM_NAMA_KOTA_ID,
        'TO_NAMA_KOTA_ID' => $value->TO_NAMA_KOTA_ID,
        'PELANGGAN_ID' => $value->PELANGGAN_ID,
        'GANDENGAN_ID' => $value->GANDENGAN_ID

      );

      $this->m_t_ak_jurnal->tambah($data);
      $this->update_coa_saldo($value->COA_ID);
      $this->m_t_ak_jurnal_create->delete($value->ID);
    }
    redirect('c_t_ak_jurnal_create');
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
      'TIME' => date('H:i:s'),
      'UPDATED_BY' => $this->session->userdata('username'),
      'DEBIT' => $debit,
      'KREDIT' => $kredit,
      'CATATAN' => $catatan,
      'DEPARTEMEN' => $departemen,
      'DATE' => $date,

      'NO_SPB_PENDAPATAN' => $no_spb_pendapatan,
      'NO_INVOICE_PENDAPATAN' => $no_invoice_pendapatan,
      'NO_POLISI_ID' => $no_polisi_id,
      'SUPIR_ID' => $supir_id,
      'FROM_NAMA_KOTA_ID' => $from_nama_kota_id,
      'TO_NAMA_KOTA_ID' => $to_nama_kota_id,
      'PELANGGAN_ID' => $pelanggan_id,
      'GANDENGAN_ID' => $gandengan_id

    );

    $this->m_t_ak_jurnal_create->update($data, $id);


    $data = array(
      'DATE' => $date,
      'NO_VOUCER' => $no_voucer
    );

    $this->session->set_userdata('now_no_voucer_keep', $no_voucer);

    $this->m_t_ak_jurnal_create->update_all($data);

    $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Diupdate!</strong></p></div>');
    redirect('/c_t_ak_jurnal_create');
  }
}
