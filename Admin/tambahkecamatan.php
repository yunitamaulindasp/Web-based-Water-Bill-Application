<?php
	if ($_POST['kecamatan'] != "")
	{	
		$kec1 = strtoupper($_POST['kecamatan']);
		$kec = strip_tags($kec1);
		require("../koneksi.php");
		$hsl = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kecamatan WHERE kecamatan='$kec'"));
		if ($hsl == 0)
		{	
			$query = "INSERT INTO kecamatan (Kecamatan) VALUES ('$kec')";
			$hasil = $mysqli->query($query);
			if (!$hasil)
			{	echo "Eror: " . $mysqli->error;	}
			else
			{	
				echo "<table width='100%' border='0'>";
				echo "<tr><td>Kecamatan </td><td>: $kec</td></tr>";
				echo "</table>";
			}
			$mysqli->close();
		}
		else
		{	die("Kecamatan Sudah Didaftarkan");	}
	}
	else
	{
		die("");
	}
?>
