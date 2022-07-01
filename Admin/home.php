<nav aria-label="breadcrumb" role="navigation">
	<ol class="breadcrumb adminx-page-breadcrumb">
		<li class="breadcrumb-item"><a href="?kode=dasboard">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
	</ol>
</nav>

<div class="pb-3">
	<h1>Dashboard</h1>
</div>

<div class="row">
	<div class="col-md-6 col-lg-4 d-flex">
		<div class="card mb-grid w-100">
			<div class="card-body d-flex flex-column">
				<div class="d-flex justify-content-between mb-3">
					<h5 class="card-title mb-0">
						Tagihan Lunas
					</h5>
					<div class="card-title-sub">
						<?php
							$jml = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tagihan"));
							$lns = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tagihan WHERE Bayar='S'"));
													
							$hsl = $lns * 100 / $jml;
							echo number_format($lns,0,',','.')."/".number_format($jml,0,',','.');
						?>
					</div>
				</div>
				
				<div class="progress mt-auto">
					<div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" style="width: <?php echo $hsl; ?>%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
			</div>
		</div>
	</div>			  
	<div class="col-md-6 col-lg-5 d-flex">
		<div class="card border-0 bg-primary text-white text-center mb-grid w-100">
			<div class="d-flex flex-row align-items-center h-100">
				<div class="card-icon d-flex align-items-center h-100 justify-content-center">
					<i data-feather="droplet"></i>
				</div>
				<div class="card-body">
					<div class="card-info-title">Besar Meter Air Pakai Pelanggan Bulan <?php echo date('F Y', strtotime('M')); ?></div>
					<h3 class="card-title mb-0">
						<?php
							$bln = date('m');
							$thn = date('Y');
							$prd = $thn.'-'.$bln;
						
							$query = "SELECT * FROM tagihan WHERE Periode LIKE '%$prd%'";
							$hasil = $mysqli->query($query) or die ("Error: ". $mysqli->error);
														
							$i = 0;
							while ($arData = mysqli_fetch_array($hasil))
							{
								$pakai = $arData['Pakai'];
								$i = $i + $pakai;				
								$i++;
							}
							
							echo number_format($i,0,',','.')." kubik";
						?>
					</h3>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-lg-3 d-flex">
		<div class="card border-0 bg-success text-white text-center mb-grid w-100">
			<div class="d-flex flex-row align-items-center h-100">
				<div class="card-icon d-flex align-items-center h-100 justify-content-center">
					<i data-feather="users"></i>
				</div>
				<div class="card-body">
					<div class="card-info-title">Pelanggan PDAM</div>
					<h3 class="card-title mb-0">
						<?php
							$hsl = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pelanggan"));						
							echo number_format($hsl,0,',','.')." Saluran";
						?>
					</h3>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">			
	<div class="col-lg-12">
		<div class="card mb-grid text-center">
			<div class="card-header">
				<div class="card-header d-flex justify-content-between align-items-center">
					<div class="card-header-title">MOTTO</div>
				</div>
				<div class="card-body">
					<div class="tab-content">
						<div class="tab-pane fade show active" id="card-tab-content-1" role="tabpanel" aria-labelledby="card-tab-1">
							<h4 class="card-title">PERUMDAM AMONG TIRTO KOTA BATU</h4>
							<p class="card-text">Menjadi Perusahaan Yang Terpercaya dan Kebanggaan Masyarakat Dalam Pelayanan Air Minum</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

					
