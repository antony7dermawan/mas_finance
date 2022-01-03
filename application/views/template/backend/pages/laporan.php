<div class="card">
  <div class="card-header">
    <form action='<?php echo base_url("c_t_ak_jurnal_history/search_date"); ?>' class='no_voucer_area' method="post" id=''>

      <label>Pilih Laporan:</label>

      <select name="pilih_laporan" class='pilih_laporan' id='id_pilih_laporan' placeholder='Pick a state...'>
        <?php

        $level_user_id = $this->session->userdata('level_user_id');
        if($level_user_id<8)
        {


          echo "<option value='laporan_excel/lap_tagihan_per_payment_method/index/' >Laporan Tagihan per Metode Bayar</option>";

          echo "<option value='laporan_excel/lap_neraca_bulanan/index/' >Neraca Bulanan</option>";


          echo "<option value='laporan_excel/lap_tagihan/index/' >Laporan Tagihan</option>";

          echo "<option value='laporan_excel/lap_do_global/index/' >Laporan DO Global</option>";

          echo "<option value='laporan_excel/lap_do_global_per_pelanggan/index/' >Laporan DO Global per Pelanggan</option>";

          echo "<option value='laporan_excel/lap_trial_balance/index/' >Laporan Trial Balance</option>";
          echo "<option value='laporan_excel/lap_laba_rugi/index/' >Laporan Laba Rugi</option>";
          echo "<option value='laporan_excel/lap_neraca/index/' >Laporan Neraca</option>";
          echo "<option value='laporan_excel/lap_jurnal/index/' >Laporan Jurnal</option>";
          echo "<option value='laporan_excel/lap_jurnal_per_sub_akun/index/' >Laporan Jurnal per Sub Akun</option>";


          echo "<option value='laporan_excel/lap_saldo_akun_parent_1_per_sub_akun/index/' >Laporan Saldo Akun Parent 1 per Sub Akun</option>";
        }
          
        
        
        ?>
      </select>

      <div class='sub' id='sub'>
        <label>Sub Akun</label>
            <select name="sub_id" class='sub_id' id='sub_id' placeholder='Pick a state...'>
              
              <?php
              foreach ($c_ak_m_sub as $key => $value) 
              {
                echo "<option value='".$value->SUB_ID."'>".$value->SUB."</option>";

              }
              ?>
            </select>
      </div>



      <div class='pelanggan' id='pelanggan'>
        <label>Pilih Pelanggan</label>
            <select name="pelanggan_id" class='' id='pelanggan_id' placeholder='Pick a state...'>
            
            <?php
            foreach ($c_t_m_d_pelanggan as $key => $value) 
            {
              echo "<option value='".$value->ID."'>".$value->PELANGGAN."</option>";
            }
            ?>
          </select>
      </div>


      <div class='payment_method' id='payment_method'>
        <label>Pilih Metode Bayar</label>
            <select name="payment_method_id" class='' id='payment_method_id' placeholder='Pick a state...'>
            
            <?php
            foreach ($c_t_m_d_payment_method as $key => $value) 
            {
              echo "<option value='".$value->ID."'>".$value->PAYMENT_METHOD."</option>";
            }
            ?>
          </select>
      </div>


      <table>
        <tr>
          <th>Periode:</th>
          <th>
            <form action='/action_page.php'>
              <input type='date' class='form-control' id='date_from_laporan' value='<?php echo $this->session->userdata('date_from_select_jurnal'); ?>'>
          </th>
          <th>-</th>
          <th>
            <form action='/action_page.php'>
              <input type='date' class='form-control' id='date_to_laporan' value='<?php echo $this->session->userdata('date_to_select_jurnal'); ?>'>
          </th>
          <th>


            <button type='button' class='btn btn-success' onclick='call_download()'>Download</button>
          </th>
        </tr>
      </table>


    </form>
  </div>

</div>


<?php
//document.getElementById("password_edit").value

?>




<script type="text/javascript">

$(document).ready(function()
{
  $(".pilih_laporan").change(function()
  {
    var pilih_laporan=$(this).val();
    console.log(pilih_laporan);
    
    if(pilih_laporan=="laporan_excel/lap_jurnal_per_sub_akun/index/" || pilih_laporan=="laporan_excel/lap_saldo_akun_parent_1_per_sub_akun/index/")
    {
      document.getElementById('sub').style.display = 'block';
      document.getElementById('pelanggan').style.display = 'none';
      document.getElementById('payment_method').style.display = 'none';

    }

    else if(pilih_laporan=="laporan_excel/lap_do_global_per_pelanggan/index/")
    {
      document.getElementById('sub').style.display = 'none';
      document.getElementById('pelanggan').style.display = 'block';
      document.getElementById('payment_method').style.display = 'none';
    }

    else if(pilih_laporan=="laporan_excel/lap_tagihan_per_payment_method/index/")
    {
      document.getElementById('sub').style.display = 'none';
      document.getElementById('pelanggan').style.display = 'none';
      document.getElementById('payment_method').style.display = 'block';
    }

    else
    {
      document.getElementById('sub').style.display = 'none';
      document.getElementById('pelanggan').style.display = 'none';
      document.getElementById('payment_method').style.display = 'none';
    }
    
  });


});



</script>


<script type="text/javascript">
  function call_download() {
    var link_1 = document.getElementById("id_pilih_laporan").value;
    var link_2 = document.getElementById("date_from_laporan").value;
    var link_3 = document.getElementById("date_to_laporan").value;
    var link_4 = parseInt(document.getElementById("sub_id").value);
    var link_5 = parseInt(document.getElementById("pelanggan_id").value);
    var link_6 = parseInt(document.getElementById("payment_method_id").value);
    var slash = "/";

    var link = link_1.concat(link_2, slash, link_3, slash, link_4 ,slash ,link_5,slash ,link_6);
    window.open(link);
  }
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('select').selectize({
      sortField: 'text'
    });
  });
</script>




<style type="text/css">

  .sub
  {
    display: none;
  }

  .pelanggan
  {
    display: none;
  }
   .payment_method
  {
    display: none;
  }


  div.searchable {
    width: 90%;
    margin: 0 15px;
  }

  .background-white {
    background-color: white;
  }

  .background-blue {
    background-color: #151B54;
    color: white;
  }




  .searchable input {
    width: 100%;
    height: 25px;
    font-size: 12px;
    padding: 10px;
    -webkit-box-sizing: border-box;
    /* Safari/Chrome, other WebKit */
    -moz-box-sizing: border-box;
    /* Firefox, other Gecko */
    box-sizing: border-box;
    /* Opera/IE 8+ */
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





<style type="text/css">
  .text_red {
    color: red;
  }

  .text_black {
    color: black;
  }
</style>