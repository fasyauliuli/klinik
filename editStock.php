<?php
	include 'dbcon.php';
	
	$id = $_POST['id'];
	$nama = $_POST['nama'];
	$tanggal = $_POST['tanggal'];
	$jumlah = $_POST['jumlah'];
	$satuan = $_POST['satuan'];
	
	mysql_query("UPDATE `m_obat` SET `mob_nama_obat`='$nama',`mob_tanggal_beli`='$tanggal',`mob_jumlah`= `mob_jumlah` + '$jumlah',`mob_satuan`='$satuan' WHERE mob_id = '$id'");
	header("location: stok.php");
?>