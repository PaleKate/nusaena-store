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

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Manage Page Info</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary text-center">NUSAENA STORE TASIKMALAYA</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
								<button class="btn btn-sm btn-danger btn-icon-split" 
								onclick="deleteall()">
									<span class="icon text-white-50">
										<i class="fas fa-trash"></i>
									</span>
									<span class="text">Delete All</span>
								</button>
								<a href="contactinfo-tambah.php" class="btn btn-sm btn-primary btn-icon-split">
									<span class="icon text-white-50">
										<i class="fas fa-plus"></i>
									</span>
									<span class="text">Add Page Info</span>
								</a>
								<div class="my-3"></div>
                                <table id="table" class="display table table-striped table-bordered table-hover" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="5" class="text-center">No</th>
                                            <th class="text-center">Page Name</th>
                                            <th class="text-center">Detail</th>
                                            <th class="text-center">Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
										$nomor = 0;
										$sqlusers = "SELECT * FROM contactusinfo ORDER BY page_name ASC";
										$queryusers = mysqli_query($koneksidb,$sqlusers);
										while ($result = mysqli_fetch_array($queryusers)){
											$nomor++;
											?>
										<tr>
											<td class="text-center"><?php echo htmlentities($nomor);?></td>
											<td><?php echo htmlentities($result['page_name']);?></td>
											<td><?php echo $result['detail'];?></td>
											<td class="text-center">
												<a href="contactinfo-edit.php?id=<?php echo $result['id_info'];?>" 
												class="btn btn-warning btn-circle btn-sm" >
													<i class="fas fa-edit"></i></a>&nbsp;&nbsp;
												<button class="btn btn-danger btn-circle btn-sm" 
												onclick="Swal.fire({
													icon: 'warning',
													title: 'Sure',
													text: 'Apakah Kamu Yakin Akan Menghapus Page <?php echo htmlentities($result['page_name']);?> ?',
													showCancelButton: true,
													confirmButtonText: 'Yes Delete It',
														}).then((result) => {
														if (result.isConfirmed) {
														window.location = 'contactinfo-del.php?id=<?php echo $result['id_info'];?>';
														}
													})">
													<i class="fas fa-times-circle"></i></button>
											</td>
										</tr>
										<?php } ?>
                                    </tbody>
                                </table>
								<!-- Large modal -->
								<div class="modal bs-example-modal animated--fade-in" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-body">
												<p>One fine body…</p>
											</div>
										</div>
									</div>
								</div>    
								<!-- Large modal --> 
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
	<script type="text/javascript">
        function deleteall() {
			Swal.fire({
			icon: 'warning',
			title: 'Sure',
			text: 'Apakah Kamu Yakin Akan Menghapus Semua ?',
			showCancelButton: true,
			confirmButtonText: 'Yes Delete All',
				}).then((result) => {
				if (result.isConfirmed) {
				window.location = 'contactinfo-delall.php';
				}
			})
		}
	</script>
	<script>
	$(document).ready(function() {
    var table = $('#table').DataTable( {
		"scrollY": 400,
		"scrollX": true,
		lengthMenu:[
				[10,20,50,100,-1],
				[10,20,50,100,"All"]
				],
        buttons: [{
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2 ]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2 ]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2 ]
                }
            },
			{
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2 ]
                }
            },
			{
				extend: 'colvis',
				text: 'Filter',
			}],
		dom:
		"<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
		"<'row'<'col-md-12'tr>>" +
		"<'row'<'col-md-5'i><'col-md-7'p>>"
    } );
 
    table.buttons().container()
        .appendTo( '#table_wrapper .col-md-6:eq(0)' );
	} );
	</script>
</body>

</html>
<?php }?>