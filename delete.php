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
	 //echo $userid;
	 //echo $eventid;
	 $sql1 = "delete from M_e_u where user_id = '$userid' and event_id = '$eventid'";
	 //echo $sql1;
	 $query = mysqli_query($db, $sql1);
	 if(mysqli_affected_rows($db)>0) {
		$sql2 = "UPDATE M_events SET p_num = (select count(user_id) from M_e_u where M_e_u.event_id = M_events.id)";
		 //echo $sql2;
		if(mysqli_query($db, $sql2)) {
		// echo "<script>alert('You have sucessfully left the event!'); location.href='starter.php';</script>";
		// $result= 'You have sucessfully left the event!';
		//}		
		$sql3 = "select p_num from M_events where id = '$eventid'";
		//echo $sql3;	
		if ($pum = mysqli_query($db,$sql3)) {
	 	$row = mysqli_fetch_row($pum);
				//echo $row[0];						
			if ($row[0]==0) {
				$sql4 = "delete from M_events where id = '$eventid'";
				//echo $sql4;
				if(mysqli_query($db, $sql4)){
					echo "<script>alert('You have left the group. The event has been deleted because no one is in it.'); location.href='starter.php';</script>";
					$result = "You have left the group.<br>The event has been deleted because no one is in it.";
					}
			}
			else {
				echo "<script>alert('You have sucessfully left the event!'); location.href='starter.php';</script>";
				$result= 'You have sucessfully left the event!';
			}
		}				
	 }
	 }
	 else {
    		$result= 'Sorry you can not leave the group because you are not in it.';
    		//echo "<script>alert('You have sucessfully left the event!'); location.href='starter.php';</script>";
    		echo "<script>alert('Sorry you can not leave the group because you are not in it.'); location.href='starter.php';</script>";
    		//echo "Error: " . $sql1 . "<br>" . mysqli_error($db);
		}	  
 } 
?>

<!DOCTYPE html>
<html>
	<head>
 
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
	<body>
		
        <!-- div class="col-sm-8 col-sm-offset-2">
		<div id = "myAlert" class = "alert alert-warning">
   			<a href = "#" class = "close" data-dismiss = "alert">&times;</a>
   			<strong>Notice!</strong> <?php echo $result; ?>
		</div>
		</div>
		
	<script type = "text/javascript">
   $(function(){
      $("#myAlert").bind('closed.bs.alert', function () {
         window.location.href='starter.php';;
      });
   });
</script>   -->
	</body>
	</html>
	 