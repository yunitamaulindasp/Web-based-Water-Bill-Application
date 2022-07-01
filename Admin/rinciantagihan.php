<?php
	$kode = $_GET['saluran'];
	$_SESSION['saluran'] = $kode;
?>

<nav aria-label="breadcrumb" role="navigation">
	<ol class="breadcrumb adminx-page-breadcrumb">
		<li class="breadcrumb-item"><a href="?kode=dasboard">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Data Pelanggan</li>
		<li class="breadcrumb-item active" aria-current="page">Pelanggan Lama</li>
		<li class="breadcrumb-item active" aria-current="page">Rincian Tagihan</li>
	</ol>
</nav>
						
<div class="pb-3">
	<h1>Rincian Tagihan</h1>
</div>
						
<div class="row">
	<div class="col-lg-12">
		<div class="card mb-grid">									
			<div class="card-header">
				<div class="card-header-title">Data Pelanggan</div>
			</div>                
			<div class="card-body collapse show" id="card1">
				<table id="tabelprofil" class="tabled">
					<thead>
						<tr>
							<th width="200px"> </th>
							<th width="400px"> </th>
						</tr>
					</thead>
					<tbody>
						<?php
							$sql = "SELECT * FROM pelanggan WHERE IDsaluran=$kode";
							$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
							$arData = $hasil->fetch_array();
						?>
						<tr>
							<td> ID Saluran </td>
							<td><?php echo ': '.$arData['IDsaluran'];?></td>
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
							<td> Nama Pelanggan </td>
							<td><?php echo': '.$arData['Nama']; ?></td>
						</tr>
						<tr>
							<td> Alamat </td>
							<td> 
								<?php 
									$wil = $arData['IDwilayah'];
									$sql2 = "SELECT * FROM wilayah INNER JOIN kecamatan ON IDKec=IDkecamatan WHERE IDwilayah=$wil";
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
									$i = 1;
									$total 	= 0;
									while ($arData3 = mysqli_fetch_array($hasil3))
									{
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
											if ( $sls == 1 )
											{	$telat = ( 12 - $periode ) + $bln;	}
											else
											{	$telat = ( ( 12 - $periode ) + $bln ) + ( 12 * $sls );	}
										};
										$sql4 = "SELECT * FROM kategori WHERE IDtarif=$idk";
										$hasil4 = $mysqli->query($sql4) or die ("Error: ". $mysqli->error);
										$arData4 = $hasil4->fetch_array();
										$denda = $arData4['Denda'];								
										$subtotal = $denda * $telat;												
										$total = $total + $tagihan + $subtotal;											
										$i++;
									}										
									$bulan = date('F Y', strtotime('M'));											
									echo ': Rp. '.number_format($total,0,',','.').' / '.$bulan;
								?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div></div>
		<div class="card mb-grid">									
			<div class="card-header">
				<div class="card-header-title">Rincian Tagihan</div>
			</div>                
			<div class="card-body collapse show" id="card1">
				<table id="tabelrincian" class="tabled table-bordered" data-table>
					<style>
						th { text-align: center; }
					</style>
					<a href="?kode=excel&ID=<?php echo $kode; ?>"><button type="button" class="btn btn-outline-success btn-icon-text">Cetak Excel</button></a>
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
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

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
