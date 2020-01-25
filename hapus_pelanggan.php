<?php

include "koneksi.php";
$hapus = $conn->query("DELETE FROM tbl_pelanggan WHERE no_hp ='".$_GET['pelgn']."'");
?>

<script>
document.location = 'daftar_pelanggan.php'
</script>