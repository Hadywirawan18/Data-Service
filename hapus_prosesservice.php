<?php

include "koneksi.php";
$hapus = $conn->query("DELETE FROM tbl_proses_service WHERE id ='".$_GET['id']."'");
?>

<script>
document.location = 'daftar_service.php'
</script>