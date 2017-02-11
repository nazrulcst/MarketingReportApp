<?php
  require('database.php');
  include_once('necessaryClass/user.php');
  $user_id=$obj->userLoginId();
  $selectDepo=$db->prepare("SELECT * FROM depo_regi WHERE user_id=?");
  $selectDepo->bindParam(1,$user_id);
  $selectDepo->execute();
  $inc='';
  $data='';
  while($depoRow=$selectDepo->fetch(PDO::FETCH_OBJ)){
    $inc++;
    $data.="
      <option value='$depoRow->id'>$depoRow->zone</option>        
    ";
  }
?>
<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header text-bold text-blue">Shop Registration</h1>
    <?php
      if(isset($_SESSION['shopMsg'])){
        echo $_SESSION['shopMsg'];
        unset($_SESSION['shopMsg']);
      }
    ?>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <form action="action/shopRegAction.php" method="post" class="form-horizontal">
          <div class="form-group">
            <label class="control-label col-sm-2" for="shopName">Shop Name :</label>
            <div class="col-sm-8">
              <input type="text" name="shopName" class="form-control" id="shopName" placeholder="Enter Shop Name" required="1">
            </div>
          </div>
          <div class="form-group">
              <label class="control-label col-sm-2" for="shopZone">Shop Area :</label>
              <div class="col-sm-8"> 
                <select name="shopZone" id="shopZone" class="form-control" required="1">
                  <option value="">Select Depo Zone</option>
                  <?php echo $data;?>
                </select>
              </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="shopAddress">Shop Address :</label>
            <div class="col-sm-8"> 
              <textarea class="form-control" name="shopAddress" id="shopAddress" placeholder="Enter Address" required="1"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="onwerName">Owner Name :</label>
            <div class="col-sm-8"> 
              <input type="text" class="form-control" name="onwerName" id="onwerName" placeholder="Enter owner name" required="1">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="phone">Phone Number :</label>
            <div class="col-sm-8"> 
              <input type="number" class="form-control" name="phone" id="phone" placeholder="Enter Phone Number" required="1">
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