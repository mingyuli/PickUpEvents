<html>
   
   <head>
      <title>Sending HTML email using PHP</title>
   </head>
   
   <body>
      
      <?php
      if (isset($_SESSION['valid_user'])){
      	session_start();
		require"/export/home/m/mingyuli/public_html/PickUpEvents/connectdb.php";
		$eventid =  $_GET['eventid'];
		$userid = $_SESSION['user_id'];
		$query_email = "SELECT M_users.email 
	 	FROM M_users, M_e_u 
	 	WHERE M_e_u.user_id = M_users.id and M_e_u.event_id = '$eventid'";
		if ($result_email = mysqli_query($db,$query_email)) {
	 		$email_array = array();
	 		while($email = mysqli_fetch_array($result_email)){
	 			$email_array[] = $email['email'];
				echo $email_array[0];				
	 		}	
			$emaillist = implode(', ', $email_array);
			 echo $emaillist;
		}
         $to = $emaillist;
         $subject = "Notice from PickUpEvents";
         
         $message = "<b>This is HTML message.</b>";
         $message .= "<h1>This is headline.</h1>";
         
         $header = "From:'$userid' \r\n";
         $header .= "Cc:afgh@somedomain.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo "Message sent successfully...";
         }else {
            echo "Message could not be sent...";
         }
      ?>
      
   </body>
</html>