<?php
  session_start();
  include "koneksi.php";
  $id_pegawai 	  = $_POST['id_pegawai'];
  $id_menu 	      = $_POST['id_menu'];
  $nama_menu	    = $_POST['nama_menu'];
  $nama_menu1	    = $_POST['nama_menu1'];
  $id_jenis_menu  = $_POST['id_jenis_menu'];
  $harga          = str_replace(',','', mysqli_escape_string($koneksi, $_POST['harga']));
  $qty            = str_replace(',','', mysqli_escape_string($koneksi, $_POST['qty']));
  $qty1           = $_POST['qty1'];

  $namaBaru = date('dmYHis');
  $img 		  = $_FILES['img']['name'];
  if($img !=""){$imgBaru = $namaBaru.$_FILES['img']['name'];};

  $sql      = "SELECT * FROM tbl_menu WHERE id_menu = '$id_menu'";
  $query    = mysqli_query($koneksi, $sql);
  $data     = mysqli_fetch_array($query);
  $imgLama  = $data['img'];

  if($qty<$qty1){
    $_SESSION['info'] = 'Gagal Diupdate';
  }else{
    if($nama_menu == $nama_menu1){
      if($img==""){
        $sql = "UPDATE tbl_menu SET 
          id_jenis_menu = '$id_jenis_menu',
          harga         = '$harga',
          qty           = '$qty',
          id_pegawai    = '$id_pegawai'
        WHERE id_menu   = '$id_menu'";
        mysqli_query($koneksi, $sql);
        $_SESSION['info'] = 'Diupdate';
      }else{
        $sql = "UPDATE tbl_menu SET 
          id_jenis_menu = '$id_jenis_menu',
          harga         = '$harga',
          qty           = '$qty',
          id_pegawai    = '$id_pegawai',
          img           = '$imgBaru'
        WHERE id_menu   = '$id_menu'";
        $hsl=mysqli_query($koneksi, $sql);
        if($hsl==1){
          if($img!=""){unlink("img/".$imgLama);}
          move_uploaded_file($_FILES['img']['tmp_name'], "img/".$imgBaru);
          $_SESSION['info'] = 'Diupdate';
        }else{
          $_SESSION['info'] = 'Gagal Diupdate';
        }
      }
    }else{
      $sql 		= "SELECT * FROM tbl_menu WHERE nama_menu = '$nama_menu' ORDER BY nama_menu";
      $query 	= mysqli_query($koneksi, $sql);
      if(mysqli_num_rows($query)>0){
        $_SESSION['info'] = 'Gagal Diupdate';
      }else{
        if($img==""){
          $sql = "UPDATE tbl_menu SET 
            nama_menu     = '$nama_menu',
            id_jenis_menu = '$id_jenis_menu',
            harga         = '$harga',
            qty           = '$qty',
            id_pegawai    = '$id_pegawai'
          WHERE id_menu   = '$id_menu'";
          mysqli_query($koneksi, $sql);
          $_SESSION['info'] = 'Diupdate';
        }else{
          $sql = "UPDATE tbl_menu SET
            nama_menu     = '$nama_menu',
            id_jenis_menu = '$id_jenis_menu',
            harga         = '$harga',
            qty           = '$qty',
            id_pegawai    = '$id_pegawai',
            img           = '$imgBaru'
          WHERE id_menu   = '$id_menu'";
          $hsl=mysqli_query($koneksi, $sql);
          if($hsl==1){
            if($img!="" && $img!="no-logo.png"){unlink("img/".$imgLama);}
            move_uploaded_file($_FILES['img']['tmp_name'], "img/".$imgBaru);
            $_SESSION['info'] = 'Diupdate';
          }else{
            $_SESSION['info'] = 'Gagal Diupdate';
          }
        }
      }
    }
  }
  header("location:menu.php");
?>
