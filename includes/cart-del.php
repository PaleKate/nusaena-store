<?php 
if(!isset($_SESSION))
{
session_start();
}
$id_produk=$_GET["pid"];
unset($_SESSION["cart"][$id_produk]);

echo"<script>location='/nusaena/product.php';</script>";
?>