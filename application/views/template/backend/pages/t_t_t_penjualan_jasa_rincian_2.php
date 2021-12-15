<div class="card">
  <div class="card-header">
   
      <h5>
      <?php
      $level_user_id = $this->session->userdata('level_user_id');

      $disable_harga_jual = 'disabled';
      if($level_user_id==1)
      {
        $disable_harga_jual = '';
      }
      foreach ($c_t_t_t_penjualan_jasa_by_id as $key => $value) {
        $inv = $value->NO_DO;
        $enable_edit = $value->ENABLE_EDIT;
        $pelanggan = $value->PELANGGAN;
        $keterangan_jasa = $value->KET;
        $jarak_km = $value->JARAK_KM;
      }


      echo 'No DO: '.$inv.'<br>';
      echo 'Pelanggan: '.$pelanggan.'<br>';
      echo 'Jarak: '.$jarak_km.'<br>';
      echo 'Keterangan: '.$keterangan_jasa.'<br>';
      ?>


      </h5>
   
  </div>
  <div class="card-block">
    <!-- Menampilkan notif !-->
    <?= $this->session->flashdata('notif') ?>

    <a href="<?= base_url("c_t_t_t_penjualan_jasa_2"); ?>" class="btn waves-effect waves-light btn-inverse"><i class="icofont icofont-double-left"></i>Back</a>
    <!-- Tombol untuk menambah data akun !-->
    <?php
    if($enable_edit==1)
    {
      echo "<button data-toggle='modal' data-target='#addModal' class='btn btn-success waves-effect waves-light'>New Data</button>";
    }
    ?>
    

    <div class="table-responsive dt-responsive">
      <table id="dom-jqry" class="table table-striped table-bordered nowrap">
        <thead>
          <tr>
            <th>No</th>
            <th>No SPB/SJ OKE</th>
            <th>Keterangan</th>
            <th>Pengeluaran</th>
            <th>DARI</th>
            <th>TUJUAN</th>
            <th>Jarak(Km)</th>
            <th>Tgl Muat</th>
            <th>Tgl Bongkar</th>
            <th>No Polisi</th>
            <th>Gandengan</th>
            <th>Supir</th>
            <th>Lokasi</th>
            
            <th>PC</th>
            <th>Harga/PC</th>
            <th>Sub Total</th>
            <th>PPN(%)</th>
            <th>PPN Rp</th>
  

           

            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($c_t_t_t_penjualan_jasa_rincian_2 as $key => $value) {

            if($value->MARK_FOR_DELETE == 'f')
            {
              echo "<tr>";

              echo "<td>" . ($key + 1) . "</td>";
              echo "<td>" . $value->NO_SPB . "</td>";
              echo "<td>" . $value->KET . "</td>";

              echo "<td>";
              echo "<a href='" . site_url('c_t_t_t_pengeluaran_rincian/index/' . $value->ID.'/'.$penjualan_jasa_id) . "' ";
              echo "onclick=\"return confirm('Lanjut?')\"";
              echo "> <i class='fa fa-search-plus text-c-blue'></i></a> ";
              echo " Rp" . number_format(intval($value->SUM_VALUE)) . "</td>";
              //satu button
              


              
              echo "<td>" . $value->FROM_NAMA_KOTA . "</td>";
              echo "<td>" . $value->TO_NAMA_KOTA . "</td>";
              echo "<td>" . number_format(($value->JARAK_KM), 2, '.', ',') . "</td>";
              echo "<td>" . $value->DATE_MUAT . "</td>";
              echo "<td>" . $value->DATE_BONGKAR . "</td>";
              echo "<td>" . $value->NO_POLISI .' / '. $value->NO_UNIT . "</td>";
              echo "<td>" . $value->GANDENGAN . "</td>";
              echo "<td>" . $value->SUPIR . "</td>";
              echo "<td>" . $value->LOKASI . "</td>";
              
              echo "<td>" . number_format(($value->PC), 2, '.', ',') . "</td>";
              echo "<td>" . number_format(($value->HARGA_PC), 2, '.', ',') . "</td>";
              echo "<td>" . number_format(($value->SUB_TOTAL), 2, '.', ',') . "</td>";
              echo "<td>" . number_format(($value->PPN_PERCENTAGE), 2, '.', ',') . "</td>";
              echo "<td>" . number_format(($value->PPN_VALUE), 2, '.', ',') . "</td>";
      
              
             

              
              echo "<td>";
              
                echo "<a href='javascript:void(0);' data-toggle='modal' data-target='#Modal_Edit' class='btn-edit' data-id='".$value->ID."'>";
                echo "<i class='icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green'></i>";
                echo "</a>";
              if( $value->ENABLE_EDIT==1 and $value->SUM_VALUE==0)
              {


                echo "<a href='".site_url('c_t_t_t_penjualan_jasa_rincian_2/delete/'.$value->ID.'/'.$penjualan_jasa_id)."' ";
                echo "onclick=\"return confirm('Apakah kamu yakin ingin menghapus data ini?')\"";


                echo "> <i class='feather icon-trash-2 f-w-600 f-16 text-c-red'></i></a>";
              }
              if( $value->ENABLE_EDIT==0)
              {
                echo "<a>Sudah Ditagih</a>";
              }
                
             
              echo "</td>";


              echo "</tr>";
            }


            






          }
          ?>
        </tbody>
      </table>

      
    </div>
  </div>
