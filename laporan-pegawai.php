<?php
  $judul = "Laporan";
  include "koneksi.php";
  include "header.php";
  include "sidebar.php";
  include "topbar.php";
?>

<div class="container-fluid pt-3 pb-5 backGambar">
  <div class="row mt-3">
    <div class="col-xl-12 table-responsive">
      <a href="cetak-laporan-pegawai.php" class="btn btn-sm btn-success text-white mb-3" target="_blank">&nbsp;<i class="fas fa-print"></i>&nbsp;&nbsp;Cetak Rekapitulasi Pegawai&nbsp;&nbsp;</a>

      <table class="table table-bordered table-hover" id="laporanPegawai">
        <thead>
          <tr class="text-center">
            <th>No.</th>
            <th>Nama Pegawai</th>
            <th>Photo</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>Telp</th>
            <th>Jabatan</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $sql = "SELECT * FROM tbl_pegawai";
          $query = mysqli_query($koneksi, $sql);
          while ($data = mysqli_fetch_array($query)) {
            $photo          = $data['photo'];
            $jenis_Kelamin  = $data['jenis_kelamin'];
            if ($photo == "" && $jenis_Kelamin == "Laki-laki") {
              $photo = "male.png";
            } else if ($photo == "" && $jenis_Kelamin == "Perempuan") {
              $photo = "female.png";
            }
          ?>
            <tr>
              <td align="center" width="5%"><?= $no++; ?>.</td>
              <td><?= $data['nama_pegawai']; ?></td>
              <td align="center"><img src="photo/<?= $photo; ?>" alt="photo" width="40" height="40"></td>
              <td><?= $data['jenis_kelamin']; ?></td>
              <td><?= $data['alamat']; ?></td>
              <td><?= $data['telp']; ?></td>
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
		$('#laporanPegawai').dataTable();
		$('.form-control-chosen').chosen({
			allow_single_deselect: true,
		});
	});
</script>