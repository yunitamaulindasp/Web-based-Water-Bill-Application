<?php
	if (!isset($_POST["username"]) || !isset($_POST["pass"]))
	{	die("");
	}
	$username = $_POST["username"];
	$passw = md5($_POST["pass"]);
	
	require("koneksi.php");
	$query = "SELECT * FROM pegawai WHERE Nama='$username' AND Password='$passw'";
	$hasil = $mysqli->query($query) or die ("Error: ". $mysqli->error);
	if ($hasil->num_rows > 0)
	{	$data = $hasil->fetch_row();
		
		$nama = $data[1];
		$status = $data[2];
		
		echo $status;
		
		session_start();
		$_SESSION['nama'] = $nama;
		$_SESSION['status'] = $status;
		
	}
	else
	{	echo '';
	}
	$mysqli->close();
?>
