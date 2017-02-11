<?php
	require('database.php');
	$shopRecord=$db->prepare("SELECT * FROM daily_sales");
	$shopRecord->execute();
	$rowCount=$shopRecord->rowCount();
	$per_page_row=10;
	$totalPage=ceil($rowCount/$per_page_row);
	$pageNumber=(isset($_GET['pgNumber'])?(int)$_GET['pgNumber']:(int)$_GET['pgNumber']=1);
	$startPage=(int)($pageNumber-1)*$per_page_row;
	if($pageNumber<1){
	    $startPage=(int)(-$pageNumber+1)*$per_page_row;
	    $_SESSION['erMsg']="You are enter wrong values !";
	}
	$selectShop=$db->prepare("SELECT DISTINCT shop_reg.id, depo_regi.depo_name AS depoName,shop_reg.shop_name AS shopName,shop_reg.shop_owner AS ownerName,shop_reg.phone AS shopPhone,shop_reg.shop_address AS shopAdd FROM daily_sales LEFT JOIN depo_regi ON daily_sales.depo_id=depo_regi.id LEFT JOIN shop_reg ON daily_sales.shop_id=shop_reg.id ORDER BY id DESC LIMIT $startPage,$per_page_row");
	$selectShop->execute();
	$totalShop=$selectShop->rowCount();
	$inc='';
	$shopData='';
	while($shopRow=$selectShop->fetch(PDO::FETCH_OBJ)){
		$inc++;
		$shopData.="
			<tr>
				<td>$inc</td>
				<td>$shopRow->depoName</td>
				<td>$shopRow->shopName</td>
				<td>$shopRow->ownerName</td>
				<td>$shopRow->shopPhone</td>
				<td>$shopRow->shopAdd</td>
			</tr>
		";
	}
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      <h3 class="text-green text-center text-bold">Client Shop View</h3>
      <hr>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2" style="margin-top:10px">
      <table class="table table-hover table-bordered table-striped table-consendend">
        <thead class="text-green">
          <th>Sl No</th>
          <th>Depo Name</th>
          <th>Shop Name</th>
          <th>Owner</th>
          <th>Phone</th>
          <th>Address</th>
        </thead>
        <tbody>
          <?php echo $shopData;?>
          <tr class="info">
          	<td></td>
          	<td>Total Shop</td>
          	<td colspan="5"><?php echo $totalShop;?></td>
          </tr>
        </tbody>
      </table><hr>
    </div>
    <div class="col-sm-10 col-sm-offset-1 text-center" style="margin-top:10px">
      <?php
        $prevPage=$pageNumber-1;
        $nextPage=$pageNumber+1;
        if($pageNumber<=1){
          echo"<a href='index.php?page=viewAllClientShop&folder=report&pgNumber={$prevPage}' class='btn btn-primary btn-sm disabled'><span class='glyphicon glyphicon-chevron-left'></span>Prev</a>&nbsp;&nbsp;";
        }else{
          echo"<a href='index.php?page=viewAllClientShop&folder=report&pgNumber={$prevPage}' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-chevron-left'></span>Prev</a>&nbsp;&nbsp;";
        }
        if($pageNumber>$totalPage){
          echo"Page not found"; 
        }else{
          for($i=1;$i<=$totalPage;$i++){
            if($i == $pageNumber){
              echo"<a href='index.php?page=viewAllClientShop&folder=report&pgNumber={$i}' class='btn btn-primary btn-sm'>$i</a>&nbsp;";
            }else{
              echo"<a href='index.php?page=viewAllClientShop&folder=report&pgNumber={$i}' class='btn btn-default btn-sm'>$i</a>&nbsp;";
            }
          }
        }
      if($totalPage==$pageNumber){
        echo"&nbsp;&nbsp;<a href='index.php?page=viewAllClientShop&folder=report&pgNumber={$nextPage}' class='btn btn-primary btn-sm disabled'>Next<span class='glyphicon glyphicon-chevron-right'></span></a>";
      }else{
        echo"&nbsp;&nbsp;<a href='index.php?page=viewAllClientShop&folder=report&pgNumber={$nextPage}' class='btn btn-primary btn-sm'>Next<span class='glyphicon glyphicon-chevron-right'></span></a>";
      } 
      ?>
    </div>
  </div>
</div>