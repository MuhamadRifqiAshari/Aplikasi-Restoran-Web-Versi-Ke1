<?php
  session_start();
  include "koneksi.php";
  $id_admin       = $_SESSION['id_pegawai'];
  $nama_pegawai		= $_POST['nama_pegawai'];
  $jenis_kelamin 	= $_POST['jenis_kelamin'];
  $alamat 	      = $_POST['alamat'];
  $telp 	        = $_POST['telp'];
  $jabatan 	      = $_POST['jabatan'];
  
  $namaBaru 	    = date('dmYHis');
  $photo 		      = $_FILES['photo']['name'];
  if($photo !=""){$photo = $namaBaru.$_FILES['photo']['name'];};
  $temp				    = $namaBaru.$_FILES['photo']['tmp_name'];

  $sql = "INSERT INTO tbl_pegawai(nama_pegawai, jenis_kelamin, alamat, telp, jabatan, photo, id_admin) VALUES('$nama_pegawai', '$jenis_kelamin', '$alamat', '$telp', '$jabatan', '$photo', '$id_admin')";
  $hsl = mysqli_query($koneksi, $sql);
  if($hsl==1){
    move_uploaded_file($_FILES['photo']['tmp_name'], "photo/".$photo);
    $_SESSION['info'] = 'Disimpan';
  }else{
    $_SESSION['info'] = 'Gagal Disimpan';
  }
  header("location:pegawai.php");
?>
