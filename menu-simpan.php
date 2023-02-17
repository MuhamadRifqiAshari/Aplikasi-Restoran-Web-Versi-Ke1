<?php
  session_start();
  include "koneksi.php";
  $id_pegawai	    = $_POST['id_pegawai'];
  $nama_menu	    = $_POST['nama_menu'];
  $id_jenis_menu  = $_POST['id_jenis_menu'];
  $harga = str_replace(',','', mysqli_escape_string($koneksi, $_POST['harga']));
  $qty = str_replace(',','', mysqli_escape_string($koneksi, $_POST['qty']));

  $namaBaru = date('dmYHis');
  $img 	    = $_FILES['img']['name'];
  if($img !=""){$img = $namaBaru.$_FILES['img']['name'];};
  $temp	    = $namaBaru.$_FILES['img']['tmp_name'];

  $sql 		  = "SELECT * FROM tbl_menu a WHERE nama_menu = '$nama_menu'";
  $query 	  = mysqli_query($koneksi, $sql);
  if(mysqli_num_rows($query)>0){
    $_SESSION['info'] = 'Gagal Disimpan';
  }else{
    $sql = "INSERT INTO tbl_menu(nama_menu, id_jenis_menu, harga, qty, id_pegawai, img) VALUES('$nama_menu', '$id_jenis_menu', '$harga', '$qty', '$id_pegawai', '$img')";
    $hsl=mysqli_query($koneksi, $sql);
    if($hsl==1){
      move_uploaded_file($_FILES['img']['tmp_name'], "img/".$img);
      $_SESSION['info'] = 'Disimpan';
    }else{
      $_SESSION['info'] = 'Gagal Disimpan';
    }
  }
  header("location:menu.php");
?>
