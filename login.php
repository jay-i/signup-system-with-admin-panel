<?php
include ("includes/header.php");
include ("includes/config.php");
include ("includes/functions.php");
session_start();

$msg = ''; $msg2 = ''; $email = '';

if(isset($_POST['submit']))
{
	$email = $_POST['mail'];
	$password = $_POST['pass'];
	$checkbox = isset($_POST['check']);
	if(empty($email))
	{
		$msg = '<div class="error">Please Enter your Email</div>';
	}
	else if(empty($password))
	{
		$msg2 = '<div class="error">Please Enter your Password</div>';
	}
	else if(email_exists($email, $con))
	{
	$pass = mysqli_query($con, "SELECT pass FROM users WHERE mail = '$email'");
	$pass_check = mysqli_fetch_array($pass);
	$dbpass = $pass_check['pass'];
	$password = md5($password);
	if($password!= $dbpass)
	{
		$msg2 = '<div class="error">Invalid Password!</div>';
	}
	else
	{
		$_SESSION['mail'] = $email;
		if($checkbox == 'on')
		{
			setcookie('name', $email, time()+3000);
		}
		header('location: profile.php');
	}
	}
	else
	{
		$msg = '<div class="error">Email does not Exist!</div>';
	}
}

?>
<title>Sign In</title>
<style type="text/css">
#body-bg
	{
		background: url("images/community.jpg") center no-repeat fixed;
	}
.error
{
	color: red;
}
</style>

</head>
<body id='body-bg'>
	<div class="container">
		<div class="login-form col-md-4 offset-md-4">
			<div class="jumbotron" style="magin-top: 50px; padding-top: 20px; padding-bottom: 10px;">
				<h2 align="center">Login Form</h2><br />
				<form method="post">
					<div class="form-group">
						<label>Email :</label>
						<input type="email" name="mail" class="form-control" placeholder="Your Email" value="<?php echo $email ;?>"/>
					<?php  echo $msg;?>
					</div>
					<div class="form-group">
						<label>Password :</label>
						<input type="password" name="pass" placeholder="Your Password" class="form-control" />
					<?php echo $msg2;?>
					</div>
					<div class="form-group">
						<input type="checkbox" name="check" />
					&nbsp;	Keep me Logged In
					</div><br />
					<div class="form-group">
						<center><input type="submit" name="submit" value="Submit" class="btn btn-success" /></center><br>
					<center>Forgot Password? <a href="forgot.php">Click Here</a></center>
					</div>
					
				</form>
			</div>
		</div>
	</div>
</body>
</html>