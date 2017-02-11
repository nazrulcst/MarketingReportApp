<?php
	require('../database.php');
	$desigVal=filter_var($_POST['desigVal'],FILTER_SANITIZE_STRING);
	$selectEmp=$db->prepare('SELECT * FROM employee_reg WHERE emp_desig=? ORDER BY id');
	$selectEmp->bindValue(1,$desigVal);
	$selectEmp->execute();
	$empNameRow=$selectEmp->fetchAll(PDO::FETCH_OBJ);
	echo json_encode($empNameRow);
?>