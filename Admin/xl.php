<?php
	require '../Web/vendor/vendor/autoload.php';
	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
	
	$spreadsheet = new Spreadsheet();
	
	$spreadsheet->setActiveSheetIndex(0);
	$sheet = $spreadsheet->getActiveSheet();
	$sheet->setTitle('Riwayat Tagihan');
	
	include('../koneksi.php');
	$ID = $_GET['ID'];
	$query = 'SELECT Periode, Pakai, Tagihan, Bayar, keterangan FROM tagihan WHERE IDPelanggan='.$ID;
	$hasil = $mysqli->query($query) or die($mysqli->error);
	$jumlahData = $hasil->num_rows;
	
	$sheet->setCellValue('A1', 'PDAM Among Tirto Kota Batu');
	$sheet->setCellValue('A2', 'JL R.A. Kartini No. 20 BATU 65311');
	$sheet->getStyle('A1:G2')->getFont()->setBold(True);
	$sheet->getStyle('A1:G2')->getFont()->getColor()->setRGB('0000FF');
	
	$sheet->setCellValue('A4', 'ID Saluran');
	$sheet->mergeCells('A4:B4');
		$sql = "SELECT * FROM pelanggan WHERE IDsaluran=$ID";
		$hasilx = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
		$arData = $hasilx->fetch_array();
	$sheet->setCellValue('C4', ': '.$arData['IDsaluran']);
	$sheet->mergeCells('C4:F4');
	
	$sheet->setCellValue('A5', 'Kategori Bangunan');
	$sheet->mergeCells('A5:B5');
		$idk = $arData['IDtarif'];
		$sql1 = "SELECT * FROM kategori WHERE IDtarif=$idk";
		$hasil1 = $mysqli->query($sql1) or die ("Error: ". $mysqli->error);
		$arData1 = $hasil1->fetch_array();
	$sheet->setCellValue('C5', ': '.$arData1['kategori']);
	$sheet->mergeCells('C5:F5');
	
	$sheet->setCellValue('A6', 'Nama');
	$sheet->mergeCells('A6:B6');
	$sheet->setCellValue('C6', ': '.$arData['Nama']);
	$sheet->mergeCells('C6:F6');
	
	$sheet->setCellValue('A7', 'Alamat');
	$sheet->mergeCells('A7:B7');
		$wil = $arData['IDwilayah'];
		$sql2 = "SELECT * FROM wilayah INNER JOIN kecamatan ON IDKec=IDkecamatan
				 WHERE IDwilayah=$wil";
		$hasil2 = $mysqli->query($sql2) or die ("Error: ". $mysqli->error);
		$arData2 = $hasil2->fetch_array();
	$sheet->setCellValue('C7', ': '.$arData['Alamat'].", ".$arData2['desa'].", Kec. ".$arData2['kecamatan']);
	$sheet->mergeCells('C7:F7');
	
	$sheet->setCellValue('A9', 'Riwayat Tagihan');
	$sheet->mergeCells('A9:G9');
	$sheet->getStyle('A4:G9')->getFont()->setBold(True);
	$sheet->getStyle('A9')->getAlignment()->setHorizontal('center');
	$sheet->getColumnDimension('A')->setWidth(5);
	$sheet->getColumnDimension('B')->setWidth(20);
	$sheet->getColumnDimension('C')->setWidth(10);
	$sheet->getColumnDimension('D')->setWidth(15);
	$sheet->getColumnDimension('E')->setWidth(15);
	$sheet->getColumnDimension('F')->setWidth(20);
	$sheet->getColumnDimension('G')->setWidth(15);
	
	$judul = array('No', 'Periode', 'Pakai', 'Tagihan', 'Denda', 'Total Tagihan', 'Keterangan');
	for ($i=0; $i<7; $i++){
		$sheet->setCellValueByColumnAndRow($i+1, 11, $judul[$i]);	}
	$sheet->getStyle('A11:G11')->getFont()->setBold(True);
	$sheet->getStyle('A11:G11')->getAlignment()->setHorizontal('center');
	$baris = 12;
	$no_baris = 1;
	while ($data = $hasil->fetch_array()){
		$sheet->setCellValue('A'.$baris, $no_baris);
		
		$bulan = date('F Y', strtotime($data[0]));
		$sheet->setCellValue('B'.$baris, $bulan);
		
		$sheet->setCellValue('C'.$baris, $data[1]);
		
		$sheet->setCellValue('D'.$baris, 'Rp. '.number_format($data[2],0,',','.'));
		
		$tagihan = $data[2];
							
		$tgl = explode('-', $data[0]);
		$periode = $tgl[1];
		$thn = $tgl[2];
									
		$bln = date('m');
		$thn1 = date('y');
		
		$sls_thn = $thn1 - $thn;
		if ( $sls_thn == 0){
			$telat = $bln - $periode;
		} else{
			$sls = $sls_thn;
			if ( $sls == 1 ){
				$telat = ( 12 - $periode ) + $bln;
			} else{
				$telat = ( ( 12 - $periode ) + $bln ) + ( 12 * $sls );
			}
		}
								
		$sql1 = "SELECT * FROM kategori INNER JOIN pelanggan ON kategori.IDtarif=pelanggan.IDtarif WHERE pelanggan.IDsaluran='$_SESSION[saluran]'";
		$hasil1 = $mysqli->query($sql1) or die ("Error: ". $mysqli->error);
		$arData1 = $hasil1->fetch_array();
		
		if ( $data[3] == 'B' ){
			$denda = $arData1['Denda'];
									
			$subtotal = $denda * $telat; 
			
			$total = $tagihan + $subtotal;
			
		} else{	
			$subtotal = 0;
			$total = $tagihan;
		}
		
		$sheet->setCellValue('E'.$baris, 'Rp. '.number_format($subtotal,0,',','.'));
		
		$sheet->setCellValue('F'.$baris, 'Rp. '.number_format($total,0,',','.'));
		
		if ($data[3] == 'B'){
			$sheet->setCellValue('G'.$baris, 'TAGIHAN');
		} else{	
			$tgl = date('d-m-Y', strtotime($data[4])); 
			$sheet->setCellValue('G'.$baris, $tgl);
		}
		
		$no_baris++;
		$baris++;
	}
	
	$sheet->getStyle('A11:G'.($baris-1))->getBorders()->getAllBorders()->setBorderStyle('thin');
	$sheet->getStyle('A12:A'.($baris-1))->getAlignment()->setHorizontal('center');
	$sheet->getStyle('B12:B'.($baris-1))->getAlignment()->setHorizontal('center');
	$sheet->getStyle('C12:C'.($baris-1))->getAlignment()->setHorizontal('center');
	$sheet->getStyle('G12:G'.($baris-1))->getAlignment()->setHorizontal('center');
	
	$sheet->getPageMargins()->setTop(1);
	$sheet->getPageMargins()->setRight(0.75);
	$sheet->getPageMargins()->setLeft(0.75);
	$sheet->getPageMargins()->setBottom(1);
	$sheet->getPageSetup()->setPaperSize('PAPERSIZE_A4');
	
	$namafile = 'Riwayat Tagihan.xlsx';
	$writer = new Xlsx($spreadsheet);
	$writer->save($namafile.'.xlsx');
	
	echo "<script>alert('Silakan Print File');window.history.go(-1);</script>";
?>
