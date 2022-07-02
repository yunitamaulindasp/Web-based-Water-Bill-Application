<?php
	$ID = $_POST['saluran'];
	session_start();
	if(isset($_POST["captcha"])&&$_POST["captcha"]!=""&&$_SESSION["code"]==$_POST["captcha"]){
		header("location:index.php?kode=rincian&ID=$ID");
	} else{
		echo "<script>alert('Kode Yang Kamu Masukkan Salah !!');window.history.go(-1);</script>";
	}
?>
