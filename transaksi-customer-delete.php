<?php
include "koneksi.php";
$id_detail  = $_GET['id_detail'];

$sql1   = "SELECT * FROM tbl_transaksi_detail WHERE id_detail = '$id_detail' ORDER BY id_detail";
$query1 = mysqli_query($koneksi, $sql1);
$data1  = mysqli_fetch_array($query1);
$no_transaksi     = $data1['no_transaksi'];
$id_menu          = $data1['id_menu'];
$qty              = $data1['qty'];
$harga            = $data1['harga'];
$total_transaksi  = $qty*$harga;

$sql2 = "DELETE FROM tbl_transaksi_detail WHERE id_detail = '$id_detail'";
mysqli_query($koneksi, $sql2);

$sql3 = "UPDATE tbl_menu SET jual = jual - '$qty' WHERE id_menu = '$id_menu'";
mysqli_query($koneksi, $sql3);

$sql4  = "SELECT * FROM tbl_transaksi_detail WHERE no_transaksi = '$no_transaksi' ORDER BY id_detail, no_transaksi";
$query4= mysqli_query($koneksi, $sql4);
if(mysqli_num_rows($query4)>0){
  $sql5 = "UPDATE tbl_transaksi SET 
    total_transaksi = total_transaksi - '$total_transaksi' 
  WHERE no_transaksi = '$no_transaksi'";
  mysqli_query($koneksi, $sql5);
}else{
  $sql7 = "DELETE FROM tbl_transaksi WHERE no_transaksi = '$no_transaksi'";
  mysqli_query($koneksi, $sql7);
}
header("location:dashboard-customer.php");
?>