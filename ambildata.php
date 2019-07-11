 <?php
 require "config/db.php";

 if($_POST['rowid']) {
        $id = $_POST['rowid'];
        // mengambil data berdasarkan id
        $sql    = "SELECT * FROM skripsi WHERE  id = '$id'";
        $result = mysqli_query($connect, $sql);
        $baris  = mysqli_fetch_array($result); 
		
		if (!$result) {
		    printf("Error: %s\n", mysqli_error($connect));
		    exit();
		}
           echo" <embed src='pdffiles/$baris[filename]' type='application/pdf' width='100%' height='500px'/>";  
    }
 ?>
   