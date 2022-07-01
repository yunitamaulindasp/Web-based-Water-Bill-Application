<nav aria-label="breadcrumb" role="navigation">
	<ol class="breadcrumb adminx-page-breadcrumb">
		<li class="breadcrumb-item"><a href="?kode=dasboard">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Data Pelanggan</li>
		<li class="breadcrumb-item active" aria-current="page">Pelanggan Baru</li>
	</ol>
</nav>

<div class="pb-3">
	<h1>Tambah Saluran Baru</h1>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="card mb-grid">							
			<div class="card-header">
				<div class="card-header-title">Isi Data Pelanggan</div>
			</div>                  
			<div class="card-body collapse show" id="card1">
				<form id="tambah" name="tambah" action="POST">											
					<div class="form-group row">
						<label for="nama" class="col-sm-2 col-form-label form-label">Nama</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pelanggan Baru">
						</div>
					</div>                      
					<div class="form-group row">
						<label for="alamat" class="col-sm-2 col-form-label form-label">Alamat</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat Pelanggan Baru">
						</div>
					</div>											
					<div class="form-group row">
						<label class="col-sm-2 col-form-label form-label">Kecamatan</label>
						<div class="col-sm-10">
							<select name="Kecamatan" class="form-control js-choice" id="Kecamatan">
								<?php
									$sql= "SELECT * FROM kecamatan";
									$hasil= $mysqli->query($sql) or die("Error: ". $mysli->error);
									While ($arData = $hasil->fetch_array())
									{
								?>
								<option value="<?php echo $arData['IDkecamatan']; ?>"><?php echo '<td>'.$arData['kecamatan']. '</td>'; ?></option>
								<?php 
									}
								?>
							</select>
						</div>
					</div>									
					<div class="form-group row">
						<label class="col-sm-2 col-form-label form-label">Desa/Kelurahan</label>
						<div class="col-sm-10">
							<select name="dk" class="form-control js-choice" id="dk">
								<?php
									$sql1= "SELECT * FROM wilayah";
									$hasil1= $mysqli->query($sql1) or die("Error: ". $mysli->error);
									While ($Data = $hasil1->fetch_array())
									{
								?>
								<option value="<?php echo $Data['IDwilayah']; ?>"><?php echo '<td>'.$Data['desa']. '</td>'; ?></option>
								<?php 
									}
								?>
							</select>
						</div>
					</div>											
					<div class="form-group row">
						<label class="col-sm-2 col-form-label form-label" for="tarif">Kategori Bangunan</label>
						<div class="col-sm-10">
							<select name="tarif" class="form-control js-choice" id="tarif">
								<?php
									$sql2= "SELECT * FROM kategori";
									$hasil2= $mysqli->query($sql2) or die("Error: ". $mysli->error);
									While ($Dataar = $hasil2->fetch_array())
									{
								?>
								<option value="<?php echo $Dataar['IDtarif']; ?>"><?php echo '<td>'.$Dataar['kategori']. '</td>'; ?></option>
								<?php 
									}
								?>
							</select>
						</div>
					</div>										
					<button type="submit" class="btn btn-primary">Daftarkan</button>					
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function()
	{	$("#tambah").submit(function(e)
		{	e.preventDefault();
			$.ajax({
				url: "tambahsaluran.php",
				type: "POST",
				data: $("#tambah").serialize()
			})
			.done(function(hasil){
				if (hasil != ""){
					bootbox.alert({
						title: "Tambah Saluran Berhasil",
						message: hasil,
						callback: function(result){
							window.location.href = "?kode=SRBaru";
						}
					});
				}
				else
				{	bootbox.alert({
						title: 'Tambah Saluran Gagal!',
						message: 'Masukkan Data Dengan Benar!'
					});
				}
			})
			.fail(function(q, textStatus){
				alert(textStatus);
			})
		});
	});
</script>
