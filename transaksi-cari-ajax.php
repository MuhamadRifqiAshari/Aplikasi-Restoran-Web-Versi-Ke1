<?php
include "koneksi.php";
$id_menu  = $_POST['id_menu'];

$sql = "SELECT * FROM tbl_menu WHERE id_menu = '$id_menu' ORDER BY id_menu";
$query = mysqli_query($koneksi, $sql);
if(mysqli_num_rows($query)>0){
  $data     = mysqli_fetch_array($query);
  echo number_format($data['harga']);
}


?>