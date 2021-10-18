<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_t_m_d_from_nama_kota extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('m_t_m_d_from_nama_kota');
  }

  public function index()
  {
    $this->session->set_userdata('t_m_d_from_nama_kota_delete_logic', '1');
    $data = [
      "c_t_m_d_from_nama_kota" => $this->m_t_m_d_from_nama_kota->select(),
      "title" => "Master Nama Kota",
      "description" => "Nama Kota untuk Unit Barang"
    ];
    $this->render_backend('template/backend/pages/t_m_d_from_nama_kota', $data);
  }



  public function delete($id)
  {
    $data = array(
        'UPDATED_BY' => $this->session->userdata('username'),
        'MARK_FOR_DELETE' => TRUE
    );
    $this->m_t_m_d_from_nama_kota->update($data, $id);
    $this->session->set_flashdata('notif', '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Success!</strong> Data Berhasil DIhapus!</p></div>');
    redirect('/c_t_m_d_from_nama_kota');
  }

  public function undo_delete($id)
  {
    $data = array(
        'UPDATED_BY' => $this->session->userdata('username'),
        'MARK_FOR_DELETE' => FALSE
    );
    $this->m_t_m_d_from_nama_kota->update($data, $id);
    
    $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Dikembalikan!</strong></p></div>');
    redirect('/c_t_m_d_from_nama_kota');
  }


  function tambah()
  {
    
    $from_nama_kota = substr($this->input->post("from_nama_kota"), 0, 50);

    //Dikiri nama kolom pada database, dikanan hasil yang kita tangkap nama formnya.
    $data = array(
      'FROM_NAMA_KOTA' => $from_nama_kota,
      'CREATED_BY' => $this->session->userdata('username'),
      'UPDATED_BY' => '',
      'MARK_FOR_DELETE' => FALSE
    );

    $this->m_t_m_d_from_nama_kota->tambah($data);

    $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Ditambahkan!</strong></p></div>');
    redirect('c_t_m_d_from_nama_kota');
  }






  public function edit_action()
  {
    $id = $this->input->post("id");
    $from_nama_kota = substr($this->input->post("from_nama_kota"), 0, 50);

    //Dikiri nama kolom pada database, dikanan hasil yang kita tangkap nama formnya.
    $data = array(
      'FROM_NAMA_KOTA' => $from_nama_kota,
      'UPDATED_BY' => $this->session->userdata('username')
    );

    $this->m_t_m_d_from_nama_kota->update($data, $id);
    $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Diupdate!</strong></p></div>');
    redirect('/c_t_m_d_from_nama_kota');
  }
}
