<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_dashboard extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('m_setting_db_supplier_coa');
    $this->load->model('m_setting_db_bank_coa');
    $this->load->model('m_t_ak_faktur_penjualan');

  }


  public function index()
  {
    $title = "Dashboard";
    
    $data = [
      "c_setting_db_bank_coa" => $this->m_setting_db_bank_coa->select('2021-01-01','2100-01-01'),
      "c_setting_db_supplier_coa" => $this->m_setting_db_supplier_coa->select('2021-01-01','2100-01-01'),
      "select_no_faktur" => $this->m_t_ak_faktur_penjualan->select_no_faktur(),
      
      "title" => $title,
      "description" => "Web Version:21-06-01 19:30"
    ];

    $this->render_backend('template/backend/pages/dashboard', $data);
  }

  public function search_date()
  {
    $date_from_dashboard = ($this->input->post("date_from_dashboard"));
    $this->session->set_userdata('date_from_dashboard', $date_from_dashboard);

    $date_to_dashboard = ($this->input->post("date_to_dashboard"));
    $this->session->set_userdata('date_to_dashboard', $date_to_dashboard);
    redirect('/c_dashboard');
  }


  public function checked_ok($id)
  {
    $data = array(
      'ENABLE_EDIT' => 0
    );
    $this->m_t_po->update($data, $id);
    $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Diupdate!</strong></p></div>');
    redirect('/c_dashboard');
  }


  

}



