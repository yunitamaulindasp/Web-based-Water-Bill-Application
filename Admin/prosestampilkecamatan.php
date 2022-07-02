<?php
	require '../koneksi.php';
	$requestData = $_REQUEST;
	
	$sql = "SELECT count(*) FROM kecamatan";
	$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
	$data = $hasil->fetch_row();
	$totalData = $data[0];
	$totalFilter = $totalData;
	$parameter = $requestData['search']['value'];
	$start = $requestData['start'];
	$length = $requestData['length'];
	
	if (empty($parameter))
	{	$sql = "SELECT IDkecamatan, kecamatan ";
		$sql .= " FROM kecamatan ";
		$sql .= " LIMIT $start, $length";
		$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
	}
	else 	
	{	$sql = "SELECT IDkecamatan, kecamatan ";
		$sql .= " FROM kecamatan ";
		$sql .= " WHERE kecamatan LIKE '%$parameter%' ";
		$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
		$totalFilter = $hasil->num_rows;
		$sql .= " LIMIT $start, $length";
		$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
	}
	
	$data = array();
	$counter = $start + 1;
	while ($row = $hasil->fetch_row())
	{	$nestedData = array();
		$nestedData[] = $counter;
		$nestedData[] = $row[1];
		$nestedData[] = '<a href="javascript:KonfirmasiHapus('.$row[0].');"><button type="button" class="btn btn-outline-success btn-icon-text">Hapus</button></a>';
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
