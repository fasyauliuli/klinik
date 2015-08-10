<!DOCTYPE html>
<html lang="en">

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
                    <li>
                        <a href="pasien.php"><i class="fa fa-fw fa-bar-chart-o"></i> Pasien</a>
                    </li>
                    <li class="active">
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
                    
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Transaksi Obat
                        </h1>
                    </div>
				</div>
				<div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
										<th>Obat</th>
                                        <th>Tanggal</th>
                                        <th>Nama Pasien</th>
										<th class="col-sm-1"></th>
										<th class="col-sm-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1.</td>
                                        <td>1265</td>
                                        <td>32.3%</td>
										<td>Uli</td>
										<td>
											<!-- Button trigger modal -->
											<center>
												<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#rincian">
												  Rincian / Edit
												</button>
											</center>

											<!-- Modal -->
											<div class="modal fade" id="rincian" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
											  <div class="modal-dialog modal-sm" role="document">
												<div class="modal-content">
												  <div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														<center><h3 class="modal-title" id="myModalLabel">Obat</h3></center>
													</div>
												  <div class="modal-body">
													<table class="table table-striped">
														<thead>
															<tr>
																<th></th>
																<th>Jumlah</th>
																<th>Satuan</th>
																<th></th>
																<th></th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td>1.</td>
																<td>Uli</td>
																<td>10</td>
																<td></td>
																<td></td>
															</tr>
														</tbody>
													</table>
												  </div>
												  <div class="modal-footer">
															<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
															<button type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
													</div>
												</div>
											  </div>
											</div>
										</td>
											<td>
												<!-- Button trigger modal -->
								
												<center>
													<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus">
													  Hapus
													</button>
												</center>
												<!-- Modal -->
												<div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
												  <div class="modal-dialog modal-sm" role="document">
													<div class="modal-content">
													  <div class="modal-body">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														<center><h4 class="modal-title" id="myModalLabel">Hapus Transaksi Obat?</h4></center>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
															<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
														</div>
													</div>
												  </div>
												</div>
											</td>
                                    </tr>
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

</body>

</html>
