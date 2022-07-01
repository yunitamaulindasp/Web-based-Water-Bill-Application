<nav aria-label="breadcrumb" role="navigation">
	<ol class="breadcrumb adminx-page-breadcrumb">
		<li class="breadcrumb-item"><a href="?kode=dasboard">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
		<li class="breadcrumb-item active" aria-current="page">Tambah Wilayah</li>
	</ol>
</nav>
	
<div class="pb-3">
	<h1>Wilayah Batu</h1>
</div>
						
<div class="row">
	<div class="col-lg-12">
		<div class="card mb-grid">									
			<div class="card-header">
				<div class="card-header-title">Tambah Wilayah</div>
			</div>                  
			<div class="card-body collapse show" id="card1">
				<form id="tambah" name="tambah">											
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
						<label for="text" class="col-sm-2 col-form-label form-label">Desa/Kecamatan</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="desa" name="desa" placeholder="Desa/Kecamatan">
						</div>
					</div>										
					<button type="submit" class="btn btn-primary">Tambah</button>					
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
				url: "tambahwilayah.php",
				type: "POST",
				data: $("#tambah").serialize()
			})
			.done(function(hasil){
				if (hasil != ""){
					if (hasil != "Wilayah Sudah Didaftarkan")
					{
						bootbox.alert({
							title: "Tambah Wilayah Berhasil",
							message: hasil,
							callback: function(result){
								window.location.href = "?kode=wilayah";
							}
						});
					}
					else
					{
						bootbox.alert({
							title: 'Tambah Wilayah Gagal',
							message: hasil
						});
					}
				}
				else
				{	bootbox.alert({
						title: 'Tambah Wilayah Gagal',
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
