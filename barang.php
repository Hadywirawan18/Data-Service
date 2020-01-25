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
    <title>AMBIL BARANG</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />

    <style>
      #tooltip {
        background-color: rebeccapurple;
        padding: 20px;
        width: 200px;
      }
    </style>
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
          <a class="nav-link active" href="barang.php">Bisa Diambil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="sudah_diambil.php">Sudah Diambil</a>
        </li>
      </ul>
    </nav>
    <div class="container">
      <h3 style="text-align: center;">DAFTAR BARANG BISA DIAMBIL</h3>
      <div class="table-responsive">
        <form method="POST" class="">
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

          <table class="table table-sm table-hover" style="font-size: 14px">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col" style="text-align: center;">PEMILIK</th>
                <th scope="col">TGL DITERIMA</th>
                <th scope="col" style="text-align-last: center;">BARANG</th>
                <th scope="col">KERUSAKAN</th>
                <th scope="col">KONDISI</th>
                <th scope="col">TINDAKAN</th>
                <th scope="col">BIAYA</th>
                <th scope="col">TGL DIKERJAKAN</th>
                <th scope="col" style="text-align: center;">TOOLS</th>
              </tr>
            </thead>
            <tbody>

              <?php
              include "koneksi.php";
              $nama = $_POST['nama'];
              $cari = "SELECT * FROM view_proses_service WHERE nama_pelanggan like '%$nama%'  AND status = 'selesai'";
              $peta = mysqli_query($conn, $cari);                      
              $no = 1;
              foreach($peta as $pel){
                ?>

                <td><?php echo $no ?></td>
                <td><?php echo $pel['id'];?></td>
                <td data-toggle="tooltip" data-placement="bottom" title="<b>No Hp :</b> <em><?php echo $pel['no_hp'];?></em><br><b>Alamat :</b> <em><?php echo $pel['alamat'];?></em></em>" data-html="true"><?php echo $pel['nama_pelanggan'];?>
              </td>
              <td align="center"><?php echo $pel['tgl_terima'];?></td>
              <td data-toggle="tooltip" data-placement="bottom" title="<b>SN : </b> <em><?php echo $pel['sn'];?>" data-html="true"><?php echo $pel['jenis_barang'].",".$pel['merk'].",".$pel['model_seri'];?></td>

                <td><?php echo $pel['kerusakan'];?></td>
                <td><?php echo $pel['kondisi'];?></td>
                <td  data-toggle="tooltip" data-placement="bottom" title="<b>CATATAN : </b> <em><?php echo $pel['catatan'];?>"data-html="true"><?php echo $pel['tindakan'];?></td>
                  <td><?php echo $pel['biaya'];?></td>
                  <td align="center"><?php echo $pel['tgl_dikerjakan'];?></td>
                  <td align="right">

                    <a href="proses_sudah_diambil.php?dambl=<?php echo $pel['id'];?>" type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalambil<?php echo $pel['id'];?>">✔</a>
                    <a href="bisadiambil_to_proses.php?bsdambl=<?php echo $pel['id'];?>" style="font-size: 14px" type="submit" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modaledit<?php echo $pel['id'];?>">&#x21bb</a>

                    <div id="modalambil<?php echo $pel['id'];?>" class="modal fade" role="dialog">
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
                            <form action="proses_sudah_diambil.php" method="POST">
                              <input type="hidden" name="id_service" value="<?php echo $pel['id'];?>">
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">Pemilik Barang</span>
                                </div>
                                <!-- <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"> -->
                                <input type="text" name="pemilik" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $pel['nama_pelanggan'].",".$pel['no_hp'].",".$pel['alamat'];?>"readonly>
                              </div>
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">Nama Barang</span>
                                </div>
                                <!-- <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"> -->
                                <input type="text" name="nama_barang" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $pel['jenis_barang'].",".$pel['merk'].",".$pel['model_seri'].",".$pel['sn'];?>"readonly>
                              </div>
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">Kerusakan</span>
                                </div>
                                <input type="text" name="kerusakan" class="form-control" aria-label="Sizing example input"  aria-describedby="inputGroup-sizing-default" value="<?php echo $pel['kerusakan'];?>" readonly>
                              </div>
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">Kondisi</span>
                                </div>
                                <input type="text" name="kerusakan" class="form-control" aria-label="Sizing example input"  aria-describedby="inputGroup-sizing-default" value="<?php echo $pel['kondisi'];?>" readonly>
                              </div>
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">Tindakan</span>
                                </div>
                                <input type="text" name="kerusakan" class="form-control" aria-label="Sizing example input"  aria-describedby="inputGroup-sizing-default" value="<?php echo $pel['tindakan'];?>" readonly>
                              </div>
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">Biaya</span>
                                </div>
                                <input type="text" name="kerusakan" class="form-control" aria-label="Sizing example input"  aria-describedby="inputGroup-sizing-default" value="<?php echo $pel['biaya'];?>" readonly>
                              </div>
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">Garansi</span>
                                </div>
                                <!-- <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"> -->
                                <select name="garansi" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                  <option value="Tidak Ada">
                                    Tidak Ada
                                  </option>
                                  <option value="3 Hari">
                                    3 Hari
                                  </option>
                                  <option value="1 Minggu">
                                    1 Minggu
                                  </option>
                                  <option value="1 Bulan">
                                    1 Bulan
                                  </option>
                                  <option value="3 Bulan">
                                    3 Bulan
                                  </option>
                                  <option value="6 Bulan">
                                    6 Bulan
                                  </option>
                                  <option value="1 Tahun">
                                    1 Tahun
                                  </option>
                                </select>
                              </div>
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">Pengambil</span>
                                </div>
                                <input type="text" name="pengambil" class="form-control" aria-label="Sizing example input"  aria-describedby="inputGroup-sizing-default" value="<?php echo $pel['nama_pelanggan'];?>">
                              </div>

                            </div>
                            <!-- footer modal -->
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-success">Diambil</a>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                      <div id="modaledit<?php echo $pel['id'];?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                          <!-- konten modal-->
                          <div class="modal-content">
                            <!-- heading modal -->
                            <div class="modal-header">
                              <h4 class="modal-title">FORM EDIT DATA SERVICE</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- body modal -->
                            <div class="modal-body">
                              <form action="proses_ubah_daftar_service.php" method="POST">
                                <input type="hidden" name="id_service" value="<?php echo $pel['id'];?>">
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 118px" id="inputGroup-sizing-default">Nama</span>
                                  </div>
                                  <select class="form-control select_name" name="state"  style="width: 74.5%" disabled="true">
                                    <?php
                                    $tampil2 = "SELECT * FROM tbl_pelanggan";
                                    $pelgn = mysqli_query ($conn, $tampil2);
                                    $no = 1;
                                    foreach($pelgn as $plgn){ 
                                      ?>

                                      <option value="<?php echo $plgn['nama_pelanggan'] ?>,<?php echo $plgn['no_hp'] ?>"><?php echo $plgn['nama_pelanggan'] ?> (<?php echo $plgn['no_hp'] ?>)</option>
                                      <?php 
                                      $no++;
                                    }                    
                                    ?>
                                  </select>
                                </div>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 118px" id="inputGroup-sizing-default">Jenis Barang</span>
                                  </div>
                                  <input type="text" class="form-control" name="jenis_barang" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $pel['jenis_barang'];?>">
                                </div>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 118px" id="inputGroup-sizing-default">Merk</span>
                                  </div>
                                  <input type="text" class="form-control" name="merk" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $pel['merk'];?>">
                                </div>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 118px" id="inputGroup-sizing-default">Model/Seri</span>
                                  </div>
                                  <input type="text" class="form-control" name="model_seri" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $pel['model_seri'];?>">
                                </div><div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 118px" id="inputGroup-sizing-default">SN</span>
                                  </div>
                                  <input type="text" class="form-control" name="sn" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $pel['sn'];?>">
                                </div>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 118px" id="inputGroup-sizing-default">Kelengkapan</span>
                                  </div>
                                  <input type="text" class="form-control" name="kelengkapan" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $pel['kelengkapan'];?>">
                                </div>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 118px" id="inputGroup-sizing-default">Kerusakan</span>
                                  </div>
                                  <input type="text" class="form-control" name="kerusakan" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $pel['kerusakan'];?>">
                                </div>
                                <input type="hidden" name="status" value="proses">
                              </div>
                              <!-- footer modal -->
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-success" onclick="return confirm('Ubah Ke Proses Service ?')">Save</a>
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                              </div>

                            </form>
                          </div>
                        </div>

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
            <table class="table table-sm table-hover" style="font-size: 14px">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">ID</th>
                  <th scope="col" style="text-align: center;">PEMILIK</th>
                  <th scope="col">TGL DITERIMA</th>
                  <th scope="col" style="text-align-last: center;">BARANG</th>
                  <th scope="col">KERUSAKAN</th>
                  <th scope="col">KONDISI</th>
                  <th scope="col">TINDAKAN</th>
                  <th scope="col">BIAYA</th>
                  <th scope="col">TGL DIKERJAKAN</th>
                  <th scope="col" style="text-align: center;">TOOLS</th>
                </tr>
              </thead>
              <tbody>

                <?php
                include "koneksi.php";
                $tampil = "SELECT * FROM view_proses_service WHERE status='selesai'";
                $sv = mysqli_query ($conn, $tampil);
                    // var_dump($conn->query("SELECT * FROM tbl_proses_service WHERE status='proses'"));
                $no = 1;
                foreach($sv as $service){                        
                  ?>

                  <td><?php echo $no ?></td>
                  <td><?php echo $service['id'];?></td>
                  <td data-toggle="tooltip" data-placement="bottom" title="<b>No Hp :</b> <em><?php echo $service['no_hp'];?></em><br><b>Alamat :</b> <em><?php echo $service['alamat'];?></em></em>" data-html="true"><?php echo $service['nama_pelanggan'];?>
                </td>
                <td align="center"><?php echo $service['tgl_terima'];?></td>
                <td data-toggle="tooltip" data-placement="bottom" title="<b>SN : </b> <em><?php echo $service['sn'];?>" data-html="true"><?php echo $service['jenis_barang'].",".$service['merk'].",".$service['model_seri'];?></td>

                  <td><?php echo $service['kerusakan'];?></td>
                  <td><?php echo $service['kondisi'];?></td>
                  <td  data-toggle="tooltip" data-placement="bottom" title="<b>CATATAN : </b> <em><?php echo $service['catatan'];?>"data-html="true"><?php echo $service['tindakan'];?></td>
                    <td><?php echo $service['biaya'];?></td>
                    <td align="center"><?php echo $service['tgl_dikerjakan'];?></td>
                    <td align="right">

                      <a href="proses_sudah_diambil.php?dambl=<?php echo $service['id'];?>" type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalambil<?php echo $service['id'];?>">✔</a>
                      <a href="bisadiambil_to_proses.php?bsdambl=<?php echo $service['id'];?>" style="font-size: 14px" type="submit" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modaledit<?php echo $service['id'];?>">&#x21bb</a>

                      <div id="modalambil<?php echo $service['id'];?>" class="modal fade" role="dialog">
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
                              <form action="proses_sudah_diambil.php" method="POST">
                                <input type="hidden" name="id_service" value="<?php echo $service['id'];?>">
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">Pemilik Barang</span>
                                  </div>
                                  <!-- <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"> -->
                                  <input type="text" name="pemilik" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $service['nama_pelanggan'].",".$service['no_hp'].",".$service['alamat'];?>"readonly>
                                </div>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">Nama Barang</span>
                                  </div>
                                  <!-- <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"> -->
                                  <input type="text" name="nama_barang" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $service['jenis_barang'].",".$service['merk'].",".$service['model_seri'].",".$service['sn'];?>"readonly>
                                </div>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">Kerusakan</span>
                                  </div>
                                  <input type="text" name="kerusakan" class="form-control" aria-label="Sizing example input"  aria-describedby="inputGroup-sizing-default" value="<?php echo $service['kerusakan'];?>" readonly>
                                </div>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">Kondisi</span>
                                  </div>
                                  <input type="text" name="kerusakan" class="form-control" aria-label="Sizing example input"  aria-describedby="inputGroup-sizing-default" value="<?php echo $service['kondisi'];?>" readonly>
                                </div>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">Tindakan</span>
                                  </div>
                                  <input type="text" name="kerusakan" class="form-control" aria-label="Sizing example input"  aria-describedby="inputGroup-sizing-default" value="<?php echo $service['tindakan'];?>" readonly>
                                </div>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">Biaya</span>
                                  </div>
                                  <input type="text" name="kerusakan" class="form-control" aria-label="Sizing example input"  aria-describedby="inputGroup-sizing-default" value="<?php echo $service['biaya'];?>" readonly>
                                </div>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">Garansi</span>
                                  </div>
                                  <!-- <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"> -->
                                  <select name="garansi" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                    <option value="Tidak Ada">
                                      Tidak Ada
                                    </option>
                                    <option value="3 Hari">
                                      3 Hari
                                    </option>
                                    <option value="1 Minggu">
                                      1 Minggu
                                    </option>
                                    <option value="1 Bulan">
                                      1 Bulan
                                    </option>
                                    <option value="3 Bulan">
                                      3 Bulan
                                    </option>
                                    <option value="6 Bulan">
                                      6 Bulan
                                    </option>
                                    <option value="1 Tahun">
                                      1 Tahun
                                    </option>
                                  </select>
                                </div>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">Pengambil</span>
                                  </div>
                                  <input type="text" name="pengambil" class="form-control" aria-label="Sizing example input"  aria-describedby="inputGroup-sizing-default" value="<?php echo $service['nama_pelanggan'];?>">
                                </div>

                              </div>
                              <!-- footer modal -->
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Diambil</a>
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                        <div id="modaledit<?php echo $service['id'];?>" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                            <!-- konten modal-->
                            <div class="modal-content">
                              <!-- heading modal -->
                              <div class="modal-header">
                                <h4 class="modal-title">FORM EDIT DATA SERVICE</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>
                              <!-- body modal -->
                              <div class="modal-body">
                                <form action="bisadiambil_to_proses.php" method="POST">
                                  <input type="hidden" name="id_service" value="<?php echo $service['id'];?>">
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" style="width: 118px" id="inputGroup-sizing-default">Nama</span>
                                    </div>
                                    <select class="form-control select_name" name="state"  style="width: 74.5%" disabled="true">
                                      <?php
                                      $tampil2 = "SELECT * FROM tbl_pelanggan";
                                      $pelgn = mysqli_query ($conn, $tampil2);
                                      $no = 1;
                                      foreach($pelgn as $plgn){ 
                                        ?>

                                        <option value="<?php echo $plgn['nama_pelanggan'] ?>,<?php echo $plgn['no_hp'] ?>"><?php echo $plgn['nama_pelanggan'] ?> (<?php echo $plgn['no_hp'] ?>)</option>
                                        <?php 
                                        $no++;
                                      }                    
                                      ?>
                                    </select>
                                  </div>
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" style="width: 118px" id="inputGroup-sizing-default">Jenis Barang</span>
                                    </div>
                                    <input type="text" class="form-control" name="jenis_barang" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $service['jenis_barang'];?>">
                                  </div>
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" style="width: 118px" id="inputGroup-sizing-default">Merk</span>
                                    </div>
                                    <input type="text" class="form-control" name="merk" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $service['merk'];?>">
                                  </div>
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" style="width: 118px" id="inputGroup-sizing-default">Model/Seri</span>
                                    </div>
                                    <input type="text" class="form-control" name="model_seri" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $service['model_seri'];?>">
                                  </div><div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" style="width: 118px" id="inputGroup-sizing-default">SN</span>
                                    </div>
                                    <input type="text" class="form-control" name="sn" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $service['sn'];?>">
                                  </div>
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" style="width: 118px" id="inputGroup-sizing-default">Kelengkapan</span>
                                    </div>
                                    <input type="text" class="form-control" name="kelengkapan" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $service['kelengkapan'];?>">
                                  </div>
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" style="width: 118px" id="inputGroup-sizing-default">Kerusakan</span>
                                    </div>
                                    <input type="text" class="form-control" name="kerusakan" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $service['kerusakan'];?>">
                                  </div>
                                  <input type="hidden" name="status" value="proses">
                                </div>
                                <!-- footer modal -->
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-success" onclick="return confirm('Ubah Ke Proses Service ?')">Save</a>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                  </div>
                                </div>

                              </form>
                            </div>
                          </div>

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