<?php 
  session_start();
  include "koneksi.php";

  // Cek tersediaan username
  $username = htmlspecialchars($_POST['username2']);
  $sql = "SELECT * FROM tbl_login WHERE username = '$username' ORDER BY username";
  $query = mysqli_query($koneksi, $sql);
  if(mysqli_num_rows($query)>0){
    $_SESSION['info'] = 'Gagal Disimpan';
  }else{

    $sql1 = "SELECT * FROM tbl_customer WHERE username = '$username' ORDER BY username";
    $query1 = mysqli_query($koneksi, $sql1);
    if(mysqli_num_rows($query1)>0){
      $_SESSION['info'] = 'Gagal Disimpan';
    }else{
      // Cek tersediaan email
      $email = $_POST['email'];
      $sql2 = "SELECT * FROM tbl_customer WHERE email = '$email' ORDER BY email";
      $query2 = mysqli_query($koneksi, $sql2);
      if(mysqli_num_rows($query2)>0){
        $_SESSION['info'] = 'Gagal Disimpan';
      }else{
        $nama 		= $_POST['nama'];
        $password = md5(htmlspecialchars($_POST['password2']));
        $telp 		= $_POST['telp'];
        $alamat 	= $_POST['alamat'];
  
        $sql = "INSERT INTO tbl_customer(nama, email, username, password, telp, alamat) VALUES('$nama', '$email', '$username', '$password', '$telp', '$alamat')";
        mysqli_query($koneksi, $sql);
        
        $_SESSION['id_login'] = "sudahLogin";
        $_SESSION['username'] = $username;
        $_SESSION['nama'] = $nama;
        
        $sql1 = "SELECT id_customer FROM tbl_customer ORDER BY id_customer DESC";
        $query1 = mysqli_query($koneksi, $sql1);
        $data1  = mysqli_fetch_array($query1);
        $_SESSION['id_customer']  = $data1['id_customer'];

      }
    }
  }
  header("location:index.php");

?>