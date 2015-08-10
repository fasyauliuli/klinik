<?php
	include 'dbcon.php';
	
	$nama = $_POST['nama'];
	$tanggal = $_POST['tanggal'];
	$jumlah = $_POST['jumlah'];
	$satuan = $_POST['satuan'];
	
	mysql_query("INSERT INTO `m_obat`(`mob_nama_obat`, `mob_tanggal_beli`, `mob_jumlah`, `mob_satuan`) VALUES ('$nama','$tanggal','$jumlah','$satuan')");
	
	header("location: stok.php");
?>