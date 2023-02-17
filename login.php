<?php
  $judul = "Login";
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
      <h3 class="text-center text-uppercase text-dark">Rekapitulasi Master Login</h3>
      <hr class="hr">
    </div>
  </div>

  <div class="row">
    <div class="col-xl-10 table-responsive">
      <button type="button" class="btn btn-primary btn-sm px-2 my-3" data-toggle="modal" data-target="#staticBackdrop" title="tambah data">
        <i class="fas fa-plus"></i>&nbsp;Tambah&nbsp;&nbsp;
      </button>

      <table class="table table-bordered table-hover" id="login">
        <thead>
          <tr class="text-center">
            <th width="5%">No.</th>
            <th>Nama</th>
            <th>Photo</th>
            <th>Username</th>
            <th>Jabatan</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php
          $no = 1;
          $sql = "SELECT a.id_pegawai, a.nama_pegawai, a.jabatan, a.photo, a.jenis_kelamin, b.id_login, b.username FROM tbl_pegawai a INNER JOIN tbl_login b ON a.id_pegawai = b.id_pegawai";
          $query = mysqli_query($koneksi, $sql);
          while ($data = mysqli_fetch_array($query)) {
            $id_pegawai     = $data['id_pegawai'];
            $photo          = $data['photo'];
            $jenis_kelamin  = $data['jenis_kelamin'];
            if ($photo == "" && $jenis_kelamin == "Laki-laki") {
              $photo = "photo/man.png";
            } else if ($photo == "" && $jenis_kelamin == "Perempuan") {
              $photo = "photo/woman.png";
            } else {
              $photo = "photo/" . $photo;
            }
          ?>
            <tr>
              <td align="center" width="3%"><?= $no++; ?>.</td>
              <td><?= $data['nama_pegawai']; ?></td>
              <td align="center"><img src="<?= $photo; ?>" alt="photo" width="40" height="40"></td>
              <td><?= $data['username']; ?></td>
              <td><?= $data['jabatan']; ?></td>
              <td align="center" width="15%">
                <a href="login-edit.php?id_login=<?= $data['id_login']; ?>" class="badge badge-primary p-2" title="Edit"><i class="fas fa-edit"></i></a> 
                <?php 
                if($id_pegawai>2){?>
                  | <a href="login-delete.php?id_login=<?= $data['id_login']; ?>" class="badge badge-danger p-2 delete-data" title='Delete'><i class="fas fa-trash"></i></a>
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
					Input Master Login
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<form action="login-simpan.php" method="post">
					<div class="input-group mb-1">
						<span class="input-group-text lebar">Nama Pegawai</span>
						<select name="id_pegawai" class="form-control-chosen form-control-sm" required>
							<option value="" selected>~ Pilih Nama Pegawai ~</option>
							<?php
							include "koneksi.php";
							$sql = "SELECT * FROM tbl_pegawai ORDER BY nama_pegawai";
							$query = mysqli_query($koneksi, $sql);
							while ($data   = mysqli_fetch_array($query)) {
								$id_pegawai = $data['id_pegawai'];
								$sql1       = "SELECT id_pegawai FROM tbl_login WHERE id_pegawai  = '$id_pegawai' ORDER BY id_pegawai";
								$query1     = mysqli_query($koneksi, $sql1);
								if (mysqli_num_rows($query1) == 0) { ?>
									<option value=<?= $data['id_pegawai']; ?>><?= $data['nama_pegawai']; ?> - <?= $data['jabatan']; ?> </option>
							<?php
								}
							}
							?>
						</select>
					</div>
			
          <div class="input-group input-group-sm mb-1">
						<span class="input-group-text lebar">Username</span>
						<input type="text" name="username" required autocomplete="off" class="form-control form-control-sm" placeholder="Input Username">
					</div>

          <div class="input-group mb-1">
						<span class="input-group-text lebar">Password</span>
						<input type="password" name="password" required class="form-control form-control-sm" placeholder="Input Password">
					</div>

					<div class="modal-footer">
						<button type="submit" class="btn btn-primary btn-sm">&nbsp;<i class="fas fa-save"></i>&nbsp;&nbsp;Simpan&nbsp;&nbsp;</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#login').dataTable();

		$('.form-control-chosen').chosen({
			allow_single_deselect: true,
		});

	});
</script>
