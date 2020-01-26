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
    <a class="navbar-brand font-weight-bold" href="daftar_service.php">DATA SERVICE</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto navbar-right">
        <li class="nav-item active ">
          <a class="nav-link" href="user.php">USER</a>
        </li>
        <li class="nav-item">
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

<div class="container">
  <h3 style="text-align: center;">DAFTAR USER</h3>
  <div class="table-responsive">
    <div class="input-group mb-3">
      <a href="#" style="float: right;" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tambah User</a>
    </div>

    <table class="table table-sm table-hover" style="font-size: 14px">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">NAMA</th>
          <th scope="col">USERNAME</th>
          <th scope="col">PASSWORD</th>
          <th scope="col" style="text-align: center;">TOOLS</th>
        </tr>
      </thead>
      <tbody>

        <?php
        include "koneksi.php";
        $tampil = "SELECT * FROM tbl_user";
        $user = mysqli_query ($conn, $tampil);
                    //var_dump($user);
        $no = 1;
        foreach($user as $pengguna){                        
          ?>

          <tr>
            <td><?php echo $no ?></td>
            <td><?php echo $pengguna['nama'];?></td>
            <td><?php echo $pengguna['username'];?></td>
            <td><?php echo $pengguna['password'];?></td>

            <td align="center">

              <a href="proses_ubah_user.php?usr=<?php echo $pengguna['username'];?>" type="button" class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#modaledit<?php echo $pengguna['username'];?>">📝</a>

              <a href = "hapus_user.php?usr=<?php echo $pengguna['username'];?>" type="button" onclick="return confirm('Are You Sure to Delete ?');" class="btn btn-danger btn-sm">🗑️</a>


              <form action="proses_ubah_user.php" method="POST">
                <div id="modaledit<?php echo $pengguna['username'];?>" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                    <!-- konten modal-->    
                    <div class="modal-content">
                      <!-- heading modal -->
                      <div class="modal-header">
                        <h4 class="modal-title">EDIT USER</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <!-- body modal -->
                      <div class="modal-body">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">Nama</span>
                          </div>
                          <input type="text" name="nama" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"value="<?php echo $pengguna['nama'];?>">
                        </div>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">Username</span>
                          </div>
                          <input type="text" name="usrnm" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $pengguna['username'];?>" readonly>
                        </div>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">Password</span>
                          </div>
                          <input type="text" name="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $pengguna['password'];?>">
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
            </div>



          </td>
        </tr>
        <?php
        $no++;
      }
      ?>

    </tbody>
  </table>
</div>

<form action="proses_tambah_user.php" method="POST">
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <h4 class="modal-title">TAMBAH USER</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <div class="input-group mb-3">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default"  style="width: 118px">Nama</span>
              </div>
              <input type="text" name="nama" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default"  style="width: 118px">Username</span>
            </div>
            <input type="text" name="username" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default"  style="width: 118px">password</span>
            </div>
            <input type="password" name="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
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