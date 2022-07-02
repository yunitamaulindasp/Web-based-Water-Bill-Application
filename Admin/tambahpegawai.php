<?php
	if (($_POST['nama'] != "") || ($_POST['pass'] != "")){
		$nama =  strtolower($_POST['nama']);
		$status = $_POST['status'];
		$passw = $_POST['pass'];
		$pass = md5($passw);
		
		require("../koneksi.php");
		$hsl = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pegawai WHERE Nama='$nama'"));
		if ($hsl == 0){
			$query = "INSERT INTO pegawai (Nama, Status, Password) VALUES ('$nama', '$status', '$pass')";
			$hasil = $mysqli->query($query);
			if (!$hasil){
				echo "Eror: " . $mysqli->error;
			} else{	
				echo "<table width='100%' border='0'>";
				echo "<tr><td>Nama</td><td>: $nama</td></tr>";
				echo "<tr><td>Status Kepegawaian</td><td>: $status PDAM</td></tr>";
				echo "</table>";
			}
			if ($status == 'Cater'){
				$sql = "INSERT INTO cater (Nama, Target, Dapat) VALUES ('$nama', '200', '0')";
				$hsl = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
			}
			$mysqli->close();
		} else{
			die("Username Sudah Didaftarkan");	}
	} else{
		die("");
	}
?>
