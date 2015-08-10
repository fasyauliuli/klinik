<!DOCTYPE html>
<html lang="en">
<?php
	include 'dbcon.php';
	
	$query = mysql_query("select * from m_obat");
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
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="pasien.php"><i class="fa fa-fw fa-bar-chart-o"></i> Pasien</a>
                    </li>
                    <li>
                        <a href="transaksi.php"><i class="fa fa-fw fa-table"></i> Transaksi Obat</a>
                    </li>
                    <li class="active">
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
                </ul>    
            </div>
            <!-- /.navbar-collapse -->
        </nav>

		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Stok Obat</h1>
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
												<th>Tanggal Pembelian</th>
												<th>Jumlah Stok</th>
												<th>Satuan</th>
												<th></th>
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
												<td class="text-center"><?php echo $i?></td>
												<td><?php echo $row['mob_nama_obat']?></td>
												<td class="text-center"><?php echo $row['mob_tanggal_beli']?></td>
												<td class="text-center"><?php echo $row['mob_jumlah']?></td>
												<td class="text-center"><?php echo $row['mob_satuan']?></td>
												<td class="text-center">
													<!-- Button trigger modal -->
													<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit_stok<?php echo $row['mob_id']?>">
													  Edit Stok
													</button>
												</td>
												
												<div class="modal fade" role="dialog" aria-labelledby="gridSystemModalLabel" id="edit_stok<?php echo $row['mob_id']?>">
												  <div class="modal-dialog" role="document">
													<div class="modal-content">
													  <div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														<h4 class="modal-title" id="gridSystemModalLabel">Form Edit Stok</h4>
													  </div>
													  <div class="modal-body">
														<div class="container-fluid">
														  <div class="row">
														  	<div class="col-lg-12">
																<form id="editStock" method="POST" action="editStock.php">
																  <div class="form-group">
																	<label for="nama_obat">Nama Obat</label>
																	<input value="<?php echo $row['mob_nama_obat']?>" name="nama" type="text" class="form-control" id="nama_obat" placeholder="Nama Obat" required>
																  </div>
																  <div class="form-group">
																	<label for="tanggalBeli">Tanggal Pembelian</label>
																	<input value="<?php echo $row['mob_tanggal_beli']?>" name="tanggal" type="date" class="form-control" id="tanggalBeli" placeholder="Tanggal Pembelian" required>
																  </div>
																  <div class="form-group">
																	<label for="tambahStok">Penambahan Stok</label>
																	<input value="0" name="jumlah" type="number" class="form-control" id="tambahStok" placeholder="Jumlah" required>
																  </div>
																  <div class="form-group">
																	<label for="satuan">Satuan</label>
																	<input value="<?php echo $row['mob_satuan']?>" name="satuan" type="text" class="form-control" id="satuan" placeholder="Satuan" required>
																  </div>
																  <input type="hidden" value="<?php echo $row['mob_id']?>" name="id">
																</form>
															</div>
														  </div>
														</div>
													  </div>
													  <div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														<button type="submit" form="editStock" class="btn btn-primary">Save changes</button>
													  </div>
													</div><!-- /.modal-content -->
												  </div><!-- /.modal-dialog -->
												</div><!-- /.modal -->
												
												<td class="text-center">
													<!-- Button trigger modal -->
													<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_stok<?php echo $row['mob_id']?>">
													  Hapus Stok
													</button>
												</td>
												
												<div class="modal fade" role="dialog" aria-labelledby="gridSystemModalLabel" id="hapus_stok<?php echo $row['mob_id']?>">
												  <div class="modal-dialog modal-sm" role="document">
													<div class="modal-content">
													  <div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														<h4 class="modal-title" id="gridSystemModalLabel">Konfirmasi Hapus Stok</h4>
													  </div>
													  <div class="modal-body">
														<div class="container-fluid">
														  <div class="row">
															<div class="col-md-12">Apakah anda yakin menghapus stok obat <?php echo ' ',$row['mob_nama_obat'],'?'?></div>
														  </div>
														</div>
													  </div>
													  <div class="modal-footer">
														<form action="removeStock.php" method="POST">
															<input name="id_obat" type="hidden" value="<?php echo $row['mob_id']?>"></input>
															<button type="submit" class="btn btn-primary">Ya</button>
														</form>
														<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
													  </div>
													</div><!-- /.modal-content -->
												  </div><!-- /.modal-dialog -->
												</div><!-- /.modal -->
											</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
								<!-- /.table-responsive -->
								</br>
								<div class="text-center">
									<button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#tambah_stok">
									  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah Stok Obat Baru
									</button>
								</div>
								
								<div class="modal fade" role="dialog" aria-labelledby="gridSystemModalLabel" id="tambah_stok">
								  <div class="modal-dialog modal-sm" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="gridSystemModalLabel">Form Tambah Stok</h4>
									  </div>
									  <div class="modal-body">
										<div class="container-fluid">
											<div class="row">
												<div class="col-lg-12">
													<form id="addStock" method="POST" action="addStock.php">
													  <div class="form-group">
														<label for="nama_obat">Nama Obat</label>
														<input name="nama" type="text" class="form-control" id="nama_obat" placeholder="Nama Obat" required>
													  </div>
													  <div class="form-group">
														<label for="tanggalBeli">Tanggal Pembelian</label>
														<input name="tanggal" type="date" class="form-control" id="tanggalBeli" placeholder="Tanggal Pembelian" required>
													  </div>
													  <div class="form-group">
														<label for="jumlahStok">Jumlah Stok</label>
														<input name="jumlah" type="number" class="form-control" id="jumlahStok" placeholder="Jumlah" required>
													  </div>
													  <div class="form-group">
														<label for="satuan">Satuan</label>
														<input name="satuan" type="text" class="form-control" id="satuan" placeholder="Satuan" required>
													  </div>
													  <button type="reset" class="btn btn-danger">Reset</button>
													</form>
												</div>
											</div>
										</div>
									  </div>
									  <div class="modal-footer">
										<button type="submit" form="addStock" class="btn btn-primary">Submit</button>
										<button type="button" class="btn btn-default" data-dismiss="modal"\>Cancel</button>
									  </div>
									</div><!-- /.modal-content -->
								  </div><!-- /.modal-dialog -->
								</div><!-- /.modal -->
							
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
