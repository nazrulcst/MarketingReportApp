<?php
	require('../database.php');
	session_start();
	if(!isset($_GET['deleteId'])){
		exit();
	}
	$delId=$_GET['deleteId'];
	$shopDelete=$db->prepare('DELETE FROM shop_reg WHERE id=?');
	$shopDelete->bindValue(1,$delId);
	if($shopDelete->execute()){
		$_SESSION['delShopMsg']="<p class='alert alert-success'>Delete Success</p>";
	}else{
		$_SESSION['delShopMsg']="<p class='alert alert-danger'>Delete Failed!</p>";
	}
header('Location:../index.php?page=viewAllShop&folder=shopInfo');
?>