<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.css">
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<style>
		.hide {
			opacity: 0;
		}
	</style>
</head>
<div class="hide">
<?php
session_start();
if ($_SESSION ['user_login']) {
  echo "<script> alert('Anda Wah Login !')
  document.location = 'daftar_service.php'
  </script>";

  }else{
  	?>
</div>
<body background="gambar/8.jpg">
	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4 font-weight-bold"><br><br><h2 style="text-align: center; color: blue;">WELCOME TO DATA SERVICE</h2><br><br><br> <br> </div>
	</div>    
	<div class="row">
		<div class="col-sm-4">
		</div>
		<div class="col-sm-4">
			<h2 class="page-header">Login</h2>
			<form method="POST" action="PLogin.php" onsubmit="return validateForm()">
				<div class="form-group">
					<label>USERNAME</label><br>
					<input type="text" name="username" class="form-control" placeholder="Username">
					<label>PASSWORD</label><br>
					<input type="password" name="password" class="form-control" placeholder="Password">
					<br>
					<button type="submit" class="btn btn-success">LOGIN</button>
					<button type="button" class="btn btn-danger">CANCEL</button>
				</div>	
			</form>
		</div>
		<div class="col-sm-4">
		</div>		
	</div>	
</div>
</body>
</html>
<?php
}
?>