<?php
include("../includes/config.php");
session_start();
if(isset($_SESSION['alogin'])){
$allowed =  array('gif','png','jpg','jpeg');
$filename_upload_gambar = $_FILES['upload_gambar']['name'];
$ext = pathinfo($filename_upload_gambar, PATHINFO_EXTENSION);

if($filename_upload_gambar!=""){
	if(in_array($ext,$allowed) ) {
		move_uploaded_file($_FILES['upload_gambar']['tmp_name'], 'images/'.$_FILES['upload_gambar']['name']);

		$outgoing_id = $_SESSION['alogin'];
        $incoming_id = mysqli_real_escape_string($koneksidb, $_POST['incoming_id']);
		$type = "gambar";
		$status = "0";

		mysqli_query($koneksidb,"INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, status, type)
		values('$incoming_id','$outgoing_id','$filename_upload_gambar','$status','$type')")or die(mysqli_error($koneksidb));

	}
}
}
echo "image was uploaded";
?>