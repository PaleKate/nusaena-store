<?php
    session_start();
    include('../../includes/config.php');
    $outgoing_id = $_SESSION['ulogin'];
    $sql = "SELECT * FROM admin WHERE NOT unique_id = '$outgoing_id' ORDER BY username ASC";
    $query = mysqli_query($koneksidb, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;
?>