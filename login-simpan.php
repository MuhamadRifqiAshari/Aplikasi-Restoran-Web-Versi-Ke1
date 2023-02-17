<?php
session_start();
include "koneksi.php";

$id_admin     = $_SESSION['id_pegawai'];
$username 		= htmlspecialchars($_POST['username']);
$password 		= md5(htmlspecialchars($_POST['password']));
$id_pegawai   = $_POST['id_pegawai'];

$sql = "INSERT INTO tbl_login(id_pegawai, username, password, id_admin) VALUES('$id_pegawai', '$username', '$password', '$id_admin')";
$hsl = mysqli_query($koneksi, $sql);
if($hsl==1){
  $_SESSION['info'] = 'Disimpan';
}else{
  $_SESSION['info'] = 'Gagal Disimpan';
}
header("location:login.php");

?>
