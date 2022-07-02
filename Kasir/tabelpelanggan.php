<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">

		<title>Halaman Kasir</title>

		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

		<link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
		<link rel="stylesheet" href="src/vendors/styles/style.css">

		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>

		<link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/jquery.dataTables.css">
		<link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/dataTables.bootstrap4.css">
		<link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/responsive.dataTables.css">
	</head>
	<body>
		<div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="title">
								<h4>Rincian Tagihan</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="?kode=dasboard">Dasboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">Rincian Tagihan</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-12 mb-30">
					<div class="card box-shadow">
						<div class="card-header bg-blue">
							<h5 class="text-white">Profil</h5>
						</div>
						<div class="card-body">
							<table id="tabelprofil" class="tabled">
								<thead>
									<tr>
										<th width="200px"> </th>
										<th width="400px"> </th>
									</tr>
								</thead>
								<tbody>
									<?php
										$kode = $_GET['ID'];
										$_SESSION['saluran'] = $kode;
										$sql = "SELECT * FROM pelanggan WHERE IDsaluran=$kode";
										$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
										$arData = $hasil->fetch_array();
									?>
									<tr>
										<td>ID Saluran</td>
										<td><?php echo ': '.$arData['IDsaluran']; ?></td>
									</tr>
									<tr>
										<td> Kategori Bangunan </td>
										<td> 
											<?php 
												$idk = $arData['IDtarif'];
												$sql1 = "SELECT * FROM kategori WHERE IDtarif=$idk";
												$hasil1 = $mysqli->query($sql1) or die ("Error: ". $mysqli->error);
												$arData1 = $hasil1->fetch_array();

												echo ': '.$arData1['kategori'];
											?>
										</td>
									</tr>
									<tr>
										<td>Nama Pelanggan</td>
										<td><?php echo ': '.$arData['Nama']; ?></td>
									</tr>
									<tr>
										<td> Alamat </td>
										<td> 
											<?php 
												$wil = $arData['IDwilayah'];
												$sql2 = "SELECT * FROM wilayah INNER JOIN kecamatan ON IDKec=IDkecamatan
														 WHERE IDwilayah=$wil";
												$hasil2 = $mysqli->query($sql2) or die ("Error: ". $mysqli->error);
												$arData2 = $hasil2->fetch_array();

												echo ': '.$arData['Alamat'].", ".$arData2['desa'].", Kec. ".$arData2['kecamatan'];
											?>
										</td>
									</tr>
									<tr>
										<td> Tagihan </td>
										<td> 
											<?php 
												$sql3 	= "SELECT * FROM tagihan WHERE IDpelanggan=$kode AND Bayar='B'";
												$hasil3 = $mysqli->query($sql3) or die ("Error: ". $mysqli->error);

												$i 		= 1;
												$total 	= 0;

												while ($arData3 = mysqli_fetch_array($hasil3)){
													$tagihan = $arData3['Tagihan'];

													$tgl = explode('-', $arData3['Periode']);
													$periode = $tgl[1];
													$thn = $tgl[2];

													$bln = date('m');
													$thn1 = date('y');

													$sls_thn = $thn1 - $thn;
													if ( $sls_thn == 0){
														$telat = $bln - $periode;
													} else{
														$sls = $sls_thn;
														if ( $sls == 1 ){
															$telat = ( 12 - $periode ) + $bln;
														} else{
															$telat = ( ( 12 - $periode ) + $bln ) + ( 12 * $sls );
														}
													};

													$sql4 = "SELECT * FROM kategori WHERE IDtarif=$idk";
													$hasil4 = $mysqli->query($sql4) or die ("Error: ". $mysqli->error);
													$arData4 = $hasil4->fetch_array();

													$denda = $arData4['Denda'];

													$subtotal = $denda * $telat;

													$admin = $arData4['Admin'];

													$total = $tagihan + $subtotal + $admin;

													$i++;
												}

												$bulan = date('F Y', strtotime('M'));

												echo': Rp. '.number_format($total,0,',','.').' / '.$bulan; 
											?>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="card box-shadow">
					<div class="card-header bg-blue">
						<h5 class="text-white">Rincian Tagihan</h5>
					</div>
					<div class="card-body">
						<div class="row">
							<table id="tabelrincian" class="table table-actions table-striped table-hover mb-0" data-table>
								<style>
									th { text-align: center; }
								</style>
								<thead>
									<tr>
										<th width="200px"> Periode </th>
										<th width="400px"> Pakai </th>
										<th width="400px"> Tagihan </th>
										<th width="400px"> Denda </th>
										<th width="400px"> Total Tagihan </th>
										<th width="400px"> Keterangan </th>
									</tr>
								</thead>
								<tbody>
									<tr>

									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<script src="src/vendors/scripts/script.js"></script>
	
		<script src="src/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script src="src/plugins/datatables/media/js/dataTables.bootstrap4.js"></script>
		<script src="src/plugins/datatables/media/js/dataTables.responsive.js"></script>
		<script src="src/plugins/datatables/media/js/responsive.bootstrap4.js"></script>
		<script src="src/plugins/datatables/media/js/button/dataTables.buttons.js"></script>
		<script src="src/plugins/datatables/media/js/button/buttons.bootstrap4.js"></script>
		<script src="src/plugins/datatables/media/js/button/buttons.print.js"></script>
		<script src="src/plugins/datatables/media/js/button/buttons.html5.js"></script>
		<script src="src/plugins/datatables/media/js/button/buttons.flash.js"></script>
		<script src="src/plugins/datatables/media/js/button/pdfmake.min.js"></script>
		<script src="src/plugins/datatables/media/js/button/vfs_fonts.js"></script>

		<script type="text/javascript">
			$(document).ready(function(){
				var dataTable = $('#tabelrincian').DataTable( {
					"processing": true,
					"serverSide": true,
					"bSort": false,
					"ajax": {
						url: "prosestampilrincian.php",
						type: "POST",
						error: function(){
							$(".lookup-error").html("");
							$("#tabel").append('<tbody class="employee-grid-error"> <tr> <th colspan="6"> Data Tidak Ditemukan </th> </tr> </tbody>');
							$("#lookup_processing").css("display", "none");
						}
					}
				});
			});
		</script>
	</body>
</html>
