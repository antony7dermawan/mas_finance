<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_t_ak_jurnal extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('m_t_ak_jurnal');
    $this->load->model('m_t_ak_jurnal_edit');
    $this->load->model('m_ak_m_coa');
    $this->load->model('m_ak_m_family');
    $this->load->model('m_ak_m_type');
  }


  public function index()
  {

    if($this->session->userdata('date_from_select_jurnal')=='')
    {
      $date_from_select_jurnal = date('Y-m-d');
      $this->session->set_userdata('date_from_select_jurnal', $date_from_select_jurnal);
    }

    if($this->session->userdata('date_to_select_jurnal')=='')
    {
      $date_to_select_jurnal = date('Y-m-d');
      $this->session->set_userdata('date_to_select_jurnal', $date_to_select_jurnal);
    }


    $this->m_t_ak_jurnal->delete_created_by();
    $data = [
      "c_t_ak_jurnal" => $this->m_t_ak_jurnal->select($this->session->userdata('date_from_select_jurnal'), $this->session->userdata('date_to_select_jurnal')),
      "no_akun_option" => $this->m_ak_m_coa->select_no_akun(),
      "c_ak_m_family" => $this->m_ak_m_family->select(),
      "c_ak_m_type" => $this->m_ak_m_type->select(),
      "title" => "Transaksi Jurnal",
      "description" => ""
    ];
    $this->render_backend('template/backend/pages/t_ak_jurnal', $data);
  }

  public function search_date()
  {

    $date_from_select_jurnal = ($this->input->post("date_from_select_jurnal"));
    $this->session->set_userdata('date_from_select_jurnal', $date_from_select_jurnal);

    $date_to_select_jurnal = ($this->input->post("date_to_select_jurnal"));
    $this->session->set_userdata('date_to_select_jurnal', $date_to_select_jurnal);




    $date1 = strtotime($date_from_select_jurnal);
    $date2 = strtotime($date_to_select_jurnal);

    $hourDiff=round(abs($date2 - $date1) / (60*60*24),0);

    if($hourDiff>=10)
    {
      $date_before = date('Y-m-d',(strtotime ( '-10 day' , strtotime ( $date_to_select_jurnal) ) ));
      $this->session->set_userdata('date_from_select_jurnal', $date_before);
    }

    if(isset($_POST['tutup_buku']))
    {
      $data = array(
      'CHECKED_ID' => 0
    );

      $this->m_t_ak_jurnal->update_tutup_buku($data,$this->session->userdata('date_from_select_jurnal'), $this->session->userdata('date_to_select_jurnal'));
    }

    if(isset($_POST['buka_buku']))
    {
      $data = array(
      'CHECKED_ID' => 1
    );

      $this->m_t_ak_jurnal->update_tutup_buku($data,$this->session->userdata('date_from_select_jurnal'), $this->session->userdata('date_to_select_jurnal'));
    }

    redirect('/c_t_ak_jurnal');
    
  }


  public function delete($created_id)
  {
    $this->m_t_ak_jurnal->delete($created_id);
    $this->session->set_flashdata('notif', '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Success!</strong> Data Berhasil DIhapus!</p></div>');
    redirect('/c_t_ak_jurnal');
  }



  public function checked_ok($id)
  {
    $data = array(
      'CHECKED_ID' => 1
    );
    $this->m_t_ak_jurnal->update($data, $id);
    $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Diupdate!</strong></p></div>');
    redirect('/c_t_ak_jurnal');
  }

  function move($created_id)
  {

    $read_select = $this->m_t_ak_jurnal->select_created_id($created_id);
    foreach ($read_select as $key => $value) {

      $this->m_t_ak_jurnal_edit->delete($value->ID);

      $data = array(
        'ID' => $value->ID,
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
        'CREATED_ID' => $created_id,
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
      $this->m_t_ak_jurnal_edit->tambah($data);
    }
    redirect('c_t_ak_jurnal_edit');
  }




}
