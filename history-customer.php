<style>
  .lebar{
    width: 80px !important;
  }
</style>
<?php
  session_start();
  $idCustomer = $_SESSION['id_customer'];
  $nama       = $_SESSION['nama'];
  date_default_timezone_set("Asia/Jakarta");
  $tglHariIni = date('Y-m-d');

  $judul      = "Rekapitulasi Transaksi";
  include "koneksi.php";
  include "header-customer.php";
  include "sidebar-customer.php";
  include "topbar-customer.php";
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
            <tr class="text-center">
              <th width="5%">No.</th>
              <th>Tanggal</th>
              <th>No Transaksi</th>
              <th>Detail</th>
              <th>Total</th>
            </tr>
          </thead>

          <tbody>
            <?php
            $no = 1;
            $ttl= 0;
            $sql = "SELECT * FROM tbl_transaksi WHERE id_pegawai = '$idCustomer' AND total_bayar > 0 ORDER BY tgl_transaksi DESC, no_transaksi DESC";
            $query = mysqli_query($koneksi, $sql);
            while ($data = mysqli_fetch_array($query)) {
              $no_transaksi = $data['no_transaksi'];
              $tanggal      = date_create($data['tgl_transaksi']);
              $ttl = $ttl + $data['total_transaksi'];?>
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
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $nomer = 1;
                      $sql1 = "SELECT a.qty, a.harga, b.nama_menu FROM tbl_transaksi_detail a INNER JOIN tbl_menu b ON a.id_menu = b.id_menu WHERE a.no_transaksi = '$no_transaksi'  ORDER BY a.id_detail";
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
              </tr>
            <?php
            } ?>
            <tr style="font-weight: bold;height: 40px;font-size: 20px;">
              <td colspan="3" align="right">TOTAL</td>
              <td colspan="2" align="right"><?= number_format($ttl); ?></td>
            </tr>
          </tbody>
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
        text: "Data akan disimpan?",
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