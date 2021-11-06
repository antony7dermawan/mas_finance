<div class="card">
  <div class="card-header">


    <?php
      foreach ($c_t_t_t_penjualan_jasa_rincian_by_id as $key => $value) {
        $no_spb = $value->NO_SPB;
        $ket_rincian_jasa = $value->KET;
      }
    ?>




    <h5>Transaksi Pengeluaran NO SPB: <?=$no_spb;?></h5><br>
    <h5>Ket: <?=$ket_rincian_jasa;?></h5>
  </div>
  <div class="card-block">
    <!-- Menampilkan notif !-->
    <?= $this->session->flashdata('notif') ?>
    

    <a href="<?= base_url('c_t_t_t_penjualan_jasa_rincian/index/' . $penjualan_jasa_id); ?>" class="btn waves-effect waves-light btn-inverse"><i class="icofont icofont-double-left"></i>Back</a>



    <button data-toggle="modal" data-target="#addModal" class="btn btn-success waves-effect waves-light">New Data</button> 

    <div class="table-responsive dt-responsive">
      <table id="dom-jqry" class="table table-striped table-bordered nowrap">
        <thead>
          <tr>
            <th>ID</th>
            <th>Date</th>
            <th>No Voucer</th>
            <th>Ket</th>
            <th>Coa Kas</th>
            <th>Coa Pengeluaran</th>
            <th>Jumlah Pengeluaran</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($c_t_t_t_pengeluaran_rincian as $key => $value) 
          {
            if($value->MARK_FOR_DELETE == 'f')
            {
              echo "<tr>";
              echo "<td>".($key+1)."</td>";
              echo "<td>" . date('d-m-Y', strtotime($value->DATE)) .' / '. date('H:i:s', strtotime($value->TIME)) . "</td>";

              echo "<td>".$value->NO_VOUCER."</td>";
              echo "<td>".$value->KET."</td>";
              echo "<td>".$value->NAMA_AKUN."</td>";
              echo "<td>".$value->NAMA_AKUN_PENGELUARAN."</td>";



              echo "<td> Rp" . number_format(intval($value->VALUE)) . "</td>";
            
             

              echo "<td>";
              
              /* 
              echo "<a href='javascript:void(0);' data-toggle='modal' data-target='#Modal_Edit' class='btn-edit' data-id='".$value->ID."'>";
                echo "<i class='icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green'></i>";
              echo "</a>";

              */

              echo "<a href='".site_url('c_t_t_t_pengeluaran_rincian/delete/' . $value->ID .'/' .$penjualan_jasa_rincian_id.'/'.$penjualan_jasa_id)."' ";
              ?>
              onclick="return confirm('Apakah kamu yakin ingin menghapus data ini?')"
              <?php
              echo "> <i class='feather icon-trash-2 f-w-600 f-16 text-c-red'></i></a>";

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




<!-- MODAL TAMBAH Beban! !-->
<form action="<?php echo base_url('c_t_t_t_pengeluaran_rincian/tambah/'.$penjualan_jasa_rincian_id.'/'.$penjualan_jasa_id) ?>" method="post" id='add_data'>
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">New Data</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="">


            <div class="form-group">
              <fieldset class="form-group">
                  <label>No Voucer</label>
                  <input type='text' class='form-control' placeholder='Input Text' name='no_voucer' value=''>  
              </fieldset>
            </div>

            <div class="form-group">
              <label>Pilih Coa Kas</label>
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



          <div class="form-group">
              <label>Pilih Coa Pengeluaran</label>
              <select name="coa_id_pengeluaran" class='custom_width' id='select-state' placeholder='Pick a state...'>
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
                  <label>Tanggal</label>
                  <form action='/action_page.php'>
                  <input type='date' class='form-control' name='date' value='<?= $this->session->userdata('date_penjualan_jasa') ?>'>
                </fieldset>

              </div><!-- Membungkus Row Kedua !-->


              <div class="col-md-6">

                <fieldset class="form-group">
                  <label>Jumlah Pengeluaran</label>
                  <input type='text' class='form-control' placeholder='Input Text' name='value' value=''>  
                </fieldset>
              </div> <!-- Membungkus Row !-->
            </div>

            

            <div class="form-group">
              <label>Keterangan</label>
              <textarea rows='4' cols='20' name='ket' id='' form='add_data' class='form-control'></textarea>
            </div>






          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
            <button type="Submit" class="btn btn-primary waves-effect waves-light ">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
<!-- MODAL TAMBAH AKUN! SELESAI !-->

















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