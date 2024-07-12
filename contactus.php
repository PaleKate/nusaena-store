<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/format_rupiah.php');
include('includes/library.php');
?>	
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- ======= Head ======= -->
  <?php include('includes/head.php');?>
  <!-- End Head -->
</head>
<body>

  <!-- ======= Header ======= -->
  <?php include('includes/header.php');?>
  <!-- End Header -->

<main id="main">
  <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">

      <div class="container" data-aos="fade-up">
		
		</br>
        <header class="section-header">
          <h2>Contact</h2>
          <p>Contact Us</p>
        </header>

        <div class="row gy-4">
		  
          <div class="col-lg-6">

            <div class="row gy-4">
			
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-geo-alt"></i>
                  <h3>Address</h3>
                  <?php
				$sql2 = "SELECT * FROM contactusinfo WHERE page_name='Alamat'";
				$query2 = mysqli_query($koneksidb,$sql2);
					while($result = mysqli_fetch_array($query2))
				{ ?>
				<p><?php echo $result['detail'];?></p>
				<?php }?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-telephone"></i>
                  <h3>Call Us</h3>
                  <?php
				$sql2 = "SELECT * FROM contactusinfo WHERE page_name='Telp'";
				$query2 = mysqli_query($koneksidb,$sql2);
					while($result = mysqli_fetch_array($query2))
				{ ?>
				<p><?php echo $result['detail'];?></p>
				<?php }?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-envelope"></i>
                  <h3>Email Us</h3>
                  <?php
				$sql2 = "SELECT * FROM contactusinfo WHERE page_name='Email'";
				$query2 = mysqli_query($koneksidb,$sql2);
					while($result = mysqli_fetch_array($query2))
				{ ?>
				<p><?php echo $result['detail'];?></p>
				<?php }?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-clock"></i>
                  <h3>Open Hours</h3>
                  <?php
				$sql2 = "SELECT * FROM contactusinfo WHERE page_name='Jadwal'";
				$query2 = mysqli_query($koneksidb,$sql2);
					while($result = mysqli_fetch_array($query2))
				{ ?>
				<p><?php echo $result['detail'];?></p>
				<?php }?>
                </div>
              </div>
            </div>

          </div>
		<?php if($_SESSION['ulogin'])
				
              {?>
          <div class="col-lg-6">
			  <?php 
				$unique_id=$_SESSION['ulogin'];
				$sql = "SELECT * FROM users WHERE unique_id='$unique_id'";
				$query = mysqli_query($koneksidb,$sql);
				while($result=mysqli_fetch_array($query)){
			  ?>
            <form method="post" class="php-email-form">
              <div class="row gy-4">
				<div class="col-md-12">
                  <label>Ada Pertanyaan? Silahkan komen dibawah ini</label>
                </div>
				
                <div class="col-md-6">
                  <input type="hidden" name="id_user" class="form-control" value="<?php echo htmlentities($result['id_user']);?>" required>
                  <input type="text" name="name" class="form-control" value="<?php echo htmlentities($result['nama_user']);?>" readonly>
                </div>

                <div class="col-md-6 ">
                  <input type="text" class="form-control" name="email" value="<?php echo htmlentities($result['email']);?>" readonly>
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required></textarea>
                </div>
				<?php }?>
                <div class="col-md-12 text-center">
                  <button type="submit" name="submit">Send Message</button>
                </div>

              </div>
            </form>

          </div>
		  <?php } else { ?>
		  <div class="col-lg-6">
            <form method="post" class="php-email-form">
              <div class="row gy-4">
				<div class="col-md-12">
                  <label>Ada Pertanyaan? Silahkan komen dibawah ini</label>
                </div>
				
                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                </div>

                <div class="col-md-6 ">
                  <input type="text" class="form-control" name="email" placeholder="Your Email" required>
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required></textarea>
                </div>
				
                <div class="col-md-12 text-center">
                  <button type="submit" name="alert">Send Message</button>
                </div>

              </div>
            </form>

          </div>
		  <?php }?>
        </div>

      </div>

    </section>
	<!-- End Contact Section -->

  </main>
  <!-- End #main -->
  
  <!-- ======= Footer ======= -->
  <?php include('includes/footer.php'); ?>
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  
  <!-- ======= Login Form ======= -->
  <?php include('includes/login.php'); ?>
  <!-- End Login Form -->
  
  <!-- ======= Cart Form ======= -->
  <?php include('includes/cart.php'); ?>
  <!-- End Cart Form -->
  
  <!-- ======= Script.js ======= -->
  <?php include('includes/script.php'); ?>
  <!-- End Script.js -->

</body>
<?php
if(isset($_POST['alert']))
{
	echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'warning',
			  title: 'Oops',
			  text: 'Anda harus login dahulu!!'
			});
		</script>";	
	} 
?>
<?php
if(isset($_POST['submit']))
{
$subject=$_POST['subject'];
$message=$_POST['message'];
$id_user=$_POST['id_user'];
$status="0";
$sql1="INSERT INTO contactus(id_user,subject,message,status) 
					VALUES('$id_user','$subject','$message','$status')";
$lastInsertId = mysqli_query($koneksidb, $sql1);
	if($lastInsertId){
		echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'success',
			  title: 'Done',
			  text: 'Komentar Anda Telah Dikirim'
			  });
		</script>";	
	}else {
		echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'warning',
			  title: 'Oops',
			  text: 'Terjadi Kesalahan Silahkan Coba Lagi!!',
			  });
		</script>";	
	}
}	
?>
</html>