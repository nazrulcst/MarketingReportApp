<?php
	require('../database.php');
	session_start();
	$shopZoneId=(int)trim($_POST['shopZone']);
	$shopName=trim(htmlspecialchars($_POST['shopName']));
	$onwerName=trim(htmlspecialchars($_POST['onwerName']));
	$phone=(int)trim($_POST['phone']);
	$shopAddress=trim(htmlspecialchars($_POST['shopAddress']));
	$shopAddLength=strlen($shopAddress);
	if(!empty($shopName) && !empty($shopZoneId) && !empty($shopAddress) && !empty($onwerName) && !empty($phone)){
		if($shopAddLength<=200){//cheking the address field length
			$shopInsert=$db->prepare("INSERT INTO shop_reg SET depo_id=?,shop_name=?,shop_owner=?,phone=?,shop_address=?");
			$shopInsert->bindParam(1,$shopZoneId);
			$shopInsert->bindParam(2,$shopName);
			$shopInsert->bindParam(3,$onwerName);
			$shopInsert->bindParam(4,$phone);
			$shopInsert->bindParam(5,$shopAddress);
			if($shopInsert->execute()){
				$_SESSION['shopMsg']="<p class='alert alert-success'>Successfully registered</p>";
			}else{
				$_SESSION['shopMsg']="<p class='alert alert-danger'>Registered failed!</p>";
			}
		}else{
			$_SESSION['shopMsg']="<p class='alert alert-info'>Please enter less than 200 characters into address field!</p>";
		}
	}else{
		$_SESSION['shopMsg']="<p class='alert alert-warning'>Please fillup all input fields!</p>";
	}
header("Location:../index.php?page=shop_reg&folder=shopInfo");
?>