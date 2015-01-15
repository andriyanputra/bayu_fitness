<?php
/*if (!$db=oci_connect('andriyan','andriyan','localhost/xe')) {
die("Cannot connect to the database");
}
$qry='select * from pegawai';
$csr=oci_parse($db,$qry);
if (!oci_execute($csr)) {
die("Something is screwed up with the SQL");
} else {
while ($row=oci_fetch_array($csr,OCI_NUM)) {
//printf("EMPNO=%d\n",$row[0]);
}
$numrows = oci_num_rows($csr);
printf("The number of returned rows is:%d\n",$numrows);
}*/


function cek_supplier($id_supplier) {
	$qry="select ID_SUPPLIER from SUPPLIER WHERE ID_SUPPLIER='$id_supplier'";
	$hasil_cek=oci_parse($koneksi,$qry);
	if (!oci_execute($hasil_cek)) {
		die("Something is screwed up with the SQL");
	} else {
		oci_execute($hasil_cek);
		while ($row=oci_fetch_array($hasil_cek,OCI_NUM)) {
		//printf("EMPNO=%d\n",$row[0]);
		}
		$numrows = oci_num_rows($hasil_cek);
		return $numrows;
		//echo $numrows;
	}
}

/*function cek_barang($kode_barang) {
	$hasil_cek=mysql_num_rows(mysql_query("select IDBarang from tblbarang where IDBarang='$kode_barang'"));
	return $hasil_cek;
}

function cek_penjualan($tgl_transaksi) {
	$hasil_cek=mysql_num_rows(mysql_query("select *  from v_laporan_penjualan where TglTransaksi='$tgl_transaksi'"));
	return $hasil_cek;
}

function jml_barang($kode_barang,$status){
	$hasil_hitung=mysql_fetch_array(mysql_query("select sum(jumlah) as jumlah from tbltransaksi where IDBarang='$kode_barang' and status='$status' and Jumlah>0"));
	return $hasil_hitung[jumlah];
}

function jml_retur($kode_barang){
$hasil_hitung=mysql_fetch_array(mysql_query("select sum(jumlah) as jumlah from tbltransaksi where IDBarang='$kode_barang' and status='K' and Jumlah<0"));
return abs($hasil_hitung[jumlah]);
}

function sisa_barang($kode_barang){
$hasil_sisa=mysql_fetch_array(mysql_query("select tblbarang.IDBarang ,(select sum(jumlah) as jml FROM 
tbltransaksi 
where status='M' and IDBarang='$kode_barang'
group by IDBarang)-(select sum(jumlah) as jml FROM 
tbltransaksi 
where status='K' and IDBarang='$kode_barang'
group by IDBarang)
as sisa from tblbarang where IDBarang='$kode_barang'
"));

return $hasil_sisa[sisa];
}

function ambil_tgl_transaksi($id) {
$sql_tgl=mysql_fetch_array(mysql_query("select * from tbltransaksi where IDTransaksi='$id'"));
return $sql_tgl[TglTransaksi];
}

function ambil_kode_supplier($kode_barang) {
$sql_supplier=mysql_fetch_array(mysql_query("select * from tblbarang where IDBarang='$kode_barang'"));
return $sql_supplier[IDSupplier];
}*/





?>