<?php

include "fpdf.php";
include "../dbcon.php";

$pdf = new FPDF('L','mm',array(215.9,330.2));
$pdf->AddPage();

$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(0,5, 'LAPORAN HARIAN KUNJUNGAN PASIEN KLINIK PT. MUS', '0', '1', 'C', false);
$pdf->SetFont('Times', 'B', 11);

$pdf->Ln(4);
$query = mysql_query("select * from tpa_pasien where tpa_tanggal_berobat = CURDATE()");
$row = mysql_fetch_array($query);

$pdf->Cell(0,0, 'TANGGAL : ' .$row['tpa_tanggal_berobat'], '0', '1', 'C', false);
$pdf->Ln(7);

$pdf->SetFont('Times');
$pdf->Cell(8,6, 'No.', 1,0,'C');
$pdf->Cell(20,6,'JAM',1,0,'C');
$pdf->Cell(33,6,'NAMA PASIEN',1,0,'C');
$pdf->Cell(30,6,'UMUR (Tahun)',1,0,'C');
$pdf->Cell(9,6,'L/P',1,0,'C');
$pdf->Cell(58,6,'BAGIAN/JABATAN/ALAMAT',1,0,'C');
$pdf->Cell(33,6,'DIAGNOSIS',1,0,'C');
$pdf->Cell(50,6,'TERAPI',1,0,'C');
$pdf->Cell(30,6,'BIAYA (Rupiah)',1,0,'C');
$pdf->Cell(38,6,'KETERANGAN',1,0,'C');

$query = mysql_query("select * from tpa_pasien where tpa_tanggal_berobat = CURDATE()");
$no = 0;
while($row = mysql_fetch_array($query))
	{
		$me_id = $row['tpa_me_id'];
		$q = mysql_query("select * from m_employee where me_id='$me_id'");
		$r = mysql_fetch_array($q);
		$birth = $r['me_dob'];
		$from = new DateTime($birth);
		$to = new DateTime('today');
		$umur = $from ->diff($to)->y;
		if($r['me_gender']) $gender = 'L'; else $gender = 'P';
		
		$mep_id = $r['me_mep_id'];
		$db = mysql_query("select * from m_employee_positions where mep_id = '$mep_id'");
		$f = mysql_fetch_array($db);
		
		$tks_tpa_id = $row['tpa_id'];
		$tabel = mysql_query("select * from tks_keterangan_sakit where tks_tpa_id = '$tks_tpa_id'");
		$baris = mysql_fetch_array($tabel);
		$ketSakit= $baris['tks_nama_penyakit'];
		while($baris = mysql_fetch_array($tabel))
		{
				$ketSakit .= ', '.$baris['tks_nama_penyakit'];
		}
		
		$tob_tpa_id = $row['tpa_id'];
		$t = mysql_query("select * from tob_transaksi_obat where tob_tpa_id = '$tob_tpa_id'");
		$b = mysql_fetch_array($t);
		
		$mob_id = $b['tob_mob_id'];
		$tb = mysql_query("select * from m_obat where mob_id = '$mob_id'");
		$br = mysql_fetch_array($tb);
		$namaObat = $br['mob_nama_obat'];
		
		while($b = mysql_fetch_array($t))
		{
			$mob_id = $b['tob_mob_id'];
			$tb = mysql_query("select * from m_obat where mob_id = '$mob_id'");
			$br = mysql_fetch_array($tb);
			$namaObat .= ', '.$br['mob_nama_obat'];
		}
		
		$pot = mysql_query("select * from m_potongan where mpo_me_id = '$me_id'");
		$p = mysql_fetch_array($pot);
		
		$no++;
		$pdf->Ln(6);
		$pdf->SetFont('Times');
		$pdf->Cell(8,6,$no. ".",1,0,'C');
		$pdf->Cell(20,6,$row['tpa_tanggal_berobat'],1,0,'L');
		$pdf->Cell(33,6,$r['me_first_name'].' '.$r['me_middle_name'].' '.$r['me_last_name'] ,1,0,'L');
		$pdf->Cell(30,6,$umur,1,0,'L');
		$pdf->Cell(9,6,$gender,1,0,'L');
		$pdf->Cell(58,6,$f['mep_name']. "/" .$r['me_address'] ,1,0,'L');
		$pdf->Cell(33,6,$ketSakit,1,0,'L');
		$pdf->Cell(50,6,$namaObat,1,0,'L');
		$pdf->Cell(30,6,$pot['mpo_jumlah'],1,0,'L');
		$pdf->Cell(38,6,' ',1,0,'L');
		
		
	}

while($row = mysql_fetch_array($query))
	{
		$mp_id = $row['tpa_me_id'];
		$q = mysql_query("select * from m_pengunjung where mp_id='$mp_id'");
		$r = mysql_fetch_array($q);
		$birth = $r['mp_tanggal_lahir'];
		$from = new DateTime($birth);
		$to = new DateTime('today');
		$umur = $from ->diff($to)->y;
		if($r['mp_jk']) $gender = 'L'; else $gender = 'P';
		
		$tks_tpa_id = $row['tpa_id'];
		$tabel = mysql_query("select * from tks_keterangan_sakit where tks_tpa_id = '$tks_tpa_id'");
		$baris = mysql_fetch_array($tabel);
		$ketSakit= $baris['tks_nama_penyakit'];
		while($baris = mysql_fetch_array($tabel))
		{
				$ketSakit .= ', '.$baris['tks_nama_penyakit'];
		}
		
		$tob_tpa_id = $row['tpa_id'];
		$t = mysql_query("select * from tob_transaksi_obat where tob_tpa_id = '$tob_tpa_id'");
		$b = mysql_fetch_array($t);
		
		$mob_id = $b['tob_mob_id'];
		$tb = mysql_query("select * from m_obat where mob_id = '$mob_id'");
		$br = mysql_fetch_array($tb);
		$namaObat = $br['mob_nama_obat'];
		
		while($b = mysql_fetch_array($t))
		{
			$mob_id = $b['tob_mob_id'];
			$tb = mysql_query("select * from m_obat where mob_id = '$mob_id'");
			$br = mysql_fetch_array($tb);
			$namaObat .= ', '.$br['mob_nama_obat'];
		}
				
		$no++;
		$pdf->Ln(6);
		$pdf->SetFont('Times');
		$pdf->Cell(8,6,$i. ".",1,0,'C');
		$pdf->Cell(20,6,$row['tpa_tanggal_berobat'],1,0,'L');
		$pdf->Cell(33,6,$r['mp_nama_lengkap'] ,1,0,'L');
		$pdf->Cell(30,6,$umur,1,0,'L');
		$pdf->Cell(9,6,$gender,1,0,'L');
		$pdf->Cell(58,6,$r['mp_pekerjaan']. "/" .$r['mp_alamat'] ,1,0,'L');
		$pdf->Cell(33,6,$ketSakit,1,0,'L');
		$pdf->Cell(50,6,$namaObat,1,0,'L');
		$pdf->Cell(30,6,'',1,0,'L');
		$pdf->Cell(38,6,' ',1,0,'L');
		
		
	}

$pdf->Output();
?>