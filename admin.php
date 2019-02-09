<?php
include ("includes/header.php");
include ("includes/config.php");
include ("includes/functions.php");
session_start();

$msg = ''; $msg2 = ''; $firstname = '';

if(isset($_POST['submit']))
{
	$firstname = $_POST['name'];
	$password = $_POST['pass'];
	
	if(empty($firstname))
	{
		$msg = '<div class="error">Please Enter your Name</div>';
	}
	else if(empty($password))
	{
		$msg2 = '<div class="error">Please Enter your Password</div>';
	}
	else 
	{
	$pass = mysqli_query($con, "SELECT password FROM admin WHERE name='$firstname'");
	$pass_check = mysqli_fetch_array($pass);
	$dbpass = $pass_check['password'];
	if($password!= $dbpass)
	{
		$msg2 = '<div class="error">Invalid Password!</div>';
	}
	else
	{
		$_SESSION['name'] = $firstname;
		
		header('location: admin-panel.php');
	}
	}
}

?>
<title>Admin Login</title>
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
				<h2 align="center">Admin Login</h2><br />
				<form method="post">
					<div class="form-group">
						<label>User Name :</label>
						<input type="text" name="name" class="form-control" placeholder='User Name' value="<?php echo $firstname ;?>"/>
					<?php  echo $msg;?>
					</div>
					<div class="form-group">
						<label>Password :</label>
						<input type="password" name="pass" placeholder='Password' class="form-control" />
					<?php echo $msg2;?>
					</div>
					
					<div class="form-group">
						<center><input type="submit" name="submit" value="Submit" class="btn btn-success" /></center><br>
					</div>
					
				</form>
			</div>
		</div>
	</div>
</body>
</html>