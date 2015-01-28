<?php
  include ('../assets/fpdf/fpdf.php');
  include ('../config/koneksi.php');
  $logo = "../assets/img/logo.png";

	$cetak = oci_parse($koneksi, "SELECT * FROM MEMBER WHERE ID_MEMBER = '$_GET[id]'"); oci_execute($cetak);
	$db = oci_fetch_row($cetak);
  
  $pdf = new FPDF('L', 'mm', array(90, 50));
  $pdf->AddPage();
  $pdf->SetFont('Helvetica','B',10);
  $pdf->SetTextColor(255,255,255);
  $pdf->SetFillColor(0,255,0);
  $pdf->Cell(30, 6, 'This is white text on a black box', 1, 0, 'L', TRUE);
  $pdf->Cell(30, 6, 'This is white text on a black box', 1, 0, 'L', TRUE);
  $pdf->Output();
  exit;  
?>