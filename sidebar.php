<style>
  #accordionSidebar{
    background: url("img/standing-banner-01.jpg");
    background-size:cover;
  }
  li.nav-item{
    margin-top: -10px !important;
    margin-bottom: -10px !important;
  }
  span{
    color: black !important;
    font-weight: bold;
  }
</style>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
  <img src="img/logo1.png" alt="logo" width="60px" height="60px">
    <span class="sidebar-brand-text mx-3"><?= $judul; ?></span>
  </a>
  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="dashboard.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider">

  <?php
    if($jabatan=="Admin"){?>
      <!-- User Login -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="login.php" >
          <i class="fas fa-fw fa-user"></i>
          <span>User Login</span>
        </a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
      
      <!-- Laporan user -->
      <li class="nav-item">
        <a class="nav-link" href="laporan-user.php">
          <i class="fas fa-fw fa-clipboard-list"></i>
          <span>Laporan User</span>
        </a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Log -->
      <li class="nav-item">
        <a class="nav-link" href="log.php">
          <i class="fas fa-fw fa-clipboard-list"></i>
          <span>Log Pegawai</span>
        </a>
      </li>
      <?php 
    }else if($jabatan=="Manajer"){?>
      <!-- Master -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <i class="fas fa-fw fa-cog"></i>
          <span>Master</span>
        </a>
              
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- Pegawai -->
            <a class="collapse-item" href="pegawai.php">
              <i class="fas fa-fw fa-users"></i>
              <span>Pegawai</span>
            </a>
      
            <!-- Jenis Menu -->
            <a class="collapse-item" href="jenis-menu.php">
              <i class="fas fa-fw fa-clipboard-list"></i>
              <span>Jenis Menu</span>
            </a>
  
            <!-- Daftar Menu -->
            <a class="collapse-item" href="menu.php">
              <i class="fas fa-fw fa-clipboard-list"></i>
              <span>Daftar Menu</span>
            </a>
          </div>
        </div>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">
      
      <!-- Laporan-laporan -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-edit"></i>
          <span>Laporan-laporan</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- Laporan pegawai -->
            <a class="collapse-item" href="laporan-pegawai.php">
              <i class="fas fa-fw fa-clipboard-list"></i>
              <span>Laporan Pegawai</span>
            </a>
            
            <!-- Laporan Jenis Menu -->
            <a class="collapse-item" href="laporan-jenis-menu.php">
              <i class="fas fa-fw fa-clipboard-list"></i>
              <span>Laporan Jenis Menu</span>
            </a>
            
            <!-- Laporan Menu -->
            <a class="collapse-item" href="laporan-menu.php">
              <i class="fas fa-fw fa-clipboard-list"></i>
              <span>Laporan Menu</span>
            </a>

            <!-- Laporan Transaksi -->
            <a class="collapse-item" href="laporan-transaksi.php">
              <i class="fas fa-fw fa-clipboard-list"></i>
              <span>Laporan Transaksi</span>
            </a>

            <!-- Laporan Transaksi -->
            <a class="collapse-item" href="laporan-customer.php">
              <i class="fas fa-fw fa-clipboard-list"></i>
              <span>Laporan Customer</span>
            </a>
          </div>
        </div>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">
      
      <!-- Log -->
      <li class="nav-item">
        <a class="nav-link" href="log.php">
          <i class="fas fa-fw fa-clipboard-list"></i>
          <span>Log Pegawai</span>
        </a>
      </li>
      <?php 
    }else if($jabatan=="Kasir"){?>
      <!-- Transaksi -->
      <li class="nav-item">
        <a class="nav-link" href="transaksi.php">
          <i class="fas fa-fw fa-clipboard-list"></i>
          <span>Transaksi</span>
        </a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Laporan Transaksi -->
      <li class="nav-item">
        <a class="nav-link" href="laporan-transaksi.php">
          <i class="fas fa-fw fa-clipboard-list"></i>
          <span>Laporan Transaksi</span>
        </a>
      </li>
      <?php
    }
  ?>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">
  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline mt-3">
    <button class="rounded-circle border-0 bg-warning" id="sidebarToggle"></button>
  </div>
</ul>

<div id="content-wrapper" class="d-flex flex-column">
  <div id="content">
  