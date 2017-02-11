<?php 
  require('database.php');
    if(!isset($_GET['id'])){
      exit();
    }
    $empId=$_GET['id'];
  	$selectEmpId=$db->prepare("SELECT * FROM employee_reg WHERE id=?");
  	$selectEmpId->bindParam(1,$empId);
  	$selectEmpId->execute();
  	$selectEmpRow=$selectEmpId->fetch(PDO::FETCH_OBJ);
?>
<div class="container-fluid">
<div class="row">
  <div class="col-lg-12 ">
    <h3 class="text-center text-green">Employee Information</h3>
    <hr>
  </div>
</div>
<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
      <div class="col-sm-6">
         	<img src="<?php echo 'emp_photo/'.$selectEmpRow->picture;?>" alt="Employee Photo" height="150px" widht="230px"> 
      </div>
      <div class="col-sm-4">
          <a href='index.php?page=viewEmplist&folder=registration' class="btn btn-primary pull-right">View All Employee</a>
      </div>
    </div>
</div>
 </div>
<div class="row">
  <div class="col-sm-10 col-sm-offset-1">
    <table class="table table-hover table-striped table-bordered table-condensed">
    	<tbody>
    	 	<tr>
    	 	   <th class="text-green">Name</th>
    	 		<td width="25%"><?php echo $selectEmpRow->emp_name; ?></td>
    	 		<th class="text-green">Father Name</th>
    	 		<td width="25%"><?php echo $selectEmpRow->emp_father; ?></td>
    	 	</tr>
    	 	<tr>
    	 	    <th class="text-green">Mother Name</th>
    	 		<td><?php echo $selectEmpRow->emp_mother; ?></td>
    	 		<th class="text-green">Phone Number</th>
    	 		<td><?php echo $selectEmpRow->emp_phone; ?></td>
    	 	</tr>
    	 	<tr>
    	 	    <th class="text-green">Birth Date</th>
    	 		<td><?php echo$selectEmpRow->emp_birth; ?></td>
    	 		<th class="text-green">Religion</th>
    	 		<td><?php echo$selectEmpRow->religion; ?></td>
    	 	</tr>
    	 	<tr>
    	 	    <th class="text-green">Gender</th>
    	 		<td><?php echo $selectEmpRow->gender; ?></td>
    	 		<th class="text-green">National Id</th>
    	 		<td><?php echo $selectEmpRow->emp_nid; ?></td>
    	 	</tr>
    	 	<tr>
    	 	  <th class="text-green">Present Address</th>
    	 		<td><?php echo $selectEmpRow->present_add; ?></td>
    	 		<th class="text-green">Permanent Address</th>
    	 		<td><?php echo $selectEmpRow->permanent_add; ?></td>
    	 	</tr>
    	 	<tr>
    	 	    <th class="text-green">Designation</th>
    	 		<td><?php echo $selectEmpRow->emp_desig; ?></td>
    	 		<th class="text-green">Salary</th>
    	 		<td><?php echo $selectEmpRow->salary; ?></td>
    	 	</tr>
    	 </tbody>
    </table>
</div> 
</div> 