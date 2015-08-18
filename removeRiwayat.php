<?php
	include 'dbcon.php';
	
	$tpa_id = $_POST['id_pasien'];
	$mep_id = $_POST['mep_id'];
	
	mysql_query("delete from tks_keterangan_sakit where tks_tpa_id='$tpa_id'");
	
	$query = mysql_query("select * from tob_transaksi_obat where tob_tpa_id='$tpa_id'");
	while($row= mysql_fetch_array($query))
	{
		$mob_id = $row['tob_mob_id'];
		$j = $row['tob_mob_jumlah'];
		$tob_id = $row['tob_id'];
		
		mysql_query("UPDATE `m_obat` SET `mob_jumlah`=`mob_jumlah`+'$j' WHERE mob_id='$mob_id'");
		mysql_query("delete from tob_transaksi_obat where tob_id='$tob_id'");
	}
	
	mysql_query("delete from tpa_pasien where tpa_id = '$tpa_id'");
	header("location: detail.php?id=$mep_id");
?>