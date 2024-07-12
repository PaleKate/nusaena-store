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
          <h2>Users</h2>
          <p>Create Account</p>
        </header>

        <div class="row gy-4">

          <div class="col-lg-12">
            <form action="registact.php" method="post" onSubmit="return checkLetter(this);" enctype="multipart/form-data">
              <div class="row gy-4">

                <div class="col-md-6">
				  <label class="control-label">Nama Lengkap<span style="color:red">*</span></label>
                  <input type="text" name="nama_lengkap" class="form-control" placeholder="Your Name" required>
                </div>
				
				<div class="col-md-6">
				  <label class="control-label">Username<span style="color:red">*</span></label>
                  <input type="text" name="nama_user" class="form-control" placeholder="Your Username" required>
                </div>

                <div class="col-md-6 ">
                  <label class="control-label">Email<span style="color:red">*</span></label>
				  <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                </div>

                <div class="col-md-6">
                  <label class="control-label">Password<span style="color:red">*</span></label>
				  <input type="password" class="form-control" name="password" placeholder="Your Password" required>
                </div>

                <div class="col-md-6">
                  <label class="control-label">Confirm Password<span style="color:red">*</span></label>
				  <input type="password" class="form-control" name="password2" placeholder="Confirm Password" required>
                </div>
				
				<div class="col-md-6">
                  <label class="control-label">Telp/Wa<span style="color:red">*</span></label>
				  <input type="number" class="form-control" name="wa" min=0 required>
				</div>
				
				<div class="col-md-6">
                  <label class="control-label">Address<span style="color:red">*</span></label>
				  <textarea class="form-control" name="alamat" rows="3" placeholder="Your Address" required></textarea>
                </div>

                <div class="col-md-2">
                  <label class="control-label">RT<span style="color:red">*</span></label>
				  <input type="number" class="form-control" name="rt" min=0 required>
				</div>

				<div class="col-md-2">
				  <label class="control-label">RW<span style="color:red">*</span></label>
				  <input type="number" class="form-control" name="rw" min=0 required>
                </div>
				
				<div class="col-md-2">
				  <label class="control-label">Kode Pos<span style="color:red">*</span></label>
				  <input type="number" class="form-control" name="kode_pos" min=0 required>
                </div>
				
                <div class="col-md-6">
                <label class="control-label col-sm-3">Provinsi<span style="color:red">*</span></label>
                  <?php                    
                    $sql_provinsi = mysqli_query($koneksidb,"SELECT * FROM provinces ORDER BY provinsi ASC");
                   ?>
                  <select class="form-control" name="id_provinsi" id="provinsi" required>
                    <option></option>
                    <?php                       
                        while($rs_provinsi = mysqli_fetch_assoc($sql_provinsi)){ 
                           echo '<option value="'.$rs_provinsi['id'].'">'.$rs_provinsi['provinsi'].'</option>';
                        }                        
                      ?>
                  </select>
                  <img src="assets/vendor/img/loading.gif" width="35" id="load1" style="display:none;" />
                </div>
				
                <div class="col-md-6">          
                <label class="control-label col-sm-3" >Kota/Kabupaten<span style="color:red">*</span></label>
                  <select class="form-control" name="id_kota" id="kota" required>
                    <option></option>
                  </select>
                  <img src="assets/vendor/img/loading.gif" width="35" id="load2" style="display:none;" />
                </div>
			  
                <div class="col-md-6">          
                <label class="control-label col-sm-3" >Kecamatan<span style="color:red">*</span></label>
                  <select class="form-control" name="id_kec" id="kecamatan" required>
                    <option></option>
                  </select>
                  <img src="assets/vendor/img/loading.gif" width="35" id="load3" style="display:none;" />
                </div>
				
                <div class="col-md-6">          
                <label class="control-label col-sm-3" >Kelurahan/Desa<span style="color:red">*</span></label>
                  <select class="form-control" name="id_kel" id="kelurahan" required>
                    <option></option>
                  </select>
                </div>
				
				<div class="col-md-6">          
                <label class="control-label col-sm-6" >Upload Foto Profil<span style="color:red">*</span></label>
                  <input type="file" class="form-control" name="img" accept="image/*" required>
                </div>
				
                <div class="col-md-12 text-center">
                  <button type="submit" class="btn btn-primary btn-block" name="save">Register</button>
                </div>

              </div>
            </form>

          </div>

        </div>

      </div>

    </section>
  <!-- End Contact Section -->
  
</main>
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

</html>