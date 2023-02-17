<?php
include "koneksi.php";
$id_detail  = $_POST['id_detail'];

// Mencari data pegawai, yaitu nama pegawai dan jabatan
// ini seharusnya dilakukan di trigger
$id_peg = $_POST['id_peg'];
$sql    = "SELECT * FROM tbl_pegawai WHERE id_pegawai = '$id_peg'";
$query  = mysqli_query($koneksi, $sql);
$data   = mysqli_fetch_array($query);
$nama_pegawai = $data['nama_pegawai'];
$jabatan      = $data['jabatan'];

$sql1   = "SELECT a.no_transaksi, a.qty, a.harga, b.id_menu, b.nama_menu FROM tbl_transaksi_detail a INNER JOIN tbl_menu b ON a.id_menu = b.id_menu WHERE id_detail = '$id_detail' ORDER BY id_detail";
$query1 = mysqli_query($koneksi, $sql1);
$data1  = mysqli_fetch_array($query1);
$id_menu          = $data1['id_menu'];
$nama_menu        = $data1['nama_menu'];
$no_transaksi     = $data1['no_transaksi'];
$qty              = $data1['qty'];
$harga            = $data1['harga'];
$total_transaksi  = $qty*$harga;

$sql2 = "DELETE FROM tbl_transaksi_detail WHERE id_detail = '$id_detail'";
mysqli_query($koneksi, $sql2);

$sql3 = "UPDATE tbl_menu SET jual = jual - '$qty' WHERE id_menu = '$id_menu'";
mysqli_query($koneksi, $sql3);

// insert tbl log
$aksi = "Transaksi detail - menghapus " . $nama_menu .' dengan no transaksi '. $no_transaksi;
$sql3 = "INSERT INTO tbl_log(id_pegawai, nama_pegawai, jabatan, aksi) VALUES ('$id_peg', '$nama_pegawai', '$jabatan', '$aksi')";
mysqli_query($koneksi, $sql3);

$sql4  = "SELECT * FROM tbl_transaksi_detail WHERE no_transaksi = '$no_transaksi' ORDER BY id_detail, no_transaksi";
$query4= mysqli_query($koneksi, $sql4);
if(mysqli_num_rows($query4)>0){
  $sql5 = "UPDATE tbl_transaksi SET 
    total_transaksi = total_transaksi - '$total_transaksi' 
  WHERE no_transaksi = '$no_transaksi'";
  mysqli_query($koneksi, $sql5);

  $sql6  = "SELECT * FROM tbl_transaksi WHERE no_transaksi = '$no_transaksi' ORDER BY no_transaksi";
  $query6= mysqli_query($koneksi, $sql6);
  $data6 = mysqli_fetch_array($query6);
  $total = $data6['total_transaksi']; 

  echo $no_transaksi.$total;
}else{
  $sql7 = "DELETE FROM tbl_transaksi WHERE no_transaksi = '$no_transaksi'";
  mysqli_query($koneksi, $sql7);
  echo 0;
}
?>