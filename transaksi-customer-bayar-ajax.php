<?php
include "koneksi.php";
$no_transaksi = $_POST['no_transaksi'];

$sql = "UPDATE tbl_transaksi SET total_bayar = total_transaksi
WHERE no_transaksi = '$no_transaksi'";
mysqli_query($koneksi, $sql);
?>
