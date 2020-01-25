<?php

include "koneksi.php";




$nm = addslashes($_POST['nama']); 
$nhp = $_POST['nohp'];
$almt = $_POST['almt'];


 

$simpan = "INSERT INTO tbl_pelanggan (nama_pelanggan,no_hp,alamat)  
VALUES ('$nm','$nhp', '$almt')";

var_dump($simpan);

if (mysqli_query($conn,$simpan)) {
	echo "<script language = 'JavaScript'> 
    alert('Data Saved!');
    document.location = 'daftar_pelanggan.php'
    </script>";
}else{
    echo "Error !".mysqli_error($conn);

}