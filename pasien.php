<!DOCTYPE html>
<html lang="en">
<?php
	include 'dbcon.php';
	
	$query = mysql_query("select * from m_employee");
	$q = mysql_query("select * from m_pengunjung");
	$r = mysql_num_rows($q);
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Klinik Mekarsari</title>

	<!-- from sb2 -->
	<!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<!-- end from sb2 -->

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
    
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
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Database Pasien</h1>
					</div>
					<!-- /.col-lg-12 -->
				</div>
				<!-- /.row -->
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="dataTable_wrapper">
									<table class="table table-striped table-bordered table-hover" id="dataTables-example">
										<thead>
											<tr>
												<th>No</th>
												<th>Nama</th>
												<th>Tanggal Lahir</th>
												<th>Pekerjaan/Bagian</th>
												<th>Berapa kali berobat</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php
											$j = 0;
											while($row = mysql_fetch_array($q))
											{
												$j++;
											?>
											
											<tr>
												<td class="text-center"><?php echo $j?></td>
												<td><?php echo $row['mp_nama_lengkap']?></td>
												<td class="text-center"><?php echo $row['mp_tanggal_lahir']?></td>
												<td><?php echo $row['mp_pekerjaan']?></td>
												<?php
													$mp_id = $row['mp_id'];
													$q1 = mysql_query("select * from tpa_pasien where tpa_mp_id='$mp_id'");
													$r1 = mysql_num_rows($q1);
												?>
												<td class="text-center"><?php echo $r1?></td>
												<td>
												<!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
													<a href="detailp.php?id=<?php echo $mp_id?>">
														<center>
															<button type="button" class="btn btn-primary btn-md">Detail</button>
														</center>
													</a>
												</td>
											</tr>
											<?php } ?>
										
											<?php
											$i = $j;
											while($row = mysql_fetch_array($query))
											{
												$i++;
											
											?>
											
											<tr>
												<td class="text-center"><?php echo $i?></td>
												<td><?php echo $row['me_first_name'],' ',$row['me_last_name']?></td>
												<td class="text-center"><?php echo $row['me_dob']?></td>
												<?php
													$mep_id = $row['me_mep_id'];
													$q = mysql_query("select * from m_employee_positions where mep_id = '$mep_id'");
													$r = mysql_fetch_array($q);
												?>
												<td><?php echo $r['mep_name']?></td>
												<?php
													$q1 = mysql_query("select * from tpa_pasien where tpa_me_id='$mep_id'");
													$r1 = mysql_num_rows($q1);
												?>
												<td class="text-center"><?php echo $r1?></td>
												<td>
												<!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
													<a href="detail.php?id=<?php echo $mep_id?>">
														<center>
															<button type="button" class="btn btn-primary btn-md">Detail</button>
														</center>
													</a>
												</td>
											</tr>
											<?php } ?>
											
											
											
										</tbody>
									</table>
								</div>
								<!-- /.table-responsive -->
							</div>
							<!-- /.panel-body -->
						</div>
						<!-- /.panel -->
					</div>
					<!-- /.col-lg-12 -->
				</div>
				<!-- /.row -->
				
				<div class="text-center">
					<button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#tambah_pasien">
					  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah Pasien Baru
					</button>
				</div>
				
				<div class="modal fade" role="dialog" aria-labelledby="gridSystemModalLabel" id="tambah_pasien">
				  <div class="modal-dialog modal-sm" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="gridSystemModalLabel">Form Tambah Data Pasien</h4>
					  </div>
					  <div class="modal-body">
						<div class="container-fluid">
							<div class="row">
								<div class="col-lg-12">
									<form id="addPasien" method="POST" action="addPasien.php">
									  <div class="form-group">
										<label for="nama">Nama</label>
										<input name="nama" type="text" class="form-control" id="nama" placeholder="Nama" required>
									  </div>
									  <div class="form-group">
										<label for="pekerjaan">Pekerjaan/Bagian</label>
										<input name="pekerjaan" type="text" class="form-control" id="pekerjaan" placeholder="Pekerjaan" required>
									  </div>
									  <div class="form-group">
										<label for="tanggalLahir">Tanggal Lahir</label>
										<input name="tanggalLahir" type="date" class="form-control" id="tanggalLahir" placeholder="Tanggal Lahir" required>
									  </div>
									  <div class="form-group">
										<label for="no_HP">Nomor HP</label>
										<input name="no_HP" type="text" class="form-control" id="no_HP" placeholder="Nomor HP" required>
									  </div>
									  <div class="form-group">
										<label for="alamat">Alamat</label>
										<input name="alamat" type="text" class="form-control" id="alamat" placeholder="Alamat" required>
									  </div>
									  <button type="reset" class="btn btn-danger">Reset</button>
									</form>
								</div>
							</div>
						</div>
					  </div>
					  <div class="modal-footer">
						<button type="submit" form="addPasien" class="btn btn-primary">Submit</button>
						<button type="button" class="btn btn-default" data-dismiss="modal"\>Cancel</button>
					  </div>
					</div><!-- /.modal-content -->
				  </div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
			</div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

	<!-- from sb2-->
	<!-- jQuery -->
	<script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

	<!-- DataTables JavaScript -->
    <script src="bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
	
	<!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>
	
	<!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
	<!-- end from sb2-->
	
</body>

</html>
