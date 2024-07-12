<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion fixed-top" id="accordionSidebar">

		<!-- Sidebar - Brand -->
		<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
			<div class="sidebar-brand-icon rotate">
			<img src="img/login-img.png" class="img-fluid" alt="">
			</div>
			<div class="sidebar-brand-text mx-3">NUSAENA Admin</div>
		</a>

		<!-- Divider -->
		<hr class="sidebar-divider my-0">

		<!-- Nav Item - Dashboard -->
		<li class="nav-item active">
			<a class="nav-link" href="index.php">
				<i class="fas fa-fw fa-tachometer-alt"></i>
				<span>Dashboard</span></a>
		</li>

		<!-- Divider -->
		<hr class="sidebar-divider">

		<!-- Heading -->
		<div class="sidebar-heading">
			Main Menu
		</div>

		<!-- Nav Item - Pages Collapse Menu -->
		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
				aria-expanded="true" aria-controls="collapseTwo">
				<i class="fas fa-money-check-alt"></i>
				<span>Penjualan</span>
			</a>
			<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
				<div class="bg-white py-3 collapse-inner rounded">
					<h6 class="collapse-header">Data Penjualan :</h6>
					<a class="collapse-item" href="kaos-bayar.php">Menunggu Pembayaran</a>
					<a class="collapse-item" href="kaos-konfirm.php">Menunggu Konfirmasi</a>
					<a class="collapse-item" href="kaos-kemas.php">Pesanan Dikemas</a>
					<a class="collapse-item" href="kaos-kirim.php">Pesanan Dikirim</a>
					<a class="collapse-item" href="kaos-selesai.php">Pesanan Selesai</a>
					<a class="collapse-item" href="kaos-data.php">All Items</a>
				</div>
			</div>
		</li>

		<!-- Nav Item - Utilities Collapse Menu -->
		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
				aria-expanded="true" aria-controls="collapseUtilities">
				<i class="fas fa-tshirt"></i>
				<span>Product</span>
			</a>
			<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
				data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<h6 class="collapse-header">Data Produk :</h6>
					<a class="collapse-item" href="kaos.php">Kaos</a>
					<a class="collapse-item" href="kategori.php">Kategori</a>
					<a class="collapse-item" href="bahan.php">Bahan</a>
				</div>
			</div>
		</li>
		
		<!-- Nav Item - Utilities Collapse Menu -->
		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTruck"
				aria-expanded="true" aria-controls="collapseTruck">
				<i class="fas fa-truck"></i>
				<span>Ongkir</span>
			</a>
			<div id="collapseTruck" class="collapse" aria-labelledby="headingTruck"
				data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<h6 class="collapse-header">Data Ongkir :</h6>
					<a class="collapse-item" href="ongkir.php">Harga Ongkir</a>
					<a class="collapse-item" href="kurir.php">Jasa Kurir</a>
					<a class="collapse-item" href="paket.php">Paket</a>
				</div>
			</div>
		</li>

		<!-- Divider -->
		<hr class="sidebar-divider">

		<!-- Heading -->
		<div class="sidebar-heading">
			Others
		</div>
		
		<!-- Nav Item - Users -->
		<li class="nav-item">
			<a class="nav-link" href="livechat.php">
				<i class="fas fa-comment-dots"></i>
				<span>Chat</span></a>
		</li>
		
		<!-- Nav Item - Users -->
		<li class="nav-item">
			<a class="nav-link" href="users.php">
				<i class="fas fa-users"></i>
				<span>Users</span></a>
		</li>

		<!-- Nav Item - Comments -->
		<li class="nav-item">
			<a class="nav-link" href="comments.php">
				<i class="fas fa-comments"></i>
				<span>Comments</span></a>
		</li>
		
		<!-- Nav Item - Contact Info-->
		<li class="nav-item">
			<a class="nav-link" href="contactinfo.php">
				<i class="fas fa-address-book"></i>
				<span>Contact Info</span></a>
		</li>

		<!-- Divider -->
		<hr class="sidebar-divider d-none d-md-block">

		<!-- Sidebar Toggler (Sidebar) -->
		<div class="text-center d-none d-md-inline">
			<button class="rounded-circle border-0" id="sidebarToggle"></button>
		</div>

</ul>
<!-- End of Sidebar -->