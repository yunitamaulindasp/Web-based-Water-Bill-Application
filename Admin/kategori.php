<nav aria-label="breadcrumb" role="navigation">		
	<ol class="breadcrumb adminx-page-breadcrumb">
		<li class="breadcrumb-item"><a href="?kode=dasboard">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
		<li class="breadcrumb-item active" aria-current="page">Tambah Kategori</li>
	</ol>
</nav>
	
<div class="pb-3">
	<h1>Kategori Bangunan</h1>
</div>
						
<div class="row">
	<div class="col-lg-12">
		<div class="card mb-grid">
			<div class="card-header">
				<div class="card-header-title">Tambah Kategori Bangunan</div>
			</div>
			<div class="card-body collapse show" id="card1">
				<form id="tambah" name="tambah">
					<div class="form-group row">
						<label for="text" class="col-sm-2 col-form-label form-label">Kategori Bangunan</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="Bangunan" name="Bangunan" placeholder="Kategori Bangunan">
						</div>
					</div>
					<div class="form-group row">
						<label for="text" class="col-sm-2 col-form-label form-label">Tarif per-Kubik</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="tarif" name="tarif" placeholder="Tarif per-Kubik Air">
						</div>
					</div>
					<div class="form-group row">
						<label for="text" class="col-sm-2 col-form-label form-label">Denda</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="denda" name="denda" placeholder="Denda Keterlambatan Pembayaran">
						</div>
					</div>
					<div class="form-group row">
						<label for="text" class="col-sm-2 col-form-label form-label">Biaya Jasa Administrasi</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="admin" name="admin" placeholder="Biaya Jasa Administrasi">
						</div>
					</div>
					<button type="submit" class="btn btn-primary">Tambah</button>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$("#tambah").submit(function(e){
			e.preventDefault();
			$.ajax({
				url : "tambahkategori.php",
				type : "POST",
				data : $("#tambah").serialize()
			})
			.done(function(hasil){
				if (hasil != ""){
					if (hasil != "Kategori Sudah Didaftarkan"){
						bootbox.alert({
							title: "Tambah Kategori Berhasil",
							message: hasil,
							callback: function(result){
								window.location.href = "?kode=jenis";
							}
						});
					} else{
						bootbox.alert({
							title: 'Tambah Kategori Gagal',
							message: hasil
						});
					}
				} else{
					bootbox.alert({
						title: 'Tambah KategoriGagal!',
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
