<?php

include "koneksi.php";





$id = $_POST['id_service'];
// $tampung = $_POST['state'];
$tgl = date("Y-m-d");
$jenis_barang = $_POST['jenis_barang'];
$model_seri = $_POST['model_seri']; 
$sn = $_POST['sn']; 
$merk = $_POST['merk'];
$klgkpn = $_POST['kelengkapan'];
$kerusakan = $_POST['kerusakan']; 
// $meledak = explode(',' , $tampung);
// $nm = $meledak[0];
$status = $_POST['status'];
// $phone = $meledak[1];

// $simpan = "UPDATE tbl_user SET nama='".$nm."', password='".$pass."' WHERE username='".$usrnm."'";

$simpan = "UPDATE tbl_proses_service SET tgl_terima='".$tgl."', jenis_barang = '".$jenis_barang."',
merk = '".$merk."', model_seri= '".$model_seri."', sn = '".$sn."', kelengkapan = '".$klgkpn."', kerusakan = '".$kerusakan."', status = '".$status."' WHERE id='".$id."'";


if (mysqli_query($conn,$simpan)) {
	echo "<script language = 'JavaScript'> 
	alert('Data Updated!');
	document.location = 'daftar_service.php'
	</script>";
}else{
	echo "Error !".mysqli_error($conn);

}