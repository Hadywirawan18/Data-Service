<?php
session_start();

if (!$_SESSION ['user_login']) {
  echo "<script> alert('Silahkan Login Dahulu!')
  document.location = 'index.php'
  </script>";

}else{
  ?>


<!DOCTYPE html>
<html>
<head>

	<style type="text/css">
		body {
			width: 100%;
			height: 100%;
			margin: 0;
			padding: 0;
			font: 12pt "Tahoma";
		}
		* {
			box-sizing: border-box;
			-moz-box-sizing: border-box;
		}
		.page {
			width: 210mm;
			min-height: 297mm;
			padding: 20mm;
			margin: 10mm auto;
			
			border-radius: 5px;
			background: white;
			box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
		}
		.subpage {
			padding: 1cm;
			height: 257mm;
			outline: 2cm #FFEAEA solid;
		}

		@page {
			size: A4;
			margin: 0;
		}
		@media print {
			html, body {
				width: 210mm;
				height: 297mm;        
			}
			.page {
				margin: 0;
				border: initial;
				width: initial;
				min-height: initial;
				box-shadow: initial;
				background: initial;
				page-break-after: always;
			}
		}
	</style>
	
</head>
<body>

	<?php
	include "koneksi.php";
	$sql = $conn->query("SELECT * FROM view_proses_service WHERE id='".$_GET['id']."'");
	$arr = mysqli_fetch_array($sql);
// var_dump($arr);
	?>
	<div class="book">
		<div class="page">
			<div class="subpage">
				<table align="right" border="0" cellpadding="1" style="font-size: 12px">
					<tr>
						<td style="font-size: 10px"><?php echo $arr['tgl_terima']?></td>
						<td align="center" colspan="3" style="font-size: 14px">TANDA TERIMA SERVICE <br><br><br></td>

					</tr>
					<tr>
						<td>Id</td>
						<td><?php echo ":".$arr['id'] ?></td>
						<td style="font-size: 12px; width: 50%"><strong>Universe IT Solution</strong></td>
					</tr>
					<tr>
						<td>Nama</td>
						<td><?php echo ":".$arr['nama_pelanggan']?></td>
						<td rowspan="2" style="font-size: 12px">Toko Komputer Menerima Service Laptop, PC, Printer Segala Merk
							Jl. Aneka No. 16 Dasan Agung Muhajirin
						Telpon atau Whatsapp di 082340371882</td>
					</tr>
					<tr>
						<td>No. HP</td>
						<td><?php echo ":".$arr['no_hp']?></td>
					</tr>
					<tr>
						<td colspan="3">-------------------------------------------------------------------------------------------------------------------------------</td>
					</tr>
				</table>
				<table style="font-size: 12px" border="0">
					<tr>
						<td style="width: 15%">Nama Barang</td>
						<td><?php echo ":".$arr['jenis_barang']?></td>
						<td>Perkiraan Biaya (Rp) :</td>
						<td style="width: 25%">....................................</td>
					</tr>
					<tr>
						<td>Model / Seri</td>
						<td><?php echo ":".$arr['model_seri']?></td>
						<td></td>
						<td style="width: 25%">....................................</td>
					</tr>
					<tr>
						<td>SN</td>
						<td><?php echo ":".$arr['sn']?></td>
						<td></td>
						<td style="width: 25%">....................................</td>
					</tr>
					<td>Kelengkapan</td>
					<td><?php echo ":".$arr['kelengkapan']?></td>
					<td>Keterangan Lain-lain :</td>
					<td style="width: 25%">....................................</td>
				</tr>
				<tr>
					<td>Kerusakan</td>
					<td><?php echo ":".$arr['kerusakan']?></td>
					<td></td>
					<td style="width: 25%">....................................</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td style="width: 25%">....................................</td>
				</tr>
				<tr>
					<td colspan="4">-------------------------------------------------------------------------------------------------------------------------------</td>
				</tr>
			</tr>
		</table>
		<table style="font-size: 10px" border="0">
			<tr>
				<td style="font-style: italic;">Terimakasih Atas Kepercayaan Anda Kepada Kami</td>
				<tr>
					<td style="font-style: italic;">Barang Yang Tidak Diambil Lebih Dari 3 Bulan, Bukan Tanggung Jawab Kami !</td>
					<td width="20%" style="text-align: center;"><b>Penerima</b></td>
					<td width="20%" style="text-align: center;"><b>Pemilik</b></td>
				</tr>
				<tr>
					<td style="font-style: italic;">Nota Ini Adalah Bukti Sah Untuk Pengambilan Barang</td>
				</tr>
				<tr>
					<td style="font-style: italic;">Jika Ingin Membatalkan, Maka Wajib Terkena Biaya Pengecekan</td>
				</tr>
				<tr>
					<td style="font-style: italic;">Sebesar Rp. 25.000</td>
					<td style="text-align: center;"><?php echo $_SESSION['nama'] ?></td>
					<td style="text-align: center;"><?php echo $arr['nama_pelanggan']?></td>
				</tr>
			</tr>
		</table>
	</div>    
</div>
</div>










	<script>
		window.print();
	</script>
</body>
</html>

<?php
}
?>