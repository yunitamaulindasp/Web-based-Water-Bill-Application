<?php
	if (($_POST['Bangunan'] != "") || ($_POST['tarif'] != "") || ($_POST['denda'] != "") || ($_POST['admin'] != "")){
		$jns = strtoupper($_POST['Bangunan']);
		$jenis = strip_tags($jns);
		$harga = $_POST['tarif'];
		$denda = $_POST['denda'];
		$admin = $_POST['admin'];
		
		require("../koneksi.php");
		$hsl = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kategori WHERE kategori='$jenis'"));
		if ($hsl == 0){
			$query = "INSERT INTO kategori (kategori, Tarif, Denda, Admin) VALUES ('$jenis', '$harga', '$denda', '$admin')";
			$hasil = $mysqli->query($query);
			if (!$hasil){
				echo "Eror: " . $mysqli->error;
			} else{
				echo "<table width='100%' border='0'>";
				echo "<tr><td>Jenis Bangunan </td><td>: $jenis</td></tr>";
				echo "<tr><td>Tarif per-Kubik </td><td>: Rp. ".number_format($harga,0,',','.')." /kubik</td></tr>";
				echo "<tr><td>Denda Terlambat Bayar </td><td>: Rp. ".number_format($denda,0,',','.')." /bulan</td></tr>";
				echo "<tr><td>Biaya Jasa Administrasi </td><td>: Rp. ".number_format($admin,0,',','.')." </td></tr>";
				echo "</table>";
			}
			$mysqli->close();
		} else{
			die("Kategori Sudah Didaftarkan");	}
	} else{
		die("");
	}
?>
