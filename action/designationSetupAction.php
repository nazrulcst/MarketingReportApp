<?php
session_start();
require('../database.php');
require_once('../necessaryClass/user.php');
$designation=trim(htmlspecialchars($_POST['designation']));
$checkdesignation=$db->prepare("SELECT `desigName` FROM `designation` where desigName=?");
$checkdesignation->bindParam(1,$designation);
$checkdesignation->execute();
$checkDesigRow=$checkdesignation->fetch(PDO::FETCH_OBJ);
if($obj->userType()){
	if(!empty($designation)){
		if($designation===$checkDesigRow->desigName){//this line use for checking duplicate value insert
			$_SESSION['desigMsg']="<p class='alert alert-warning'>Don't allowed duplicat designation name</p>";
			header('Location:../index.php?page=createDesignation&folder=setup');
		}else{
			$catInsert=$db->prepare("INSERT INTO `designation` SET `desigName`=?");
			$catInsert->bindParam(1,$designation);
				if($catInsert->execute()){
				$_SESSION['desigMsg']="<p class='alert alert-success'>Your data has been successfully inserted";
				header('Location:../index.php?page=createDesignation&folder=setup');
				}
			}
	}else{
		$_SESSION['desigMsg']="<p class='alert alert-warning'>Please insert your designation name</p>";
		header('Location:../index.php?page=createDesignation&folder=setup');
		}
}else{
	$_SESSION['desigMsg']="<p class='alert alert-danger'>Your are not permited to access this system</p>";
	header('Location:../index.php?page=createDesignation&folder=setup');
}
header('Location:../index.php?page=createDesignation&folder=setup');
