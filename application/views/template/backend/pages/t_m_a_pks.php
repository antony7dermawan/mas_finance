<div class="card">
  <div class="card-header">
    <h5>Master Supir</h5>
  </div>
  <div class="card-block">
    <!-- Menampilkan notif !-->
    <?= $this->session->flashdata('notif') ?>
    <!-- Tombol untuk menambah data akun !-->
    <button data-toggle="modal" data-target="#addModal" class="btn btn-success waves-effect waves-light">New Data</button>

    <div class="table-responsive dt-responsive">
      <table id="dom-jqry" class="table table-striped table-bordered nowrap">
        <thead>
          <tr>
            <th>No</th>
            <th>PKS Id</th>
            <th>PKS</th>
            <th>No Pelanggan</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Npwp</th>
            <th>Telepon</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($c_t_m_a_pks as $key => $value) 
          {
            echo "<tr>";
            echo "<td>".($key + 1)."</td>";
            echo "<td>".$value->PKS_ID."</td>";
            echo "<td>".$value->PKS."</td>";
            echo "<td>".$value->NO_PELANGGAN."</td>";
            echo "<td>".$value->NAMA."</td>";
            echo "<td>".$value->ALAMAT."</td>";
            echo "<td>".$value->NPWP."</td>";
            echo "<td>".$value->TELEPON."</td>";
          
            echo "<td>";
             
            echo "<a href='javascript:void(0);' data-toggle='modal' data-target='#Modal_Edit' class='btn-edit' data-id='".$value->ID."'>";
              echo "<i class='icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green'></i>";
            echo "</a>";

            echo "<a href='".site_url('c_t_m_a_pks/delete/' . $value->ID)."' ";
            ?>
            onclick="return confirm('Apakah kamu yakin ingin menghapus data ini?')"
            <?php
            echo "> <i class='feather icon-trash-2 f-w-600 f-16 text-c-red'></i></a>";

            echo "</td>";


            echo "</tr>";

          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>




<!-- MODAL TAMBAH Beban! !-->
<form action="<?php echo base_url('c_t_m_a_pks/tambah') ?>" method="post">
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
              <label>PKS ID</label>
              <input type='text' class='form-control' placeholder='Harus Angka' name='pks_id'>
            </div>

            <div class="form-group">
              <label>PKS</label>
              <input type='text' class='form-control' placeholder='Input Text' name='pks'>
            </div>

            <div class="form-group">
              <label>No Pelanggan</label>
              <input type='text' class='form-control' placeholder='Input Text' name='no_pelanggan'>
            </div>

            <div class="form-group">
              <label>Nama</label>
              <input type='text' class='form-control' placeholder='Input Text' name='nama'>
            </div>

            <div class="form-group">
              <label>Alamat</label>
              <input type='text' class='form-control' placeholder='Input Text' name='alamat'>
            </div>

            <div class="form-group">
              <label>NPWP</label>
              <input type='text' class='form-control' placeholder='Input Text' name='npwp'>
            </div>

            <div class="form-group">
              <label>Telepon</label>
              <input type='text' class='form-control' placeholder='Input Text' name='telepon'>
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


<!-- MODAL EDIT AKUN !-->
<div class="modal fade" id="Modal_Edit" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form action="<?php echo base_url('c_t_m_a_pks/edit_action') ?>" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Data</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="">

            <input type="hidden" name="id" value="" class="form-control">

            <div class="form-group">
              <label>PKS ID</label>
              <input type='text' class='form-control' placeholder='Harus Angka' name='pks_id'>
            </div>

            <div class="form-group">
              <label>PKS</label>
              <input type='text' class='form-control' placeholder='Input Text' name='pks'>
            </div>

            <div class="form-group">
              <label>No Pelanggan</label>
              <input type='text' class='form-control' placeholder='Input Text' name='no_pelanggan'>
            </div>

            <div class="form-group">
              <label>Nama</label>
              <input type='text' class='form-control' placeholder='Input Text' name='nama'>
            </div>

            <div class="form-group">
              <label>Alamat</label>
              <input type='text' class='form-control' placeholder='Input Text' name='alamat'>
            </div>

            <div class="form-group">
              <label>NPWP</label>
              <input type='text' class='form-control' placeholder='Input Text' name='npwp'>
            </div>

            <div class="form-group">
              <label>Telepon</label>
              <input type='text' class='form-control' placeholder='Input Text' name='telepon'>
            </div>



          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
            <button type="Submit" class="btn btn-primary waves-effect waves-light ">Save changes</button>
          </div>

        </div>


<script>
  const users = <?= json_encode($c_t_m_a_pks) ?>;
  console.log(users);
  let elModalEdit = document.querySelector("#Modal_Edit");
  console.log(elModalEdit);
  let elBtnEdits = document.querySelectorAll(".btn-edit");
  [...elBtnEdits].forEach(edit => {
    edit.addEventListener("click", (e) => {
      let id = edit.getAttribute("data-id");
      let User = users.filter(user => {
        if (user.ID == id)
          return user;
      });
      const {
        ID,
        PKS_ID : pks_id,
        PKS : pks,
        NO_PELANGGAN : no_pelanggan,
        NAMA : nama,
        ALAMAT : alamat,
        NPWP : npwp,
        TELEPON : telepon
      } = User[0];

      elModalEdit.querySelector("[name=id]").value = ID;
      elModalEdit.querySelector("[name=pks_id]").value = pks_id;
      elModalEdit.querySelector("[name=pks]").value = pks;
      elModalEdit.querySelector("[name=no_pelanggan]").value = no_pelanggan;
      elModalEdit.querySelector("[name=nama]").value = nama;
      elModalEdit.querySelector("[name=alamat]").value = alamat;
      elModalEdit.querySelector("[name=npwp]").value = npwp;
      elModalEdit.querySelector("[name=telepon]").value = telepon;

    })
  })
</script>

    </form>
  </div>
</div>
<!-- MODAL EDIT AKUN! SELESAI !-->

