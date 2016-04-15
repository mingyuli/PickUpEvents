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


if (isset($_POST['email']) && isset($_POST['password'])) {
 require"/export/home/m/mingyuli/public_html/PickUpEvents/connectdb.php";
 // user has provided a username and password, so try to log them in
 
 	$useremail = my_escape($db,$_POST['email']);
	$sha1_pass = md5($_POST['password']);
	//sha1($_POST['password']);
	
	$query = "select id, firstname, lastname, created_date from M_users where email = '$useremail' "
			. "and password = '$sha1_pass'";
			
	if ($result = mysqli_query($db,$query)) {
	 	$num_rows = mysqli_num_rows($result);
	 	if ($num_rows > 0) {
	 	session_start();
	 	
	 	$row = mysqli_fetch_row($result);
	 	//echo "###$row[0]###<br>###$row[1]###<br>###$row[2]###<br>####$row[3]##<br>";
	 	$_SESSION['valid_user'] = $useremail;
	 	$_SESSION['user_id'] = $row[0];
	 	$_SESSION['firstname'] = $row[1];
		$_SESSION['lastname'] = $row[2];
		$_SESSION['created_date'] = $row[3];
	 	}
 	}
 	mysql_close($db);
 }

	if (isset($_SESSION['valid_user'])) {
		header('Location: ../../starter.php');
	 } else {
	 	if (isset($useremail)) {
			$status = "Login Failed!" ;
		}
		else {
			$status = "Sign in to start your session";
		}
	 }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PickUpEvents | Log in</title>
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
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="../../starter.php"><b>PickUp</b>Events</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg text-warning"><?php echo $status; ?></p>
        <form action="login.php" method="post">
          <div class="form-group has-feedback">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-block bg-purple btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

        <!-- <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
        </div><!-- /.social-auth-links -->

        <a href="#">I forgot my password</a><br>
        <a href="register.php" class="text-center">Register a new membership</a>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

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
