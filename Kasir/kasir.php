<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<link rel="icon" type="image/png" href="assets/img/favicon.ico">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

		<title>Halaman Kasir</title>

		<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />

		<link rel="canonical" href="https://www.creative-tim.com/product/fresh-bootstrap-table"/>

		<meta itemprop="image" content="http://s3.amazonaws.com/creativetim_bucket/products/31/original/opt_fbt_thumbnail.jpg">

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
		<link href="assets/css/fresh-bootstrap-table.css" rel="stylesheet" />
		<link href="assets/css/demo.css" rel="stylesheet" />

		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
		<link href="http://fonts.googleapis.com/css?family=Roboto:400,700,300" rel="stylesheet" type="text/css">

		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<script src="https://unpkg.com/bootstrap-table/dist/bootstrap-table.js"></script>
		<script src="../Web/bootbox/bootbox.min.js"></script>

		<script src="assets/js/demo/gsdk-switch.js"></script>
		<script src="assets/js/demo/jquery.sharrre.js"></script>
		<script src="assets/js/demo/demo.js"></script>
	</head>
	<body>
		<div class="logo-container full-screen-table-demo">
			<div class="dropdown">
				<a href="#" data-toggle="dropdown">
					<div class="logo">
						<img src="assets/img/new_logo.png">
					</div>
					<div class="brand">Kasir PDAM</div>
				</a>
				<ul class="dropdown-menu">
					<li>
						<div class="">
							<a href="../logout.php" class="btn btn-default btn-block">Log Out</a>
						</div>
					</li>
				</ul>	
			</div>		
		</div>
		<div class="fresh-table full-color-blue full-screen-table">
			<table id="fresh-table" class="table">
				<thead>
					<th data-events="operateEvents">  </th>
					<th data-field="IDS">ID Sambungan</th>
					<th data-field="tarif">Kategori Bangunan</th>
					<th data-field="nama" data-sortable="true">Nama</th>
					<th data-field="alamat" data-sortable="true">Alamat</th>
					<th data-field="tagihan">Tagihan</th>
					<th data-field="actions">Cek Tagihan</th>
					<th> </th>
				</thead>
				<tbody>
					<tr>
						<?php
							$sql = "SELECT * FROM pelanggan";
							$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
							$start = 0;
							$counter = $start + 1;
							while ($data = $hasil->fetch_array()){
								$_SESSION['saluran'] = $data['IDsaluran'];

								echo '<td></td><td> '.$_SESSION['saluran'].' </td>';

								$add = "SELECT * FROM kategori WHERE IDtarif=".$data['IDtarif'];
								$hsl = $mysqli->query($add);
								$arData = $hsl->fetch_array();

								echo '<td> '.$arData['kategori'].' </td>';

								echo '<td> '.$data['Nama'].' </td>';

								$add1 = "SELECT * FROM wilayah WHERE IDwilayah=".$data['IDwilayah'];
								$hsl1 = $mysqli->query($add1);
								$arData1 = $hsl1->fetch_array();

								echo '<td> '.$arData1['desa'].' </td>';
						?>
						<td>
							<?php 
								$kode = $data['IDsaluran'];
								$idk = $data['IDtarif'];					

								$add2 = "SELECT * FROM tagihan WHERE IDpelanggan=$kode AND Bayar='B'";
								$hsl2 = $mysqli->query($add2) or die ("Error: ". $mysqli->error);

								$i = 1;
								$total 	= 0;

								while ($arData2 = mysqli_fetch_array($hsl2)){
									$tagihan = $arData2['Tagihan'];

									$tgl = explode('-', $arData2['Periode']);
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

									$add3 = "SELECT * FROM kategori WHERE IDtarif=$idk";
									$hsl3 = $mysqli->query($add3) or die ("Error: ". $mysqli->error);
									$arData3 = $hsl3->fetch_array();

									$denda = $arData3['Denda'];

									$subtotal = $denda * $telat;

									$admin = $arData3['Admin'];

									$total = $total + $tagihan + $subtotal + $admin;

									$i++;
								}		
								echo'Rp. '.number_format($total,0,',','.');
							?>
						</td>
						<td>
							<a rel="tooltip" class="table-action Bayar" href="javascript:KonfirmasiBayar('<?php echo $_SESSION['saluran']; ?>');" title="Bayar">
								<i class="fas fa-donate"></i>
							</a>
							<a rel="tooltip" class="table-action edit" href="?kode=rincian&ID=<?php echo $data['IDsaluran']; ?>" title="Rincian">
								<i class="fa fa-folder-open"></i>
							</a>
						<td>
					</tr>
						<?php
								$counter++;
							}
						?>
				</tbody>
			</table>

			<div class="description description-footer">
				<p>Copyright &copy; 2020 PDAM Among Tirto</p>
			</div>
		</div>

		<script src="../Web/bootbox/bootbox.min.js"> </script>
		<script>
			function KonfirmasiBayar(x){
				bootbox.confirm({
					title: "Konfirmasi",
					message: "ID Saluran " + x + " Melakukan Pembayaran?",
					callback: function(result){
						if (result == true){
							$.ajax({
								type: "GET",
								url: "bayar.php",
								data: { "ID" : x},
							})
							.done(function(hasilProses){
								if (hasilProses != "Pembayaran Sudah Dilakukan"){
									bootbox.alert({
										title: "Berhasil Melakukan Pembayaran",
										message: hasilProses,
										callback: function(result){
											window.location.href = "?kode=cek&ID=" + x;
										}
									});
								} else{
									bootbox.alert({
										title: 'Pembayaran Gagal',
										message: hasilProses
									});
								}
							})
							.fail(function(jqXHR, textStatus){
								alert( "Request gagal: " + textStatus );
							});
						}
					}
				});
			}
			var $table = $('#fresh-table')
			$(function (){
				$table.bootstrapTable({
					classes: 'table table-hover table-striped',
					toolbar: '.toolbar',
					search: true,
					showRefresh: true,
					showToggle: true,
					showColumns: true,
					pagination: true,
					striped: true,
					sortable: true,
					height: $(window).height(),
					pageSize: 25,
					pageList: [25, 50, 100],
					formatShowingRows: function (pageFrom, pageTo, totalRows){
						return ''
					},
					formatRecordsPerPage: function (pageNumber){
						return pageNumber + ' rows visible'
					}
				})
				$(window).resize(function (){
					$table.bootstrapTable('resetView', {
						height: $(window).height()
					})
				})
			})
		</script>
	</body>
</html>
