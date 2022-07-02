<?php
	require '../koneksi.php';
	$requestData = $_REQUEST;

	$sql = "SELECT count(*) FROM kategori";
	$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
	$data = $hasil->fetch_row();
	$totalData = $data[0];
	$totalFilter = $totalData;
	$parameter = $requestData['search']['value'];
	$start = $requestData['start'];
	$length = $requestData['length'];
	if (empty($parameter)){	
		$sql = "SELECT  IDtarif, kategori, tarif, Denda, Admin ";
		$sql .= " FROM kategori ";
		$sql .= " LIMIT $start, $length";
		$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
	} else{
		$sql = "SELECT IDtarif, kategori, tarif, Denda, Admin ";
		$sql .= " FROM kategori ";
		$sql .= " WHERE kategori LIKE '%$parameter%' ";
		$sql .= " OR tarif LIKE '%$parameter%' ";
		$sql .= " OR denda LIKE '%$parameter%' ";
		$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
		$totalFilter = $hasil->num_rows;
		$sql .= " LIMIT $start, $length";
		$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
	}
	
	$data = array();
	$counter = $start + 1;
	while ($row = $hasil->fetch_row()){
		$nestedData = array();
		$nestedData[] = $counter;
		$nestedData[] = $row[1];
		$nestedData[] = number_format($row[2],0,',','.');
		$nestedData[] = number_format($row[3],0,',','.');
		$nestedData[] = number_format($row[4],0,',','.');
		$nestedData[] = '<a href="?kode=edit&ID='.$row[0].'"><button type="button" class="btn btn-outline-success btn-icon-text">Edit</button></a>';
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
