<?php
 // Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<script>window.alert('Untuk mengakses modul, Anda harus login dulu.');
        window.location = 'index.php'</script>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  $aksi = "modules/keuangan/aksi.php";

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : '';

  switch($act){
    // Tampil User
    default:

    // Query Total saldo //
    $total = "SELECT ROUND ( SUM(IF(status = 'Pemasukan', jumlah, 0))-(SUM(IF( status = 'Pengeluaran',
    		 jumlah, 0))) ) AS subtotal FROM keuangan";
    $view  = mysqli_query($connect, $total);
    $r     = mysqli_fetch_array($view);
    $idr   = $r['subtotal'];
    $for   = number_format($idr,0,",",".");
    //---------------------------------------
				  
?>  
    <section class="content-header">
      <h1>
        Data Keuangan
        <small>advanced tables</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data Keuangan</li>
      </ol>
    </section>

    <section class="content">
    	<!-- SISA SALDO -->
	    <div class="box box-danger">
	    	<div class="box-body bg-red">
	    		<center>
    				<h4>
    					<strong>SISA SALDO SAAT INI</strong><br>
    					<small style="color: white;">Pemasukan - Pengeluaran</small>
    				</h4>
    				<h1>
    					<b>Rp. <?php echo $for; ?></b>
    				</h1>
	    		</center>
	    	</div>
      	</div>
		<div class="box-body">
          	<?php 
	            if (isset($_SESSION['namauser'])): 
		        ?>
	            <a href="?module=keuangan&act=tambah" style="margin-bottom: 10px;" class="btn btn-md btn-warning "> <i class="fa fa-plus"></i> Tambah Data</a>
	            <a href="modules/keuangan/print_data.php" style="margin-bottom: 10px;" class="btn btn-md btn-primary "> <i class="fa fa-print" target="blank"></i> Print</a>
          	<?php endif; ?>

          	<div class="nav-tabs-custom ">
		        <ul class="nav nav-tabs pull-right">
		          	<li><a href="#tab_5" data-toggle="tab">Kartu</a></li>
		          	<li><a href="#tab_4" data-toggle="tab">Jurnal</a></li>
		          	<li><a href="#tab_3" data-toggle="tab">Buku</a></li>
		          	<li><a href="#tab_2" data-toggle="tab">Fotocopy</a></li>
		          	<li class="active"><a href="#tab_1" data-toggle="tab">Denda</a></li>
		          	<li class="pull-left header"><i class="fa fa-money"></i> <b>Total Uang</b></li>
		        </ul>
		        <div class="tab-content">
		        	<!-- Denda -->
			        <div class="tab-pane active" id="tab_1">
			        	<?php
			        		$query = "SELECT * FROM keuangan WHERE jenis='Denda' ORDER BY id_keuangan";
   							$masuk = mysqli_query($connect, $query);

   							$query1  = mysqli_fetch_array(mysqli_query($connect, "SELECT status , SUM(jumlah) AS denda_plus FROM keuangan WHERE status = 'Pemasukan' and jenis = 'Denda'"));
				            $query2 = mysqli_fetch_array(mysqli_query($connect, "SELECT status , SUM(jumlah) AS denda_min FROM keuangan WHERE status = 'Pengeluaran' and jenis = 'Denda'"));
				            $query3 = mysqli_fetch_array(mysqli_query($connect, "SELECT status , SUM(jumlah) AS hutang FROM keuangan WHERE status = 'Hutang' and jenis = 'Denda'"));
				            $query4 = mysqli_fetch_array(mysqli_query($connect, "SELECT status , SUM(jumlah) AS bayar FROM keuangan WHERE status = 'Bayar' and jenis = 'Denda'"));

				            $total = $query1['denda_plus'] - $query2['denda_min'] - $query3['hutang'] + $query4['bayar'];
				            $for = number_format($total,0,",",".");
			        	?>
			        	<div class="table-responsive">
				            <table class="table table-bordered table-striped table-hover" id="example1">
				              	<thead>
					                <tr>
					                  <th>NO</th>
					                  <th>PJ</th>
					                  <th>STATUS</th>
					                  <th>TANGGAL</th>
					                  <th>KETERANGAN</th>
					                  <th>JUMLAH</th> 
					                  <th>AKSI</th>
					                </tr>
				              	</thead>
				              	<tbody>
				                	<?php
					                $no = 1;
					                while ($r=mysqli_fetch_array($masuk)){
					                	$idr       = $r['jumlah'];
	    								$masuk_for = number_format($idr,0,",",".");
	    								$date      = tgl_indo($r['tgl']);

	    								if ($r['status']!='Hutang' AND $r['status']!='Bayar') {
				                		?>
				                		<tr>
						                  	<td><?php echo $no; ?></td>
						                  	<td><?php echo $r['username']?></td>
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
						                  	<td><?php echo $date ?></td>
						                  	<td><?php echo $r['keterangan']?></td>
						                  	<td>Rp. <?php echo $masuk_for ?></td>
						                  	<td>
							                    <a class="btn btn-success" href="?module=keuangan&act=edit&id=<?php echo $r['id_keuangan']; ?>"><i class="fa fa-edit"></i></a>
							                    <a class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" <?php echo "href=\"$aksi?module=keuangan&act=delete&id=$r[id_keuangan]\""; ?>><i class="fa fa-trash"></i></a>
						                  	</td>
					                	</tr>
					                	<?php
				                		}
					                 $no++;
					                }
					                ?>
				              	</tbody>
				              	<tfoot>
					              	<tr>
					                  <td align="center" colspan="7" >
					                  	<h2>
					                  		<small>Saldo: </small>
					                  		Rp. <?php echo $for; ?>
					                  	</h2>
					                  	
					                  </td>
					                </tr>
				              	</tfoot>
				            </table>
			            </div>
			        </div>
			        <!-- Fotocopy -->
			        <div class="tab-pane" id="tab_2">
			        	<?php
			        		$query = "SELECT * FROM keuangan WHERE jenis='Fotocopy' ORDER BY id_keuangan";
   							$masuk = mysqli_query($connect, $query);

   							$query1  = mysqli_fetch_array(mysqli_query($connect, "SELECT status , SUM(jumlah) AS fc_plus FROM keuangan WHERE status = 'Pemasukan' and jenis = 'Fotocopy'"));
				            $query2 = mysqli_fetch_array(mysqli_query($connect, "SELECT status , SUM(jumlah) AS fc_min FROM keuangan WHERE status = 'Pengeluaran' and jenis = 'Fotocopy'"));
				            $query3 = mysqli_fetch_array(mysqli_query($connect, "SELECT status , SUM(jumlah) AS hutang FROM keuangan WHERE status = 'Hutang' and jenis = 'Fotocopy'"));
				            $query4 = mysqli_fetch_array(mysqli_query($connect, "SELECT status , SUM(jumlah) AS bayar FROM keuangan WHERE status = 'Bayar' and jenis = 'Fotocopy'"));
				              
				            $total = $query1['fc_plus'] - $query2['fc_min'] - $query3['hutang'] + $query4['bayar'];
				            $for = number_format($total,0,",",".");
			        	?>
			        	<div class="table-responsive">
				            <table class="table table-bordered table-striped table-hover" id="example11">
				              	<thead>
					                <tr>
					                  <th>NO</th>
					                  <th>PJ</th>
					                  <th>STATUS</th>
					                  <th>TANGGAL</th>
					                  <th>KETERANGAN</th>
					                  <th>JUMLAH</th> 
					                  <th>AKSI</th>
					                </tr>
				              	</thead>
				              	<tbody>
				                	<?php
					                $no = 1;
					                while ($r=mysqli_fetch_array($masuk)){
					                	$idr       = $r['jumlah'];
	    								$masuk_for = number_format($idr,0,",",".");
	    								$date      = tgl_indo($r['tgl']);

	    								if ($r['status']!='Hutang' AND $r['status']!='Bayar') {
				                		?>
				                		<tr>
						                  	<td><?php echo $no; ?></td>
						                  	<td><?php echo $r['username']?></td>
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
						                  	<td><?php echo $date ?></td>
						                  	<td><?php echo $r['keterangan']?></td>
						                  	<td>Rp. <?php echo $masuk_for ?></td>
						                  	<td>
							                    <a class="btn btn-success" href="?module=keuangan&act=edit&id=<?php echo $r['id_keuangan']; ?>"><i class="fa fa-edit"></i></a>
							                    <a class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" <?php echo "href=\"$aksi?module=keuangan&act=delete&id=$r[id_keuangan]\""; ?>><i class="fa fa-trash"></i></a>
						                  	</td>
					                	</tr>
					                	<?php
				                		}
					                 $no++;
					                }
					                ?>
				              	</tbody>
				              	<tfoot>
					              	<tr>
					                  <td align="center" colspan="7" >
					                  	<h2>
					                  		<small>Saldo: </small>
					                  		Rp. <?php echo $for; ?>
					                  	</h2>
					                  	
					                  </td>
					                </tr>
				              	</tfoot>
				            </table>
			            </div>
			        </div>
			        <!-- Buku -->
			        <div class="tab-pane" id="tab_3">
			        	<?php
			        		$query = "SELECT * FROM keuangan WHERE jenis='Buku' ORDER BY id_keuangan";
   							$masuk = mysqli_query($connect, $query);

   							$query1  = mysqli_fetch_array(mysqli_query($connect, "SELECT status , SUM(jumlah) AS buku_plus FROM keuangan WHERE status = 'Pemasukan' and jenis = 'Buku'"));
				            $query2 = mysqli_fetch_array(mysqli_query($connect, "SELECT status , SUM(jumlah) AS buku_min FROM keuangan WHERE status = 'Pengeluaran' and jenis = 'Buku'"));
				            $query3 = mysqli_fetch_array(mysqli_query($connect, "SELECT status , SUM(jumlah) AS hutang FROM keuangan WHERE status = 'Hutang' and jenis = 'Buku'"));
				            $query4 = mysqli_fetch_array(mysqli_query($connect, "SELECT status , SUM(jumlah) AS bayar FROM keuangan WHERE status = 'Bayar' and jenis = 'Buku'"));
				              
				            $total = $query1['buku_plus'] - $query2['buku_min'] - $query3['hutang'] + $query4['bayar'];
				            $for = number_format($total,0,",",".");
			        	?>
			        	<div class="table-responsive">
				            <table class="table table-bordered table-striped table-hover" id="example12">
				              	<thead>
					                <tr>
					                  <th>NO</th>
					                  <th>PJ</th>
					                  <th>STATUS</th>
					                  <th>TANGGAL</th>
					                  <th>KETERANGAN</th>
					                  <th>JUMLAH</th> 
					                  <th>AKSI</th>
					                </tr>
				              	</thead>
				              	<tbody>
				                	<?php
					                $no = 1;
					                while ($r=mysqli_fetch_array($masuk)){
					                	$idr       = $r['jumlah'];
	    								$masuk_for = number_format($idr,0,",",".");
	    								$date      = tgl_indo($r['tgl']);

	    								if ($r['status']!='Hutang' AND $r['status']!='Bayar') {
				                		?>
				                		<tr>
						                  	<td><?php echo $no; ?></td>
						                  	<td><?php echo $r['username']?></td>
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
						                  	<td><?php echo $date ?></td>
						                  	<td><?php echo $r['keterangan']?></td>
						                  	<td>Rp. <?php echo $masuk_for ?></td>
						                  	<td>
							                    <a class="btn btn-success" href="?module=keuangan&act=edit&id=<?php echo $r['id_keuangan']; ?>"><i class="fa fa-edit"></i></a>
							                    <a class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" <?php echo "href=\"$aksi?module=keuangan&act=delete&id=$r[id_keuangan]\""; ?>><i class="fa fa-trash"></i></a>
						                  	</td>
					                	</tr>
					                	<?php
				                		}
					                 $no++;
					                }
					                ?>
				              	</tbody>
				              	<tfoot>
					              	<tr>
					                  <td align="center" colspan="7" >
					                  	<h2>
					                  		<small>Saldo: </small>
					                  		Rp. <?php echo $for; ?>
					                  	</h2>
					                  	
					                  </td>
					                </tr>
				              	</tfoot>
				            </table>
			            </div>
			        </div>
			        <!-- Jurnal -->
			        <div class="tab-pane" id="tab_4">
			        	<?php
			        		$query = "SELECT * FROM keuangan WHERE jenis='Jurnal' ORDER BY id_keuangan";
   							$masuk = mysqli_query($connect, $query);

   							$query1  = mysqli_fetch_array(mysqli_query($connect, "SELECT status , SUM(jumlah) AS jr_plus FROM keuangan WHERE status = 'Pemasukan' and jenis = 'Jurnal'"));
				            $query2 = mysqli_fetch_array(mysqli_query($connect, "SELECT status , SUM(jumlah) AS jr_min FROM keuangan WHERE status = 'Pengeluaran' and jenis = 'Jurnal'"));
				            $query3 = mysqli_fetch_array(mysqli_query($connect, "SELECT status , SUM(jumlah) AS hutang FROM keuangan WHERE status = 'Hutang' and jenis = 'Jurnal'"));
				            $query4 = mysqli_fetch_array(mysqli_query($connect, "SELECT status , SUM(jumlah) AS bayar FROM keuangan WHERE status = 'Bayar' and jenis = 'Jurnal'"));
				              
				            $total = $query1['jr_plus'] - $query2['jr_min'] - $query3['hutang'] + $query4['bayar'];
				            $for = number_format($total,0,",",".");
			        	?>
			        	<div class="table-responsive">
				            <table class="table table-bordered table-striped table-hover" id="example13">
				              	<thead>
					                <tr>
					                  <th>NO</th>
					                  <th>PJ</th>
					                  <th>STATUS</th>
					                  <th>TANGGAL</th>
					                  <th>KETERANGAN</th>
					                  <th>JUMLAH</th> 
					                  <th>AKSI</th>
					                </tr>
				              	</thead>
				              	<tbody>
				                	<?php
					                $no = 1;
					                while ($r=mysqli_fetch_array($masuk)){
					                	$idr       = $r['jumlah'];
	    								$masuk_for = number_format($idr,0,",",".");
	    								$date      = tgl_indo($r['tgl']);
					                ?>
				                	<tr>
					                  	<td><?php echo $no; ?></td>
					                  	<td><?php echo $r['username']?></td>
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
					                  	<td><?php echo $date ?></td>
					                  	<td><?php echo $r['keterangan']?></td>
					                  	<td>Rp. <?php echo $masuk_for ?></td>
					                  	<td>
						                    <a class="btn btn-success" href="?module=keuangan&act=edit&id=<?php echo $r['id_keuangan']; ?>"><i class="fa fa-edit"></i></a>
						                    <a class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" <?php echo "href=\"$aksi?module=keuangan&act=delete&id=$r[id_keuangan]\""; ?>><i class="fa fa-trash"></i></a>
					                  	</td>
				                	</tr>
					                <?php
					                  $no++;
					                }
					                ?>
				              	</tbody>
				              	<tfoot>
					              	<tr>
					                  <td align="center" colspan="7" >
					                  	<h2>
					                  		<small>Saldo: </small>
					                  		Rp. <?php echo $for; ?>
					                  	</h2>
					                  	
					                  </td>
					                </tr>
				              	</tfoot>
				            </table>
			            </div>
			        </div>
			        <!-- Kartu -->
			        <div class="tab-pane" id="tab_5">
			        	<?php
			        		$query = "SELECT * FROM keuangan WHERE jenis='Kartu' ORDER BY id_keuangan";
   							$masuk = mysqli_query($connect, $query);

   							$query1  = mysqli_fetch_array(mysqli_query($connect, "SELECT status , SUM(jumlah) AS kta_plus FROM keuangan WHERE status = 'Pemasukan' and jenis = 'Kartu'"));
				            $query2 = mysqli_fetch_array(mysqli_query($connect, "SELECT status , SUM(jumlah) AS kta_min FROM keuangan WHERE status = 'Pengeluaran' and jenis = 'Kartu'"));
				            $query3 = mysqli_fetch_array(mysqli_query($connect, "SELECT status , SUM(jumlah) AS hutang FROM keuangan WHERE status = 'Hutang' and jenis = 'Kartu'"));
				            $query4 = mysqli_fetch_array(mysqli_query($connect, "SELECT status , SUM(jumlah) AS bayar FROM keuangan WHERE status = 'Bayar' and jenis = 'Kartu'"));
				              
				            $total = $query1['kta_plus'] - $query2['kta_min'] - $query3['hutang'] + $query4['bayar'];
				            $for = number_format($total,0,",",".");
			        	?>
			        	<div class="table-responsive">
				            <table class="table table-bordered table-striped table-hover" id="example14">
				              	<thead>
					                <tr>
					                  <th>NO</th>
					                  <th>PJ</th>
					                  <th>STATUS</th>
					                  <th>TANGGAL</th>
					                  <th>KETERANGAN</th>
					                  <th>JUMLAH</th> 
					                  <th>AKSI</th>
					                </tr>
				              	</thead>
				              	<tbody>
				                	<?php
					                $no = 1;
					                while ($r=mysqli_fetch_array($masuk)){
					                	$idr       = $r['jumlah'];
	    								$masuk_for = number_format($idr,0,",",".");
	    								$date      = tgl_indo($r['tgl']);

	    								if ($r['status']!='Hutang' AND $r['status']!='Bayar') {
				                		?>
				                		<tr>
						                  	<td><?php echo $no; ?></td>
						                  	<td><?php echo $r['username']?></td>
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
						                  	<td><?php echo $date ?></td>
						                  	<td><?php echo $r['keterangan']?></td>
						                  	<td>Rp. <?php echo $masuk_for ?></td>
						                  	<td>
							                    <a class="btn btn-success" href="?module=keuangan&act=edit&id=<?php echo $r['id_keuangan']; ?>"><i class="fa fa-edit"></i></a>
							                    <a class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" <?php echo "href=\"$aksi?module=keuangan&act=delete&id=$r[id_keuangan]\""; ?>><i class="fa fa-trash"></i></a>
						                  	</td>
					                	</tr>
					                	<?php
				                		}
					                 $no++;
					                }
					                ?>
				              	</tbody>
				              	<tfoot>
					              	<tr>
					                  <td align="center" colspan="7" >
					                  	<h2>
					                  		<small>Saldo: </small>
					                  		Rp. <?php echo $for; ?>
					                  	</h2>
					                  	
					                  </td>
					                </tr>
				              	</tfoot>
				            </table>
			            </div>
			        </div>
		        </div>
		        <!-- /.tab-content -->
        	</div>
        </div>
      <!-- nav-tabs-custom -->
    </section>

    <?php
      break;
    ?>

    <!-- Tambah keuangan -->
    <?php
    case "tambah":
      if ($_SESSION['leveluser']=='admin' or $_SESSION['leveluser']=='user'){
      ?>
        <section class="content-header">
          	<h1>
	            Tambah Data
	            <small>advanced tables</small>
          	</h1>
	        <ol class="breadcrumb">
	            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	            <li><a href="#">Tables</a></li>
	            <li class="active">Data Keuangan</li>
	        </ol>
        </section>
        <section class="content">
            <div class="row">
	            <div class="col-md-12">
	                <!-- general form elements disabled -->
	                <div class="box box-danger col-lg-12">
	                    <div class="box-body">
		                    <form role="form" method="post" enctype="multipart/form-data" <?php echo "action=\"$aksi?module=keuangan&act=input\""; ?>>
		                    	<input type="hidden" name="username" value="<?php echo $_SESSION['namauser']; ?>">
			                    <div class="form-group">
			                        <label>Status</label>
			                        <select class='form-control' name='status' >
			                            <option value=''>-- Please select --</option>
			                            <option value='Pemasukan'>Pemasukan</option>
			                            <option value='pengeluaran'>Pengeluaran</option>
			                        </select>
		                        </div>
			                    <div class="form-group">
			                        <label>Jenis</label>
			                        <select class='form-control' name='jenis' >
			                            <option value=''>-- Please select --</option>
			                            <option value='Denda'>Denda</option>
			                            <option value='Fotocopy'>Fotocopy</option>
			                            <option value='Kartu'>Kartu</option>
			                            <option value='Jurnal'>Jurnal</option>
			                            <option value='Buku'>Buku</option>
			                        </select>
			                    </div>
		                        <div class="form-group">
		                            <label>Tanggal</label>
		                            <div class="input-group date">
		                              <div class="input-group-addon">
		                                <i class="fa fa-calendar"></i>
		                              </div>
		                              <input type="text" class="form-control pull-right" id="datepicker" name="tgl">
			                        </div>
	                            </div>
			                    <div class="form-group">
			                        <label>Keterangan</label>
			                        <input type="text" class="form-control" name="ktr" value=""/>
			                    </div>
		                        <div class="form-group">
		                      		<label>Jumlah</label>
			                      	<div class="input-group">
				                        <span class="input-group-addon">Rp.</span>
				                		<input type="number" class="form-control" name="jumlah">
			                        </div>
			                    </div>

			                    <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Simpan</button>
			                    <button type="reset" class="btn btn-warning"> <i class="fa fa-trash"></i> Reset</button>
			                    <button type="button" class="btn btn-danger" onclick="self.history.back()"><i class="fa fa-times"></i> Batal</button>
		                    </form>
	                    </div>
	                    <!-- /.box-body -->
	                </div
	                ><!-- /.box -->
	            </div>
	            <!--/.col (right) -->
            </div>
        </section>
      <?php
      }
      else{
        echo "Anda tidak berhak mengakses halaman ini.";
      }
    break;
    ?>

    <!-- Edit keuangan -->
    <?php
    case "edit":
      
      $query = "SELECT * FROM keuangan WHERE id_keuangan='$_GET[id]'";
      $hasil = mysqli_query($connect, $query);
      $r     = mysqli_fetch_array($hasil);
     
      if ($_SESSION['leveluser']=='admin' or $_SESSION['leveluser']=='user'){
    ?> 
        <section class="content-header">
          <h1>
            Edit Data
            <small>advanced tables</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data Keuangann</li>
          </ol>
        </section>
        <section class="content">
            <div class="row">
	            <div class="col-md-12">
	                <!-- general form elements disabled -->
	                <div class="box box-danger col-lg-12">
	                    <div class="box-body">
		                    <form role="form" method="post" enctype="multipart/form-data" <?php echo "action=\"$aksi?module=keuangan&act=update\""; ?>>
		                    	<input type="hidden" name="id" value="<?php echo $r['id_keuangan']; ?>">
		                    	<input type="hidden" name="username" value="<?php echo $_SESSION['namauser']; ?>">
			                    <div class="form-group">
			                        <label>Status</label>
			                        <input type="text" class="form-control" name="status" value="<?php echo $r['status']; ?>" readonly="readonly"/>
		                        </div>
			                    <div class="form-group">
			                        <label>Jenis</label>
			                        <input type="text" class="form-control" name="jenis" value="<?php echo $r['jenis']; ?>" readonly="readonly"/>
			                    </div>
			                    <div class="form-group">
		                            <label>Tanggal</label>
		                            <div class="input-group date">
		                              <div class="input-group-addon">
		                                <i class="fa fa-calendar"></i>
		                              </div>
		                              <input type="text" class="form-control pull-right" id="datepicker" name="tgl" value="<?php echo $r['tgl']; ?>">
			                        </div>
	                            </div>
			                    <div class="form-group">
			                        <label>Keterangan</label>
			                        <input type="text" class="form-control" name="ktr" value="<?php echo $r['keterangan']; ?>"/>
			                    </div>
		                        <div class="form-group">
		                      		<label>Jumlah</label>
			                      	<div class="input-group">
				                        <span class="input-group-addon">Rp</span>
				                		<input type="number" class="form-control" name="jumlah" value="<?php echo $r['jumlah']; ?>">
			                        </div>
			                    </div>

			                    <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Update</button>
			                    <button type="reset" class="btn btn-warning"> <i class="fa fa-trash"></i> Reset</button>
			                    <button type="button" class="btn btn-danger" onclick="self.history.back()"><i class="fa fa-times"></i> Batal</button>
		                    </form>
	                    </div>
	                    <!-- /.box-body -->
	                </div
	                ><!-- /.box -->
	            </div>
	            <!--/.col (right) -->
            </div>
        </section>
    <?php
      }
      else{
        echo "Anda tidak berhak mengakses halaman ini.";
      }
    break;
  }
}
?>  
  
