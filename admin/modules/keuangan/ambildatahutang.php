<?php

require_once "../../../config/db.php";
require_once "../../../config/tgl_indo.php";
    
$id   = $_POST['rowid'];
$aksi = "modules/keuangan/aksi.php";

// mengambil data berdasarkan id
$query = "SELECT b.nama, a.status, a.jenis, a.tgl, a.jumlah, a.id_keuangan FROM keuangan a, staff b 
          WHERE a.id_staf = b.id_staf AND a.id_staf = '1' ORDER BY id_keuangan";
$masuk = mysqli_query($connect, $query);

// cek koneksi
if (!$masuk) {
    printf("Error: %s\n", mysqli_error($connect));
    exit();
}

$query1  = mysqli_fetch_array(mysqli_query($connect, "SELECT status , SUM(jumlah) AS denda_plus FROM keuangan WHERE status = 'Hutang'"));
$query2 = mysqli_fetch_array(mysqli_query($connect, "SELECT status , SUM(jumlah) AS denda_min FROM keuangan WHERE status = 'Bayar'"));
  
$total = $query1['denda_plus'] - $query2['denda_min'];
$for = number_format($total,0,",",".");
?>

<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover" id="example2">
        <thead>
            <tr>
              <th>NO</th>
              <th>NAMA</th>
              <th>STATUS</th>
              <th>JENIS</th>
              <th>TANGGAL</th>
              <th>JUMLAH</th> 
              <th>AKSI</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($r=mysqli_fetch_array($masuk)){
                $idr    = $r['jumlah'];
                $jumlah = number_format($idr,0,",",".");
                $date   = tgl_indo($r['tgl']);
            ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $r['nama']?></td>
                <td>
                    <?php
                        if ($r['status']=='Hutang') {
                            echo"<span class='badge bg-green'>$r[status]</span>";
                        }
                        else{
                            echo"<span class='badge bg-yellow'>$r[status]</span>";
                        }
                    ?>
                </td> 
                <td><?php echo $r['jenis']?></td> 
                <td><?php echo $date ?></td>       
                <td>Rp. <?php echo $jumlah ?></td>
                <td>
                    <a href="#myModalEdit" class="btn btn-success btn-xs" id="custId" data-toggle="modal" data-id="<?php echo $r['id_keuangan']?>"><i class="fa fa-edit"></i></a>

                    <a class="btn btn-success" href="?module=keuangan&act=edit&id=<?php echo $r['id_keuangan']; ?>"><i class="fa fa-edit"></i></a>
                    
                    <a class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" <?php echo "href=\"$aksi?module=keuangan&act=delete&id=$r[id_keuangan]\""; ?>><i class="fa fa-trash"></i></a>
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
   
