  <aside class="main-sidebar">  
		    <!-- sidebar: style can be found in sidebar.less -->
		    <section class="sidebar">
		      <!-- Sidebar user panel -->
		      <div class="user-panel">
		        <div class="pull-left image">
		          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
		        </div>
		        <div class="pull-left info">
		          <p><?php echo $userNameRow['userName'];?></p>
		          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
		        </div>
		      </div>
		      <!-- search form -->
		      <form action="#" method="get" class="sidebar-form">
		        <div class="input-group">
		          <input type="text" name="q" class="form-control" placeholder="Search...">
		              <span class="input-group-btn">
		                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
		                </button>
		              </span>
		        </div>
		      </form>
		      <!-- /.search form -->
		      <!-- sidebar menu: : style can be found in sidebar.less -->
		      <ul class="sidebar-menu">
		        <li class="header">MAIN NAVIGATION</li>
			        <li class="<?php echo(isset($_GET['folder']) && $_GET['folder']=='setup')?'active':null;?> treeview">
			          <a href="#">
			            <i class="fa fa-cog text-green"></i> <span>General Settings</span>
			            <span class="pull-right-container">
			              <i class="fa fa-angle-left pull-right"></i>
			            </span>
			          </a>
			          <ul class="treeview-menu">
			            <li class="<?php echo (isset($_GET['page']) && $_GET['page']=='categorySetup')? 'active':null;?>"><a href="index.php?page=categorySetup&folder=setup"><i class="fa fa-circle-o"></i>Create new category</a></li>
			            <li class="<?php echo (isset($_GET['page']) && $_GET['page']=='createDesignation')? 'active':null;?>"><a href="index.php?page=createDesignation&folder=setup"><i class="fa fa-circle-o"></i>Create new designation</a></li>
			            <li class="<?php echo (isset($_GET['page']) && $_GET['page']=='userCreateSetup')? 'active':null;?>"><a href="index.php?page=userCreateSetup&folder=setup"><i class="fa fa-circle-o"></i>Create new user</a></li>
			            <li class="<?php echo (isset($_GET['page']) && $_GET['page']=='viewAlluser')? 'active':null;?>"><a href="index.php?page=viewAlluser&folder=setup"><i class="fa fa-circle-o"></i>View all users</a></li>
			          </ul>
			        </li>
			         <!--Report start-->
		        <li class="<?php echo(isset($_GET['folder']) && $_GET['folder']=='report')?'active':null;?> treeview">
		          <a href="#">
		            <i class="fa fa-flag text-green"></i> <span>All Reports</span>
		            <span class="pull-right-container">
		              <i class="fa fa-angle-left pull-right"></i>
		            </span>
		          </a>
		          <ul class="treeview-menu">
		            <li class="<?php echo (isset($_GET['page']) && $_GET['page']=='viewTodaySalesReport')? 'active':null;?>"><a href="index.php?page=viewTodaySalesReport&folder=report"><i class="fa fa-circle-o"></i>View Depo Sales</a></li>
		            <li class="<?php echo (isset($_GET['page']) && $_GET['page']=='viewAllShop')? 'active':null;?>"><a href="index.php?page=viewAllShop&folder=report"><i class="fa fa-circle-o"></i>View All Shop</a></li>
		            <li class="<?php echo (isset($_GET['page']) && $_GET['page']=='viewAllClientShop')? 'active':null;?>"><a href="index.php?page=viewAllClientShop&folder=report"><i class="fa fa-circle-o"></i>Client Shop View</a></li>
		          </ul>
		        </li>
		        <!--report End-->
			        <!--Registrations start-->
		        <li class="<?php echo(isset($_GET['folder']) && $_GET['folder']=='registration')?'active':null;?> treeview">
		          <a href="#">
		            <i class="fa fa-registered text-green"></i> <span>Registration</span>
		            <span class="pull-right-container">
		              <i class="fa fa-angle-left pull-right"></i>
		            </span>
		          </a>
		          <ul class="treeview-menu">
		            <li class="<?php echo (isset($_GET['page']) && $_GET['page']=='emp_reg')? 'active':null;?>"><a href="index.php?page=emp_reg&folder=registration"><i class="fa fa-circle-o"></i>Employee Registration</a></li>
		            <li class="<?php echo (isset($_GET['page']) && $_GET['page']=='depo_reg')? 'active':null;?>"><a href="index.php?page=depo_reg&folder=registration"><i class="fa fa-circle-o"></i>Create new depo</a></li>
		            <li class="<?php echo (isset($_GET['page']) && $_GET['page']=='viewAllDepo')? 'active':null;?>"><a href="index.php?page=viewAllDepo&folder=registration"><i class="fa fa-circle-o"></i>View All Depo</a></li>
		            <li class="<?php echo (isset($_GET['page']) && $_GET['page']=='viewEmplist')? 'active':null;?>"><a href="index.php?page=viewEmplist&folder=registration"><i class="fa fa-circle-o"></i>Employee View</a></li>
		          </ul>
		        </li>
		        <!--Registrations End-->
		       <!--attendance start-->
		        <li class="<?php echo(isset($_GET['folder']) && $_GET['folder']=='attendance')?'active':null;?> treeview">
		          <a href="#">
		            <i class="fa fa fa-user text-green"></i><span>Attendance</span>
		            <span class="pull-right-container">
		              <i class="fa fa-angle-left pull-right"></i>
		            </span>
		          </a>
		          <ul class="treeview-menu">
		            <li class="<?php echo (isset($_GET['page']) && $_GET['page']=='today_attendence')? 'active':null;?>"><a href="index.php?page=today_attendence&folder=attendance"><i class="fa fa-circle-o"></i>Today attendence</a></li>
		            <li class="<?php echo (isset($_GET['page']) && $_GET['page']=='view_all_attendence')? 'active':null;?>"><a href="index.php?page=view_all_attendence&folder=attendance"><i class="fa fa-circle-o"></i>View attendence</a></li>
		          </ul>
		        </li>
		        <!--attendance End-->
		        <!--shop info start-->
		        <li class="<?php echo(isset($_GET['folder']) && $_GET['folder']=='shopInfo')?'active':null;?> treeview">
		          <a href="#">
		            <i class="fa fa-building text-green"></i><span>Shop Info</span>
		            <span class="pull-right-container">
		              <i class="fa fa-angle-left pull-right"></i>
		            </span>
		          </a>
		          <ul class="treeview-menu">
		          <li class="<?php echo (isset($_GET['page']) && $_GET['page']=='shop_reg')? 'active':null;?>"><a href="index.php?page=shop_reg&folder=shopInfo"><i class="fa fa-circle-o"></i>Create new shop</a></li>
		          <li class="<?php echo (isset($_GET['page']) && $_GET['page']=='viewAllShop')? 'active':null;?>"><a href="index.php?page=viewAllShop&folder=shopInfo"><i class="fa fa-circle-o"></i>View All Shop</a></li>
		          </ul>
		        </li>
		        <!--shop info End-->
		        <!--Products Setup start-->
		       	
			        <li class="<?php echo(isset($_GET['folder']) && $_GET['folder']=='products')?'active':null;?> treeview">
			          <a href="#">
			            <i class="fa fa-product-hunt text-green"></i> <span>Products Setup</span>
			            <span class="pull-right-container">
			              <i class="fa fa-angle-left pull-right"></i>
			            </span>
			          </a>
			          <ul class="treeview-menu">
			            <li class="<?php echo (isset($_GET['page']) && $_GET['page']=='productSetup')? 'active':null;?>"><a href="index.php?page=productSetup&folder=products"><i class="fa fa-circle-o"></i>Add new product</a></li>
			            <li class="<?php echo(isset($_GET['page']) && $_GET['page']=='productViewList')?'active':null;?>">
			            	<a href="index.php?page=productViewList&folder=products"><i class="fa fa-circle-o"></i>View all product list</a>
			            </li>
			          </ul>
			        </li>
		       
		        <!--Products Setup End-->
		        <!--sales start-->
		        <li class="<?php echo(isset($_GET['folder']) && $_GET['folder']=='sales')?'active':null;?> treeview">
		          <a href="#">
		            <i class="fa fa-gg-circle text-green"></i> <span>Sales</span>
		            <span class="pull-right-container">
		              <i class="fa fa-angle-left pull-right"></i>
		            </span>
		          </a>
		          <ul class="treeview-menu">
		            <li class="<?php echo (isset($_GET['page']) && $_GET['page']=='today_sales')? 'active':null;?>"><a href="index.php?page=today_sales&folder=sales"><i class="fa fa-circle-o"></i>Today Sales</a></li>
		            <li class="<?php echo (isset($_GET['page']) && $_GET['page']=='viewTodaySales')? 'active':null;?>"><a href="index.php?page=viewTodaySales&folder=sales"><i class="fa fa-circle-o"></i>View all sales</a></li>
		          </ul>
		        </li>
		        <!--sales End-->
		      </ul>
		    </section>
		    <!-- /.sidebar -->
		  </aside>