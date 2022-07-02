<div class="hero-area2 slider-height d-flex align-items-center">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="section-top">
					<div class="col-xl-8 col-lg-9">
						<table id="tabelprofil" class="tabled">
							<thead>
								<tr>
									<th width="200px"> </th>
									<th width="400px"> </th>
								</tr>
							</thead>
							<tbody>
								<?php
									require '../koneksi.php';
									$kode	= $_GET['ID'];
									$sql 	= "SELECT * FROM pelanggan WHERE IDsaluran=$kode";
									$hasil 	= $mysqli->query($sql) or die ("Error: ". $mysqli->error);
									$arData	= $hasil->fetch_array();
								?>
								<tr>
									<td><b>ID Saluran</b></td>
									<td><?php echo '<b>: '.$arData['IDsaluran']; '</b>' ?></td>
								</tr>
								<tr>
									<td> <b>Kategori Bangunan</b> </td>
									<td> 
										<?php 
											$idk		= $arData['IDtarif'];
											$sql1		= "SELECT * FROM kategori WHERE IDtarif=$idk";
											$hasil1		= $mysqli->query($sql1) or die ("Error: ". $mysqli->error);
											$arData1	= $hasil1->fetch_array();
										
											echo '<b>: '.$arData1['kategori']; '</b>'
										?>
									</td>
								</tr>
								<tr>
									<td><b>Nama Pelanggan</b></td>
									<td><?php echo'<b>: '.$arData['Nama']; '</b>' ?></td>
								</tr>
								<tr>
									<td><b>Alamat</b></td>
									<td> 
										<?php 
											$wil 		= $arData['IDwilayah'];
											$sql2 		= "SELECT * FROM wilayah INNER JOIN kecamatan ON IDKec=IDkecamatan
													   WHERE IDwilayah=$wil";
											$hasil2 	= $mysqli->query($sql2) or die ("Error: ". $mysqli->error);
											$arData2 	= $hasil2->fetch_array();
										
											echo '<b>: '.$arData['Alamat'].", ".$arData2['desa'].", Kec. ".$arData2['kecamatan']; '</b>'
										?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<section class="pricing-card-area">
	<div class="container">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-6 col-sm-10">
				<div class="single-card text-center mb-30">
					<div class="card-top">
						<?php
							$sql3 	= "SELECT * FROM tagihan WHERE IDpelanggan=$kode AND Bayar='B'";
							$hasil3 = $mysqli->query($sql3) or die ("Error: ". $mysqli->error);
						?>
						<h4>Tagihan Bulan <?php echo date('F Y', strtotime('M')); ?></h4>
					</div>
					<div class="card-mid">
						<?php
							$i = 1;
							$total 	= 0;
							$pakai	= 0;
							while ($arData3 = mysqli_fetch_array($hasil3)){
								$tagihan = $arData3['Tagihan'];
								$tgl = explode('-', $arData3['Periode']);
								$periode = $tgl[1];
								$thn = $tgl[2];
								$bln = date('m');
								$thn1 = date('y');
								$sls_thn = $thn1 - $thn;
								if ( $sls_thn == 0){
									$telat = $periode - $bln;
								} else{
									$sls = $sls_thn;
									if ( $sls == 1 ){
										$telat = ( 12 - $periode ) + $bln;
									} else{	$telat = ( ( 12 - $periode ) + $bln ) + ( 12 * $sls );
									      }
								};
								$sql4 = "SELECT * FROM kategori WHERE IDtarif=$idk";
								$hasil4 = $mysqli->query($sql4) or die ("Error: ". $mysqli->error);
								$arData4 = $hasil4->fetch_array();
								$denda = $arData4['Denda'];
								$subtotal = $denda * $telat;
								$admin = $arData4['Admin'];
								$total = $total + $tagihan + $subtotal + $admin;
								$pakai = $pakai + $arData3['Pakai'];
								$i++;
							}
							if ( $total != 0 ){
								$tagihan = $tagihan;
								$denda = $denda;
								$admin = $admin;
							} else{
								$tagihan = 0;
								$denda = 0;
								$admin = 0;
							}
						?>
						<h4><?php echo 'RP. '.number_format($total,0,',','.'); ?></h4>
					</div>
					<div class="card-bottom">
						<div align='center'>
							<table border='0'>
								<tr><td>Banyak Meter Pakai </td><td>: <?php echo $pakai; ?> kubik</td></tr>
								<tr><td>Jumlah Tagihan </td><td>: <?php echo 'RP. '.number_format($tagihan,0,',','.'); ?></td></tr>
								<tr><td>Jumlah Denda </td><td>: <?php echo 'RP. '.number_format($denda,0,',','.'); ?> / bulan</td></tr>
								<tr><td>Biaya Admin </td><td>: <?php echo 'RP. '.number_format($admin,0,',','.'); ?></td></tr>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-12 col-lg-12 col-md-6 col-sm-10">
				<div class="single-card text-center mb-30">
					<div class="card-top">
						<h4>Riwayat Tagihan</h4>
					</div>
					<div class="card-bottom">
						<table class="table table-hover" id="tabel" data-table>
							<thead>
								<th width="50px">No</th>
								<th width="200px">Periode</th>
								<th width="200px">Pemakaian (perkubik)</th>
								<th width="200px">Tagihan</th>
								<th width="200px">Denda</th>
								<th width="200px">Total Tagihan</th>
								<th width="200px">Rincian</th>	
							</thead>
							<tbody>
								<?php
									$sql5 = "SELECT * FROM tagihan WHERE IDpelanggan=$kode";
									$hasil5 = $mysqli->query($sql5);
									$counter = 1;
									while ($arData5 = mysqli_fetch_array($hasil5)){
								?>
								<tr>
									<td><?php echo $counter; ?></td>
									<td>
										<?php
											$bulan = date('F Y', strtotime($arData5['Periode']));
											echo $bulan;
										?>
									</td>
									<td><?php echo $arData5['Pakai']; ?></td>
									<td><?php echo 'RP. '.number_format($arData5['Tagihan'],0,',','.'); ?></td>
									<td> 
										<?php 
											$tagihan1 = $arData5['Tagihan'];
											if ( $arData5['Bayar'] == 'B' ){
												$tgl1 = explode('-', $arData5['Periode']);
												$periode1 = $tgl1[1];
												$thn2 = $tgl1[2];
												$bln1 = date('m');
												$thn3 = date('y');
												$sls_thn1 = $thn3 - $thn2;
												if ( $sls_thn1 == 0){
													$telat1 = $bln1 - $periode1;
												} else{
													$sls1 = $sls_thn1;
													if ( $sls1 == 1 ){
														$telat1 = ( 12 - $periode1 ) + $bln1;
													} else{
														$telat1 = ( ( 12 - $periode1 ) + $bln1 ) + ( 12 * $sls1 );
													}
												};
												$sql6 = "SELECT * FROM kategori WHERE IDtarif=$idk";
												$hasil6 = $mysqli->query($sql6) or die ("Error: ". $mysqli->error);
												$arData6 = $hasil6->fetch_array();
												$denda1 = $arData6['Denda'];
												$subtotal1 = $denda1 * $telat1;
											} else{
												$subtotal1 = 0;
											}
											echo 'RP. '.number_format($subtotal1,0,',','.'); 
										?>
									</td>
									<td>
										<?php
											$tagihan1 = $arData5['Tagihan'];
											if ( $arData5['Bayar'] == 'B' ){
												$total1 = $tagihan1 + $subtotal;
											} else{
												$total1 = $tagihan1;
											}
											echo 'RP. '.number_format($total1,0,',','.');
										?>
									</td>
									<td> 
										<?php 
											if ($arData5['Bayar'] == 'B'){
												echo 'TAGIHAN';
											} else{
												echo date('d-m-Y', strtotime($arData5['Periode']));
											}
										?>
									</td>
								</tr>
								<?php
										$counter++;
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>		
