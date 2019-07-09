<?php

include "../../../config/db.php";
 
//Beginning Buffer to save PHP variables and HTML tags
ob_start(); 

$query  = "SELECT * FROM keuangan ORDER BY tgl";
$tampil = mysqli_query($connect, $query);

//Query Subtotal
$total = "SELECT ROUND ( SUM(IF(status = 'Pemasukan', jumlah, 0))-(SUM(IF( status = 'Pengeluaran', jumlah, 0))) ) AS subtotal FROM keuangan";
$view = mysqli_query($connect, $total);
$r=mysqli_fetch_array($view);
$idr = $r['subtotal'];
$subtotal = number_format($idr,0,",",".");

//Query Total Masuk
$query = "SELECT status , SUM(jumlah) AS masuk FROM keuangan WHERE status = 'Pemasukan'";
$view = mysqli_query($connect, $query);
$r=mysqli_fetch_array($view);
$idr = $r['masuk'];
$total_masuk = number_format($idr,0,",",".");

//Query Total Keluar
$query = "SELECT status , SUM(jumlah) AS keluar FROM keuangan WHERE status = 'Pengeluaran'";
$view = mysqli_query($connect, $query);
$r=mysqli_fetch_array($view);
$idr = $r['keluar'];
$total_keluar = number_format($idr,0,",",".");
        
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Data Keuangan | Perpustakaan UNIDA Gontor</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../../dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
   	<section class="content">
	   	<div class="col-xs-12">
	      <img src="../../../dist/img/logounida.png" width="60" class="pull-left">
	      <h4 class="page-header">
	        &nbsp;&nbsp; PERPUSTAKAAN<br>
	        &nbsp;&nbsp; UNIVERSITAS DARUSSALAM GONTOR<br>
	        &nbsp;&nbsp; <font size="4">Jl. Raya Siman Km. 6 Demangan, Siman, Ponorogo</font>
	      </h4>
	    </div>
	    <br>
	    <div class="box-header">
	      <center>
	      	<h4 class="box-title">Data Keuangan Pemasukan dan Pengeluaran</h4>
	      </center>
	    </div>
     	<br>
      	<table class="table table-bordered table-striped">
	        <thead>
	          <tr>
	          	<th align="center">No</th>
	            <th align="center">Tanggal</th>
	            <th align="center">Status</th>
	            <th align="center">Jenis</th>
	            <th align="center">Keterangan</th>
	            <th align="center">Jumlah</th>
	          </tr>
	        </thead>
        	<tbody>
	        <?php
	          $no = 1;
	          while ($r=mysqli_fetch_array($tampil)){
	          		$jml = $r['jumlah'];
	          		$rp = number_format($jml,0,",",".");
	        ?>
	        	<tr>
		            <td align="center"><?php echo $no; ?></td>          
		            <td>&nbsp;<?php echo $r['tgl']?>&nbsp;</td>
		            <td>
		            	<?php
		            		if ($r['status']=='Pemasukan') {
		            			echo"<span class='badge bg-green'>$r[status]</span>";
		            		}
		            		else{
		            			echo"<span class='badge bg-yellow'>$r[status]</span>";
		            		}
		            	?>
		            </td>
		            <td>&nbsp;<?php echo $r['jenis']?>&nbsp;</td>
		            <td>&nbsp;<?php echo $r['keterangan']?>&nbsp;</td>
		            <td>&nbsp;Rp. <?php echo $rp ?>&nbsp;</td>                
	          	</tr>
	        <?php
	          $no++;
	          }
	        ?>
	       		 <tr>
                  <td align="center" colspan="5" ><b>Total Pemasukan</b></td>
                  <th>Rp. <?php echo $total_masuk; ?></th>
                </tr>
                <tr>
                  <td align="center" colspan="5" ><b>Total Pengeluaran</b></td>
                  <th>Rp. <?php echo $total_keluar; ?></th>
                </tr>
                <tr>
                  <td align="center" colspan="5" ><b>Subtotal</b></td>
                  <th>Rp. <?php echo $subtotal; ?></th>
                </tr>
        	</tbody>
      	</table>
    </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
