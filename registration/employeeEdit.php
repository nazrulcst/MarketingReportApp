<?php
	require('database.php');
	if(!isset($_GET['id'])){
	 exit();	
	}
  $empId=$_GET['id'];
  $editEmployee=$db->prepare("SELECT employee_reg.*,depo_regi.id AS ID,depo_regi.zone AS DepoZone FROM employee_reg LEFT JOIN depo_regi ON employee_reg.depo_id=depo_regi.id WHERE employee_reg.id=?");
  $editEmployee->bindParam(1,$empId);
  $editEmployee->execute();
  $editEmployeeRow=$editEmployee->fetch(PDO::FETCH_ASSOC);
  // designation select
  $desigSelect=$db->prepare('SELECT desigName FROM designation');
  $desigSelect->execute();
  $inc='';
  $desigData='';
  while($desigRow=$desigSelect->fetch(PDO::FETCH_OBJ)){
    $inc='';
    $desigData.="
      <option value='$desigRow->desigName'>$desigRow->desigName</option>
    ";
  }
   // market area  select
  $marketArea=$db->prepare('SELECT * FROM depo_regi');
  $marketArea->execute();
  $in='';
  $zoneData='';
  while($marketRow=$marketArea->fetch(PDO::FETCH_OBJ)){
    $inc='';
    $zoneData.="
      <option value='$marketRow->id'>$marketRow->zone</option>
    ";
  }
?>
<div class="container-fluid">
  <div class="row">
		<div class="col-sm-12">
			<h2 class="text-info text-center">Update employee information</h2>
			<hr>
			<?php
			   if(isset($_SESSION['empUpMsg'])){
            echo $_SESSION['empUpMsg'];
            unset($_SESSION['empUpMsg']);
         }
			?>
			<a href="index.php?page=viewemplist&folder=registration" class="btn btn-primary pull-right">View all Employee
			</a>
		</div>
	</div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <form action="action/empEditAction.php" method="post" enctype="multipart/form-data" class="form-horizontal">
        <div class="col-sm-12">
        <div class="form-group">
            <img name="onwerPicture" src="<?php echo 'emp_photo/'.$editEmployeeRow['picture'];?>" alt="picture" height="130px" width="210px" style="box-shadow: 0px 2px 6px 5px #888888;margin-bottom:5px">
            <input type="hidden" name="oldPicName" value="<?php echo $editEmployeeRow['picture'];?>">
          </div>
        </div>
        <div class="col-sm-12">
          <div class="form-group">
            <p>Change picture</p>
            <input type="file" name="newPicture">
          </div>
        </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="empName">Employee Name :</label>
              <div class="col-sm-4">
                <input type="text" name="empName" class="form-control" id="empName" value="<?php echo $editEmployeeRow['emp_name'];?>">
                <input type="hidden" name="empId" id="empId" value="<?php echo $editEmployeeRow['id'];?>">
              </div>
            <label class="control-label col-sm-2" for="fatherName">Father's Name :</label>
              <div class="col-sm-4">
                <input type="text" name="fatherName" class="form-control" id="fatherName" value="<?php echo $editEmployeeRow['emp_father'];?>" required="1">
              </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="motherName">Mother's Name :</label>
              <div class="col-sm-4">
                <input type="text" name="motherName" class="form-control" id="motherName" value="<?php echo $editEmployeeRow['emp_mother'];?>" required="1">
              </div>
            <label class="control-label col-sm-2" for="DateOfBirth">Date of Birth :</label>
              <div class="col-sm-4">
                <input type="date" name="DateOfBirth" class="form-control datepicker" id="DateOfBirth" value="<?php echo $editEmployeeRow['emp_birth'];?>" required="1">
              </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="religion">Religion :</label>
              <div class="col-sm-4">
                <select name="religion" class="form-control" id="religion" >
                  <option value="<?php echo $editEmployeeRow['religion'];?>"><?php echo $editEmployeeRow['religion'];?></option>
                  <option value="Islam">Islam</option>
                  <option value="Hindu">Hindu</option>
                  <option value="Christian">Christian</option>
                  <option value="Buddist">Budist</option>
                </select>
              </div>
            <label class="control-label col-sm-2" for="Empphone">Phone :</label>
              <div class="col-sm-4">
                <input type="number" name="Empphone" class="form-control" id="Empphone" value="<?php echo $editEmployeeRow['emp_phone'];?>" required="1">
              </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="preAddress">Present Address :</label>
              <div class="col-sm-4">
                <textarea name="preAdress" class="form-control" id="preAdress"><?php echo $editEmployeeRow['present_add'];?></textarea>
              </div>
            <label class="control-label col-sm-2" for="perAddress">Permanent Address :</label>
              <div class="col-sm-4">
                <textarea name="perAddress" class="form-control" id="perAddress"><?php echo $editEmployeeRow['permanent_add'];?></textarea>
              </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="nid">National Id :</label>
              <div class="col-sm-4">
                <input type="number" name="nid" class="form-control" id="nid" value="<?php echo $editEmployeeRow['emp_nid'];?>">
              </div>
              <label class="control-label col-sm-2" for="Designation">Designation :</label>
              <div class="col-sm-4">
                <select class="form-control" name="Designation" id="Designation" required="1">
                  <option value="<?php echo $editEmployeeRow['emp_desig'];?>"><?php echo $editEmployeeRow['emp_desig'];?></option>
                  <?php echo $desigData;?>
                </select>
              </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="MarketArea">Market Area :</label>
              <div class="col-sm-4">
                <select class="form-control" name="marketArea" id="MarketArea" required="1">
                  <option value="<?php echo $editEmployeeRow['ID'];?>"><?php echo $editEmployeeRow['DepoZone'];?></option>
                  <?php echo $zoneData;?>
                </select>
              </div>
            <label class="control-label col-sm-2" for="salary">Salary :</label>
              <div class="col-sm-4">
                <input type="number" name="salary" class="form-control" id="salary" value="<?php echo $editEmployeeRow['salary'];?>">
              </div>
          </div>
          <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit"  class="btn btn-primary">Update</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
 </div>
</div>
<script type="text/javascript">
  $( function() {
    $( ".datepicker" ).datepicker();
  });
</script>