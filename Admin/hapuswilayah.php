<?php
	$iddesa = $_GET['ID'];
	require '../koneksi.php'; 
	
	$sql = "SELECT * FROM wilayah WHERE IDwilayah='$iddesa'";
	$hasil = $mysqli->query($sql) or die("Error: " . $mysqli->error);
	$arData = $hasil->fetch_array();
	$nama = $arData['desa'];
	if ($hasil->num_rows == 0){
		die("Wilayah $nama tidak ditemukan!");
	}
	$sql = "DELETE FROM wilayah WHERE IDwilayah='$iddesa'";
	$hasil = $mysqli->query($sql) or die("Error: " . $mysqli->error);
	if ($mysqli->affected_rows > 0){
		echo "<script> alert('Wilayah $nama berhasil dihapus');
		window.location.href = '?kode=tampilwilayah'</script>";
	} else{
		echo "<script> alert('Wilayah $nama gagal dihapus');
		window.location.href = '?kode=tampilwilayah'</script>";
	}
	$mysqli->close();
?>
