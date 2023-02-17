<?php
  session_start();
  include "koneksi.php";
  $id_login = $_GET['id_login'];

  $sql          = "SELECT * FROM tbl_login a INNER JOIN tbl_pegawai b ON a.id_pegawai  = b.id_pegawai WHERE a.id_login ='$id_login'";
  $query        = mysqli_query($koneksi, $sql);
  if (mysqli_num_rows($query)>0){
    $data       = mysqli_fetch_array($query);  
    $jabatan    = $data['jabatan'];
    $id_pegawai = $data['id_pegawai'];
  
    if($jabatan=="Manajer"){
      // Mencari di tabel jenis menu
      $sql1 = "SELECT id_pegawai FROM tbl_jenis_menu WHERE id_pegawai ='$id_pegawai'";
      $query1 = mysqli_query($koneksi, $sql1);
      if (mysqli_num_rows($query1)>0){
        $_SESSION['info'] = 'Gagal Dihapus';
      }else{
        // Mencari lagi di tabel menu
        $sql2   = "SELECT id_pegawai FROM tbl_menu WHERE id_pegawai ='$id_pegawai'";
        $query2 = mysqli_query($koneksi, $sql2);
        if (mysqli_num_rows($query2)>0){
          $_SESSION['info'] = 'Gagal Dihapus';
        }else{
          $sql = "DELETE FROM tbl_login WHERE id_login ='$id_login'";
          mysqli_query($koneksi, $sql);
          $_SESSION['info'] = 'Dihapus';
        }
      }
    }else if($jabatan=="Kasir"){
      $sql2   = "SELECT * FROM tbl_transaksi WHERE id_pegawai ='$id_pegawai'";
      $query2 = mysqli_query($koneksi, $sql2);
      if (mysqli_num_rows($query2)>0){
        $_SESSION['info'] = 'Gagal Dihapus';
      }else{
        $sql = "DELETE FROM tbl_login WHERE id_login ='$id_login'";
        mysqli_query($koneksi, $sql);
        $_SESSION['info'] = 'Dihapus';
      }
    }else if($jabatan=="Admin"){
      $sql4   = "SELECT * FROM tbl_login WHERE id_admin ='$id_pegawai'";
      $query4 = mysqli_query($koneksi, $sql4);
      if (mysqli_num_rows($query4)>0){
        $_SESSION['info'] = 'Gagal Dihapus';
      }else{
        $sql = "DELETE FROM tbl_login WHERE id_login ='$id_login'";
        mysqli_query($koneksi, $sql);
        $_SESSION['info'] = 'Dihapus';
      }
    }else{
      $_SESSION['info'] = 'Gagal Dihapus';
    }
  }else{
    $sql = "DELETE FROM tbl_login WHERE id_login ='$id_login'";
    mysqli_query($koneksi, $sql);
    $_SESSION['info'] = 'Dihapus';
  }
  header("location:login.php");
?>