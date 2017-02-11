<?php
	require('../database.php');
	$proNameId=$_POST['productNameId'];
	$selectProPrice=$db->prepare("SELECT pro_price FROM products WHERE id=?");
	$selectProPrice->bindValue(1,$proNameId);
	$selectProPrice->execute();
	$row=$selectProPrice->fetch(PDO::FETCH_OBJ);
	$lolPrice=$row->pro_price;
	echo json_encode($lolPrice);
?>