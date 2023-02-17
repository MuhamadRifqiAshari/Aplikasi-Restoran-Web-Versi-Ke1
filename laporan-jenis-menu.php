<?php
  $judul = "Laporan";
  include "koneksi.php";
  include "header.php";
  include "sidebar.php";
  include "topbar.php";
?>

<div class="container-fluid pt-3 pb-5 backGambar">
  <div class="row mt-3">
    <div class="col-xl-6 table-responsive">
      <a href="cetak-laporan-jenis-menu.php" class="btn btn-sm btn-success text-white mb-3" target="_blank">&nbsp;<i class="fas fa-print"></i>&nbsp;&nbsp;Cetak Rekapitulasi Jenis Menu&nbsp;&nbsp;</a>

      <table class="table table-bordered table-hover" id="laporanMenu">
        <thead>
          <tr class="text-center">
            <th>No.</th>
            <th>Jenis Menu</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no 		= 1;
          $sql 		= "SELECT * FROM tbl_jenis_menu";
          $query 	= mysqli_query($koneksi, $sql);
          while ($data = mysqli_fetch_array($query)) { ?>
            <tr>
              <td align="center" width="5%"><?= $no++; ?>.</td>
              <td><?= $data['jenis_menu']; ?></td>
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
		$('#laporanMenu').dataTable();
		$('.form-control-chosen').chosen({
			allow_single_deselect: true,
		});
	});
</script>