<?php
  require('database.php');
  $userId=$obj->userLoginId();//user id stored into
  $proSelect = $db->prepare("SELECT * FROM products");
  $proSelect->execute();
  $inc='';
  $proData='';
  while($proRow=$proSelect->fetch(PDO::FETCH_OBJ)){
    $inc++;
    $proData.="
      <option value='$proRow->id'>$proRow->pro_name</option>
    ";
  }
  // depo zone select
    $depoZone = $db->prepare('SELECT * FROM depo_regi WHERE user_id=?');
    $depoZone->bindValue(1,$userId);
    $depoZone->execute();
    $in='';
    $depoData='';
    while($depoRow=$depoZone->fetch(PDO::FETCH_OBJ)){
      $in++;
      $depoData.="
        <option value='$depoRow->id'>$depoRow->zone</option>
      ";
    }
    // employee name select
    $empName = $db->prepare('SELECT employee_reg.id,employee_reg.emp_name,depo_regi.user_id AS userId FROM employee_reg LEFT JOIN depo_regi ON employee_reg.depo_id=depo_regi.id LEFT JOIN user ON depo_regi.user_id=user.id WHERE depo_regi.user_id=?');
    $empName->bindValue(1,$userId);
    $empName->execute();
    $sl='';
    $empData='';
    while($empRow=$empName->fetch(PDO::FETCH_OBJ)){
      $sl++;
      $empData.="
        <option value='$empRow->id'>$empRow->emp_name</option>
      ";
    }
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header text-info text-bold">Add Today Sales</h3>
      <?php
        if(isset($_SESSION['slsMsg'])){
          echo $_SESSION['slsMsg'];
          unset($_SESSION['slsMsg']);
        }
      ?>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <form action="action/todaySalesInsertAction.php" method="post" class="form-horizontal">
            <div class="form-group">
              <label class="control-label col-sm-2" for="proName">Product Name :</label>
              <div class="col-sm-4">
                <select class="form-control" name="proName" id="proName" required="1">
                   <option value="">Select sell product name</option>
                   <?php echo $proData;?>
                </select>
              </div>
              <label class="control-label col-sm-2" for="proPrice">Product Price :</label>
                <div class="col-sm-4">
                  <input type="number" class="form-control" name="proPrice" id="proPrice" placeholder="Enter Product Price" required="1">
                </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="proQuantity">Product Quantity :</label>
              <div class="col-sm-4">
                <input type="number" class="form-control" name="proQuantity" id="proQuantity" placeholder="Enter Product Quantity" required="1">
              </div>
              <label class="control-label col-sm-2" for="totalPrice">Total Price :</label>
              <div class="col-sm-4">
                <input type="number" class="form-control" name="totalPrice" id="totalPrice" placeholder="Enter Product Quantity" required="1">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="marketArea">Market Area :</label>
              <div class="col-sm-4">
                <select class="form-control" name="marketArea" id="marketArea" required="1">
                  <option value="">Select marketing area</option>
                  <?php echo $depoData;?>
                </select>
              </div>
              <label class="control-label col-sm-2" for="shopName">Shop Name :</label>
              <div class="col-sm-4">
                <select class="form-control" name="shopName" id="shopName" required="1">
                    <option value="">Select shop name</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="salePerson">Sales Executive :</label>
              <div class="col-sm-4">
                <select class="form-control" name="salePerson" id="salePerson" required="1">
                    <option value="">Select Sales Executive</option>
                    <?php echo $empData;?>
                </select>
              </div>
              <label class="control-label col-sm-2" for="saleDate">Sale Date :</label>
              <div class="col-sm-4">
                 <input type="date" name="saleDate" class="form-control" id="datepicker" placeholder="mm-dd-yy" required="1"> 
              </div>
            </div>
            <div class="form-group"> 
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit"  class="btn btn-primary">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>  
</div>
<script type="text/javascript">
    $( function(){
      $("#datepicker").datepicker();
    });
    //product table data pass
    $('#proName').change(function(){
      var proIdVal=$('#proName').val();
     $.ajax({
        type:'post',
        url:'ajaxAction/productPriceShowAjax.php',
        data:{productNameId:proIdVal},
        success:function(resValue){
          var jsonData = $.parseJSON(resValue);//parse json
          $('#proPrice').val(jsonData);
        }
      });
    });
    //total price of the product
    $('#proQuantity').mouseout(function(){
      var proId=$('#proName').val();
      var quantity=$(this).val();
      $.ajax({
        type:'post',
        url:'ajaxAction/productTotalPriceShowAjax.php',
        data:{proIdVal:proId,quantityVal:quantity},
        success:function(totalRes){
          var totalTaka=$.parseJSON(totalRes);
          $('#totalPrice').val(totalTaka);
        }
      });
    });
    //shop name value
    $('#marketArea').change(function(){
      var marketArea=$(this).val();
      $.ajax({
        type:'post',
        url:'ajaxAction/shopNameAjax.php',
        data:{zoneValue:marketArea},
        success:function(resdData){
          var depoZone=JSON.parse(resdData);
          var totalRows=depoZone.length;
          $('#shopName').html('<option value="">Select Shop</option>');
          for(i=0;i<totalRows;i++){
            $('#shopName').append('<option value="'+depoZone[i].id+'">'+depoZone[i].shop_name+'</option>');
          }
        }
      });
    }); 
</script> 