</div>









<!-- MODAL TAMBAH PEMASUKAN! !-->
<form action="<?php echo base_url('c_t_t_t_penjualan_jasa_rincian_2/tambah/'.$penjualan_jasa_id) ?>" method="post" id='add_data'>
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">New Data
            
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          

          <div class="form-group">
              <label>No SPB/SJ OKE</label>
              <input type='text' class='form-control' placeholder='Input Text' name='no_spb'>
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


          <div class="row">
            <div class="col-md-6">

              <fieldset class="form-group">
                <label>Jarak(Km)</label>
                <input type='text' class='form-control' placeholder='Input Number' name='jarak_km' value=''>
              </fieldset>

            </div><!-- Membungkus Row Kedua !-->


            <div class="col-md-6">

              <fieldset class="form-group">
                
              </fieldset>
            </div> <!-- Membungkus Row !-->
          </div>







          <div class="form-group">
              <label>Keterangan</label>
              <textarea rows='4' cols='20' name='ket' id='' form='add_data' class='form-control'></textarea>
          </div>




          <div class="row">
            <div class="col-md-6">
              <fieldset class="form-group">
                <label>Tanggal Muat</label>
                <form action='/action_page.php'>
                <input type='date' class='form-control' name='date_muat' value='<?= $this->session->userdata('date_penjualan_jasa') ?>'>
              </fieldset>
            </div>

            <div class="col-md-6">
              <fieldset class="form-group">
                <label>Tanggal Bongkar</label>
                <form action='/action_page.php'>
                <input type='date' class='form-control' name='date_bongkar' value='<?= $this->session->userdata('date_penjualan_jasa') ?>'>
              </fieldset>
            </div>
          </div>



          <div class="row">
            <div class="col-md-6">
              <fieldset class="form-group">
                  <label>No Polisi</label>
                  <select name="no_polisi_id" class='custom_width' id='select-state' placeholder='Pick a state...'>
                  <?php
                  foreach ($c_t_m_d_no_polisi as $key => $value) 
                  {
                    echo "<option value='".$value->ID."'>".$value->NO_POLISI."</option>";

                  }
                  ?>
                </select>
              </fieldset>
            </div>

            <div class="col-md-6">

              <fieldset class="form-group">
                  <label>Supir</label>
                  <select name="supir_id" class='custom_width' id='select-state' placeholder='Pick a state...'>
                  <?php
                  foreach ($c_t_m_d_supir as $key => $value) 
                  {
                    echo "<option value='".$value->ID."'>".$value->SUPIR."</option>";

                  }
                  ?>
                </select>
              </fieldset>

            </div>
          </div>



          <div class="row">



            <div class="col-md-6">

              <fieldset class="form-group">
                <label>Gandengan</label>
                <select name="gandengan_id" class='custom_width' id='select-state' placeholder='Pick a state...'>
                <?php
                foreach ($c_t_m_d_gandengan as $key => $value) 
                {
                  echo "<option value='".$value->ID."'>".$value->GANDENGAN."</option>";

                }
                ?>
              </select>
              </fieldset>

            </div>
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

          </div>









          <div class="row">
            <div class="col-md-6">

              <fieldset class="form-group">
                <label>PC</label>
                <input type='text' class='form-control' placeholder='Input Number' name='pc' value=''>
              </fieldset>

            </div><!-- Membungkus Row Kedua !-->


            <div class="col-md-6">

              <fieldset class="form-group">
                <label>Harga/PC</label>
                <input type='text' class='form-control' placeholder='Input Number' name='harga_pc' value=''>  
              </fieldset>
            </div> <!-- Membungkus Row !-->
          </div>


        





          



          




          



          <div class="row">
            <div class="col-md-6">

              <fieldset class="form-group">
                <label>PPN (%)</label>
                <input type='text' class='form-control' placeholder='10' name='ppn_percentage' value=''>
              </fieldset>

            </div><!-- Membungkus Row Kedua !-->


            <div class="col-md-6">

              
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
    <form action="<?php echo base_url('c_t_t_t_penjualan_jasa_rincian_2/edit_action/'.$penjualan_jasa_id) ?>" method="post" autocomplete="off" id='edit_data'>
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Data
            
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        
        <div class="modal-body">
        <input type="hidden" name="id" value="" class="form-control">




          <div class="form-group">
              <label>No SPB/SJ OKE</label>
              <input type='text' class='form-control' placeholder='Input Text' name='no_spb'>
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



          <div class="row">
            <div class="col-md-6">

              <fieldset class="form-group">
                <label>Jarak(Km)</label>
                <input type='text' class='form-control' placeholder='Input Number' name='jarak_km' value=''>
              </fieldset>

            </div><!-- Membungkus Row Kedua !-->


            <div class="col-md-6">

              <fieldset class="form-group">
                
              </fieldset>
            </div> <!-- Membungkus Row !-->
          </div>



          <div class="form-group">
              <label>Keterangan</label>
              <textarea rows='4' cols='20' name='ket' id='' form='edit_data' class='form-control'></textarea>
          </div>




          <div class="row">
            <div class="col-md-6">
              <fieldset class="form-group">
                <label>Tanggal Muat</label>
                <form action='/action_page.php'>
                <input type='date' class='form-control' name='date_muat' value='<?= $this->session->userdata('date_penjualan_jasa') ?>'>
              </fieldset>
            </div>

            <div class="col-md-6">
              <fieldset class="form-group">
                <label>Tanggal Bongkar</label>
                <form action='/action_page.php'>
                <input type='date' class='form-control' name='date_bongkar' value='<?= $this->session->userdata('date_penjualan_jasa') ?>'>
              </fieldset>
            </div>
          </div>



          <div class="row">
            <div class="col-md-6">
              <fieldset class="form-group">
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
              </fieldset>
            </div>

            <div class="col-md-6">

              <fieldset class="form-group">
                  <label>Supir</label>
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
              </fieldset>

            </div>
          </div>










          <div class="row">
            <div class="col-md-6">
              <fieldset class="form-group">
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
              </fieldset>
            </div>

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
          </div>











          





          <div class="row">
            <div class="col-md-6">

              <fieldset class="form-group">
                <label>PC</label>
                <input type='text' class='form-control' placeholder='Input Number' name='pc' value=''>
              </fieldset>

            </div><!-- Membungkus Row Kedua !-->


            <div class="col-md-6">

              <fieldset class="form-group">
                <label>Harga/PC</label>
                <input type='text' class='form-control' placeholder='Input Number' name='harga_pc' value=''>  
              </fieldset>
            </div> <!-- Membungkus Row !-->
          </div>



          <div class="row">
            <div class="col-md-6">

              <fieldset class="form-group">
                <label>PPN (%)</label>
                <input type='text' class='form-control' placeholder='10' name='ppn_percentage' value=''>
              </fieldset>

            </div><!-- Membungkus Row Kedua !-->


            <div class="col-md-6">

              
            </div> <!-- Membungkus Row !-->
          </div>
          




        


          <div class="modal-footer">
            <div class="created_form">
              Created By : <a name='created_by'></a>
              <br>
              Updated By : <a name='updated_by'></a>
            </div>
            <style type="text/css">
              .created_form
              {
                float: left;
                margin right: : 20px;
                font-size: 10px;
              }
            </style>
            <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
            <button type="Submit" class="btn btn-primary waves-effect waves-light ">Save changes</button>
          </div>

        </div>


