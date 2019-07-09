<?php
session_start(); 
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
    echo "<link href=\"css/style_login.css\" rel=\"stylesheet\" type=\"text/css\" />
          <div id=\"login\"><h1 class=\"fail\">Untuk mengakses modul, Anda harus login dulu.</h1>
          <p class=\"fail\"><a href=\"index.php\">LOGIN</a></p></div>";  
}
    // Apabila user sudah login dengan benar, maka terbentuklah session
else{
	require_once "../../../config/koneksi.php";
	require_once "../../../config/fungsi_antiinjection.php";


    $module = $_GET['module'];
  	$act	= $_GET['act'];

  	// Input user
	if ($module=='user' AND $act=='input'){
		$username     = anti_injection($_POST['username']);
		$password     = anti_injection($_POST['password']);
		$nama_lengkap = anti_injection($_POST['nama_lengkap']); 
		$bagian       = anti_injection($_POST['bagian']); 
		$email        = anti_injection($_POST['email']);

		// perlu dibuat sebarang pengacak
		$pengacak  = "B4P@KUN!D490nToR102496B15M!LL4H";

		// mengenkripsi password dengan md5() dan pengacak
		$pass_enkripsi = md5($pengacak . md5($password) . $pengacak);

	    $lok_file   = $_FILES['foto']['tmp_name'];
	    $tipe_file  = $_FILES['foto']['type'];
	    $nama_file  = $_FILES['foto']['name'];
	    $ukuran     = $_FILES['foto']['size'];
	    $eks_boleh  = array('png','jpg');
	    $d          = explode('.', $nama_file);
	    $ekstensi   = strtolower(end($d));
		
		 $size=1000000;

		if (in_array($ekstensi, $eks_boleh) === true) {
	        if ($ukuran > $ukuran_maks) {
	            echo "<script>window.alert('Ukuran tidak boleh lebih dari 10MB');
                      self.history.back();</script>";
	        }
	        else{
	        	$dir = "../../../dist/img/$nama_file";
	            move_uploaded_file($lok_file, "$dir");

				$input = "INSERT INTO users(nama_lengkap, bagian, username, password, email, foto) 
						          VALUES('$nama_lengkap', '$bagian', '$username', '$pass_enkripsi', '$email', '$nama_file')";
				mysqli_query($konek, $input);
				header("location:../../media.php?module=".$module);     
	        }
	    }
	    else{
	        echo "<script>window.alert('Upload Gagal! Pastikan file yang di upload bertipe *.JPG/.PNG');
                  self.history.back();</script>";
	    }      
	}

	// Update user
	elseif ($module=='user' AND $act=='update'){
		$id           = $_POST['id'];
		//$username     = anti_injection($_POST['username']);
		$password     = anti_injection($_POST['password']);
		$nama_lengkap = anti_injection($_POST['nama_lengkap']); 
		$bagian       = anti_injection($_POST['bagian']); 
		$email        = anti_injection($_POST['email']);

		// perlu dibuat sebarang pengacak
		$pengacak  = "B4P@KUN!D490nToR102496B15M!LL4H";

		// mengenkripsi password dengan md5() dan pengacak
		$pass_enkripsi = md5($pengacak . md5($password) . $pengacak);

	    $lok_file   = $_FILES['foto']['tmp_name'];
	    $tipe_file  = $_FILES['foto']['type'];
	    $nama_file  = $_FILES['foto']['name'];
	    $ukuran     = $_FILES['foto']['size'];
	    $eks_boleh  = array('png','jpg');
	    $d          = explode('.', $nama_file);
	    $ekstensi   = strtolower(end($d));
		
	    $size=1000000;

	 
	    // Apabila password dan foto tidak diganti diubah
		if (empty($password) && empty($nama_file)) {
			$update = "UPDATE users SET nama_lengkap = '$nama_lengkap',
				    						  bagian = '$bagian',
				    					       email = '$email'
				                       WHERE id_user = '$id'";
			mysqli_query($konek, $update);
		}
		// Apabila password diubah
		elseif ($password)
		{
		    $update = "UPDATE users SET nama_lengkap = '$nama_lengkap',
				    						  bagian = '$bagian',
				    						password = '$pass_enkripsi',
				                               email = '$email'
				                       WHERE id_user = '$id'";
			mysqli_query($konek, $update);	 
		}
		echo "<script>alert('Data Berhasil Di Update'); 
                window.location = '../../media.php?module=user'</script>";
	}

	// Delete User
	elseif($module=='user' AND $act=='delete'){
		$query = "SELECT foto FROM users WHERE id_user='$_GET[id]'";
	    $hapus = mysqli_query($konek, $query);
	    $r     = mysqli_fetch_array($hapus);
	    
	    if ($r['foto']!=''){
	      $namafile = $r['foto']; 

	      // hapus file gambar yang berhubungan dengan berita tersebut
	      unlink("../../../dist/img/$namafile");   

	      // hapus data  di database 
	      mysqli_query($konek, "DELETE FROM users WHERE id_user='$_GET[id]'");      
	    }
	    else{
	      mysqli_query($konek, "DELETE FROM users WHERE id_user='$_GET[id]'");
	    }
	    header("location:../../media.php?module=".$module);
	}
}
?>