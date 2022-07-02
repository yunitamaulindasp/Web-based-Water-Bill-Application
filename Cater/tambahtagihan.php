<?php
	$saluran = $_POST['saluran'];
	$tagihan = $_POST['tagihan'];
	
	require("../koneksi.php");

	$sql = "SELECT * FROM pelanggan INNER JOIN kategori ON pelanggan.IDtarif=kategori.IDtarif WHERE pelanggan.IDsaluran=$saluran";
	$hsl = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
	$arData = $hsl->fetch_array();
	$harga = $arData['tarif'];
	
	$total = $harga * $tagihan;
	
	$query = "INSERT INTO tagihan (Periode, IDpelanggan, Pakai, Tagihan, Bayar) VALUES (now(), '$saluran', '$tagihan', '$total', 'B')";
	$hasil = $mysqli->query($query) or die ("Error: ". $mysqli->error);
	
	$sql1 = "SELECT * FROM cater WHERE IDuser=1";
	$hsl1 = $mysqli->query($sql1) or die ("Error: ". $mysqli->error);
	$arData = $hsl1->fetch_array();
	
	$banyak = $arData['Dapat'];
	$tambah = $banyak + 1;
	
	$query1 = "UPDATE cater SET Dapat='$tambah' WHERE IDuser=1 ";
	$hasil1 = $mysqli->query($query1) or die ("Error: ". $mysqli->error);
	
	$mysqli->close();
?>
