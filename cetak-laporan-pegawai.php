<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Cetak Rekapitulasi Pegawai</title>
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
    <span style="margin-left: 0px; font-size: 24px;">REKAPITULASI DATA PEGAWAI</span>
    <table class="table table-bordered table-hover">
      <thead>
        <tr class="text-center">
          <th>No.</th>
          <th>Nama Pegawai</th>
          <th>Photo</th>
          <th>Jenis Kelamin</th>
          <th>Alamat</th>
          <th>Telp</th>
          <th>Jabatan</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include "koneksi.php";
        $no = 1;
        $sql = "SELECT * FROM tbl_pegawai";
        $query = mysqli_query($koneksi, $sql);
        while ($data = mysqli_fetch_array($query)) {
          $photo          = $data['photo'];
          $jenis_Kelamin  = $data['jenis_kelamin'];
          if ($photo == "" && $jenis_Kelamin == "Laki-laki") {
            $photo = "male.png";
          } else if ($photo == "" && $jenis_Kelamin == "Perempuan") {
            $photo = "female.png";
          }
        ?>
          <tr>
            <td align="center" width="5%"><?= $no++; ?>.</td>
            <td><?= $data['nama_pegawai']; ?></td>
            <td align="center"><img src="photo/<?= $photo; ?>" alt="photo" width="40" height="40"></td>
            <td><?= $data['jenis_kelamin']; ?></td>
            <td><?= $data['alamat']; ?></td>
            <td><?= $data['telp']; ?></td>
            <td><?= $data['jabatan']; ?></td>
          </tr>
        <?php
        } ?>
      </tbody>
    </table>
  </body>
</html>

