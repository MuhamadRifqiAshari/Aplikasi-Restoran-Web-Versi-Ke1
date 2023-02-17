<?php
session_start();
include "koneksi.php";
$jenis_menu = trim($_POST['jenis_menu']);
$id_pegawai = $_POST['id_pegawai'];
$sql 		= "SELECT * FROM tbl_jenis_menu WHERE jenis_menu = '$jenis_menu'";
$query 	= mysqli_query($koneksi, $sql);
if(mysqli_num_rows($query)>0){
  $_SESSION['info'] = 'Gagal Disimpan';
}else{
  $sql = "INSERT INTO tbl_jenis_menu(jenis_menu, id_pegawai) VALUES('$jenis_menu', '$id_pegawai')";
  mysqli_query($koneksi, $sql);
  $_SESSION['info'] = 'Disimpan';
}
header("location:jenis-menu.php?hasil=1");
?>
