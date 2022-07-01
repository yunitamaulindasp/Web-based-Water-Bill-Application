<nav aria-label="breadcrumb" role="navigation">
	<ol class="breadcrumb adminx-page-breadcrumb">
		<li class="breadcrumb-item"><a href="?kode=dasboard">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
		<li class="breadcrumb-item active" aria-current="page">Tambah Wilayah</li>
	</ol>
</nav>
	
<div class="pb-3">
	<h1>Kecamatan Batu</h1>
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
						<label for="text" class="col-sm-2 col-form-label form-label">Kecamatan</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="kecamatan" name="kecamatan" placeholder="Kecamatan">
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
				url: "tambahkecamatan.php",
				type: "POST",
				data: $("#tambah").serialize()
			})
			.done(function(hasil){
				if (hasil != ""){
					if (hasil != "Kecamatan Sudah Didaftarkan")
					{
						bootbox.alert({
							title: "Berhasil Menambahkan Kecamatan",
							message: hasil,
							callback: function(result){
								window.location.href = "?kode=kecamatan";
							}
						});
					}
					else
					{
						bootbox.alert({
							title: 'Tambah Kecamatan Gagal',
							message: hasil
						});
					}
				}
				else
				{	bootbox.alert({
						title: 'Tambah Kecamatan Gagal',
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
