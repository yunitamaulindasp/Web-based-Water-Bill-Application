<?php
	if ($_POST['desa'] != "")
	{
		$kecamatan = $_POST['Kecamatan'];
		
		$desa = strtoupper($_POST['desa']);
		$desa1 = strip_tags($desa);
		
		require("../koneksi.php");
		$hsl = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM wilayah WHERE desa='$desa1'"));
		if ($hsl == 0) 
		{
			$query = "INSERT INTO wilayah (IDkec, desa) VALUES ('$kecamatan', '$desa1')";
			$hasil = $mysqli->query($query);
			if (!$hasil)
			{	echo "Eror: " . $mysqli->error;	}
			else
			{	
				$add = "SELECT kecamatan FROM kecamatan WHERE IDkecamatan=$kecamatan";
				$hsl = $mysqli->query($add);
				$arData = $hsl->fetch_array();
				$kec = $arData['kecamatan'];
		
				echo "<table width='100%' border='0'>";
				echo "<tr><td>Kecamatan </td><td>: $kec</td></tr>";
				echo "<tr><td>Desa/Kelurahan </td><td>: $desa</td></tr>";
				echo "</table>";
			}
			$mysqli->close();
		}
		else
		{	die("Wilayah Sudah Didaftarkan");	}
	}
	else
	{	die("");	}
?>
