<div class="card">
  <div class="card-header">
    <h5>Edit Transaction</h5>
  </div>
  <div class="card-block">
    <!-- Menampilkan notif !-->
    <?= $this->session->flashdata('notif') ?>
    <!-- Tombol untuk menambah data akun !-->
    <button data-toggle='modal' data-target='#addModal' class='btn btn-success waves-effect waves-light'>New Data</button>

    <div class="table-responsive dt-responsive">
      <table id="dom-jqry" class="table table-striped table-bordered nowrap">
        <thead>
          <tr>
            <th>No</th>
            <th>No Voucer</th>
            <th>Date</th>
            <th>NO AKUN</th>
            <th>Nama Akun</th>
            <th>Debit</th>
            <th>Kredit</th>
            <th>Catatan</th>


            <th>No Polisi</th>
            <th>Supir</th>
            <th>Tgl Muat</th>
            <th>Tgl Bongkar</th>
            <th>Kota Asal</th>
            <th>Kota Tujuan</th>

            <th>Dept/Jenis</th>
            <th>Pelanggan/Project</th>

            <th>Gandengan/Ekor</th>

            <th>No DO Pend</th>
            <th>Tgl DO</th>

            <th>No Inv Pend</th>
            <th>No SPB Pend</th>
     
            <th>QTY Jurnal</th>
            <th>Harga Jurnal</th>
            <th>Jumlah</th>
           
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php

          $total_debit=0;
          $total_kredit=0;
          foreach ($c_t_ak_jurnal_edit as $key => $value) 
          {

                if($value->NO_AKUN_3!='')
                {
                  $no_akun=$value->NO_AKUN_3;
                }
                elseif($value->NO_AKUN_2!='')
                {
                  $no_akun=$value->NO_AKUN_2;
                }
                else
                {
                  $no_akun=$value->NO_AKUN_1;
                }
            $total_debit = floatval($value->DEBIT) + $total_debit;
            $total_kredit = floatval($value->KREDIT) + $total_kredit;
            
            echo "<tr>";

              echo "<td>".($key + 1)."</td>";
              echo "<td>".$value->NO_VOUCER."</td>";
              echo "<td>" . date('d-m-Y', strtotime($value->DATE)) . " / " . date('H:i', strtotime($value->TIME)) . "</td>";
              echo "<td>".$no_akun."</td>";
              echo "<td>".$value->NAMA_AKUN."</td>";
              echo "<td>Rp".number_format(($value->DEBIT),2,'.',',')."</td>";
              echo "<td>Rp".number_format(($value->KREDIT),2,'.',',')."</td>";
              echo "<td>".$value->CATATAN."</td>";

              echo "<td>".$value->NO_POLISI."</td>";
              echo "<td>".$value->SUPIR."</td>";

              echo "<td>".date('d-m-Y', strtotime($value->DATE_MUAT))."</td>";
              echo "<td>".date('d-m-Y', strtotime($value->DATE_BONGKAR))."</td>";

              echo "<td>".$value->FROM_NAMA_KOTA."</td>";
              echo "<td>".$value->TO_NAMA_KOTA."</td>";


              echo "<td>".$value->DEPARTEMEN."</td>";
              echo "<td>".$value->PELANGGAN."</td>";
              echo "<td>".$value->GANDENGAN."</td>";

              echo "<td>".$value->NO_DO_PENDAPATAN."</td>";
              echo "<td>".date('d-m-Y', strtotime($value->DATE_DO))."</td>";


              echo "<td>".$value->NO_INVOICE_PENDAPATAN."</td>";
              echo "<td>".$value->NO_SPB_PENDAPATAN."</td>";


              echo "<td>Rp".number_format(($value->QTY_JURNAL),2,'.',',')."</td>";
              echo "<td>Rp".number_format(($value->HARGA_JURNAL),2,'.',',')."</td>";
              echo "<td>Rp".number_format(($value->HARGA_JURNAL*$value->QTY_JURNAL),2,'.',',')."</td>";

           
              echo "<td>";
              echo "<a href='javascript:void(0);' data-toggle='modal' data-target='#Modal_Edit' class='btn-edit' data-id='".$value->ID."'>";
                echo "<i class='icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green'></i>";
              echo "</a>";
              echo "<a href='".site_url('c_t_ak_jurnal_edit/delete/' . $value->ID)."' ";
              ?>
              onclick="return confirm('Apakah kamu yakin ingin menghapus data ini?')"
              <?php
              echo "> <i class='feather icon-trash-2 f-w-600 f-16 text-c-red'></i></a>";

              echo "</td>";

            echo "</tr>";
          }
          echo "<tfoot>";

          if($total_debit!=$total_kredit)
          {
            echo "<tr>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th class='text_red'>TOTAL</th>";
            echo "<th class='text_red'>Rp".number_format(($total_debit),2,'.',',')."</th>";
            echo "<th class='text_red'>Rp".number_format(($total_kredit),2,'.',',')."</th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";

            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";

            echo "</tr>";
            echo "</tfoot>";
          }

          if($total_debit==$total_kredit and $total_debit>=0)
          {
            echo "<tr>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th class='text_red'>TOTAL</th>";
            echo "<th class='text_red'>Rp".number_format(($total_debit),2,'.',',')."</th>";
            echo "<th class='text_red'>Rp".number_format(($total_kredit),2,'.',',')."</th>";
            echo "<th>";


            echo "<form action=".base_url('c_t_ak_jurnal_edit/move')." method='post'>";
            
            echo "<button type='Submit' class='btn btn-success waves-effect waves-light'>Save</button>";

            echo "</form>";

            echo "</th>";


            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";

            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";

            echo "</tr>";
            echo "</tfoot>";
          }
          $rekomended_debit_value = 0;
          $rekomended_kredit_value = 0;
          if($total_debit>$total_kredit)
          {
            $rekomended_kredit_value = $total_debit-$total_kredit;
          }
          if($total_debit<$total_kredit)
          {
            $rekomended_debit_value = $total_kredit-$total_debit;
          }
          
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>




