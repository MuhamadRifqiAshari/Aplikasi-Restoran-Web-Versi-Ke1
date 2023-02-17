<?php
session_start();
include "koneksi.php";
$id_pegawai   = $_SESSION['id_pegawai'];

$no_transaksi   = $_POST['no_transaksi'];
$id_menu	      = $_POST['id_menu'];
$tgl_transaksi  = $_POST['tgl_transaksi'];
$harga = str_replace(',','', mysqli_escape_string($koneksi, $_POST['harga']));
$qty             = $_POST['qty'];
$total_transaksi = $qty*$harga;
$no_meja         = $_POST['no_meja'];

// Cari Stok Menu
$sql      = "SELECT * FROM tbl_menu WHERE id_menu = '$id_menu' ORDER BY id_menu";
$query    = mysqli_query($koneksi, $sql);
$data     = mysqli_fetch_array($query);
$qtyMenu  = $data['qty'];
$qtyJual  = $data['jual'];
if($qtyJual+$qty<=$qtyMenu){
  if($no_transaksi == ""){
    $sql = "INSERT INTO tbl_transaksi(tgl_transaksi, total_transaksi, id_pegawai, no_meja, kode) VALUES('$tgl_transaksi', '$total_transaksi', '$id_pegawai', '$no_meja', 1)";
    mysqli_query($koneksi, $sql);

    $sql    = "SELECT * FROM tbl_transaksi ORDER BY id_transaksi DESC";
    $query  = mysqli_query($koneksi, $sql);
    $data   = mysqli_fetch_array($query);
    $tgl    = $data['tgl_transaksi'];
    $id_transaksi = $data['id_transaksi'];

    if($id_transaksi<10){
      $noTransaksi = "00000000".$id_transaksi;
    }else if($id_transaksi<100){
      $noTransaksi = "0000000".$id_transaksi;
    }else if($id_transaksi<1000){
      $noTransaksi = "000000".$id_transaksi;
    }else if($id_transaksi<10000){
      $noTransaksi = "00000".$id_transaksi;
    }else if($id_transaksi<100000){
      $noTransaksi = "0000".$id_transaksi;
    }else if($id_transaksi<1000000){
      $noTransaksi = "000".$id_transaksi;
    }else if($id_transaksi<10000000){
      $noTransaksi = "00".$id_transaksi;
    }else if($id_transaksi<100000000){
      $noTransaksi = "0".$id_transaksi;
    }
    $tglTransaksi = str_replace('-','', mysqli_escape_string($koneksi, $tgl));
    $noTransaksi = $tglTransaksi.$noTransaksi;

    $sql = "UPDATE tbl_transaksi SET no_transaksi = '$noTransaksi' 
    WHERE id_transaksi =  '$id_transaksi'";
    mysqli_query($koneksi, $sql);
  }else{
    $noTransaksi   = $no_transaksi;
    $sql = "UPDATE tbl_transaksi SET total_transaksi = total_transaksi + '$total_transaksi' WHERE no_transaksi =  '$noTransaksi'";
    mysqli_query($koneksi, $sql);
  }

  $sql = "INSERT INTO tbl_transaksi_detail(no_transaksi, id_menu, qty, harga, id_pegawai) VALUES('$noTransaksi', '$id_menu', '$qty', '$harga', '$id_pegawai')";
  mysqli_query($koneksi, $sql);

  $sql = "UPDATE tbl_menu SET jual = jual + '$qty' WHERE id_menu = '$id_menu'";
  mysqli_query($koneksi, $sql);

  $sql    = "SELECT * FROM tbl_transaksi ORDER BY id_transaksi DESC";
  $query  = mysqli_query($koneksi, $sql);
  $data   = mysqli_fetch_assoc($query);
  $result = [];
  $result = $data;
  echo json_encode($result);
}else{
  echo "Kelebihan";
}
?>
