<?php
    session_start();
    include('../../includes/config.php');

    $outgoing_id = $_SESSION['alogin'];
    $searchTerm = mysqli_real_escape_string($koneksidb, $_POST['searchTerm']);

    $sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} AND (nama_user LIKE '%{$searchTerm}%') ";
    $output = "";
    $query = mysqli_query($koneksidb, $sql);
    if(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }else{
        $output .= 'No user found related to your search term';
    }
    echo $output;
?>