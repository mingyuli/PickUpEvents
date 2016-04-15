<?php
session_start();

function my_escape($db,$s) {
 $retval = $s;
 if (get_magic_quotes_gpc()) {
 $retval = stripslashes($retval);
 }
 $retval = strip_tags($retval);
 $retval = mysqli_real_escape_string($db,$retval);
 return $retval;
}

 if (isset($_SESSION['valid_user'])){
 	 //connect databse
 	 require"/export/home/m/mingyuli/public_html/PickUpEvents/connectdb.php";
	 $eventid =  $_GET['eventid'];
	 $userid = $_SESSION['user_id'];
	 // echo $userid;
	 // echo $eventid;
	 $sql1 = "insert into M_e_u (user_id, event_id) values ('$userid','$eventid')";
	 //echo $sql1;
	 if(mysqli_query($db, $sql1)) { 	 
		$sql2 = "UPDATE M_events SET p_num = (select count(user_id) from M_e_u where M_e_u.event_id = M_events.id)";
		 //echo $sql2;
		if(mysqli_query($db, $sql2)) {
			echo "<script>alert('You have sucessfully joined the event!'); location.href='starter.php';</script>";
		$result= 'You have sucessfully joined the event!';		
		}
	 }
	 else {
    		$result= 'Sorry there was an error sending your message.';
    		echo "<script>alert('Sorry you have already joined the group.'); location.href='starter.php';</script>";
    		//echo "Error: " . $sql1 . "<br>" . mysqli_error($db);
		}	 
 } 
?>

<!DOCTYPE html>
<html>
	<head>
 	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  	<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  	<!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.min.js"></script>
  	<!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

	</head>
	 <!--<body class="hold-transition login-page"></div>
    <div class="login-box">
      <div class="login-logo">
        <a href="starter.php"><b>PickUp</b>Events</a>
      </div><!-- /.login-logo -->
      <!-- <div class="login-box-body">
        
		<div id = "myAlert" class = "alert alert-info fade in">
   			<a href = "#" class = "close" data-dismiss = "alert">&times;</a>
   			<strong>Notice!</strong> <?php echo $result; ?>
		</div>
		</div>
		</div>
		</div> --> 
		
	<!-- <script type = "text/javascript">
   $(function(){
      $("#myAlert").bind('closed.bs.alert', function () {
         window.location.href='starter.php';;
      });
   });
</script>  --> 
	</body>
	</html>