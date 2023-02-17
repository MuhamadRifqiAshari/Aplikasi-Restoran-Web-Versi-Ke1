<?php
include "koneksi.php";
$id_detail  = $_POST['id_detail'];

$sql1   = "SELECT a.no_transaksi, a.qty, a.harga, b.id_menu FROM tbl_transaksi_detail a INNER JOIN tbl_menu b ON a.id_menu = b.id_menu WHERE id_detail = '$id_detail' ORDER BY id_detail";
$query1 = mysqli_query($koneksi, $sql1);
$data1  = mysqli_fetch_array($query1);
$id_menu          = $data1['id_menu'];
$no_transaksi     = $data1['no_transaksi'];
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

  $sql6  = "SELECT * FROM tbl_transaksi WHERE no_transaksi = '$no_transaksi' ORDER BY no_transaksi";
  $query6= mysqli_query($koneksi, $sql6);
  $data6 = mysqli_fetch_array($query6);
  $total = $data6['total_transaksi']; 

  echo $no_transaksi.$total;
}else{
  $sql7 = "DELETE FROM tbl_transaksi WHERE no_transaksi = '$no_transaksi'";
  mysqli_query($koneksi, $sql7);
  echo 0;
}
?>