<?php
	include 'dbcon.php';
	
	$id_pasien = $_POST['id_pasien'];
	$mep_id = $_POST['mep_id'];
	
	mysql_query("DELETE FROM `tpa_pasien` WHERE tpa_id = '$id_pasien'");
	mysql_query("DELETE FROM `tob_transaksi_obat` WHERE tob_tpa_id = '$id_pasien'");
	mysql_query("DELETE FROM `tks_keterangan_sakit` WHERE tks_tpa_id = '$id_pasien'");
	
	header("location: detail.php?id=$mep_id");
?>