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
    // Tampil Data
    default:
?>  
    <section class="content-header">
      <h1>
        Data Hutang
        <small>advanced tables</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data Hutang</li>
      </ol>
    </section>

    <section class="content">
    	<div class="box box-warning">
			<div class="box-body">
	          	<?php 
		            if (isset($_SESSION['namauser'])): 
			        ?>
		            <a href="?module=hutang&act=tambah" style="margin-bottom: 10px;" class="btn btn-md btn-success"> <i class="fa fa-plus"></i> Tambah Data</a>
	          	<?php endif; ?>

	        	<?php
	        		$query = "SELECT a.id_keuangan, b.id_staf, a.username, b.nama, sum(a.jumlah) as total
	        		          FROM keuangan a, staff b WHERE status = 'Hutang' OR status = 'Bayar' 
	        		          ORDER BY id_keuangan";
					$masuk = mysqli_query($connect, $query);

					$query1  = mysqli_fetch_array(mysqli_query($connect, "SELECT status , SUM(jumlah) AS denda_plus FROM keuangan WHERE status = 'Hutang'"));
					$query2 = mysqli_fetch_array(mysqli_query($connect, "SELECT status , SUM(jumlah) AS denda_min FROM keuangan WHERE status = 'Bayar'"));
					  
					$total      = $query1['denda_plus'] - $query2['denda_min'];
					$tanggungan = number_format($total,0,",",".");
	        	?>
	        	<div class="table-responsive">
		            <table class="table table-bordered table-striped table-hover" id="example1">
		              	<thead>
			                <tr>
			                  <th>NO</th>
			                  <th>PJ</th>
			                  <th>NAMA</th>
			                  <th>TANGGUNGAN</th> 
			                  <th>AKSI</th>
			                </tr>
		              	</thead>
		              	<tbody>
		                	<?php
			                $no = 1;
			                while ($r=mysqli_fetch_array($masuk)){
			                	$idr   = $r['total'];
								$total = number_format($idr,0,",",".");
			                ?>
		                	<tr>
			                  	<td><?php echo $no; ?></td>
			                  	<td><?php echo $r['username']?></td>
			                  	<td><?php echo $r['nama']?></td>
			                  	         
			                  	<td>Rp. <?php echo $tanggungan ?></td>
			                  	<td>
			                  		<a href="#myModal" class="btn btn-danger btn-sm" id="custId" data-toggle="modal" data-id="<?php echo $r['id_staf']?>"><i class="fa fa-eye"></i> Detail</a>
			                  	</td>
		                	</tr>
			                <?php
			                  $no++;
			                }
			                ?>
		              	</tbody>
		            </table>
	            </div>
		    </div>
	    </div>
      <!-- nav-tabs-custom -->
    </section>

    <?php
      break;
    ?>

    <!-- Tambah hutang -->
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
	            <li class="active">Data Hutang</li>
	        </ol>
        </section>
        <section class="content">
            <div class="row">
	            <div class="col-md-12">
	                <!-- general form elements disabled -->
	                <div class="box box-danger col-lg-12">
	                    <div class="box-body">
		                    <form role="form" method="post" enctype="multipart/form-data" <?php echo "action=\"$aksi?module=hutang&act=input\""; ?>>
		                    	<input type="hidden" name="username" value="<?php echo $_SESSION['namauser']; ?>">
		                    	<div class="form-group">
			                        <label>Nama Peminjam</label>
			                        <select class='form-control' name='id_staf' >
				                    	<?php
				                    		$staff = mysqli_query($connect, "SELECT * FROM staff");
											echo "<option>-- Please select --</option>";
											while($s = mysqli_fetch_array($staff)){
											    echo "<option value=\"".$s['id_staf']."\">".$s['nama']."</option>\n";
											}
				                    	?>
				                    </select>
				                </div>
			                    <div class="form-group">
			                        <label>Status</label>
			                        <select class='form-control' name='status' >
			                            <option value=''>-- Please select --</option>
			                            <option value='Hutang'>Hutang</option>
			                            <option value='Bayar'>Bayar</option>
			                        </select>
		                        </div>
			                    <div class="form-group">
			                        <label>Jenis Uang</label>
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
  }
}
?>  
  
