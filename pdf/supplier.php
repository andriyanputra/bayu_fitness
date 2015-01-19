<?php
include ('../assets/fpdf/fpdf.php');
include ('../config/koneksi.php');
include ('../config/function.php');
$logo = "../assets/img/logo.png";		

		$pdf = new FPDF('L','cm','Legal');
		$pdf->AddPage();
		$pdf->SetFont('Helvetica','',14);
		// Logo
		//$pdf->Image($logo,1,1,-300);
		$pdf->Write(0.5, nama_perusahaan);$pdf->Ln();
		$pdf->SetFontSize(10);
		$pdf->Write(0.5, 'DAFTAR SUPPLIER');$pdf->Ln();
		$pdf->Write(0.5, alamat_perusahaan);$pdf->Ln();

		$pdf->Ln();
		$pdf->SetFont('Helvetica','B',12);
		$pdf->cell(1,2, 'No.',1,0,'C');
		$pdf->cell(2.5,2, 'Kode',1,0,C);
		$pdf->cell(6,2, 'Nama Supplier',1,0,C);
		$pdf->cell(13,2, 'Alamat',1,0,C);
		$pdf->cell(4,2, 'No. Telepon / Fax',1,0,C);
		$pdf->cell(6,2, 'Email',1,0,C);
		$pdf->Ln();

		$no=0;
		$sql=oci_parse($koneksi, "SELECT * FROM SUPPLIER ORDER BY ID_SUPPLIER ASC");oci_execute($sql);
		while ($data=oci_fetch_array($sql)) {$no++;
		$pdf->SetFont('Helvetica','',10);
		$pdf->cell(1,0.5, $no.'.',1,0,'L');
		$pdf->cell(2.5,0.5, $data['ID_SUPPLIER'],1);
		$pdf->SetFont('Helvetica','',11);
		$nama=str_replace("\\","",$data['NM_SUPPLIER']);
		$pdf->cell(6,0.5, $nama,1);
		$pdf->cell(13,0.5, $data['ALAMAT_SUPPLIER'],1);
		$pdf->cell(4,0.5, $data['TELEPON']." / ".$data["FAX"],1);
		$pdf->cell(6,0.5, $data['EMAIL_SUPPLIER'],1);

		$pdf->Ln();
		}


		$pdf->Ln();$no=0;
		$pdf->Ln();
		$pdf->SetFont('Helvetica','',12);
		$pdf->cell(0.5,0.5, 'Kuningan, '. date("d M Y"));$pdf->Ln(0.75);
		$pdf->cell(0.5,0.5, 'Pimpinan');$pdf->cell(7);
		$pdf->cell(0.5,0.5, '');$pdf->cell(7);
		$pdf->cell(0.5,0.5, '');$pdf->cell(4);$pdf->Ln(1.5);$pdf->Ln(1.5);
		$pdf->cell(0.5,0.5, nama_pimpinan);$pdf->cell(7);$pdf->Ln(0.5);
		$pdf->cell(0.5,0.5, nip_pimpinan);$pdf->cell(7);
		$pdf->SetFont('Helvetica','BU',12);
		$pdf->Output();
		exit;

?>
