<style>
  .lebar{
    width: 80px !important;
  }
</style>
<?php
  $judul = "Laporan Transaksi";
  include "koneksi.php";
  include "header.php";
  include "sidebar.php";
  include "topbar.php";
?>
<div class="container-fluid pt-3 pb-5 backGambar">
  <div class="row">
    <div class="col-xl-12">
      <h3 class="text-center text-uppercase text-dark">Rekapituasi Transaksi</h3>
      <hr class="hr">
    </div>
  </div>

  <!-- Periode -->
  <form action="cetak-transaksi.php" method="post" target="_blank">
    <div class="row mb-4 mt-2">
      <div class="col-xl-10">
        <div class="input-group mb-1">
          <span class="input-group-text lebar">Dari</span>
          <input type="date" name="periodeDari" id="periodeDari" class="form-control form-control-sm lebar" value="<?= $tglHariIni; ?>">
          
          <span class="input-group-text lebar">Sampai</span>
          <input type="date" name="periodeSampai" id="periodeSampai" class="form-control form-control-sm" value="<?= $tglHariIni; ?>">
        
          <?php 
          if($jabatan!="Kasir"){?>
            <select name="id_pegawai" class="form-control form-control-sm form-control-chosen lebar" >
              <option value="" selected>~ Pilih Nama ~</option>
              <?php
              $sql 		= "SELECT * FROM tbl_pegawai WHERE jabatan = 'Kasir' ORDER BY nama_pegawai";
              $query 	= mysqli_query($koneksi, $sql);
              while ($k = mysqli_fetch_array($query)) {
                $id_pegawai    = $k['id_pegawai'];
                $nama_pegawai  = $k['nama_pegawai'];?>
                <option value="<?= $id_pegawai;?>"><?= $nama_pegawai;?></option>
                <?php 
              }?>
            </select>
            <?php 
          }else{?>
            <input type="hidden" name="id_pegawai" value="<?= $id_pegawai; ?>">
            <?php   
          }?>
        
          <a class="btn btn-sm btn-primary text-white" id="periodeCari"><i class="fas fa-search pt-1"></i></a>

          <button class="btn btn-sm btn-success text-white" type="submit" id="periodePrint" name="cetak"><i class="fas fa-print"></i></button>
        </div>
      </div>
    </div>
  </form>

  <div class="row">
    <div class="col-xl-12 table-responsive">
      <div id="tampilkanTransaksiPeriode">
        <table class="table table-bordered table-hover table-sm" id="tblTransaksi">
          <thead>
            <tr style="height:40px;text-align:center">
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
            $no = 1;
            $ttl=0;
            if($jabatan=="Kasir"){
              $sql = "SELECT * FROM tbl_transaksi a INNER JOIN tbl_pegawai b ON a.id_pegawai = b.id_pegawai WHERE a.id_pegawai = '$id_pegawai' ORDER BY tgl_transaksi DESC, no_transaksi DESC";
            }else{
              $sql = "SELECT * FROM tbl_transaksi ORDER BY tgl_transaksi DESC, id_pegawai, no_transaksi DESC";
            }
            $query = mysqli_query($koneksi, $sql);
            while ($data = mysqli_fetch_array($query)) {
              $kode       = $data['kode'];
              $id_pegawai = $data['id_pegawai'];
              $no_meja    = $data['no_meja'];   
              $sql1   = "SELECT nama_pegawai FROM tbl_pegawai WHERE id_pegawai = '$id_pegawai'";
              $query1 = mysqli_query($koneksi, $sql1);
              if(mysqli_num_rows($query1)>0){
                $data1      = mysqli_fetch_array($query1);
                $nm_pegawai = $data1['nama_pegawai'];
              }else{
                $nm_pegawai = 'Customer';
                $no_meja    = '-';
              }
              $no_transaksi = $data['no_transaksi'];
              $tanggal      = date_create($data['tgl_transaksi']);?>
              <tr>
                <td align="center"><?= $no++; ?>.</td>
                <td align="center"><?= date_format($tanggal, "d-m-Y"); ?></td>
                <td><?= $no_transaksi; ?></td>
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
                        if ($jabatan == "Manajer" AND $kode=="1") { ?>
                          <th>Aksi</th>
                        <?php
                        } ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $nomer = 1;
                      $ttl=0;
                      $sql1 = "SELECT a.id_detail, a.qty AS qty, a.harga, b.nama_menu FROM tbl_transaksi_detail a INNER JOIN tbl_menu b ON a.id_menu = b.id_menu WHERE a.no_transaksi = '$no_transaksi' ORDER BY a.id_detail";
                      $query1 = mysqli_query($koneksi, $sql1);
                      while ($data1 = mysqli_fetch_array($query1)) { 
                        $ttl=$ttl+($data1['harga']*$data1['qty']);?>
                        <tr>
                          <td align="center"><?= $nomer++; ?>.</td>
                          <td><?= $data1['nama_menu']; ?></td>
                          <td align="right"><?= number_format($data1['harga']); ?></td>
                          <td align="right"><?= number_format($data1['qty']); ?></td>
                          <td align="right"><?= number_format($data1['harga'] * $data1['qty']); ?>
                          </td>
                          <?php
                          if ($jabatan == "Manajer" AND $kode=='1') { ?>
                            <td align="center"><i class="fas fa-trash text-danger transaksiAksi2" id=<?= $data1['id_detail']; ?> id1=<?= $id_peg = $_SESSION['id_pegawai']; ?> title="hapus" ></i></td>
                          <?php
                          } ?>
                        </tr>
                        <?php
                      }?>
                    </tbody>
                  </table>
                </td>
                <td align="right"><?= number_format($data['total_transaksi']); ?></td>
                <td align="center"><?= $no_meja; ?></td>
                <?php 
                if($jabatan!="Kasir"){?>
                  <td ><?= $nm_pegawai; ?></td>
                  <?php 
                }?>
                <td align="center">
                  <a href="cetak_struk.php?no_transaksi=<?= $no_transaksi;?>" class="btn btn-success btn-sm" target="_blank">
                    <i class="fa fa-print"></i>&nbsp;CETAK</a>
                </td>
              </tr>
              <?php
            } ?>
          </tbody>
          <tr style="height: 40px;font-weight:bold;text-align:right;font-size:20px;">
            <td colspan="4" align="right">Total</td>
            <td colspan="2"><?= number_format($ttl); ?></td>
            <td colspan="2"></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include "sticky-footer.php"; ?>
