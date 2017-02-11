<?php
	date_default_timezone_set('Asia/Dhaka');
	session_start();
	require('../database.php');
	include('../necessaryClass/user.php');
	$uploader = $obj->userType();
	$employeeId = $_POST['check'];
	$attenTime = date('Y-m-d');
	$attenStr = strtotime($attenTime);
	$insertExecute='';
	$existIdMsg='';
	if(!empty($employeeId)){
		foreach($employeeId as $index => $empIdVal){
			// select Data & employee id for checking duplicate value
				$empId=$empIdVal;
				$selectAttenId = $db->prepare("SELECT * FROM attendence WHERE emp_id=? AND atten_time=?");
				$selectAttenId->bindValue(1,$empIdVal);
				$selectAttenId->bindValue(2,$attenTime);
				$selectAttenId->execute();
				$selectAttendRow = $selectAttenId->fetch(PDO::FETCH_ASSOC);
				$existId = $selectAttendRow['emp_id'];
				$exitstDate = $selectAttendRow['atten_time'];
				$exitsDateStr = strtotime($exitstDate);
				if($attenStr==$exitsDateStr AND $empId==$existId){// checking the date & id
					$existIdMsg="<p class='alert alert-info'>Already have a attendence !</p>";;
				}else{
					$attenDence = $db->prepare("INSERT INTO attendence SET emp_id=?,atten_time=?,uploader=?");
					$attenDence->bindValue(1,$empIdVal);
					$attenDence->bindValue(2,$attenTime);
					$attenDence->bindValue(3,$uploader);
					$insertExecute = $attenDence->execute();
				}
		}
		if($insertExecute){# message point
			$_SESSION['attMsg']="<p class='alert alert-success'>Successfully Saved</p>";
		}elseif($existIdMsg){
			$_SESSION['attMsg']=$existIdMsg;
		}else{
			$_SESSION['attMsg']="<p class='alert alert-danger'>Your query failed!</p>";
		}
	}else{
		$_SESSION['attMsg']="<p class='alert alert-warning'>Please select a person!</p>";
	}
	header("Location:../index.php?page=today_attendence&folder=attendance");
?>