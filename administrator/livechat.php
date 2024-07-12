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
<link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
</head>
<body id="page-top">
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

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
							<h6 class="m-0 font-weight-bold text-primary">Your Chat</h6>
							<div class="dropdown no-arrow">
								<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
									data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
									aria-labelledby="dropdownMenuLink">
									<div class="dropdown-header">Options:</div>
									<a class="dropdown-item" href="#">Setting</a>
									<a class="dropdown-item" href="#">Change</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="#">Report</a>
								</div>
							</div>
						</div>
						
						<div class="card-body p-0">
							<!-- Nested Row within Card Body -->
							<div class="row">
								<div class="col-lg-12">
								  <div class="wrapper">
									<section class="users">
									  <header>
										<div class="content border-left-primary">
										<?php 
											$unique_id=$_SESSION['alogin'];
											$sql ="SELECT * FROM admin WHERE unique_id='$unique_id'";
											$query = mysqli_query($koneksidb,$sql);
											if(mysqli_num_rows($query)>0)
												{
												while($results = mysqli_fetch_array($query)){
										  ?>
										  <img src="img/admin/<?php echo htmlentities($results['img']);?>" alt="">
										  <div class="details">
											<span><?php echo htmlentities($results['username']);?></span>
											<p><?php echo htmlentities($results['status']);?></p>
										  </div>
										</div>
											<?php }}?>
									  </header>
									  <div class="search">
										<span class="text">Select an user to start chat</span>
										<input type="text" placeholder="Enter name to search...">
										<button><i class="fas fa-search"></i></button>
									  </div>
									  <div class="users-list">
										
									  </div>
									</section>
								  </div>
								</div>
							</div>
						</div>
                    </div>
                </div>
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
	<script src="javascript/users.js"></script>
</body>
</html>
<?php }?>