<?php
  $judul = "Pegawai";
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
      <h3 class="text-center text-uppercase text-dark">Rekapitulasi Master Pegawai</h3>
      <hr class="hr">
    </div>
  </div>

  <div class="row">
    <div class="col-xl-12 table-responsive">
      <button type="button" class="btn btn-primary btn-sm p-1 mb-3" data-toggle="modal" data-target="#staticBackdrop">&nbsp;
        <i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah &nbsp;&nbsp;
      </button>

      <table class="table table-bordered table-hover" id="pegawai">
        <thead>
          <tr class="text-center">
            <th>No.</th>
            <th>Nama Pegawai</th>
            <th>Photo</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>Telp</th>
            <th>Jabatan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $sql = "SELECT * FROM tbl_pegawai";
          $query = mysqli_query($koneksi, $sql);
          while ($data = mysqli_fetch_array($query)) {
            $id_pegawai     = $data['id_pegawai'];
            $photo          = $data['photo'];
            $jenis_Kelamin  = $data['jenis_kelamin'];
            if ($photo == "" && $jenis_Kelamin == "Laki-laki") {
              $photo = "male.png";
            } else if ($photo == "" && $jenis_Kelamin == "Perempuan") {
              $photo = "female.png";
            }?>

            <tr>
              <td align="center" width="5%"><?= $no++; ?>.</td>
              <td><?= $data['nama_pegawai']; ?></td>
              <td align="center"><img src="photo/<?= $photo; ?>" alt="photo" width="40" height="40"></td>
              <td><?= $data['jenis_kelamin']; ?></td>
              <td><?= $data['alamat']; ?></td>
              <td><?= $data['telp']; ?></td>
              <td><?= $data['jabatan']; ?></td>

              <td align="center">
                <a href="pegawai-edit.php?id_pegawai=<?= $id_pegawai ?>" class="badge badge-primary p-2" title="Edit"><i class="fas fa-edit"></i></a>  
                <?php 
                  if($id_pegawai>2){?> 
                    | 
                    <a href="pegawai-delete.php?id_pegawai=<?= $data['id_pegawai']; ?>" class="badge badge-danger p-2 delete-data" title="Delete"><i class="fas fa-trash"></i></a> 
                    <?php 
                  }?>
              </td>
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
					Input Master Pegawai
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="pegawai-simpan.php" method="post" enctype="multipart/form-data">
					<div class="input-group input-group-sm mb-1">
						<span class="input-group-text lebar">Nama Pegawai</span>
						<input type="text" name="nama_pegawai" required autocomplete="off" class="form-control" placeholder="Input Nama Pegawai">
					</div>
					<div class="input-group mb-1">
						<span class="input-group-text lebar">Jenis Kelamin</span>
						<select name="jenis_kelamin" class="form-control form-control-sm" required>
							<option value="" selected>~ Pilih Jenis Kelamin ~</option>
							<option value="Laki-laki">Laki-laki</option>
							<option value="Perempuan">Perempuan</option>
						</select>
					</div>
					<div class="input-group input-group-sm mb-1">
						<span class="input-group-text lebar">Alamat</span>
						<textarea name="alamat" id="" cols="30" rows="2" class="form-control"></textarea>
					</div>
					<div class="input-group input-group-sm mb-1">
						<span class="input-group-text lebar">No Telp / HP</span>
						<input type="text" name="telp" required autocomplete="off" class="form-control form-control-sm" placeholder="Input No Telp / HP">
					</div>

					<!-- Jabatan -->
					<div class="input-group mb-1">
						<span class="input-group-text lebar">Jabatan</span>
						<select name="jabatan" class="form-control form-control-sm" required>
							<option value="" selected>~ Pilih Jabatan ~</option>
							<option value="Admin">Admin</option>
							<option value="Kasir">Kasir</option>
							<option value="Manajer">Manajer</option>
						</select>
					</div>

					<!-- Photo -->
					<div class="input-group mb-1">
						<span class="input-group-text lebar">Photo</span>
						<input type="file" name="photo" class="form-control form-control-sm" accept="image/*">
					</div>

					<div class="modal-footer">
						<button type="submit" class="btn btn-primary btn-sm">&nbsp;<i class="fas fa-save"></i>&nbsp;&nbsp;Simpan&nbsp;</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#pegawai').dataTable();
	});
</script>