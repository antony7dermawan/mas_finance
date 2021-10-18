<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_t_m_d_jenis_kendaraan extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('m_t_m_d_jenis_kendaraan');
  }

  public function index()
  {
    $this->session->set_userdata('t_m_d_jenis_kendaraan_delete_logic', '1');
    $data = [
      "c_t_m_d_jenis_kendaraan" => $this->m_t_m_d_jenis_kendaraan->select(),
      "title" => "Master Jenis Kendaraan",
      "description" => "Jenis Kendaraan untuk Unit Barang"
    ];
    $this->render_backend('template/backend/pages/t_m_d_jenis_kendaraan', $data);
  }



  public function delete($id)
  {
    $data = array(
        'UPDATED_BY' => $this->session->userdata('username'),
        'MARK_FOR_DELETE' => TRUE
    );
    $this->m_t_m_d_jenis_kendaraan->update($data, $id);
    $this->session->set_flashdata('notif', '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Success!</strong> Data Berhasil DIhapus!</p></div>');
    redirect('/c_t_m_d_jenis_kendaraan');
  }

  public function undo_delete($id)
  {
    $data = array(
        'UPDATED_BY' => $this->session->userdata('username'),
        'MARK_FOR_DELETE' => FALSE
    );
    $this->m_t_m_d_jenis_kendaraan->update($data, $id);
    
    $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Dikembalikan!</strong></p></div>');
    redirect('/c_t_m_d_jenis_kendaraan');
  }


  function tambah()
  {
    
    $jenis_kendaraan = substr($this->input->post("jenis_kendaraan"), 0, 50);

    //Dikiri nama kolom pada database, dikanan hasil yang kita tangkap nama formnya.
    $data = array(
      'JENIS_KENDARAAN' => $jenis_kendaraan,
      'CREATED_BY' => $this->session->userdata('username'),
      'UPDATED_BY' => '',
      'MARK_FOR_DELETE' => FALSE
    );

    $this->m_t_m_d_jenis_kendaraan->tambah($data);

    $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Ditambahkan!</strong></p></div>');
    redirect('c_t_m_d_jenis_kendaraan');
  }






  public function edit_action()
  {
    $id = $this->input->post("id");
    $jenis_kendaraan = substr($this->input->post("jenis_kendaraan"), 0, 50);

    //Dikiri nama kolom pada database, dikanan hasil yang kita tangkap nama formnya.
    $data = array(
      'JENIS_KENDARAAN' => $jenis_kendaraan,
      'UPDATED_BY' => $this->session->userdata('username')
    );

    $this->m_t_m_d_jenis_kendaraan->update($data, $id);
    $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Diupdate!</strong></p></div>');
    redirect('/c_t_m_d_jenis_kendaraan');
  }
}
