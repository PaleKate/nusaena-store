<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/format_rupiah.php');
include('includes/library.php');

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
  <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">

      <div class="container" data-aos="fade-up">
		</br>
        <header class="section-header">
          <h2>Pesanan</h2>
          <p>Riwayat Pesanan</p>
        </header>

        <div class="row gy-4">
			<div class="table-responsive">
				<table id="table" class="display table table-striped table-bordered table-hover" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th width="5" class="text-center">No</th>
							<th class="text-center">Resi</th>
							<th class="text-center">Nama Lengkap</th>
							<th class="text-center">Alamat Pengiriman</th>
							<th class="text-center">Pembayaran</th>
							<th class="text-center">Tanggal Pesanan</th>
							<th class="text-center" width="100px;">Total</th>
							<th class="text-center">Status</th>
							<th width="120px" class="text-center">Option</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$nomor = 0;
						$unique_id = $_SESSION['ulogin'];
						$sql = "SELECT users.*, provinces.*, regencies.*, districts.*, villages.*, pesanan.* 
								FROM users, provinces, regencies, districts, villages, pesanan WHERE 
								users.unique_id=pesanan.unique_id AND 
								provinces.id=users.id_provinsi AND
								regencies.id=users.id_kota AND
								districts.id=users.id_kec AND
								villages.id=users.id_kel AND
								users.unique_id='$unique_id' ORDER BY pesanan.id_pembelian DESC";
						$query = mysqli_query($koneksidb,$sql);
								while($result = mysqli_fetch_array($query))
									{
									$tgl_order = strtotime($result['tgl_order']);
									$tgl = date("d F Y H:i:s A", $tgl_order);
									$nomor++;
					?>  
					<tr>
						<td align="center"><?php echo $nomor; ?></td>
						<td><?php echo $result['id_pembelian']; ?></td>			   
						<td><?php echo $result['nama_lengkap']; ?></td>			   
						<td><p style="margin:0;"><?php echo htmlentities($result['alamat']);?> RT. <?php echo htmlentities($result['rt']);?>/RW. <?php echo htmlentities($result['rw']);?></p>
							<p style="margin:0;"><?php echo htmlentities($result['kelurahan']);?>, Kec. <?php echo htmlentities($result['kecamatan']);?>, <?php echo htmlentities($result['kota']);?>, 
							<?php echo htmlentities($result['kode_pos']);?></p></td>
						<td><?php echo $result['bayar']; ?></td>	
						<td><?php echo $tgl; ?></td>	
						<td><?php echo format_rupiah(htmlentities($result['total']));?></td>	
						<td><?php echo $result['status']; ?></td>	
						<td class="text-center">
							<?php if($result['status']=="Menunggu Pembayaran"){?>
							<a class="btn btn-primary btn-circle btn-sm" 
								href="#myModal" data-bs-toggle="modal" 
								data-load-code="<?php echo htmlentities($result['id_pembelian']); ?>" 
								data-remote-target="#myModal .modal-body">Bayar
							</a>
							<button class="btn btn-danger btn-circle btn-sm" 
								onclick="Swal.fire({
									icon: 'warning',
									title: 'Sure',
									text: 'Apakah Kamu Yakin Akan Membatalkan Pesanan Ini ?',
									showCancelButton: true,
									confirmButtonText: 'Yes Delete It',
										}).then((result) => {
										if (result.isConfirmed) {
										window.location = 'order-del.php?id=<?php echo $result['id_pembelian'];?>';
										}
									})">Cancel
							</button>

							<?php }else{?>
							<?php if ($result['status']=="Menunggu Konfirmasi") { ?>
							<a class="btn btn-warning btn-circle btn-sm text-white" 
								href="#myModal" data-bs-toggle="modal" 
								data-load-code="<?php echo htmlentities($result['id_pembelian']); ?>" 
								data-remote-target="#myModal .modal-body">Detail
							</a>
							<?php }else{ ?>
							
							<?php if ($result['status']=="Dikemas") { ?>
							<a class="btn btn-warning btn-circle btn-sm text-white" 
								href="#myModal" data-bs-toggle="modal" 
								data-load-code="<?php echo htmlentities($result['id_pembelian']); ?>" 
								data-remote-target="#myModal .modal-body">Detail
							</a>
							<?php }else{ ?>
							
							<?php if ($result['status']=="Dikirim") { ?>
							<a class="btn btn-success btn-circle btn-sm" 
								href="#myModal" data-bs-toggle="modal" 
								data-load-code="<?php echo htmlentities($result['id_pembelian']); ?>" 
								data-remote-target="#myModal .modal-body">Detail
							</a>
							<?php }else{ ?>
							
							<?php if ($result['status']=="Selesai") { ?>
							<?php
								$unique_id = $_SESSION['ulogin'];
								$sqlusers = "SELECT * FROM users WHERE unique_id='$unique_id'";
								$queryusers = mysqli_query($koneksidb,$sqlusers);
								$users = mysqli_fetch_array($queryusers)
							?>
							<a class="btn btn-success btn-circle btn-sm" 
								href="#myModal" data-bs-toggle="modal" 
								data-load-code="<?php echo htmlentities($result['id_pembelian']); ?>" 
								data-remote-target="#myModal .modal-body">Done
							</a>
							<?php }}}}}?>
						</td>
					</tr>
					
					<?php }?>
					</tbody>
				</table>
			</div>
		</div>
      </div>
    </section>
  <!-- End Contact Section -->
	<!-- Large modal -->
	<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-body">
					<p>One fine body…</p>
				</div>
			</div>
		</div>
	</div>    
	<!-- Large modal -->
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
	<script>
	$(document).ready(function() {
    var table = $('#table').DataTable( {
		"scrollY": 400,
		"scrollX": true,
		lengthMenu:[
				[10,20,50,100,-1],
				[10,20,50,100,"All"]
				],
        buttons: [{
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                }
            },
			{
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                }
            },
			{
				extend: 'colvis',
				text: 'Filter',
			}],
		dom:
		"<'row'<'col-md-3'l><'col-md-6'B><'col-md-3'f>>" +
		"<'row'<'col-md-12'tr>>" +
		"<'row'<'col-md-5'i><'col-md-7'p>>"
    } );
 
    table.buttons().container()
        .appendTo( '#table_wrapper .col-md-6:eq(0)' );
	} );
	</script>
	<script>
		var app = {
			code: '0'
		};
		$('[data-load-code]').on('click',function(e) {
					e.preventDefault();
					var $this = $(this);
					var code = $this.data('load-code');
					if(code) {
						$($this.data('remote-target')).load('bayar.php?code='+code);
						app.code = code;
						
					}
		});
    </script>

</body>

</html>
<?php }?>