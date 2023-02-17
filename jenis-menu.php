<?php
  $judul = "JENIS MENU";
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
      <h3 class="text-center text-uppercase">Rekapitulasi Jenis Menu</h3>
      <hr class="hr">
    </div>
  </div>

  <div class="row">
    <div class="col-xl-6 table-responsive">
      <button type="button" class="btn btn-primary btn-sm p-1 my-3" data-toggle="modal" data-target="#staticBackdrop">&nbsp;
        <i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah&nbsp;&nbsp;
      </button>

      <table class="table table-bordered table-hover" id="menu">
        <thead>
          <tr class="text-center">
            <th>No.</th>
            <th>Jenis Menu</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no 		= 1;
          $sql 		= "SELECT * FROM tbl_jenis_menu ORDER BY jenis_menu";
          $query 	= mysqli_query($koneksi, $sql);
          while ($data = mysqli_fetch_array($query)) { ?>
            <tr>
              <td align="center" width="5%"><?= $no++; ?>.</td>
              <td><?= $data['jenis_menu']; ?></td>
              <td align="center" width="25%"><a href="jenis-menu-edit.php?id_jenis_menu=<?= $data['id_jenis_menu']; ?>" class="badge badge-primary p-2" title="Edit"><i class="fas fa-edit"></i></a> | <a href="jenis-menu-delete.php?id_jenis_menu=<?= $data['id_jenis_menu']; ?>" class="badge badge-danger delete-data p-2" title='Delete'><i class="fas fa-trash"></i></a> </td>
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

<!-- Modal Tambah-->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">
					Input Master Jenis Menu
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="jenis-menu-simpan.php" method="post">
					<div class="input-group mb-1">
						<input type="hidden" name="id_pegawai" value="<?= $id_pegawai; ?>">
						<span class="input-group-text lebar">Jenis Menu</span>
						<input type="text" name="jenis_menu" required autocomplete="off" class="form-control form-control-sm" placeholder="Input Jenis Menu">
					</div>
			
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i>&nbsp;&nbsp;Simpan&nbsp;</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#menu').dataTable();
	});
</script>