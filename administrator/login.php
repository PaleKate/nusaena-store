<?php 
session_start();
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
<!-- Head -->
<?php include ('includes/head.php'); ?>
<!-- End of Head -->
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
							<img src="img/login-img.png" class="img-fluid" alt="">
							</div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="username" name="username" aria-describedby="emailHelp"
                                                placeholder="Enter Username Here...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="password" name="password" placeholder="Password">
                                        </div>
										<div class="form-group">
											<button class="btn btn-primary btn-user btn-block" name="login" type="submit">
												Login
											</button>
										</div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
	<!-- Sweetalert2 -->
	<script src="package/dist/sweetalert2.all.min.js"></script>

</body>
<?php
if(isset($_POST['login']))
{
$username=$_POST['username'];
$password=($_POST['password']);
$sql = "SELECT * FROM admin WHERE username='$username'";
$query = mysqli_query($koneksidb,$sql);
if(mysqli_num_rows($query) === 1){
	$row = mysqli_fetch_assoc($query);
	if(password_verify($password, $row['password'])){
		$_SESSION['alogin']=$row['unique_id'];
		$status = "Active now";
		 $sql2 = mysqli_query($koneksidb, "UPDATE admin SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
		 if($sql2){
	echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'success',
			  title: 'Done',
			  text: 'Login Berhasil'
			}).then(function() {
				window.location = 'index.php';
			});
		</script>";	
	}else{
	echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'warning',
			  title: 'Oops',
			  text: 'Username atau Password Salah'
			  }).then(function() {
				window.location = 'login.php';
			});
		</script>";	
			}
		}
	}
}

?>
</html>