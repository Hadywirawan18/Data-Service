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
    <title>DAFTAR PELANGGAN</title>
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
          <li class="nav-item active">
            <a class="nav-link" href="daftar_pelanggan.php">PELANGGAN</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="daftar_service.php">SERVICE</a>
          </li>
          <li class="nav-item">
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
          <a class="nav-link " href="#" data-toggle="modal" data-target="#myModal">Tambah Pelanggan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">Daftar Pelanggan</a>
        </li>
      </ul>
    </nav>
    <div class="container">
      <h3 style="text-align: center;">DAFTAR PELANGGAN</h3>
      <div class="table-responsive">
        <form action="" method="POST">
          <div class="input-group mb-3">
          <input type="text" class="form-control" name="nama" placeholder="cari nama" aria-label="Recipient's username" aria-describedby="button-addon2">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit" name="cari_pelanggan">CARI</button>
          </div>
        </div>
        </form>
      </div>

      <?php
      if (isset($_POST['cari_pelanggan'])) {
        ?>
        <table class="table table-sm table-hover" id="table_cari" style="font-size: 13px">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">NAMA PELANGGAN</th>
              <th scope="col">NOMOR HP</th>
              <th scope="col">ALAMAT</th>
              <th scope="col" style="text-align: center;">TOOLS</th>
            </tr>
          </thead>
          <tbody>

           <?php
           include "koneksi.php";
           $nama = $_POST['nama'];
           $cari = "SELECT * FROM tbl_pelanggan WHERE nama_pelanggan like '%$nama%'";
           $peta = mysqli_query($conn, $cari);                      
           $no = 1;
           foreach($peta as $pel){
            ?>
            <td><?php echo $no ?></td>
            <td><?php echo $pel['nama_pelanggan'];?></td>
            <td><?php echo $pel['no_hp'];?></td>
            <td><?php echo $pel['alamat'];?></td>
            <td align="center">

              <a href="ubah_pelanggan.php?pelgn=<?php echo $pel['no_hp'];?>" type="button" class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#modaledit<?php echo $pel['no_hp'];?>">📝</a>

              <a href = "hapus_pelanggan.php?pelgn=<?php echo $pel['no_hp'];?>" type="button" onclick="return confirm('Are You Sure to Delete ?');" class="btn btn-danger btn-sm">🗑️</a>

              <form action="ubah_pelanggan.php" method="POST">
                <div id="modaledit<?php echo $pel['no_hp'];?>" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                    <!-- konten modal-->
                    <div class="modal-content">
                      <!-- heading modal -->
                      <div class="modal-header">
                        <h4 class="modal-title">EDIT DATA PELANGGAN</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <!-- body modal -->
                      <div class="modal-body">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">Nama</span>
                          </div>
                          <input type="text" name="nama_pelanggan" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $pel['nama_pelanggan'];?>">
                        </div>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">NOMOR HP</span>
                          </div>
                          <input type="text" name="no_hp" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $pel['no_hp'];?>" readonly>
                        </div>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">ALAMAT</span>
                          </div>
                          <textarea type="text" cols="46" name="almt" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" ><?php echo $pel['alamat']?></textarea>

                        </div>
                      </div>
                      <!-- footer modal -->
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save</a>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>

                </form>


              </td>
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
    <table class="table table-sm table-hover" style="font-size: 13px">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">NAMA PELANGGAN</th>
          <th scope="col">NOMOR HP</th>
          <th scope="col">ALAMAT</th>
          <th scope="col" style="text-align: center;">TOOLS</th>
        </tr>
      </thead>
      <tbody>

       <?php
       include "koneksi.php";
       $tampil = "SELECT * FROM tbl_pelanggan";
       $plgn = mysqli_query ($conn, $tampil);
                    //var_dump($user);
       $no = 1;
       foreach($plgn as $pelanggan){                        
        ?>


        <td><?php echo $no ?></td>
        <td><?php echo $pelanggan['nama_pelanggan'];?></td>
        <td><?php echo $pelanggan['no_hp'];?></td>
        <td><?php echo $pelanggan['alamat'];?></td>
        <td align="center">

          <a href="ubah_pelanggan.php?pelgn=<?php echo $pelanggan['no_hp'];?>" type="button" class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#modaledit<?php echo $pelanggan['no_hp'];?>">📝</a>

          <a href = "hapus_pelanggan.php?pelgn=<?php echo $pelanggan['no_hp'];?>" type="button" onclick="return confirm('Are You Sure to Delete ?');" class="btn btn-danger btn-sm">🗑️</a>

          <form action="ubah_pelanggan.php" method="POST">
            <div id="modaledit<?php echo $pelanggan['no_hp'];?>" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <!-- konten modal-->
                <div class="modal-content">
                  <!-- heading modal -->
                  <div class="modal-header">
                    <h4 class="modal-title">EDIT DATA PELANGGAN</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <!-- body modal -->
                  <div class="modal-body">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">Nama</span>
                      </div>
                      <input type="text" name="nama_pelanggan" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $pelanggan['nama_pelanggan'];?>">
                    </div>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">NOMOR HP</span>
                      </div>
                      <input type="text" name="no_hp" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $pelanggan['no_hp'];?>" readonly>
                    </div>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">ALAMAT</span>
                      </div>
                      <textarea type="text" cols="46" name="almt" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" ><?php echo $pelanggan['alamat']?></textarea>

                    </div>
                  </div>
                  <!-- footer modal -->
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</a>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>

            </form>


          </td>
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

<form action="proses_tambah_pelanggan.php" method="POST">
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <h4 class="modal-title">FORM TAMBAH PELANGGAN</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">Nama</span>
            </div>
            <input type="text" name="nama" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">NOMOR HP</span>
            </div>
            <input type="text" name="nohp" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">ALAMAT</span>
            </div>
            <textarea cols="46" name="almt" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"></textarea>

          </div>

        </div>
        <!-- footer modal -->
        <div class="modal-footer">

          <button type="submit" class="btn btn-success">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</form>


</body>
</html>
<?php
}
?>