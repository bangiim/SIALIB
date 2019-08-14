<?php
 // Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<script>window.alert('Untuk mengakses modul, Anda harus login dulu.');
        window.location = 'index.php'</script>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  $aksi = "modules/staff/aksi.php";

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : '';

  switch($act){
    // Tampil Staff
    default:

    $query  = "SELECT * FROM staff ORDER BY nim";
    $tampil = mysqli_query($connect, $query);
?>  
    <section class="content-header">
      <h1>
        Data Staff
        <small>advanced tables</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data Staff</li>
      </ol>
    </section>

    <section class="content">
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Jumlah Data, <?php echo mysqli_num_rows($tampil); ?> Data</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <?php 
            if (isset($_SESSION['namauser'])): 
          ?>
            <a href="?module=staff&act=tambahdata" style="margin-bottom: 10px;" class="btn btn-md btn-primary"> <i class="fa fa-plus"></i> Tambah Data</a>
          <?php endif; ?>
      
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="example1">
              <thead>
                <tr>
                  <th>NO</th>
                  <th>NIM</th>
                  <th>NAMA</th>
                  <th>FAKULTAS</th>
                  <th>PRODI</th> 
                  <th>AKSI</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                while ($r=mysqli_fetch_array($tampil)){
                ?>
                <tr>
                  <td><?php echo $no; ?></td>          
                  <td><?php echo $r['nim']?></td>
                  <td><?php echo $r['nama']?></td>
                  <td><?php echo $r['fakultas']?></td>
                  <td><?php echo $r['prodi']?></td>
                  <td>
                    <a class="btn btn-success" href="?module=staff&act=editdata&id=<?php echo $r['id_staf']; ?>"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" <?php echo "href=\"$aksi?module=staff&act=delete&id=$r[id_staf]\""; ?>><i class="fa fa-trash"></i></a>
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
    </section>
    <?php
    break;
    ?>

    <!-- Tambah Data -->
    <?php
    case "tambahdata":
      if ($_SESSION['leveluser']=='admin'){
      ?>
        <section class="content-header">
          <h1>
            Tambah Data
            <small>advanced tables</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data Staff</li>
          </ol>
        </section>
        <section class="content">
          <div class="row">
            <div class="col-md-12">
                <!-- general form elements disabled -->
                <div class="box box-danger">
                  <div class="box-header">
                    <h3 class="box-title">Tambah Staff</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body">
                    <form role="form" method="post" enctype="multipart/form-data" <?php echo "action=\"$aksi?module=staff&act=input\""; ?>>
                      <div class="form-group">
                        <label>NIM</label>
                        <input type="text" class="form-control" name="nim" value=""/>
                      </div>
                      <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" value=""/>
                      </div>
                      <!-- fakultas -->
                      <div class="form-group">
                        <label class="control-label">Fakultas</label>
                          <select name="fakultas" class="form-control">
                            <option>-- Please select --</option>
                            <option value="Ushuluddin">Ushuluddin</option>
                            <option value="Tarbiyah">Tarbiyah</option>
                            <option value="Shariah">Shariah</option>
                            <option value="FEM">FEM</option>
                            <option value="Humaniora">Humaniora</option>
                            <option value="Tarbiyah">Tarbiyah</option>
                            <option value="Saintek">Saintek</option>
                            <option value="Kesehatan">Kesehatan</option>
                          </select>
                      </div>
                      <!-- prodi -->
                      <div class="form-group">
                        <label class="control-label">Prodi</label>
                          <select name="prodi" class="form-control">
                            <option>-- Please select --</option>
                            <option value="Pendidikan Agama Islam">Pendidikan Agama Islam</option>
                            <option value="Pendidikan Bahasa Arab">Pendidikan Bahasa Arab</option>
                            <option value="Aqidah Filsafat Islam">Aqidah Filsafat Islam</option>
                            <option value="Studi Agama - Agama">Studi Agama - Agama</option>
                            <option value="Ilmu Quran dan Tafsir">Ilmu Quran dan Tafsir</option>
                            <option value="Perbandingan Mazhab dan Hukum">Perbandingan Mazhab dan Hukum</option>
                            <option value="Hukum Ekonomi Syariah">Hukum Ekonomi Syariah</option>
                            <option value="Teknik Informatika">Teknik Informatika</option>
                            <option value="Teknologi Industri Pertanian">Teknologi Industri Pertanian</option>
                            <option value="Agro Teknologi">Agro Teknologi</option>
                            <option value="Hubungan Internasional">Hubungan Internasional</option>
                            <option value="Ilmu Komunikasi">Ilmu Komunikasi</option>
                            <option value="Farmasi">Farmasi</option>
                            <option value="Nutrition">Nutrition</option>
                            <option value="Keselamatan dan Kesehatan Kerj">Keselamatan dan Kesehatan Kerja</option>
                            <option value="Ekonomi Islam">Ekonomi Islam</option>
                            <option value="Manajemen Bisnis">Manajemen Bisnis</option>
                          </select>
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
    ?>

    <!-- Edit Data -->
    <?php
    case "editdata":
      
      $query = "SELECT * FROM staff WHERE id_staf='$_GET[id]'";
      $hasil = mysqli_query($connect, $query);
      $r     = mysqli_fetch_array($hasil);
     
      if ($_SESSION['leveluser']=='admin'){
    ?> 
        <section class="content-header">
          <h1>
            Edit Data
            <small>advanced tables</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data Staff</li>
          </ol>
        </section>
        <section class="content">
          <div class="row">
            <div class="col-md-12">
                <!-- general form elements disabled -->
                <div class="box box-warning">
                  <div class="box-header">
                    <h3 class="box-title">Edit Staff</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body">
                    <form role="form" method="post" enctype="multipart/form-data" <?php echo "action=\"$aksi?module=staff&act=update\""; ?>>
                    
                      <!-- text input -->
                      <input type="hidden" name="id" value="<?php echo $r['id_staf']; ?>">
                      <div class="form-group">
                        <label>NIM</label>
                        <input type="text" class="form-control" name="nim" value="<?php echo $r['nim'] ?>" readonly="readonly">
                      </div>
                      <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" value="<?php echo $r['nama'] ?>"/>
                      </div>
                      <!-- fakultas -->
                      <div class="form-group">
                        <label class="control-label">Fakultas</label>
                          <select name="fakultas" class="form-control">
                            <?php 
                            echo "
                              <option value='$r[fakultas]'>
                                -- $r[fakultas] ?> --
                              </option>";
                            ?>
                            <option value="Ushuluddin">Ushuluddin</option>
                            <option value="Tarbiyah">Tarbiyah</option>
                            <option value="Shariah">Shariah</option>
                            <option value="FEM">FEM</option>
                            <option value="Humaniora">Humaniora</option>
                            <option value="Tarbiyah">Tarbiyah</option>
                            <option value="Saintek">Saintek</option>
                            <option value="Kesehatan">Kesehatan</option>
                          </select>
                      </div>
                      <!-- prodi -->
                      <div class="form-group">
                        <label class="control-label">Prodi</label>
                          <select name="prodi" class="form-control">
                            <?php 
                            echo "
                              <option value='$r[prodi]'>
                                -- $r[prodi] ?> --
                              </option>";
                            ?>
                            <option value="Pendidikan Agama Islam">Pendidikan Agama Islam</option>
                            <option value="Pendidikan Bahasa Arab">Pendidikan Bahasa Arab</option>
                            <option value="Aqidah Filsafat Islam">Aqidah Filsafat Islam</option>
                            <option value="Studi Agama - Agama">Studi Agama - Agama</option>
                            <option value="Ilmu Quran dan Tafsir">Ilmu Quran dan Tafsir</option>
                            <option value="Perbandingan Mazhab dan Hukum">Perbandingan Mazhab dan Hukum</option>
                            <option value="Hukum Ekonomi Syariah">Hukum Ekonomi Syariah</option>
                            <option value="Teknik Informatika">Teknik Informatika</option>
                            <option value="Teknologi Industri Pertanian">Teknologi Industri Pertanian</option>
                            <option value="Agro Teknologi">Agro Teknologi</option>
                            <option value="Hubungan Internasional">Hubungan Internasional</option>
                            <option value="Ilmu Komunikasi">Ilmu Komunikasi</option>
                            <option value="Farmasi">Farmasi</option>
                            <option value="Nutrition">Nutrition</option>
                            <option value="Keselamatan dan Kesehatan Kerj">Keselamatan dan Kesehatan Kerja</option>
                            <option value="Ekonomi Islam">Ekonomi Islam</option>
                            <option value="Manajemen Bisnis">Manajemen Bisnis</option>
                          </select>
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
  
