<?php 
session_start();
include "koneksi.php";
$username = mysqli_escape_string($koneksi, $_POST['username']);
$password = md5(mysqli_escape_string($koneksi, $_POST['password']));

$sql = "SELECT a.kode, b.id_pegawai, b.nama_pegawai, b.jabatan, b.jenis_kelamin, b.photo FROM tbl_login a INNER JOIN tbl_pegawai b ON a.id_pegawai = b.id_pegawai WHERE a.username = '$username' AND a.password = '$password' AND kode='1'";
$query = mysqli_query($koneksi, $sql);
if (mysqli_num_rows($query)>0){
	$data 	      = mysqli_fetch_array($query);
  $id_pegawai   = $data['id_pegawai'];
  $nama_pegawai = $data['nama_pegawai'];
  $jabatan      = $data['jabatan'];
  $jenis_kelamin= $data['jenis_kelamin'];
 
  $photo        = $data['photo'];
  // Jika tidak ada gambar
  if($photo==""){
    if($jenis_kelamin=="Laki-laki"){
      $photo = "male.png"; 
    }else{
      $photo = "female.png"; 
    }
  }

  // Membuat session
  $_SESSION['id_pegawai']   = $id_pegawai;
	$_SESSION['nama_pegawai'] = $nama_pegawai;
	$_SESSION['jabatan']      = $jabatan;
	$_SESSION['photo']        = $photo;
	header("location:dashboard.php");
}else{
  $sql1 = "SELECT * FROM tbl_customer WHERE username = '$username' AND password = '$password' AND email!=''";
  $query1 = mysqli_query($koneksi, $sql1);
  if (mysqli_num_rows($query1)>0){
    $data1 = mysqli_fetch_array($query1);
    $_SESSION['id_login']     = "sudahLogin";
    $_SESSION['id_customer']  = $data1['id_customer'];
    $_SESSION['username']     = $data1['username'];
    $_SESSION['nama']         = $data1['nama'];
  }else{
    $_SESSION['info'] = 'Salah';
  }
  header("location:index.php");
}