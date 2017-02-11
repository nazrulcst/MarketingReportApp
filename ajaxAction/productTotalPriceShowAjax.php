<?php
	require('../database.php');
	$proIdVal = trim($_POST['proIdVal']);
	$quantityVal = trim($_POST['quantityVal']);
	$selectProPrice = $db->prepare('SELECT pro_price FROM products WHERE id=?');
	$selectProPrice->bindValue(1,$proIdVal);
	$selectProPrice->execute();
	$priceRow = $selectProPrice->fetch(PDO::FETCH_OBJ);
	$proPrice = $priceRow->pro_price;
	$total = $proPrice*$quantityVal;
	echo json_encode($total);
?>