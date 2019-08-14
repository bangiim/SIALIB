<?php

require_once "../../../config/db.php";
require_once "../../../config/tgl_indo.php";
    
$id   = $_POST['rowid'];
$aksi = "modules/keuangan/aksi.php";

$query = "SELECT * FROM keuangan WHERE id_keuangan='$id'";
$hasil = mysqli_query($connect, $query);
$r     = mysqli_fetch_array($hasil);

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
