<?php 
session_start();
require('../database.php');
require_once('../necessaryClass/user.php');
if(!$obj->userType()){

	exit();
}
$userUploader=$obj->userType();
$empEditId=(int)$_POST['empId'];//depo edit id
$uploader=$obj->userName();//uploader name
$empName=trim(htmlspecialchars($_POST['empName']));
$fatherName=trim(htmlspecialchars($_POST['fatherName']));
$motherName=trim(htmlspecialchars($_POST['motherName']));
$birthDate=$_POST['DateOfBirth'];
$dateModify=date('d-m-Y',strtotime($birthDate));
$religion=trim(htmlspecialchars($_POST['religion']));
$Empphone=trim($_POST['Empphone']);
$preAdress=trim(htmlspecialchars($_POST['preAdress']));
$perAddress=trim(htmlspecialchars($_POST['perAddress']));
$nid=(int)trim($_POST['nid']);
$Designation=trim(htmlspecialchars($_POST['Designation']));
$salary=trim($_POST['salary']);
$marketAreaId=trim($_POST['marketArea']);


$oldPicName=$_POST['oldPicName'];// Old picture Name
$profilePicture=$_FILES['newPicture'];
$picName=$_FILES['newPicture']['name'];
$tmp_name=$_FILES['newPicture']['tmp_name'];
$fileType=$_FILES['newPicture']['type'];
$explode=explode('.',$picName);
$ext=end($explode);
$sha1pic=sha1($picName).'.'.$ext;
$uploadFolder="../emp_photo/".$sha1pic;
$fileExt=array("jpg","png","jpeg","gif","bmp","JPG","PNG","JPEG","GIF","BMP");

if(empty($picName)){
	if(!empty($empEditId) && !empty($empName) && !empty($fatherName) && !empty($motherName) && !empty($birthDate) && !empty($religion) && !empty($Empphone) && !empty($preAdress) && !empty($perAddress) && !empty($nid) && !empty($Designation) && !empty($salary) && !empty($marketAreaId)){
		$empUpdate=$db->prepare("UPDATE employee_reg SET depo_id=?,emp_name=?,emp_father=?,emp_mother=?,emp_phone=?,emp_birth=?,religion=?,permanent_add=?,present_add=?,emp_desig=?,emp_nid=?,salary=?,picture=?,uploader=? WHERE id=?");
		$empUpdate->bindParam(1,$marketAreaId);
		$empUpdate->bindParam(2,$empName);
		$empUpdate->bindParam(3,$fatherName);
		$empUpdate->bindParam(4,$motherName);
		$empUpdate->bindParam(5,$Empphone);
		$empUpdate->bindParam(6,$dateModify);
		$empUpdate->bindParam(7,$religion);
		$empUpdate->bindParam(8,$perAddress);
		$empUpdate->bindParam(9,$preAdress);
		$empUpdate->bindParam(10,$Designation);
		$empUpdate->bindParam(11,$nid);
		$empUpdate->bindParam(12,$salary);
		$empUpdate->bindParam(13,$oldPicName);
		$empUpdate->bindParam(14,$userUploader);
		$empUpdate->bindParam(15,$empEditId);
		if($empUpdate->execute()){
			$_SESSION['empUpMsg']="<p class='alert alert-success'>Data update query successful</p>";
		}else{
			$_SESSION['empUpMsg']="<p class='alert alert-danger'>System error</p>";
		}
	}else{
		$_SESSION['empUpMsg']="<p class='alert alert-warning'>Please insert your data</p>";
	}
}else{
	if(!empty($empEditId) && !empty($empName) && !empty($fatherName) && !empty($motherName) && !empty($birthDate) && !empty($religion) && !empty($Empphone) && !empty($preAdress) && !empty($perAddress) && !empty($nid) && !empty($Designation) && !empty($salary) && !empty($marketAreaId)){
		if(in_array($ext, $fileExt)){
			$empUpdate=$db->prepare("UPDATE employee_reg SET depo_id=?,emp_name=?,emp_father=?,emp_mother=?,emp_phone=?,emp_birth=?,religion=?,permanent_add=?,present_add=?,emp_desig=?,emp_nid=?,salary=?,picture=?,uploader=? WHERE id=?");
			$empUpdate->bindParam(1,$marketAreaId);
			$empUpdate->bindParam(2,$empName);
			$empUpdate->bindParam(3,$fatherName);
			$empUpdate->bindParam(4,$motherName);
			$empUpdate->bindParam(5,$Empphone);
			$empUpdate->bindParam(6,$dateModify);
			$empUpdate->bindParam(7,$religion);
			$empUpdate->bindParam(8,$perAddress);
			$empUpdate->bindParam(9,$preAdress);
			$empUpdate->bindParam(10,$Designation);
			$empUpdate->bindParam(11,$nid);
			$empUpdate->bindParam(12,$salary);
			$empUpdate->bindParam(13,$sha1pic);
			$empUpdate->bindParam(14,$userUploader);
			$empUpdate->bindParam(15,$empEditId);
			if($empUpdate->execute()){
				move_uploaded_file($tmp_name,$uploadFolder);
				$_SESSION['empUpMsg']="<p class='alert alert-success'>Data update query successful</p>";
			}else{
				$_SESSION['empUpMsg']="<p class='alert alert-danger'>System error</p>";
			}
		}else{
			$_SESSION['empUpMsg']="<p class='alert alert-warning'>we don't allowed this file type</p>";
		}
	}else{
		$_SESSION['empUpMsg']="<p class='alert alert-warning'>Please insert your data</p>";
	}
}
header("Location:../index.php?page=employeeEdit&folder=registration&id=$empEditId");
?>