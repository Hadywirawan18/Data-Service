<?php
include 'koneksi.php';



$username 	= $_POST['username'];
$password 	= $_POST['password'];

//enkripsi passowrd yg dimasukkan ke md5 dan atau sha1

// $ency 	= md5($password);
// $ency 	= sha1($password);

$cek_admin 	= $conn->query("SELECT * FROM tbl_user WHERE username = '$username' AND password = '$password'");
$arr = mysqli_fetch_array($cek_admin);
$nama = $arr['nama'];

if (($cek_admin->num_rows ==1)) {
	session_start();
	//variable session
	$_SESSION ['user_login'] = $username;
	$_SESSION['nama'] = $nama;
	?>
	<script> alert('Selamat Datang!');
	document.location = "daftar_service.php";
</script>
<?php
	

}else{
	?>
	<script> alert('Gagal Login !');
	document.location = "index.php";
</script>
<?php
}