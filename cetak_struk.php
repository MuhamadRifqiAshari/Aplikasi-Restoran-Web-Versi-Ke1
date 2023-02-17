<?php
  include "koneksi.php"; 
  $judul        = "Struk Pembayaran";
  $no_transaksi = $_GET['no_transaksi'];
?>
<html>
  <head>
    <title><?= $judul; ?></title>
    <link rel="shorcut icon" type="text/css" href="photo/logo1.png">

    <style>
      hr {
        display: block;
        margin-top: 0.5em;
        margin-bottom: 0.5em;
        margin-left: auto;
        margin-right: auto;
        border-style: inset;
        border-width: 1px;
      }
    </style>
  </head>
  <body style='font-family:tahoma; font-size:8pt;' onload="window.print(); window.onafterprint = window.close; ">

    <?php
    $no = 1;
    $sql = "SELECT * FROM tbl_transaksi a INNER JOIN tbl_pegawai b ON a.id_pegawai=b.id_pegawai WHERE a.no_transaksi = '$no_transaksi' ORDER BY a.no_transaksi";
    $query = mysqli_query($koneksi, $sql);
    if(mysqli_num_rows($query)>0){
      while ($data = mysqli_fetch_array($query)) {
        $no_transaksi = $data['no_transaksi'];
        $tanggal      = date_create($data['tgl_transaksi']);?>
      
        <center>
          <table style='width:350px; font-size:16pt; font-family:calibri; border-collapse: collapse;' border='0'>
            <tr>
              <td width='70%' align='CENTER' vertical-align='top'>
                <span style='color:black;'>
                  <b>Restoran Cafe Bisa Ngopi</b></br>JL Kartini No 2 Pati</span>
              </td>
            </tr>
            <tr>
              <td colspan='4'>
                <span style='text-align:left; font-size:12pt'>No Transaksi : <?= $no_transaksi; ?></span>
              </td>
            </tr>
            <tr>
              <td colspan='4'>
                <span style='text-align:left; font-size:12pt'>Tanggal : <?= date_format($tanggal, "d-m-Y"); ?></span>
              </td>
            </tr>
            <tr>
              <td colspan='4'>
                <span style='text-align:left; font-size:12pt'>No Meja : <?= $data['no_meja']; ?></span>
              </td>
            </tr>
            <tr>
              <td colspan='4'>
                <span style='text-align:left; font-size:12pt'>Nama Kasir : <?= $data['nama_pegawai']; ?></span>
              </td>
            </tr>
          </table>
              
          <table cellspacing='0' cellpadding='0' style='width:500px; font-size:12pt; font-family:calibri;  border-collapse: collapse;' border='0'>
            <tr>
              <td colspan='5'><hr></td>
            </tr>
            <tr align='center'>
              <th>No.</th>
              <th>Nama Menu</th>
              <th>Harga</th>
              <th>Qty</th>
              <th>Sub</th>
            </tr>
            <tr>
              <td colspan='5'><hr></td>
            </tr>
            <?php
            $nomer = 1;
            $sql1 = "SELECT a.harga, a.qty AS qty, b.nama_menu FROM tbl_transaksi_detail a INNER JOIN tbl_menu b ON a.id_menu = b.id_menu WHERE a.no_transaksi = '$no_transaksi' ORDER BY a.id_detail";
            $query1 = mysqli_query($koneksi, $sql1);
            while ($data1 = mysqli_fetch_array($query1)) { ?>
              <tr>
                <td align="center"><?= $nomer++; ?>.</td>
                <td width="50%"><?= $data1['nama_menu']; ?></td>
                <td align="right"><?= number_format($data1['harga']); ?></td>
                <td align="right"><?= number_format($data1['qty']); ?></td>
                <td align="right"><?= number_format($data1['harga'] * $data1['qty']); ?>
                </td>
              </tr>
              <tr>
                <td colspan='5'><hr></td>
              </tr>
              <?php 
            }?>
            <tr>
              <td colspan='4'>
                <div style='text-align:right; color:black'>Total : </div>
              </td>
              <td style='text-align:right; font-size:16pt; color:black'>
                <?= number_format($data['total_transaksi']); ?>
              </td>
            </tr>
            <tr>
              <td colspan='4'>
                <div style='text-align:right; color:black'>Total Bayar : </div>
              </td>
              <td style='text-align:right; font-size:16pt; color:black'>
                <?= number_format($data['total_bayar']); ?>
              </td>
            </tr>
            <tr>
              <td colspan='4'>
                <div style='text-align:right; color:black'>Total Kembali : </div>
              </td>
              <td style='text-align:right; font-size:16pt; color:black'>
                <?= number_format($data['total_bayar']-$data['total_transaksi']); ?>
              </td>
            </tr>
          </table>

          <table style='width:350; font-size:12pt;' cellspacing='2'>
            <tr></br>
              <td align='center'>****** TERIMAKASIH ******</br></td>
            </tr>
          </table>
        </center>
        <?php
      }
    }else{
      $sql = "SELECT * FROM tbl_transaksi a INNER JOIN tbl_customer b ON a.id_pegawai=b.id_customer WHERE a.no_transaksi = '$no_transaksi' ORDER BY a.no_transaksi";
      $query = mysqli_query($koneksi, $sql);
      while ($data = mysqli_fetch_array($query)) {
        $no_transaksi = $data['no_transaksi'];
        $tanggal      = date_create($data['tgl_transaksi']);?>
        <center>
          <table style='width:350px; font-size:16pt; font-family:calibri; border-collapse: collapse;' border='0'>
            <tr>
              <td width='70%' align='CENTER' vertical-align='top'>
                <span style='color:black;'>
                  <b>Restoran Cafe Bisa Ngopi</b></br>JL Kartini No 2 Pati</span>
              </td>
            </tr>
            <tr>
              <td colspan='4'>
                <span style='text-align:left; font-size:12pt'>No Transaksi : <?= $no_transaksi; ?></span>
              </td>
            </tr>
            <tr>
              <td colspan='4'>
                <span style='text-align:left; font-size:12pt'>Tanggal : <?= date_format($tanggal, "d-m-Y"); ?></span>
              </td>
            </tr>
            <tr>
              <td colspan='4'>
                <span style='text-align:left; font-size:12pt'>No Meja : <?= $data['no_meja']; ?></span>
              </td>
            </tr>
            <tr>
              <td colspan='4'>
                <span style='text-align:left; font-size:12pt'>Nama Customer : <?= $data['nama']; ?></span>
              </td>
            </tr>
          </table>
              
          <table cellspacing='0' cellpadding='0' style='width:500px; font-size:12pt; font-family:calibri;  border-collapse: collapse;' border='0'>
            <tr>
              <td colspan='5'><hr></td>
            </tr>
            <tr align='center'>
              <th>No.</th>
              <th>Nama Menu</th>
              <th>Harga</th>
              <th>Qty</th>
              <th>Sub</th>
            </tr>
            <tr>
              <td colspan='5'><hr></td>
            </tr>
            <?php
            $nomer = 1;
            $sql1 = "SELECT a.harga, a.qty AS qty, b.nama_menu FROM tbl_transaksi_detail a INNER JOIN tbl_menu b ON a.id_menu = b.id_menu WHERE a.no_transaksi = '$no_transaksi' ORDER BY a.id_detail";
            $query1 = mysqli_query($koneksi, $sql1);
            while ($data1 = mysqli_fetch_array($query1)) { ?>
              <tr>
                <td align="center"><?= $nomer++; ?>.</td>
                <td width="50%"><?= $data1['nama_menu']; ?></td>
                <td align="right"><?= number_format($data1['harga']); ?></td>
                <td align="right"><?= number_format($data1['qty']); ?></td>
                <td align="right"><?= number_format($data1['harga'] * $data1['qty']); ?>
                </td>
              </tr>
              <tr>
                <td colspan='5'><hr></td>
              </tr>
              <?php 
            }?>
            <tr>
              <td colspan='4'>
                <div style='text-align:right; color:black'>Total : </div>
              </td>
              <td style='text-align:right; font-size:16pt; color:black'>
                <?= number_format($data['total_transaksi']); ?>
              </td>
            </tr>
            <tr>
              <td colspan='4'>
                <div style='text-align:right; color:black'>Total Bayar : </div>
              </td>
              <td style='text-align:right; font-size:16pt; color:black'>
                <?= number_format($data['total_bayar']); ?>
              </td>
            </tr>
            <tr>
              <td colspan='4'>
                <div style='text-align:right; color:black'>Total Kembali : </div>
              </td>
              <td style='text-align:right; font-size:16pt; color:black'>
                <?= number_format($data['total_bayar']-$data['total_transaksi']); ?>
              </td>
            </tr>
          </table>

          <table style='width:350; font-size:12pt;' cellspacing='2'>
            <tr></br>
              <td align='center'>****** TERIMAKASIH ******</br></td>
            </tr>
          </table>
        </center>
        <?php
      }

    }?>

  </body>
</html>