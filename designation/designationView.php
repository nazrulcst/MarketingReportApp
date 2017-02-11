<?php
require("database.php");
include_once('necessaryClass/user.php');
if(!$obj->userType()){ //it's use for restricstions for this application
	$showDesignation=$db->prepare("SELECT * FROM `designation`");
	$showDesignation->execute();
	$totalPage="";
	$pagesNumber="";
	$a='';
	$sl="";
	$data="";
	while($desigRow=$showDesignation->fetch(PDO::FETCH_OBJ)){
		$sl++;
		$data.="
			<tr class='success'>
				<td>$sl</td>
				<td>$desigRow->desigName</td>
				<td>
					<a href='index.php?page=categoryEdit&folder=category&id={$desigRow->id}' class='btn btn-primary disabled'>
						<span class='glyphicon glyphicon-pencil'></span>
					</a>
				</td>
				<td>
					<a href='index.php?page=categoryEdit&folder=category&id={$desigRow->id}' class='btn btn-danger disabled'>
						<span class='glyphicon glyphicon-trash'></span>
					</a>
				</td>
			</tr>
		";
	}
}else{
	$records=$db->prepare("SELECT * FROM `designation`");
	$records->execute();
	$totalDesRow=$records->rowCount();// Counting category total row numbers
	$perPageItem=5;
	$totalPage=ceil($totalDesRow/$perPageItem);
	$pagesNumber=(isset($_GET['pgNumber'])?$_GET['pgNumber']:$_GET['pgNumber']=1);
	$start=($pagesNumber-1)*$perPageItem;
	if($pagesNumber<1){
		$start=(-$pagesNumber+1)*$perPageItem;
	}
	$showDesig=$db->prepare("SELECT * FROM designation LIMIT $start,$perPageItem");
	$showDesig->execute();

	$sl="";
	$data="";

	while($desigRow=$showDesig->fetch(PDO::FETCH_OBJ)){
		$sl++;
		$data.="
		<tr class='success'>
			<td class='text-green text-bold text-center'>$sl</td>
			<td>$desigRow->desigName</td>
			<td>
				<a href='index.php?page=designationEdit&folder=designation&id={$desigRow->id}' class='btn btn-primary'>
					<span class='glyphicon glyphicon-pencil'></span>
				</a>
			</td>
			<td>
				<a href='index.php?page=designationView&folder=designation&deleteid={$desigRow->id}' class='btn btn-danger disabled'>
					<span class='glyphicon glyphicon-trash'></span>
				</a>
			</td>
		</tr>
	";
	}
} // End all designation name show here 
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 col-sm-10 col-sm-offset-1">
			<h2 class="text-center text-info text-bold">All designation list</h2>
			<hr>
			<a href="index.php?page=createDesignation&folder=setup" class="btn btn-primary pull-right">Add Designation</a>
			<?php
				if(isset($_GET['deleteid'])){
					$deleteId=$_GET['deleteid'];
					echo"<b class='btn btn-primary'>Are you sure delete this item ?</b>&nbsp;&nbsp;&nbsp;
					<a href='action/categoryDeleteAction.php?deleteId=$deleteId' class='btn btn-danger'>
						<i class='fa fa-check'></i>
					</a>
					<a href='index.php?page=designationView&folder=designation' class='btn btn-primary'>
						<i class='fa fa-times'></i>
					</a>";
				}
				if(isset($_SESSION['catDelMsg'])){
					echo $_SESSION['catDelMsg'];
					unset($_SESSION['catDelMsg']);
				}
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-8 col-xs-offset-2">
			<table class="table table-bordered table-hover table-condensed table-striped">
				<thead>
					<th width="5%">Sl No</th>
					<th>Designation</th>
					<th width="5%">Edit</th>
					<th width="5%">Delete</th>
				</thead>
				<tbody>
					<?php echo $data;?>	
				</tbody>
			</table><hr>
		</div>
	</div>
	<div class="row"><!--Pagination Section start here-->
		<div class="col-xs-8 col-xs-offset-2 text-center" style="margin-top:10px">
			<?php
				$pagePre=$pagesNumber-1;
				$pageNext=$pagesNumber+1;
				if($pagePre==0){//checking the previous button
					echo"<a href='index.php?page=designationView&folder=designation&pgNumber={$pagePre}' class='btn btn-primary btn-sm disabled'><span class='glyphicon glyphicon-chevron-left'></span>Prev</a> &nbsp;&nbsp;"; // Previous button
				}else{
					echo"<a href='index.php?page=designationView&folder=designation&pgNumber={$pagePre}' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-chevron-left'></span>Prev</a> &nbsp;&nbsp;"; // Previous button
				}
				
				if($pagesNumber <= $totalPage){
					for($i=1;$i<=$totalPage;$i++){
						if($i == $pagesNumber){
								echo "<a href='index.php?page=designationView&folder=designation&pgNumber={$i}' class='btn btn-primary btn-sm'>$i</a>".'&nbsp;';
						}else{
							echo "<a href='index.php?page=designationView&folder=designation&pgNumber={$i}' class='btn btn-default btn-sm'>$i</a>".'&nbsp;';
						}
					}
				}else{
					echo"Page not found ! 404";
				}
				if($pagesNumber==$totalPage){//checking the next button
					echo"&nbsp;&nbsp;<a class='btn btn-primary btn-sm disabled'
						href='index.php?page=designationView&folder=designation&pgNumber={$pageNext}'>Next
							<span class='glyphicon glyphicon-chevron-right'></span>
						</a>";// Next button
				}else{
					echo"&nbsp;&nbsp;<a href='index.php?page=designationView&folder=designation&pgNumber={$pageNext}'
					 class='btn btn-primary btn-sm'>Next
					 	<span class='glyphicon glyphicon-chevron-right'></span>
					 </a>";// Next button
				}
			?>	
		</div>
	</div><!--/Pagination Section End here-->
</div>