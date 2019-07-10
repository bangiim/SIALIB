<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Dashboard
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <!-- ROW 1-->
  <div class="row">
    <div class="col-lg-4 col-xs-12">
      <!-- box SALDO -->
      <div class="small-box bg-red">
        <div class="inner">
          <?php 
            $query = "SELECT ROUND ( SUM(IF(status = 'Pemasukan', jumlah, 0))-(SUM(IF( status = 'Pengeluaran', jumlah, 0))) ) AS subtotal FROM keuangan";
            $view = mysqli_query($connect, $query);
            $r=mysqli_fetch_array($view);
            $idr = $r['subtotal'];
            $for = number_format($idr,0,",",".");
          ?>
          <p>Saldo</p>
          <h3>Rp. <?php echo $for; ?></h3>
        </div>
        <div class="icon">
          <i class="fa fa-money"></i>
        </div>
        <a href="?module=keuangan" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-xs-12">
      <!-- box PEMASUKAN -->
      <div class="small-box bg-green">
        <div class="inner">
          <?php 
            $query = "SELECT status , SUM(jumlah) AS masuk FROM keuangan WHERE status = 'Pemasukan'";
            $view = mysqli_query($connect, $query);
            $r=mysqli_fetch_array($view);
            $idr = $r['masuk'];
            $for = number_format($idr,0,",",".");
          ?>
          <p>Pemasukan</p>
          <h3>Rp. <?php echo $for; ?></h3>          
        </div>
        <div class="icon">
          <i class="fa fa-download"></i>
        </div>
        <a href="?module=keuangan" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-xs-12">
      <!-- box PENGELUARAN-->
      <div class="small-box bg-yellow">
        <div class="inner">
          <?php 
            $query = "SELECT status , SUM(jumlah) AS keluar FROM keuangan WHERE status = 'Pengeluaran'";
            $view = mysqli_query($connect, $query);
            $r=mysqli_fetch_array($view);
            $idr = $r['keluar'];
            $for = number_format($idr,0,",",".");
          ?>
          <p>Pengeluaran</p>
          <h3>Rp. <?php echo $for; ?></h3>
        </div>
        <div class="icon">
          <i class="fa fa-upload"></i>
        </div>
        <a href="?module=keuangan" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>
  <!-- /.row -->

  <!-- ROW 2-->
  <div class="row">
    <div class="col-md-6 col-xs-12">
      <!-- Custom Tabs (Pulled to the right) -->
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs pull-right">
          <li><a href="#tab_5" data-toggle="tab">Kartu</a></li>
          <li><a href="#tab_4" data-toggle="tab">Jurnal</a></li>
          <li><a href="#tab_3" data-toggle="tab">Buku</a></li>
          <li><a href="#tab_2" data-toggle="tab">Fotocopy</a></li>
          <li class="active"><a href="#tab_1" data-toggle="tab">Denda</a></li>
        
          <li class="pull-left header"><i class="fa fa-money"></i> <b>Total Uang</b></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab_1">
            <?php 
              $query1  = mysqli_fetch_array(mysqli_query($connect, "SELECT status , SUM(jumlah) AS denda_plus FROM keuangan WHERE status = 'Pemasukan' and jenis = 'Denda'"));
              $query2 = mysqli_fetch_array(mysqli_query($connect, "SELECT status , SUM(jumlah) AS denda_min FROM keuangan WHERE status = 'Pengeluaran' and jenis = 'Denda'"));
              
              $total = $query1['denda_plus'] - $query2['denda_min'];
              $for = number_format($total,0,",",".");
            ?>
            <center>
              <h1>
                <strong>
                  Rp. <?php echo $for; ?>
                </strong>
              </h1>
            </center>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="tab_2">
            <?php 
              $query1  = mysqli_fetch_array(mysqli_query($connect, "SELECT status , SUM(jumlah) AS fc_plus FROM keuangan WHERE status = 'Pemasukan' and jenis = 'Fotocopy'"));
              $query2 = mysqli_fetch_array(mysqli_query($connect, "SELECT status , SUM(jumlah) AS fc_min FROM keuangan WHERE status = 'Pengeluaran' and jenis = 'Fotocopy'"));
              
              $total = $query1['fc_plus'] - $query2['fc_min'];
              $for = number_format($total,0,",",".");
            ?>
            <center>
              <h1>
                <strong>
                  Rp. <?php echo $for; ?>
                </strong>
              </h1>
            </center>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="tab_3">
            <?php 
              $query1  = mysqli_fetch_array(mysqli_query($connect, "SELECT status , SUM(jumlah) AS buku_plus FROM keuangan WHERE status = 'Pemasukan' and jenis = 'Buku'"));
              $query2 = mysqli_fetch_array(mysqli_query($connect, "SELECT status , SUM(jumlah) AS buku_min FROM keuangan WHERE status = 'Pengeluaran' and jenis = 'Buku'"));
              
              $total = $query1['buku_plus'] - $query2['buku_min'];
              $for = number_format($total,0,",",".");
            ?>
            <center>
              <h1>
                <strong>
                  Rp. <?php echo $for; ?>
                </strong>
              </h1>
            </center>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="tab_4">
            <?php 
              $query1  = mysqli_fetch_array(mysqli_query($connect, "SELECT status , SUM(jumlah) AS jr_plus FROM keuangan WHERE status = 'Pemasukan' and jenis = 'Jurnal'"));
              $query2 = mysqli_fetch_array(mysqli_query($connect, "SELECT status , SUM(jumlah) AS jr_min FROM keuangan WHERE status = 'Pengeluaran' and jenis = 'Jurnal'"));
              
              $total = $query1['jr_plus'] - $query2['jr_min'];
              $for = number_format($total,0,",",".");
            ?>
            <center>
              <h1>
                <strong>
                  Rp. <?php echo $for; ?>
                </strong>
              </h1>
            </center>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="tab_5">
            <?php 
              $query1  = mysqli_fetch_array(mysqli_query($connect, "SELECT status , SUM(jumlah) AS kta_plus FROM keuangan WHERE status = 'Pemasukan' and jenis = 'Kartu'"));
              $query2 = mysqli_fetch_array(mysqli_query($connect, "SELECT status , SUM(jumlah) AS kta_min FROM keuangan WHERE status = 'Pengeluaran' and jenis = 'Kartu'"));
              
              $total = $query1['kta_plus'] - $query2['kta_min'];
              $for = number_format($total,0,",",".");
            ?>
            <center>
              <h1>
                <strong>
                  Rp. <?php echo $for; ?>
                </strong>
              </h1>
            </center>
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- nav-tabs-custom -->
    </div>
    <!-- /.col -->
    <div class="col-md-6 col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-book"></i> <b>Thesis Data</b></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Skripsi</th>
              <th>Thesis</th>
              <th>Tahun</th>
            </tr>
            </thead>
            <tbody>          
              <tr>
                <td>123</td>
                <td>21</td>
                <td>2017</td>
              </tr>
              <tr>
                <td>233</td>
                <td>34</td>
                <td>2018</td>
              </tr>
            </tbody>
            
          </table>
        </div>
        <!-- /.box-body -->
            
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->