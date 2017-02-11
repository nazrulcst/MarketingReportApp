<div class="container-fluid">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<h2 class="text-info text-bold text-center">Create Designation</h2>
			<hr>
			<?php
				if(isset($_SESSION['desigMsg'])){
					echo $_SESSION['desigMsg'];
					unset($_SESSION['desigMsg']);
				}
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<a href="index.php?page=designationView&folder=designation" class="btn btn-primary pull-right">View all designation</a>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<form action="action/designationSetupAction.php" method="post">
				<div class="col-sm-8 col-sm-offset-2">
					<div class="form-group">
						<label for="designation">Designation :</label>
						<input type="text" id="designation" name="designation" placeholder="Enter Designation..." class="form-control" required="1">
					</div>
				</div>
				<div class="col-sm-8 col-sm-offset-2">
					<div class="form-group">
						<button href="" class="btn btn-primary btn-block" id="Button">Save</button>
					</div>
				</div>
			</form>
		</div>
	</div>	
</div>