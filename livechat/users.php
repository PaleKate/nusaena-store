<?php
session_start();
error_reporting(0);
include('../includes/config.php');

if(strlen($_SESSION['ulogin'])==0){ 
	header('location:../index.php');
}else{
?>	

<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
		<?php 
			$unique_id=$_SESSION['ulogin'];
			$sql ="SELECT * FROM users WHERE unique_id='$unique_id'";
			$query = mysqli_query($koneksidb,$sql);
			if(mysqli_num_rows($query)>0)
				{
				while($results = mysqli_fetch_array($query)){
		  ?>
          <img src="../assets/img/users/<?php echo htmlentities($results['img']);?>" alt="">
          <div class="details">
            <span><?php echo htmlentities($results['nama_lengkap']);?></span>
            <p><?php echo htmlentities($results['status']);?></p>
          </div>
        </div>
        <a href="../index.php" class="logout">Back</a>
			<?php }}?>
      </header>
      <div class="search">
        <span class="text">Select an user to start chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">
		
	  </div>
    </section>
  </div>

</body>
<script src="javascript/users.js"></script>
</html>
<?php }?>