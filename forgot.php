<?php
include ("includes/header.php");
include ("includes/config.php");
include ("includes/functions.php");

$msg = ''; $msg1 = ''; $msg2 = ''; $msg3 = ''; $msg4 = ''; $email = ''; $date = ''; $password = ''; $confirm_password = '';

if(isset($_POST['submit']))
{
	$email = $_POST['email'];
	$date = $_POST['dob'];
	$password = $_POST['pass'];
	$confirm_password = $_POST['cpass'];
	
	if(empty($email))
	{
		$msg = '<div class="error">Please Enter Your Email</div>';
	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		$msg = '<div class="error">Please Enter Valid Email</div>';
	}
	if(empty($date))
	{
		$msg2 = '<div class="error">Please Enter Your Date of Birth</div>';
	}
	if(empty($password))
	{
		$msg3 = '<div class="error">Please Enter Your New Password</div>';
	}
	else if(strlen($password)<=5)
	{
		$msg3 = '<div class="error">Password must contain atleast 6 characters</div>';
	}
	if(empty($confirm_password))
	{
		$msg4 = '<div class="error">Please Confirm Your New Password</div>';
	}
	else if($password!=$confirm_password)
	{
		$msg4 = '<div class="error">Password does not match</div>';
	}
	else if(email_exists($email, $con))
	{
	$result = mysqli_query($con, "SELECT dob FROM users WHERE mail='$email'");
	$retrive = mysqli_fetch_array($result);
	$DOB = $retrive['dob'];
	if($date == $DOB)
	{
		$pass = md5($password);
		mysqli_query($con, "UPDATE users SET pass='$pass'");
		$msg1 = '<div class="success">Password Changed Successfully </div>';
	}
	else
	{
		$msg2 = '<div class="error">Date of Birth is wrong</div>';
	}
	}
	else
	{
		$msg = '<div class="error">Email does not exist</div>';
	}
	
}

?>
<title>Forgot Password</title>
<style type="text/css">
#body-bg
	{
		background: url("images/community.jpg") center no-repeat fixed;
	}
.error
{
	color: red;
}
.success
{
	color: green;
	font-weight: bold;
}
</style>

</head>
<body id='body-bg'>
	<div class="container">
		<div class="login-form col-md-4 offset-md-4">
			<div class="jumbotron" style="magin-top: 50px; padding-top: 20px; padding-bottom: 10px;">
				<h2 align="center">Forgot Password</h2>
				<center><?php echo $msg1; ?></center><br />
				<form method="post">
					<div class="form-group">
					<label>Email : </label>
					<input type='email' name='email' class='form-control' placeholder='Enter Your Email' value='<?php echo $email; ?>'>
					<?php echo $msg; ?>
					</div>
					<div class="form-group">
					<label>Date of Birth : </label>
					<input type='date' name='dob' value='<?php echo $date; ?>' class='form-control'>
					<?php echo $msg2; ?>
					</div>
					<div class="form-group">
					<label>New Password : </label>
					<input type='password' name='pass' value='<?php echo $password; ?>' class='form-control' placeholder='Enter New Password'>
					<?php  echo $msg3; ?>
					</div>
					<div class="form-group">
					<label>Confirm New Password : </label>
					<input type='password' name='cpass' value='<?php echo $confirm_password; ?>' class='form-control' placeholder='Confirm New Password'>
					<?php  echo $msg4; ?>
					</div>
					<center><button class='btn btn-success' name='submit'>Submit</button></center>
					<center><a href="login.php">Back to Login</a></center>
				</form>
			</div>
		</div>
	</div>
</body>
</html>