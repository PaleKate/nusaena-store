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
						<div class="card-body p-0">
							<!-- Nested Row within Card Body -->
							<div class="row">
								<div class="col-lg-12">
								  <div class="wrapper">
									<section class="chat-area">
									  <header>
										<?php 
										  $user_id = mysqli_real_escape_string($koneksidb, $_GET['user_id']);
										  $sql = mysqli_query($koneksidb, "SELECT * FROM users WHERE unique_id = '$user_id'");
										  if(mysqli_num_rows($sql) > 0){
											$row = mysqli_fetch_assoc($sql);
										  }
										?>
										<a href="livechat.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
										<img src="../assets/img/users/<?php echo $row['img']; ?>" alt="">
										<div class="details">
										  <span><?php echo $row['nama_lengkap'] ?></span>
										  <p><?php echo $row['status']; ?></p>
										</div>
									  </header>
									  <div class="chat-box">

									  </div>
									 <form action="" class="typing-area" method="POST" enctype="multipart/form-data">
										<input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
										<label for="upload_gambar"><img src="../assets/img/images.png" style="opacity: 0.8; width: 30px; margin: 5px; cursor: pointer;"></label>
										<input class="upload_gambar" id="upload_gambar" type="file" name="upload_gambar" style="display:none;" onchange="send_image(this.files)" accept="image/*"/>
										<input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
										<button><i class="fab fa-telegram-plane"></i></button>
									  </form>
									</section>
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
	function send_image(files){
			var fd = new FormData();
			let xml = new XMLHttpRequest();
			
			xml.onload = function(){
				if(xml.readyState == 4 || xml.status == 200){
					alert(xml.responseText);
				}
			}
			fd.append('file',files[0]);
			fd.append('data_type',"send_image");
			
			xml.open("POST","php/ajax_upload_gambar.php",true);
			let formData = new FormData(form);
			xml.send(formData);

		}
</script>
	<script src="javascript/chat.js"></script>
</body>
</html>
<?php }?>