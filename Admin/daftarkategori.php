<nav aria-label="breadcrumb" role="navigation">
	<ol class="breadcrumb adminx-page-breadcrumb">
		<li class="breadcrumb-item"><a href="?kode=dasboard">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Data Kategori</li>
		<li class="breadcrumb-item active" aria-current="page">Daftar Kategori Bangunan</li>
	</ol>
</nav>
						
<div class="pb-3">
	<h1>Daftar Kategori Bangunan</h1>
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
								<th width="50px">No</th>
								<th width="400px">Kategori Bangunan</th>
								<th width="300px">Tarif (Rp)</th>
								<th width="300px">Denda (Rp)</th>
								<th width="300px">Biaya Admin (Rp)</th>								
								<th width="300px">Action</th>								
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
				url: "prosestampilkategori.php",
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
