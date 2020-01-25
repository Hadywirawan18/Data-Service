<?php


$conn = mysqli_connect("localhost","root","","db_dataservice");

// Check connection
if (mysqli_connect_error()){
	echo "Koneksi database gagal : " . mysqli_connect_error($conn);
}


?>
