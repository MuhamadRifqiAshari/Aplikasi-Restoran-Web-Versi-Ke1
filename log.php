<?php
  $judul = "PEGAWAI";
  include "koneksi.php";
  include "header.php";
  include "sidebar.php";
  include "topbar.php";
?>
<!-- SweetAlert2 -->
<div class="info-data" data-infodata="<?php if(isset($_SESSION['info'])){ 
  echo $_SESSION['info']; 
  } 
  unset($_SESSION['info']); ?>">
</div>

<div class="container-fluid pt-3 pb-5 backGambar">
  <div class="row">
    <div class="col-xl-12">
      <h3 class="text-center text-uppercase text-dark">Rekapitulasi Log Pegawai</h3>
      <hr class="hr">
    </div>
  </div>

  <div class="row ml-1 mt-2">
    <div class="col-xl-12 table-responsive">
      <table class="table table-bordered table-hover" id="log">
        <thead>
          <tr class="text-center">
            <th>No.</th>
            <th>Nama Pegawai</th>
            <th>Jabatan</th>
            <th>Aksi</th>
            <th>Tanggal</th>
            <?php 
            if($jabatan == "Manajer"){?>
              <th>Aksi</th>
              <?php 
            }?>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $sql = "SELECT * FROM tbl_log ORDER BY date DESC, id_log DESC";
          $query = mysqli_query($koneksi, $sql);
          while ($data = mysqli_fetch_array($query)) {
            $aksi = $data['aksi'];
            $id_pegawai   = $data['id_pegawai'];
            $nama_pegawai = $data['nama_pegawai'];
            $jbt          = $data['jabatan'];
            if($nama_pegawai=="" || is_null($nama_pegawai)){
              $sql1   = "SELECT * FROM tbl_customer WHERE id_customer = '$id_pegawai'";
              $query1 = mysqli_query($koneksi, $sql1);
              if(mysqli_num_rows($query1)>0){
                $data1  = mysqli_fetch_array($query1);
                $nama_pegawai = $data1['nama'];
                $jbt    = 'Customer';

                $sql2 = "UPDATE tbl_log SET 
                  nama_pegawai = '$nama_pegawai', 
                  jabatan = 'Customer' 
                WHERE id_pegawai = '$id_pegawai'";
                mysqli_query($koneksi, $sql2);
              }
            }
            ?>
            <tr>
              <td align="center" width="5%"><?= $no++; ?>.</td>
              <td width="22%"><?= $nama_pegawai; ?></td>
              <td><?= $jbt; ?></td>
              <td><?= $aksi; ?></td>
              <td align="center" width="18%"><?= $data['date']; ?></td>
              <?php 
              if($jabatan == "Manajer"){?>
                <td align="center" width="5%"><a href="log-delete.php?id_log=<?= $data['id_log']; ?>" class="badge badge-danger p-2 delete-data" title="Delete"><i class="fas fa-trash"></i></a> </td>
                <?php 
              }?>
            </tr>
          <?php
          } ?>
        </tbody>
      </table>
		</div>
	</div>
</div>

<?php include "sticky-footer.php"; ?>
<?php include "footer.php"; ?>

<script>
	$(document).ready(function() {
		$('#log').dataTable();
	});
</script>