<?php
	require '../koneksi.php';
	session_start();
	$requestData = $_REQUEST; 

	$sql = "SELECT count(*) FROM tagihan WHERE IDpelanggan='$_SESSION[saluran]' ";
	$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
	$data = $hasil->fetch_row();
	$totalData = $data[0];
	$totalFilter = $totalData;
	$parameter = $requestData['search']['value'];
	$start = $requestData['start'];
	$length = $requestData['length'];
	if (empty($parameter))
	{	$sql = "SELECT Periode, Pakai, Tagihan, Bayar, keterangan ";
		$sql .= " FROM tagihan WHERE IDpelanggan='$_SESSION[saluran]' ";
		$sql .= " LIMIT $start, $length";
		$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
	}
	else	
	{	$sql = "SELECT Periode, Pakai, Tagihan, Bayar, keterangan ";
		$sql .= " FROM tagihan WHERE IDpelanggan='$_SESSION[saluran]' ";
		$sql .= " WHERE Periode LIKE '%$parameter%' ";
		$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
		$totalFilter = $hasil->num_rows;
		$sql .= " LIMIT $start, $length";
		$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
	}
	
	$data = array();
	$counter = $start + 1;
	while ($row = $hasil->fetch_row())
	{	$nestedData = array();
		
		$bulan = date('F Y', strtotime($row[0]));
		$nestedData[] = $bulan;
	 
		$nestedData[] = $row[1];
		
		$nestedData[] = 'Rp. '.number_format($row[2],0,',','.');
		
		$tagihan = $row[2];
							
		$tgl = explode('-', $row[0]);
		$periode = $tgl[1];
		$thn = $tgl[2];
									
		$bln = date('m');
		$thn1 = date('y');
		
		$sls_thn = $thn1 - $thn;
		if ( $sls_thn == 0)
		{	$telat = $bln - $periode;	}
		else
		{
			$sls = $sls_thn;
			if ( $sls == 1 )
			{	$telat = ( 12 - $periode ) + $bln;	}
			else
			{	$telat = ( ( 12 - $periode ) + $bln ) + ( 12 * $sls );	}
		}
								
		$sql1 = "SELECT * FROM kategori INNER JOIN pelanggan ON kategori.IDtarif=pelanggan.IDtarif WHERE pelanggan.IDsaluran='$_SESSION[saluran]'";
		$hasil1 = $mysqli->query($sql1) or die ("Error: ". $mysqli->error);
		$arData1 = $hasil1->fetch_array();
		
		if ( $row[3] == 'B' )
		{
			$denda = $arData1['Denda'];
									
			$subtotal = $denda * $telat;
							
			$nestedData[] = 'Rp. '.number_format($subtotal,0,',','.'); 
			
			$total = $tagihan + $subtotal;
			
		}
		else
		{	
			$nestedData[] = 'Rp. 0';
			$total = $tagihan;
		}
									
		$nestedData[] = 'Rp. '.number_format($total,0,',','.');
		
		if ($row[3] == 'B')
		{	$nestedData[] = 'TAGIHAN'; }
		else
		{	$nestedData[] = date('d-m-Y', strtotime($row[4])); }
		
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
