<?php
if(isset($_POST['login']))
{
$email=$_POST['email'];
$password=$_POST['password'];
$sql = "SELECT * FROM users WHERE email='$email'";
$query = mysqli_query($koneksidb,$sql);
if(mysqli_num_rows($query)>0){
	$currentpage=$_SERVER['REQUEST_URI'];
	$row = mysqli_fetch_assoc($query);
	if(password_verify($password, $row['password'])){
		$_SESSION['ulogin']=$row['unique_id'];
		$status = "Active now";
		 $sql2 = mysqli_query($koneksidb, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
		 if($sql2){
	echo "<script type='text/javascript'> document.location = '$currentpage'; </script>";
	} else{
		echo "<script>alert('Email atau Password Salah!');</script>";
		}
	}
}
}

?>

<div class="modal fade" id="loginForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" data-aos="fade-up">
      <div class="modal-header" data-aos="fade-up" data-aos-delay="100">
        <h3 class="modal-title" id="exampleModalLabel">Login Form</h3>
		<button type="button" class="btn btn-secondary btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" data-aos="fade-up" data-aos-delay="100">
        <form method="post">
          <div class="form-group mb-3">
            <label class="control-label">Email</label>
            <input type="text" class="form-control" name="email" placeholder="Enter Email Here...">
          </div>
          <div class="form-group mb-3">
            <label class="control-label">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password">
          </div>
		  <div class="form-group">
		    <input type="submit" name="login" value="Login" class="col-md-12 btn btn-primary">
		  </div>
        </form>
      </div>
	   <div class="modal-footer" data-aos="fade-up" data-aos-delay="100">
		<p class="text-center">Belum punya akun? <a href="regist.php">Daftar Disini</a></p><br>
        <p>Lupa Password? <a href="#forgotpassword" data-toggle="modal" data-dismiss="modal">Klik disini</a></p>
      </div>
    </div>
  </div>
</div>