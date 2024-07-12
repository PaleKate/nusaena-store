<?php
    session_start();
    if(isset($_SESSION['alogin'])){
        include_once "config.php";
        $logout_id = mysqli_real_escape_string($koneksidb, $_GET['logout_id']);
        if(isset($logout_id)){
            $status = "Offline now";
            $sql = mysqli_query($koneksidb, "UPDATE admin SET status = '{$status}' WHERE unique_id={$_GET['logout_id']}");
            if($sql){
                session_unset();
                session_destroy();
                header("location: ../login.php");
            }
		}
	}
?>