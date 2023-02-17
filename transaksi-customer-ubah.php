<?php
  session_start();
  include "koneksi.php";
  $id_detail  = $_POST['id_detail'];
  $qty        = $_POST['qty'];

  $sql = "SELECT a.qty AS qtyDetail, a.no_transaksi, a.id_menu, a.harga, b.qty AS qtyMenu, b.jual FROM tbl_transaksi_detail a INNER JOIN tbl_menu b ON a.id_menu = b.id_menu WHERE a.id_detail = '$id_detail' ORDER BY a.id_detail";
  $query        = mysqli_query($koneksi, $sql);
  $data         = mysqli_fetch_assoc($query);
  $id_menu      = $data['id_menu'];
  $no_transaksi = $data['no_transaksi'];
  $qtyDetail    = $data['qtyDetail'];
  $qtymenu      = $data['qtyMenu']; 
  $jual         = $data['jual'];
  $harga        = $data['harga'];
  
  if($jual-$qtyDetail+$qty>$qtymenu){
    $_SESSION['info'] = 'Gagal Diupdate';
  }else{
    $sql1 = "UPDATE tbl_transaksi_detail SET qty =  '$qty' WHERE id_detail = '$id_detail'";
    mysqli_query($koneksi, $sql1);

    $jual = $jual-$qtyDetail+$qty;
    $sql2 = "UPDATE tbl_menu SET jual =  '$jual' WHERE id_menu = '$id_menu'";
    mysqli_query($koneksi, $sql2);

    $total_transaksi_lama = ($harga*$qtyDetail);
    $total_transaksi_baru = ($harga*$qty);
    $sql3 = "UPDATE tbl_transaksi SET total_transaksi = total_transaksi - '$total_transaksi_lama' + '$total_transaksi_baru' WHERE no_transaksi = '$no_transaksi'";
    mysqli_query($koneksi, $sql3);
    $_SESSION['info'] = 'Diupdate';

  }
  header("location:dashboard-customer.php");
?>
