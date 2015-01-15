<?php
//membangun koneksi
$username="andriyan";
$password="andriyan";
$database="localhost/xe";
 
$koneksi=oci_connect($username,$password,$database);
 
if($koneksi){
	//echo "Koneksi berhasil";
}else{
	$err=oci_error();
	echo "Gagal tersambung ke ORACLE". $err['text'];
}
?>