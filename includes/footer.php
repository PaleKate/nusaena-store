<footer id="footer" class="footer">

    <div class="footer-newsletter">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-12 text-center">
            <h1>Find Us</h1>
				<p>Hubungi Kami Melalui Chat :</p>
            <a href="livechat/users.php" 
			class="btn btn-primary col-lg-2" target="_blank">Live Chat</a>
		  </div>
        </div>
      </div>
    </div>

    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 col-md-12 footer-info">
            <a href="index.php" class="logo d-flex align-items-center">
              <img src="assets/img/logo.png" alt="">
              <span>NUSAENA STORE</span>
            </a>
			<?php
				$sql2 = "SELECT * FROM contactusinfo WHERE page_name='Tentang Kami'";
				$query2 = mysqli_query($koneksidb,$sql2);
					while($result = mysqli_fetch_array($query2))
			{ ?>
            <p><?php echo $result['detail'];?></p>
			<?php }?>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="youtube"><i class="bi bi-youtube"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#">T-shirt Design</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Delivery</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Take Order</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact text-center text-md-start">
            <h4 class="mb-0">Contact Us</h4>
			<?php
				$sql2 = "SELECT * FROM contactusinfo WHERE page_name='Alamat'";
				$query2 = mysqli_query($koneksidb,$sql2);
					while($result = mysqli_fetch_array($query2))
			{ ?>
            <p class="mb-0"><?php echo $result['detail'];?>
			<?php }?>
			<?php
				$sql2 = "SELECT * FROM contactusinfo WHERE page_name='Telp'";
				$query2 = mysqli_query($koneksidb,$sql2);
					while($result = mysqli_fetch_array($query2))
			{ ?>
              <strong>Phone :</strong> <?php echo $result['detail'];?>
			<?php }?>
			<?php
				$sql2 = "SELECT * FROM contactusinfo WHERE page_name='Email'";
				$query2 = mysqli_query($koneksidb,$sql2);
					while($result = mysqli_fetch_array($query2))
			{ ?>
              <strong>Email :</strong> <?php echo $result['detail'];?><br>
			<?php }?>
            </p>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>NUSAENA STORE</span></strong>. All Rights Reserved
      </div>
    </div>
  </footer>