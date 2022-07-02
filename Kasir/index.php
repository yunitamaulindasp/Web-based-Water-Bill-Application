<?php
	include ('../koneksi.php');
	session_start();

	if (!isset($_SESSION['status'])){
		echo "<script>window.location.replace('../login.php')</script>";
		die();
	}
?>
<!doctype html>
<html lang="en">
	<link rel="shortcut icon" type="image/x-icon" href="dist/logo/logo2.png">
	<head>
		<title>Halaman Kasir</title>
	</head>
	<body>
		<?php
			if (isset($_GET['kode'])){
				$kode = $_GET['kode'];
				if ($kode == 'dasboard')
				{	include('kasir.php');
				}
				else if ($kode == 'rincian')
				{	include('tabelpelanggan.php');
				}
				else if ($kode == 'bayar')
				{	include('bayar.php');
				}
				else if ($kode == 'cek')
				{	include('cekbayar.php');
				}
			}
		?>
	</body>
</html> 