<?php include "footer.php"; ?>

<script>
  $(document).ready(function() {
    $('#tblTransaksi').dataTable();
    // Menampilkan Tabel Transaksi Per Periode

    $(document).on('click', '#periodeCari', function() {
      var periodeDari   = $('#periodeDari').val();
      var periodeSampai = $('#periodeSampai').val();
      var idPegawai    = $('[name="id_pegawai"]').val();
      $.ajax({
        method: 'POST',
        data: {
          periodeDari: periodeDari,
          periodeSampai: periodeSampai,
          idPegawai: idPegawai
        },
        url: 'transaksi-cari-periode.php',
        cache: false,
        success: function() {
          $('#tampilkanTransaksiPeriode').load('transaksi-cari-periode.php', {
            periodeDari: periodeDari,
            periodeSampai: periodeSampai,
            idPegawai: idPegawai
          });
        }
      });
    });

    // Hapus
    $(document).on('click', '.transaksiAksi2', function(e) {
      var id_detail     = $(this).attr('id');
      var id_peg        = $(this).attr('id1');
      var periodeDari   = "";
      var periodeSampai = "";
      var idPegawai     = "";
      e.preventDefault();
      Swal.fire({
        title: "Hapus Data",
        text: "Data akan dihapus?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "red",
        cancelButtonColor: "blue",
        confirmButtonText: "Hapus",
      }).then((result) => {
        if (result.value) {
          $.ajax({
            method: 'POST',
            data: {
              id_detail: id_detail,
              id_peg: id_peg
            },
            url: 'transaksi-delete-ajax1.php',
            cache: false,
            success: function() {
              $('#tampilkanTransaksiPeriode').load('transaksi-cari-periode.php', {
                periodeDari: periodeDari,
                periodeSampai: periodeSampai,
                idPegawai:idPegawai
              });
            }
          });
        }
      });
    });

    $('.form-control-chosen').chosen({
      allow_single_deselect: true,
    });
  });
</script>