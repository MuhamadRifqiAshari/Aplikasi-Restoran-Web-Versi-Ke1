<?php
  session_start();
  session_destroy();
  unset( $_SESSION['id_login']);
  header("location:index.php");
?>