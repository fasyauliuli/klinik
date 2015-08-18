<?php
	include 'dbcon.php';
	
	//---------------DELETE---------------//
	mysql_query("DELETE FROM m_employee");
	mysql_query("DELETE FROM m_employee_positions`");
	mysql_query("DELETE FROM m_obat");
	mysql_query("DELETE FROM m_potongan");
	mysql_query("DELETE FROM tks_keterangan_sakit");
	mysql_query("DELETE FROM tob_transaksi_obat");
	mysql_query("DELETE FROM tpa_pasien");
	
	//---------------INSERT---------------//
	
	/*
	#################### 			####################
	#################### 	MASTER 	####################
	#################### 			####################
	*/
	mysql_query("
	INSERT INTO `m_employee` (`me_id`, `me_md_id`, `me_mep_id`, `me_nik`, `me_rfid`, `me_barcode`, `me_first_name`, `me_middle_name`, `me_last_name`, `me_dob`, `me_gender`, `me_hp`, `me_email`, `me_address`, `me_working_since`, `me_status_kontrak`, `me_status_keaktifan`, `me_kendaraan`, `me_foto`) VALUES
		(1, 10, '1', '123', '', '', 'Mas', '', 'Ganteng', '2015-05-20', '0', '08567167648', 'ones006@gmail.com', 'adasdasd', '2015-05-20', 0, '', '', ''),
		(2, 25, '2', '1267166261', '', '', 'Roso', '', 'Sasongko', '2015-06-07', '1', '081298419718', 'roso.sasongko@gmail.com', 'Jl. DI. Panjaitan No. 128 Purwokerto', '2015-06-07', 0, '', '', '');
	");
	
	mysql_query("
	INSERT INTO `m_employee_positions` (`mep_id`, `mep_name`, `mep_desc`) VALUES
		(1, 'Manager', 'Manager'),
		(2, 'Supervisor', 'Supervisor');
	");
	
	mysql_query("
	INSERT INTO `m_obat` (`mob_id`, `mob_nama_obat`, `mob_tanggal_beli`, `mob_jumlah`, `mob_satuan`) VALUES
		(1, 'promag', '2015-08-05', 10, 'strip'),
		(2, 'OBH', '2015-07-07', 20, 'botol'),
		(3, 'actifed', '2015-08-07', 15, 'botol'),
		(4, 'vitacimin', '2015-08-19', 1, 'kardus'),
		(5, 'albothyl', '2015-08-12', 18, 'botol');
	");
	
	/*
	#################### 					####################
	#################### 	TRANSACTION 	####################
	#################### 					####################
	*/
	mysql_query("
	INSERT INTO `tpa_pasien` (`tpa_id`, `tpa_tanggal_berobat`, `tpa_me_id`) VALUES
		(3, '2015-08-15', 1),
		(4, '2015-08-14', 1),
		(5, '2015-08-16', 1),
		(6, '2015-08-18', 1),
		(7, '2015-08-16', 2),
		(8, '2015-08-07', 2),
		(9, '2015-08-18', 2);
	");
	
	mysql_query("
	INSERT INTO `tob_transaksi_obat` (`tob_id`, `tob_mob_id`, `tob_tpa_id`, `tob_mob_jumlah`) VALUES
		(1,1,3,2),
		(2,2,3,1),
		(3,2,4,1),
		(4,5,4,2),
		(5,1,4,2),
		(6,4,5,1),
		(7,5,6,1),
		(8,3,7,1),
		(9,3,8,1),
		(10,1,9,1);
	");
	
	mysql_query("
	INSERT INTO `tks_keterangan_sakit`(`tks_id`, `tks_tpa_id`, `tks_nama_penyakit`) VALUES 
		(1,3,'batuk'),
		(2,3,'sakit kepala'),
		(3,4,'mencret'),
		(4,4,'diare'),
		(5,4,'pusing'),
		(6,5,'pusing'),
		(7,6,'demam'),
		(8,6,'batuk'),
		(9,7,'maag'),
		(10,7,'muntah-muntah'),
		(11,8,'sulit tidur'),
		(12,8,'mimpi buruk'),
		(13,8,'konsentrasi buruk'),
		(14,9,'maag');
	");
	
	header("location:index.php");
?>