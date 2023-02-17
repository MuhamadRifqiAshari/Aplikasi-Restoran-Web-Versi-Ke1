<?php
  session_start();
  include "koneksi.php";
  $id_pegawai = $_GET['id_pegawai'];

  $sql   = "SELECT * FROM tbl_login WHERE id_pegawai = '$id_pegawai'";
  $query = mysqli_query($koneksi, $sql);
  if(mysqli_num_rows($query)>0){
    $_SESSION['info'] = 'Gagal Dihapus';
  }else{
    // Cek apakah manajer sudah pernah input
    $sql1   = "SELECT * FROM tbl_pegawai WHERE id_admin = '$id_pegawai'";
    $query = mysqli_query($koneksi, $sql);
    if(mysqli_num_rows($query)>0){
      $_SESSION['info'] = 'Gagal Dihapus';
    }else{
      $sql1 = "DELETE FROM tbl_pegawai WHERE id_pegawai = '$id_pegawai'";
      $hsl = mysqli_query($koneksi, $sql1);
      if($hsl==1){
        if($photo!=""){unlink("photo/".$photo);}
        $_SESSION['info'] = 'Dihapus';
      }else{
        $_SESSION['info'] = 'Gagal Dihapus';
      }
    }
  }
  header("location:pegawai.php");
?>