<!-- MODAL TAMBAH PEMASUKAN! !-->
<form action="<?php echo base_url('c_t_ak_jurnal_edit/tambah') ?>" method="post" id='add_data'>
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tanggal Transaksi:
            <form action='/action_page.php'>
              <input type='date' class='form-control' name='date' value='<?= $this->session->userdata('date_jurnal_create') ?>'>
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          
          <div class="form-group">
              <label>Pilih Akun</label>
              <select name="coa_id" class='custom_width' id='select-state' placeholder='Pick a state...'>
              <?php
              foreach ($no_akun_option as $key => $value) 
              {
                
                if($value->NO_AKUN_3!='')
                {
                  $no_akun=$value->NO_AKUN_3;
                }
                elseif($value->NO_AKUN_2!='')
                {
                  $no_akun=$value->NO_AKUN_2;
                }
                else
                {
                  $no_akun=$value->NO_AKUN_1;
                }
                echo "<option value=".$value->ID.">".$no_akun." / ".$value->NAMA_AKUN."</option>";
              }
              ?>
              </select>
          </div>


        <div class="row">
          <div class="col-md-6">

            <fieldset class="form-group">
              <label>Debit</label>
              <input type='text' class='form-control' placeholder='Input Number' name='debit' value='<?php echo $rekomended_debit_value;?>'>
            </fieldset>

          </div><!-- Membungkus Row Kedua !-->


          <div class="col-md-6">

            <fieldset class="form-group">
              <label>Kredit</label>
              <input type='text' class='form-control' placeholder='Input Number' name='kredit' value='<?php echo $rekomended_kredit_value;?>'>  
            </fieldset>
          </div> <!-- Membungkus Row !-->
        </div>


        <div class="form-group">
              <label>Catatan</label>
              <textarea rows='4' cols='20' name='catatan' id='' form='add_data' class='form-control'></textarea>
        </div>

        <div class="form-group">
              <label>No Polisi</label>
                <select name="no_polisi_id" class='custom_width' id='select-state' placeholder='Pick a state...'>
                <?php
                foreach ($c_t_m_d_no_polisi as $key => $value) 
                {
                  echo "<option value='".$value->ID."'>".$value->NO_POLISI."</option>";

                }
                ?>
              </select>
        </div>


        <div class="row">

          <div class="col-md-6">
              <label>Gandengan</label>
                <select name="gandengan_id" class='custom_width' id='select-state' placeholder='Pick a state...'>
                <?php
                foreach ($c_t_m_d_gandengan as $key => $value) 
                {
                  echo "<option value='".$value->ID."'>".$value->GANDENGAN."</option>";

                }
                ?>
              </select>
          </div>


          <div class="col-md-6">
              <label>Nama Supir</label>
                <select name="supir_id" class='custom_width' id='select-state' placeholder='Pick a state...'>
                <?php
                foreach ($c_t_m_d_supir as $key => $value) 
                {
                  echo "<option value='".$value->ID."'>".$value->SUPIR."</option>";

                }
                ?>
              </select>
          </div>

        </div>


        <div class="row">

          <div class="col-md-6">
              <label>Kota Dari</label>
                <select name="from_nama_kota_id" class='custom_width' id='select-state' placeholder='Pick a state...'>
                <?php
                foreach ($c_t_m_d_from_nama_kota as $key => $value) 
                {
                  echo "<option value='".$value->ID."'>".$value->FROM_NAMA_KOTA."</option>";

                }
                ?>
              </select>
          </div>


          <div class="col-md-6">
              <label>Kota Tujuan</label>
                <select name="to_nama_kota_id" class='custom_width' id='select-state' placeholder='Pick a state...'>
                <?php
                foreach ($c_t_m_d_to_nama_kota as $key => $value) 
                {
                  echo "<option value='".$value->ID."'>".$value->TO_NAMA_KOTA."</option>";

                }
                ?>
              </select>
          </div>

        </div>


        <div class="form-group">
              <label>No Invoice Pendapatan</label>
              <input type='text' class='form-control' placeholder='Input Text' name='no_invoice_pendapatan'>
        </div>



        <div class="row">
          <div class="col-md-6">
            <fieldset class="form-group">
              <label>No DO Pendapatan</label>
              <input type='text' class='form-control' placeholder='Input Text' name='no_do_pendapatan'>
            </fieldset>
          </div>

          <div class="col-md-6">
            <fieldset class="form-group">
              <label>No SPB Pendapatan</label>
              <input type='text' class='form-control' placeholder='Input Text' name='no_spb_pendapatan'>
            </fieldset>
          </div>
        </div>







        <div class="form-group">
              <label>Tanggal DO</label>
              <form action='/action_page.php'>
              <input type='date' class='form-control' name='date_do' value='<?= $this->session->userdata('date_jurnal_create') ?>'>
        </div>



        <div class="row">
          <div class="col-md-6">
            <fieldset class="form-group">
              <label>Tanggal Muat</label>
              <form action='/action_page.php'>
              <input type='date' class='form-control' name='date_muat' value='<?= $this->session->userdata('date_jurnal_create') ?>'>
            </fieldset>
          </div>

          <div class="col-md-6">
            <fieldset class="form-group">
              <label>Tanggal Bongkar</label>
              <form action='/action_page.php'>
              <input type='date' class='form-control' name='date_bongkar' value='<?= $this->session->userdata('date_jurnal_create') ?>'>
            </fieldset>
          </div>
        </div>




        


        <div class="row">

          <div class="col-md-6">
            <fieldset class="form-group">
                <label>Pelanggan</label>
                <select name="pelanggan_id" class='custom_width' id='select-state' placeholder='Pick a state...'>
                <?php
                foreach ($c_t_m_d_pelanggan as $key => $value) 
                {
                  echo "<option value='".$value->ID."'>".$value->PELANGGAN."</option>";

                }
                ?>
              </select>
            </fieldset>
          </div>

          <div class="col-md-6">

            <fieldset class="form-group">
              <label>Departemen / Jenis</label>
              <input type='text' class='form-control' placeholder='Input Text' name='departemen'>
            </fieldset>

          </div>
        </div>




        <div class="row">

          <div class="col-md-6">
            <fieldset class="form-group">
              <label>Lokasi</label>
                <select name="lokasi_id" class='custom_width' id='select-state' placeholder='Pick a state...'>
                <?php
                foreach ($c_t_m_d_lokasi as $key => $value) 
                {
                  echo "<option value='".$value->ID."'>".$value->LOKASI."</option>";

                }
                ?>
              </select>
            </fieldset>
          </div>

          <div class="col-md-6">

            <fieldset class="form-group">
              <label>Metode Bayar</label>
                <select name="payment_method_id" class='custom_width' id='select-state' placeholder='Pick a state...'>
                <?php
                foreach ($c_t_m_d_payment_method as $key => $value) 
                {
                  echo "<option value='".$value->ID."'>".$value->PAYMENT_METHOD."</option>";

                }
                ?>
              </select>
            </fieldset>

          </div>
        </div>




        <div class="row">
          <div class="col-md-6">

            <fieldset class="form-group">
              <label>QTY Jurnal</label>
              <input type='text' class='form-control' placeholder='Input Number' name='qty_jurnal'>
            </fieldset>

          </div><!-- Membungkus Row Kedua !-->


          <div class="col-md-6">

            <fieldset class="form-group">
              <label>Harga Jurnal</label>
              <input type='text' class='form-control' placeholder='Input Number' name='harga_jurnal'>  
            </fieldset>
          </div> <!-- Membungkus Row !-->
        </div>



        </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
            <button type="Submit" class="btn btn-primary waves-effect waves-light ">Save changes</button>
          </div>



      </div>
    </div>
  </div>
