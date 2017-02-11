<?php
	session_start();
	require('../database.php');
	$marketAreaId=$_POST['marketArea'];// It's variable stored depo id
	$salePersonId=$_POST['salePerson'];// It's variable stored employee id
	$shopNameId=$_POST['shopName'];// It's variable stored shop id
	$proNameId=$_POST['proName'];// It's variable stored product id
	$proQuantity=$_POST['proQuantity'];// It's variable stored product quantity
	$saleDate=$_POST['saleDate'];
	$modifyDate=date('Y-m-d');// insered date
	$curDateStr=strtotime($modifyDate);// current date converted
	if(!empty($marketAreaId) && !empty($salePersonId) && !empty($shopNameId) && !empty($proNameId) && !empty($proQuantity) && !empty($saleDate)){
		//$db->beginTransaction();// begin Transaction
		// select product price
		$selPrice=$db->prepare("SELECT pro_price FROM products WHERE id=?");
		$selPrice->bindValue(1,$proNameId);
		$selPrice->execute();
		$priceRow=$selPrice->fetch(PDO::FETCH_ASSOC);
		$proPrice=$priceRow['pro_price'];
		$totalPrice=$proPrice*$proQuantity;// product total price
		// depo all data select for checking duplicate data
		$daily_sales=$db->prepare('SELECT * FROM daily_sales WHERE depo_id=? AND emp_id=? AND shop_id=? AND pro_id=? AND sale_date=?');
		$daily_sales->bindValue(1,$marketAreaId);
		$daily_sales->bindValue(2,$salePersonId);
		$daily_sales->bindValue(3,$shopNameId);
		$daily_sales->bindValue(4,$proNameId);
		$daily_sales->bindValue(5,$modifyDate);
		$daily_sales->execute();
		$daily_sales_row=$daily_sales->fetch(PDO::FETCH_ASSOC);
		$exitDepoId=$daily_sales_row['depo_id'];// Existing depo id
		$exitEmpId=$daily_sales_row['emp_id'];// Existing emp id
		$exitShopId=$daily_sales_row['shop_id'];// Existing shop id
		$exitProId=$daily_sales_row['pro_id'];// Existing product id
		$exitDate=$daily_sales_row['sale_date'];// Existing date
		$updateQuantity=$daily_sales_row['pro_quantity']+$proQuantity;// Update quantity
		$updateTotalPrice=$daily_sales_row['total_price']+$totalPrice;// Update total price
		$exiStrDate=strtotime($exitDate);// existing date converted strtotime
		if($marketAreaId==$exitDepoId && $salePersonId==$exitEmpId && $shopNameId==$exitShopId && $proNameId==$exitProId && $curDateStr==$exiStrDate){
			// Today sales update query
			$todaySalesUpdate=$db->prepare("UPDATE daily_sales SET pro_quantity=?,total_price=? WHERE depo_id=? AND emp_id=? AND shop_id=? AND pro_id=? AND sale_date=?");
			$todaySalesUpdate->bindValue(1,$updateQuantity);
			$todaySalesUpdate->bindValue(2,$updateTotalPrice);
			$todaySalesUpdate->bindValue(3,$marketAreaId);
			$todaySalesUpdate->bindValue(4,$salePersonId);
			$todaySalesUpdate->bindValue(5,$shopNameId);
			$todaySalesUpdate->bindValue(6,$proNameId);
			$todaySalesUpdate->bindValue(7,$modifyDate);
			$todaySalesUpdateExe=$todaySalesUpdate->execute();
		}else{
			// Today sales insert query
			$todaySalesInsert=$db->prepare("INSERT INTO daily_sales SET depo_id=?,emp_id=?,shop_id=?,pro_id=?,pro_quantity=?,total_price=?,sale_date=?");
			$todaySalesInsert->bindValue(1,$marketAreaId);
			$todaySalesInsert->bindValue(2,$salePersonId);
			$todaySalesInsert->bindValue(3,$shopNameId);
			$todaySalesInsert->bindValue(4,$proNameId);
			$todaySalesInsert->bindValue(5,$proQuantity);
			$todaySalesInsert->bindValue(6,$totalPrice);
			$todaySalesInsert->bindValue(7,$modifyDate);
			$todaySalesInsertExe=$todaySalesInsert->execute();
		}
		// Total sales insert  & select daily_sales data
		$selectTodaySales=$db->prepare('SELECT * FROM daily_sales WHERE depo_id=? AND sale_date=?');
		$selectTodaySales->bindValue(1,$marketAreaId);
		$selectTodaySales->bindValue(2,$modifyDate);
		$selectTodaySales->execute();
		$inc='';
		$TodayTotalPrice='';// total taka just one depo sales
		while($selectTodaySalesRow=$selectTodaySales->fetch(PDO::FETCH_OBJ)){
			$inc++;
			$TodayTotalPrice+=$selectTodaySalesRow->total_price;
		}
		
		// checking duplicate total sales values
		$selectTotal=$db->prepare('SELECT * FROM total_sales WHERE deopo_id=? AND sales_date=?');
		$selectTotal->bindValue(1,$marketAreaId);
		$selectTotal->bindValue(2,$modifyDate);
		$selectTotal->execute();
		$selectTotalRow=$selectTotal->fetch(PDO::FETCH_OBJ);
		$exitDepo=$selectTotalRow->deopo_id;// total sales existing depo id
		$exitTaka=$selectTotalRow->today_sales_taka;// total sales existing total taka
		$exitDate=$selectTotalRow->sales_date;// total sales existing date
		$strTotalDate=strtotime($exitDate);// convertred to strtotime
		$updateTotalTaka=$exitTaka+$totalPrice;// its variable stored update total taka
		if($marketAreaId==$exitDepo && $curDateStr==$strTotalDate){
			// update total sales query
			$totalUpdate=$db->prepare('UPDATE total_sales SET today_sales_taka=? WHERE deopo_id=? AND sales_date=?');
			$totalUpdate->bindValue(1,$updateTotalTaka);
			$totalUpdate->bindValue(2,$marketAreaId);
			$totalUpdate->bindValue(3,$modifyDate);
			$totalSalesUpdExe=$totalUpdate->execute();
		}else{
			// Total Sales data insert query
			$totalSalesInsert=$db->prepare('INSERT INTO total_sales SET deopo_id=?,today_sales_taka=?,sales_date=?');
			$totalSalesInsert->bindValue(1,$marketAreaId);
			$totalSalesInsert->bindValue(2,$TodayTotalPrice);
			$totalSalesInsert->bindValue(3,$modifyDate);
			$totalSalesInsExe=$totalSalesInsert->execute();
		}
		// check out the messages
		if($todaySalesUpdateExe OR $totalSalesUpdExe OR $totalSalesInsExe){
			$_SESSION['slsMsg']="<p class='alert alert-success'>Your data successfully saved</p>";
		}elseif($todaySalesInsertExe OR $totalSalesUpdExe OR $totalSalesInsExe){
			$_SESSION['slsMsg']="<p class='alert alert-success'>Your data successfully saved</p>";
		}else{
			$_SESSION['slsMsg']="<p class='alert alert-danger'>Your query failed!</p>";
		}
	}else{
		$_SESSION['slsMsg']="<p class='alert alert-warning'>Please insert all input fields!</p>";
	}
header('Location:../index.php?page=today_sales&folder=sales');
?>