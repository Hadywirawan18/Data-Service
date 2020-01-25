<?php

include "koneksi.php";





$id = $_POST['id_service'];
$tgl = date("Y-m-d");
$tampung = $_POST['state'];
$meledak = explode(',' , $tampung);
$nm = $meledak[0]; 
$phone = $meledak[1];
$jenis_barang = $_POST['jenis_barang']; 
$model_seri = $_POST['model_seri']; 
$sn = $_POST['sn']; 
$merk = $_POST['merk'];
$klgkpn = $_POST['klgkpn'];
$kerusakan = $_POST['kerusakan'];
$status = $_POST['status']; 




$simpan = "INSERT INTO tbl_proses_service (id,tgl_terima,jenis_barang,merk,model_seri,sn,kelengkapan,kerusakan,no_hp,status)  
VALUES ('$id','$tgl', '$jenis_barang','$merk','$model_seri','$sn','$klgkpn','$kerusakan','$phone','$status')";


if (mysqli_query($conn,$simpan)) {
	echo "<script language = 'JavaScript'> 
	alert('Data Saved!');
	document.location = 'daftar_service.php'
	</script>";
}else{
	echo "Error !".mysqli_error($conn);

}