<nav aria-label="breadcrumb" role="navigation">
	<ol class="breadcrumb adminx-page-breadcrumb">
		<li class="breadcrumb-item"><a href="?kode=dasboard">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Data Wilayah</li>
		<li class="breadcrumb-item active" aria-current="page">Daftar Kecamatan Kota Batu</li>
	</ol>
</nav>
						
<div class="pb-3">
	<h1>Daftar Kecamatan Kota Batu</h1>
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
								<th width="400px">Kecamatan</th>
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
	function KonfirmasiHapus(x)
	{	bootbox.confirm({
			title: "Konfirmasi",
			message: "ID Kecamatan " + x + " dihapus?",
			callback: function(result){
				if (result == true)
				{	$.ajax({
						type: "GET",
						url: "hapuskecamatan.php",
						data: { "ID" : x},
				})
				.done(function(hasilProses){
					bootbox.alert({
						title: "Hasil Penghapusan",
						message: hasilProses,
						callback: function(result){
							window.location.href = "?kode=tampilkecamatan";
						}
					});
				})
				.fail(function(jqXHR, textStatus){
					alert( "Request gagal: " + textStatus );
				});
				}
			}
	});
	}
	$(document).ready(function(){
		var dataTable = $('#tabel').DataTable( {
			"processing": true,
			"serverSide": true,
			"bSort": false,
			"ajax": {
				url: "prosestampilkecamatan.php",
				type: "POST",
				error: function(){ 
					$(".lookup-error").html("");
					$("#tabel").append('<tbody class="employee-grid-error"> <tr> <th colspan="2"> Data Tidak Ditemukan </th> </tr> </tbody>');
					$("#lookup_processing").css("display", "none");
				}
			}
			  
		});
	});
</script>
