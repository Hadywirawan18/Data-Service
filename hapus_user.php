<?php

include "koneksi.php";
$hapus = $conn->query("DELETE FROM tbl_user WHERE username='".$_GET['usr']."'");
?>

<script>
document.location = 'user.php'
</script>