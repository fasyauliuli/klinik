<?php
	include 'dbcon.php';
	
	$ket = $_POST['ketSakit'];
	$jumlah = $_POST['jumlah'];
	$obat = $_POST['obat'];
	$me_id = $_POST['me_id'];
	$mep_id = $_POST['mep_id'];
	
	
	mysql_query("INSERT INTO `tpa_pasien` (`tpa_tanggal_berobat`, `tpa_me_id`) VALUES (CURTIME(), '$me_id')");
	$tpa_id = mysql_insert_id();
	
	foreach($ket as $k)
	{
		mysql_query("INSERT INTO `tks_keterangan_sakit`(`tks_tpa_id`, `tks_nama_penyakit`) VALUES ('$tpa_id','$k')");
	}
	
	$i=0;
	foreach($obat as $mob_id)
	{
		$j = $jumlah[$i++];
		mysql_query("INSERT INTO `tob_transaksi_obat`(`tob_mob_id`, `tob_tpa_id`, `tob_mob_jumlah`) VALUES ('$mob_id','$tpa_id','$j')");
		mysql_query("UPDATE `m_obat` SET `mob_jumlah`=`mob_jumlah`-'$j' WHERE mob_id='$mob_id'");
	}
	header("location: detail.php?id=$mep_id");
	
?>