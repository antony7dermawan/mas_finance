<?php
defined('BASEPATH') or exit('No direct script access allowed');


class C_t_t_t_penjualan_jasa extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('m_t_t_t_penjualan_jasa');
    $this->load->model('m_t_m_d_company');
    $this->load->model('m_t_m_d_payment_method');
    $this->load->model('m_t_m_d_pelanggan');

    $this->load->model('m_t_m_d_no_polisi');
    $this->load->model('m_t_m_d_supir');
    $this->load->model('m_t_m_d_lokasi');
  }

  public function index()
  {
    
    
    $this->session->set_userdata('t_t_t_penjualan_jasa_delete_logic', '1');
    $this->session->set_userdata('t_m_d_payment_method_delete_logic', '0');
    $this->session->set_userdata('t_m_d_pelanggan_delete_logic', '0');
    $this->session->set_userdata('t_m_d_no_polisi_delete_logic', '0');
    $this->session->set_userdata('t_m_d_supir_delete_logic', '0');
    $this->session->set_userdata('t_m_d_lokasi_delete_logic', '0');


    if($this->session->userdata('date_penjualan_jasa')=='')
    {
      $date_penjualan = date('Y-m-d');
      $this->session->set_userdata('date_penjualan_jasa', $date_penjualan_jasa);
    }
    $data = [
      "c_t_t_t_penjualan_jasa" => $this->m_t_t_t_penjualan_jasa->select($this->session->userdata('date_penjualan_jasa'),1),   //tipe cpo

      "c_t_m_d_company" => $this->m_t_m_d_company->select(),
      "c_t_m_d_payment_method" => $this->m_t_m_d_payment_method->select(),
      "c_t_m_d_pelanggan" => $this->m_t_m_d_pelanggan->select(),


      "c_t_m_d_lokasi" => $this->m_t_m_d_lokasi->select(),
      "c_t_m_d_no_polisi" => $this->m_t_m_d_no_polisi->select(),
      "c_t_m_d_supir" => $this->m_t_m_d_supir->select(),

      "title" => "Transaksi Penjualan Jasa",
      "description" => "form Penjualan Jasa"
    ];
    $this->render_backend('template/backend/pages/t_t_t_penjualan_jasa', $data);
  }


  public function date_penjualan_jasa()
  {
    $date_penjualan_jasa = ($this->input->post("date_penjualan_jasa"));
    $this->session->set_userdata('date_penjualan_jasa', $date_penjualan_jasa);
    redirect('/c_t_t_t_penjualan_jasa');
  }


  public function delete($id)
  {
    $data = array(
        'UPDATED_BY' => $this->session->userdata('username'),
        'MARK_FOR_DELETE' => TRUE
    );
    $this->m_t_t_t_penjualan_jasa->update($data, $id);
    $this->session->set_flashdata('notif', '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Success!</strong> Data Berhasil DIhapus!</p></div>');
    redirect('/c_t_t_t_penjualan_jasa');
  }

  public function undo_delete($id)
  {
    $data = array(
        'UPDATED_BY' => $this->session->userdata('username'),
        'MARK_FOR_DELETE' => FALSE
    );
    $this->m_t_t_t_penjualan_jasa->update($data, $id);
    
    $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Dikembalikan!</strong></p></div>');
    redirect('/c_t_t_t_penjualan_jasa');
  }

 







  function tambah()
  {
    $pelanggan_id = intval($this->input->post("pelanggan_id"));
    $payment_method_id = intval($this->input->post("payment_method_id"));
    $target_party = floatval($this->input->post("target_party"));
    
    $no_faktur_pajak = substr($this->input->post("no_faktur_pajak"), 0, 100);
   

    $ket = substr($this->input->post("ket"), 0, 500);
    $date = $this->input->post("date");

    $no_do = substr($this->input->post("no_do"), 0, 50);

    if($date=='')
    {
      $date = date('Y-m-d');
    }
    
   

    $date_penjualan_jasa = $date;
    $this->session->set_userdata('date_penjualan_jasa', $date_penjualan_jasa);

    if($pelanggan_id!=0 and $payment_method_id!=0  )
    {
      $data = array(
        'DATE' => $date,
        'TIME' => date('H:i:s'),
        
        'COMPANY_ID' => $this->session->userdata('company_id'),
        'PAYMENT_METHOD_ID' => $payment_method_id,
        'PELANGGAN_ID' => $pelanggan_id,
        
        'KET' => $ket,
        'CREATED_BY' => $this->session->userdata('username'),
        'UPDATED_BY' => '',
        'MARK_FOR_DELETE' => FALSE,
        

        'ENABLE_EDIT' => 1,
        'NO_FAKTUR_PAJAK' => $no_faktur_pajak,

        'NO_DO' => $no_do,
        'TYPE_ID' => 1, //tipe cpo
        'TARGET_PARTY' => $target_party
 
      );

      $this->m_t_t_t_penjualan_jasa->tambah($data);



      


      $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Ditambahkan!</strong></p></div>');
    }

    else
    {
      $this->session->set_flashdata('notif', '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Gagal!</strong> Data Tidak Lengkap!</p></div>');
    }
    

    
    redirect('c_t_t_t_penjualan_jasa');
  }






  public function edit_action()
  {
    $id = $this->input->post("id");
    

   
    $target_party = floatval($this->input->post("target_party"));
    
    $no_faktur_pajak = substr($this->input->post("no_faktur_pajak"), 0, 100);
   

    $ket = substr($this->input->post("ket"), 0, 500);
    $date = $this->input->post("date");

    $no_do = substr($this->input->post("no_do"), 0, 50);

    if($date=='')
    {
      $date = date('Y-m-d');
    }




    $pelanggan = $this->input->post("pelanggan");
    $payment_method = $this->input->post("payment_method");



    $supplier_id = 0;
    $payment_method_id = 0;



    $read_select = $this->m_t_m_d_payment_method->select_id($payment_method);
    foreach ($read_select as $key => $value) {
      $payment_method_id = $value->ID;
    }

    $read_select = $this->m_t_m_d_pelanggan->select_id($pelanggan);
    foreach ($read_select as $key => $value) {
      $pelanggan_id = $value->ID;
    }
    //Dikiri nama kolom pada database, dikanan hasil yang kita tangkap nama formnya.

    if($pelanggan_id!=0 and $payment_method_id!=0 )
    {
      $data = array(
        'DATE' => $date,
        'TIME' => date('H:i:s'),
        
        'COMPANY_ID' => $this->session->userdata('company_id'),
        'PAYMENT_METHOD_ID' => $payment_method_id,
        'PELANGGAN_ID' => $pelanggan_id,
        
        'KET' => $ket,
        'UPDATED_BY' => $this->session->userdata('username'),
     


        'NO_FAKTUR_PAJAK' => $no_faktur_pajak,

        'NO_DO' => $no_do,
        'TARGET_PARTY' => $target_party


      );
      $this->m_t_t_t_penjualan_jasa->update($data, $id);
      $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Diupdate!</strong></p></div>');
    }
    else
    {
      $this->session->set_flashdata('notif', '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Gagal!</strong> Data Tidak Lengkap!</p></div>');
    }
    
    redirect('/c_t_t_t_penjualan_jasa');
  }
}
