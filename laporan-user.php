<?php
  $judul = "Laporan";
  include "koneksi.php";
  include "header.php";
  include "sidebar.php";
  include "topbar.php";
?>

<div class="container-fluid py-5 backGambar">
  <div class="row">
    <div class="col-md-8">
      <a href="cetak-laporan-user.php" class="btn btn-sm btn-success text-white" target="_blank"><i class="fas fa-print"></i>&nbsp;Cetak Rekapitulasi User &nbsp;&nbsp;</a>
      <hr>

      <table class="table table-bordered table-hover" id="laporanUser">
        <thead>
          <tr>
            <th width="5%">No.</th>
            <th>Nama</th>
            <th>Photo</th>
            <th>Username</th>
            <th>Jabatan</th>
          </tr>
        </thead>

        <tbody>
          <?php
          $no = 1;
          $sql = "SELECT a.nama_pegawai, a.jabatan, a.photo, a.jenis_kelamin, b.id_login, b.username FROM tbl_pegawai a INNER JOIN tbl_login b ON a.id_pegawai = b.id_pegawai";
          $query = mysqli_query($koneksi, $sql);
          while ($data = mysqli_fetch_array($query)) {
            $photo          = $data['photo'];
            $jenis_kelamin  = $data['jenis_kelamin'];
            if ($photo == "" && $jenis_kelamin == "Laki-laki") {
              $photo = "photo/male.png";
            } else if ($photo == "" && $jenis_kelamin == "Perempuan") {
              $photo = "photo/female.png";
            } else {
              $photo = "photo/" . $photo;
            }?>
            <tr>
              <td align="center" width="3%"><?= $no++; ?>.</td>
              <td><?= $data['nama_pegawai']; ?></td>
              <td align="center"><img src="<?= $photo; ?>" alt="photo" width="40" height="40"></td>
              <td><?= $data['username']; ?></td>
              <td><?= $data['jabatan']; ?></td>
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
		$('#laporanUser').dataTable();

		$('.form-control-chosen').chosen({
			allow_single_deselect: true,
		});
	});
</script>