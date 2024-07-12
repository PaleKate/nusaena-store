<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/format_rupiah.php');
include('includes/library.php');
if(strlen($_SESSION['alogin'])==0){	
header('location: login.php');
} else{
	?>
<!DOCTYPE html>
<html lang="en">

<head>
<!-- Head -->
<?php include ('includes/head.php'); ?>
<!-- End of Head -->

</head>

<body id="page-top" >
<!-- Topbar -->
<?php include ('includes/header.php'); ?>
<!-- End of Topbar -->

<!-- Page Wrapper -->
<div id="wrapper">

<!-- Sidebar -->
<?php include ('includes/leftbar.php'); ?>
<!-- End of Sidebar -->

	<!-- Content Wrapper -->
    <div class="col-md-10 offset-2 mt-4">
        <div id="content-wrapper" class="d-flex flex-column ml-auto">

            <!-- Main Content -->
            <div id="content" class="mt-4">

                <!-- Begin Page Content -->
                <div class="container-fluid mt-5">

                    <!-- Page Heading -->
                    <div class="col-md-12 mb-4">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
										<?php 
											$sqlpending = "SELECT id FROM pesanan WHERE status='Menunggu Pembayaran'";
											$querypending = mysqli_query($koneksidb,$sqlpending);
											$pending=mysqli_num_rows($querypending);
										?>
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Menunggu Pembayaran</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $pending; ?> Items</div>
											 <a href="kaos-bayar.php" class="btn btn-primary btn-icon-split btn-sm">
												<span class="icon text-white-50">
													<i class="fas fa-info"></i>
												</span>
												<span class="text">More Details</span>
											 </a>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-wallet fa-4x text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
										<?php 
											$sqlkonfirm = "SELECT id FROM pesanan WHERE status='Menunggu Konfirmasi'";
											$querykonform = mysqli_query($koneksidb,$sqlkonfirm);
											$konfirm=mysqli_num_rows($querykonform);
										?>
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Menunggu Konfirmasi</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $konfirm; ?> Items</div>
											 <a href="kaos-konfirm.php" class="btn btn-danger btn-icon-split btn-sm">
												<span class="icon text-white-50">
													<i class="fas fa-info"></i>
												</span>
												<span class="text">More Details</span>
											 </a>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-money-check-alt fa-4x text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
										<?php 
											$sqlselesai = "SELECT id FROM pesanan WHERE status='Dikemas'";
											$queryselesai = mysqli_query($koneksidb,$sqlselesai);
											$selesai=mysqli_num_rows($queryselesai);
										?>
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Dikemas</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $selesai; ?> Items</div>
											 <a href="kaos-kemas.php" class="btn btn-warning btn-icon-split btn-sm">
												<span class="icon text-white-50">
													<i class="fas fa-info"></i>
												</span>
												<span class="text">More Details</span>
											 </a>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-archive fa-4x text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
										<?php 
											$sqlkemas = "SELECT id FROM pesanan WHERE status='Dikirim'";
											$querykemas = mysqli_query($koneksidb,$sqlkemas);
											$kemas=mysqli_num_rows($querykemas);
										?>
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
											Dikirim</div>
                                             <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $kemas; ?> Items</div>
											 <a href="kaos-kirim.php" class="btn btn-info btn-icon-split btn-sm">
												<span class="icon text-white-50">
													<i class="fas fa-info"></i>
												</span>
												<span class="text">More Details</span>
											 </a>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-shipping-fast fa-4x text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
										<?php 
											$sqlselesai = "SELECT id FROM pesanan WHERE status='Selesai'";
											$queryselesai = mysqli_query($koneksidb,$sqlselesai);
											$selesai=mysqli_num_rows($queryselesai);
										?>
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Selesai</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $selesai; ?> Items</div>
											 <a href="kaos-selesai.php" class="btn btn-success btn-icon-split btn-sm">
												<span class="icon text-white-50">
													<i class="fas fa-info"></i>
												</span>
												<span class="text">More Details</span>
											 </a>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar-check fa-4x text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
										<?php 
											$sqlkonfirm = "SELECT id FROM pesanan";
											$querykonform = mysqli_query($koneksidb,$sqlkonfirm);
											$konfirm=mysqli_num_rows($querykonform);
										?>
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                All Items</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $konfirm; ?> Items</div>
											 <a href="kaos-data.php" class="btn btn-primary btn-icon-split btn-sm">
												<span class="icon text-white-50">
													<i class="fas fa-info"></i>
												</span>
												<span class="text">More Details</span>
											 </a>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-list-alt fa-4x text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Peningkatan Penghasilan</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Perbandingan Penghasilan</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> Direct
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Social
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> Referral
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include ('includes/footer.php'); ?>
            <!-- End of Footer -->

        </div>
	</div>
	<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
	<!-- End Of Scroll to Top Button-->

    <!-- Logout Modal-->
    <?php include ('includes/logout.php'); ?>
	<!-- End Of Logout Modal-->

    <!-- javaScript-->
    <?php include ('includes/script.php'); ?>
	<!-- End Of javaScript-->

</body>

</html>
<?php } ?>