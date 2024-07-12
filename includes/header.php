<header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span>NUSAENA STORE</span>
      </a>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="index.php">Home</a></li>
          <li class="dropdown"><a href="#"><span>About Us</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="brand.php">Brand Story</a></li>
              <li><a href="sub-brand.php">Sub Brands</a></li>
            </ul>
          </li>
		  <li class="dropdown"><a href="#"><span>Our Product</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="product.php">All Product</a></li>
			  <?php 
				$sqlkaos = "SELECT * FROM kategori ORDER BY kategori ASC LIMIT 6";
				$querykaos = mysqli_query($koneksidb,$sqlkaos);
				while ($result = mysqli_fetch_array($querykaos)){
					?>
              <li><a href="product-katalog.php?kid=<?php echo htmlentities($result['id_kategori']);?>"><?php echo htmlentities($result['kategori']);?> T-shirt</a></li>
				<?php }?>
            </ul>
          </li>
		  <li><a class="nav-link scrollto" href="contactus.php">Contact Us</a></li>
		  <li><a class="nav-link scrollto" href="htorder.php">How To Order</a></li>
		   <?php  
			   if(strlen($_SESSION['ulogin'])==0){	
			?>
          <li><a class="getstarted scrollto" href="#" data-bs-toggle="modal" data-bs-target="#loginForm">Login</a></li>
		  <?php } else { 
				if($_SESSION['ulogin']){
					$unique_id=$_SESSION['ulogin'];
					$sql ="SELECT * FROM users WHERE unique_id='$unique_id'";
					$query = mysqli_query($koneksidb,$sql);
						if(mysqli_num_rows($query)>0)
						{
						while($results = mysqli_fetch_array($query)){
						$nama_user=$results['nama_user'];
						$nama=substr($nama_user,0,4);
		  ?>
		  <li>
				  <?php 
					if ($_SESSION['cart']){
				  ?>
			<a class="nav-link scrollto" href="#" data-bs-toggle="modal" data-bs-target="#cartForm">
				<i class="bi bi-cart4" style="font-size: 1.5rem;"></i>
				  <span style="padding:3px;background:#e9222c;border-radius:5px;"></span>
			</a>
				  <?php }else{?>
			<a class="nav-link scrollto" href="#" data-bs-toggle="modal" data-bs-target="#cartForm">
				<i class="bi bi-cart4" style="font-size: 1.5rem;"></i>
			</a>
				  <?php }?>
		  </li>	
			<?php 
				$unique_id=$_SESSION['ulogin'];
				$sqlpesan = "SELECT * FROM messages WHERE status='0' AND 
							 incoming_msg_id='$unique_id' AND NOT outgoing_msg_id='$unique_id'";
				$querypesan = mysqli_query($koneksidb,$sqlpesan);
				$pesan=mysqli_num_rows($querypesan);
			?>
			<?php 
				$unique_id=$_SESSION['ulogin'];
				$sqlnotif = "SELECT id_pembelian FROM pesanan WHERE 
							 status!='Selesai' AND unique_id='$unique_id'";
				$querynotif = mysqli_query($koneksidb,$sqlnotif);
				$notif=mysqli_num_rows($querynotif);
			?>
		  <li class="dropdown">
			<a href="#" class="logo d-flex align-items-center">
			  <img src="assets/img/users/<?php echo htmlentities($results['img']);?>" 
					style="object-fit: cover; border:solid 2px #4154f1; border-radius: 50%; height: 30px; width: 30px;">
				<?php if (strlen($results['nama_user'])>4){?>
				<?php echo $nama; ?>...
				
				<?php }else{?>
				<?php echo $results['nama_user'];?>
				<?php }?>
				<i class="bi bi-chevron-down"></i>
				<?php if (($pesan>0) || ($notif>0)){?>
				<span style="padding:3px;background:#e9222c;border-radius:5px;"></span>
				<?php }?>
			</a>
			<ul>
              <li><a href="profile.php">Profile Settings</a></li>
              <li><a href="livechat/users.php" target="_blank">Message
				<?php if ($pesan>0){?>
			  <span style="padding:5px;background:#e9222c;font-size:11px;color:#fff;border-radius:5px;"><?php echo $pesan; ?></span>
				<?php }?>
			  </a></li>
              <li><a href="update-password.php">Update Password</a></li>
              <li><a href="riwayatorder.php">Riwayat Pesanan
				<?php if ($notif>0){?>
			  <span style="padding:5px;background:#e9222c;font-size:11px;color:#fff;border-radius:5px;"><?php echo $notif; ?></span>
				<?php }?>
			  </a></li>
              <li><a href="includes/logout.php?logout_id=<?php echo $results['unique_id']; ?>">Logout</a></li>
			</ul>
          </li>
		  <?php }}}}?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
	  <!-- .navbar -->
	
    </div>
  </header>