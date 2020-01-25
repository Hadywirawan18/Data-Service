<?php

include "koneksi.php";



$nm = addslashes($_POST['nama_pelanggan']); 
$noHp = $_POST['no_hp'];
$alamat = addslashes ($_POST['almt']);

$simpan = "UPDATE tbl_pelanggan SET nama_pelanggan='".$nm."', alamat='".$alamat."'  WHERE no_hp='".$noHp."'";



if (mysqli_query($conn,$simpan)){

    echo "<script language = 'JavaScript'> 
    alert('Data Updated!');
    document.location = 'daftar_pelanggan.php'
    </script>";
}else{
    echo "Error !".mysqli_error($conn);
}

?>
