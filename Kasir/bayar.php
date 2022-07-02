<?php
	$kode = $_GET['ID'];
	require '../koneksi.php';
	$hsl = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tagihan WHERE IDpelanggan=$kode AND Bayar='B'"));
	if ($hsl > 0){
		echo "Pembayaran Sukses!";
	} else{	
		echo "Pembayaran Sudah Dilakukan";
	}
	$mysqli->close();
?>