<script>
  const read_data = <?= json_encode($c_t_t_t_penjualan_jasa_rincian_2) ?>;
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
        NO_SPB : no_spb,
        DATE_MUAT : date_muat,
        DATE_BONGKAR : date_bongkar,


        FROM_NAMA_KOTA : from_nama_kota,
        TO_NAMA_KOTA : to_nama_kota,

        NO_POLISI : no_polisi,
        SUPIR : supir,
       
        PC : pc,
        HARGA_PC : harga_pc,
        PPN_PERCENTAGE : ppn_percentage,
        KET : ket,
        JARAK_KM : jarak_km,
        GANDENGAN : gandengan,
        LOKASI : lokasi
   
        
      } = User[0];

      elModalEdit.querySelector("[name=id]").value = ID;



      elModalEdit.querySelector("[name=no_spb]").value = no_spb;
      elModalEdit.querySelector("[name=date_muat]").value = date_muat;
      elModalEdit.querySelector("[name=date_bongkar]").value = date_bongkar;
      elModalEdit.querySelector("[name=from_nama_kota]").value = from_nama_kota;
      elModalEdit.querySelector("[name=to_nama_kota]").value = to_nama_kota;
      elModalEdit.querySelector("[name=no_polisi]").value = no_polisi;
      elModalEdit.querySelector("[name=supir]").value = supir;
      
      elModalEdit.querySelector("[name=pc]").value = pc;
      elModalEdit.querySelector("[name=harga_pc]").value = harga_pc;

      elModalEdit.querySelector("[name=ppn_percentage]").value = ppn_percentage;
      elModalEdit.querySelector("[name=ket]").value = ket;
      elModalEdit.querySelector("[name=jarak_km]").value = jarak_km;

      elModalEdit.querySelector("[name=gandengan]").value = gandengan;
      elModalEdit.querySelector("[name=lokasi]").value = lokasi;

  



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