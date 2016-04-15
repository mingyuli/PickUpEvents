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


if(count($_POST)>0) {
	/* Form Required Field Validation */
	foreach($_POST as $key=>$value) {
	if(empty($_POST[$key])) {
	$message = ucwords($key) . " field is required";
	break;
	}
	}
	/* Password Matching Validation */
	if($_POST['password'] != $_POST['repw']){ 
	$message = 'Passwords should be same<br>'; 
	}

	/* Email Validation */
	if(!isset($message)) {
	if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
	$message = "Invalid UserEmail";
	}
	}

	/* Validation to check if firstname is selected */
	if(!isset($message)) {
	if(!isset($_POST["firstname"])) {
	$message = " Firstname field is required";
	}
	}
	

	/* Validation to check if Terms and Conditions are accepted */
	if(!isset($message)) {
	if(!isset($_POST["check"])) {
	$message = "Accept Terms and conditions before submit";
	}
	}
	
 if(!isset($message)) {	
		require"/export/home/m/mingyuli/public_html/PickUpEvents/connectdb.php";
				
		$email = my_escape($db, $_POST['email']);	
		$fname = my_escape($db, $_POST['firstname']);
		$lname = my_escape($db, $_POST['lastname']);
		$pw = md5(my_escape($db, $_POST['password']));
		$query = "insert into M_users (email, firstname, lastname, password) 
		values ('$email', '$fname', '$lname','$pw')";
		// echo $query;
		
		$result = mysqli_query($db, $query);
		if($result) {
	 		session_start();
			$last_id = mysqli_insert_id($db);
			$userinfo = "SELECT * FROM M_users WHERE id= '$last_id'";
			if ($userresult = mysqli_query($db,$userinfo)) {
	 		$row = mysqli_fetch_row($userresult);
			$_SESSION['valid_user'] = $row[1];
	 		$_SESSION['user_id'] = $row[0];
	 		$_SESSION['firstname'] = $row[2];
			$_SESSION['lastname'] = $row[3];
			$_SESSION['created_date'] = $row[5];			
			$message = "You have registered successfully!<br> Now go to the main page!";	
			header( "refresh:2;url=../../starter.php" );
			//header('Location: login.php');
			unset($_POST);
			}			
		}

		else {
		$message = "Problem in registration. Try Again!";	
	}
	mysql_close($db);
 }
 }
?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PickUpEvents | Registration Page</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../../plugins/iCheck/square/purple.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition register-page">
    <div class="register-box">
	<div class="login-logo">
        <a href="../../starter.php"><b>PickUp</b>Events</a>
      </div><!-- /.login-logo -->

      <div class="register-box-body">
        <p class="login-box-msg text-warning"><?php if(isset($message)) echo $message; ?></p>
        <form action="register.php" method="post">
          <div class="form-group has-feedback">
            <input type="email" class="form-control" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" 
            placeholder="Email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>         
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="firstname" value="<?php if(isset($_POST['firstname'])) echo $_POST['firstname']; ?>"
            placeholder="First name">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="lastname" value="<?php if(isset($_POST['lastname'])) echo $_POST['lastname']; ?>"
             placeholder="Last name">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="repw" placeholder="Retype password">
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox" name="check"> I agree to the <a href="#">terms</a>
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
            <input type="submit" name="submit" value="Register" class="btn btn-block bg-purple btn-flat">
            <!-- <button type="submit" name="submit" class="btn btn-block bg-purple btn-flat">Register</button> -->
            </div><!-- /.col -->
          </div>
        </form>

        <!-- <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using Google+</a>
        </div> -->

        <a href="login.php" class="text-center">I already have a membership</a>
      </div><!-- /.form-box -->
    </div><!-- /.register-box -->
     

    <!-- jQuery 2.1.4 -->
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="../../plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-purple',
          radioClass: 'iradio_square-purple',
          increaseArea: '20%' // optional
        });
      });
      
    </script>
  </body>
</html>