<div class="row">			
	<div class="col-lg-6">
		<div class="card">
			<div class="card-header d-flex justify-content-between align-items-center">
				<div class="card-header-title">Daftar Desa/Kelurahan di Kota Batu</div>
				<nav class="card-header-actions">
					<div class="dropdown">
						<a class="card-header-action" href="#" role="button" id="card1Settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i data-feather="settings"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="card1Settings">
							<a class="dropdown-item" href="?kode=kecamatan">Tambah Kecamatan</a>
							<a class="dropdown-item" href="?kode=wilayah">Tambah Desa/Kelurahan</a>
						</div>
					</div>
					<a class="card-header-action" data-toggle="collapse" href="#card1" aria-expanded="false" aria-controls="card1">
						<i data-feather="minus-circle"></i>
					</a>
				</nav>
			</div>
			
			<div class="card-body collapse show" id="card1">
				<table class="table table-bordered mb-0">
					<thead align="center">
						<tr>
							<?php
								$query1 	= "SELECT * FROM kecamatan";
								$hasil1		= $mysqli->query($query1) or die ("Error: ". $mysqli->error);

								while ($arData1 = mysqli_fetch_array($hasil1))
								{
									$kec = $arData1['kecamatan'];
									$ke = $arData1['IDkecamatan'];
								?>
							<th scope="col"><?php echo $kec; ?></th>
							<?php
									$i++;
								}
							?>
						</tr>
					</thead>
					<tbody>
						<?php
							$query2 	= "SELECT * FROM kecamatan";
							$hasil2		= $mysqli->query($query2) or die ("Error: ". $mysqli->error);
							while ($arData2 = mysqli_fetch_array($hasil2))
							{
								$ke = $arData2['IDkecamatan'];

								$query3 	= "SELECT * FROM wilayah WHERE IDKec=$ke";
								$hasil3		= $mysqli->query($query3) or die ("Error: ". $mysqli->error);
						?>
						<td>
							<?php
								while ($arData3 = mysqli_fetch_array($hasil3))
								{
							?>
							<li><?php echo $arData3['desa']; ?></li>
							<?php	
									$i++;
								}
							?>
						</td>
						<?php											
								$i++;
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
	<div class="col-lg-6">
		<div class="card mb-grid">
			<div class="card-header d-flex justify-content-between align-items-center">
				<div class="card-header-title">Daftar Kategori Bangunan</div>
				<nav class="card-header-actions">
					<div class="dropdown">
						<a class="card-header-action" href="#" role="button" id="card2Settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i data-feather="settings"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="card2Settings">
							<a class="dropdown-item" href="?kode=jenis">Tambah Kategori</a>
							<a class="dropdown-item" href="?kode=daftarjenis">Lihat Detail</a>
						</div>
					</div>
					<a class="card-header-action" data-toggle="collapse" href="#card2" aria-expanded="false" aria-controls="card2">
						<i data-feather="minus-circle"></i>
					</a>
				</nav>
			</div>
			
			<div class="card-body collapse show" id="card2">
				<table class="table table-bordered mb-0">
					<thead align="center">
						<tr>
							<th scope="col">Rumah Tangga</th>
							<th scope="col">Niaga</th>
							<th scope="col">Industri</th>
							<th scope="col">Lain-lain</th>
						</tr>
					</thead>
					<tbody>
						<td>
							<?php
								$query4 	= "SELECT * FROM kategori WHERE kategori LIKE '%Rumah Tangga%'";
								$hasil4		= $mysqli->query($query4) or die ("Error: ". $mysqli->error);
								while ($arData4 = mysqli_fetch_array($hasil4))
								{
							?>
							<li><?php echo $arData4['kategori']; ?></li>
							<?php	
									$i++;
								}
							?>
						</td>
						<td>
							<?php
								$query5 	= "SELECT * FROM kategori WHERE kategori LIKE '%Niaga%'";
								$hasil5		= $mysqli->query($query5) or die ("Error: ". $mysqli->error);
								while ($arData5 = mysqli_fetch_array($hasil5))
								{
							?>
							<li><?php echo $arData5['kategori']; ?></li>
							<?php	
									$i++;
								}
							?>
						</td>
						<td>
							<?php
								$query6 	= "SELECT * FROM kategori WHERE kategori LIKE '%Industri%'";
								$hasil6		= $mysqli->query($query6) or die ("Error: ". $mysqli->error);
								while ($arData6 = mysqli_fetch_array($hasil6))
								{
							?>
							<li><?php echo $arData6['kategori']; ?></li>
							<?php	
									$i++;
								}
							?>
						</td>
						<td>
							<?php
								$query7 	= "SELECT * FROM kategori WHERE admin='6000'";
								$hasil7		= $mysqli->query($query7) or die ("Error: ". $mysqli->error);
								while ($arData7 = mysqli_fetch_array($hasil7))
								{
								?>
								<li><?php echo $arData7['kategori']; ?></li>
								<?php	
									$i++;
								}
								$query8 	= "SELECT * FROM kategori WHERE admin='80000'";
								$hasil8		= $mysqli->query($query8) or die ("Error: ". $mysqli->error);
								$arData8 = $hasil8->fetch_array();
							?>
							<li><?php echo $arData8['kategori']; ?></li>
						</td>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
