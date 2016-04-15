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
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="dist/css/skins/skin-purple-light.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    	
	<!--[if !IE]><!-->
	<style>
	
	

.btn.btn-success {
    color: #ffffff;
    background-color: #24b300;
    background-image: linear-gradient(to bottom, #24b300, #37911f);
    border-color: #24b300 #24b300 #24b300;
}
.btn.btn-success:hover {
    color: #ffffff;
    background-color: #37911f;
    background-image: linear-gradient(to bottom, #37911f, #37911f);
    border-color: #24b300 #24b300 #24b300;
}

.btn.btn-danger {
    color: #ffffff;
    background-color: #cc0033;
    background-image: linear-gradient(to bottom, #cc0033, #ad2648);
    border-color: #cc0033 #cc0033 #cc0033;
}
.btn.btn-danger:hover {
    color: #ffffff;
    background-color: #ad2648;
    background-image: linear-gradient(to bottom, #ad2648, #ad2648);
    border-color: #cc0033 #cc0033 #cc0033;
}

.white-bg{
    background:#f8f7f7 !important;
}
	a {
  	color: inherit;
	}
	
	
	/* 
	Max width before this PARTICULAR table gets nasty
	This query will take effect for any screen smaller than 667px
	speciffically for iphone 6
	*/
	* { 
	margin: 0; 
	padding: 0; 
	}

	#page-wrap {
		margin: 50px;
	}

	/* 
	Generic Styling, for Desktops/Laptops 
	*/
	table { 
		width: 100%; 
		border-collapse: collapse; 
	}
	
	@media only screen 
	  and (min-device-width: 320px) 
	  and (max-device-width: 414px) 
	  and (-webkit-min-device-pixel-ratio: 2)
	  and (orientation: portrait) { 
	
	
		/* Force table to not be like tables anymore */
		table, thead, tbody, th, td, tr { 
			display: block; 
		}
		
		/* Hide table headers (but not display: none;, for accessibility) */
		thead tr { 
			position: absolute;
			top: -9999px;
			left: -9999px;
		}
		
		tr { border: 1px solid #ccc; }
		
		td { 
			/* Behave  like a "row" */
			border: none;
			border-bottom: 1px solid #eee; 
			position: relative;
			padding-left: 60%;
			text-align:center;		
			}
		
		tbody td:before { 
			/* Now like a table header */
			position: absolute;
			/* Top/left values mimic padding */
			top: 6px;
			left: 2px;
			width: 20%; 
			padding-right: 6px; 
			white-space: nowrap;
		}
		
		/*
		Label the data
		*/
		td:nth-of-type(1):before { content: ""; }
		td:nth-of-type(2):before { content: "Name"; }
		td:nth-of-type(3):before { content: "Date"; }
		td:nth-of-type(4):before { content: "Time"; }
		td:nth-of-type(5):before { content: "Location"; }
		td:nth-of-type(6):before { content: "Players"; }
		td:nth-of-type(7):before { content: "Actions"; }
		
	}
	
	/* Smartphones (portrait and landscape) ----------- */
	/*@media only screen
	and (min-device-width : 320px)
	and (max-device-width : 375px) {
		body {  
			padding: 0; 
			margin: 0; 
			/*width: 320px;*/ }
		}*/
	
	/* iPads (portrait and landscape) ----------- */
	/*@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
		body { 
			width: 495px; 
		}
	}*/
	</style>
    
    
  </head>
  <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->
  <body class="hold-transition skin-purple-light sidebar-mini">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="starter.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>P</b>E</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>PickUp</b>Events</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- create an new event link  -->
              <li role="presentation"><a href="pages/forms/newEvents.php"><i class="fa fa-plus-square-o"></i>&nbspNew</a></li>
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
                  <img src="dist/img/wu_images.jpg" class="user-image" alt="User Image">
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs">
                  	<?php echo $_SESSION['firstname']. "&nbsp&nbsp" . $_SESSION['lastname'] ;	?>
                  </span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="dist/img/wu_images.jpg" class="img-circle" alt="User Image">
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
                      <a href="pages/examples/logout.php" class="btn btn-default btn-flat">Sign out</a>
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
              <img src="dist/img/wu_images.jpg" class="img-circle" alt="User Image">
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
          
          <!-- callout -->
          	

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="treeview active">
              <a href="#">
                <i class="fa fa-hand-peace-o"></i> <span>Upcoming Events</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              	<li class="<?php if ((!isset($_GET['location1']))&&(!isset($_GET['location2']))){ echo 'active';} ?>"><a href="starter.php"><i class="fa fa-circle-o"></i> <span>All</span><small class="label pull-right bg-blue">
              		<?php echo $num_events; ?></small></a></li>
                <li class="<?php if (isset($_GET['location1'])){ echo 'active';} ?>">
                	<a href="starter.php?location1=true"><i class="fa fa-circle-o"></i><span>Fetzer Gym</span><small class="label pull-right bg-blue">
                	<?php echo $num_1; ?></small></a></li>
                <li class="<?php if (isset($_GET['location2'])){ echo 'active';} ?>">
                	<a href="starter.php?location2=true"><i class="fa fa-circle-o"></i><span>Rams Head</span><small class="label pull-right bg-blue">
                	<?php echo $num_2; ?></small></a></li>
              </ul>
            </li>
            <li><a href="pages/forms/newEvents.php"><i class="fa fa-tags"></i> <span>New Events</span></a></li>
            <!-- <li>
              <a href="pages/gameCalendar.html">
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
            Upcoming Events
            <small>Events Details List</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="starter.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li> Upcoming Events</li>
            <li class="active">Basketball events</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
          
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <!-- <div class="box-header text-center">
                  <h3 class="box-title" >Basketball Games List</h3> -->
                <!-- </div> --><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table id="example2" class="table table-condensed table-hover">
                    <thead>
                      <tr class="text-purple">
                      	<th></th>
                      	<th>Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Location</th>
                        <th>Players</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
 <?php

  if (isset($_GET['location1'])) {
 	$query = "SELECT M_events.id, M_events.name, M_events.description, M_events.date, M_events.time, M_locations.id, M_locations.name, M_locations.description, M_events.p_num    
	FROM M_events, M_locations
	where M_events.location_id = M_locations.id and M_locations.id = 1 
	and M_events.date >= CURDATE() order by M_events.date";
	}
  else if (isset($_GET['location2'])) {
  	$query = "SELECT M_events.id, M_events.name, M_events.description, M_events.date, M_events.time, M_locations.id, M_locations.name, M_locations.description, M_events.p_num    
	FROM M_events, M_locations
	where M_events.location_id = M_locations.id and M_locations.id = 2 
	and M_events.date >= CURDATE() order by M_events.date";
  }
  else {
  	$query = "SELECT M_events.id, M_events.name, M_events.description, M_events.date, M_events.time, M_locations.id, M_locations.name, M_locations.description, M_events.p_num    
	FROM M_events, M_locations
	where M_events.location_id = M_locations.id 
	and M_events.date >= CURDATE() order by M_events.date";
  }
	// echo "$query";
	
	if ($result = mysqli_query($db,$query)) {
	 	while($row = mysqli_fetch_array($result)){
	 		
	 	$query_people = "SELECT M_users.firstname 
	 	FROM M_users, M_e_u 
	 	WHERE M_e_u.user_id = M_users.id and M_e_u.event_id = ".$row[0]."";
	 		 	
	 	if ($result_people = mysqli_query($db,$query_people)) {
	 		$people_array = array();
	 		while($people = mysqli_fetch_array($result_people)){
	 			$people_array[] = $people['firstname'];
				// echo $people_array[0];				
	 		}	
			$peoplelist = implode(', ', $people_array);
			// echo $peoplelist;
		}
		
		$query_email = "SELECT M_users.email 
	 	FROM M_users, M_e_u 
	 	WHERE M_e_u.user_id = M_users.id and M_e_u.event_id = ".$row[0]."";
		if ($result_email = mysqli_query($db,$query_email)) {
	 		$email_array = array();
	 		while($email = mysqli_fetch_array($result_email)){
	 			$email_array[] = $email['email'];
				//echo $email_array[0];				
	 		}	
			$emaillist = implode(', ', $email_array);
			 //echo $emaillist;
		}
		$startdate = $row[3];
 		$Date = strtotime($startdate);
 		$formatDate = date('l, M j, Y', $Date);
 		$starttime = $row[4];
 		$Time = strtotime($starttime);
		$formatTime = date('h:i A', $Time);
 		
		//$displaydate = date("l F Y", shrtotime($row[3]));
		// $time = date('h:i A', shrtotime($row[4]));
		echo "<tr><td>
		<a class='btn btn-social-icon' href='mailto:".$emaillist."' data-toggle='tooltip' title='Send a message to this group.' data-placement = 'right'>
                    <i class='fa fa-envelope-o'></i>
                  </a>
		</td>";		
	 	echo "<td class='text-info'><a href='#' data-toggle='tooltip' title='$row[2]' data-placement = 'right'>"
	 	 . $row[1] . "</td>";
		echo "<td class='text-info'>" . $formatDate . "</td>";
		echo "<td class='text-info'>" . $formatTime . "</td>";
		echo "<td class='text-info'><a href='maps.html' target='_blank' data-toggle='tooltip' title='$row[7] Click to show the map!' data-placement = 'right' >"
		 . $row[6] . "</td>";
		echo "<td class='text-info'><a href='#' data-toggle='tooltip' title='$peoplelist' data-placement = 'top'>"
		 . $row[8] . "</td>";
		echo "<td>
			<a href='join.php?eventid=".$row[0]. "' role='button' class='btn btn-success btn-sm btn-flat'>
			<span class='glyphicon glyphicon-ok'></span>Join</a>
          </a>
          <a href='delete.php?eventid=".$row[0]. "' role='button' class='btn btn-danger btn-sm btn-flat'>
          <span class='glyphicon glyphicon-remove'></span>Leave</a>  
		</td></tr>";
		}	
		
     }
   }		
 	
?>
                    </tbody>                  
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->                    
            </div>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          <b>Version</b>
          1.0 
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2016 <a href="#">MSIS Project</a>.</strong> All rights reserved.
      </footer>
      
    </div><!-- ./wrapper -->
    		<!-- <div class='alert alert-warning alert-dismissible' role='alert'>
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
  <strong>Warning!</strong> Better check yourself, you're not looking too good.
</div>	 -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
         
    <!-- page script -->
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true
        });
        $("#example3").DataTable();
      });
    </script>

  </body>
</html>
