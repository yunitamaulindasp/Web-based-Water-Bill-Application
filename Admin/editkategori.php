<?php
	if (!isset ($_GET['ID'])){
		die("<script>alert('Tentukan dulu data yang akan diubah!');
		window.location.href = '?kode=daftarjenis'</script>");
	}
	
	$id = $_GET['ID'];
	$_SESSION['ID'] = $id;
	$sql = "SELECT * FROM kategori WHERE IDtarif='$id'";
	$hasil = $mysqli->query($sql) or die("Error: ". $mysqli->error);
	if ($hasil->num_rows == 0){
		die("Kategori tidak ditemukan!");
	}
	$data = $hasil->fetch_row();
?>

<nav aria-label="breadcrumb" role="navigation">
	<ol class="breadcrumb adminx-page-breadcrumb">
		<li class="breadcrumb-item"><a href="?kode=dasboard">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
		<li class="breadcrumb-item active" aria-current="page">Tambah Kategori</li>
	</ol>
</nav>
	
<div class="pb-3">
	<h1>Edit Kategori Bangunan</h1>
</div>
						
<div class="row">
	<div class="col-lg-12">
		<div class="card mb-grid">
			<div class="card-header">
				<div class="card-header-title">Edit Kategori Bangunan</div>
			</div>
			<div class="card-body collapse show" id="card1">
				<form id="ubah" name="ubah">
					<div class="form-group row">
						<label for="text" class="col-sm-2 col-form-label form-label">Kategori Bangunan</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="Bangunan" name="Bangunan" value="<?php echo $data[1] ?>" readonly>
						</div>
					</div>
					<div class="form-group row">
						<label for="text" class="col-sm-2 col-form-label form-label">Tarif per-Kubik</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="tarif" name="tarif" value="<?php echo $data[2] ?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="text" class="col-sm-2 col-form-label form-label">Denda</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="denda" name="denda" value="<?php echo $data[3] ?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="text" class="col-sm-2 col-form-label form-label">Biaya Jasa Administrasi</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="admin" name="admin" value="<?php echo $data[4] ?>">
						</div>
					</div>
					<button type="submit" class="btn btn-primary">Ubah</button>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$("#ubah").submit(function(e){
			e.preventDefault();
			$.ajax({
				url : "simpaneditkategori.php",	
				type : "POST",
				data : $("#ubah").serialize()
			})
			.done(function(hasil){
				bootbox.alert({
					title: "Edit Kategori Berhasil",
					message: hasil,
					callback: function(result){
						window.location.href = "?kode=daftarjenis";
					}
				});
			})
			.fail(function(q, textStatus){
				alert(textStatus);
			})
		});
	});
</script>
