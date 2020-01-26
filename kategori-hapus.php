<?php
include_once "includes/config.php";
$database = new Config();
$db = $database->getConnection();

include_once 'includes/kategori.inc.php';
$pro = new kategori($db);
$id = isset($_GET['id']) ? base64_decode($_GET['id']) : die('ERROR: missing ID.');
$pro->kk = addslashes($id);
	
if($pro->delete()){
	echo "<script>location.href='kategori.php';</script>";
} else{
	echo "<script>alert('Gagal Hapus Data');location.href='kategori.php';</script>";
		
}
?>
