<?php
	session_start();
	require('../database.php');
	include_once('../necessaryClass/user.php');
	$userId=(int)$_POST['userId'];
	$depoId=(int)$_POST['depoId'];
	if(!$obj->userType()){
		$_SESSION['depoUpMsg']="<p class='alert alert-danger'>You are not permited user!</p>";
		header("Location:..index.php?page=depoEdit&folder=registration&id=$depoId");
		exit();
	}
	$depoName=trim(htmlspecialchars($_POST['depoName']));
	$depoZone=trim(htmlspecialchars($_POST['depoZone']));
	$depoAddress=trim(htmlspecialchars($_POST['depoAddress']));
	$depoPhone=trim($_POST['depoPhone']);
	$depoUpdate=$db->prepare('UPDATE depo_regi SET user_id=?,depo_name=?,zone=?,address=?,phone=? WHERE id=?');
	$depoUpdate->bindValue(1,$userId);
	$depoUpdate->bindValue(2,$depoName);
	$depoUpdate->bindValue(3,$depoZone);
	$depoUpdate->bindValue(4,$depoAddress);
	$depoUpdate->bindValue(5,$depoPhone);
	$depoUpdate->bindValue(6,$depoId);
	if($depoUpdate->execute()){
		$_SESSION['depoUpMsg']="<p class='alert alert-success'>Data has been update success</p>";
	}else{
		$_SESSION['depoUpMsg']="<p class='alert alert-danger'>Query failed!</p>";
	}
header("Location:../index.php?page=depoEdit&folder=registration&id=$depoId");
?>