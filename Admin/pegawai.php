<nav aria-label="breadcrumb" role="navigation">
	<ol class="breadcrumb adminx-page-breadcrumb">
		<li class="breadcrumb-item"><a href="?kode=dasboard">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Data Pegawai</li>
		<li class="breadcrumb-item active" aria-current="page">Tambah Pegawai</li>
	</ol>
</nav>
						
<div class="pb-3">
	<h1>Tambah Pegawai</h1>
</div>
						
<div class="row">
	<div class="col-lg-12">
		<div class="card mb-grid">
			<div class="card-header">
				<div class="card-header-title">Isi Data Pegawai</div>
			</div>
			<div class="card-body collapse show" id="card1">
				<form id="tambah" name="tambah">
					<div class="form-group row">
						<label for="nama" class="col-sm-2 col-form-label form-label">Nama</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pegawai">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label form-label">Status</label>
						<div class="col-sm-10">
							<select name="status" class="form-control js-choice" id="status">
								<option value="Staf">Staf PDAM</option>
								<option value="Kasir">Kasir PDAM</option>
								<option value="Cater">Cater</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="nama" class="col-sm-2 col-form-label form-label">Password</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" id="pass" name="pass" placeholder="Masukkan Password">
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
				url: "tambahpegawai.php",
				type: "POST",
				data: $("#tambah").serialize()
			})
			.done(function(hasil){
				if (hasil != ""){
					if (hasil != "Username Sudah Didaftarkan"){
						bootbox.alert({
							title: "Tambah Akses Berhasil",
							message: hasil,
							callback: function(result){
								window.location.href = "?kode=pegawai";
							}
						});
					} else{
						bootbox.alert({
							title: 'Tambah Akses Gagal',
							message: hasil
						});
					}
				} else{
					bootbox.alert({
						title: 'Tambah Data Gagal',
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
