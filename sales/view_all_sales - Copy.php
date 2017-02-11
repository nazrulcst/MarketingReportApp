
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header">View Sales</h3>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>




  

  <!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">

                                                    <div class="modal-dialog modal-lg">
                                                    
                                                      <!-- Modal content-->
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                          <h4 class="modal-title">Rupom Electronics</h4>
                                                        </div>
                                                        <div class="modal-body" >
                                                          <div class="row">
                                                            <div class="col-lg-12">
                                                              <div class="panel-body">
                                                                 <div class="table-responsive">
                                
                                 <table class="table table-striped table-hover">
                                        <thead>
                                          <tr align="text-center">
                                            <th>Serial No.</th>
                                            <th>Product Name</th>
                                            <th>Sale Quantity</th>
                                            <th>Total Taka</th>
                                            <th>Cash</th>
                                            <th>Due</th>  
                                          </tr>
                                        </thead>

                                        <tbody>
                                          <tr>
                                            <td>1</td>
                                            <td>N 70</td>
                                            <td>50</td>
                                            <td>2000</td>
                                            <td>1200</td>
                                            <td>800</td>
        
                                          </tr>
                                          <tr>
                                            <td>2</td>
                                            <td>N 6500</td>
                                            <td>40</td>
                                            <td>4000</td>
                                            <td>3000</td>
                                            <td>1000</td>
                                            
                                          </tr>

                                          <tr>
                                            <td>3</td>
                                            <td>Auto charger</td>
                                            <td>800</td>
                                            <td>2500</td>
                                            <td>2000</td>
                                            <td>500</td>
                                            
                            
                                          </tr>
                                          <tr>
                                            <td>4</td>
                                            <td>Auto charger USB</td>
                                            <td>900</td>
                                            <td>3000</td>
                                            <td>2000</td>
                                            <td>1000</td>
                                            
                                          </tr>

                                         
                                        </tbody>
                                    </table>
                            </div>


                                                              </div>
                                                            </div>
                                                          </div>    
                                                        </div>
                                                        <div class="modal-footer">
                                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                      </div>
                                                      
                                                    </div>
                                                  </div>



<!--Modal-->
                                     

                                        <div class="row">
                                            <div class="col-lg-12">
                                              <div class="panel-body">
                                                   
                                                   <form class="form-horizontal">

                                                          <div class="form-group">
                                                            <label class="control-label col-sm-2" for="email">Market Area:</label>
                                                            <div class="col-sm-4">
                                                              <select class="form-control">
                                                                  <option>Select Area</option>
                                                                  <option>Uttara</option>
                                                                  <option>Mirpur</option>
                                                                  <option>Jatrabari</option>
                                                              </select>
                                                              </div>

                                                            <label class="control-label col-sm-2" for="email">Sales By:</label>
                                                            <div class="col-sm-4">
                                                               <select class="form-control">
                                                                  <option>Select Person</option>
                                                                  <option>Firoz</option>
                                                                  <option>Nasir</option>
                                                                  <option>Mustafiz</option>
                                                              </select>
                                                            </div>
                                                          </div>


                                                          <div class="form-group">
                                                            <label class="control-label col-sm-2" for="email">From:</label>
                                                            <div class="col-sm-4">
                                                              <input type="Date" class="form-control">
                                                              </div>

                                                            <label class="control-label col-sm-2" for="email">To:</label>
                                                            <div class="col-sm-4">
                                                               <input type="Date" class="form-control">
                                                            </div>
                                                          </div>


                                                           <div class="form-group">
                                                            <label class="control-label col-sm-2" for="email"></label>
                                                            <div class="col-sm-4">
                                                              <button type="button" class="btn btn-primary">Search</button>
                                                              </div>

                                                            <label class="control-label col-sm-2" for="email"></label>
                                                            <div class="col-sm-4">
                                                               
                                                            </div>
                                                          </div>
                                                    </form>      

                                              </div>
                                            </div>
                                        </div>      


                  
                  <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Product Sales
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Shop Name</th>
                                        <th>Market Area</th>
                                        <th>Sales person</th>
                                        <th>Total Sale</th>
                                        <th>Cash</th>
                                        <th>Due</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr class="odd gradeX">
                                        
                                        <td>Rupom Electronics</td>
                                        <td>Uttara</td>
                                        <td>Nasir</td>
                                        <td>5000</td>
                                        <td>4000</td>
                                        <td>1000</td>
                                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" >View Details</button></td>
                                    </tr>



                                    <tr class="even gradeC">
                                         
                                        <td>Mahim Electronics</td>
                                        <td>Mirpur</td>
                                        <td>Mustafiz</td>
                                        <td>8000</td>
                                        <td>4000</td>
                                        <td>4000</td>
                                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" >View Details</button></td>
                                    </tr>
                                    <tr class="odd gradeA">
                                        
                                        <td>Jamuna Electronics</td>
                                        <td>Jatrabari</td>
                                        <td>Zisan</td>
                                        <td>10000</td>
                                        <td>8000</td>
                                        <td>2000</td>
                                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" >View Details</button></td>
                                    </tr>
                                    <tr class="even gradeA">
                                         
                                        <td>Karim Electronics</td>
                                        <td>Mirpur</td>
                                        <td>Mustafiz</td>
                                        <td>7000</td>
                                        <td>6000</td>
                                        <td>1000</td>
                                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" >View Details</button></td>
                                    </tr>
                                    
                                    
                                
                                    
                                    
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                          
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>  
                    
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->