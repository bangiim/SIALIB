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

  	// Input keuangan
	if ($module=='keuangan' AND $act=='input'){
		$username    = anti_injection($_POST['username']);
		$status      = anti_injection($_POST['status']);
		$jenis		 = anti_injection($_POST['jenis']); 
		$tgl		 = anti_injection($_POST['tgl']);
		$keterangan  = anti_injection($_POST['ktr']);
		$jumlah		 = anti_injection($_POST['jumlah']);

		$input = "INSERT INTO keuangan(username, status, jenis, tgl, keterangan, jumlah) 
				VALUES('$username', '$status', '$jenis', '$tgl', '$keterangan', '$jumlah')";
		mysqli_query($connect, $input);

		echo "<script>alert('Data Berhasil Di Tambah'); 
               window.location = '../../media.php?module=keuangan'</script>";	    
	}

	// Update keuangan
	elseif ($module=='keuangan' AND $act=='update'){
		$id          = $_POST['id'];
		$username    = anti_injection($_POST['username']);
		$status      = anti_injection($_POST['status']);
		$jenis		 = anti_injection($_POST['jenis']); 
		$tgl		 = anti_injection($_POST['tgl']);
		$keterangan  = anti_injection($_POST['ktr']);
		$jumlah		 = anti_injection($_POST['jumlah']);



	    $update = "UPDATE keuangan SET username   = '$username',
	    							   status     = '$status',
			    					   jenis      = '$jenis',
			    					   tgl        = '$tgl',
			    					   keterangan = '$keterangan',
			    					   jumlah     = '$jumlah'
			                   WHERE id_keuangan  = '$id'";

		mysqli_query($connect, $update);	 
		echo "<script>alert('Data Berhasil Di Update'); 
                window.location = '../../media.php?module=keuangan'</script>";
	}

	// Delete keuangan
	elseif($module=='keuangan' AND $act=='delete'){
	    mysqli_query($connect, "DELETE FROM keuangan WHERE id_keuangan='$_GET[id]'");
    	echo "<script>alert('Data Berhasil Di Hapus'); 
                window.location = '../../media.php?module=keuangan'</script>";
	}
}
?>