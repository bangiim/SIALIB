<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Perpustakaan UNIDA Gontor</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="../../index2.html" class="navbar-brand"><b>Perpustakaan</b> UNIDA Gontor</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="#">Upload <span class="sr-only">(current)</span></a></li>
            <li><a href="list.php">List</a></li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->

        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Log-In -->
            <li class="dropdown messages-menu">
              <!-- Menu toggle button -->
              <a href="admin" class="dropdown-toggle" >
                <i class="glyphicon glyphicon-log-in"></i>
                <span class="label label-warning">Log-in</span>
              </a>
            </li>
            <!-- /.Log-In-menu -->
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->

      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="row">
          <h3>
            FORMULIR UPLOAD SKRIPSI DAN TESIS &nbsp;
            <small>Universitas Darussalam Gontor</small>
          </h3>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Page</a></li>
            <li class="active">Upload Skripsi Dan Tesis</li>
          </ol>
        </div>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <!-- general form elements -->
          <div class="box box-warning col-lg-12">
            <!-- form start -->
            <form enctype="multipart/form-data" method="POST" action="action.php">
              <div class="box-body">
                <div class="form-group">
                  <label for="judul">NIM</label>
                  <input type="text" class="form-control" name="nim" placeholder="NIM" required>
                </div> 
                <div class="form-group">
                  <label for="judul">Judul</label>
                  <input type="text" class="form-control" name="title" placeholder="judul" required>
                </div>  
                <div class="form-group">
                  <label for="penyusun">Penyusun</label>
                  <input type="text" class="form-control" name="author" placeholder="Penyusun" required>
                </div>
                <div class="form-group">
                  <label for="abstrak">Abstarak</label>
                  <textarea class="form-control" name="abstract" row="5" placeholder="Abstrak" required></textarea>
                </div>
                <div class="form-group">
                  <label class="control-label">Kategori</label>
                  <select name="category" class="form-control">
                    <option value="Skripsi">Skripsi</option>
                    <option value="Thesis">Thesis</option>
                  </select>
                </div>
                <!-- tahun -->
                <div class="form-group">
                  <label class="control-label">Tahun</label>
                  <select name="year" class="form-control">
                    <option>-- Please select --</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                  </select>
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
                <div class="form-group">
                  <label for="file">File input</label>
                  <input type="file" name="file">
                  <p class="help-block">Upload file berbentuk pdf</p>
                </div>
                <div class="box-footer">
                  <button type="submit" class="btn btn-primary" name="upload">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
          <!-- /.box -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2019 <a href="https://192.168.25.212/opac">UNIDA Gontor Library </a>.</strong> All rights reserved.
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
