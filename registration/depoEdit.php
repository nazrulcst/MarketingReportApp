<?php
  require_once('database.php');
  if(!isset($_GET['id'])){
    exit();
  }
  $editDepoId=(int)$_GET['id'];
  $depoSelect=$db->prepare("SELECT depo_regi.*,user.id AS UserId,user.userName AS name FROM depo_regi LEFT JOIN user ON depo_regi.user_id=user.id WHERE depo_regi.id=?");
  $depoSelect->bindValue(1,$editDepoId);
  $depoSelect->execute();
  $depoRow=$depoSelect->fetch(PDO::FETCH_OBJ);
  // select all users
  $selectUsers=$db->prepare('SELECT * FROM user');
  $selectUsers->execute();
  $inc='';
  $data='';
  while($userRow=$selectUsers->fetch(PDO::FETCH_OBJ)){
    $inc++;
    $data="
      <option value='$userRow->id'>$userRow->userName</option>
    ";
  }
?>
<div class="row">
  <div class="col-lg-12">
    <h2 class="page-header text-info text-center text-bold">Depo Information Update</h2>
     <?php
        if(isset($_SESSION['depoUpMsg'])){
          echo $_SESSION['depoUpMsg'];
          unset($_SESSION['depoUpMsg']);
        }
      ?>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <form action="action/depoEditAction.php" method="post" class="form-horizontal">
          <div class="form-group">
            <label class="control-label col-sm-2" for="depoName">Depo Name :</label>
            <div class="col-sm-10">
              <input type="text" name="depoName" id="depoName" class="form-control" placeholder="Enter Depo Name" value="<?php echo $depoRow->depo_name;?>">
              <input type="hidden" name="depoId" id="depoId" value="<?php echo $depoRow->id;?>">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="depoZone">Depo Zone :</label>
            <div class="col-sm-10">
              <input type="text" name="depoZone" id="depoZone" class="form-control" placeholder="Enter Depo Zone (Area).." value="<?php echo $depoRow->zone;?>">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="depoAddress">Depo Address :</label>
            <div class="col-sm-10"> 
              <textarea name="depoAddress" id="depoAddress" class="form-control" placeholder="Enter Address (200 characters)"><?php echo $depoRow->address;?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="depoPhone">Phone :</label>
            <div class="col-sm-10"> 
              <input type="number" name="depoPhone" id="depoPhone" class="form-control" placeholder="Enter Depo Phone Number" value="<?php echo $depoRow->phone;?>">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="userId">Select User :</label>
            <div class="col-sm-10">
              <select name="userId" id="userId" class="form-control">
              	<option value="<?php echo $depoRow->UserId;?>"><?php echo $depoRow->name;?></option>	
              	<?php echo $data;?>	
              </select>
            </div>
          </div>
          <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>