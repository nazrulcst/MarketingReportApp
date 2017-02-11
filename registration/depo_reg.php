<?php
  require_once('database.php');
  $selectUser=$db->prepare("SELECT * FROM user");
  $selectUser->execute();
  $inc='';
  $data='';
  while($userRow=$selectUser->fetch(PDO::FETCH_OBJ)){
    $inc++;
    $data.="
      <option value='$userRow->id'>$userRow->userName</option>
    ";
  }
?>
<div class="row">
  <div class="col-lg-12">
    <h2 class="page-header text-info text-center text-bold">Depo Registration</h2>
    <?php
      if(isset($_SESSION['depoMsg'])){
        echo $_SESSION['depoMsg'];
        unset($_SESSION['depoMsg']);
      }
    ?>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <form action="action/depoRegSetupAction.php" method="post" class="form-horizontal">
          <div class="form-group">
            <label class="control-label col-sm-2" for="depoName">Depo Name :</label>
            <div class="col-sm-10">
              <input type="text" name="depoName" id="depoName" class="form-control" placeholder="Enter Depo Name" required="1">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="depoZone">Depo Zone :</label>
            <div class="col-sm-10">
              <input type="text" name="depoZone" id="depoZone" class="form-control" placeholder="Enter Depo Zone (Area).." required="1">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="depoAddress">Depo Address :</label>
            <div class="col-sm-10"> 
              <textarea name="depoAddress" id="depoAddress" class="form-control" placeholder="Enter Address (200 characters)" required="1"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="depoPhone">Phone :</label>
            <div class="col-sm-10"> 
              <input type="number" name="depoPhone" id="depoPhone" class="form-control" placeholder="Enter Depo Phone Number" required="1">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="userId">Select User :</label>
            <div class="col-sm-10">
              <select name="userId" id="userId" class="form-control" required="1">
              	<option value="">Select your user</option>	
              	<?php echo $data;?>	
              </select>
            </div>
          </div>
          <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>