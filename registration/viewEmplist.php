<?php
	require('database.php');
	$empRecods=$db->prepare("SELECT * FROM employee_reg");
	$empRecods->execute();
	$emptotalRecods=$empRecods->rowCount();
	$perPage=12;
	$totalPage=ceil($emptotalRecods/$perPage);
	$pageNumber=(isset($_GET['pgNumber'])?$_GET['pgNumber']:$_GET['pgNumber']=1);
	$startPage=($pageNumber-1)*$perPage;
	if($pageNumber<1){
		$startPage=(-$pageNumber+1)*$perPage;
		echo"No recods found!";
	}
	$viewAllemp=$db->prepare("SELECT * FROM employee_reg LIMIT $startPage,$perPage");
	$viewAllemp->execute();
	$sl="";
	$data="";
	while($viewAllempeRow=$viewAllemp->fetch(PDO::FETCH_OBJ)){
		$sl++;
		$data.="
			<tr class='success'>
				<td class='text-green text-bold'>$sl</td>
				<td>$viewAllempeRow->emp_name</td>
				<td>$viewAllempeRow->emp_desig</td>
				<td>$viewAllempeRow->salary</td>
				<td>$viewAllempeRow->emp_phone</td>
				<td>$viewAllempeRow->present_add</td>
				<td>
				    <a href='index.php?page=viewEmpDetails&folder=registration&id=$viewAllempeRow->id' class='btn btn-info btn-sm'>
				    	<span class='glyphicon glyphicon-eye-open'></span>
				    </a>
				</td>
				<td>
					<a href='index.php?page=employeeEdit&folder=registration&id=$viewAllempeRow->id' class='btn btn-primary btn-sm'>
						<span class='glyphicon glyphicon-edit'></span>
					</a>
				</td>
				<td>
					<a href='index.php?page=viewemplist&folder=registration&deleteId={$viewAllempeRow->id}' class='btn btn-danger btn-sm'>
						<span class='glyphicon glyphicon-trash'></span>
					</a>
				</td>
			</tr>
		";
	}
?>
<div class="container">
	<div class="row">
		<div class="col-xs-8 col-xs-offset-2">
			<h3 class="text-center text-green">View all Employee</h3>
			<hr>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<table class="table table-hover table-bordered table-condensed">
				<thead class="text-green">
					<th width="5%">Sl No</th>
					<th>Employee Name</th>
					<th>Designation</th>
					<th>Salary</th>
					<th>Mobile</th>
					<th>Present Address</th>
					<th width="5%">View</th>
					<th width="5%">Update</th>
					<th width="2%">Delete</th>
				</thead>
				<tbody>
					<?php echo $data;?>
				</tbody>
			</table><hr>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2 text-center" style="margin-top:10px">
			<?php
				$prevPage=$pageNumber-1;
				$nextPage=$pageNumber+1;
				if($pageNumber<=1){
					echo"<a href='index.php?page=viewEmplist&folder=registration&pgNumber={$prevPage}' class='btn btn-primary btn-sm disabled'><span class='glyphicon glyphicon-chevron-left'></span>Prev</a>&nbsp;&nbsp;";
				}else{
					echo"<a href='index.php?page=viewEmplist&folder=registration&pgNumber={$prevPage}' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-chevron-left'></span>Prev</a>&nbsp;&nbsp;";
				}
				if($pageNumber>$totalPage){
					echo"Page not found";	
				}else{
					for($i=1;$i<=$totalPage;$i++){
						if($i == $pageNumber){
							echo"<a href='index.php?page=viewEmplist&folder=registration&pgNumber={$i}' class='btn btn-primary btn-sm'>$i</a>&nbsp;";
						}else{
							echo"<a href='index.php?page=viewEmplist&folder=registration&pgNumber={$i}' class='btn btn-default btn-sm'>$i</a>&nbsp;";
						}
					}
				}
			if($totalPage==$pageNumber){
				echo"&nbsp;&nbsp;<a href='index.php?page=viewEmplist&folder=registration&pgNumber={$nextPage}' class='btn btn-primary btn-sm disabled'>Next<span class='glyphicon glyphicon-chevron-right'></span></a>";
			}else{
				echo"&nbsp;&nbsp;<a href='index.php?page=viewEmplist&folder=registration&pgNumber={$nextPage}' class='btn btn-primary btn-sm'>Next<span class='glyphicon glyphicon-chevron-right'></span></a>";
			}	
			?>
		</div>
	</div>
</div>


