<?php
  date_default_timezone_set('Asia/Dhaka');
  require('database.php');
  $attenDenceRecord=$db->prepare("SELECT * FROM attendence");
  $attenDenceRecord->execute();
  $rowCount=$attenDenceRecord->rowCount();
  $per_page_row=10;
  $totalPage=ceil($rowCount/$per_page_row);
  $pageNumber=(isset($_GET['pgNumber'])?(int)$_GET['pgNumber']:(int)$_GET['pgNumber']=1);
  $startPage=(int)($pageNumber-1)*$per_page_row;
  if($pageNumber<1){
      $startPage=(int)(-$pageNumber+1)*$per_page_row;
      $_SESSION['erMsg']="You are enter wrong values !";
  }
  $curDate = date('Y-m-d');
  $selectTodayAtten = $db->prepare("SELECT attendence.*,attendence.id AS atId,employee_reg.emp_name AS empName,employee_reg.emp_desig AS desiName FROM attendence LEFT JOIN employee_reg ON attendence.emp_id=employee_reg.id WHERE atten_time=? ORDER BY atId DESC LIMIT $startPage,$per_page_row");
  $selectTodayAtten->bindValue(1,$curDate);
  $selectTodayAtten->execute();
  $inc='';
  $data='';
  while($attenRow=$selectTodayAtten->fetch(PDO::FETCH_OBJ)){
    $inc++;
    $strDate=date('d-D-m-Y',strtotime($attenRow->atten_time));
    $data.="
      <tr class='success'>
        <td>$attenRow->empName</td>
        <td>$attenRow->desiName</td>
        <td>{$strDate}</td>
        <td>$attenRow->uploader</td>
      </tr>
    ";
  }
  // Designation select statement
  $selectDesi = $db->prepare("SELECT * FROM designation");
  $selectDesi->execute();
  $desigData='';
  while($desigRow=$selectDesi->fetch(PDO::FETCH_OBJ)){
    $inc++;
    $desigData.="
      <option value='$desigRow->desigName'>$desigRow->desigName</option>
    ";
  }
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header text-blue text-bold">View Attendance</h3> 
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">  
        <div class="panel-body">    
          <form action="" method="post" class="form-horizontal" id="myformOne">
            <div class="form-group">
              <label class="control-label col-sm-2" for="desigNation">Designation :</label>
                <div class="col-sm-4">
                  <select name="desigNation" id="desigNation" class="form-control">
                    <option value="">Select Designation</option>
                    <?php echo $desigData;?>
                  </select>
                </div>
              <label class="control-label col-sm-2" for="empNameId">Employee Name :</label>
                <div class="col-sm-4">
                  <select class="form-control" name="empName" id="empNameId">
                    <option value="">Select Employee Name</option>
                  </select>
                </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="month">Month :</label>
                <div class="col-sm-4">
                  <select class="form-control" name="month" id="month">
                    <option value="">Select A Month</option>
                    <option value="January">January</option>;
                    <option value="February">February</option>;
                    <option value="March">March</option>;
                    <option value="April">April</option>;
                    <option value="May">May</option>;
                    <option value="June">June</option>;
                    <option value="July">July</option>;
                    <option value="August">August</option>;
                    <option value="September">September</option>;
                    <option value="October">October</option>;
                    <option value="November">November</option>;
                    <option value="December">December</option>;
                  </select>
                </div>
              <label class="control-label col-sm-2" for="email"></label>
                <div class="col-sm-4">
                </div>
            </div>
            <div class="form-group"> 
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
            </form>
            <table class="table">
              <tbody> 
                <tr style="width:150px;">
                  <th><h3 class="text-bold text-green text-center"><font>Today is <?php echo date("l jS \of F Y")."<br>";?></font></h3><hr>
                  </th>
                </tr>
              </tbody>
            </table>
            <table class="table table-stripe table-hover table-bordered table-condensed">
              <thead class="text-blue text-bold">
                <tr class="info">  
                  <th>Employee Name</th>
                  <th>Designation</th>
                  <th>Date</th>
                  <th>Uploader</th>
                </tr>
              </thead>
              <tbody>
                <?php echo $data;?>
              </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
    <div class="col-sm-10 col-sm-offset-1 text-center" style="margin-top:10px">
      <?php
        $prevPage=$pageNumber-1;
        $nextPage=$pageNumber+1;
        if($pageNumber<=1){
          echo"<a href='index.php?page=view_all_attendence&folder=attendance&pgNumber={$prevPage}' class='btn btn-primary btn-sm disabled'><span class='glyphicon glyphicon-chevron-left'></span>Prev</a>&nbsp;&nbsp;";
        }else{
          echo"<a href='index.php?page=view_all_attendence&folder=attendance&pgNumber={$prevPage}' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-chevron-left'></span>Prev</a>&nbsp;&nbsp;";
        }
        if($pageNumber>$totalPage){
          echo"Page not found"; 
        }else{
          for($i=1;$i<=$totalPage;$i++){
            if($i == $pageNumber){
              echo"<a href='index.php?page=view_all_attendence&folder=attendance&pgNumber={$i}' class='btn btn-primary btn-sm'>$i</a>&nbsp;";
            }else{
              echo"<a href='index.php?page=view_all_attendence&folder=attendance&pgNumber={$i}' class='btn btn-default btn-sm'>$i</a>&nbsp;";
            }
          }
        }
      if($totalPage==$pageNumber){
        echo"&nbsp;&nbsp;<a href='index.php?page=view_all_attendence&folder=attendance&pgNumber={$nextPage}' class='btn btn-primary btn-sm disabled'>Next<span class='glyphicon glyphicon-chevron-right'></span></a>";
      }else{
        echo"&nbsp;&nbsp;<a href='index.php?page=view_all_attendence&folder=attendance&pgNumber={$nextPage}' class='btn btn-primary btn-sm'>Next<span class='glyphicon glyphicon-chevron-right'></span></a>";
      } 
      ?>
    </div>     
</div>
<script>
  $(document).ready(function(){
      // Show employee name script
      $('#desigNation').change(function(){
          var desig=$(this).val();
          $.ajax({
            url:'ajaxAction/attendenceEmpShowName.php',
            type:'POST',
            data:{desigVal:desig},
            success:function(recvData){
              var jsonData=JSON.parse(recvData);
              var numberOfRows=jsonData.length;
              $('#empNameId').html('<option value="">Select an employee</option>');
              for(i=0;i<numberOfRows;i++){
                $('#empNameId').append('<option value="'+jsonData[i].id+'">'+jsonData[i].emp_name+'</option>');
              } 
            }
          });
      });
  });
</script>
