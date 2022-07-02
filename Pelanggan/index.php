<!doctype html>
<html class="no-js" lang="zxx">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">

		<title>Halaman Pelanggan</title>

		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" type="image/x-icon" href="assets/img/logo/logo2.png">

		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/owl.carousel.min.css">
		<link rel="stylesheet" href="assets/css/slicknav.css">
		<link rel="stylesheet" href="assets/css/flaticon.css">
		<link rel="stylesheet" href="assets/css/progressbar_barfiller.css">
		<link rel="stylesheet" href="assets/css/gijgo.css">
		<link rel="stylesheet" href="assets/css/animate.min.css">
		<link rel="stylesheet" href="assets/css/animated-headline.css">
		<link rel="stylesheet" href="assets/css/magnific-popup.css">
		<link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
		<link rel="stylesheet" href="assets/css/themify-icons.css">
		<link rel="stylesheet" href="assets/css/slick.css">
		<link rel="stylesheet" href="assets/css/nice-select.css">
		<link rel="stylesheet" href="assets/css/style.css">

		<script src="../Web/bootbox/bootbox.min.js"></script>
	</head>
	<body>
		<div id="preloader-active">
			<div class="preloader d-flex align-items-center justify-content-center">
				<div class="preloader-inner position-relative">
					<div class="preloader-circle"></div>
					<div class="preloader-img pere-text">
						<img src="assets/img/logo/logo2.png" alt="">
					</div>
				</div>
			</div>
		</div>
		<header>
			<div class="header-area header-transparent">
				<div class="main-header header-sticky">
					<div class="container-fluid">
						<div class="menu-wrapper d-flex align-items-center justify-content-between">
							<div class="logo">
								<a href="?kode=dasboard"><img src="assets/img/logo/logo2.png" alt=""></a>
							</div>
							<div class="main-menu f-right d-none d-lg-block">
								<nav>
									<ul id="navigation">
										<li><a href="http://pdamkotabatu.com/">Tentang PDAM</a></li>
									</ul>
								</nav>
							</div>
							<div class="col-12">
								<div class="mobile_menu d-block d-lg-none"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
		<main>
			<?php
				if (isset($_GET['kode']))
				{	$kode = $_GET['kode'];
					if ($kode == 'dasboard')
					{	include('default.php');
					}
					else if ($kode == 'rincian')
					{	include('riwayat.php');
					}
					else if ($kode == 'pop')
					{	include('pop-up.php');
					}
				}
			?>
		</main>
		<footer>
			<div class="footer-wrappr  section-bg">
				<div class="footer-area">
					<div class="container">
						<div class="row d-flex justify-content-between">
							<div class="col-xl-2 col-lg-2 col-md-4 col-sm-5">
								<div class="single-footer-caption mb-50">
									<div class="footer-tittle">
										<h4>Lainnya</h4>
										<ul>
											<li><a href="http://pdamkotabatu.com/pengaduanku/">Pengaduan</a></li>
											<li><a href="http://pdamkotabatu.com/srku/">Pasang Saluran Baru</a></li>
											<li><a href="http://pdamkotabatu.com/">Tentang PDAM</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
								<div class="single-footer-caption mb-50">
									<div class="footer-logo mb-25">
										<img src="assets/img/logo/logo2.png" alt=""></a>
									</div>
									<div class="footer-tittle mb-25">
										<h4>Hubungi Kami</h4>
										<p>Kantor Pusat</p>
										<p>JL R.A. Kartini No. 20 Batu 65311</p>
									</div>
									<div class="footer button-group-area mt-10">
										<ul>
											<li><a href="#" class="genric-btn default circle"><i class="fa fa-tty"></i> (0341) 591034</a></li>
											<li><a href="#" class="genric-btn default circle"><i class="fas fa-fax"></i> (0341) 512977 (fax)</a></li>
											<li><a href="#" class="genric-btn default circle"><i class="fas fa-comments"></i> 081 321 333 111</a></li>
											<li><a href="#" class="genric-btn default circle"><i class="fa fa-envelope"></i> pdamkotabatu@gmail.com</a></li>
										</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-bottom-area">
				<div class="container">
					<div class="footer-border">
						<div class="row">
							<div class="col-xl-10 ">
								<div class="footer-copy-right">
									<p>Copyright &copy; PDAM Among Tirto Kota Batu</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			</div>
		</footer>
		<div id="back-top" >
			<a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
		</div>

		<script src="assets/js/vendor/modernizr-3.5.0.min.js"></script>
		<script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/jquery.slicknav.min.js"></script>
		<script src="assets/js/owl.carousel.min.js"></script>
		<script src="assets/js/slick.min.js"></script>
		<script src="assets/js/wow.min.js"></script>
		<script src="assets/js/animated.headline.js"></script>
		<script src="assets/js/jquery.magnific-popup.js"></script>
		<script src="assets/js/gijgo.min.js"></script>
		<script src="assets/js/jquery.nice-select.min.js"></script>
		<script src="assets/js/jquery.sticky.js"></script>
		<script src="assets/js/jquery.barfiller.js"></script>
		<script src="assets/js/jquery.counterup.min.js"></script>
		<script src="assets/js/waypoints.min.js"></script>
		<script src="assets/js/jquery.countdown.min.js"></script>
		<script src="assets/js/hover-direction-snake.min.js"></script>
		<script src="assets/js/contact.js"></script>
		<script src="assets/js/jquery.form.js"></script>
		<script src="assets/js/jquery.validate.min.js"></script>
		<script src="assets/js/mail-script.js"></script>
		<script src="assets/js/jquery.ajaxchimp.min.js"></script>
		<script src="assets/js/plugins.js"></script>
		<script src="assets/js/main.js"></script>
		<script src="../Web/bootbox/bootbox.min.js"> </script>
	</body>
</html>
