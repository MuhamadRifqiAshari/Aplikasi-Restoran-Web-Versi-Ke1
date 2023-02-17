<?php
  $judul = "Laporan";
  include "koneksi.php";
  include "header.php";
  include "sidebar.php";
  include "topbar.php";
?>

<div class="container-fluid pt-3 pb-5 backGambar">
  <div class="row mt-3">
    <div class="col-xl-8 table-responsive">
      <a href="cetak-laporan-menu.php" class="btn btn-sm btn-success text-white mb-3" target="_blank">&nbsp;<i class="fas fa-print"></i>&nbsp;&nbsp;Cetak Rekapitulasi Daftar Menu&nbsp;&nbsp;</a>

      <table class="table table-bordered table-hover" id="laporanMenu">
        <thead>
          <tr class="text-center">
            <th>No.</th>
            <th>Gambar</th>
            <th>Nama Menu</th>
            <th>Jenis Menu</th>
            <th>Harga</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no 		= 1;
          $sql 		= "SELECT * FROM tbl_menu a INNER JOIN tbl_jenis_menu b ON a.id_jenis_menu = b.id_jenis_menu";
          $query 	= mysqli_query($koneksi, $sql);
          while ($data = mysqli_fetch_array($query)) { 
            $img = $data['img'];?>
            <tr>
              <td align="center" width="5%"><?= $no++; ?>.</td>
              <td align="center"><img src="img/<?= $img; ?>" alt="gambar" width="30px" height="30px"></td>
              <td><?= $data['nama_menu']; ?></td>
              <td><?= $data['jenis_menu']; ?></td>
              <td align="right"><?= number_format($data['harga']); ?></td>
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