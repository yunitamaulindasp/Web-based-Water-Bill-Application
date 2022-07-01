<?php
	require '../koneksi.php';
	$requestData = $_REQUEST;
	$sql = "SELECT count(*) FROM pelanggan";
	$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
	$data = $hasil->fetch_row();
	$totalData = $data[0];
	$totalFilter = $totalData;

	$parameter = $requestData['search']['value'];
	$start = $requestData['start'];
	$length = $requestData['length'];
	
	if (empty($parameter))
	{	$sql = "SELECT IDsaluran, IDtarif, Nama, IDwilayah ";
		$sql .= " FROM pelanggan ";
		$sql .= " LIMIT $start, $length";
		$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
	}
	else	
	{	$sql = "SELECT IDsaluran, IDtarif, Nama, IDwilayah ";
		$sql .= " FROM pelanggan ";
		$sql .= " WHERE Nama LIKE '%$parameter%' ";
		$sql .= " OR IDsaluran LIKE '%$parameter%' ";
		$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
		$totalFilter = $hasil->num_rows;
		$sql .= " LIMIT $start, $length";
		$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
	}
	
	$data = array();
	$counter = $start + 1;
	while ($row = $hasil->fetch_row())
	{	$nestedData = array();
		$nestedData[] = $row[0];
		
		$add = "SELECT * FROM kategori WHERE IDtarif=$row[1]";
		$hsl = $mysqli->query($add);
		$arData = $hsl->fetch_array();
		
		$nestedData[] = $arData['kategori'];
		
		$nestedData[] = $row[2];
		
		$add1 = "SELECT * FROM wilayah WHERE IDwilayah=$row[3]";
		$hsl1 = $mysqli->query($add1);
		$arData1 = $hsl1->fetch_array();
		
		$nestedData[] = $arData1['desa'];
		
		$nestedData[] = '<a href="?kode=rincian&saluran='.$row[0].'"><button type="button" class="btn btn-outline-info btn-icon-text">Rincian</button></a>';
		$data[] = $nestedData;
		$counter++;
	}
	
	$jsonData = array(
		"draw" => intval($requestData['draw']),
		"recordsTotal" => intval($totalData),
		"recordsFiltered" => intval($totalFilter),
		"data" => $data
	);
	echo json_encode($jsonData);
?>
