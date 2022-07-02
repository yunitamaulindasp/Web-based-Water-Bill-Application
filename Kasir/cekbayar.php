<?php
	$kode = $_GET['ID'];
	$_SESSION['saluran']=$kode;
	echo "<script>window.location.href = 'cetak.php'</script>"
?>
