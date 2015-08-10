<?php
	include 'dbcon.php';
	
	$id_obat = $_POST['id_obat'];
	
	mysql_query("DELETE FROM `m_obat` WHERE mob_id='$id_obat'");
	
	header("location: stok.php");
?>