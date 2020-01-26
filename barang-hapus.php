<?php
include_once "includes/config.php";
$database = new Config();
$db = $database->getConnection();

include_once 'includes/barang.inc.php';
$pro = new barang($db);
$id = isset($_GET['id']) ? base64_decode($_GET['id']) : die('ERROR: missing ID.');
$pro->ki = $id;
	
if($pro->delete()){
	echo "<script>location.href='barang.php';</script>";
} else{
	echo "<script>alert('Gagal Hapus Data');location.href='barang.php';</script>";
		
}
?>
