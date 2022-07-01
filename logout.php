<?php
	session_start();
	if (!isset($_SESSION['status']))
	{	echo "<script>alert('Anda belum login, silakan login lebih dulu')</script>";
		echo "<script>window.location.replace('login.php')</script>";
		die();
	}
	session_destroy();
	echo "<script>alert('Terimakasih')</script>";
	echo "<script>window.location.replace('login.php')</script>";
?>
