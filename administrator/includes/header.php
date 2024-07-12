<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow fixed-top">
	
	<!-- Topbar Navbar -->
	<ul class="navbar-nav ml-auto">
		<!-- Nav Item - Alerts -->
		<li class="nav-item dropdown no-arrow mx-1">
			<a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
				data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-comments fa-fw"></i>
				<!-- Counter - Alerts -->
				<?php 
					$sqlnotif = "SELECT id_cu FROM contactus WHERE status='0'";
					$querynotif = mysqli_query($koneksidb,$sqlnotif);
					$notif=mysqli_num_rows($querynotif);
				?>
				<span class="badge badge-danger badge-counter"><?php echo $notif; ?></span>
			</a>
			<!-- Dropdown - Alerts -->
			<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
				aria-labelledby="alertsDropdown">
				<h6 class="dropdown-header">
					Comments
				</h6>
				<?php 
					$outgoing_id = $_SESSION['alogin'];
					$sqlusers = "SELECT contactus.message,contactus.tgl_posting, users.nama_user, users.img FROM contactus,users WHERE 
								 contactus.id_user=users.id_user AND contactus.status='0'";
					$queryusers = mysqli_query($koneksidb,$sqlusers);
					while ($result = mysqli_fetch_array($queryusers)){
						$tgl_posting = strtotime($result['tgl_posting']);
						$tgl = date("d F Y", $tgl_posting);
				?>
				<a class="dropdown-item d-flex align-items-center" href="comments.php">
					<div class="dropdown-list-image mr-3 border-left-primary" style="border-radius:20px;">
						<img class="rounded-circle" src="../assets/img/users/<?php echo $result['img'];?>">
					</div>
					<div>
						<div class="small text-black-800"><?php echo $result['nama_user']; ?> | <?php echo $tgl; ?></div>
						<span class="font-weight-bold"><?php echo $result['message']; ?></span>
					</div>
				</a>
					<?php }?>
				<a class="dropdown-item text-center small text-black-800" href="comments.php">See All Comments</a>
			</div>
		</li>
		<!-- Nav Item - Alerts -->
		<li class="nav-item dropdown no-arrow mx-1">
			<a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
				data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-bell fa-fw"></i>
				<!-- Counter - Alerts -->
				<?php 
					$sqlnotif = "SELECT id_pembelian FROM pesanan WHERE status!='Selesai'";
					$querynotif = mysqli_query($koneksidb,$sqlnotif);
					$notif=mysqli_num_rows($querynotif);
				?>
				<span class="badge badge-danger badge-counter"><?php echo $notif; ?></span>
			</a>
			<!-- Dropdown - Pesanan -->
			<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
				aria-labelledby="alertsDropdown">
				<h6 class="dropdown-header">
					Notifikasi
				</h6>
				<?php 
					$outgoing_id = $_SESSION['alogin'];
					$sqlusers = "SELECT pesanan.status, users.nama_lengkap, users.img FROM pesanan,users WHERE 
								 pesanan.unique_id=users.unique_id AND
								 NOT pesanan.unique_id='$outgoing_id' AND 
								 NOT pesanan.status='Selesai'";
					$queryusers = mysqli_query($koneksidb,$sqlusers);
					while ($result = mysqli_fetch_array($queryusers)){
				?>
				<?php if($result['status']=="Menunggu Pembayaran"){?>
				<a class="dropdown-item d-flex align-items-center" href="kaos-bayar.php">
					<div class="dropdown-list-image mr-3 border-left-primary" style="border-radius:20px;">
						<img class="rounded-circle" src="../assets/img/users/<?php echo $result['img'];?>">
					</div>
					<div>
						<div class="small text-black-800"><?php echo htmlentities($result['nama_lengkap']);?></div>
						<span class="font-weight-bold"><?php echo htmlentities($result['status']);?></span>
					</div>
				</a>
				<?php }else{?>
				<?php if ($result['status']=="Menunggu Konfirmasi") { ?>
				<a class="dropdown-item d-flex align-items-center" href="kaos-konfirm.php">
					<div class="dropdown-list-image mr-3 border-left-primary" style="border-radius:20px;">
						<img class="rounded-circle" src="../assets/img/users/<?php echo $result['img'];?>">
					</div>
					<div>
						<div class="small text-black-800"><?php echo htmlentities($result['nama_lengkap']);?></div>
						<span class="font-weight-bold"><?php echo htmlentities($result['status']);?></span>
					</div>
				</a>
				<?php }else{ ?>
				<?php if ($result['status']=="Dikemas") { ?>
				<a class="dropdown-item d-flex align-items-center" href="kaos-kemas.php">
					<div class="dropdown-list-image mr-3 border-left-primary" style="border-radius:20px;">
						<img class="rounded-circle" src="../assets/img/users/<?php echo $result['img'];?>">
					</div>
					<div>
						<div class="small text-black-800"><?php echo htmlentities($result['nama_lengkap']);?></div>
						<span class="font-weight-bold"><?php echo htmlentities($result['status']);?></span>
					</div>
				</a>
				<?php }else{ ?>
				<?php if ($result['status']=="Dikirim") { ?>
				<a class="dropdown-item d-flex align-items-center" href="kaos-kirim.php">
					<div class="dropdown-list-image mr-3 border-left-primary" style="border-radius:20px;">
						<img class="rounded-circle" src="../assets/img/users/<?php echo $result['img'];?>">
					</div>
					<div>
						<div class="small text-black-800"><?php echo htmlentities($result['nama_lengkap']);?></div>
						<span class="font-weight-bold"><?php echo htmlentities($result['status']);?></span>
					</div>
				</a>
					<?php }}}}}?>
				<a class="dropdown-item text-center small text-black-800" href="kaos-data.php">See All</a>
			</div>
		</li>

		<!-- Nav Item - Messages -->
		<li class="nav-item dropdown no-arrow mx-1">
			<a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
				data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-envelope fa-fw"></i>
				<!-- Counter - Messages -->
				<?php 
					$outgoing_id = $_SESSION['alogin'];
					$sqlpesan = "SELECT * FROM messages WHERE status='0' AND 
							 incoming_msg_id='$outgoing_id' AND NOT outgoing_msg_id='$outgoing_id'";
						$querypesan = mysqli_query($koneksidb,$sqlpesan);
						$pesan=mysqli_num_rows($querypesan);
							if($pesan > 0){
				?>
				<span class="badge badge-danger badge-counter"><?php echo $pesan;?></span>
				<?php }?>
			</a>
			<!-- Dropdown - Messages -->
			<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
				aria-labelledby="messagesDropdown">
				<h6 class="dropdown-header">
					Message Center
				</h6>
				<?php
					$outgoing_id = $_SESSION['alogin'];
					$sql = "SELECT * FROM users WHERE NOT unique_id = '$outgoing_id' ORDER BY status, nama_user ASC LIMIT 4";
					$query = mysqli_query($koneksidb, $sql);
					$output = "";
					if(mysqli_num_rows($query) == 0){
						$output .= "No users are available to chat";
					}elseif
						(mysqli_num_rows($query) > 0){
						while($row = mysqli_fetch_assoc($query)){
						$sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
								OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
								OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
						$query2 = mysqli_query($koneksidb, $sql2);
						$row2 = mysqli_fetch_assoc($query2);
						(mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result ="No message available";
						(strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
						if(isset($row2['outgoing_msg_id'])){
							($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
						}else{
							$you = "";
						}
						$belum_terbaca = mysqli_query($koneksidb,"SELECT * FROM messages WHERE status=0 
										 AND outgoing_msg_id={$row['unique_id']} AND incoming_msg_id={$outgoing_id} ");
						$jumlah_belum_terbaca = mysqli_num_rows($belum_terbaca);
				?>
				<a class="dropdown-item d-flex align-items-center" href="chat.php?user_id=<?php echo $row['unique_id'];?>">
					<div class="dropdown-list-image mr-3 border-left-primary" style="border-radius:20px;">
						<img class="rounded-circle" src="../assets/img/users/<?php echo $row['img'];?>">
						<?php if($row['status']=="Offline now"){?> 
							<div class="status-indicator"><i class="fas fa-circle" style="color: #ccc;"></i></div>
						<?php } else { ?> 
							<div class="status-indicator"><i class="fas fa-circle" style="color: #468669;"></i></div> 
						<?php } ?>
					</div>
					<div>
						<div class="text-truncate"><?php echo $row['nama_user'];?></div>
						<?php if($row2['status']=="0"){?> 
						<div class="text-truncate font-weight-bold"><?php echo $you;?><?php echo $msg;?>
						<span class="badge badge-danger badge-counter"><?php echo $jumlah_belum_terbaca;?></span>
						</div>
						<?php } else {?>
						<div class="text-truncate"><?php echo $you;?><?php echo $msg;?></div>
						<?php }?>
					</div>
				</a>
				<?php }}?>
				<a class="dropdown-item text-center small text-black-800" href="livechat.php">Read More Messages</a>
			</div>
		</li>
		
		<li class="nav-item dropdown no-arrow mx-1">
			<!-- Sidebar Toggle (Topbar) -->
		<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mt-3">
			<i class="fa fa-bars"></i>
		</button>
		</li>
		<div class="topbar-divider d-none d-sm-block"></div>
		<!-- Nav Item - User Information -->
		<?php
			if($_SESSION['alogin']){
				$unique_id=$_SESSION['alogin'];
				$sql ="SELECT * FROM admin WHERE unique_id='$unique_id'";
				$query = mysqli_query($koneksidb,$sql);
					if(mysqli_num_rows($query)>0)
						{
					while($results = mysqli_fetch_array($query)){
		  ?>
		<li class="nav-item dropdown no-arrow">
			<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
				data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<img class="img-profile rounded-circle"
					src="img/admin/<?php echo htmlentities($results['img']);?>">
				<span class="ml-2 d-none d-lg-inline text-gray-600 small"><?php echo htmlentities($results['username']);?></span>
			</a>
			<!-- Dropdown - User Information -->
			<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
				aria-labelledby="userDropdown">
				<a class="dropdown-item" href="profile.php">
					<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
					Profile
				</a>
				<a class="dropdown-item" href="#">
					<i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
					Settings
				</a>
				<a class="dropdown-item" href="#">
					<i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
					Activity Log
				</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
					<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
					Logout
				</a>
			</div>
		</li>
			<?php }}}?>

	</ul>

</nav>