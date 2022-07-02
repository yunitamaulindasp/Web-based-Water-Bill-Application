<?php
	$idkec = $_GET['ID'];
	require '../koneksi.php';
	
	$sql = "SELECT * FROM kecamatan WHERE IDkecamatan='$idkec'";
	$hasil = $mysqli->query($sql) or die("Error: " . $mysqli->error);
	$arData = $hasil->fetch_array();
	$nama = $arData['kecamatan'];
	if ($hasil->num_rows == 0){
		die("Kecamatan $nama tidak ditemukan!");
	}
	$sql = "DELETE FROM kecamatan WHERE IDkecamatan='$idkec'";
	$hasil = $mysqli->query($sql) or die("Error: " . $mysqli->error);
	if ($mysqli->affected_rows > 0){
		echo "<script> alert('Kecamatan $nama berhasil dihapus');
		window.location.href = '?kode=tampilkecamatan'</script>";
	} else{
		echo "<script> alert('Kecamatan $nama gagal dihapus');
		window.location.href = '?kode=tampilkecamatan'</script>";
	}
	$mysqli->close();
?>
