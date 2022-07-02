<?php
	session_start();
	function randomPassword(){
		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
   		$pass = array(); 
		$alphaLength = strlen($alphabet) - 1; 
		for ($i = 0; $i < 4; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); 
	}
	$code = randomPassword();
	$_SESSION["code"]=$code;
	$im = imagecreatetruecolor(100, 50);
	$bg = imagecolorallocate($im, 22, 86, 165);
	$fg = imagecolorallocate($im, 255, 255, 255);
	imagefill($im, 0, 0, $bg);
	imagestring($im, 5, 30, 15,  $code, $fg);
	header("Cache-Control: no-cache, must-revalidate");
	header('Content-type: image/png');
	imagepng($im);
	imagedestroy($im);
?>
