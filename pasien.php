<!DOCTYPE html>
<html lang="en">
<?php
	include 'dbcon.php';
	
	$query = mysql_query("select * from m_employee");
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
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="active">
                        <a href="pasien.php"><i class="fa fa-fw fa-bar-chart-o"></i> Pasien</a>
                    </li>
                    <li>
                        <a href="transaksi.php"><i class="fa fa-fw fa-table"></i> Transaksi Obat</a>
                    </li>
                    <li>
                        <a href="stok.php"><i class="fa fa-fw fa-edit"></i> Stok Obat</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Laporan <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="#">Laporan Bulanan</a>
                            </li>
                            <li>
                                <a href="#">Laporan Harian</a>
                            </li>
                        </ul>
                    </li>
                    
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Database Pasien</h1>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Pegawai</th>
                                        <th>Nama</th>
<<<<<<< HEAD
										<th>Tanggal Lahir</th>
                                        <th>Pekerjaan/Bagian</th>
=======
>>>>>>> origin/master
										<th>Berapa kali berobat</th>
										<th></th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
									
									$i = 0;
									while($row = mysql_fetch_array($query))
									{
										$i++;
									?>
									
                                    <tr>
<<<<<<< HEAD
                                        <td><?php echo $i?></td>
                                        <td><?php echo $row['me_nik']?></td>
                                        <td><?php echo $row['me_first_name'],' ',$row['me_last_name']?></td>
                                        <td><?php echo $row['me_dob']?></td>
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
										<td><?php echo $r1?></td>
=======
                                        <td>1.</td>
                                        <td>1265</td>
                                        <td>32.3%</td>
                                        <td>$321.33</td>
										<td>
										<!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
											<a href="detail.php">
												<center>
													<button type="button" class="btn btn-primary btn-md">Detail</button>
												</center>
											</a>
										</td>
                                    </tr>
									<tr>
                                        <td>2.</td>
                                        <td>1265</td>
                                        <td>32.3%</td>
                                        <td>$321.33</td>
>>>>>>> origin/master
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
                    </div>
                </div>
                <!-- /.row -->
                </div>
                <!-- /.row -->
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

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

    <!-- Flot Charts JavaScript -->
    <!--[if lte IE 8]><script src="js/excanvas.min.js"></script><![endif]-->
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="js/plugins/flot/flot-data.js"></script>

</body>

</html>
