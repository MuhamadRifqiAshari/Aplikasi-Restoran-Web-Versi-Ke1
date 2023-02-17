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
      <a href="cetak-laporan-customer.php" class="btn btn-sm btn-success text-white mb-3" target="_blank">&nbsp;<i class="fas fa-print"></i>&nbsp;&nbsp;Cetak Rekapitulasi Customer&nbsp;&nbsp;</a>

      <table class="table table-bordered table-hover" id="laporanPegawai">
        <thead>
          <tr class="text-center">
            <th>No.</th>
            <th>Tanggal</th>
            <th>Nama Customer</th>
            <th>Alamat</th>
            <th>Telp</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $sql = "SELECT * FROM tbl_customer ORDER BY tanggal DESC";
          $query = mysqli_query($koneksi, $sql);
          while ($data = mysqli_fetch_array($query)) {
            $tanggal = date_create($data['tanggal']);?>
            <tr>
              <td align="center" width="4%"><?= $no++; ?>.</td>
              <td align="center" width="10%"><?= date_format($tanggal, "d-m-Y"); ?></td>
              <td width="20%"><?= $data['nama']; ?></td>
              <td><?= $data['alamat']; ?></td>
              <td width="15%"><?= $data['telp']; ?></td>
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