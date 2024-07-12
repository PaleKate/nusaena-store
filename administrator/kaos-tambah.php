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
                    <h1 class="h3 mb-2 text-gray-800">T-Shirt Add Product</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary text-center">NUSAENA STORE TASIKMALAYA</h6>
                        </div>
						<div class="card-body p-0">
							<!-- Nested Row within Card Body -->
							<div class="row">
								<div class="col-lg-12">
									<div class="pb-5 pr-5 pl-5 pt-3">
										<h1 class="h4 text-gray-900">Add New T-Shirt</h1>
										<hr>
										<form class="user" method="post" name="theform" action="kaos-tambahact.php" 
										onSubmit="return valid(this);" enctype="multipart/form-data">
											<div class="form-group row">
												<div class="col-sm-6 mb-3 mb-sm-0">
													<label class="control-label">Nama Produk<span style="color:red">*</span></label>
													<input type="text" class="form-control form-control-user" id="nama_produk" 
													name="nama_produk" required>
												</div>
												
												<div class="col-sm-6">
													<label class="control-label">Harga<span style="color:red">*</span></label>
													<input type="number" class="form-control form-control-user" name="harga" min="0" required>
												</div>
											</div>
											<hr>
											
											<div class="form-group row">
												<div class="col-sm-6 mb-3 mb-sm-0">
													<label class="control-label">Bahan<span style="color:red">*</span></label>
													<select class="form-control select2" name="id_bahan" required="">
														<option selected="selected" value="">== Pilih Bahan ==</option>
														<?php
															$mySql = "SELECT * FROM bahan ORDER BY bahan";
															$myQry = mysqli_query($koneksidb, $mySql);
															while ($myData = mysqli_fetch_array($myQry)) {
																if ($myData['id_bahan']== $dataBahan) {
																$cek = " selected";
																} else { $cek=""; }
																echo "<option value='$myData[id_bahan]' $cek>$myData[bahan] </option>";
															}
														?>
														
													</select>
												</div>
												
												<div class="col-sm-6">
													<label class="control-label">Kategori<span style="color:red">*</span></label>
													<select class="form-control select2" name="id_kategori" required="">
														<option selected="selected"value="">== Pilih Kategori ==</option>
														<?php
															$mySql = "SELECT * FROM kategori ORDER BY kategori";
															$myQry = mysqli_query($koneksidb, $mySql);
															while ($myData = mysqli_fetch_array($myQry)) {
																if ($myData['id_kategori']== $dataKategori) {
																$cek = " selected";
																} else { $cek=""; }
																echo "<option value='$myData[id_kategori]' $cek>$myData[kategori] </option>";
															}
														?>
														
													</select>
												</div>
											</div>
											<hr>
											
											<div class="form-group row">
												<div class="col-sm-12 text-center">
													<label class="control-label">Qty</label>
												</div>
											</div>
											<hr>
											
											<div class="form-group row">
												<div class="col-sm-3 mb-3 mb-sm-0">
													<label class="control-label">Size S<span style="color:red">*</span></label>
													<input type="number" class="form-control form-control-user" name="qty_s" min="0" required>
												</div>
												<div class="col-sm-3 mb-3 mb-sm-0">
													<label class="control-label">Size M<span style="color:red">*</span></label>
													<input type="number" class="form-control form-control-user" name="qty_m" min="0" required>
												</div>
												<div class="col-sm-3 mb-3 mb-sm-0">
													<label class="control-label">Size L<span style="color:red">*</span></label>
													<input type="number" class="form-control form-control-user" name="qty_l" min="0" required>
												</div>
												<div class="col-sm-3 mb-3 mb-sm-0">
													<label class="control-label">Size XL<span style="color:red">*</span></label>
													<input type="number" class="form-control form-control-user" name="qty_xl" min="0" required>
												</div>
											</div>
											<hr>
											
											<div class="form-group row row">
												<div class="col-sm-12 mb-3 mb-sm-0">
													<label class="control-label">Deskripsi<span style="color:red">*</span></label>
													<textarea type="text" class="form-control form-control-user" name="deskripsi" 
													required></textarea>
												</div>
											</div>
											<hr>
											
											<div class="form-group row">
												<div class="col-sm-12">
													<label class="control-label">Upload Gambar</label>
												</div>
											</div>

											<div class="form-group row">
												<div class="col-sm-3">
													Gambar 1<span style="color:red">*</span>
													<input type="file" name="img1" accept="image/*" required>
												</div>
											</div>
											<div class="form-group row">
												<div class="col-sm-3">
													Gambar 2<span style="color:red">*</span>
													<input type="file" name="img2" accept="image/*" required>
												</div>
											</div>
											<div class="form-group row">
												<div class="col-sm-3">
													Gambar 3<span style="color:red">*</span>
													<input type="file" name="img3" accept="image/*" required>
												</div>
											</div>
											<div class="form-group row">
												<div class="col-sm-3">
													Gambar 4<span style="color:red">*</span>
													<input type="file" name="img4" accept="image/*" required>
												</div>
											</div>
											<hr>
											
											<div class="form-group row">
												<div class="col-sm-6 mb-3 mb-sm-0">
													<button class="btn btn-primary btn-user btn-block-split" type="submit" name="save">
														<span class="icon text-white-50">
															<i class="fas fa-paper-plane"></i>
														</span>
														<span class="text">Create</span>
													</button>
													<button class="btn btn-danger btn-user btn-block-split" type="reset">
														<span class="icon text-white-50">
															<i class="fas fa-sync-alt"></i>
														</span>
														<span class="text">Cancel</span>
													</button>
												</div>
											</div>
										</form>
										<hr>
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
	<script>
	if(jQuery().select2) {
		$(".select2").select2();
	}
	</script>
	<script>
		CKEDITOR.replace('deskripsi');
	</script>
</body>

</html>
<?php }?>