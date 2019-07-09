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
    <!-- DataTables -->
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
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
                        <li><a href="index.php">Upload <span class="sr-only">(current)</span></a></li>
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
                        DATA UPLOAD SKRIPSI DAN TESIS &nbsp;
                        <small>Universitas Darussalam Gontor</small>
                      </h3>
                      <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Page</a></li>
                        <li class="active">Data Skripsi Dan Tesis</li>
                      </ol>
                    </div>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- general form elements -->
                        <div class="box box-warning">
                            <section class="content">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover" id="example1">
                                                  <thead>
                                                    <tr>
                                                      <th>NO</th>
                                                      <th>PENULIS</th>
                                                      <th>JUDUL</th>
                                                      <th>TAHUN</th> 
                                                      <th>PRODI</th>
                                                      <th>AKSI</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    <?php
                                                    require_once('config/db.php');
                                                    $query  = "SELECT * FROM skripsi ORDER BY author";
                                                    $tampil = mysqli_query($connect, $query);
                                                    $no = 1;
                                                    while ($r=mysqli_fetch_array($tampil)){
                                                    ?>
                                                    <tr>
                                                      <td><?php echo $no; ?></td>          
                                                      <td><?php echo $r['author']?></td>
                                                      <td><?php echo $r['title']?></td>
                                                      <td><?php echo $r['year']?></td>
                                                      <td><?php echo $r['prodi']?></td>
                                                      <td>
                                                        <a class="btn btn-success" href="#"><i class="fa fa-eye"></i></a>
                                                        
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
                                        <!-- /.box-body -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </section>
                        </div>
                        <!-- /.box -->
                    </div>
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
    <!-- DataTables -->
    <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- page script -->
    <script>
        $(function() {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            })
        })
    </script>
</body>
</html>