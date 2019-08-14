<?php
session_start(); 
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
    echo  "<script>window.alert('Untuk mengakses modul, Anda harus login dulu.');
        window.location = 'index.php'</script>";  
}
    // Apabila user sudah login dengan benar, maka terbentuklah session
else{
	require_once "../../../config/db.php";
	require_once "../../../config/fungsi_antiinjection.php";


    $module = $_GET['module'];
  	$act	= $_GET['act'];

  	// Input Staff
	if ($module=='staff' AND $act=='input'){

		$nim      = anti_injection($_POST['nim']);
		$nama     = anti_injection($_POST['nama']);
		$fakultas = anti_injection($_POST['fakultas']); 
		$prodi    = anti_injection($_POST['prodi']);	

		$input = "INSERT INTO staff(nim, nama, fakultas, prodi) 
				  VALUES('$nim', '$nama', '$fakultas','$prodi')";

		mysqli_query($connect, $input);
		echo "<script>alert('Data Berhasil Di Tambah'); 
               window.location = '../../media.php?module=staff'</script>";	    
	}

	// Update Staff
	elseif ($module=='staff' AND $act=='update'){
		
		$id       = $_POST['id'];
		$nim      = anti_injection($_POST['nim']);
		$nama     = anti_injection($_POST['nama']);
		$fakultas = anti_injection($_POST['fakultas']); 
		$prodi    = anti_injection($_POST['prodi']);
	  
	    $update = "UPDATE staff SET nim      = '$nim',
	    						   nama     = '$nama',
			    				   fakultas = '$fakultas',
			                       prodi    = '$prodi'
			                 WHERE id_staf  = '$id'";
			                 
		mysqli_query($connect, $update);	 
		echo "<script>alert('Data Berhasil Di Update'); 
                window.location = '../../media.php?module=staff'</script>";
	}

	// Delete Staff
	elseif($module=='staff' AND $act=='delete'){
	    mysqli_query($connect, "DELETE FROM staff WHERE id_staf='$_GET[id]'");
    	header("location:../../media.php?module=".$module);
	}
}
?>