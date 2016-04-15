<?php
session_start();
if (!isset($_SESSION['valid_user'])) {
 // not logged in
 	header ('Location: pages/examples/login.php');
	}
else{
	//alreay logged in
	require"/export/home/m/mingyuli/public_html/PickUpEvents/connectdb.php";
 	// user has provided a username and password, so try to log them in
 	$query1 = "SELECT * from M_events where date >= CURDATE()";
		if ($result1 = mysqli_query($db,$query1)) {
	 		$num_events = mysqli_num_rows($result1);			
	}
	$query2 = "SELECT * from M_events where date >= CURDATE() and location_id = 1";
		if ($result2 = mysqli_query($db,$query2)) {
	 		$num_1 = mysqli_num_rows($result2);
		}
	$query3 = "SELECT * from M_events where date > CURDATE() and location_id = 2";
		if ($result3 = mysqli_query($db,$query3)) {
	 		$num_2 = mysqli_num_rows($result3);
		}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MSIS Master Project | Mingyu</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="../../plugins/iCheck/all.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="../../plugins/datepicker/datepicker3.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="../../plugins/colorpicker/bootstrap-colorpicker.min.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="../../plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="../../plugins/select2/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../dist/css/skins/skin-purple-light.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <!-- <style>
 
  </style> -->
  
  </head>
  <body class="hold-transition skin-purple-light sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="../../starter.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>P</b>E</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>PickUp</b>Events</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
                <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->

              <!-- Notifications Menu -->
              <li class="dropdown notifications-menu">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning">9</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 9 notifications</li>
                  <li>
                    <!-- Inner Menu: contains the notifications -->
                    <ul class="menu">
                      <li><!-- start notification -->
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> 5 new members joined today
                        </a>
                      </li><!-- end notification -->
                    </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
                </ul>
              </li>
              
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img src="../../dist/img/wu_images.jpg" class="user-image" alt="User Image">
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs">
                  	<?php echo $_SESSION['firstname']. "&nbsp&nbsp" . $_SESSION['lastname'] ;	?>
                  	</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="../../dist/img/wu_images.jpg" class="img-circle" alt="User Image">
                    <p>
                      <?php echo $_SESSION['firstname']. "&nbsp&nbsp" . $_SESSION['lastname'] ;	?> - Web Developer
                      <small>Good for you.</small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="col-xs-6 text-center">
                      <a href="#">Followers</a>
                    </div>
                   
                    <div class="col-xs-6 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="../examples/logout.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="../../dist/img/wu_images.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $_SESSION['firstname']. "&nbsp&nbsp" . $_SESSION['lastname'] ;	?></p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <!-- search form (Optional) -->
          <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form> -->
          <!-- /.search form -->

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="treeview">
             <a href="#">
                <i class="fa fa-hand-peace-o"></i> <span>Upcoming Events</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              	<li><a href="../../starter.php"><i class="fa fa-circle-o"></i> <span>All</span><small class="label pull-right bg-blue">
              		<?php echo $num_events; ?></small></a></li>
                <li><a href="../../starter.php?location1=true"><i class="fa fa-circle-o"></i> <span>Fetzer Gym</span><small class="label pull-right bg-blue">
                	<?php echo $num_1; ?></small></a></li>
                <li><a href="../../starter.php?location2=true"><i class="fa fa-circle-o"></i> <span>Rams Head</span><small class="label pull-right bg-blue">
                	<?php echo $num_2; ?></small></a></li>
              </ul>
            </li>
            <li class="active"><a href="newEvents.php"><i class="fa fa-tags"></i> <span>New Events</span></a></li>
            <!-- <li>
              <a href="../../pages/gameCalendar.html">
                <i class="fa fa-calendar"></i> <span>Calendar</span>
                <small class="label pull-right bg-red">5</small>
              </a>
            </li> -->
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            New Events
            <small>Create a new game</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="../../starter.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="#"> New Events</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <div class="row">
            <div class="col-md-6">
              <div class="box">
              
                <!-- <div class="box-header">
                  <h3 class="box-title"></h3>
                </div> --><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="create_event.php" method="post">
                <div class="box-body">
                  <div class="form-group">
                  <label>Create a name for your event:</label>
                      <input type="text" class="form-control" placeholder="Limit to 20 characters..." name="name">
                  </div><!-- /.form-group -->  
                  
                  <div class="form-group">
                  <label>Enter the Discriptions: </label>
                      <input type="text" class="form-control" placeholder="Enter ..." name="description">
                  </div><!-- /.form-group -->  
                  
                	<div class="form-group">
                    <label>Pick a location:</label>
                    <select class="form-control select2" style="width: 100%;" name="location">
                      <option selected="selected"></option>
                      <option value=1>Fetzer Gym</option>
                      <option value=2>Rams Head</option>
                      <option value=3>location3</option>
                      <option value=4>location4</option>
                    </select>
                  </div><!-- /.form-group -->  
                  
                  <!-- Date mm/dd/yyyy -->
                 
                  <div class="form-group">
                  <label>Pick a date:</label>	
                    <div class="input-group date" data-provide="datepicker" id="datepicker">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>                      
                      <input type="text" class="form-control" name="date" readonly="true" >
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  
                  
                  <!-- time Picker -->
                  <div class="bootstrap-timepicker">
                    <div class="form-group">
                      <label>Pick a time:</label>
                      <div class="input-group">
                        <input type="text" name="time" class="form-control timepicker" readonly="true">
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                      </div><!-- /.input group -->
                    </div><!-- /.form group -->
                  </div>
                  
                  
                   <div class="box-footer">
                   	<div class = "col-md-6 col-md-offset-4">
                  	<button class="btn bg-purple btn-flat">Submit</button>
                  	</div>
                  </div>
               </div><!-- /.box-body -->
               </form>
              </div><!-- /.box -->
            </div><!-- /.col (left) -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2016 <a href="#">MSIS Project</a>.</strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="../../plugins/select2/select2.full.min.js"></script>
    <!-- InputMask -->
    <script src="../../plugins/input-mask/jquery.inputmask.js"></script>
    <script src="../../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="../../plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="../../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap color picker -->
    <script src="../../plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
    <!-- bootstrap date picker -->
    <script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- bootstrap time picker -->
    <script src="../../plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="../../plugins/iCheck/icheck.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
   <!-- Page script -->
    <script>
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();

        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();


		$("#datepicker").datepicker({ startDate: '-0m' });

        //Timepicker
        $(".timepicker").timepicker({
          showInputs: false
        });
      });
    </script>
  </body>
</html>
<?php
}
?>