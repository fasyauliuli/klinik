<!DOCTYPE html>
<html lang="en">
<?php
	include 'dbcon.php';
	
	$query = mysql_query("select * from tob_transaksi_obat");
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
                    <li>
                        <a href="pasien.php"><i class="fa fa-fw fa-user"></i> Pasien</a>
                    </li>
                    <li class="active">
                        <a href="transaksi.php"><i class="fa fa-fw fa-money"></i> Transaksi Obat</a>
                    </li>
                    <li>
                        <a href="stok.php"><i class="fa fa-fw fa-medkit"></i> Stok Obat</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-file-pdf-o"></i> Laporan <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="laporan/Laporan Harian.php">Laporan Harian</a>
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
						<h1 class="page-header">Transaksi Obat</h1>
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
												<th>Nama Obat</th>
												<th>Tanggal Transaksi</th>
												<th>Jumlah</th>
												<th>Satuan</th>
											</tr>
										</thead>
										<tbody>
											<?php
											
											$i = 0;
											while($row = mysql_fetch_array($query))
											{
												$mob_id = $row['tob_mob_id'];
												$tpa_id = $row['tob_tpa_id'];
												$qr = mysql_query("select * from m_obat where mob_id = '$mob_id'");
												$ro = mysql_fetch_array($qr);

												$qy = mysql_query("select * from tpa_pasien where tpa_id = '$tpa_id'");
												$rw = mysql_fetch_array($qy);
												$i++;
											?>
											
											<tr>
												<td><?php echo $i?></td>
												<td><?php echo $ro['mob_nama_obat']?></td>
												<td><?php echo $rw['tpa_tanggal_berobat']?></td>
												<td><?php echo $row['tob_mob_jumlah']?></td>
												<td><?php echo $ro['mob_satuan']?></td>
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
