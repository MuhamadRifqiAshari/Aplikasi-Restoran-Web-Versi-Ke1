<?php
  $judul = "MENU";
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
      <h3 class="text-center text-uppercase">Rekapitulasi Master Menu</h3>
      <hr class="hr">
    </div>
  </div>

  <div class="row mt-3">
    <div class="col-xl-12 table-responsive">
      <button type="button" class="btn btn-primary btn-sm p-1 mb-3" data-toggle="modal" data-target="#staticBackdrop">&nbsp;
        <i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah&nbsp;&nbsp;
      </button>

      <table class="table table-bordered table-hover" id="menu">
        <thead>
          <tr class="text-center">
            <th>No.</th>
            <th>Gambar</th>
            <th>Nama Menu</th>
            <th>Jenis Menu</th>
            <th>Harga</th>
            <th>Beli</th>
            <th>Jual</th>
            <th>Stok</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no 		= 1;
          $sql 		= "SELECT * FROM tbl_menu a INNER JOIN tbl_jenis_menu b ON a.id_jenis_menu = b.id_jenis_menu";
          $query 	= mysqli_query($koneksi, $sql);
          while ($data = mysqli_fetch_array($query)) { 
            $img = $data['img'];
            if($img==""){$img="no-logo.png";}
            ?>
            <tr>
              <td align="center" width="5%"><?= $no++; ?>.</td>
              <td align="center" width="8%"><img src="img/<?= $img; ?>" alt="menu" width="30px" height="30px"></td>
              <td><?= $data['nama_menu']; ?></td>
              <td><?= $data['jenis_menu']; ?></td>
              <td align="right"><?= number_format($data['harga']); ?></td>
              <td align="right"><?= number_format($data['qty']); ?></td>
              <td align="right"><?= number_format($data['jual']); ?></td>
              <td align="right"><?= number_format($data['qty']-$data['jual']); ?></td>
              <td align="center" width="12%"><a href="menu-edit.php?id_menu=<?= $data['id_menu']; ?>" class="badge badge-primary p-2" title="Edit"><i class="fas fa-edit"></i></a> | <a href="menu-delete.php?id_menu=<?= $data['id_menu']; ?>" class="badge badge-danger p-2 delete-data" title='Delete'><i class="fas fa-trash"></i></a> </td>
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
					Input Master Menu
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="menu-simpan.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id_pegawai" value="<?= $id_pegawai; ?>">

          <!-- Nama Menu -->
					<div class="input-group mb-1">
						<span class="input-group-text lebar">Nama Menu</span>
						<input type="text" name="nama_menu" required autocomplete="off" class="form-control form-control-sm" placeholder="Input Nama Menu">
					</div>

          <!-- Jenis Menu -->
					<div class="input-group mb-1">
						<span class="input-group-text lebar">Jenis Menu</span>
						<select name="id_jenis_menu" class="form-control form-control-sm" required>
							<option value="" selected>~ Pilih Jenis Menu ~</option>
              <?php 
            	$sql   = "SELECT * FROM tbl_jenis_menu ORDER BY jenis_menu";
              $query = mysqli_query($koneksi, $sql);
              while ($d = mysqli_fetch_array($query)){?>
							  <option value="<?= $d['id_jenis_menu']; ?> "><?= $d['jenis_menu']; ?></option>
                <?php 
              }?>
						</select>
					</div>

          <!-- Harga -->
					<div class="input-group mb-1">
						<span class="input-group-text lebar">Harga</span>
						<input type="text" name="harga" required autocomplete="off" class="form-control form-control-sm text-right money angkaSemua" placeholder="Input Harga">
					</div>

          <!-- Qty -->
					<div class="input-group mb-1">
						<span class="input-group-text lebar">Qty</span>
						<input type="text" name="qty" required autocomplete="off" class="form-control form-control-sm text-right money angkaSemua" placeholder="Input qty">
					</div>

          <!-- Photo -->
					<div class="input-group mb-1">
						<span class="input-group-text lebar">Photo</span>
						<input type="file" name="img" class="form-control form-control-sm" accept="image/*">
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