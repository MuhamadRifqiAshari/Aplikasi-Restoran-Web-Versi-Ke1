<?php
  $judul = "Edit Menu";
  include "koneksi.php";
  include "header.php";
  include "sidebar.php";
  include "topbar.php";

  $id_jenis_menu  = $_GET['id_jenis_menu'];
  $sql        = "SELECT * FROM tbl_jenis_menu WHERE id_jenis_menu = '$id_jenis_menu'";
  $query      = mysqli_query($koneksi, $sql);
  $data       = mysqli_fetch_array($query);
  $jenis_menu = $data['jenis_menu'];
?>

<div class="container-fluid pt-3 pb-5 backGambar">
  <div class="row pb-3">
    <div class="col-xl-12">	
      <h3 class="text-center text-uppercase text-dark">Edit Master Jenis Menu</h3>
      <hr class="hr">
    </div>
  </div>
  <div class="row ml-5">
    <div class="col-xl-4">
      <form action="jenis-menu-update.php" method="post">
        <input type="hidden" name="id_jenis_menu" value="<?= $id_jenis_menu;?>">

        <div class="input-group mb-2">
          <span class="input-group-text lebar" >Jenis Menu</span>

          <input type="hidden" name="jenis_menu1" value="<?= $data['jenis_menu'];?>" >

          <input type="text" name="jenis_menu" required autocomplete="off" class="form-control form-control-sm" placeholder="Input Jenis Menu" value="<?= $data['jenis_menu'];?>" >
        </div>

        <div class="input-group">
          <button type="submit" class="btn btn-success btn-sm">&nbsp;<i class="fas fa-save"></i>&nbsp;&nbsp;Update&nbsp;&nbsp;</button>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="jenis-menu.php" class="btn btn-sm btn-warning">&nbsp;<i class="fas fa-redo"></i>&nbsp;&nbsp;Cancel&nbsp;&nbsp;</a>
        </div>
			</form>
		</div>
	</div>
</div>

<?php include "sticky-footer.php"; ?>    
<?php include "footer.php"; ?>
