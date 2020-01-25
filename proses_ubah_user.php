<?php

include "koneksi.php";



$nm = addslashes($_POST['nama']); 
$usrnm = $_POST['usrnm'];
$pass = $_POST['password'];

$simpan = "UPDATE tbl_user SET nama='".$nm."', password='".$pass."' WHERE username='".$usrnm."'";



if (mysqli_query($conn,$simpan)){

    echo "<script language = 'JavaScript'> 
    alert('Data Updated!');
    document.location = 'user.php'
    </script>";
}else{
    echo "Error !".mysqli_error($conn);
}

?>
