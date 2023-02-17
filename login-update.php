<?php
  session_start();
  include "koneksi.php";
  $id_admin 	  = $_POST['id_admin'];
  $id_pegawai	  = $_POST['id_pegawai'];
  $username 		= $_POST['username'];
  $username1 		= $_POST['username1'];
  $password 		= md5(htmlspecialchars($_POST['password']));;
  
  if($username==$username1){
    $sql = "UPDATE tbl_login SET 
      password = '$password', 
      id_admin = '$id_admin' 
    WHERE id_pegawai = '$id_pegawai'";
    mysqli_query($koneksi, $sql);
    $_SESSION['info'] = 'Diupdate';
  }else{
    $sql = "SELECT * FROM tbl_login WHERE username = '$username1'";
    $query= mysqli_query($koneksi, $sql);
    if(mysqli_num_rows($query)>0){
      $_SESSION['info'] = 'Gagal Diupdate';
    }else{
      $sql = "UPDATE tbl_login SET 
        username      = '$username1', 
        password      = '$password', 
        id_admin      = '$id_admin' 
      WHERE id_pegawai = '$id_pegawai'";
      mysqli_query($koneksi, $sql);
      $_SESSION['info'] = 'Diupdate';
    }
  }
  header("location:login.php");
?>
