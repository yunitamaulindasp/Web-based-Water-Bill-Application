<?php
	require '../koneksi.php';
	session_start();
	
	if (!isset($_SESSION['status']))
	{	echo "<script>window.location.replace('../login.php')</script>";
		die();
	}
	
	$nama = $_SESSION['nama'];
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		
		<title>Halaman Cater</title>

		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
		<meta name="viewport" content="width=device-width" />

		<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png" />
		<link rel="icon" type="image/png" href="assets/img/favicon.png" />

		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="assets/css/material-bootstrap-wizard.css" rel="stylesheet" />

		<link href="assets/css/demo.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="styles/elements.css">
		<link rel="stylesheet" type="text/css" href="styles/elements_responsive.css">
	</head>
	<body>
		<div class="image-container set-full-height" style="background-image: url('assets/img/wizard-book.jpg')">
			<div class="dropdown">
				<a href="#" data-toggle="dropdown">
					<div class="logo-container">
						<div class="brand">Cater PDAM</div>
					</div>	
				</a>
				<ul class="dropdown-menu">
					<li>
						<div class="">
							<a href="../logout.php" class="btn btn-default btn-block">Log Out</a>
						</div>
					</li>
				</ul>				
			</div>
			<a href="#" class="made-with-mk">
				<div class="brand">AT</div>
				<div class="made-with">
					<strong> © PDAM Among Tirto</strong>
				</div>
			</a>
			<div class="container">
				<div class="row">
					<div class="col-sm-8 col-sm-offset-2">
						<div class="wizard-container">
							<div class="card wizard-card" data-color="blue" id="wizard">
								<div class="wizard-header">
									<h3 class="wizard-title">Tangihan Pelanggan</h3>
									<h5>Masukkan ID Saluran Pelanggan!</h5>
								</div>
								<div class="wizard-navigation">
									<ul>
										<li><a href="#details" data-toggle="tab">Pemakaian</a></li>
										<li><a href="#description" data-toggle="tab">Target</a></li>
									</ul>
								</div>
								<div class="tab-content">
									<div class="tab-pane" id="details">
										<form name="tambah" id="tambah">
											<div class="row">
												<div class="col-sm-12">
													<h4 class="info-text">Tagihan Air Pelanggan</h4>
												</div>
												<div class="col-sm-12">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="material-icons">add_task</i>
														</span>
														<div class="form-group label-floating">
															<label class="control-label">Masukkan ID Saluran</label>
															<input name="saluran" id="saluran" type="text" class="form-control">
														</div>
													</div>
													<div class="input-group">
														<span class="input-group-addon">
															<i class="material-icons">lock_outline</i>
														</span>
														<div class="form-group label-floating">
															<label class="control-label">Masukkan Pemakaian Pelanggan</label>
															<input name="tagihan" id="tagihan" type="text" class="form-control">
														</div>
													</div>
												</div>
											</div>
											<div class="wizard-footer">
												<div class="pull-right">
													<button type='submit' class='btn btn-fill btn-danger btn-wd'> Masukkan </button>
												</div>
											</div>
										</form>
									</div>
									<div class="tab-pane" id="description">
										<h4 class="info-text">Profil dan Target Cater</h4>
										<div class="row">
											<div class="col-sm-6 col-sm-offset-1">
												<div class="form-group">
													<label>Profil Cater</label>
													<table id="fresh-table" class="table">
														<thead>
															<th width="200px"> </th>
															<th width="400px"> </th>
														</thead>
														<tbody>
															<?php
																$sql = "SELECT * FROM cater WHERE Nama='$nama'";
																$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
																$arData = $hasil->fetch_array();
															?>
															<tr>
																<td>Nama</td>
																<td><?php echo ': '.$arData['Nama']; ?></td>
															</tr>
															<tr>
																<td>Target Catat</td>
																<td><?php echo ': '.$arData['Target']; ?></td>
															</tr>
															<tr>
																<td>Terpenuhi</td>
																<td><?php echo ': '.$arData['Dapat']; ?></td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
											<div class="col-sm-4 col-sm-offset-1">
												<div class="form-group">
													<div class="col-md-10">
														<label>Target Catat</label>
														<div class="progress">
															<?php
																$persen = $arData['Dapat'] * 100 / $arData['Target'];
															?>
															<div class="progress-bar" role="progressbar" style="width: <?php echo $persen; ?>%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><?php echo $arData['Dapat'].'/'.$arData['Target']; ?></div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
	
	<script src="assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="assets/js/jquery.bootstrap.js" type="text/javascript"></script>
	<script src="assets/js/material-bootstrap-wizard.js"></script>
	<script src="assets/js/jquery.validate.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#tambah").submit(function(e){
				e.preventDefault();
				$.ajax({
					url: "tambahtagihan.php",
					type: "POST",
					data: $("#tambah").serialize()
				})
				.done(function(hasil){
					window.location.href = "index.php"
				})
				.fail(function(q, textStatus){
					alert( "Request gagal: " + textStatus);
				})
			});
		});
	</script>
</html>
