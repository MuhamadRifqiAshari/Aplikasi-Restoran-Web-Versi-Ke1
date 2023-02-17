<?php
session_start();
date_default_timezone_set("Asia/Jakarta");
include "koneksi.php";

$idMenu	= $_POST['idMenu'];
$sql    = "SELECT * FROM tbl_menu WHERE id_menu = '$idMenu'";
$query  = mysqli_query($koneksi, $sql);
$data   = mysqli_fetch_array($query);
$harga  = $data['harga'];

$noTransaksi= $_POST['noTrans'];
if($noTransaksi==""){
  $tgl    = date('Y-m-d');
  $sql1   = "SELECT * FROM tbl_transaksi ORDER BY id_transaksi DESC";
  $query1 = mysqli_query($koneksi, $sql1);
  if(mysqli_num_rows($query1)>0){
    $data1= mysqli_fetch_array($query1);
    $id_transaksi = $data1['id_transaksi']+1;
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
  }else{
    $noTransaksi = "000000001";
  }
  $tglTransaksi = str_replace('-','', mysqli_escape_string($koneksi, $tgl));
  $noTransaksi  = $tglTransaksi.$noTransaksi;
}

$idCustomer = $_POST['idCustomer'];
$sql2 = "SELECT * FROM tbl_transaksi WHERE id_pegawai = '$idCustomer' AND kode='2' AND total_bayar = 0 ORDER BY id_transaksi DESC";
$query2 = mysqli_query($koneksi, $sql2);
if(mysqli_num_rows($query2)>0){
  $data2   = mysqli_fetch_array($query2);
  $id_transaksi = $data2['id_transaksi'];
 
  $sql2 = "UPDATE tbl_transaksi SET total_transaksi =  total_transaksi + '$harga' 
  WHERE id_transaksi =  '$id_transaksi'";
  mysqli_query($koneksi, $sql2);
}else{
  $sql2 = "INSERT INTO tbl_transaksi(tgl_transaksi, no_transaksi, total_transaksi, id_pegawai, kode) VALUES('$tgl', '$noTransaksi', '$harga', '$idCustomer', 2)";
  mysqli_query($koneksi, $sql2);
}

$sql3 = "SELECT * FROM tbl_transaksi_detail WHERE no_transaksi = '$noTransaksi' AND id_menu = '$idMenu' ORDER BY no_transaksi";
$query3 = mysqli_query($koneksi, $sql3);
if(mysqli_num_rows($query3)>0){
  $sql3 = "UPDATE tbl_transaksi_detail SET qty =  qty + 1 
  WHERE no_transaksi = '$noTransaksi' AND id_menu = '$idMenu'";
  mysqli_query($koneksi, $sql3);
}else{
  $sql3 = "INSERT INTO tbl_transaksi_detail(no_transaksi, id_menu, qty, harga, id_pegawai) VALUES('$noTransaksi', '$idMenu', '1', '$harga', '$idCustomer')";
  mysqli_query($koneksi, $sql3);
}

$sql4 = "UPDATE tbl_menu SET jual =  jual + 1 WHERE id_menu = '$idMenu'";
mysqli_query($koneksi, $sql4);

$sql = "SELECT sum(b.qty) AS qty, a.no_transaksi, c.qty AS stock, c.jual FROM tbl_transaksi a INNER JOIN tbl_transaksi_detail b ON a.no_transaksi = b.no_transaksi INNER JOIN tbl_menu c ON b.id_menu =  c.id_menu WHERE a.id_pegawai = '$idCustomer' AND a.total_bayar = 0 ORDER BY a.no_transaksi DESC";
$query  = mysqli_query($koneksi, $sql);
$data   = mysqli_fetch_assoc($query);
$result = [];
$result = $data;
echo json_encode($result);
?>
