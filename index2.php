<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Aplikasi RESTAURANT-360">
  <title>RESTAURANT-360 | Login</title>
  
  <link rel="shorcut icon" type="text/css" href="photo/logo1.png">
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  
  <style>
    body{
      /* Gambar Login */
      background-image: url("img/1.png");
      background-size: cover;
      background-repeat: no-repeat;
      /* Posisi Gambar */
      background-position-y: 80%;
    }
    .body-login{
      left: 700px;
      top:150px;
      /* box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px; */
      box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
    }
  </style>
</head>

  <body>
    <!-- SWAL -->
	  <div class="info-data" data-infodata="<?php if(isset($_SESSION['info'])){ echo $_SESSION['info']; } unset($_SESSION['info']); ?>"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-3 body-login">
          <div class="card p-4 bg-transparent border-0">
            <div class="text-center" >
              <!-- <h1 class="h4 text-dark mb-4">LOGIN</h1> -->
              <!-- <img src="photo/favicon.png" alt="logo" class="img-rounded" width="60" height="60"> -->
            </div>
            <form action="proses.php" method="post">
              <div class="form-group mb-2">
                <input type="text" name="username" class="form-control form-control-sm" placeholder="Username" autofocus autocomplete="off" required>
              </div>
              <div class="form-group">
                <input type="password" name="password" class="form-control form-control-sm" placeholder="Password" autocomplete="off" required>
              </div>
              <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-lock"></i> Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="assets/jquery/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
	  <script src="js/style-sweetalert2.js"></script>
    <script src="js/style.js"></script>
  </body>
</html>