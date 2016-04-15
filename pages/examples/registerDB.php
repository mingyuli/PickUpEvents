<?php

function my_escape($db,$s) {
 $retval = $s;
 if (get_magic_quotes_gpc()) {
 $retval = stripslashes($retval);
 }
 $retval = strip_tags($retval);
 $retval = mysqli_real_escape_string($db,$retval);
 return $retval;
}
 		
	require"/export/home/m/mingyuli/public_html/PickUpEvents/connectdb.php";
	
	
	$email = my_escape($db, $_POST['email']);	
	$fname = my_escape($db, $_POST['fastname']);
	$lname = my_escape($db, $_POST['lastname']);
	$pw = m5(my_escape($db, $_POST['password']));
	$query = "insert into M_users (email, firstname, lastname, password) 
	values ('$email', '$fname', '$lname','$pw')";
	echo $query;
	
	$result = mysqli_query($db, $query);
	if($result) {
	$num_rows = mysqli_num_rows($result);
 	if ($num_rows > 0) {
 		session_start();
		echo "You have registered successfully!";	
		unset($_POST);
	} else {
		echo "Problem in registration. Try Again!";	
	}
	
}