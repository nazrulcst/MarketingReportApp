<?php
	 require('../database.php');
	 session_start();
	 require('../necessaryClass/user.php');
	 if(!$obj->userType()){
	 	exit();
	 }
	 if(!isset($_POST['shopId'])){
	 	exit();
	 }
 	$shopId=(int)$_POST['shopId'];
	$shopName=trim(htmlspecialchars($_POST['shopName']));
	$onwerName=trim(htmlspecialchars($_POST['onwerName']));
	$phone=trim(htmlspecialchars($_POST['phone']));
	$shopAddress=trim(htmlspecialchars($_POST['shopAddress']));
	$shopZone=trim(htmlspecialchars($_POST['shopZone']));
	
	if(!empty($shopId && $shopName && $onwerName && $phone && $shopAddress && $shopZone)){
		$shopEdit=$db->prepare("UPDATE `shop_reg` SET shop_name=?,shop_owner=?,phone=?,shop_address=?,depo_id=? WHERE id=?");
		$shopEdit->bindParam(1,$shopName);
		$shopEdit->bindParam(2,$onwerName);
		$shopEdit->bindParam(3,$phone);
		$shopEdit->bindParam(4,$shopAddress);
		$shopEdit->bindParam(5,$shopZone);
		$shopEdit->bindParam(6,$shopId);
		if($shopEdit->execute()){
			$_SESSION['shopeditMsg']="<p class='alert alert-success'>Successfully update your data</p>";
		}
		else{
			$_SESSION['shopeditMsg']="<p class='alert alert-danger'>System Error</p>";
		}
  }
 header("Location:../index.php?page=shopEdit&folder=shopInfo&id=$shopId");
 ?>