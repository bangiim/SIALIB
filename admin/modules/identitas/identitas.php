<?php
 // Apabila user belum login
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<script>window.alert('Untuk mengakses modul, Anda harus login dulu.');
        window.location = 'index.php'</script>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{

  $aksi = "modules/identitas/aksi_identitas.php";

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : '';
?>
    <section class="content-header">
      <h1>
        Data Website
        <small>advanced tables</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="?module=dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data Website</li>
      </ol>
    </section>
<?php
  switch($act){
    // Tampil Berita
    default:

    $query  = "SELECT * FROM identitas LIMIT 1";
    $tampil = mysqli_query($connect, $query);
    $r      = mysqli_fetch_array($tampil);
?>  


    <section class="content">
      <div class="box box-warning">
        <!-- /.box-header -->
        <div class="box-body">
          <?php 
            if (isset($_SESSION['namauser'])): 
          ?>
          
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="example1">
              <tr><td width="15%"><b>Nama Pemilik</b></td>     <td> : <?php echo $r['nama_pemilik'] ?></td></tr>
              <tr><td><b>Judul Website</b></td>    <td> : <?php echo $r['judul_website']  ?></td></tr>
              <tr><td><b>Alamat Website</b></td>   <td> : <?php echo $r['alamat_website'] ?></td></tr>
              <tr><td><b>Meta Deskripsi</b></td>   <td> : <?php echo $r['meta_deskripsi'] ?></td></tr>
              <tr><td><b>Meta Keyword</b></td>     <td> : <?php echo $r['meta_keyword'] ?></td></tr>
              <tr><td><b>Email</b></td>            <td> : <?php echo $r['email'] ?></td></tr>
              <p><a class="btn btn-success" href="?module=identitas&act=editidentitas&id=<?php echo $r['id_identitas']; ?>"><i class="fa fa-edit"></i> Edit</a></p>
            </table>
          </div>

          <?php endif; ?>
        </div>
      </div>
    </section>
    <?php
      break;
    ?>

    <!-- Edit Identitas -->
    <?php
    case "editidentitas":
      
      $query = "SELECT * FROM identitas WHERE id_identitas='$_GET[id]'";
      $hasil = mysqli_query($connect, $query);
      $r     = mysqli_fetch_array($hasil);

      if ($_SESSION['leveluser']=='admin'){
    ?> 
        
        <section class="content">
          <div class="row">
            <div class="col-md-12">
                <!-- general form elements disabled -->
                <div class="box box-info">
                  <div class="box-header">
                    <h3 class="box-title">Edit Identitas</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body">
                    <form role="form" method="post" <?php echo "action=\"$aksi?module=identitas&act=update\""; ?>>
                     <input type="hidden" name="id" value="<?php echo $r['id_identitas']; ?>">
                      <div class="form-group">
                        <label>Nama Pemilik</label>
                        <input type="text" class="form-control" name="nama_pemilik" placeholder="Nama Pemilik" value="<?php echo $r['nama_pemilik']; ?>"/>
                      </div>
                      <div class="form-group">
                        <label>Judul Website</label>
                        <input type="text" class="form-control" name="judul_website" placeholder="Judul Website" value="<?php echo $r['judul_website']; ?>"/>
                      </div>
                      <div class="form-group">
                        <label>Alamat Website</label>
                        <input type="text" class="form-control" name="alamat_website" placeholder="Alamat Website" value="<?php echo $r['alamat_website']; ?>"/>
                        
                        <p class="help-block">
                          *) Apabila website sudah di online-kan, ganti dengan nama domain website Anda<br>
                          *) Contoh: <b>http://muhammadibrahim.web.id</b>            
                        </p>
                      </div>
                      <div class="form-group">
                        <label>Meta Deskripsi</label>
                        <input type="text" class="form-control" name="meta_deskripsi" placeholder="Meta Deskripsi" value="<?php echo $r['meta_deskripsi']; ?>"/>
                      </div>
                      <div class="form-group">
                        <label>Meta Keyword</label>
                        <input type="text" class="form-control" name="meta_keyword" placeholder="Meta Keyword" value="<?php echo $r['meta_keyword']; ?>"/>
                      </div>
                      <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Email" value="<?php echo $r['email']; ?>"/>
                      </div>
                      
                      <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Simpan</button>
                      <button type="reset" class="btn btn-warning"> <i class="fa fa-trash"></i> Reset</button>
                      <button type="button" class="btn btn-danger" onclick="self.history.back()"><i class="fa fa-times"></i> Batal</button>
                    </form>
                  </div><!-- /.box-body -->
                </div><!-- /.box -->
              </div><!--/.col (right) -->
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
  
