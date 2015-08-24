<!DOCTYPE html>
<html lang="en">
<?php
	include 'dbcon.php';
	$query = mysql_query("select * from tpa_pasien where tpa_tanggal_berobat = CURDATE()");
	$cnt = mysql_num_rows($query);
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

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
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
                    <li class="active">
                        <a href="index.php"><i class="fa fa-fw fa-home"></i> Dashboard</a>
                    </li>
                    <li>
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

                <!-- Page Heading -->
                <div class="row">
					<div class="col-lg-4">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-12 text-left">
                                        <div>Jumlah Pasien yang Berobat Hari ini :</div>
										<div class="huge"><?php echo $cnt ?></div>
                                    </div>
                                </div>
                            </div>
							
                            <a href="#myModal" data-toggle="modal" data-target="#myModal">
								<div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
							
							<!--modal-->
							<div class="modal fade" role="dialog" aria-labelledby="gridSystemModalLabel" id="myModal">
							  <div class="modal-dialog modal-sm" role="document">
								<div class="modal-content">
								  <div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="gridSystemModalLabel">Pasien Hari Ini</h4>
								  </div>
								  <div class="modal-body">
									<table class="table">
										<thead>
											<tr>
												<td>Nama</td>
												<td>Detail</td>
											</tr>
										</thead>
										<tbody>
										<?php
											while($row = mysql_fetch_array($query))
											{
												$me_id = $row['tpa_me_id'];
												if($me_id){
												$q = mysql_query("select * from m_employee where me_id='$me_id'");
												$r = mysql_fetch_array($q);
												$mep_id = $r['me_mep_id'];
										?>
										
											<tr>
												<td><?php echo $r['me_first_name'],' ',$r['me_middle_name'],' ',$r['me_last_name']?></td>
												<td><a class="btn btn-primary" href="detail.php?id=<?php echo $mep_id?>"><i class="fa fa-arrow-circle-right"></i></a></td>
											</tr>
											
										<?php
											} else{
										?>
										
										<?php
												$mp_id = $row['tpa_mp_id'];
												$q = mysql_query("select * from m_pengunjung where mp_id='$mp_id'");
												$r = mysql_fetch_array($q);
										?>
											<tr>
												<td><?php echo $r['mp_nama_lengkap']?></td>
												<td><a class="btn btn-primary" href="detailp.php?id=<?php echo $mp_id?>"><i class="fa fa-arrow-circle-right"></i></a></td>
											</tr>
										<?php
											}
										}
										?>
										</tbody>
									</table>
								</div>
								<!-- modal-body -->
								  <div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								  </div>
								</div><!-- /.modal-content -->
							  </div><!-- /.modal-dialog -->
							</div><!-- /.modal -->
                        </div>
                    </div>
                </div>
				</br>
                </br>
				</br>
				
				<!-- /.row -->

				<div class="row">
					<center>
						<img src="image/logo-mekarsari.png">
					</center>
				</div>
				</br>
			</div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

	<!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>
	
</body>

</html>
