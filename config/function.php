<?php
define("nama_perusahaan","New Comando Fitness Center");
define("alamat_perusahaan","Jalan Raya Mastrip 185 Jajartunggal, Kedurus, Surabaya");
define("nama_pimpinan","Bayu Anggoro Priyambodho");
define("nip_pimpinan","NIP. 115623210");

function jml_barang($kode_barang,$status){
	$jml_brng = oci_parse($koneksi, "SELECT SUM(JML_TRANSAKSI) AS Jumlah FROM TRANSAKSI WHERE ID_BARANG='$kode_barang' AND STATUS_TRANSAKSI='$status' AND JML_TRANSAKSI>0");
	oci_execute($jml_brng); 
	$jml_barang_ = oci_fetch_array($jml_barang);
	return $jml_barang_[0];
}

function sisa_barang($kode_barang){
	$hasil_sisa="SELECT BARANG.ID_BARANG ,(SELECT SUM(JML_TRANSAKSI) AS jml FROM TRANSAKSI WHERE STATUS_TRANSAKSI = 'M' AND ID_BARANG='$kode_barang' GROUP BY ID_BARANG)-(SELECT SUM(JML_TRANSAKSI) AS jml FROM TRANSAKSI WHERE STATUS_TRANSAKSI='K' AND ID_BARANG='$kode_barang' GROUP BY ID_BARANG) AS sisa FROM BARANG WHERE ID_BARANG='$kode_barang'";
	$sisa = oci_parse($koneksi, $hasil_sisa);
	oci_execute($sisa);
	$db_ = oci_fetch_array($sisa);
	return $db_['sisa'];
}

function jml_retur($kode_barang){
	$hasil_hitung="SELECT SUM(JML_TRANSAKSI) AS jumlah FROM TRANSAKSI WHERE ID_BARANG='$kode_barang' AND STATUS_TRANSAKSI='K' AND JML_TRANSAKSI<0";
	$q = oci_parse($koneksi, $hasil_hitung); oci_execute($q);
	$q_ = oci_fetch_array($q);
	return abs($q_[jumlah]);
}

?>