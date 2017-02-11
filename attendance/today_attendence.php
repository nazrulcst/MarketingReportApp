<?php
	date_default_timezone_set('Asia/Dhaka');
	require('database.php');
	$selectEmp=$db->prepare("SELECT * FROM employee_reg ORDER BY employee_reg.id LIMIT 10");
	$selectEmp->execute();
	$inc='';
	$empData='';
	while($empRow=$selectEmp->fetch(PDO::FETCH_OBJ)){
		$inc++;
		$empData.="
			<tr style='width:200px;'>
                <td><input class='checkbox' type='checkbox' name='check[]' value='$empRow->id'></td>
                <td>$empRow->emp_name</td>                
                <td>$empRow->emp_desig</td>                
            </tr>
		";
	}
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      <div class="col-lg-6">
        <h3 class="page-header text-left text-bold text-green">Today Attendance</h3>
        <?php
        	if(isset($_SESSION['attMsg'])){
        		echo $_SESSION['attMsg'];
        		unset($_SESSION['attMsg']);
        	}
        ?>
      </div>         
      <div class="col-lg-6"> 
        <h3 class="page-header text-bold text-right text-blue">Date: <?php echo date('d-M-Y');?></h3>
      </div>         
    </div>
  </div>
  <div class="row">
  	<div class="col-sm-10 col-sm-offset-1">
  		<form action="" method="post">
  			<div class="form-group">
  				Show Number of Employees&nbsp;&nbsp;&nbsp;<select name="limit">
  					<option value="10">10</option>
  					<option value="20">20</option>
  					<option value="30">30</option>
  				</select>
  			</div>
  		</form>
  	</div>
  </div>
  <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default">
          <div class="panel-body">
              <div class="col-sm-2"></div>
              <div class="col-sm-8">
              <form action="action/today_attendenceAction.php" method="post">       
                <table class="table table-striped responsive table-hover table-bordered table-condensed">
                  <thead>
                    <tr>
                      <th><input type="checkbox" id="select_all"/>&nbsp;<font class="text-blue">Select All</font></th>
                      <th class="text-blue">Employee Name</th>
                      <th class="text-blue">Designation</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php echo $empData;?>
                  </tbody>
               </table>
               <div class="col-sm-2">
                <button type="submit"  class="btn btn-primary">Submit</button>
              </div>
              </form> 
              </div>
          </div>
        </div>
      </div>
  </div>        
</div>

<script type="text/javascript">            
	var select_all = document.getElementById("select_all"); //select all checkbox
	var checkboxes = document.getElementsByClassName("checkbox"); //checkbox items

	//select all checkboxes
	select_all.addEventListener("change", function(e){
    	for (i = 0; i < checkboxes.length; i++) { 
        	checkboxes[i].checked = select_all.checked;
    	}
	});

	for (var i = 0; i < checkboxes.length; i++) {
    	checkboxes[i].addEventListener('change', function(e){ //".checkbox" change 
        	//uncheck "select all", if one of the listed checkbox item is unchecked
        	if(this.checked == false){
            	select_all.checked = false;
        	}
        	//check "select all" if all checkbox items are checked
        	if(document.querySelectorAll('.checkbox:checked').length == checkboxes.length){
            	select_all.checked = true;
        	}
    	});
	}
 </script>