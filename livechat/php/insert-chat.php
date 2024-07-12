<?php 
    session_start();
    if(isset($_SESSION['ulogin'])){
        include('../../includes/config.php');
        $outgoing_id = $_SESSION['ulogin'];
        $incoming_id = mysqli_real_escape_string($koneksidb, $_POST['incoming_id']);
        $message = mysqli_real_escape_string($koneksidb, $_POST['message']);
		$type = "text";
		$status = "0";
        if(!empty($message)){
            $sql = mysqli_query($koneksidb, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, type, status)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}', '{$type}','{$status}')") or die();
        }
    }else{
        header("location: ../../index.php");
    }


    
?>