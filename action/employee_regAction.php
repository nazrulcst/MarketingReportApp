<?php
require('../database.php');
session_start();
require_once('../necessaryClass/user.php');
if(!$obj->userType()){
	$_SESSION['empMsg']="<p class='alert alert-danger'>You are not permited user</p>";
	header("Location:../index.php?page=emp_reg&folder=registration");
	exit();
}
$uploader=$obj->userType();//uploader this point
$empName=trim(htmlspecialchars($_POST['empName']));
$fatherName=trim(htmlspecialchars($_POST['fatherName']));
$motherName=trim(htmlspecialchars($_POST['motherName']));
$birthDate=trim($_POST['DateOfBirth']);
$modifyDate=date('d/m/y',strtotime($birthDate));
$religion=trim(htmlspecialchars($_POST['religion']));
$preAdress=trim(htmlspecialchars($_POST['preAdress']));
$perAddress=trim(htmlspecialchars($_POST['perAddress']));
$nid=(int)trim($_POST['nid']);
$salary=(int)trim($_POST['salary']);
$gender=trim($_POST['gender']);
$Designation=trim(htmlspecialchars($_POST['Designation']));
$marketAreaId=(int)trim($_POST['marketArea']);
$phone=(int)trim($_POST['Empphone']);
//profile picture received & upload process
$file=$_FILES['picture'];
$fileName=$_FILES['picture']['name'];
$fileType=$_FILES['picture']['type'];
$fileTempName=$_FILES['picture']['tmp_name'];
$fileSize=$_FILES['picture']['size'];
$explode=explode('.',$fileName);
$ext=end($explode);
$sha1=sha1($fileName);
$uploadFileName=$sha1.'.'.$ext;
$upload_dir='../emp_photo/'.$uploadFileName;

if(!empty($empName) && !empty($fatherName) && !empty($motherName) && !empty($birthDate) && !empty($religion) && !empty($preAdress) && !empty($perAddress) && !empty($gender) && !empty($Designation) && !empty($marketAreaId) && !empty($phone) && !empty($file)){

	if($ext=="jpg" OR $ext=="JPG"  OR $ext=="png" OR $ext=="PNG" OR $ext=="jpeg" OR $ext=="JPEG" OR $ext=="gif" OR $ext=="GIF"){
		$empReg=$db->prepare("INSERT INTO employee_reg SET depo_id=?,emp_name=?,emp_father=?,emp_mother=?,emp_phone=?,emp_birth=?,religion=?,permanent_add=?,present_add=?,emp_desig=?,emp_nid=?,salary=?,gender=?,picture=?,uploader=?");
		$empReg->bindParam(1,$marketAreaId);
		$empReg->bindParam(2,$empName);
		$empReg->bindParam(3,$fatherName);
		$empReg->bindParam(4,$motherName);
		$empReg->bindParam(5,$phone);
		$empReg->bindParam(6,$birthDate);
		$empReg->bindParam(7,$religion);
		$empReg->bindParam(8,$perAddress);
		$empReg->bindParam(9,$preAdress);
		$empReg->bindParam(10,$Designation);
		$empReg->bindParam(11,$nid);
		$empReg->bindParam(12,$salary);
		$empReg->bindParam(13,$gender);
		$empReg->bindParam(14,$uploadFileName);
		$empReg->bindParam(15,$uploader);
		if($empReg->execute()){
			move_uploaded_file($fileTempName, $upload_dir);
			$_SESSION['empMsg']="<p class='alert alert-success'>Successfully data inserted</p>";
			header("Location:../index.php?page=emp_reg&folder=registration");
		}else{
			$db->rollback();
			$_SESSION['empMsg']="<p class='alert alert-warning'>Submited query failed !</p>";
			header("Location:../index.php?page=emp_reg&folder=registration");
		}
	}else{
		$_SESSION['empMsg']="<p class='alert alert-danger'>This file type don't allowed here !</p>";
		header("Location:../index.php?page=emp_reg&folder=registration");
	}
}else{
	$_SESSION['empMsg']="<p class='alert alert-warning'>Please insert your information !!</p>";
	header("Location:../index.php?page=emp_reg&folder=registration");
}













