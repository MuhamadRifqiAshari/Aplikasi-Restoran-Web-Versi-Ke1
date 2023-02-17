<?php 
include "koneksi.php";
$noTransaksi  = $_POST['noTransaksi'];
$idCustomer   = $_POST['idCustomer'];
$sql = "SELECT * FROM tbl_menu ORDER BY id_jenis_menu, nama_menu";
$query = mysqli_query($koneksi, $sql);
while ($data = mysqli_fetch_array($query)) {
  if ($data['img']==""){
    $img = "img/no-logo.png";
  }else{ 
    $img = "img/".$data['img'];
  }
  $id_menu    = $data['id_menu'];
  $nama_menu  = strtoupper($data['nama_menu']);
  $harga      = number_format($data['harga']);
  $qty        = $data['qty'];
  $jual       = $data['jual'];?>

  <div class="col-sm-3 mb-1">
    <a>
      <input type="hidden" name="noTrans" value="<?= $noTransaksi; ?>">
      <img src="<?= $img; ?>" alt="<?= $nama_menu; ?>" class="img-responsive">
      <span></span>
      <div class="menuNama"><?= $nama_menu; ?></div>
      <div class="menuHarga"><?= "Rp. " .$harga; ?></div>
      <?php 
      if($qty-$jual>0){?>
        <div class="menuPesan"><small class="btn btn-sm btn-success pesanMenu" id2="<?= $id_menu; ?>" id3="<?= $idCustomer; ?>"><i class="fa fa-plus"></i></small></div>
        <?php 
      }else{?>
        <div class="soldOut"><img src="img/soldOut.png" class="imgSold"></div>
        <?php 
      }?>
    </a>
  </div>
  <?php 
}?>