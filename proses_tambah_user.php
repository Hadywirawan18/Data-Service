<?php

include "koneksi.php";




$nm = addslashes($_POST['nama']); 
$usrnm = $_POST['username'];
$pass = $_POST['password'];


 

$simpan = "INSERT INTO tbl_user (username,nama,password)  
VALUES ('$usrnm','$nm', '$pass')";

var_dump($simpan);

if (mysqli_query($conn,$simpan)) {
	echo "<script language = 'JavaScript'> 
    alert('Data Saved!');
    document.location = 'user.php'
    </script>";
}else{
    echo "Error !".mysqli_error($conn);

}