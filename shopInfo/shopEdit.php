<?php
	require('database.php');
	if(!isset($_GET['id'])){
		exit();
	}
	$shopId=$_GET['id'];
	$editShop=$db->prepare("SELECT shop_reg.*,depo_regi.id AS ID,depo_regi.zone AS depoZone FROM shop_reg LEFT JOIN depo_regi ON shop_reg.depo_id=depo_regi.id WHERE shop_reg.id=?");
	$editShop->bindParam(1,$shopId);
	$editShop->execute();
	$editShopRow=$editShop->fetch(PDO::FETCH_ASSOC);
	// select shop area
	$depoArea=$db->prepare('SELECT * FROM depo_regi');
	$depoArea->execute();
	$inc='';
	$depoData='';
	while($depoRow=$depoArea->fetch(PDO::FETCH_OBJ)){
		$inc++;
		$depoData.="
			<option value='$depoRow->id'>$depoRow->zone</option>
		";
	}
?>
<div class="container-fluid">
  <div class="row">
		<div class="col-sm-12" style="margin-bottom:10px;">
			<h2 class="text-info text-center">Edit Shop Details</h2>
			<hr>
			<?php
				if(isset($_SESSION['shopeditMsg'])){
					echo $_SESSION['shopeditMsg'];
					unset($_SESSION['shopeditMsg']);
				}
			?>
			<a href="index.php?page=viewAllShop&folder=shopInfo" class="btn btn-primary pull-right">View all Shop
			</a>
		</div>
	</div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <form action="action/shopEditAction.php" method="post" class="form-horizontal">
          <div class="form-group">
            <label class="control-label col-sm-2" for="shopName">Shop Name :</label>
            <div class="col-sm-8">
              <input type="text" name="shopName" class="form-control" id="shopName" value="<?php echo $editShopRow['shop_name'];?>">
              <input type="hidden" name="shopId" value="<?php echo $editShopRow['id'];?>">
            </div>
          </div>
          <div class="form-group">
              <label class="control-label col-sm-2" for="shopZone">Shop Area :</label>
              <div class="col-sm-8"> 
                <select name="shopZone" id="shopZone" class="form-control">
                  <option value="<?php echo $editShopRow['ID']; ?>"><?php echo $editShopRow['depoZone']; ?></option>
                  <?php echo $depoData;?>
                  </select> 
              </div>
          </div>
           <div class="form-group">
              <label class="control-label col-sm-2" for="shopAddress">Shop Address :</label>
             <div class="col-sm-8"> 
              <textarea class="form-control" name="shopAddress" id="shopAddress" required="1"><?php echo $editShopRow['shop_address']; ?></textarea>
             </div>
           </div>
            <div class="form-group">
            <label class="control-label col-sm-2" for="onwerName">Owner Name :</label>
            <div class="col-sm-8"> 
              <input type="text" class="form-control" name="onwerName" id="onwerName" value="<?php echo $editShopRow['shop_owner'];?>" ">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="phone">Phone Number :</label>
            <div class="col-sm-8"> 
              <input type="number" class="form-control" name="phone" id="phone" value="<?php echo $editShopRow['phone'];?>" required="1">
            </div>
          </div>                  
          <div class="form-group"> 
            <div class="col-sm-8 col-sm-offset-2">
						  <button type="submit" class="btn btn-primary">Update</button>
           </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>	