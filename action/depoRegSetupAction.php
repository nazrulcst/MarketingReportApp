<?php
require('../database.php');
session_start();
require_once('../necessaryClass/user.php');
if(!$obj->userType()){
	$_SESSION['depoMsg']="<p class='alert alert-danger'>You are not permited user</p>";
	header("Location:../index.php?page=depo_reg&folder=registration");
	exit();
}
$uploader=$obj->userType();//uploader this point
$userId=$obj->userLoginId();//uploader id

$depoName=trim(htmlspecialchars($_POST['depoName']));
$depoZone=trim(htmlspecialchars($_POST['depoZone']));
$depoAddress=trim(htmlspecialchars($_POST['depoAddress']));
$depoPhone=(int)trim($_POST['depoPhone']);
$userId=(int)trim($_POST['userId']);
$addressLenth=strlen($depoAddress);
if(!empty($depoName) && !empty($depoZone) && !empty($depoAddress) && !empty($depoPhone) && !empty($userId)){
	if($addressLenth<=200){
		$depoInsert=$db->prepare("INSERT INTO depo_regi SET user_id=?,depo_name=?,zone=?,address=?,phone=?,uploader=?");
		$depoInsert->bindParam(1,$userId);
		$depoInsert->bindParam(2,$depoName);
		$depoInsert->bindParam(3,$depoZone);
		$depoInsert->bindParam(4,$depoAddress);
		$depoInsert->bindParam(5,$depoPhone);
		$depoInsert->bindParam(6,$uploader);
		if($depoInsert->execute()){
			$_SESSION['depoMsg']="<p class='alert alert-success'>Successfully saved your data</p>";
		}else{
			$_SESSION['depoMsg']="<p class='alert alert-danger'>Your query has been failed!</p>";
		}
	}else{
		$_SESSION['depoMsg']="<p class='alert alert-warning'>Don't allowed more than 200 characters in address field!</p>";
	}
}else{
	$_SESSION['depoMsg']="<p class='alert alert-info'>Please fillup all input fields!</p>";
}
header("Location:../index.php?page=depo_reg&folder=registration");
?>