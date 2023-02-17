<?php
  session_start();
  include "koneksi.php";
  $id_menu = $_GET['id_menu'];

  $sql1 = "SELECT * FROM tbl_transaksi_detail WHERE id_menu ='$id_menu'";
  $query1 = mysqli_query($koneksi, $sql1);
  if (mysqli_num_rows($query1)>0){
    $_SESSION['info'] = 'Gagal Dihapus';
  }else{
    $sql2   = "SELECT * FROM tbl_menu WHERE id_menu = '$id_menu'";
    $query2 = mysqli_query($koneksi, $sql2);
    $dt2    = mysqli_fetch_array($query2);
    $img    = $dt2['img'];

    $sql = "DELETE FROM tbl_menu WHERE id_menu = '$id_menu'";
    $hsl = mysqli_query($koneksi, $sql);
    if($hsl==1){
      if($img!="" && $img!="no-logo.png"){unlink("img/".$img);}
      $_SESSION['info'] = 'Dihapus';
    }else{
      $_SESSION['info'] = 'Gagal Dihapus';
    }
  }
  header("location:menu.php");
?>