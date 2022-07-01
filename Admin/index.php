<?php
	require '../koneksi.php';
	session_start();
	
	if (!isset($_SESSION['status']))
	{	echo "<script>window.location.replace('../login.php')</script>";
		die();
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Halaman Admin</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="shortcut icon" type="image/x-icon" href="dist/logo/logo2.png">

		<link rel="stylesheet" type="text/css" href="./dist/css/adminx.css" media="screen" />
		<link rel="stylesheet" href="../Web/datatables/dataTables.bootstrap4.min.css" />
    		
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script src="../Web/bootbox/bootbox.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
	</head>
	
	<body>
		<div class="adminx-container">
			
			<nav class="navbar navbar-expand justify-content-between fixed-top">
				<a class="navbar-brand mb-0 h1 d-none d-md-block" href="?kode=dasboard">
					<i data-feather="server"></i>
					Perumdam Among Tirto Kota Batu
				</a>
				<div class="d-flex flex-1 d-block d-md-none">
					<a href="#" class="sidebar-toggle ml-3">
						<i data-feather="menu"></i>
					</a>
				</div>
				<ul class="navbar-nav d-flex justify-content-end mr-2">
					<li class="nav-item dropdown">
						<a class="nav-link avatar-with-name" id="navbarDropdownMenuLink" data-toggle="dropdown" href="#">
							Admin
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
							<a class="dropdown-item text-danger" href="../logout.php">Sign out</a>
						</div>
					</li>
				</ul>
			</nav>
			
			<div class="adminx-sidebar expand-hover push">
				
				<ul class="sidebar-nav">
					
					<li class="sidebar-nav-item">
						<a href="?kode=dasboard" class="sidebar-nav-link active">
							<span class="sidebar-nav-icon">
								<i data-feather="home"></i>
							</span>
							<span class="sidebar-nav-name">
								Dashboard
							</span>	
						</a>
					</li>
					
					<li class="sidebar-nav-item">
						<a class="sidebar-nav-link collapsed" data-toggle="collapse" href="#navTables" aria-expanded="false" aria-controls="navTables">
							<span class="sidebar-nav-icon">
								<i data-feather="align-justify"></i>
							</span>
							<span class="sidebar-nav-name">
								Data Pelanggan
							</span>
							<span class="sidebar-nav-end">
								<i data-feather="chevron-right" class="nav-collapse-icon"></i>
							</span>
						</a>

						<ul class="sidebar-sub-nav collapse" id="navTables">
							<li class="sidebar-nav-item">
								<a href="?kode=SRBaru" class="sidebar-nav-link">
									<span class="sidebar-nav-abbr">
										TS
									</span>
									<span class="sidebar-nav-name">
										Tambah Saluran
									</span>
								</a>
							</li>

							<li class="sidebar-nav-item">
								<a href="?kode=SRLama" class="sidebar-nav-link">
									<span class="sidebar-nav-abbr">
										DS
									</span>
									<span class="sidebar-nav-name">
										Daftar Saluran
									</span>
								</a>
							</li>
						</ul>
					</li>
					
					<li class="sidebar-nav-item">
						<a class="sidebar-nav-link collapsed" data-toggle="collapse" href="#example" aria-expanded="false" aria-controls="example">
							<span class="sidebar-nav-icon">
								<i data-feather="pie-chart"></i>
							</span>
							<span class="sidebar-nav-name">
								Data 
							</span>
							<span class="sidebar-nav-end">
								<i data-feather="chevron-right" class="nav-collapse-icon"></i>
							</span>
						</a>

						<ul class="sidebar-sub-nav collapse" id="example">
							<li class="sidebar-nav-item">
								<a href="?kode=kecamatan" class="sidebar-nav-link">
									<span class="sidebar-nav-abbr">
										TKc
									</span>
									<span class="sidebar-nav-name">
										Tambah Kecamatan
									</span>
								</a>
							</li>
							
							<li class="sidebar-nav-item">
								<a href="?kode=tampilkecamatan" class="sidebar-nav-link">
									<span class="sidebar-nav-abbr">
										DK
									</span>
									<span class="sidebar-nav-name">
										Daftar Kecamatan
									</span>
								</a>
							</li>
							
							<li class="sidebar-nav-item">
								<a href="?kode=wilayah" class="sidebar-nav-link">
									<span class="sidebar-nav-abbr">
										TW
									</span>
									<span class="sidebar-nav-name">
										Tambah Wilayah
									</span>
								</a>
							</li>
							
							<li class="sidebar-nav-item">
								<a href="?kode=tampilwilayah" class="sidebar-nav-link">
									<span class="sidebar-nav-abbr">
										DW
									</span>
									<span class="sidebar-nav-name">
										Daftar Wilayah
									</span>
								</a>
							</li>

							<li class="sidebar-nav-item">
								<a href="?kode=jenis" class="sidebar-nav-link">
									<span class="sidebar-nav-abbr">
										TK
									</span>
									<span class="sidebar-nav-name">
										Tambah Kategori
									</span>
								</a>
							</li>
							
							<li class="sidebar-nav-item">
								<a href="?kode=daftarjenis" class="sidebar-nav-link">
									<span class="sidebar-nav-abbr">
										DK
									</span>
									<span class="sidebar-nav-name">
										Daftar Kategori
									</span>
								</a>
							</li>
						</ul>
					</li>
					
					<li class="sidebar-nav-item">
						<a class="sidebar-nav-link collapsed" data-toggle="collapse" href="#exampleslide" aria-expanded="false" aria-controls="exampleslide">
							<span class="sidebar-nav-icon">
								<i data-feather="users"></i>
							</span>
							<span class="sidebar-nav-name">
								Data Pengguna
							</span>
							<span class="sidebar-nav-end">
								<i data-feather="chevron-right" class="nav-collapse-icon"></i>
							</span>
						</a>
						
						<ul class="sidebar-sub-nav collapse" id="exampleslide">
							<li class="sidebar-nav-item">
								<a href="?kode=pegawai" class="sidebar-nav-link">
									<span class="sidebar-nav-abbr">
										TP
									</span>
									<span class="sidebar-nav-name">
										Tambah Pegawai
									</span>
								</a>
							</li>
							
							<li class="sidebar-nav-item">
								<a href="?kode=akses" class="sidebar-nav-link">
									<span class="sidebar-nav-abbr">
										DAP
									</span>
									<span class="sidebar-nav-name">
										Daftar Akses Pegawai
									</span>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
			
			<div class="adminx-content">

				<div class="adminx-main-content">
					<div class="container-fluid">
            
						<?php
							if (isset($_GET['kode']))
							{	$kode = $_GET['kode'];
								if ($kode == 'dasboard')
								{	include('home.php');
								}
								else if ($kode == 'SRBaru')
								{	include('saluranbaru.php');
								}
								else if ($kode == 'SRLama')
								{	include('saluranlama.php');
								}
								else if ($kode == 'rincian')
								{	include('rinciantagihan.php');
								}
								else if ($kode == 'kecamatan')
								{	include('kecamatan.php');
								}
								else if ($kode == 'wilayah')
								{	include('wilayah.php');
								}
								else if ($kode == 'tampilwilayah')
								{	include('tampilwilayah.php');
								}
								else if ($kode == 'tampilkecamatan')
								{	include('tampilkecamatan.php');
								}
								else if ($kode == 'jenis')
								{	include('kategori.php');
								}
								else if ($kode == 'daftarjenis')
								{	include('daftarkategori.php');
								}
								else if ($kode == 'edit')
								{	include('editKategori.php');
								}
								else if ($kode == 'pegawai')
								{	include('pegawai.php');
								}
								else if ($kode == 'akses')
								{	include('aksespegawai.php');
								}
								else if ($kode == 'hapus')
								{	include('hapusakses.php');
								}
								else if ($kode == 'excel')
								{	include('xl.php');
								}
							}
						?>
					
					</div>
				</div>
			</div>
		
		</div>
		
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
		<script src="dist/js/vendor.js"></script>
		<script src="dist/js/adminx.js"></script>
		<script src="../Web/bootbox/bootbox.min.js"> </script>
		<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
	</body>
</html>
