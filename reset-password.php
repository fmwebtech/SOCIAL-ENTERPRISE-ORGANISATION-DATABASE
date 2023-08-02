<!DOCTYPE html>
<?php

	$userResetAttemptMsg = "";
	session_start();
	include_once("classes/class.user.php");
	require_once("classes/class.resetkey.php");
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		$userkey = new RESETKEY();		
		extract($_POST);
		
		if($userkey->userExists($email))
		{
			$userkey->save($email,'createPassword.php','You recenlty requested for change of password, follow the instrustions if its not you ignore this message');
			
			$userResetAttemptMsg ="An email has been sent to you to change your password, please check your email.";
		}
		else
		{
			$userResetAttemptMsg ="Opps! This email address does not exist in the system.";
		}
	}
?>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title> RESET PASSWORD </title>
  <!-- loader-->
  <link href="assets/css/pace.min.css" rel="stylesheet"/>
  <script src="assets/js/pace.min.js"></script>
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
  <!-- Bootstrap core CSS-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Custom Style-->
  <link href="assets/css/app-style.css" rel="stylesheet"/>
  
</head>

<body class="bg-theme bg-theme11">

<!-- Start wrapper-->
 <div id="wrapper">

 <div class="height-100v d-flex align-items-center justify-content-center">
	<div class="card card-authentication1 mb-0">
		<div class="card-body">
		 <div class="card-content p-2">
		  <div class="card-title text-uppercase pb-2">Reset Password</div>
		    <p class="pb-2">Please enter your email address. You will receive a link to create a new password via email.</p>
		    <form method='POST'>
			  <div class="form-group">
			  <label for="exampleInputEmailAddress" class="">Email Address</label>
			   <div class="position-relative has-icon-right">
				  <input type="email" name="email" required id="exampleInputEmailAddress" class="form-control input-shadow" placeholder="Email Address">
				  <div class="form-control-position">
					  <i class="icon-envelope-open"></i>
				  </div>
			   </div>
			  </div>
			 
			  <button type="submit" class="btn btn-light btn-block mt-3">Reset Password</button>
			 </form>
		   </div>
		  </div>
		   <div class="card-footer text-center py-3">
		   <p class="text-warning mb-0"><?php echo $userResetAttemptMsg?></p>
		    <p class="text-warning mb-0">Return to the <a href="login.php"> Sign In</a></p>
		  </div>
	     </div>
	     </div>
    
     <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
	
	</div><!--wrapper-->
	
  <!-- Bootstrap core JavaScript-->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
	
  <!-- sidebar-menu js -->
  <script src="assets/js/sidebar-menu.js"></script>
  
  <!-- Custom scripts -->
  <script src="assets/js/app-script.js"></script>
  
	
</body>
</html>
