<?php
	include('../koneksi.php');
	session_start();
	$query = "SELECT Periode, Pakai, Tagihan, Bayar, keterangan FROM tagihan WHERE IDpelanggan='$_SESSION[saluran]' AND Bayar='B'";
	$hasil = $mysqli->query($query) or die($mysqli->error);
	$data = $hasil->fetch_array();
	
	require_once('fpdf/fpdf.php');
	
	$pdf = new FPDF('L','cm',array(30,13.3));
	$pdf->AddPage();
	$pdf->SetMargins(1,0.5,0.5);
	
	$pdf->Image('logo.png',9,3,12,7);
	$pdf->Image('pdam.png',1,0,2,2);
	
	$pdf->SetFont('Courier','B',18);
	$pdf->SetTextColor(32, 29, 28);
	$pdf->SetY(1);
	$pdf->SetX(16);	
	$pdf->Cell(13,1,'PDAM AMONG TIRTO KOTA BATU',0,0,'R',false);
	$pdf->SetFont('Courier','B',20);
	$pdf->SetY(2);
	$pdf->SetX(1);
	$pdf->Cell(15,1,'BUKTI PEMBAYARAN REKENING AIR MINUM',0,0,'L',false);
	
	$pdf->SetFont('Courier','',16);
	$pdf->SetX(1);
	$pdf->SetY(3);
	
	$pdf->Cell(5,0.8,'NO SALURAN',0,0,'L',false);
	$pdf->SetX(7);
	$pdf->Cell(5,0.8,': '.$_SESSION['saluran'],0,0,'L',false);
	
	$pdf->SetX(15);
	$pdf->Cell(5,0.8,'TOTAL PAKAI',0,0,'L',false);
	$pdf->SetX(21);
	$pdf->Cell(9,0.8,': '.$data['Pakai'],0,0,'L',false);
	
	$sql = "SELECT * FROM kategori INNER JOIN pelanggan ON kategori.IDtarif=pelanggan.IDtarif WHERE pelanggan.IDsaluran='$_SESSION[saluran]'";
	$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
	$arData = $hasil->fetch_array();
										
	$pdf->SetY(3.8);
	$pdf->Cell(5,0.8,'NAMA',0,0,'L',false);
	$pdf->SetX(7);
	$pdf->Cell(5,0.8,': '.$arData['Nama'],0,0,'L',false);
	
	$pdf->SetX(15);
	$pdf->Cell(5,0.8,'HARGA AIR',0,0,'L',false);
	$pdf->SetX(21); 
	$pdf->Cell(2,0.8,': Rp. ',0,0,'L',false);
	$pdf->SetX(23);
	$pdf->Cell(5,0.8,number_format($arData['tarif'],2,',','.'),0,0,'R',false);
	
	$pdf->SetY(4.6);
	$pdf->Cell(5,0.8,'ALAMAT',0,0,'L',false);
	$pdf->SetX(7);
	$pdf->Cell(5,0.8,': '.$arData['Alamat'],0,0,'L',false);
	
	$admin = $arData['Admin'];
	
	$pdf->SetX(15);
	$pdf->Cell(5,0.8,'JASA ADMIN',0,0,'L',false);
	$pdf->SetX(21);
	$pdf->Cell(2,0.8,': Rp. ',0,0,'L',false);
	$pdf->SetX(23);
	$pdf->Cell(5,0.8,number_format($admin,2,',','.'),0,0,'R',false);
	
	$pdf->SetY(5.4);
	$pdf->Cell(5,0.8,'GOLONGAN',0,0,'L',false);
	$pdf->SetX(7);
	$pdf->Cell(5,0.8,': '.$arData['kategori'],0,0,'L',false);
	
	$tagihan = $data['Tagihan'];
	$tgl = explode('-', $data['Periode']);
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
	};
	$denda = $arData['Denda'];
	$subtotal = $denda * $telat;
		
	$pdf->SetX(15);
	$pdf->Cell(5,0.8,'DENDA',0,0,'L',false);
	$pdf->SetX(21);
	$pdf->Cell(2,0.8,': Rp. ',0,0,'L',false);
	$pdf->SetX(23);
	$pdf->Cell(5,0.8,number_format($subtotal,2,',','.'),0,0,'R',false);
	
	$bulan = date('F Y', strtotime($data['Periode']));
	
	$pdf->SetY(6.2);
	$pdf->Cell(5,0.8,'BULAN/TAHUN',0,0,'L',false);
	$pdf->SetX(7);
	$pdf->Cell(5,0.8,': '.$bulan,0,0,'L',false);
	
	$total = $tagihan + $subtotal + $admin;
	
	$pdf->SetFont('Courier','B',16);
	$pdf->SetX(15);
	$pdf->Cell(5,0.8,'TOTAL',0,0,'L',false);
	$pdf->SetX(21);
	$pdf->Cell(2,0.8,': Rp. ',0,0,'L',false);
	$pdf->SetX(23);
	$pdf->Cell(5,0.8,number_format($total,2,',','.'),0,0,'R',false);
	
	$pdf->SetFont('Courier','B',17);
	$pdf->SetY(7.5);
	$pdf->SetX(0);
	$pdf->Cell(30,1,'PDAM MENYATAKAN STRUK INI SEBAGAI BUKTI PEMBAYARAN YANG SAH, MOHON DISIMPAN',0,0,'C',false);
	
	require_once('terbilang.php');
	$nilai = new huruf();
	
	$pdf->SetFont('Courier','B',16);
	$pdf->SetY(8.8);
	$pdf->Cell(5,0.8,'TERBILANG',0,0,'L',false);
	$pdf->SetX(7);
	$pdf->SetFont('Courier','BI',16);
	$pdf->Cell(5,0.8,': '.$nilai->terbilang($total).'RUPIAH',0,0,'L',false);
	
	$pdf->SetY(9.6);
	$pdf->Cell(5,0.8,'DICETAK DI',0,0,'L',false);
	$pdf->SetX(7);
	$pdf->Cell(5,0.8,': PDAM AMONG TIRTO, JL R.A. KARTINI N0. 20 BATU',0,0,'L',false);
	
	date_default_timezone_set('Asia/Jakarta');
	
	$pdf->SetY(10.4);
	$pdf->Cell(5,0.8,'TANGGAL',0,0,'L',false);
	$pdf->SetX(7);
	$pdf->Cell(5,0.8,': '.date('d-M-Y H:i:s').' WIB',0,0,'L',false);
	
	$sql1 = "UPDATE tagihan SET bayar='S', keterangan=now() WHERE IDpelanggan='$_SESSION[saluran]' AND bayar='B' ";
	$hasil1 = $mysqli->query($sql1) or die ("Error: ". $mysqli->error);
	
	$pdf->Output('I', 'Tagihan.pdf');
?>
