<?php
	$jenis = $_POST['Bangunan'];
	$harga = $_POST['tarif'];
	$denda = $_POST['denda'];
	$admin = $_POST['admin'];
	
	require("../koneksi.php");
	session_start();
	$query = "UPDATE kategori SET Tarif='$harga', Denda='$denda', Admin='$admin' WHERE IDtarif='$_SESSION[ID]' ";
	$hasil = $mysqli->query($query);
	if (!$hasil){
		echo "Error: " . $mysqli->error;
	} else if ($mysqli->affected_rows == 0){
		echo "Data tidak berubah";
	} else{
		echo "<table width='100%' border='0'>";
		echo "<tr><td>Jenis Bangunan </td><td>: $jenis</td></tr>";
		echo "<tr><td>Tarif per-Kubik </td><td>: Rp. ".number_format($harga,0,',','.')." /kubik</td></tr>";
		echo "<tr><td>Denda Terlambat Bayar </td><td>: Rp. ".number_format($denda,0,',','.')." /bulan</td></tr>";
		echo "<tr><td>Biaya Jasa Administrasi </td><td>: Rp. ".number_format($admin,0,',','.')." </td></tr>";
		echo "</table>";
	}
	$mysqli->close();
?>
