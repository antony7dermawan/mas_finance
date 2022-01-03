<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_laporan extends MY_Controller {

	  public function __construct()
  {
    parent::__construct();

    $this->load->model('m_laporan');
    $this->load->model('m_ak_m_sub');
    $this->load->model('m_t_m_d_pelanggan');
  }

	public function index(){

		
		$this->session->set_userdata('t_m_d_pelanggan_delete_logic', '0');
		$data = [
      		"c_ak_m_sub" => $this->m_ak_m_sub->select(),
			"c_t_m_d_pelanggan" => $this->m_t_m_d_pelanggan->select(),
			"title" => "Laporan",
			"description" => "Pilih Detail"
		  ];
		// function render_backend tersebut dari file core/MY_Controller.php
		$this->render_backend('template/backend/pages/laporan', $data);
	}



}


