<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/format_rupiah.php');
include('includes/library.php');
if(strlen($_SESSION['alogin'])==0){	
header('location: login.php');
} else{
	?>
<!DOCTYPE html>
<html lang="en">

<head>
<!-- Head -->
<?php include ('includes/head.php'); ?>
<!-- End of Head -->
</head>
<body id="page-top">
<!-- Topbar -->
<?php include ('includes/header.php'); ?>
<!-- End of Topbar -->

<!-- Page Wrapper -->
<div id="wrapper">

<!-- Sidebar -->
<?php include ('includes/leftbar.php'); ?>
<!-- End of Sidebar -->
	<!-- Content Wrapper -->
    <div class="col-md-10 offset-2 mt-4">
        <div id="content-wrapper" class="d-flex flex-column ml-auto">

            <!-- Main Content -->
            <div id="content" class="mt-4">
                <!-- Begin Page Content -->
                <div class="container-fluid mt-5">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Pesanan Menunggu Konfirmasi</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary text-center">NUSAENA STORE TASIKMALAYA</h6>
                        </div>
                        <div class="card-body">
                          <div class="table-responsive">
							<table id="table" class="display nowrap table table-striped table-bordered table-hover" width="100%" cellspacing="0">
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
									$sql = "SELECT users.*, provinces.*, regencies.*, districts.*, villages.*, pesanan.* 
											FROM users, provinces, regencies, districts, villages, pesanan WHERE 
											users.unique_id=pesanan.unique_id AND 
											provinces.id=users.id_provinsi AND
											regencies.id=users.id_kota AND
											districts.id=users.id_kec AND
											villages.id=users.id_kel AND 
											pesanan.status='Menunggu Konfirmasi' ORDER BY pesanan.id_pembelian ASC";
									$query = mysqli_query($koneksidb,$sql);
											while($result = mysqli_fetch_array($query))
												{
												$time=strtotime($result['tgl_order']);
												$tgl_order=date("d F Y", $time);
												$time_order=date("H:i:s A", $time);
												$nomor++;
								?>  
								<tr>
									<td align="center"><?php echo $nomor; ?></td>
									<td><?php echo $result['id_pembelian']; ?></td>			   
									<td><a href="#myModal" data-toggle="modal" data-load-user="<?php echo $result['id_user']; ?>" 
											data-remote-target="#myModal .modal-body"><?php echo $result['nama_lengkap']; ?>
										</a>
									</td>			   
									<td><?php echo htmlentities($result['alamat']);?> RT. <?php echo htmlentities($result['rt']);?>/RW. <?php echo htmlentities($result['rw']);?>, <p style="margin:0;"><?php echo htmlentities($result['kelurahan']);?>, Kec. <?php echo htmlentities($result['kecamatan']);?>, <?php echo htmlentities($result['kota']);?> (<?php echo htmlentities($result['kode_pos']);?>)</p></td>
									<td><?php echo $result['bayar']; ?></td>	
									<td><?php echo $tgl_order; ?><br>	
										<?php echo $time_order; ?>
									</td>	
									<td><?php echo format_rupiah(htmlentities($result['total']));?></td>	
									<td><?php echo $result['status']; ?></td>	
									<td class="text-center">
										<a href="#myModal" class="btn btn-primary btn-circle btn-sm" data-toggle="modal" title="Details"
												data-load-code="<?php echo $result['id_pembelian']; ?>" data-remote-target="#myModal .modal-body">
											<i class="fas fa-eye"></i>
										</a>
									</td>
								</tr>
								
								<?php }?>
								</tbody>
							</table>
							<!-- Large modal -->
							<div class="modal bs-example-modal animated--fade-in" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-xl">
									<div class="modal-content">
										<div class="modal-body">
											<p>One fine body…</p>
										</div>
									</div>
								</div>
							</div>    
							<!-- Large modal --> 
						  </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include ('includes/footer.php'); ?>
            <!-- End of Footer -->

        </div>
	</div>
	<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
	<!-- End Of Scroll to Top Button-->

    <!-- Logout Modal-->
    <?php include ('includes/logout.php'); ?>
	<!-- End Of Logout Modal-->
	
    <!-- javaScript-->
    <?php include ('includes/script.php'); ?>
	<!-- End Of javaScript-->
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
				orientation: 'landscape',
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
		"<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
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
						$($this.data('remote-target')).load('kaos-bayar-view.php?code='+code);
						app.code = code;
						
					}
		});
		$('[data-load-user]').on('click',function(e) {
					e.preventDefault();
					var $this = $(this);
					var code = $this.data('load-user');
					if(code) {
						$($this.data('remote-target')).load('usersview.php?code='+code);
						app.code = code;
						
					}
		});
	</script>
</body>

</html>
<?php }?>