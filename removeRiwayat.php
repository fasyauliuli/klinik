<?php
	include 'dbcon.php';
	
	$id_pasien = $_POST['id_pasien'];
	$id_obat = $POST['id_obat'];
	$id_ket = $POST['id_ket'];
	
	mysql_query("DELETE FROM `tpa_pasien` WHERE tpa_pasien='$id_pasien'");
	mysql_query("DELETE FROM `tob_transaksi_obat` WHERE tob_mob_id = '$id_obat'");
	mysql_query("DELETE FROM `tks_keterangan_sakit` WHERE tks_id = '$id_ket'");
	
	header("location: detail.php");
?>