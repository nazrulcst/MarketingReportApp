<?php
  require('database.php');
  $depoSelect=$db->prepare("SELECT * FROM depo_regi");
  $depoSelect->execute();
  $inc='';
  $data='';
  while($depoRow=$depoSelect->fetch(PDO::FETCH_OBJ)){
    $inc++;
    $data.="
      <option value='$depoRow->id'>$depoRow->zone</option>
    ";
  }
  $designation=$db->prepare("SELECT * FROM designation");
  $designation->execute();
  $inc='';
  $desigData='';
  while($designationRow=$designation->fetch(PDO::FETCH_OBJ)){
    $inc++;
    $desigData.="
      <option value='$designationRow->desigName'>$designationRow->desigName</option>
    ";
  }
?>
<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header text-blue text-bold">Employee Registration</h1>
    <?php
      if(isset($_SESSION['empMsg'])){
        echo $_SESSION['empMsg'];
        unset($_SESSION['empMsg']);
      }
    ?>
  </div>              
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <form action="action/employee_regAction.php" method="post" enctype="multipart/form-data" class="form-horizontal">
          <div class="form-group">
            <label class="control-label col-sm-2" for="empName">Employee Name :</label>
              <div class="col-sm-4">
                <input type="text" name="empName" class="form-control" id="empName" placeholder="Enter Employee Name" required="1">
              </div>
            <label class="control-label col-sm-2" for="fatherName">Father's Name :</label>
              <div class="col-sm-4">
                <input type="text" name="fatherName" class="form-control" id="fatherName" placeholder="Enter Father name" required="1">
              </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="motherName">Mother's Name :</label>
              <div class="col-sm-4">
                <input type="text" name="motherName" class="form-control" id="motherName" placeholder="Enter Mother name" required="1">
              </div>
            <label class="control-label col-sm-2" for="DateOfBirth">Date of Birth :</label>
              <div class="col-sm-4">
                <input type="date" name="DateOfBirth" class="form-control datepicker" id="DateOfBirth" placeholder="mm-dd-yy" required="1">
              </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="religion">Religion :</label>
              <div class="col-sm-4">
                <select name="religion" class="form-control" id="religion" required="1">
                  <option value="">Select Religion</option>
                  <option value="islam">Islam</option>
                  <option value="hindu">Hindu</option>
                  <option value="christian">Christian</option>
                  <option value="budist">Budist</option>
                </select>
              </div>
            <label class="control-label col-sm-2" for="Empphone">Phone :</label>
              <div class="col-sm-4">
                <input type="number" name="Empphone" class="form-control" id="Empphone" placeholder="Enter employee phone number" required="1">
              </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="preAddress">Present Address :</label>
              <div class="col-sm-4">
                <textarea name="preAdress" class="form-control" id="preAdress" placeholder="Enter Present Address" required="1"></textarea>
              </div>
            <label class="control-label col-sm-2" for="perAddress">Permanent Address :</label>
              <div class="col-sm-4">
                <textarea name="perAddress" class="form-control" id="perAddress" placeholder="Enter Permanent Address" required="1"></textarea>
              </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="nid">National Id :</label>
              <div class="col-sm-4">
                <input type="number" name="nid" class="form-control" id="nid" placeholder="Enter National Id">
              </div>
              <label class="control-label col-sm-2" for="Designation">Designation :</label>
              <div class="col-sm-4">
                <select class="form-control" name="Designation" id="Designation" required="1">
                  <option value="">Select Employee Designation</option>
                  <?php echo $desigData;?>
                </select>
              </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="MaritalStatus">Gender :</label>
              <div class="col-sm-4">
                <input type="radio" name="gender" value="male" required="1">&nbsp;Male 
                <input type="radio" name="gender" value="female" required="1">&nbsp;Female
              </div>
            <label class="control-label col-sm-2" for="salary">Salary :</label>
              <div class="col-sm-4">
                <input type="number" name="salary" class="form-control" id="salary" placeholder="Enter Employee Salary (Optional)">
              </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="MarketArea">Market Area :</label>
              <div class="col-sm-4">
                <select class="form-control" name="marketArea" id="MarketArea" required="1">
                  <option value="">Select Work Area</option>
                  <?php echo $data;?>
                </select>
              </div>
           <label class="control-label col-sm-2" for="Picture">Picture :</label>
              <div class="col-sm-4">
                <input type="file" name="picture" class="form-control" id="Picture" required="1">
              </div>
          </div>
          <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit"  class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $( function() {
    $( ".datepicker" ).datepicker();
  });
</script> 