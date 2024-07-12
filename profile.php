<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['ulogin'])==0){ 
	header('location:index.php');
}else{
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
          <p>Update Account</p>
        </header>

        <div class="row gy-4">
		<?php 
			$unique_id=$_SESSION['ulogin'];
			$sql = "SELECT * FROM users 
					JOIN provinces ON provinces.id=users.id_provinsi
					JOIN regencies ON regencies.id=users.id_kota
					JOIN districts ON districts.id=users.id_kec	
					JOIN villages ON villages.id=users.id_kel
					WHERE unique_id='$unique_id'";
			$query = mysqli_query($koneksidb,$sql);
			while($result=mysqli_fetch_array($query)){
				$timeReg = strtotime($result['RegDate']);
				$RegDate = date("d F Y H:i:s A", $timeReg);
				$timeUp = strtotime($result['UpdationDate']);
				$UpdationDate = date("d F Y H:i:s A", $timeUp);
		?>
          <div class="col-lg-12">
            <form method="post" onSubmit="return checkLetter(this);" enctype="multipart/form-data">
              <div class="row gy-4">
				<div class="col-md-12 text-center">
				  <img src="assets/img/users/<?php echo htmlentities($result['img']);?>" 
						style="object-fit: cover; border:solid 3px #4154f1; border-radius: 50%; height: 120px; width: 120px;">
					<div class="my-2"></div>
					  <a class="btn btn-primary" href="changeimage.php?imgid=<?php echo htmlentities($result['id_user'])?>">
						Change</a>
                </div>
				
				<div class="form-group">
			      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
					<div class="service-box blue">
					  <label class="control-label">Tanggal Daftar -</label>
					  <?php echo $RegDate;?>
					</div>
				  </div>
				</div>
					<?php if($result['UpdationDate']!=""){?>
				<div class="form-group">
				  <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
					<div class="service-box orange">
					  <label class="control-label">Terakhir Update -</label>
					  <?php echo $UpdationDate;?>
					</div>
				  </div>
				</div>
					<?php } ?>
				
                <div class="col-md-6">
				  <label class="control-label">Nama Lengkap<span style="color:red">*</span></label>
                  <input type="text" name="nama_lengkap" class="form-control" value="<?php echo htmlentities($result['nama_lengkap']);?>" required>
                </div>
				
				<div class="col-md-6">
				  <label class="control-label">Username<span style="color:red">*</span></label>
                  <input type="text" name="nama_user" class="form-control" value="<?php echo htmlentities($result['nama_user']);?>" required>
                </div>

                <div class="col-md-6 ">
                  <label class="control-label">Email<span style="color:red">*</span></label>
				  <input type="email" class="form-control" name="email" value="<?php echo htmlentities($result['email']);?>" required readonly>
                </div>
				
				<div class="col-md-6">
                  <label class="control-label">Telp/Wa<span style="color:red">*</span></label>
				  <input type="number" class="form-control" name="wa" min=0 value="<?php echo htmlentities($result['wa']);?>" required>
				</div>
				
				<div class="col-md-6">
                  <label class="control-label">Address<span style="color:red">*</span></label>
				  <textarea class="form-control" name="alamat" rows="3" required><?php echo htmlentities($result['alamat']);?></textarea>
                </div>

                <div class="col-md-2">
                  <label class="control-label">RT<span style="color:red">*</span></label>
				  <input type="number" class="form-control" name="rt" min=0 value="<?php echo htmlentities($result['rt']);?>" required>
				</div>

				<div class="col-md-2">
				  <label class="control-label">RW<span style="color:red">*</span></label>
				  <input type="number" class="form-control" name="rw" min=0 value="<?php echo htmlentities($result['rw']);?>" required>
                </div>
				
				<div class="col-md-2">
				  <label class="control-label">Kode Pos<span style="color:red">*</span></label>
				  <input type="number" class="form-control" name="kode_pos" min=0 value="<?php echo htmlentities($result['kode_pos']);?>" required>
                </div>
				
                <div class="col-md-6">
                <label class="control-label col-sm-3">Provinsi<span style="color:red">*</span></label>
                  <?php                    
                    $sql_provinsi = mysqli_query($koneksidb,"SELECT * FROM provinces ORDER BY provinsi ASC");
                   ?>
                  <select class="form-control" name="id_provinsi" id="provinsi" required>
                    <option value="<?php echo htmlentities($result['id_provinsi']);?>"><?php echo htmlentities($result['provinsi']);?></option>
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
                    <option value="<?php echo htmlentities($result['id_kota']);?>"><?php echo htmlentities($result['kota']);?></option>
                  </select>
                  <img src="assets/vendor/img/loading.gif" width="35" id="load2" style="display:none;" />
                </div>
			  
                <div class="col-md-6">          
                <label class="control-label col-sm-3" >Kecamatan<span style="color:red">*</span></label>
                  <select class="form-control" name="id_kec" id="kecamatan" required>
                    <option value="<?php echo htmlentities($result['id_kec']);?>"><?php echo htmlentities($result['kecamatan']);?></option>
                  </select>
                  <img src="assets/vendor/img/loading.gif" width="35" id="load3" style="display:none;" />
                </div>
				
                <div class="col-md-6">          
                <label class="control-label col-sm-3" >Kelurahan/Desa<span style="color:red">*</span></label>
                  <select class="form-control" name="id_kel" id="kelurahan" required>
                    <option value="<?php echo htmlentities($result['id_kel']);?>"><?php echo htmlentities($result['kelurahan']);?></option>
                  </select>
                </div>
				
			<?php }?>
                <div class="col-md-12 text-center">
                  <button type="submit" class="btn btn-primary btn-block" name="save">Save Change</button>
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
  
  <!-- ======= Cart Form ======= -->
  <?php include('includes/cart.php'); ?>
  <!-- End Cart Form -->
	
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  
  <!-- ======= Script.js ======= -->
  <?php include('includes/script.php'); ?>
  <!-- End Script.js -->

</body>
<?php
if(isset($_POST['save']))
{
$nama_lengkap=$_POST['nama_lengkap'];
$nama_user=$_POST['nama_user'];
$alamat=$_POST['alamat'];
$rt=$_POST['rt'];
$rw=$_POST['rw'];
$kode_pos=$_POST['kode_pos'];
$wa=$_POST['wa'];
$id_provinsi=$_POST['id_provinsi'];
$id_kota=$_POST['id_kota'];
$id_kec=$_POST['id_kec'];
$id_kel=$_POST['id_kel'];
$email=$_POST['email'];
$sql1="UPDATE users SET nama_lengkap='$nama_lengkap', nama_user='$nama_user', alamat='$alamat', rt='$rt', rw='$rw', 
		kode_pos='$kode_pos', wa='$wa', id_provinsi='$id_provinsi', id_kota='$id_kota', id_kec='$id_kec', id_kel='$id_kel' 
		WHERE email='$email'";
$lastInsertId = mysqli_query($koneksidb, $sql1);
	if($lastInsertId){
		echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'success',
			  title: 'Done',
			  text: 'Update Profil Berhasil'
			  }).then(function() {
				window.location = 'profile.php';
			});
		</script>";	
	}else {
		echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'warning',
			  title: 'Oops',
			  text: 'Terjadi Kesalahan Update Profil!!',
			  });.then(function() {
				window.location = 'profile.php';
			});
		</script>";	
	}
}	
?>
</html>
<?php }?>