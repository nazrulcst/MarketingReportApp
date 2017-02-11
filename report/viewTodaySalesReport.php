<?php
  require('database.php');
  include_once('necessaryClass/user.php');
  $userLoginId=$obj->userLoginId();

  $dailySalesRecod=$db->prepare("SELECT * FROM total_sales");
  $dailySalesRecod->execute();
  $rowCount=$dailySalesRecod->rowCount();
  $per_page_row=10;
  $totalPage=ceil($rowCount/$per_page_row);
  $pageNumber=(isset($_GET['pgNumber'])?(int)$_GET['pgNumber']:(int)$_GET['pgNumber']=1);
  $startPage=(int)($pageNumber-1)*$per_page_row;
  if($pageNumber<1){
    $startPage=(int)(-$pageNumber+1)*$per_page_row;
    $_SESSION['erMsg']="You are enter wrong values !";
  }
   $depo_sales=$db->prepare("SELECT total_sales.*,depo_regi.depo_name AS depoName FROM total_sales LEFT JOIN depo_regi ON total_sales.deopo_id=depo_regi.id ORDER BY id DESC LIMIT $startPage,$per_page_row");
  $depo_sales->bindParam(1,$depoId);
  $depo_sales->execute();
  $i='';
  $data='';
  while($salesRow=$depo_sales->fetch(PDO::FETCH_ASSOC)){
    $i++;
    $date=date('d-M-Y',strtotime($salesRow['sales_date']));
    $data.="
      <tr class='success'>
        <td>$i</td>
        <td>{$salesRow['depoName']}</td>
        <td>{$salesRow['today_sales_taka']}</td>
        <td>{$date}</td>
      </tr>
    ";
  }

?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      <h3 class="text-green text-center text-bold">Today sales view</h3>
      <hr>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2" style="margin-top:10px">
      <table class="table table-hover table-bordered table-striped table-consendend">
        <thead class="text-green">
          <th>Sl No</th>
          <th>Depo Name</th>
          <th>Total Sales</th>
          <th>Date</th>
        </thead>
        <tbody>
          <?php echo $data;?>
        </tbody>
      </table><hr>
    </div>
    <div class="col-sm-10 col-sm-offset-1 text-center" style="margin-top:10px">
      <?php
        $prevPage=$pageNumber-1;
        $nextPage=$pageNumber+1;
        if($pageNumber<=1){
          echo"<a href='index.php?page=viewTodaySalesReport&folder=report&pgNumber={$prevPage}' class='btn btn-primary btn-sm disabled'><span class='glyphicon glyphicon-chevron-left'></span>Prev</a>&nbsp;&nbsp;";
        }else{
          echo"<a href='index.php?page=viewTodaySalesReport&folder=report&pgNumber={$prevPage}' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-chevron-left'></span>Prev</a>&nbsp;&nbsp;";
        }
        if($pageNumber>$totalPage){
          echo"Page not found"; 
        }else{
          for($i=1;$i<=$totalPage;$i++){
            if($i == $pageNumber){
              echo"<a href='index.php?page=viewTodaySalesReport&folder=report&pgNumber={$i}' class='btn btn-primary btn-sm'>$i</a>&nbsp;";
            }else{
              echo"<a href='index.php?page=viewTodaySalesReport&folder=report&pgNumber={$i}' class='btn btn-default btn-sm'>$i</a>&nbsp;";
            }
          }
        }
      if($totalPage==$pageNumber){
        echo"&nbsp;&nbsp;<a href='index.php?page=viewTodaySalesReport&folder=report&pgNumber={$nextPage}' class='btn btn-primary btn-sm disabled'>Next<span class='glyphicon glyphicon-chevron-right'></span></a>";
      }else{
        echo"&nbsp;&nbsp;<a href='index.php?page=viewTodaySalesReport&folder=report&pgNumber={$nextPage}' class='btn btn-primary btn-sm'>Next<span class='glyphicon glyphicon-chevron-right'></span></a>";
      } 
      ?>
    </div>
  </div>
</div>