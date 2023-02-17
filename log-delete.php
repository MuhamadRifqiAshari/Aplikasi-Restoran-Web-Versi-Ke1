<?php
  session_start();
  include "koneksi.php";
  $id_log = $_GET['id_log'];

  $sql = "DELETE FROM tbl_log WHERE id_log ='$id_log'";
  mysqli_query($koneksi, $sql);
  $hsl = mysqli_query($koneksi, $sql);
  if($hsl==1){
    $_SESSION['info'] = 'Dihapus';
  }else{
    $_SESSION['info'] = 'Gagal Dihapus';
  }
  header("location:log.php");
?>