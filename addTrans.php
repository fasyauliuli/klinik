<?php
	include 'dbcon.php';
	
	$ket = $_POST['ketSakit'];
	$jumlah = $_POST['jumlah'];
	$tgl = $_POST['tgl'];
	$me_id = $_POST['me_id'];
	$idPasienT = $_POST['idPasienT'];
	$idPasienK = $_POST['idPasienK'];
	$idObat = $_POST['idObat'];
	$mep_id = $_POST['mep_id'];
	
	mysql_query("INSERT INTO `tpa_pasien` (`tpa_tgl_berobat`, `tpa_me_id`) VALUES ('$tgl', '$me_id')");
	mysql_query("INSERT INTO `tks_keterangan_sakit` (`tks_nama_penyakit`, `tks_tpa_id`) VALUES ('$ketSakit', '$idPasienK')");
	mysql_query("INSERT INTO `tob_transaksi_obat` (`tob_tpa_id`, `tob_mob_id`, `tob_mob_jumlah') VALUES ('$idPasienT', '$idObat', '$jumlah')");
	
	header("location: detail.php?id=$mep_id");
	
?>