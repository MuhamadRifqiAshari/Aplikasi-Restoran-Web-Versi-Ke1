<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name Menu</th>
      <th scope="col">Harga</th>
      <th scope="col">Qty</th>
      <th scope="col">Subtotal</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
  <?php
    include "koneksi.php";
    $no=1;
    $result = $_POST['noTransaksi'];
    $sql = "SELECT a.qty AS qty, a.harga, a.id_detail, b.nama_menu FROM tbl_transaksi_detail a INNER JOIN tbl_menu b ON a.id_menu = b.id_menu WHERE no_transaksi = '$result'";
    $query = mysqli_query($koneksi, $sql);
    if(mysqli_num_rows($query)>0){
      while($data = mysqli_fetch_array($query)){?>
        <tr>
          <td align="center" width="3%"><?= $no++;?>.</td>
          <td><?= $data['nama_menu'];?></td>
          <td align="right"><?= number_format($data['harga']);?></td>
          <td align="right"><?= $data['qty'];?></td>
          <td align="right"><?= number_format($data['harga']*$data['qty']);?></td>
          <td align="center"><span class="fas fa-trash transaksiAksi text-danger" id=<?= $data['id_detail'];?> title="Hapus"></span></td>
        </tr>
        <?php
      }
    }?>
  </tbody>
</table>