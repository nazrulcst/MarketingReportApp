<?php
	session_start();
	require('../database.php');
	include_once('../necessaryClass/user.php');
	$proEditId=$_POST['ProeditId'];
	if(!$obj->userType()){
		$_SESSION['proEditMsg']="<p class='alert alert-danger'>You are not permited !</p>";
		header("Location:../index.php?page=productEdit&folder=products&proEditId={$proEditId}");
		exit();
	}
	$uploader=$obj->userType();
	$proName=trim(htmlspecialchars($_POST['proName']));
	$proPrice=$_POST['proPrice'];
	$proQuantity=$_POST['proQuantity'];
	$totalPrice=$proPrice*$proQuantity;
	$catNameId=trim(htmlspecialchars($_POST['catName']));
	if(!empty($proName) && !empty($proPrice) && !empty($proQuantity) && !empty($catNameId)){
		$proUpdate=$db->prepare("UPDATE products SET cat_id=?,pro_name=?,pro_price=?,quantity=?,total_price=?,uploader=? WHERE id=?");
		$proUpdate->bindParam(1,$catNameId);
		$proUpdate->bindParam(2,$proName);
		$proUpdate->bindParam(3,$proPrice);
		$proUpdate->bindParam(4,$proQuantity);
		$proUpdate->bindParam(5,$totalPrice);
		$proUpdate->bindParam(6,$uploader);
		$proUpdate->bindParam(7,$proEditId);
		if($proUpdate->execute()){
			$_SESSION['proEditMsg']="<p class='alert alert-success'>Successfully your data update</p>";
			header("Location:../index.php?page=productEdit&folder=products&proEditId={$proEditId}");
		}else{
			$_SESSION['proEditMsg']="<p class='alert alert-danger'>System wrong !</p>";
			header("Location:../index.php?page=productEdit&folder=products&proEditId={$proEditId}");
		}
	}else{
		$_SESSION['proEditMsg']="<p class='alert alert-warning'>Please insert input field !</p>";
		header("Location:../index.php?page=productEdit&folder=products&proEditId={$proEditId}");
	}
?>