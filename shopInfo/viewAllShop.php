<?php
	require('database.php');
  if(!$obj->userLoginId()){
    exit();
  }
  $userId=$obj->userLoginId();// Current loging user id
  // Select depo id
  $selectDepo=$db->prepare('SELECT * FROM depo_regi WHERE user_id=?');
  $selectDepo->bindValue(1,$userId);
  $selectDepo->execute();
  $depoRow=$selectDepo->fetch(PDO::FETCH_ASSOC);
  $depoID=$depoRow['id'];// depo id
	$shopRecord=$db->prepare("SELECT * FROM shop_reg WHERE depo_id=?");
  $shopRecord->bindValue(1,$depoID);
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
	$selectShop=$db->prepare("SELECT shop_reg.*,depo_regi.zone AS depoZone FROM shop_reg LEFT JOIN depo_regi ON shop_reg.depo_id=depo_regi.id ORDER BY id DESC LIMIT $startPage,$per_page_row");
	$selectShop->execute();
	$totalShop=$selectShop->rowCount();
	$inc='';
	$shopData='';
	while($shopRow=$selectShop->fetch(PDO::FETCH_OBJ)){
		$inc++;
		$shopData.="
			<tr>
				<td>$inc</td>
				<td>$shopRow->depoZone</td>
				<td>$shopRow->shop_name</td>
				<td>$shopRow->shop_owner</td>
				<td>$shopRow->phone</td>
        <td>$shopRow->shop_address</td>
				<td>
        <a href='index.php?page=shopEdit&folder=shopInfo&id=$shopRow->id' class='btn btn-primary btn-sm glyphicon glyphicon-edit'></a>
        <a href='index.php?page=viewAllShop&folder=shopInfo&id=$shopRow->id' class='btn btn-danger btn-sm glyphicon glyphicon-trash'></a>
        </td>
			</tr>
		";
	}
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      <h3 class="text-green text-center text-bold">View all shop</h3>
      <hr>
       <?php
        if(isset($_SESSION['shopDelMsg'])){
          echo $_SESSION['shopDelMsg'];
          unset($_SESSION['shopDelMsg']);
        }
        if(isset($_GET['id'])){
          $delId=$_GET['id'];
          echo"Are you sure Delete this shop ?&nbsp;<a href='action/shopDeleteAction.php?&deleteId=$delId' class='btn btn-danger btn-sm'>Yes</a>&nbsp;
            <a href='index.php?page=viewAllShop&folder=shopInfo' class='btn btn-info btn-sm'>Cancel</a>
          ";
        }
        if(isset($_SESSION['delShopMsg'])){
          echo $_SESSION['delShopMsg'];
          unset($_SESSION['delShopMsg']);
        }
      ?>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2" style="margin-top:10px">
      <table class="table table-hover table-bordered table-striped table-consendend">
        <thead class="text-green">
          <th>Sl No</th>
          <th>Depo Zone</th>
          <th>Shop Name</th>
          <th>Owner</th>
          <th>Phone</th>
          <th>Address</th>
          <th>Action</th>
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
          echo"<a href='index.php?page=viewAllShop&folder=shopInfo&pgNumber={$prevPage}' class='btn btn-primary btn-sm disabled'><span class='glyphicon glyphicon-chevron-left'></span>Prev</a>&nbsp;&nbsp;";
        }else{
          echo"<a href='index.php?page=viewAllShop&folder=shopInfo&pgNumber={$prevPage}' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-chevron-left'></span>Prev</a>&nbsp;&nbsp;";
        }
        if($pageNumber>$totalPage){
          echo"Page not found"; 
        }else{
          for($i=1;$i<=$totalPage;$i++){
            if($i == $pageNumber){
              echo"<a href='index.php?page=viewAllShop&folder=shopInfo&pgNumber={$i}' class='btn btn-primary btn-sm'>$i</a>&nbsp;";
            }else{
              echo"<a href='index.php?page=viewAllShop&folder=shopInfo&pgNumber={$i}' class='btn btn-default btn-sm'>$i</a>&nbsp;";
            }
          }
        }
      if($totalPage==$pageNumber){
        echo"&nbsp;&nbsp;<a href='index.php?page=viewAllShop&folder=shopInfo&pgNumber={$nextPage}' class='btn btn-primary btn-sm disabled'>Next<span class='glyphicon glyphicon-chevron-right'></span></a>";
      }else{
        echo"&nbsp;&nbsp;<a href='index.php?page=viewAllShop&folder=shopInfo&pgNumber={$nextPage}' class='btn btn-primary btn-sm'>Next<span class='glyphicon glyphicon-chevron-right'></span></a>";
      } 
      ?>
    </div>
  </div>
</div>
<script>
  $(document).ready(function(){
      $('#confirmID').click(function(){
          alert('ok');
      });
  });
</script>