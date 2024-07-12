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
    <section class="chat-area">
      <header>
        <?php 
          $admin_id = mysqli_real_escape_string($koneksidb, $_GET['admin_id']);
          $sql = mysqli_query($koneksidb, "SELECT * FROM admin WHERE unique_id = '$admin_id'");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }else{
            header("location: users.php");
          }
        ?>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="../administrator/img/admin/<?php echo $row['img']; ?>" alt="">
        <div class="details">
          <span><?php echo $row['username'] ?></span>
          <p><?php echo $row['status']; ?></p>
        </div>
      </header>
      <div class="chat-box">

      </div>
	  <form action="" class="typing-area" method="POST" enctype="multipart/form-data">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $admin_id; ?>" hidden>
        <label for="upload_gambar"><img src="../assets/img/images.png" style="opacity: 0.8; width: 30px; margin: 5px; cursor: pointer;"></label>
		<input class="upload_gambar" id="upload_gambar" type="file" name="upload_gambar" style="display:none;" onchange="send_image(this.files)" accept="image/*"/>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>
  <script>
	function send_image(files){
			var fd = new FormData();
			let xml = new XMLHttpRequest();
			
			xml.onload = function(){
				if(xml.readyState == 4 || xml.status == 200){
					alert(xml.responseText);
				}
			}
			fd.append('file',files[0]);
			fd.append('data_type',"send_image");
			
			xml.open("POST","ajax_upload_gambar.php",true);
			let formData = new FormData(form);
			xml.send(formData);

		}
</script>
  <script src="javascript/chat.js"></script>

</body>
</html>
<?php }?>