</form>
<!-- MODAL TAMBAH PEMASUKAN SELESAI !-->


<!-- MODAL EDIT AKUN !-->
<div class="modal fade" id="Modal_Edit" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form action="<?php echo base_url('c_t_ak_jurnal_edit/edit_action') ?>" method="post" autocomplete="off" id='edit_data'>
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Data</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        
        <div class="modal-body">
        <input type="hidden" name="id" value="" class="form-control">


        <div class="row">
          <div class="col-md-6">

            <fieldset class="form-group">
              <label>Tanggal Transaksi</label>
              <form action='/action_page.php'>
              <input type='date' class='form-control' name='date' value=''>
            </fieldset>

          </div><!-- Membungkus Row Kedua !-->


          <div class="col-md-6">

            
          </div> <!-- Membungkus Row !-->
        </div>


        <div class="form-group">
              <label>No Voucer</label>
              <input type='text' class='form-control' placeholder='Input Number' name='no_voucer'>
        </div>
        
        <div class="row">
          <div class="col-md-6">

            <fieldset class="form-group">
              <label>Debit</label>
              <input type='text' class='form-control' placeholder='Input Number' name='debit'>
            </fieldset>

          </div><!-- Membungkus Row Kedua !-->


          <div class="col-md-6">

            <fieldset class="form-group">
              <label>Kredit</label>
              <input type='text' class='form-control' placeholder='Input Number' name='kredit'>  
            </fieldset>
          </div> <!-- Membungkus Row !-->
        </div>


        <div class="form-group">
              <label>Catatan</label>
              <textarea rows='4' cols='20' name='catatan' id='' form='edit_data' class='form-control'></textarea>
        </div>


        <div class="form-group">
            <label>No Polisi</label>
              <div class="searchable">
                  <input type="text" name='no_polisi' placeholder="search" onkeyup="filterFunction(this,event)">
                  <ul>
                    <?php
                    foreach ($c_t_m_d_no_polisi as $key => $value) 
                    {
                      echo "<li>".$value->NO_POLISI."</li>";
                    }
                    ?>
                  </ul>
              </div>
        </div>



        <div class="row">

          <div class="col-md-6">
              <label>Gandengan</label>
              <div class="searchable">
                  <input type="text" name='gandengan' placeholder="search" onkeyup="filterFunction(this,event)">
                  <ul>
                    <?php
                    foreach ($c_t_m_d_gandengan as $key => $value) 
                    {
                      echo "<li>".$value->GANDENGAN."</li>";
                    }
                    ?>
                  </ul>
              </div>
          </div>


          <div class="col-md-6">
              <label>Nama Supir</label>
              <div class="searchable">
                  <input type="text" name='supir' placeholder="search" onkeyup="filterFunction(this,event)">
                  <ul>
                    <?php
                    foreach ($c_t_m_d_supir as $key => $value) 
                    {
                      echo "<li>".$value->SUPIR."</li>";
                    }
                    ?>
                  </ul>
              </div>

          </div>

        </div>


        <div class="row">

          <div class="col-md-6">
              <label>Kota Dari</label>

              <div class="searchable">
                  <input type="text" name='from_nama_kota' placeholder="search" onkeyup="filterFunction(this,event)">
                  <ul>
                    <?php
                    foreach ($c_t_m_d_from_nama_kota as $key => $value) 
                    {
                      echo "<li>".$value->FROM_NAMA_KOTA."</li>";
                    }
                    ?>
                  </ul>
              </div>


          </div>


          <div class="col-md-6">
              <label>Kota Tujuan</label>
                
              <div class="searchable">
                  <input type="text" name='to_nama_kota' placeholder="search" onkeyup="filterFunction(this,event)">
                  <ul>
                    <?php
                    foreach ($c_t_m_d_to_nama_kota as $key => $value) 
                    {
                      echo "<li>".$value->TO_NAMA_KOTA."</li>";
                    }
                    ?>
                  </ul>
              </div>
          </div>

        </div>







        <div class="form-group">
              <label>No Invoice Pendapatan</label>
              <input type='text' class='form-control' placeholder='Input Text' name='no_invoice_pendapatan'>
        </div>



        <div class="row">
          <div class="col-md-6">
            <fieldset class="form-group">
              <label>No DO Pendapatan</label>
              <input type='text' class='form-control' placeholder='Input Text' name='no_do_pendapatan'>
            </fieldset>
          </div>

          <div class="col-md-6">
            <fieldset class="form-group">
              <label>No SPB Pendapatan</label>
              <input type='text' class='form-control' placeholder='Input Text' name='no_spb_pendapatan'>
            </fieldset>
          </div>
        </div>







        <div class="form-group">
              <label>Tanggal DO</label>
              <form action='/action_page.php'>
              <input type='date' class='form-control' name='date_do' value='<?= $this->session->userdata('date_jurnal_create') ?>'>
        </div>



        <div class="row">
          <div class="col-md-6">
            <fieldset class="form-group">
              <label>Tanggal Muat</label>
              <form action='/action_page.php'>
              <input type='date' class='form-control' name='date_muat' value='<?= $this->session->userdata('date_jurnal_create') ?>'>
            </fieldset>
          </div>

          <div class="col-md-6">
            <fieldset class="form-group">
              <label>Tanggal Bongkar</label>
              <form action='/action_page.php'>
              <input type='date' class='form-control' name='date_bongkar' value='<?= $this->session->userdata('date_jurnal_create') ?>'>
            </fieldset>
          </div>
        </div>







        <div class="row">

          <div class="col-md-6">
              <label>Pelanggan</label>
           
              <div class="searchable">
                  <input type="text" name='pelanggan' placeholder="search" onkeyup="filterFunction(this,event)">
                  <ul>
                    <?php
                    foreach ($c_t_m_d_pelanggan as $key => $value) 
                    {
                      echo "<li>".$value->PELANGGAN."</li>";
                    }
                    ?>
                  </ul>
              </div>


          </div>

          <div class="col-md-6">

            <fieldset class="form-group">
              <label>Departemen / Jenis</label>
              <input type='text' class='form-control' placeholder='Input Text' name='departemen'>
            </fieldset>

          </div>
        </div>



        <div class="row">

          <div class="col-md-6">
            <fieldset class="form-group">
              <label>Lokasi</label>
              <div class="searchable">
                  <input type="text" name='lokasi' placeholder="search" onkeyup="filterFunction(this,event)">
                  <ul>
                    <?php
                    foreach ($c_t_m_d_lokasi as $key => $value) 
                    {
                      echo "<li>".$value->LOKASI."</li>";
                    }
                    ?>
                  </ul>
              </div>

            </fieldset>
          </div>

          <div class="col-md-6">

            <fieldset class="form-group">
              <label>Metode Bayar</label>

              <div class="searchable">
                  <input type="text" name='payment_method' placeholder="search" onkeyup="filterFunction(this,event)">
                  <ul>
                    <?php
                    foreach ($c_t_m_d_payment_method as $key => $value) 
                    {
                      echo "<li>".$value->PAYMENT_METHOD."</li>";
                    }
                    ?>
                  </ul>
              </div>

            </fieldset>

          </div>
        </div>



        <div class="row">
          <div class="col-md-6">

            <fieldset class="form-group">
              <label>QTY Jurnal</label>
              <input type='text' class='form-control' placeholder='Input Number' name='qty_jurnal'>
            </fieldset>

          </div><!-- Membungkus Row Kedua !-->


          <div class="col-md-6">

            <fieldset class="form-group">
              <label>Harga Jurnal</label>
              <input type='text' class='form-control' placeholder='Input Number' name='harga_jurnal'>  
            </fieldset>
          </div> <!-- Membungkus Row !-->
        </div>






          <div class="modal-footer">
            <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
            <button type="Submit" class="btn btn-primary waves-effect waves-light ">Save changes</button>
          </div>

        </div>


