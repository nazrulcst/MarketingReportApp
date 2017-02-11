<?php
	require('database.php');
	$depoRecord=$db->prepare("SELECT * FROM depo_regi");
	$depoRecord->execute();
	$rowCount=$depoRecord->rowCount();
	$per_page_row=10;
	$totalPage=ceil($rowCount/$per_page_row);
	$pageNumber=(isset($_GET['pgNumber'])?(int)$_GET['pgNumber']:(int)$_GET['pgNumber']=1);
	$startPage=(int)($pageNumber-1)*$per_page_row;
	if($pageNumber<1){
	    $startPage=(int)(-$pageNumber+1)*$per_page_row;
	    $_SESSION['erMsg']="You are enter wrong values !";
	}
	$depoSelect=$db->prepare("SELECT depo_regi.*,user.userName AS name FROM depo_regi LEFT JOIN user ON depo_regi.user_id=user.id ORDER BY id DESC LIMIT $startPage,$per_page_row");
	$depoSelect->execute();
	$totalDepo=$depoSelect->rowCount();
	$inc='';
	$depoData='';
	while($depoRow=$depoSelect->fetch(PDO::FETCH_OBJ)){
		$inc++;
		$depoData.="
			<tr>
				<td>$inc</td>
				<td>$depoRow->depo_name</td>
				<td>$depoRow->name</td>
				<td>$depoRow->phone</td>
				<td>$depoRow->zone</td>
        <td>$depoRow->address</td>
        <td>
          <a href='index.php?page=depoEdit&folder=registration&id={$depoRow->id}' class='btn btn-primary'>
            <span class='glyphicon glyphicon-pencil'></span>
          </a>
        </td>
			</tr>
		";
	}
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      <h3 class="text-green text-center text-bold">View all depo information</h3>
      <hr>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2" style="margin-top:10px">
      <table class="table table-hover table-bordered table-striped table-consendend">
        <thead class="text-green">
          <th>Sl No</th>
          <th>Depo Name</th>
          <th>User Name</th>
          <th>Phone</th>
          <th>Branch</th>
          <th>Address</th>
          <th>Update</th>
        </thead>
        <tbody>
          <?php echo $depoData;?>
          <tr class="info">
          	<td></td>
          	<td>Total Depo</td>
          	<td colspan="5"><?php echo $totalDepo;?></td>
          </tr>
        </tbody>
      </table><hr>
    </div>
    <div class="col-sm-10 col-sm-offset-1 text-center" style="margin-top:10px">
      <?php
        $prevPage=$pageNumber-1;
        $nextPage=$pageNumber+1;
        if($pageNumber<=1){
          echo"<a href='index.php?page=viewAllDepo&folder=registration&pgNumber={$prevPage}' class='btn btn-primary btn-sm disabled'><span class='glyphicon glyphicon-chevron-left'></span>Prev</a>&nbsp;&nbsp;";
        }else{
          echo"<a href='index.php?page=viewAllDepo&folder=registration&pgNumber={$prevPage}' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-chevron-left'></span>Prev</a>&nbsp;&nbsp;";
        }
        if($pageNumber>$totalPage){
          echo"Page not found"; 
        }else{
          for($i=1;$i<=$totalPage;$i++){
            if($i == $pageNumber){
              echo"<a href='index.php?page=viewAllDepo&folder=registration&pgNumber={$i}' class='btn btn-primary btn-sm'>$i</a>&nbsp;";
            }else{
              echo"<a href='index.php?page=viewAllDepo&folder=registration&pgNumber={$i}' class='btn btn-default btn-sm'>$i</a>&nbsp;";
            }
          }
        }
      if($totalPage==$pageNumber){
        echo"&nbsp;&nbsp;<a href='index.php?page=viewAllDepo&folder=registration&pgNumber={$nextPage}' class='btn btn-primary btn-sm disabled'>Next<span class='glyphicon glyphicon-chevron-right'></span></a>";
      }else{
        echo"&nbsp;&nbsp;<a href='index.php?page=viewAllDepo&folder=registration&pgNumber={$nextPage}' class='btn btn-primary btn-sm'>Next<span class='glyphicon glyphicon-chevron-right'></span></a>";
      } 
      ?>
    </div>
  </div>
</div>