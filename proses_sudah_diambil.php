<?php

include "koneksi.php";





$id = $_POST['id_service'];
$garansi = $_POST['garansi'];
$pengambil = $_POST['pengambil'];
$tgl_diambil = date("Y-m-d");
$status = 'diambil';




$simpan = "UPDATE tbl_proses_service SET tgl_ambil= '".$tgl_diambil."', garansi= '".$garansi."', status = '".$status."', pengambil = '".$pengambil."' WHERE id='".$id."'";


if (mysqli_query($conn,$simpan)) {
	echo "<script language = 'JavaScript'> 
	alert('Data Saved!');
	 document.location = 'sudah_diambil.php'
	</script>";
}else{
	echo "Error !".mysqli_error($conn);

}