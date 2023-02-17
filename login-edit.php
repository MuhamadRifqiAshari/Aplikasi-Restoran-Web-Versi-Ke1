<style>
  .backGambar{
    height:82vh;
    overflow: hidden;
  }
</style>
<?php
$judul = "Edit Master Login";
include "koneksi.php";
include "header.php";
include "sidebar.php";
include "topbar.php";


$id_login     = $_GET['id_login'];
$sql          = "SELECT * FROM tbl_login a INNER JOIN tbl_pegawai b ON a.id_pegawai  = b.id_pegawai WHERE a.id_login = '$id_login'";
$query= mysqli_query($koneksi, $sql);
$data = mysqli_fetch_array($query);
$id_pegawai   = $data['id_pegawai'];
$nama_pegawai = $data['nama_pegawai'];
$jabatan      = $data['jabatan'];

$id_admin     = $_SESSION['id_pegawai'];
?>

<div class="container-fluid pt-3 pb-5 backGambar">
  <div class="row pb-3">
    <div class="col-xl-12">	
      <h3 class="text-center text-uppercase text-dark">Edit Master Login</h3>
      <hr class="hr">
    </div>
  </div>
  <div class="row ml-5">
    <div class="col-xl-5">
      <form action="login-update.php" method="post">
        <input type="hidden" name="id_pegawai" value="<?= $id_pegawai;?>">
        <input type="hidden" name="id_admin" value="<?= $id_admin;?>">

        <div class="input-group mb-1">
          <span class="input-group-text lebar" >Nama Pegawai</span>
          <input class="form-control form-control-sm" type="text" value="<?= $nama_pegawai; ?> - <?= $jabatan; ?>" readonly>
        </div>

        <div class="input-group mb-1">
          <span class="input-group-text lebar" >Username</span>
          <input  type="hidden" name="username" value="<?= $data['username'];?>">
          <input  type="text" name="username1" class="form-control form-control-sm" required autocomplete="off" value="<?= $data['username'];?>">
        </div>

        <div class="input-group mb-3">
          <span class="input-group-text lebar" >Password</span>
          <input type="password" name="password" class="form-control form-control-sm" required >
        </div>

        <div class="input-group mb-1">
          <button type="submit" class="btn btn-success btn-sm">&nbsp;<i class="fas fa-save"></i>&nbsp;&nbsp;Update&nbsp;&nbsp;</button>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="login.php" class="btn btn-sm btn-warning">&nbsp;<i class="fas fa-redo"></i>&nbsp;&nbsp;Cancel&nbsp;&nbsp;</a>
        </div>
      </form>
		</div>
	</div>
</div>

<?php include "sticky-footer.php"; ?>    
<?php include "footer.php"; ?>
