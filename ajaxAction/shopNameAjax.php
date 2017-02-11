<?php
	require('../database.php');
	$depoZoneId=trim($_POST['zoneValue']);
	$selectShop=$db->prepare("SELECT * FROM shop_reg WHERE depo_id=?");
	$selectShop->bindValue(1,$depoZoneId);
	$selectShop->execute();
	$shopRow=$selectShop->fetchAll(PDO::FETCH_OBJ);
	echo json_encode($shopRow);
?>