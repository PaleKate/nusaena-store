<?php
    session_start();
    if(isset($_SESSION['ulogin'])){
        include_once "config.php";
        $logout_id = mysqli_real_escape_string($koneksidb, $_GET['logout_id']);
        if(isset($logout_id)){
            $status = "Offline now";
            $sql = mysqli_query($koneksidb, "UPDATE users SET status = '{$status}' WHERE unique_id={$_GET['logout_id']}");
            if($sql){
                session_unset();
                session_destroy();
                header("location: ../index.php");
            }
		}
	}
?>