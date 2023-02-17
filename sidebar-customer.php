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
    <a class="nav-link" href="dashboard-customer.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Transaksi</span>
    </a>
  </li>
  <!-- Divider -->

  <hr class="sidebar-divider">
  <!-- Transaksi -->
  <li class="nav-item">
    <a class="nav-link" href="history-customer.php">
      <i class="fas fa-fw fa-clipboard-list"></i>
      <span>History</span>
    </a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline mt-3">
    <button class="rounded-circle border-0 bg-warning" id="sidebarToggle"></button>
  </div>
</ul>

<div id="content-wrapper" class="d-flex flex-column">
  <div id="content">