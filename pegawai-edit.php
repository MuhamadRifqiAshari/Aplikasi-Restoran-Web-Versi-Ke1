<style>
  .backGambar{
    height:82vh;
    overflow: hidden;
  }
</style>

<?php
  $judul = "Edit Pegawai";
  include "koneksi.php";
  include "header.php";
  include "sidebar.php";
  include "topbar.php";

  $id_pegawai = $_GET['id_pegawai'];
  $sql    = "SELECT * FROM tbl_pegawai WHERE id_pegawai = '$id_pegawai'";
  $query  = mysqli_query($koneksi, $sql);
  $data   = mysqli_fetch_array($query);
  $jenis_kelamin  = $data['jenis_kelamin'];
  $jabatan        = $data['jabatan'];
  $photo          = $data['photo'];
  if ($photo == "" && $jenis_kelamin == "Laki-laki") {
    $photo = "male.png";
  } else if ($photo == "" && $jenis_kelamin == "Perempuan") {
    $photo = "female.png";
  }
?>

<div class="container-fluid pt-3 pb-5 backGambar">
  <div class="row pb-3">
    <div class="col-xl-12">	
      <h3 class="text-center text-uppercase text-dark">Edit Master Pegawai</h3>
      <hr class="hr">
    </div>
  </div>

  <div class="row ml-5">
    <div class="col-xl-4">
      <form action="pegawai-update.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_pegawai" value="<?= $id_pegawai; ?>">

        <div class="input-group input-group-sm mb-1">
          <span class="input-group-text lebar">Nama Pegawai</span>
          <input type="text" name="nama_pegawai" required autocomplete="off" class="form-control" placeholder="Input Nama Pegawai" value="<?= $data['nama_pegawai']; ?>">
        </div>

        <!-- Jenis Kelamin -->
        <div class="input-group mb-1">
          <span class="input-group-text lebar">Jenis Kelamin</span>
          <select name="jenis_kelamin" class="form-control form-control-sm" required>
            <option value="" selected>~ Pilih Jenis Kelamin ~</option>
            <option value="Laki-laki" <?php if ($jenis_kelamin == "Laki-laki") {
                            echo 'selected="selected"';
                          } ?>>Laki-laki</option>
            <option value="Perempuan" <?php if ($jenis_kelamin == "Perempuan") {
                            echo 'selected="selected"';
                          } ?>>Perempuan</option>
          </select>
        </div>

        <!-- Alamat -->
        <div class="input-group input-group-sm mb-1">
          <span class="input-group-text lebar">Alamat</span>
          <textarea name="alamat" id="" cols="30" rows="2" class="form-control"><?= $data['alamat']; ?> </textarea>
        </div>

        <!-- No Telp -->
        <div class="input-group input-group-sm mb-1">
          <span class="input-group-text lebar">No Telp / HP</span>
          <input type="text" id="telp" name="telp" required autocomplete="off" class="form-control" placeholder="Input No Telp / HP" value="<?= $data['telp']; ?>">
        </div>

        <!-- Jabatan -->
        <div class="input-group mb-1">
          <span class="input-group-text lebar">Jabatan</span>
          <?php 
          if($id_pegawai == 1){?>
            <input type="text" name="jabatan" class="form-control form-control-sm" value="Manajer" readonly>
            <?php
          }else if($id_pegawai == 2){?>
            <input type="text" name="jabatan" class="form-control form-control-sm" value="Admin" readonly>
            <?php
          }else{
            $sql    = "SELECT * FROM tbl_pegawai WHERE id_admin = '$id_pegawai'";
            $query  = mysqli_query($koneksi, $sql);
            if(mysqli_num_rows($query)>0){?>
              <input type="text" name="jabatan" class="form-control form-control-sm" value="Manajer" readonly>
              <?php 
            }else{?>
              <select name="jabatan" class="form-control form-control-sm" required>
                <option value="" selected>~ Pilih Jabatan ~</option>
                <option value="Admin" <?php if ($jabatan == "Admin") {
                              echo 'selected="selected"';
                            } ?>>Admin</option>
                <option value="Kasir" <?php if ($jabatan == "Kasir") {
                              echo 'selected="selected"';
                            } ?>>Kasir</option>
                <option value="Manajer" <?php if ($jabatan == "Manajer") {
                              echo 'selected="selected"';
                            } ?>>Manajer</option>
              </select>
              <?php
            }
          }?>
        </div>

        <!-- Gambar -->
        <div class="input-group mb-1">
          <span class="input-group-text lebar">Gambar</span>
          <img src="photo/<?= $photo; ?>" alt="photo" width="40" height="40">
        </div>

        <!-- Photo -->
        <div class="input-group mb-3">
          <span class="input-group-text lebar">Photo</span>
          <input type="file" name="photo" class="form-control form-control-sm" accept="image/*">
        </div>

        <div class="input-group mb-1 input-sm">
          <button type="submit" class="btn btn-sm btn-success">&nbsp;<i class="fas fa-save"></i>&nbsp;&nbsp;Update&nbsp;&nbsp;</button> &nbsp;| &nbsp; <a href="pegawai.php" class="btn btn-sm btn-warning">&nbsp;<i class="fas fa-redo"></i> &nbsp;&nbsp;Cancel&nbsp;&nbsp;</a>
        </div>
			</form>
		</div>
	</div>
</div>

<?php include "sticky-footer.php"; ?>    
<?php include "footer.php"; ?>
