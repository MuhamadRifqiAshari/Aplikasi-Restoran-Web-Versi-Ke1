<?php
  session_start();
  include "koneksi.php";
  $no  = 1;
  $id_pegawai    = $_SESSION['id_pegawai'];
  $jabatan       = $_SESSION['jabatan'];
  $periodeDari   = $_POST['periodeDari'];
  $periodeSampai = $_POST['periodeSampai'];
  $idPeg         = $_POST['idPegawai'];
?>
<table class="table table-bordered table-hover table-sm" id="tblTransaksi2">
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
        <th>Kasir</th>
        <?php 
      }?>
      <th>Aksi</th>
    </tr>
  </thead>

  <tbody>
    <?php
    if($idPeg=="" && $jabatan!="Kasir"){
      $sql = "SELECT * FROM tbl_transaksi a INNER JOIN tbl_pegawai b ON a.id_pegawai = b.id_pegawai ORDER BY a.tgl_transaksi DESC, a.no_transaksi";
    }else if($idPeg!="" && $jabatan!="Kasir"){
      $sql = "SELECT * FROM tbl_transaksi a INNER JOIN tbl_pegawai b ON a.id_pegawai = b.id_pegawai WHERE a.id_pegawai = '$idPeg' ORDER BY a.tgl_transaksi DESC, a.no_transaksi";
    }else{
      $sql = "SELECT * FROM tbl_transaksi a INNER JOIN tbl_pegawai b ON a.id_pegawai = b.id_pegawai WHERE a.id_pegawai = '$id_pegawai' ORDER BY a.tgl_transaksi DESC, a.no_transaksi";
    }
    $query = mysqli_query($koneksi, $sql);
    if($a=mysqli_num_rows($query)>0){
      while($data = mysqli_fetch_array($query)){
        $tgl      = $data['tgl_transaksi'];
        if(($tgl >= $periodeDari && $tgl <= $periodeSampai) || ($periodeDari == "" && $periodeSampai == "")){
          $nama_pegawai = $data['nama_pegawai'];
          $no_transaksi = $data['no_transaksi'];
          $tanggal      = date_create($data['tgl_transaksi']);?>
          <tr>
            <td align="center"><?= $no++;?>.</td>
            <td align="center"><?= date_format($tanggal,"d-m-Y");?></td>
            <td><?= $no_transaksi;?></td>
            <td>
              <table class="table table-bordered table-sm">
                <thead>
                  <tr class="text-center bg-success">
                    <th width="5%">No.</th>
                    <th>Nama Menu</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Sub</th>
                    <?php
                    if($jabatan=="Manajer"){?>
                      <th>Aksi</th>
                      <?php
                    }?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $nomer = 1;
                  $sql1 = "SELECT * FROM tbl_transaksi_detail a INNER JOIN tbl_menu b ON a.id_menu = b.id_menu WHERE a.no_transaksi = '$no_transaksi' ORDER BY a.id_detail";
                  $query1 = mysqli_query($koneksi, $sql1);
                  while($data1 = mysqli_fetch_array($query1)){?>
                    <tr>
                      <td align="center"><?= $nomer++;?>.</td>
                      <td><?= $data1['nama_menu'];?></td>
                      <td align="right"><?= number_format($data1['harga']);?></td>
                      <td align="right"><?= number_format($data1['qty']);?></td>
                      <td align="right"><?= number_format($data1['harga']*$data1['qty']);?></td>
                      <?php
                      if($jabatan=="Manajer"){?>
                        <td align="center"><i class="fas fa-trash text-danger transaksiAksi2" id=<?= $data1['id_detail'];?> title="hapus"></i></td>
                        <?php
                      }?>
                    </tr>
                    <?php
                  }?>
                </tbody>
              </table>
            </td>
            <td align="right"><?= number_format($data['total_transaksi']);?></td>
            <td align="center"><?= $data['no_meja'];?></td>
            <?php 
            if($jabatan!="Kasir"){?>
              <td ><?= $nama_pegawai; ?></td>
              <?php 
            }?>
            <td align="center">
              <a href="cetak_struk.php?no_transaksi=<?= $no_transaksi;?>" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-print"></i>&nbsp;CETAK</a>
            </td>
          </tr>
          <?php
        }
      }
    }?>
  </tbody>
</table>
<script>
	$(document).ready(function() {
		$('#tblTransaksi2').dataTable();
	});
</script>