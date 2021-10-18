<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_t_m_d_no_polisi extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('m_t_m_d_no_polisi');
    $this->load->model('m_t_m_d_jenis_kendaraan');
  }

  public function index()
  {

    $this->session->set_userdata('t_m_d_jenis_kendaraan_delete_logic', '0');
    $this->session->set_userdata('t_m_d_no_polisi_delete_logic', '1');
    $data = [
      "c_t_m_d_no_polisi" => $this->m_t_m_d_no_polisi->select(),
      "c_t_m_d_jenis_kendaraan" => $this->m_t_m_d_jenis_kendaraan->select(),
      "title" => "Master No Polisi",
      "description" => "No Polisi untuk Unit Barang"
    ];
    $this->render_backend('template/backend/pages/t_m_d_no_polisi', $data);
  }



  public function delete($id)
  {
    $data = array(
        'UPDATED_BY' => $this->session->userdata('username'),
        'MARK_FOR_DELETE' => TRUE
    );
    $this->m_t_m_d_no_polisi->update($data, $id);
    $this->session->set_flashdata('notif', '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Success!</strong> Data Berhasil DIhapus!</p></div>');
    redirect('/c_t_m_d_no_polisi');
  }

  public function undo_delete($id)
  {
    $data = array(
        'UPDATED_BY' => $this->session->userdata('username'),
        'MARK_FOR_DELETE' => FALSE
    );
    $this->m_t_m_d_no_polisi->update($data, $id);
    
    $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Dikembalikan!</strong></p></div>');
    redirect('/c_t_m_d_no_polisi');
  }


  function tambah()
  {
    $no_unit = substr($this->input->post("no_unit"), 0, 50);
    $no_polisi = substr($this->input->post("no_polisi"), 0, 50);
    $jenis_kendaraan_id = intval($this->input->post("jenis_kendaraan_id"));

    //Dikiri nama kolom pada database, dikanan hasil yang kita tangkap nama formnya.
    $data = array(
      'NO_POLISI' => $no_polisi,
      'CREATED_BY' => $this->session->userdata('username'),
      'UPDATED_BY' => '',
      'MARK_FOR_DELETE' => FALSE,
      'NO_UNIT' => $no_unit,
      'JENIS_KENDARAAN_ID' => $jenis_kendaraan_id
    );

    $this->m_t_m_d_no_polisi->tambah($data);

    $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Ditambahkan!</strong></p></div>');
    redirect('c_t_m_d_no_polisi');
  }






  public function edit_action()
  {
    $id = $this->input->post("id");
    $no_polisi = substr($this->input->post("no_polisi"), 0, 50);
    $no_unit = substr($this->input->post("no_unit"), 0, 50);


    $jenis_kendaraan = ($this->input->post("jenis_kendaraan"));

    $read_select = $this->m_t_m_d_jenis_kendaraan->select_id($jenis_kendaraan);
    foreach ($read_select as $key => $value) {
      $jenis_kendaraan_id = $value->ID;
    }

    //Dikiri nama kolom pada database, dikanan hasil yang kita tangkap nama formnya.
    $data = array(
      'NO_POLISI' => $no_polisi,
      'UPDATED_BY' => $this->session->userdata('username'),
      'NO_UNIT' => $no_unit,
      'JENIS_KENDARAAN_ID' => $jenis_kendaraan_id
    );

    $this->m_t_m_d_no_polisi->update($data, $id);
    $this->session->set_flashdata('notif', '<div class="alert alert-info icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled"></i></button><p><strong>Data Berhasil Diupdate!</strong></p></div>');
    redirect('/c_t_m_d_no_polisi');
  }
}
