<select name="id_menu" id="id_menu" class="form-control form-control-sm form-control-chosen" required>
  <option value="" selected>~ Pilih Nama Menu ~</option>
  <?php
  include "koneksi.php";
  $sql = "SELECT * FROM tbl_menu WHERE qty - jual > 0 ORDER BY nama_menu";
  $query = mysqli_query($koneksi, $sql);
  while ($data = mysqli_fetch_array($query)) { ?>
    <option value=<?= $data['id_menu']; ?>> <?= $data['nama_menu']; ?> - Rp. <?= number_format($data['harga']); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sisa : <?= $data['qty']-$data['jual'];?>  </option>
    <?php
  }?>
</select>

<script>
  $('.form-control-chosen').chosen({
    allow_single_deselect: true,
  });
</script>