<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<script>window.alert('Untuk mengakses modul, Anda harus login dulu.');
        window.location = 'index.php'</script>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  require_once "../../../config/db.php";
  
  $module = $_GET['module'];
  $act  = $_GET['act'];

    // Update identitas
  if ($module=='identitas' AND $act=='update'){

    $id             = $_POST['id'];
    $nama_pemilik   = $_POST['nama_pemilik'];
    $judul_website  = $_POST['judul_website'];
    $alamat_website = $_POST['alamat_website']; 
    $meta_deskripsi = $_POST['meta_deskripsi'];
    $meta_keyword   = $_POST['meta_keyword'];
    $email          = $_POST['email'];
    // echo $id;
    // echo $nama_pemilik;
    // exit();

      $edit = "UPDATE identitas SET nama_pemilik   = '$nama_pemilik',
                                    judul_website  = '$judul_website',
                                    alamat_website = '$alamat_website',
                                    meta_deskripsi = '$meta_deskripsi',
                                    meta_keyword   = '$meta_keyword',
                                    email          = '$email'
                              WHERE id_identitas   = '$id'";
      mysqli_query($connect, $edit);
      header("location:../../media.php?module=".$module);
    
  }
}
?>
