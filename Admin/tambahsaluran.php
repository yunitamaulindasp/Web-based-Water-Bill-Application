<?php
	if (($_POST['nama'] != "") || ($_POST['alamat'] != ""))
	{
		$nama = strtoupper($_POST['nama']);
		$alamat = strtoupper($_POST['alamat']);
		$kec = $_POST['Kecamatan'];
		$desa = $_POST['dk'];
		$tarif = $_POST['tarif'];
		
		require("../koneksi.php");	
		
		$query = "INSERT INTO pelanggan (Nama, Alamat, IDwilayah, IDtarif) VALUES ('$nama', '$alamat', '$desa', '$tarif')";
		$hasil = $mysqli->query($query);
		if (!$hasil)
		{	echo "Eror: " . $mysqli->error;
		}
		else
		{	
			$query1 = "SELECT * FROM kecamatan WHERE IDkecamatan=$kec";
			$hasil1 = $mysqli->query($query1);
			$arData = $hasil1->fetch_array();
			
			$query2 = "SELECT * FROM wilayah WHERE IDwilayah=$desa";
			$hasil2 = $mysqli->query($query2);
			$arData2 = $hasil2->fetch_array();
			
			$query3 = "SELECT * FROM kategori WHERE IDtarif=$tarif";
			$hasil3 = $mysqli->query($query3);
			$arData3 = $hasil3->fetch_array();
			
			echo "<table width='100%' border='0'>";
			echo "<tr><td>Nama :</td><td>$nama</td></tr>";
			echo "<tr><td>Alamat :</td><td>$alamat, ".$arData2['desa'].", Kec. ".$arData['kecamatan']."</td></tr>";
			echo "<tr><td>Kategori :</td><td>".$arData3['kategori']."</td></tr>";
			echo "</table>";
		}
		$mysqli->close();
	}
	else
	{
		die("");
	}
?>
