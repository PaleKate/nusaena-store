<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/format_rupiah.php');
include('includes/library.php');
?>
<div class="modal-header" data-aos="fade-up" data-aos-delay="100">
	<h3 class="modal-title" id="exampleModalLabel">Rincian Pesanan Anda</h3>
		<button type="button" class="btn btn-secondary btn-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body" data-aos="fade-up" data-aos-delay="100">
	<form method="post" action="bayaract.php" enctype="multipart/form-data">
		<div class="row gy-4">	
			<div class="table-responsive">
				<table id="table" class="display nowrap table table-striped table-bordered table-hover" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th class="text-center">No</th>
							<th class="text-center">Image</th>
							<th class="text-center">Nama Produk</th>
							<th class="text-center">Bahan</th>
							<th class="text-center" width="80">QTY</th>
							<th class="text-center" width="80">Size</th>
							<th class="text-center">Harga Produk</th>
							<th class="text-center">Total</th>
						</tr>
					</thead>
					<tbody>
						<?php if($_GET) {
								$nomor=0;
								$Kode = $_GET['code'];
								$mySql ="SELECT orderan.*, produk.*, pesanan.*, bahan.* 
										 FROM orderan, produk, pesanan, bahan WHERE 
										 orderan.id_produk=produk.id_produk AND
										 orderan.id_pembelian=pesanan.id_pembelian AND
										 produk.id_bahan=bahan.id_bahan AND
										 orderan.id_pembelian ='$Kode'";
								$myQry = mysqli_query($koneksidb, $mySql);
								while($result = mysqli_fetch_array($myQry)){
								$ongkir = $result['harga_ongkir'];
								$harga_produk = $result['harga_produk']*$result['qty'];
								$total += $harga_produk;
								$total_produk = $total+$ongkir;
								$bayar = $result['bayar'];
								$nomor++;
							
						?>
						<tr>
							<td align="center"><?php echo $nomor; ?></td>
							<td align="center"><a href="product-details.php?pid=<?php echo $result['id_produk'];?>"><img src="administrator/img/kaos/<?php echo htmlentities($result['image1']);?>" alt="" width="100" height="80"></td>
							<td><?php echo $result['nama_produk']; ?></td>
							<td><?php echo $result['bahan']; ?></td>
							<td><?php echo $result['qty']; ?></td>	
							<td><?php echo $result['size']; ?></td>					   
							<td><?php echo format_rupiah($result['harga_produk']);?></td>
							<td><?php echo format_rupiah($harga_produk);?></td>
						</tr>
						<?php }}?>
					</tbody>
					<tfoot>
						<tr>
							<td style="font-weight:bold;"align="right" colspan="7">Total Produk</td>
							<td colspan="8" style="font-weight:bold;"align="right">
							<?php echo format_rupiah($total);?></td>
						</tr>
						<tr>
							<td style="font-weight:bold;"align="right" colspan="7">Ongkir</td>
							<td colspan="8" style="font-weight:bold;"align="right">
							<?php echo format_rupiah($ongkir);?></td>
						</tr>
						<tr>
							<td style="font-weight:bold;"align="right" colspan="7">TOTAL PEMBAYARAN</td>
							<td colspan="8" style="font-weight:bold;"align="right">
							<input type="hidden" name="total" value="<?php echo $total_produk; ?>">
							<?php echo format_rupiah($total_produk);?></td>
						</tr>
					</tfoot>
				</table>
			</div>
			<?php
				$Kode = $_GET['code'];
				$mySql2 ="SELECT * FROM pesanan WHERE id_pembelian ='$Kode'";
				$myQry2 = mysqli_query($koneksidb, $mySql2);
				$result2 = mysqli_fetch_array($myQry2);
				$tgl_order=$result2['tgl_order'];
				$time=strtotime($result2['tgl_order']) + 1*60*60*24;
				$tgl_besok=date("d F Y H:i:s A", $time);
				$time_konfirm=strtotime($result2['tgl_order']) + 2*60*60*24;
				$konfirmasi=date("d F Y H:i:s A", $time_konfirm);
				$time_dikemas=strtotime($result2['tgl_order']) + 4*60*60*24;
				$dikemas=date("d F Y", $time_dikemas);
				$time_dikirim=strtotime($result2['tgl_order']) + 9*60*60*24;
				$dikirim=date("d F Y", $time_dikirim);
			
		?>
			<?php if($result2['status']=="Menunggu Pembayaran"){?>
			<div class="col-md-12">          
				<label class="control-label col-sm-6" ><strong>Upload Bukti Pembayaran</strong><span style="color:red">*</span></label>
				  <input type="hidden" name="id_pembelian" value="<?php echo $result2['id_pembelian']; ?>" required>
				  <input type="file" class="form-control" name="img" accept="image/*" required>
			</div>
			<div class="col-md-8">
				<div class="alert alert-info">
				<?php
					$sql2 = "SELECT * FROM contactusinfo WHERE page_name='$bayar'";
					$query2 = mysqli_query($koneksidb,$sql2);
					$result = mysqli_fetch_array($query2)
				?>
					<p class="mb-0">Segera Lakukan Pembayaran Sebelum Tanggal 
						<strong><?php echo $tgl_besok;?></strong></p>
					<p class="mb-0">Silahkan upload bukti pembayaran dengan total 
						<strong><?php echo format_rupiah($total_produk);?></strong> 
					Via <strong><?php echo $result['page_name'];?> : <?php echo $result['detail'];?></strong></p>
				</div>
			</div>
			<div class="col-md-4">
			  <button type="submit" class="col-md-6 btn btn-primary btn-block" style="float:right;" name="update">Proses</button>
			</div>
			
			<?php }else{?>
			<?php if ($result2['status']=="Menunggu Konfirmasi") { ?>
			<div class="col-md-4">
				<a href="administrator/img/nota/<?php echo htmlentities($result2['bukti_bayar']);?>" target="_blank">
					<img src="administrator/img/nota/<?php echo htmlentities($result2['bukti_bayar']);?>" width="250" height="150" 
					 style="border:solid 1px #000; margin-bottom: 15px;">
				</a>
			</div>
			<div class="col-md-8">	
				<div class="alert alert-warning">
					<p class="mb-0">Pembayaran sedang menunggu konfirmasi oleh Admin paling lambat tanggal
					<strong><?php echo $konfirmasi;?></strong></p>
				</div>
			</div>
			<?php }else{ ?>
			
			<?php if ($result2['status']=="Dikemas") { ?>
			<div class="col-md-4">
				<a href="administrator/img/nota/<?php echo htmlentities($result2['bukti_bayar']);?>" target="_blank">
					<img src="administrator/img/nota/<?php echo htmlentities($result2['bukti_bayar']);?>" width="250" height="150" 
					 style="border:solid 1px #000; margin-bottom: 15px;">
				</a>
			</div>
			<div class="col-md-8">	
				<div class="alert alert-warning">
					<p class="mb-0">Pesanan sedang dikemas dan akan dikirim paling lambat tanggal
					<strong><?php echo $dikemas;?></strong></p>
				</div>
			</div>
			<?php }else{ ?>
			
			<?php if ($result2['status']=="Dikirim") { ?>
			<div class="col-md-4">
				<a href="administrator/img/nota/<?php echo htmlentities($result2['bukti_bayar']);?>" target="_blank">
					<img src="administrator/img/nota/<?php echo htmlentities($result2['bukti_bayar']);?>" width="250" height="150" 
					 style="border:solid 1px #000; margin-bottom: 15px;">
				</a>
			</div>
			<div class="col-md-8">	
				<div class="alert alert-success">
					<p class="mb-0">Pesanan sedang dikirim menuju alamat anda, estimasi sampai paling lambat tanggal
					<strong><?php echo $dikirim;?></strong></p>
				</div>
			</div>
			<?php }else{ ?>
			
			<?php if ($result2['status']=="Selesai") { ?>
			<?php
				$unique_id = $_SESSION['ulogin'];
				$sqlusers = "SELECT * FROM users WHERE unique_id='$unique_id'";
				$queryusers = mysqli_query($koneksidb,$sqlusers);
				$users = mysqli_fetch_array($queryusers)
			?>
			<div class="col-md-4">
				<a href="administrator/img/nota/<?php echo htmlentities($result2['bukti_bayar']);?>" target="_blank">
					<img src="administrator/img/nota/<?php echo htmlentities($result2['bukti_bayar']);?>" width="250" height="150" 
					 style="border:solid 1px #000; margin-bottom: 15px;">
				</a>
			</div>
			<div class="col-md-8">	
				<div class="alert alert-success">
					<p class="mb-0">Pesanan sudah sampai tujuan</p>
					<p class="mb-0">Penerima : <strong><?php echo $users['nama_lengkap'];?></strong></p>
				</div>
			</div>
			<?php }}}}}?>
		</div>
	</form>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
</div>
