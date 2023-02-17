<style>
  nav.navbar.navbar-expand.shadow{
    background-color: Burlywood;
    color: black;
    font-weight: bold;
    margin-bottom: 0px;
  }
</style>


<nav class="navbar navbar-expand topbar static-top shadow">
  <!-- Sidebar Toggle (Topbar) -->
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>

  <div class="d-none d-sm-inline-block ml-md-3 my-2 my-md-0 mw-100 h3" >
    <marquee width="350%" behavior="" direction="left">Selamat Datang <?= strtoupper($nama); ?> di <b>RESTAURANT-360</b></marquee> 
  </div>

  <!-- Topbar Navbar -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img class="img-profile rounded-circle mr-3" src="photo/logo1.png" >
      </a>

      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="index.php">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Back
        </a>
      </div>
    </li>
  </ul>
</nav>