<script>
  const read_data = <?= json_encode($c_t_ak_jurnal_edit) ?>;
  console.log(read_data);
  let elModalEdit = document.querySelector("#Modal_Edit");
  console.log(elModalEdit);
  let elBtnEdits = document.querySelectorAll(".btn-edit");
  [...elBtnEdits].forEach(edit => {
    edit.addEventListener("click", (e) => {
      let id = edit.getAttribute("data-id");
      let User = read_data.filter(user => {
        if (user.ID == id)
          return user;
      });
      const {
        ID,
        DEBIT : debit,
        KREDIT : kredit,
        CATATAN : catatan,
        DEPARTEMEN : departemen,
        DATE : date,

        NO_POLISI : no_polisi,
    
        SUPIR : supir,
        NO_SPB_PENDAPATAN : no_spb_pendapatan,
        NO_INVOICE_PENDAPATAN : no_invoice_pendapatan,
        PELANGGAN : pelanggan,
        FROM_NAMA_KOTA : from_nama_kota,
        TO_NAMA_KOTA : to_nama_kota,
        GANDENGAN : gandengan,
        NO_VOUCER : no_voucer,

        NO_DO_PENDAPATAN : no_do_pendapatan,
        DATE_DO : date_do,
        QTY_JURNAL : qty_jurnal,
        HARGA_JURNAL : harga_jurnal,
        DATE_MUAT : date_muat,
        LOKASI : lokasi,
        PAYMENT_METHOD : payment_method,
        DATE_BONGKAR : date_bongkar


      } = User[0];

      elModalEdit.querySelector("[name=id]").value = ID;
      
      
      elModalEdit.querySelector("[name=debit]").value = debit;
      elModalEdit.querySelector("[name=kredit]").value = kredit;
      elModalEdit.querySelector("[name=catatan]").value = catatan;
      elModalEdit.querySelector("[name=departemen]").value = departemen;
      elModalEdit.querySelector("[name=date]").value = date;


      elModalEdit.querySelector("[name=no_polisi]").value = no_polisi;
      elModalEdit.querySelector("[name=supir]").value = supir;
      elModalEdit.querySelector("[name=no_spb_pendapatan]").value = no_spb_pendapatan;
      elModalEdit.querySelector("[name=no_invoice_pendapatan]").value = no_invoice_pendapatan;
      elModalEdit.querySelector("[name=pelanggan]").value = pelanggan;
      elModalEdit.querySelector("[name=from_nama_kota]").value = from_nama_kota;
      elModalEdit.querySelector("[name=to_nama_kota]").value = to_nama_kota;
      elModalEdit.querySelector("[name=gandengan]").value = gandengan;
      elModalEdit.querySelector("[name=no_voucer]").value = no_voucer;



      elModalEdit.querySelector("[name=no_do_pendapatan]").value = no_do_pendapatan;
      elModalEdit.querySelector("[name=date_do]").value = date_do;
      elModalEdit.querySelector("[name=qty_jurnal]").value = qty_jurnal;
      elModalEdit.querySelector("[name=harga_jurnal]").value = harga_jurnal;
      elModalEdit.querySelector("[name=date_muat]").value = date_muat;
      elModalEdit.querySelector("[name=lokasi]").value = lokasi;
      elModalEdit.querySelector("[name=payment_method]").value = payment_method;
      elModalEdit.querySelector("[name=date_bongkar]").value = date_bongkar;
  



    })
  })
