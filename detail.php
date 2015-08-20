<!DOCTYPE html>
<html lang="en">
<?php
	include 'dbcon.php';
	
	
	$mep_id = $_GET['id'];
	
	$query = mysql_query("select * from m_employee where me_mep_id = '$mep_id'");
	$row = mysql_fetch_array($query);
	$me_id = $row['me_id'];
	
	$q = mysql_query("select * from m_employee_positions where mep_id = '$mep_id'");
	$r = mysql_fetch_array($q);
	
	$qr = mysql_query("select * from tpa_pasien where tpa_me_id = '$me_id' order by tpa_tanggal_berobat");
?>

<head>
	
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Klinik Mekarsari</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Select2 -->
    <link rel="stylesheet" href="css/plugins/select2.min.css">
	
	<!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<link href="css/modal dialog.css" rel="stylesheet">
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Klinik Mekarsari</a>
            </div>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php"><i class="fa fa-fw fa-home"></i> Dashboard</a>
                    </li>
                    <li class="active">
                        <a href="pasien.php"><i class="fa fa-fw fa-user"></i> Pasien</a>
                    </li>
                    <li>
                        <a href="transaksi.php"><i class="fa fa-fw fa-money"></i> Transaksi Obat</a>
                    </li>
                    <li>
                        <a href="stok.php"><i class="fa fa-fw fa-medkit"></i> Stok Obat</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-file-pdf-o"></i> Laporan <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="doc/LAPORAN BULANAN.pdf">Laporan Bulanan</a>
                            </li>
                            <li>
                                <a href="doc/LAPORAN HARIAN.pdf">Laporan Harian</a>
                            </li>
                        </ul>
                    </li>
                </ul>
			
			</div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
						<h1 class="page-header">
                            Detail Pasien
                        </h1>
						</br>
						<div class="col-lg-6">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h3 class="panel-title">Biodata</h3>
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-sm-4">
											<label class="col-sm-12">NIK</label>
										</div>
										<div class="col-sm-1">
											<p>:</p>
										</div>
										<div class="col-sm-6">
											<p><?php echo $row['me_nik']?></p>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-4">
											<label class="col-sm-12">Nama</label>
										</div>
										<div class="col-sm-1">
											<p>:</p>
										</div>
										<div class="col-sm-6">
											<p><?php echo $row['me_first_name'],' ',$row['me_last_name']?></p>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-4">
											<label class="col-sm-12">Pekerjaan/Bagian</label>
										</div>
										<div class="col-sm-1">
											<p>:</p>
										</div>
										<div class="col-sm-6">
											<p><?php echo $r['mep_name']?></p>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-4">
											<label class="col-sm-12 control-label">Tanggal Lahir</label>
										</div>
										<div class="col-sm-1">
											<p>:</p>
										</div>
										<div class="col-sm-6">
											<p><?php echo $row['me_dob']?></p>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-4">
											<label class="col-sm-12 control-label">Jenis Kelamin</label>
										</div>
										<div class="col-sm-1">
											<p>:</p>
										</div>
										<div class="col-sm-6">
											<p><?php if($row['me_gender']) echo 'Laki-laki'; else echo 'Perempuan';?></p>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-4">
											<label class="col-sm-12 control-label">No. HP</label>
										</div>
										<div class="col-sm-1">
											<p>:</p>
										</div>
										<div class="col-sm-6">
											<p><?php echo $row['me_hp']?></p>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-4">
											<label class="col-sm-12 control-label">Email</label>
										</div>
										<div class="col-sm-1">
											<p>:</p>
										</div>
										<div class="col-sm-6">
											<p><?php echo $row['me_email']?></p>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-4">
											<label class="col-sm-12 control-label">Alamat</label>
										</div>
										<div class="col-sm-1">
											<p>:</p>
										</div>
										<div class="col-sm-6">
											<p><?php echo $row['me_address']?></p>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-lg-6">
							<div class="panel panel-default">
								<div class="panel-heading">
									<div class="row">
										<div class="col-lg-6">
											<h1 class="panel-title" style="margin-top: 7px">Riwayat Berobat</h1>
										</div>
										<div class="col-lg-6">											
											<!-- Button trigger modal -->
											<button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#tambahT">
												<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp Tambah Transaksi
											</button>
										</div>
									</div>
									
								</div>
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-bordered table-hover table-striped">
											<thead>
												<tr style="    background-color: slategray;">
													<th class="col-sm-1" style="text-align: center">No</th>
													<th style="text-align: center">Tanggal Berobat</th>
													<th class="col-sm-1"></th>
													<th class="col-sm-1"></th>
												</tr>
											</thead>
											<tbody>
												<?php
													
													$i = 0;
													while($rw = mysql_fetch_array($qr))
													{
														$tpa_id = $rw['tpa_id'];
														$i++;
													?>
												<tr>
													<td style="text-align: center"><?php echo $i?></td>
													<td>
														<?php echo $rw['tpa_tanggal_berobat']?>	
													</td>
													<td>
														<!-- Button trigger modal -->
														<center>
															<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#rincian<?php echo $tpa_id?>">
															  Rincian
															</button>
														</center>

														<?php
															
															$qy = mysql_query("select * from tks_keterangan_sakit where tks_tpa_id = '$tpa_id'");
														?>
														<!-- Modal -->
														<div class="modal fade" id="rincian<?php echo $tpa_id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
														  <div class="modal-dialog modal-sm" role="document">
															<div class="modal-content">
															  <div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<center><h3 class="modal-title" id="myModalLabel">Keterangan Sakit</h3></center>
															  </div>
															  <div class="modal-body">
															  <?php
													
																$j = 0;
																while($baris = mysql_fetch_array($qy))
																{
																	$j++;
																?>
															   <p><?php echo $baris['tks_nama_penyakit']?></p>
																<?php } ?>
															  </div>
															  
															  <div class="modal-header">
																<center><h3 class="modal-title" id="myModalLabel">Obat</h3></center>
															  </div>
																<?php
																	
																	$kolom = mysql_query("select * from tob_transaksi_obat where tob_tpa_id = '$tpa_id'");
																	
																?>
															  <div class="modal-body">
																<table class="table table-striped">
																	<thead>
																		<tr>
																			<th></th>
																			<th>Obat</th>
																			<th>Jumlah</th>
																			<th></th>
																			<th></th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php
													
																			$k = 0;
																			while($br = mysql_fetch_array($kolom))
																			{
																				$mob_id = $br['tob_mob_id'];
																				$kl = mysql_query("select * from m_obat where mob_id = '$mob_id'");
																				$b = mysql_fetch_array($kl);
																				$k++;
																			?>
																				<tr>
																					<td><?php echo $k?></td>
																					<td><?php echo $b['mob_nama_obat']?></td>
																					<td><?php echo $br['tob_mob_jumlah']?></td>
																					<td></td>
																					<td></td>
																				</tr>
																			<?php } ?>
																	</tbody>
																</table>
															  </div>
															  <div class="modal-footer">
																		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																</div>
															</div>
														  </div>
														</div>
													</td>
													<td>
														<!-- Button trigger modal -->
														<center>
															<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_riwayat<?php echo $tpa_id?> ">
															  Hapus
															</button>
														</center>
														<!-- Modal -->
														<div class="modal fade" role="dialog" aria-labelledby="gridSystemModalLabel" id="hapus_riwayat<?php echo $tpa_id?>">
														  <div class="modal-dialog modal-sm" role="document">
															<div class="modal-content">
															  <div class="modal-body">
																<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<center><h4 class="modal-title" id="gridSystemModalLabel">Hapus Riwayat Berobat? </h4></center>
																</div>
																<div class="modal-footer">
																	<form action="removeRiwayat.php" method="POST">
																		<input name="id_pasien" type="hidden" value="<?php echo $tpa_id?>"></input>
																		<input name="mep_id" type="hidden" value="<?php echo $mep_id?>"></input>
																		<button type="submit" class="btn btn-primary pull-right">Ok</button>
																	</form>
																	<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
																</div>
															</div>
														  </div>
														</div>
													</td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								
								</div>
							</div>
							
							<!-- Modal -->
									<div class="modal fade" id="tambahT" role="dialog" aria-labelledby="myModalLabel">
									  <div class="modal-dialog modal-sm" role="document">
										<div class="modal-content">
											<form action="addTrans.php" method="POST">
											  <div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<center><h3 class="modal-title" id="myModalLabel">Keterangan Sakit</h3></center>
											  </div>
											  
											  <div class="modal-body">
												<div class="row" style="margin-left: -10px; margin-right: 0px">
													<div class="col-lg-12">
														<label>Masukkan Keterangan Sakit</label>
															<div class="multi-field-wrapper">
															  <div class="multi-fields">
																<div class="multi-field row">
																	<div class="col-xs-9">
																		<input class="form-control" type="text" name="ketSakit[]" id="ketSakit" required>
																	</div>
																	<button type="button" class="col-xs-3 remove-field btn btn-danger btn-sm">Hapus</button>
																</div>
															  </div>
															  <button type="button" class="add-field btn btn-primary btn-sm">Tambah</button>
															</div>
													</div>
												</div>
											  </div>

											
											<div class="modal-header">
												<center><h3 class="modal-title" id="myModalLabel">Obat</h3></center>
											</div>
											  
											<div class="modal-body">
												<div class="row" style="margin-left: -10px; margin-right: 0px">
													<div class="col-sm-12">
														<div class="row">
															<div class="col-sm-5">
																<label>Nama Obat</label>
															</div>
															<div class="col-sm-5">
																<label>Jumlah</label>
															</div>
														</div>
														
														
														
														<div class="multi-field-wrapper">
														  <div class="multi-fields">
															<div class="multi-field row">
																<div class="col-sm-5">
																	<select id="n_obat" class="form-control" name="obat[]">
																		<?php
																		$query = mysql_query("select * from m_obat");
																		while($row = mysql_fetch_array($query)){
																			?>
																			<option value="<?php echo $row['mob_id']?>"><?php echo $row['mob_nama_obat']?> (Sisa <?php echo $row['mob_jumlah'],' ',$row['mob_satuan']?>)</option>
																		<?php }?>
																	</select>
																</div>
																
																<div class="col-sm-4">
																	<input class="form-control" type="number" name="jumlah[]" id="jumlahObat" min="0" required></input>
																</div>
																
																<button type="button" class="col-sm-3 remove-field btn btn-danger btn-sm" value="Hapus">Hapus</input>
															</div>
														  </div>
														  <button type="button" class="add-field btn btn-primary btn-sm">Tambah</button>
														</div>
													</div>
												</div>
											</div>
											
											  <div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														<input type="hidden" name="me_id" value="<?php echo $me_id?>"></input>
														<input type="hidden" name="mep_id" value="<?php echo $mep_id?>"></input>
														
														<button type="submit" class="btn btn-primary" >Submit</button>
											  </div>
											</form>
										</div>
									  </div>
									</div>
								
						</div>
						<!-- end div col 6 -->
                    </div>
					<!-- end div col 12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="js/jQuery-2.1.4.min.js"></script>
    
	<!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

	<!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>
	
	<!-- Select2 -->
    <script src="js/plugins/select2/select2.full.min.js"></script>
	
	<script>
	$(document).ready(function() {
	  $(".sel2").select2();
	});
	</script>
	
	<script>
	$('.multi-field-wrapper').each(function() {
		var $wrapper = $('.multi-fields', this);
		$(".add-field", $(this)).click(function(e) {
			$('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus();
		});
		$('.multi-field .remove-field', $wrapper).click(function() {
			if ($('.multi-field', $wrapper).length > 1)
				$(this).parent('.multi-field').remove();
		});
	});
	</script>

</body>

</html>
