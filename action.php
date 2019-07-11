
<?php
require_once('config/db.php');
//$act = $_GET['act'];

 //upload
if (isset($_POST['upload'])){
    // attribut file
  $harusekstensi = array('doc','docx','pdf');
  $nama = $_FILES['file']['name'];
  $x = explode('.',$nama);
  $ekstensi = strtolower(end($x));
  $size = $_FILES['file']['size'];
  $file_tmp = $_FILES['file']['tmp_name'];

  // attribut lainnya
  $nim      = $_POST['nim'];
  $title    = $_POST['title'];
  $author   = $_POST['author'];
  $category = $_POST['category'];
  $year     = $_POST['year'];
  $abstract = $_POST['abstract'];
  $fakultas = $_POST['fakultas'];
  $prodi    = $_POST['prodi'];
  date_default_timezone_set("Asia/Bangkok");
  $uploadtime = date ("Y-m-d H:i:s");

  //query untuk cek record sudah ada apa belum
  $cek = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM skripsi WHERE nim='$nim'"));
  if ($cek > 0){
    echo "<script>window.alert('NIM yang anda masukan sudah ada')
    window.location='index.php'</script>";
  }
  else {
    if (in_array($ekstensi, $harusekstensi)==true){
      if($size < 10000000){
        move_uploaded_file($file_tmp, 'pdffiles/'.$nama);
        $create = "INSERT INTO skripsi(nim,title,author,category,year,abstract,fakultas,prodi,filename,
        uploadtime)VALUES('$nim','$title','$author','$category','$year','$abstract','$fakultas','$prodi','$nama','$uploadtime')";
        $query = mysqli_query($connect,$create);

        if ($query) {
          $URL="index.php";
          echo "<script>alert('Data Berhasil Di Simpan'); 
                 document.location.href='{$URL}';</script>";
          echo '<META HTTP-EQUIV="refresh" content="0;URL='.$URL.'">';
        } else{
          echo  "<script>window.alert('FAILED UPLOADING FILE');
          window.location = 'index.php'</script>";
        }
      }
      else {
        echo  "<script>window.alert('YOUR FILE IS TOO LARGE');
          window.location = 'index.php'</script>";
      }
    }
    else {
      echo  "<script>window.alert('THE EXTENSION IS NOT VALID');
          window.location = 'index.php'</script>";
    }
  }
}

?>