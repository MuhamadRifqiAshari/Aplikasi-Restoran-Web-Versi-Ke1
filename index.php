<?php
  session_start();
  include "koneksi.php";
  if (!isset($_SESSION['id_login'])){
    $id_login = "";
  }else{
    $noTransaksi  = "";
    $qtyPesan     = "";
    $id_login = $_SESSION['id_login'];
    if($id_login!="sudahLogin"){
      $id_login="";
    }else{
      $idCustomer = $_SESSION['id_customer'];
      $nama       = $_SESSION['nama'];
      $username   = $_SESSION['username'];

      $sql = "SELECT sum(b.qty) AS qty, a.no_transaksi FROM tbl_transaksi a INNER JOIN tbl_transaksi_detail b ON a.no_transaksi = b.no_transaksi WHERE a.id_pegawai = '$idCustomer' AND a.total_bayar = 0 ORDER BY a.no_transaksi DESC";
      $query = mysqli_query($koneksi, $sql);
      if(mysqli_num_rows($query)>0){
        $data         = mysqli_fetch_array($query);
        $noTransaksi  = $data['no_transaksi'];
        $qtyPesan     = $data['qty'];
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en" id="home">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RESTAURANT-360</title>
    <link rel="shorcut icon" type="text/css" href="img/logo1.png">

    <link rel="stylesheet" href="css/bootstrap-4_4_1.min.css">
    <link rel="stylesheet" href="assets/fontawesome-free/css/all.min.css" >
    <link rel="stylesheet" href="css/styleku.css">
  </head>
  <body>
    <!-- SweetAlert2 -->
	  <div class="info-data" data-infodata="<?php if(isset($_SESSION['info'])){ echo $_SESSION['info']; } unset($_SESSION['info']); ?>"></div>
    
    <!-- Jika belum login -->
    <?php 
    if($id_login==""){?>
      <!-- Jumbotron -->
      <div class="jumbotron text-center">
        <img src="img/logo1.png" alt="Logo" class="rounded-circle" >
        <h1 class="textWarning">RESTAURANT-360</h1>
        <p class="kopi">Kopinya Anak Muda Gaul </p>
      </div>
      <!-- Akhir Jumbtron -->
      <?php 
    }?>

    <!-- Navbar -->
    <nav class="navbar sticky-top navbar-expand-lg shadow">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand text-dark" href="#"><img src="img/logo1.png" alt="Logo" width="20px" height="20px" class="pt-1 mr-2"> 
        <?php 
        if($id_login==""){
          echo "RESTAURANT-360";
        }else{
          echo "Selamat Datang <b>" .strtoupper($nama)."</b> di RESTAURANT-360"; 
        }?>
      </a>

      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto mt-lg-0">
          <!-- Jika belum login -->
          <?php 
          if($id_login==""){?>
            <li><a href="#about" class="page-scroll">ABOUT</a></li>
            <li><a href="#portfolio" class="page-scroll">MENU</a></li>
            <li><a href="#contact" class="page-scroll">CONTACT</a></li>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-weight: bold;">LOGIN
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <!-- Form login -->
                <form action="proses.php" method="post">
                  <!-- Username -->
                  <div class="form-group mx-2 my-0 py-0">
                    <input type="text" name="username" class="form-control form-control-sm" placeholder="Username"  autocomplete="off" required>
                  </div>

                  <!-- Password -->
                  <div class="form-group mx-2 my-0 py-0">
                    <input type="password" name="password" class="form-control form-control-sm" placeholder="Password" autocomplete="off" required>
                  </div>
                  <button type="submit" class="btn btn-primary btn-sm ml-2 py-1 my-0">&nbsp;<i class="fa fa-lock"></i>&nbsp;&nbsp;Login&nbsp;&nbsp;</button>
                </form>
              </div>
            </li>
            <?php 
          }else{?>
            <!-- Jika sudah login -->
            <li><a href="dashboard-customer.php" class="page-scroll"><i class="fa fa-shopping-cart" title="Daftar Belanja"></i> <span class="badge badge-success qtyPesan" id="qtyPesan"><?= $qtyPesan; ?></span></a></li>
            <li><a href="logout.php" class="page-scroll" title="LogOut">LOG OUT</a></li>
            <?php 
          }?>
        </ul>
      </div>
    </nav>
    <!-- Akhir Navbar  -->

    <!-- Jika belum login about-->
    <?php 
    if($id_login==""){?>
      <!-- About -->
      <section class="about" id="about">
        <div class="container-fluid imgAbout">
          <div class="row">
            <div class="col-md-12 text-center">
              <h2 class="text-dark">About</h2>
              <hr class="hr">
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-md-6">
              <p class="pKiri">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Menikmati kopi rasanya tak lengkap jika tak tahu asal usulnya. Mari menyesap kopi sambil menikmati tulisan kami tentang sejarah masuknya kopi ke Indonesia. <br>
              
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MASUKNYA kopi ke nusantara tak lepas dari peran kolonialisme Belanda. Sejarah penyebaran kopi dimulai pada 1696 oleh Belanda. Pada masa itu Belanda membawa bibit kopi pertama dari Malabar, India, ke Pulau Jawa. Bibitnya sendiri berasal dari Yaman. Seorang Gubernur Belanda yang bertugas di Malabar, India berinisiatif mengirimkan bibit yang diketahui berjenis arabika ini kepada seorang Gubernur Belanda lain yang sedang bertugas di Batavia, sekarang ini bernama Jakarta.<br>
              
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sayang percobaan pertama ini gagal total akibat seluruh tanamannya hancur terkena gempa bumi dan banjir. Tapi mereka tak mau menyerah begitu saja. Pada 1699 upaya kedua dilakukan. Kali stek kopi dikirim dari Malabar, India juga. Kemudian pada  1706 hasil tanaman kopi pertama di Pulau Jawa dikirim ke Kebun Raya Amsterdam untuk diteliti. Dan menurut hasil penelitian, kopi tersebut memiliki kualitas sangat baik dan berpotensi untuk diperdagangkan ke seluruh dunia.</p>
            </div>
            <div class="col-md-6">
              <p class="pKanan">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sejak saat itu, Belanda memutuskan untuk melebarkan perkebunan kopi ke berbagai daerah lain di nusantara. Tak hanya Jawa, perkebunan kopi dibuka di Aceh, Sumatera Utara, beberapa daerah di Sulawesi, Bali hingga Papua. <br>
              
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pada 1878 adalah masa buruk bagi tanaman kopi. Tanaman kopi diserang oleh penyakit karat daun atau hemileia vastatrix. Hampir seluruh perkebunan kopi di dataran rendah terkena penyakit ini. Dan rata-rata kopi yang ada pada masa itu adalah arabika. Agar hama ini tidak menghancurkan bisnis kopi, Belanda mendatangkan jenis kopi liberika yang digadang-gadang lebih tangguh dan tahan terhadap hama karat daun. <br>
              
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Liberika sempat menjadi primadona karena mampu menggantikan arabika. Harga kopi ini juga sama bagusnya dengan arabika di pasar Eropa. Namun kejayaan ini tak bertahan lama karena liberika juga terkena hama karat daun dan gagal panen. Lalu pada 1907 Belanda mendatangkan jenis kopi lain yaitu robusta. Robusta lebih mampu bertahan dari hama karat daun khususnya di perkebunan kopi di dataran rendah. <br>

              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pada 1945 seluruh perkebunan kopi diambil alih oleh pemerintah Republik Indonesia dan menjadi salah satu komoditas terbesar di negeri ini.
              </p>
            </div>
          </div>
        </div>
      </section>
      <!-- Akhir About  -->
      <?php 
    }?>

    <!-- Menu -->
    <section class="portfolio" id="portfolio">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 text-center">
            <h2>M E N U</h2>
            <hr class="hr">
          </div>
        </div>
        <div class="row menuCustomerBeli">
          <?php 
          $sql = "SELECT * FROM tbl_menu ORDER BY id_jenis_menu, nama_menu";
          $query = mysqli_query($koneksi, $sql);
          while ($data = mysqli_fetch_array($query)) {
            if ($data['img']==""){
              $img = "img/no-logo.png";
            }else{ 
              $img = "img/".$data['img'];
            }
            $id_menu    = $data['id_menu'];
            $nama_menu  = strtoupper($data['nama_menu']);
            $harga      = number_format($data['harga']);
            $qty        = $data['qty'];
            $jual       = $data['jual'];?>

            <div class="col-sm-3 mb-1">
              <a class="gambar">
                <input type="hidden" name="noTrans" value="<?= $noTransaksi; ?>">
                <img src="<?= $img; ?>" alt="<?= $nama_menu; ?>" class="img-responsive">
                <span></span>
                <div class="menuNama"><?= $nama_menu; ?></div>
                <div class="menuHarga"><?= "Rp. " .$harga; ?></div>
                <?php 
                if($qty-$jual>0){?>
                  <div class="menuPesan"><small class="btn btn-sm btn-success pesanMenu" id2="<?= $id_menu; ?>" id3="<?= $idCustomer; ?>"><i class="fa fa-plus"></i></small></div>
                  <?php 
                }else{?>
                  <div class="soldOut"><img src="img/soldOut.png" class="imgSold"></div>
                  <?php 
                }?>
              </a>
            </div>
            <?php 
          }?>
        </div>
      </div>
    </section>
    <!-- Akhir Menu -->

    <!-- Jika belum login buat akun-->
    <?php 
    if($id_login==""){?>
      <!-- Contact -->
      <section class="contact" id="contact">
        <div class="container">
          <div class="row">
            <div class="col-sm-12 text-center">
              <h2>Contact</h2>
              <hr class="hr">
            </div>
          </div>

          <div class="row">
            <div class="col-sm-10">
              <form name="formContact" method="post" action="customer-simpan.php">
                <!-- Nama -->
                <div class="form-group">
                  <label class="col-sm-3 control-label">Nama</label>
                  <div class="col-sm-9">
                    <input name="nama" type="text" class="form-control" placeholder="masukan nama" autocomplete="off">
                  </div>
                </div>

                <!-- Email -->
                <div class="form-group">
                  <label class="col-sm-3 control-label">Email</label>
                  <div class="col-sm-9">
                    <input name="email" type="email" class="form-control"  placeholder="masukan email" autocomplete="off" onKeyUp="testEmailChars(this);"> <small id="cekEmail"></small>
                  </div>
                </div>

                <!-- Username -->
                <div class="form-group">
                  <label class="col-sm-3 control-label">Username</label>
                  <div class="col-sm-9">
                    <input name="username2" type="text" class="form-control" placeholder="masukan username" autocomplete="off">
                  </div>
                </div>

                <!-- Password -->
                <div class="form-group">
                  <label class="col-sm-3 control-label">Password</label>
                  <div class="col-sm-9">
                    <input name="password2" type="password"  class="form-control"  placeholder="masukan password untuk login" autocomplete="off">
                  </div>
                </div>

                <!-- Telp -->
                <div class="form-group">
                  <label class="col-sm-3 control-label">No. Telp / WA</label>
                  <div class="col-sm-9">
                    <input name="telp" type="text" class="form-control" placeholder="masukan no telp" autocomplete="off">
                  </div>
                </div>

                <!-- Alamat -->
                <div class="form-group">
                  <label class="col-sm-3 control-label">Alamat</label>
                  <div class="col-sm-9">
                    <textarea name="alamat" class="form-control" placeholder="masukan alamat" cols="30" rows="3"></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-2">
                    <input name='buatAkun' type="submit" class="btn btn-primary buatAkun" value="Buat Akun" style="width:100px; display:inline-block; ">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
      <!-- Akhir Contact -->
      <?php 
    }?>

    <!-- Footer -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <p class="footer">Muhamad Rifqi Ashari</p>
          </div>
        </div>
      </div>
    </footer>
    <!-- Akhir Footer -->

    <!-- <script src="js/jquery.min.js"></script> -->
    <script src="assets/jquery/jquery.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
	  <script src="js/style-sweetalert2.js"></script>
    
    <?php 
    if($id_login==""){?>
      <script src="js/script.js"></script>
      <?php 
    }else{?>
      <script src="js/script_login.js"></script>
      <?php 
    }?>
    <script>
      $(document).ready(function () {
        $(document).on("click", ".buatAkun", function () {
          var nama      = $('[name="nama"]').val();
          var email     = $('[name="email"]').val();
          var cekEmail  = $('#cekEmail').text();
          var username  = $('[name="username2"]').val();
          var password  = $('[name="password2"]').val();
          var telp      = $('[name="telp"]').val();
          var alamat    = $('[name="alamat"]').val();
          if (nama == "") {
            Swal.fire('Nama belum diisi!');
            return false;
          } else if (email == "") {
            Swal.fire('Email belum diisi!');
            return false;
          } else if (cekEmail != "valid") {
            Swal.fire('format Email salah!');
            return false;
          } else if (username == "") {
            Swal.fire('username belum diisi!');
            return false;
          } else if (password == "") {
            Swal.fire('Password belum diisi!');
            return false;
          } else if (telp == "") {
            Swal.fire('Telp belum diisi!');
            return false;
          } else if (alamat == "") {
            Swal.fire('alamat belum diisi!');
            return false;
          }
        });

        $(document).on("click", ".pesanMenu", function () {
          var idMenu      = $(this).attr('id2');
          var idCustomer  = $(this).attr('id3');
          var noTrans     = $('[name="noTrans"]').val();
          $.ajax({
            method: 'POST',
            data: {
              idMenu: idMenu,
              idCustomer: idCustomer,
              noTrans: noTrans
            },
            url: 'transaksi-customer-ajax.php',
            cache: false,
            success: function(a) {
              var row = JSON.parse(a);
              var noTransaksi = row.no_transaksi;
              var qtyPesan = row.qty;
              var stock = row.stock;
              $('[name="noTrans"]').val(noTransaksi);
              $('#qtyPesan').text(qtyPesan);
              $('.menuCustomerBeli').load('transaksi-customer-beli.php', {
                idCustomer: idCustomer,
                noTransaksi:noTransaksi
              });
            }
          });
        });

        $(document).on("click", "#userDropdown", function () {
          $('[name="username"]').focus();
        });

      });

      
      // Cek Validasi Email
      function testEmailChars(){
        var rs = document.forms["formContact"]["email"].value;
        var atps=rs.indexOf("@");
        var dots=rs.lastIndexOf(".");
        if (atps<1 || dots<atps+2 || dots+2>=rs.length) {
          $("#cekEmail").html("not valid");
        } else {
	        $("#cekEmail").html("valid");
        }
      }


    </script>
    
   </body>
</html>