</script>

    </form>
  </div>
</div>



<script type="text/javascript">
    $(document).ready(function () {
      $('select').selectize({
          sortField: 'text'
      });
  });
</script>





<style type="text/css">
    div.searchable {
    width: 100%;
    
}

.searchable input {
    width: 100%;
    height: 30px;
    font-size: 14px;
    padding: 10px;
    -webkit-box-sizing: border-box; /* Safari/Chrome, other WebKit */
    -moz-box-sizing: border-box; /* Firefox, other Gecko */
    box-sizing: border-box; /* Opera/IE 8+ */
    display: block;
    font-weight: 400;
    line-height: 1.6;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    background: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3E%3Cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3E%3C/svg%3E") no-repeat right .75rem center/8px 10px;
}

.searchable ul {
    display: none;
    list-style-type: none;
    background-color: #fff;
    border-radius: 0 0 5px 5px;
    border: 1px solid #add8e6;
    border-top: none;
    max-height: 180px;
    margin: 0;
    overflow-y: scroll;
    overflow-x: hidden;
    padding: 0;
}

.searchable ul li {
    padding: 7px 9px;
    border-bottom: 1px solid #e1e1e1;
    cursor: pointer;
    color: #6e6e6e;
}

.searchable ul li.selected {
    background-color: #e8e8e8;
    color: #333;
}
</style>



