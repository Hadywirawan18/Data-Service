<?php

include "koneksi.php";





$id = $_POST['id'];
$kondisi = $_POST['kondisi'];
$tindakan = $_POST['tindakan'];
$biaya = $_POST['biaya'];
$catatan = $_POST['catatan'];
$tgl_dikerjakan = date("Y-m-d");
$status = 'selesai';




$simpan = "UPDATE tbl_proses_service SET kondisi='".$kondisi."', tindakan='".$tindakan."', biaya = '".$biaya."',
catatan = '".$catatan."', tgl_dikerjakan= '".$tgl_dikerjakan."', status = '".$status."' WHERE id='".$id."'";


if (mysqli_query($conn,$simpan)) {
	echo "<script language = 'JavaScript'> 
	alert('Data Saved!');
	document.location = 'barang.php'
	</script>";
}else{
	echo "Error !".mysqli_error($conn);

}