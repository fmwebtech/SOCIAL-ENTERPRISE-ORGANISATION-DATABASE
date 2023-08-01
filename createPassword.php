<!DOCTYPE html>
<?php

	$loginAttemptMsg = "";
	session_start();
	include_once("classes/class.user.php");
	include_once("classes/class.resetkey.php");
	$email = '';
	if($_SERVER['REQUEST_METHOD']=="POST" AND isset($_SESSION['resetValue']))
	{
		$user = new USER();
		extract($_POST);
		if($user->updatepassword($email,$password))
		{
			unset($_SESSION['resetValue']);
			(new RESETKEY())->delete($email);
		}
		$user = $user->authenticate($email,$password);
		if($user)
		{	
			$_SESSION['id'] = $user->id;
			$_SESSION['firstName'] = $user->firstName;
			$_SESSION['lastName'] = $user->lastName;
			$_SESSION['email'] = $user->email;
			$_SESSION['username'] = $user->email;
			$_SESSION[md5($user->email)] = md5($user->email);
			header('Location:index.php',true,302);
		}
		else
		{
			$loginAttemptMsg = 'Could not login. Either your email or Password is incorrect';
		}
	}
	else
	{
		if(isset($_GET['z']))
		{
			$resetkeyObject =(new RESETKEY())->getResetKey($_GET['z']);
			if($resetkeyObject)
			{
				$email = $resetkeyObject[0]->email;
				$_SESSION['resetValue'] = $_GET['z'];
			}
			else
			{
				header('location:signin.php');
			}
		}
		else
		{
			header('location:signin.php');
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
		  <div class="card-title text-uppercase pb-2">Update Password</div>
		    <p class="pb-2">Please enter your new password and confirm it to reset it.</p>
		    <form action="" method="POST">
			  <div class="form-group">
			  <label for="exampleInputEmailAddress" class="">New Password</label>
			   <div class="position-relative has-icon-right">
				  <input type="password" name="email" required id="firstpassword" class="form-control input-shadow" placeholder="Enter Password">
				 <input type='hidden' value='<?php echo $email?>' name='email'>
				 <div class="form-control-position">
					  <i class="icon-lock-open"></i>
				  </div>
			   </div>
			  </div>
			  
			  <div class="form-group">
			  <label for="exampleInputEmailAddress" class="">Confirm Pasword</label>
			   <div class="position-relative has-icon-right">
				  <input type="password" name="password1" onkeyup='checkvalues()' required id="secondpassword" class="form-control input-shadow" placeholder="Confirm Password">
				  <div class="form-control-position">
					  <i class="icon-lock-open"></i>
				  </div>
			   </div>
			  </div>
			  <script>
				function checkvalues()
				{
					if(document.getElementById('firstpassword').value == document.getElementById('secondpassword').value)
					{
						document.getElementById('myButton').disabled = false;
						document.getElementById('messageArea').style.display = 'none';
						document.getElementById('messageArea2').style.display = 'inline';
					}
					else
					{
							document.getElementById('messageArea').style.display = 'block';
							document.getElementById('messageArea2').style.display = 'none';
							document.getElementById('myButton').disabled = 'disabled';
							
					}
				}
			</script>
			 
			  <button id="myButton" type="submit" class="btn btn-light btn-block mt-3">Reset Password</button>
			 </form>
		   </div>
		  </div>
		   <div class="card-footer text-center py-3">
		   <p id='messageArea' style="color:red;display:none;"> <?php if($loginAttemptMsg){}else{$loginAttemptMsg='The passwords did not match.';} echo $loginAttemptMsg;?></p>
		   <p id='messageArea2' style="color:green;display:none;"> The passwords matched</p>
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
