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
    <title>SERVICE</title>
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
          <li class="nav-item active">
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
          <a class="nav-link " href="#" data-toggle="modal" data-target="#myModal">Terima Service</a>

        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">Proses Service</a>
        </li>
      </ul>
    </nav>
    <div class="container">
      <h3 style="text-align: center;">DAFTAR PROSES SERVICE</h3>
      <div class="table-responsive">
        <form method="POST" class="">
          <div class="input-group mb-3 col-sm-6" style="float: right;">
            <input type="text" class="form-control" name="nama" placeholder="cari pemilik" aria-label="Recipient's username" aria-describedby="button-addon2">
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
                <th scope="col">PEMILIK</th>
                <th scope="col">TGL TERIMA</th>
                <th scope="col" style="text-align: center;">JENIS</th>
                <th scope="col">MERK</th>
                <th scope="col">MODEL/SERI</th>
                <th scope="col">KELENGKAPAN</th>
                <th scope="col">KERUSAKAN</th>
                <th scope="col" style="text-align: center;">TOOLS</th>
              </tr>
            </thead>
            <tbody>

             <?php
           include "koneksi.php";
           $nama = $_POST['nama'];
           $cari = "SELECT * FROM view_proses_service WHERE nama_pelanggan like '%$nama%'  AND status = 'proses'";
           $peta = mysqli_query($conn, $cari);                      
           $no = 1;
           foreach($peta as $pel){
            ?>


              <td><?php echo $no ?></td>
              <td><?php echo $pel['id'];?></td>
              <td data-toggle="tooltip" data-placement="bottom" title="<b>No Hp :</b> <em><?php echo $pel['no_hp'];?></em><br><b>Alamat :</b> <em><?php echo $pel['alamat'];?>" data-html="true"><?php echo $pel['nama_pelanggan'];?></td>
                <td><?php echo $pel['tgl_terima'];?></td>
                <td><?php echo $pel['jenis_barang'];?></td>
                <td><?php echo $pel['merk'];?></td>
                <td
                data-toggle="tooltip" data-placement="bottom" title="<b>SN : </b> <em><?php echo $pel['sn'];?>" data-html="true"><?php echo $pel['model_seri'];?>
              </td>
              <!-- <td><?php echo $service['sn'];?></td> -->
              <td><?php echo $pel['kelengkapan'];?></td>
              <td><?php echo $pel['kerusakan'];?></td>


              <td align="right">
                <a href="proses_bisa_diambil.php?bsdambl=<?php echo $pel['id'];?>" type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalfinish<?php echo $pel['id'];?>">✔</a>
                <a href="proses_ubah_daftar_service.php?id=<?php echo $pel['id'];?>" style="font-size: 14px" type="button" class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#modaledit<?php echo $pel['id'];?>">📝</a>
                <a href="hapus_prosesservice.php?id=<?php echo $pel['id'];?>" type="button" class="btn btn-danger btn-sm" onclick="return confirm('yakin mau di hapus?')">🗑️</a>
                <a href="print_proses_service.php?id=<?php echo $pel['id'] ?>" target="_BLANK" style="font-size: 14px" type="button" class="btn btn-success btn-sm">🖨️</a>

                <div id="modalfinish<?php echo $pel['id'];?>" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                    <!-- konten modal-->
                    <div class="modal-content">
                      <!-- heading modal -->
                      <div class="modal-header">
                        <h4 class="modal-title">FORM BARANG BISA DIAMBIL</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <!-- body modal -->
                      <div class="modal-body">
                        <form action="proses_bisa_diambil.php" method="POST">
                          <input type="hidden" name="id" value="<?php echo $pel['id'];?>">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">Nama</span>
                            </div>
                            <input type="text" name="nama_dll" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $pel['nama_pelanggan'].",".$pel['jenis_barang'].",".$pel['merk'].",".$pel['model_seri'].",".$pel['sn'];?>"readonly>
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
                            <!-- <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"> -->
                            <select name="kondisi" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                              <option value="Sudah Jadi">
                                Sudah Jadi
                              </option>
                              <option value="Tidak Bisa">
                                Tidak Bisa
                              </option>
                              <option value="Dibatalkan">
                                Dibatalkan
                              </option>
                            </select>
                          </div>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">Tindakan</span>
                            </div>
                            <input type="text" name="tindakan" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                          </div>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">Biaya</span>
                            </div>
                            <input type="number" name="biaya" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                          </div>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">Catatan</span>
                            </div>
                            <!-- <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"> -->
                            <textarea name="catatan" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" ></textarea>
                          </div>

                        </div>
                        <!-- footer modal -->
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-success">Bisa Diambil</a>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                        </form>
                      </div>
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
                              <select class="form-control select_name" name="state"  style="width: 74.5%">
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
                            <button type="submit" class="btn btn-success">Save</a>
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
              <th scope="col">PEMILIK</th>
              <th scope="col">TGL TERIMA</th>
              <th scope="col" style="text-align: center;">JENIS</th>
              <th scope="col">MERK</th>
              <th scope="col">MODEL/SERI</th>
              <th scope="col">KELENGKAPAN</th>
              <th scope="col">KERUSAKAN</th>
              <th scope="col" style="text-align: center;">TOOLS</th>
            </tr>
          </thead>
          <tbody>

           <?php
           include "koneksi.php";
           $tampil = "SELECT * FROM view_proses_service WHERE status='proses'";
           $sv = mysqli_query ($conn, $tampil);
                    // var_dump($conn->query("SELECT * FROM tbl_proses_service WHERE status='proses'"));
           $no = 1;
           foreach($sv as $service){                        
            ?>


            <td><?php echo $no ?></td>
            <td><?php echo $service['id'];?></td>
            <td data-toggle="tooltip" data-placement="bottom" title="<b>No Hp :</b> <em><?php echo $service['no_hp'];?></em><br><b>Alamat :</b> <em><?php echo $service['alamat'];?>" data-html="true"><?php echo $service['nama_pelanggan'];?></td>
              <td><?php echo $service['tgl_terima'];?></td>
              <td><?php echo $service['jenis_barang'];?></td>
              <td><?php echo $service['merk'];?></td>
              <td
              data-toggle="tooltip" data-placement="bottom" title="<b>SN : </b> <em><?php echo $service['sn'];?>" data-html="true"><?php echo $service['model_seri'];?>
            </td>
            <!-- <td><?php echo $service['sn'];?></td> -->
            <td><?php echo $service['kelengkapan'];?></td>
            <td><?php echo $service['kerusakan'];?></td>


            <td align="right">
              <a href="proses_bisa_diambil.php?bsdambl=<?php echo $service['id'];?>" type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalfinish<?php echo $service['id'];?>">✔</a>
              <a href="proses_ubah_daftar_service.php?id=<?php echo $service['id'];?>" style="font-size: 14px" type="button" class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#modaledit<?php echo $service['id'];?>">📝</a>
              <a href="hapus_prosesservice.php?id=<?php echo $service['id'];?>" type="button" class="btn btn-danger btn-sm" onclick="return confirm('yakin mau di hapus?')">🗑️</a>
              <a href="print_proses_service.php?id=<?php echo $service['id'] ?>" target="_BLANK" style="font-size: 14px" type="button" class="btn btn-success btn-sm">🖨️</a>

              <div id="modalfinish<?php echo $service['id'];?>" class="modal fade" role="dialog">
                <div class="modal-dialog">
                  <!-- konten modal-->
                  <div class="modal-content">
                    <!-- heading modal -->
                    <div class="modal-header">
                      <h4 class="modal-title">FORM BARANG BISA DIAMBIL</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- body modal -->
                    <div class="modal-body">
                      <form action="proses_bisa_diambil.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $service['id'];?>">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">Nama</span>
                          </div>
                          <input type="text" name="nama_dll" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $service['nama_pelanggan'].",".$service['jenis_barang'].",".$service['merk'].",".$service['model_seri'].",".$service['sn'];?>"readonly>
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
                          <!-- <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"> -->
                          <select name="kondisi" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            <option value="Sudah Jadi">
                              Sudah Jadi
                            </option>
                            <option value="Tidak Bisa">
                              Tidak Bisa
                            </option>
                            <option value="Dibatalkan">
                              Dibatalkan
                            </option>
                          </select>
                        </div>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">Tindakan</span>
                          </div>
                          <input type="text" name="tindakan" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">Biaya</span>
                          </div>
                          <input type="number" name="biaya" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">Catatan</span>
                          </div>
                          <!-- <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"> -->
                          <textarea name="catatan" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" ></textarea>
                        </div>

                      </div>
                      <!-- footer modal -->
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Bisa Diambil</a>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                      </form>
                    </div>
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
                        <form action="proses_ubah_daftar_service.php" method="POST">
                          <input type="hidden" name="id_service" value="<?php echo $service['id'];?>">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" style="width: 118px" id="inputGroup-sizing-default">Nama</span>
                            </div>
                            <select class="form-control select_name" name="state"  style="width: 74.5%">
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
                          <button type="submit" class="btn btn-success">Save</a>
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

<div id="myModal" class="modal fade" role="dialog">

  <div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
      <!-- heading modal -->
      <div class="modal-header">
        <h4 class="modal-title">FORM TERIMA SERVICE</h4>
        <br>

        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- body modal -->
      <div class="modal-body">
        <form action="proses_service.php" method="POST">
          <input type="hidden" name="id_service" value="<?php echo uniqid() ?>">
          <div class="input-group mb-3">
            <div class="input-group-prepend">

              <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">Pemilik</span>
            </div>
            <!-- <input type="text" name="nama" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"> -->
            <select class="form-control select_name" name="state"  style="width: 74.5%">
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
              <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">Jenis Barang</span>
            </div>
            <input type="text" class="form-control" name="jenis_barang" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">Merk</span>
            </div>
            <input type="text" class="form-control" name="merk" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">Model/Seri</span>
            </div>
            <input type="text" class="form-control" name="model_seri" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">SN</span>
            </div>
            <input type="text" class="form-control" name="sn" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">Kelengkapan</span>
            </div>
            <input type="text" class="form-control" name="klgkpn" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default" style="width: 118px">Kerusakan</span>
            </div>
            <input type="text" class="form-control" name="kerusakan" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
          </div>
          <input type="hidden" name="status" value="proses">

        </div>
        <!-- footer modal -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

        </div>
      </form>
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