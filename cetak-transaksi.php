<?php 
  session_start();
  $jabatan = $_SESSION['jabatan'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Cetak Rekapitulasi Transaksi</title>
    <link rel="shorcut icon" type="text/css" href="photo/logo1.png">
    <!-- CSS -->
    <link rel="stylesheet" href="css/bootstrap-4_4_1.min.css"/>
    <style>
      tr>th{text-align: center; height: 35px; border: 2px solid;}
      tr>td{padding-left: 5px; vertical-align: middle!important;}
      tr>td>img{margin-top: 3px; margin-bottom: 3px;}
    </style>
  </head>
  <body onload="window.print(); window.onafterprint = window.close; ">
    <?php 
    include "koneksi.php";
    $periodeDari   = $_POST['periodeDari'];
    $periodeSampai = $_POST['periodeSampai'];
    $tgl1=date_create($periodeDari);
    $tgl2=date_create($periodeSampai);

    $id_pegawai    = $_POST['id_pegawai'];
    if($id_pegawai!=""){
      $sql = "SELECT * FROM tbl_pegawai WHERE id_pegawai = '$id_pegawai' ORDER BY id_pegawai";
      $query  = mysqli_query($koneksi, $sql);
      $d      = mysqli_fetch_array($query);
      $nama_pegawai = $d['nama_pegawai'];
    }?>

    <span style="margin-left: 0px; font-size: 20px; font-weight:bold;">REKAPITULASI TRANSAKSI</span><br>
    <span style="margin-left: 0px; font-size: 16px;">Periode dari tanggal: <?= date_format($tgl1, 'd M Y');?> s.d. tanggal: <?= date_format($tgl2, 'd M Y');?></span>
    <?php 
    if($id_pegawai!=""){?><br>
      <span style="margin-left: 0px; font-size: 16px;">Nama Kasir: <?= $nama_pegawai;?></span>
      <?php
    }?>
    <table class="table table-bordered table-hover mb-5">
      <thead>
        <tr class="text-center">
          <th width="5%">No.</th>
          <th>Tgl</th>
          <th>No Transaksi</th>
          <th>Detail</th>
          <th>Total</th>
          <th>Meja</th>
          <?php 
          if($jabatan!="Kasir"){?>
            <th>Nama Kasir</th>
            <?php 
          }?>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $ttl = 0;
        if($id_pegawai==""){
          $sql = "SELECT * FROM tbl_transaksi a INNER JOIN tbl_pegawai b ON a.id_pegawai = b.id_pegawai WHERE a.tgl_transaksi >= '$periodeDari' AND a.tgl_transaksi <= '$periodeSampai' ORDER BY a.tgl_transaksi, a.no_transaksi";
        }else{
          $sql = "SELECT * FROM tbl_transaksi a INNER JOIN tbl_pegawai b ON a.id_pegawai = b.id_pegawai WHERE a.tgl_transaksi >= '$periodeDari' AND a.tgl_transaksi <= '$periodeSampai' AND a.id_pegawai = '$id_pegawai' ORDER BY a.tgl_transaksi, a.no_transaksi";
        }
        $query = mysqli_query($koneksi, $sql);
        if($a=mysqli_num_rows($query)>0){
          while ($data = mysqli_fetch_array($query)) {
            $no_transaksi = $data['no_transaksi'];
            $nm_pegawai   = $data['nama_pegawai'];
            $ttl = $ttl + $data['total_transaksi'];
            $tanggal      = date_create($data['tgl_transaksi']); ?>
            <tr>
              <td align="center"><?= $no++; ?>.</td>
              <td align="center"><?= date_format($tanggal, "d-m-Y"); ?></td>
              <td><?= $no_transaksi; ?></td>
              <td>
                <table class="table table-bordered table-sm">
                  <thead>
                    <tr class="text-center">
                      <th width="5%">No.</th>
                      <th>Nama Menu</th>
                      <th>Harga</th>
                      <th>Qty</th>
                      <th>Sub</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $nomer = 1;
                    $sql1 = "SELECT * FROM tbl_transaksi_detail a INNER JOIN tbl_menu b ON a.id_menu = b.id_menu WHERE a.no_transaksi = '$no_transaksi' ORDER BY a.id_detail";
                    $query1 = mysqli_query($koneksi, $sql1);
                    while ($data1 = mysqli_fetch_array($query1)) { ?>
                      <tr>
                        <td align="center"><?= $nomer++; ?>.</td>
                        <td><?= $data1['nama_menu']; ?></td>
                        <td align="right"><?= number_format($data1['harga']); ?></td>
                        <td align="right"><?= number_format($data1['qty']); ?></td>
                        <td align="right"><?= number_format($data1['harga'] * $data1['qty']); ?>
                        </td>
                      </tr>
                      <?php
                    } ?>
                  </tbody>
                </table>
              </td>
              <td align="right"><?= number_format($data['total_transaksi']); ?></td>
              <td align="center"><?= $data['no_meja']; ?></td>
              <?php 
              if($jabatan!="Kasir"){?>
                <td ><?= $nm_pegawai; ?></td>
                <?php 
              }?>
            </tr>
            <?php
          }?>
          <tr>
            <td align="right" colspan="4">Total </td>
            <td align="right"><?= number_format($ttl); ?></td>
            <td></td>
            <?php 
            if($jabatan!="Kasir"){?>
              <td></td>
              <?php 
            }?>
          </tr>
          <?php
        }else{?>
          <tr>
              <td align="center" colspan="7"><b>DATA TIDAK DITEMUKAN</b></td>
          </tr>
          <?php
        }?>
      </tbody>
    </table>
  </body>
</html>

