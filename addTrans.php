<?php
	include 'dbcon.php';
	
	$id = $_POST['id'];
	$ket = $_POST['ket'];
	$nama = $_POST['nama'];
	$jumlah = $_POST['jumlah'];
	
	mysql_query("INSERT INTO `tpa_pasien` ('tpa_keterangan') VALUES ('$ket')");
	mysql_query("UPDATE `m_obat` = '$nama',`mob_jumlah' = '$jumlah' WHERE mob_id = '$id'" );
	
	header("location: detail.php");
	
?>