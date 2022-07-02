<?php
	$idnama = $_GET['ID'];
	require '../koneksi.php';

	$sql = "SELECT * FROM pegawai WHERE IDuser='$idnama'";
	$hasil = $mysqli->query($sql) or die("Error: " . $mysqli->error);
	$arData = $hasil->fetch_array();
	$nama = $arData['Nama'];
	if ($hasil->num_rows == 0){
		die("User $nama tidak ditemukan!");
	}
	$sql = "DELETE FROM pegawai WHERE IDuser='$idnama'";
	$hasil = $mysqli->query($sql) or die("Error: " . $mysqli->error);
	if ($mysqli->affected_rows > 0){
		echo "<script> alert('User $nama berhasil dihapus');
		window.location.href = '?kode=akses'</script>";
	} else{
		echo "<script> alert('Pengguna $nama gagal dihapus');
		window.location.href = '?kode=akses'</script>";
	}
	$mysqli->close();
?>
