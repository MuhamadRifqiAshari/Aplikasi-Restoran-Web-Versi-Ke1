<style>
  th{
    text-align: center;
    background-color: transparent !important;
    height: 40px;
  }
  td:hover{
    background: rgba(0, 0, 0, 0);
  }
</style>

<?php
  session_start();
  $idCustomer = $_SESSION['id_customer'];
  $nama       = $_SESSION['nama'];

  $judul = "DASHBOARD";
  include "koneksi.php";
  include "header-customer.php";
  include "sidebar-customer.php";
  include "topbar-customer.php";
  $waktu = date('Y-m-d');
?>
<!-- SweetAlert2 -->
<div class="info-data" data-infodata="<?php if(isset($_SESSION['info'])){ 
  echo $_SESSION['info']; 
  } 
  unset($_SESSION['info']); ?>">
</div>

<div class="container-fluid backGambar">
  <!-- Content -->
  <div class="row mt-5">
    <div class="col-xl-10 ml-5">
      <table class="table table-hover">
        <thead>
          <tr>
            <th width="5%">No.</th>
            <th>Tanggal</th>
            <th>Nama Menu</th>
            <th>Harga</th>
            <th width="8%">Qty</th>
            <th>Sub</th>
            <th class="aksiCustomer">Aksi</th>
          </tr>
        </thead>

        <div class="detailTransaksiCustomer">
          <tbody>
            <?php
            $nomer  = 1;
            $ttl    = 0;
            $no_transaksi = 0;
            $sql1 = "SELECT a.tgl_transaksi, b.qty, b.harga, b.id_detail, b.no_transaksi, c.nama_menu FROM tbl_transaksi a INNER JOIN tbl_transaksi_detail b ON a.no_transaksi = b.no_transaksi INNER JOIN tbl_menu c ON b.id_menu = c.id_menu WHERE a.id_pegawai = '$idCustomer' AND total_bayar = 0 ORDER BY a.no_transaksi";
            $query1 = mysqli_query($koneksi, $sql1);
            while ($data1   = mysqli_fetch_array($query1)) {
              $no_transaksi = $data1['no_transaksi'];
              $tanggal      = date_create($data1['tgl_transaksi']);
              $ttl = $ttl + ($data1['harga']*$data1['qty']); ?>
              <tr>
                <td align="center"><?= $nomer++; ?>.</td>
                <td align="center"><?= date_format($tanggal, "d M Y"); ?></td>
                <td><?= $data1['nama_menu']; ?></td>
                <td align="right"><?= number_format($data1['harga']); ?></td>
                
                <form action="transaksi-customer-ubah.php" method="POST">
                  <td >
                    <input type="hidden" name="id_detail" value="<?= $data1['id_detail']; ?>">

                    <input type="number" name="qty" class="text-right money angkaSemua" value="<?= number_format($data1['qty']); ?>" style="width: 70px;" min="1"> 
                  </td>
                  
                  <td align="right"><span class="subTotal"><?= number_format($data1['harga'] * $data1['qty']); ?></span>
                  </td>
                  <td align="center" class="aksiCustomer">
                    <a href="transaksi-customer-delete.php?id_detail=<?= $data1['id_detail']; ?>" class="badge badge-danger p-2 delete-data" title="Delete"><i class="fas fa-trash"></i></a> | 
                    <button type="submit" class="btn btn-primary p-1" title="Ubah"><i class="fas fa-edit"></i></button> 
                  </td>
                </form>
              </tr>
              <?php
            } ?>
            <tr>
              <?php 
              if($ttl>0){?>
                <td colspan="5" align="right">Total</td>
                <td align="right"><b><?= number_format($ttl); ?></b></td>
                <td align="center" class="aksiCustomer">
                  <a class="btn btn-success btn-sm text-white mt-1" id="customerBayar" id1=<?= $no_transaksi; ?> >&nbsp;<i class="fas fa-dollar-sign"></i>&nbsp;&nbsp;Bayar&nbsp;&nbsp;</a>
                </td>
                <?php 
              }else{?>
                <td colspan="7" align="center">Belum Ada Transaksi !!</td>
                <?php
              }?>
            </tr>
          </tbody>
        </div>
      </table>
    </div>
  </div>
</div>

<?php include "sticky-footer.php"; ?>    
<?php include "footer.php"; ?>

<script>
  $(document).ready(function() {
   // Bayar
    $(document).on('click', '#customerBayar', function() {
      var no_transaksi = $(this).attr('id1');
      $.ajax({
        method: 'POST',
        data: {
          no_transaksi: no_transaksi
        },
        url: 'transaksi-customer-bayar-ajax.php',
        cache: false,
        success: function() {
          Swal.fire("Terima Kasih");
          $('#customerBayar').hide();
          $('.aksiCustomer').hide();
        }
      })
    });

  });

</script>