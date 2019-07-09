<?php
session_start(); 
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
    echo  "<script>window.alert('Untuk mengakses modul, Anda harus login dulu.');
        window.location = 'index.php'</script>"  
}
    // Apabila user sudah login dengan benar, maka terbentuklah session
else{
	require_once "../../../config/db.php";
	require_once "../../../config/fungsi_antiinjection.php";


    $module = $_GET['module'];
  	$act	= $_GET['act'];

  	// Input user
	if ($module=='user' AND $act=='input'){
		$username     = anti_injection($_POST['username']);
		$password     = anti_injection($_POST['password']);
		$nama_lengkap = anti_injection($_POST['nama_lengkap']); 
		$email        = anti_injection($_POST['email']);

		// perlu dibuat sebarang pengacak
		$pengacak  = "L1BR4rYUN!D490nToR102496B15M!LL4H";

		// mengenkripsi password dengan md5() dan pengacak
		$pass_enkripsi = md5($pengacak . md5($password) . $pengacak);

	

		$input = "INSERT INTO users(nama_lengkap, username, password, email, foto, level) 
				VALUES('$nama_lengkap', '$username', '$pass_enkripsi', '$email', 'avatar5.png', 'admin')";
		mysqli_query($connect, $input);
		echo "<script>alert('Data Berhasil Di Tambah'); 
               window.location = '../../media.php?module=user'</script>";	    
	}

	// Update user
	elseif ($module=='user' AND $act=='update'){
		$id           = $_POST['id'];
		//$username     = anti_injection($_POST['username']);
		$password     = anti_injection($_POST['password']);
		$nama_lengkap = anti_injection($_POST['nama_lengkap']); 
		$email        = anti_injection($_POST['email']);

		// perlu dibuat sebarang pengacak
		$pengacak  = "L1BR4rYUN!D490nToR102496B15M!LL4H";

		// mengenkripsi password dengan md5() dan pengacak
		$pass_enkripsi = md5($pengacak . md5($password) . $pengacak);

	    // Apabila password tidak diganti diubah
		if (empty($password) && empty($nama_file)) {
			$update = "UPDATE users SET nama_lengkap = '$nama_lengkap',
				    					       email = '$email'
				                       WHERE id_user = '$id'";
			mysqli_query($connect, $update);
		}
		// Apabila password diubah
		elseif ($password)
		{
		    $update = "UPDATE users SET nama_lengkap = '$nama_lengkap',
				    						password = '$pass_enkripsi',
				                               email = '$email'
				                       WHERE id_user = '$id'";
			mysqli_query($connect, $update);	 
		}
		echo "<script>alert('Data Berhasil Di Update'); 
                window.location = '../../media.php?module=user'</script>";
	}

	// Delete User
	elseif($module=='user' AND $act=='delete'){
	    mysqli_query($konek, "DELETE FROM users WHERE id_user='$_GET[id]'");
    	header("location:../../media.php?module=".$module);
	}
}
?>