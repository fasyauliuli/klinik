<?php
	include 'dbcon.php';
	
	$nama = $_POST['nama'];
	$gender = $_POST['gender'];
	$pekerjaan = $_POST['pekerjaan'];
	$tanggalLahir = $_POST['tanggalLahir'];
	$no_HP = $_POST['no_HP'];
	$alamat = $_POST['alamat'];
	
	mysql_query("INSERT INTO `m_pengunjung`(`mp_nama_lengkap`, `mp_tanggal_lahir`, `mp_alamat`, `mp_no_hp`, `mp_pekerjaan`, `mp_jk`) VALUES ('$nama','$tanggalLahir','$alamat','$no_HP', '$pekerjaan', '$gender')");
	
	header("location: pasien.php");
?>