<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			 <?php 
					$unique_id=$_SESSION['alogin'];
					$sql ="SELECT * FROM admin WHERE unique_id='$unique_id'";
					$query = mysqli_query($koneksidb,$sql);
						if(mysqli_num_rows($query)>0)
						{
						while($results = mysqli_fetch_array($query)){
		  ?>
			<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
				<a class="btn btn-primary" href="includes/logoutact.php?logout_id=<?php echo $results['unique_id']; ?>">Logout</a>
			</div>
			<?php }} ?>
		</div>
	</div>
</div>