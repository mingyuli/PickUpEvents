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
	 $name = my_escape($db, $_POST["name"]);
	 $description = my_escape($db, $_POST["description"]);
	 $locationid = $_POST["location"];
	 $date = $_POST["date"];
	 $time = $_POST["time"];
	 $strtotime = strtotime($time);
	 $mysql_time = date('H:i:s',$strtotime);	 
	 $id = $_SESSION['user_id'];
     
	 $sqlinsert = "INSERT INTO M_events ".
       "(name, description, date, time, location_id, creator_id, p_num) ".
       "VALUES('$name','$description',STR_TO_DATE('$date', '%m/%d/%Y'), '$mysql_time', '$locationid', '$id', 1) ";

     if (mysqli_query($db, $sqlinsert)) {
    	$last_event_id = mysqli_insert_id($db);
		
		$sqlupdate = "INSERT INTO M_e_u ".
	 	"(user_id, event_id) ".
	 	"values('$id', '$last_event_id')";	
	    	
    	if(mysqli_query($db, $sqlupdate)) {
    	header ('Location: ../../starter.php');
			}
	 	} 
		else {
    		echo "Error: " . $sqlinsert . "<br>" . mysqli_error($db);
		}
		}
?> 	