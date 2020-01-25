<?php
session_start();

if (!$_SESSION ['user_login']) {
  echo "<script> alert('Silahkan Login Dahulu!')
  document.location = 'index.php'
  </script>";

}else{
  ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
    <title>BARANG DIAMBIL</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </head>
  <body background="gambar/8.jpg">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <a class="navbar-brand font-weight-bold" href="home.html">DATA SERVICE</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto navbar-right">
          <li class="nav-item ">
            <a class="nav-link" href="user.php">USER</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="daftar_pelanggan.php">PELANGGAN</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="daftar_service.php">SERVICE</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="barang.php">BARANG</a>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <a href="Logout.php" type="button" class="btn btn-danger" onclick="return confirm('CONFIRM LOGOUT')"><?php echo $_SESSION['nama'] ?> | LOGOUT</a>
        </ul>
      </div>
    </nav>
    <nav>
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link" href="barang.php">Bisa Diambil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="sudah_diambil.php">Sudah Diambil</a>
        </li>
      </ul>
    </nav>
    <div class="container">
      <h3 style="text-align: center;">DAFTAR BARANG SUDAH DIAMBIL</h3>
      <div class="table-responsive">
        <form method="POST" action="">
          <div class="input-group mb-3 col-sm-6" style="float: right;">
            <input type="text" class="form-control" name="nama" placeholder="cari nama" aria-label="Recipient's username" aria-describedby="button-addon2">
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="submit" name="cari_pelanggan">CARI</button>
            </div>
          </form>
        </div>


        <?php
        if (isset($_POST['cari_pelanggan'])) {
          ?>

          <table class="table table-sm table-hover" style="font-size: 12.5px">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">TGL TERIMA</th>
                <th scope="col">PEMILIK</th>
                <th scope="col">NAMA BARANG</th>
                <th scope="col">KERUSAKAN</th>
                <th scope="col">KONDISI</th>
                <th scope="col">TINDAKAN</th>
                <th scope="col">BIAYA</th>
                <th scope="col">TGL AMBIL</th>
                <th scope="col">GARANSI</th>
                <th scope="col">TOOLS</th>
              </tr>
            </thead>
            <tbody>

             <?php
             include "koneksi.php";
             $nama = $_POST['nama'];
             $cari = "SELECT * FROM view_proses_service WHERE nama_pelanggan like '%$nama%'  AND status = 'diambil'";
             $peta = mysqli_query($conn, $cari);                      
             $no = 1;
             foreach($peta as $pel){
              ?>
              <td><?php echo $no ?></td>
              <td><?php echo $pel['id'];?></td>
              <td><?php echo $pel['tgl_terima'];?></td>
              <td data-toggle="tooltip" data-placement="bottom" title="<b>No Hp :</b> <em><?php echo $pel['no_hp'];?></em><br><b>Alamat :</b> <em><?php echo $pel['alamat'];?></em></em><br>" data-html="true"><?php echo $pel['nama_pelanggan'];?></td>
              <td data-toggle="tooltip" data-placement="bottom" title="<b>SN : </b> <em><?php echo $pel['sn'];?>" data-html="true"><?php echo $pel['jenis_barang'].",".$pel['merk'].",".$pel['model_seri'];?></td>
                <td><?php echo $pel['kerusakan'];?></td>
                <td><?php echo $pel['kondisi'];?></td>
                <td  data-toggle="tooltip" data-placement="bottom" title="<b>CATATAN : </b> <em><?php echo $pel['catatan'];?>" data-html="true"><?php echo $pel['tindakan'];?>
              </td>
              <td><?php echo $pel['biaya'];?></td>
              <td align="center"><?php echo $pel['tgl_dikerjakan'];?></td>
              <td><?php echo $pel['garansi'];?></td>
              <td align="center">
                <a href="print_sudah_diambil.php?id=<?php echo $pel['id'] ?>" target="_BLANK" style="font-size: 14px" type="button" class="btn btn-success btn-sm">🖨️</a>
              </td>

            </tr>
            <?php
            $no++;
          }
          ?>

        </tbody>
      </table>
      <?php
    }else{
      ?>  
      <table class="table table-sm table-hover" style="font-size: 12.5px">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">TGL TERIMA</th>
            <th scope="col">PEMILIK</th>
            <th scope="col">NAMA BARANG</th>
            <th scope="col">KERUSAKAN</th>
            <th scope="col">KONDISI</th>
            <th scope="col">TINDAKAN</th>
            <th scope="col">BIAYA</th>
            <th scope="col">TGL AMBIL</th>
            <th scope="col">GARANSI</th>
            <th scope="col">TOOLS</th>
          </tr>
        </thead>
        <tbody>

         <?php
         include "koneksi.php";
         $tampil = "SELECT * FROM view_proses_service WHERE status='diambil'";
         $sv = mysqli_query ($conn, $tampil);
                    // var_dump($conn->query("SELECT * FROM tbl_proses_service WHERE status='proses'"));
         $no = 1;
         foreach($sv as $service){                        
          ?>

          <td><?php echo $no ?></td>
          <td><?php echo $service['id'];?></td>
          <td><?php echo $service['tgl_terima'];?></td>
          <td data-toggle="tooltip" data-placement="bottom" title="<b>No Hp :</b> <em><?php echo $service['no_hp'];?></em><br><b>Alamat :</b> <em><?php echo $service['alamat'];?></em></em><br>" data-html="true"><?php echo $service['nama_pelanggan'];?></td>
          <td data-toggle="tooltip" data-placement="bottom" title="<b>SN : </b> <em><?php echo $service['sn'];?>" data-html="true"><?php echo $service['jenis_barang'].",".$service['merk'].",".$service['model_seri'];?></td>
            <td><?php echo $service['kerusakan'];?></td>
            <td><?php echo $service['kondisi'];?></td>
            <td  data-toggle="tooltip" data-placement="bottom" title="<b>CATATAN : </b> <em><?php echo $service['catatan'];?>" data-html="true"><?php echo $service['tindakan'];?>
          </td>
          <td><?php echo $service['biaya'];?></td>
          <td align="center"><?php echo $service['tgl_dikerjakan'];?></td>
          <td><?php echo $service['garansi'];?></td>
          <td align="center">
            <a href="print_sudah_diambil.php?id=<?php echo $service['id'] ?>" target="_BLANK" style="font-size: 14px" type="button" class="btn btn-success btn-sm">🖨️</a>
          </td>

        </tr>
        <?php
        $no++;
      }
      ?>

    </tbody>
  </table>
  <?php
}
?>
</div>   
</div>
<div id="modalambil" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
      <!-- heading modal -->
      <div class="modal-header">
        <h4 class="modal-title">FORM AMBIL BARANG</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- body modal -->
      <div class="modal-body">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Nama Pemilik</span>
          </div>
          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Jenis Barang</span>
          </div>
          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Kerusakan</span>
          </div>
          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Kondisi</span>
          </div>
          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Tindakan</span>
          </div>
          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Biaya</span>
          </div>
          <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Garansi</span>
          </div>
          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Pengambil</span>
          </div>
          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>

      </div>
      <!-- footer modal -->
      <div class="modal-footer">
        <a href="#" type="button" class="btn btn-success">Diambil</a>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>





<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script src="https://unpkg.com/@popperjs/core@2.0.0-rc.1"></script>
<script>
  $(document).ready(function() {
    $('.select_name').select2();

    $('[data-toggle="tooltip"]').tooltip()
  });
</script>
</body>
</html>
<?php
}
?>