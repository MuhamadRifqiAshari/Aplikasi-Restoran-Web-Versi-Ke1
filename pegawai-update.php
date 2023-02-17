<?php
session_start();
include "koneksi.php";
$namaBaru 	    = date('dmYHis');
$id_pegawai     = $_POST['id_pegawai'];
$nama_pegawai		= $_POST['nama_pegawai'];
$jenis_kelamin 	= $_POST['jenis_kelamin'];
$alamat 	      = $_POST['alamat'];
$telp 	        = $_POST['telp'];
$jabatan 	      = $_POST['jabatan'];
$photo 		      = $_FILES['photo']['name'];
if($photo !=""){$photo = $namaBaru.$_FILES['photo']['name'];};

$sql        = "SELECT * FROM tbl_pegawai WHERE id_pegawai = '$id_pegawai'";
$query      = mysqli_query($koneksi, $sql);
$data       = mysqli_fetch_array($query);
$poto       = $data['photo'];

$sql = "UPDATE tbl_pegawai SET 
  nama_pegawai    = '$nama_pegawai', 
  jenis_kelamin   = '$jenis_kelamin',
  alamat          = '$alamat',
  telp            = '$telp',
  photo           = '$photo',
  jabatan         = '$jabatan'
WHERE id_pegawai  = '$id_pegawai'";

$hsl = mysqli_query($koneksi, $sql);
if($hsl==1){
  if($poto!=""){unlink("photo/".$poto);}
  move_uploaded_file($_FILES['photo']['tmp_name'], "photo/".$photo);
  $_SESSION['info'] = 'Diupdate';
}else{
  $_SESSION['info'] = 'Gagal Diupdate';
}
header("location:pegawai.php");
?>
