<?php 
session_start();
error_reporting(0);
include('nusaena/add.php');
include('config.php');

//echo "<pre>";
//print_r ($_SESSION)['cart'];
//echo "</pre>";
?>
<div class="modal fade" id="cartForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-content" data-aos="fade-up">
      <div class="modal-header" data-aos="fade-up" data-aos-delay="100">
        <h3 class="modal-title" id="exampleModalLabel">List Pesanan Anda</h3>
		<button type="button" class="btn btn-secondary btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" data-aos="fade-up" data-aos-delay="100">
        <form method="post" action="checkout.php">
            <div class="row gy-4">
				<div class="table-responsive">
					<table id="table" class="display table table-striped table-bordered table-hover" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th class="text-center">No</th>
								<th class="text-center">Image</th>
								<th class="text-center">Nama Produk</th>
								<th class="text-center">Bahan</th>
								<th class="text-center">Harga Produk</th>
								<th class="text-center">Option</th>
							</tr>
						</thead>
						<tbody>
							<?php $nomor=1; ?>
							<?php foreach ($_SESSION['cart'] as $id_produk => $jumlah): ?>
							<?php 
							$ambil = $koneksidb->query("SELECT * FROM produk 
														JOIN bahan ON produk.id_bahan=bahan.id_bahan 
													    JOIN kategori ON produk.id_kategori=kategori.id_kategori
													    WHERE id_produk='$id_produk'");
							$result = $ambil->fetch_assoc();
							?>
							<tr>
								<td align="center"><input type="checkbox" name="id[]" value="<?php echo $id_produk;?>"> 
													<?php echo $nomor; ?></td>
								<td align="center"><a href="product-details.php?pid=<?php echo $id_produk;?>"><img src="administrator/img/kaos/<?php echo htmlentities($result['image1']);?>" alt="" width="100" height="80"></td>
								<td><?php echo $result['nama_produk']; ?></td>
								<td><?php echo $result['bahan']; ?></td>
								<td><?php echo format_rupiah($result['harga']);?></td>
								<td align="center"><a href="#" class="btn btn-danger btn-circle btn-sm" 
										onclick="(Swal.fire({
											icon: 'warning',
											title: 'Sure',
											text: 'Apakah Kamu Yakin Akan Menghapus <?php echo htmlentities($result['nama_produk']);?> Ini ?',
											showCancelButton: true,
											confirmButtonText: 'Yes Delete It',
												}).then((result) => {
												if (result.isConfirmed) {
												window.location = 'includes/cart-del.php?pid=<?php echo $id_produk;?>';
												}
											}))">
											Hapus</a></td>					   
							</tr>
							<?php $nomor++; ?>
							<?php endforeach ?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="5"></td>
								<td colspan="6" align="center"><button type="submit" class="btn btn-primary btn-block" name="checkout">Checkout</button></td>
							</tr>
						</tfoot>
					</table>
					<!-- Large modal -->
					<div class="modal bs-example-modal animated--fade-in" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-lg">
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
        </form>
      </div>
    </div>
</div>