<script type="text/javascript">
    
    function filterFunction(that, event) {
    let container, input, filter, li, input_val;
    container = $(that).closest(".searchable");
    input_val = container.find("input").val().toUpperCase();

    if (["ArrowDown", "ArrowUp", "Enter"].indexOf(event.key) != -1) {
        keyControl(event, container)
    } else {
        li = container.find("ul li");
        li.each(function (i, obj) {
            if ($(this).text().toUpperCase().indexOf(input_val) > -1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });

        container.find("ul li").removeClass("selected");
        setTimeout(function () {
            container.find("ul li:visible").first().addClass("selected");
        }, 100)
    }
}

function keyControl(e, container) {
    if (e.key == "ArrowDown") {

        if (container.find("ul li").hasClass("selected")) {
            if (container.find("ul li:visible").index(container.find("ul li.selected")) + 1 < container.find("ul li:visible").length) {
                container.find("ul li.selected").removeClass("selected").nextAll().not('[style*="display: none"]').first().addClass("selected");
            }

        } else {
            container.find("ul li:first-child").addClass("selected");
        }

    } else if (e.key == "ArrowUp") {

        if (container.find("ul li:visible").index(container.find("ul li.selected")) > 0) {
            container.find("ul li.selected").removeClass("selected").prevAll().not('[style*="display: none"]').first().addClass("selected");
        }
    } else if (e.key == "Enter") {
        container.find("input").val(container.find("ul li.selected").text()).blur();
        onSelect(container.find("ul li.selected").text())
    }

    container.find("ul li.selected")[0].scrollIntoView({
        behavior: "smooth",
    });
}



$(".searchable input").focus(function () {
    $(this).closest(".searchable").find("ul").show();
    $(this).closest(".searchable").find("ul li").show();
});
$(".searchable input").blur(function () {
    let that = this;
    setTimeout(function () {
        $(that).closest(".searchable").find("ul").hide();
    }, 300);
});

$(document).on('click', '.searchable ul li', function () {
    $(this).closest(".searchable").find("input").val($(this).text()).blur();
    onSelect($(this).text())
});

$(".searchable ul li").hover(function () {
    $(this).closest(".searchable").find("ul li.selected").removeClass("selected");
    $(this).addClass("selected");
});
</script>