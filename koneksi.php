<?php
	$server = "#";
	$user = "root";
	$password = "";
	$database = "pdam";
	$mysqli = new mysqli($server, $user, $password, $database);
	$koneksi = mysqli_connect($server, $user, $password, $database);
	if ($mysqli->connect_error)
	{ die("Koneksi gagal: " . $mysqli->connect_error);
	}
?>
