<?php 
	/*$sql_emp = "SELECT NM_PEGAWAI, NOTIF_PEGAWAI, SUBSTR((current_timestamp - log), INSTR((current_timestamp - log),' ')+7,2) SS,
				SUBSTR((current_timestamp - log), INSTR((current_timestamp - log),' ')+4,2) MI,
				SUBSTR((current_timestamp - log), INSTR((current_timestamp - log),' ')+1,2) HH,
				TRUNC(TO_NUMBER(SUBSTR((current_timestamp - log),1, INSTR(current_timestamp - log,' ')))) Days, FOTO_PEGAWAI FROM PEGAWAI
				WHERE PEGAWAI.NOTIF_PEGAWAI != 0";
	$sql_mem = "SELECT NM_MEMBER, NOTIF_MEMBER, SUBSTR((current_timestamp - log), INSTR((current_timestamp - log),' ')+7,2) SS,
				SUBSTR((current_timestamp - log), INSTR((current_timestamp - log),' ')+4,2) MI,
				SUBSTR((current_timestamp - log), INSTR((current_timestamp - log),' ')+1,2) HH,
				TRUNC(TO_NUMBER(SUBSTR((current_timestamp - log),1, INSTR(current_timestamp - log,' ')))) Days, FOTO_MEMBER FROM MEMBER
				WHERE MEMBER.NOTIF_MEMBER != 0";*/
	$sql_emp = "SELECT NIP_PEGAWAI, NM_PEGAWAI, NOTIF_PEGAWAI, FOTO_PEGAWAI, TO_CHAR(log,'DD-MM-YYYY HH24:MI:SS') FROM PEGAWAI WHERE PEGAWAI.NOTIF_PEGAWAI != 0";
	$sql_mem = "SELECT ID_MEMBER, NM_MEMBER, NOTIF_MEMBER, FOTO_MEMBER, TO_CHAR(log,'DD-MM-YYYY HH24:MI:SS') FROM MEMBER WHERE MEMBER.NOTIF_MEMBER != 0";
	$notif_pegawai = oci_parse($koneksi, $sql_emp); oci_execute($notif_pegawai);
    $notif_member = oci_parse($koneksi, $sql_mem); oci_execute($notif_member);

    $jml_emp = oci_parse($koneksi, "SELECT COUNT(NOTIF_PEGAWAI) AS JML_EMP FROM PEGAWAI WHERE PEGAWAI.NOTIF_PEGAWAI != 0"); 
    oci_execute($jml_emp); $emp_ = oci_fetch_array($jml_emp);
    $jml_mem = oci_parse($koneksi, "SELECT COUNT(NOTIF_MEMBER) AS JML_MEM FROM MEMBER WHERE MEMBER.NOTIF_MEMBER != 0"); 
    oci_execute($jml_mem); $mem_ = oci_fetch_array($jml_mem);
?>