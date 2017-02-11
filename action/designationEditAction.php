<?php
 require('../database.php');
 session_start();
 require('../necessaryClass/user.php');

 if($obj->userType()){
	$cat=trim(htmlspecialchars($_POST['designationEdit']));
	$catId=(int)$_POST['desigId'];
	if(!empty($cat)){
		$catEdit=$db->prepare("UPDATE `designation` SET desigName=? WHERE id=?");
		$catEdit->bindParam(1,$cat);
		$catEdit->bindParam(2,$catId);
		if($catEdit->execute()){
			$_SESSION['desigMsg']="<p class='alert alert-success'>Successfully update your data</p>";
			header('Location:../index.php?page=designationEdit&folder=designation&id=$catId');
		}else{
			$_SESSION['desigMsg']="<p class='alert alert-danger'>System Error</p>";
			header('Location:../index.php?page=designationEdit&folder=designation&id=$catId');
		}
	}else{
		$_SESSION['desigMsg']="<p class='alert alert-warning'>Please enter edit name</p>";
		header('Location:../index.php?page=designationEdit&folder=designation&id=$catId');
	}
 }else{
 	exit();
 }