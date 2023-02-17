<style>
  .backGambar{
    height:82vh;
    overflow-y: scroll;

  }
  .display-5{
    position: relative;
    color: black !important;
    font-weight: bold;
    margin-bottom: -5px;
    text-align: center;
  }
  p.lead{
    color: blue;
    font-size: 24px;
    text-align: center;
  }
  .smk{
    text-align: right !important;
    margin-top: -15px;
    font-size: 14px;
    margin-right: 30px;
  }
</style>

<?php 
  // if(is_null($_SESSION['login'])){$_SESSION['login']="";}
  // if($_SESSION['login']!='haRusLogin'){
    //   echo "<h1 align='center'>ANDA BELUM LOGIN</h1>";
    //   header("refresh:3;url=index.php");
    //   exit();
    // }
    ?>

<?php
  $judul = "HOME";
  include "koneksi.php";
  include "header.php";
  include "sidebar.php";
  include "topbar.php";
  $waktu = date('Y-m-d');
  $id_pegawai = $_SESSION['id_pegawai'];

  
  // Jumlah Karyawan
  $jml = 0;
  $query  = "SELECT count(id_pegawai) AS jml FROM tbl_pegawai";
  $sql    = mysqli_query($koneksi, $query);
  if(mysqli_num_rows($sql)>0){
    $data = mysqli_fetch_assoc($sql);
    $jml  = $data['jml'];
  } 

  // Perempuan
  $p = 0;
  $query  = "SELECT count(id_pegawai) AS perempuan FROM tbl_pegawai WHERE jenis_kelamin = 'Perempuan'";
  $sql    = mysqli_query($koneksi, $query);
  if(mysqli_num_rows($sql)>0){
    $data = mysqli_fetch_assoc($sql);
    $p  = $data['perempuan'];
  }

  // Perempuan
  $l = 0;
  $query  = "SELECT count(id_pegawai) AS laki_laki FROM tbl_pegawai WHERE jenis_kelamin = 'Laki-laki'";
  $sql    = mysqli_query($koneksi, $query);
  if(mysqli_num_rows($sql)>0){
    $data = mysqli_fetch_assoc($sql);
    $l  = $data['laki_laki'];
  }

  // Total Pendapatan
  $sql   = "SELECT sum(total_transaksi) as jml FROM tbl_transaksi";
  $query = mysqli_query($koneksi, $sql);
  $data  = mysqli_fetch_array($query);
  $ttl   = $data['jml'];

  // Total pendapatan harian 
  $sql1   = "SELECT sum(total_transaksi) as jml FROM tbl_transaksi WHERE tgl_transaksi = '$waktu'";
  $query1 = mysqli_query($koneksi, $sql1);
  $data1  = mysqli_fetch_array($query1);
  $hr     = $data1['jml'];

  // Total Pendapatan Kasir
  $sql   = "SELECT sum(total_transaksi) as jml FROM tbl_transaksi WHERE id_pegawai = '$id_pegawai'";
  $query = mysqli_query($koneksi, $sql);
  $data  = mysqli_fetch_array($query);
  $ttlKsr= $data['jml'];

  $sql1   = "SELECT sum(total_transaksi) as jml FROM tbl_transaksi WHERE tgl_transaksi = '$waktu' AND id_pegawai = '$id_pegawai'";
  $query1 = mysqli_query($koneksi, $sql1);
  $data1  = mysqli_fetch_array($query1);
  $hrKsr  = $data1['jml'];

?>

<div class="container-fluid backGambar"">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-3">
    <!-- <h1 class="h3 pt-5 text-dark">Dashboard</h1> -->
  </div>

  <!-- Content -->
  <?php
    if($jabatan=="Admin"){?>
      <div class="row mt-5 pt-3">
        <div class="col-md-7 jumbotron m-5">
        <p class="lead">SELEMAT DATANG DI</p>
          <h1 class="display-5">APLIKASI RESTAURANT-360</h1>
          <hr class="hr" style="width:100%; margin-top: -10px">
          <p class="smk"></p>
        </div>
      </div>
      <?php  
    }
  ?>

  <?php
    if($jabatan=="Manajer"){?>
      <div class="row mt-4">
        <!-- Jumlah Karyawan -->
        <div class="col-xl-3 col-md-6 mb-2">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="font-weight-bold text-primary text-uppercase mb-1">
                  Total Karyawan</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($jml); ?> Orang</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-users fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Perempuan -->
        <div class="col-xl-3 col-md-6 mb-2">
          <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="font-weight-bold text-success text-uppercase mb-1">
                  Perempuan</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($p); ?> Orang</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-female fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Laki-laki -->
        <div class="col-xl-3 col-md-6 mb-2">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="font-weight-bold text-info text-uppercase mb-1">Laki-laki
                  </div>
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= number_format($l); ?> orang</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-male fa-2x text-gray-300"></i>
                </div>
                <!-- <div class="progress-bar bg-info" role="progressbar"
                style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                aria-valuemax="100"></div> -->
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <!-- Total Pendapatan -->
        <div class="col-xl-3 col-md-6 mb-2">
          <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="font-weight-bold text-danger text-uppercase mb-1">
                  Ttl Penerimaan</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($ttl); ?> </div>
                </div>
                <div class="col-auto">
                  <i class="fa fa-gift fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Penerimaan Hari ini -->
        <div class="col-xl-3 col-md-6 mb-2">
          <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="font-weight-bold text-warning text-uppercase mb-1">Hari ini
                  </div>
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= number_format($hr); ?></div>
                </div>
                <div class="col-auto">
                  <i class="fa fa-credit-card fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php  
    }
  ?>

  <?php
    if($jabatan=="Kasir"){?>
      <div class="row mt-5 pl-5 pt-3">
        <!-- Total Pendapatan Kasir-->
        <div class="col-xl-3 col-md-6 mb-2">
          <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="font-weight-bold text-danger text-uppercase mb-1">
                  Ttl Penerimaan</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($ttlKsr); ?> </div>
                </div>
                <div class="col-auto">
                  <i class="fa fa-gift fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Penerimaan Hari ini -->
        <div class="col-xl-3 col-md-6 mb-2">
          <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="font-weight-bold text-warning text-uppercase mb-1">Hari ini
                  </div>
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= number_format($hrKsr); ?></div>
                </div>
                <div class="col-auto">
                  <i class="fa fa-credit-card fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php  
    }
  ?>

  
</div>

<?php include "sticky-footer.php"; ?>    
<?php include "footer.php"; ?>