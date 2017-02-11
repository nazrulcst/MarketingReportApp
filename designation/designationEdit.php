<?php
	require('database.php');
	if(isset($_GET['id'])){
		$desigId=$_GET['id'];
		$editdesignation=$db->prepare("SELECT * FROM `designation` WHERE `id`=?");
		$editdesignation->bindParam(1,$desigId);
		$editdesignation->execute();
		$desigEditRow=$editdesignation->fetch(PDO::FETCH_ASSOC);
	}else{
		exit();
	}
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<h2 class="text-info text-center text-bold">Edit designation</h2>
			<hr>
			<?php
				if(isset($_SESSION['desigMsg'])){
					echo $_SESSION['desigMsg'];
					unset($_SESSION['desigMsg']);
				}
			?>
			<a href="index.php?page=designationView&folder=designation" class="btn btn-primary pull-right">View all designation
			</a>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			<form action="action/designationEditAction.php" method="post">
				<div class="col-sm-10 col-sm-offset-1">
					<div class="form-group">
						<label for="designationEdit">Designation :</label>
						<input type="text" id="designationEdit" name="designationEdit" placeholder="Write your designation name" class="form-control" value="<?php echo $desigEditRow['desigName'];?>">
						<input type="hidden" id="desigId" name="desigId" value="<?php echo $desigEditRow['id'];?>">
					</div>
				</div>
				<div class="col-sm-10 col-sm-offset-1">
					<div class="form-group">
						<button href="" class="btn btn-primary btn-block">Update</button>
					</div>
				</div>
				<div class="col-xs-2 col-xs-offset-5" style="margin-top:10px">
				<a href="index.php?page=designationView&folder=designation" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-chevron-left"></span>Go Back</a>
			</div>
			</form>
		</div>
	</div>	
</div>