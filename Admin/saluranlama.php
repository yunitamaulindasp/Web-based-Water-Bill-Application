<nav aria-label="breadcrumb" role="navigation">
	<ol class="breadcrumb adminx-page-breadcrumb">
		<li class="breadcrumb-item"><a href="?kode=dasboard">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Data Pelanggan</li>
		<li class="breadcrumb-item active" aria-current="page">Pelanggan Lama</li>
	</ol>
</nav>
						
<div class="pb-3">
	<h1>Daftar Saluran Lama</h1>
</div>
						
<div class="row">
	<div class="col">
		<div class="card mb-grid">
			<div class="table-responsive-md">
				<div class="card-body">
					<table id="tabel" class="table table-bordered" data-table>
						<style>
							th,td { text-align: center; }
						</style>
						<thead>
							<tr>
								<th width="50px">ID Saluran</th>
								<th width="100px">Kategori Bangunan</th>
								<th width="200px">Nama</th>
								<th width="200px">Alamat</th>
								<th width="200px">Rincian</th>					
							</tr>
						</thead>				
						<tbody>				
						</tbody>
					</table>
				</div>				
			</div>
		</div>
	</div>					
</div>

<script type="text/javascript">
	$(document).ready(function(){
		var dataTable = $('#tabel').DataTable( {
			"processing": true,
			"serverSide": true,
			"bSort": false,
			"ajax": {
				url: "prosestampilsaluran.php",
				type: "POST",
				error: function(){
					$(".lookup-error").html("");
					$("#tabel").append('<tbody class="employee-grid-error"> <tr> <th colspan="5"> Data Tidak Ditemukan </th> </tr> </tbody>');
					$("#lookup_processing").css("display", "none");
				}
			}
			  
		});
	});
</script>
