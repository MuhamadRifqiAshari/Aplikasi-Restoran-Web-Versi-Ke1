<?php
include "koneksi.php";
$no_transaksi = $_POST['noTransaksi'];
echo $total_bayar  = str_replace(',','', mysqli_escape_string($koneksi, $_POST['totalBayar']));

$sql = "UPDATE tbl_transaksi SET total_bayar = '$total_bayar'
WHERE no_transaksi = '$no_transaksi'";
mysqli_query($koneksi, $sql);
?>
