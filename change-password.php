<?php
include ("includes/header.php");
include ("includes/config.php");
include ("includes/functions.php");
$id = $_GET['id'];
if(isset($id))
{
$msg=''; $msg2=''; $msg1='';
if(isset($_POST['submit']))
{
	$password = $_POST['pass'];
	$confirm_password = $_POST['cpass'];
	if(empty($password))
	{
		$msg = '<div class="error">Please Enter New Password</div>';
	}
	else if(strlen($password) <=5)
	{
		$msg = '<div class="error">Password must contain atleast 6 characters</div>';
	}
	else if(empty($confirm_password))
	{
		$msg2 = '<div class="error">Please Confirm New Password</div>';
	}
	else if($password!=$confirm_password)
	{
		$msg2 = '<div class="error">Password is not the same</div>';
	}
	else
	{
		$pass = md5($password);
		mysqli_query($con, "UPDATE users SET pass='$password' WHERE id='$id'");
		$msg1 = '<div class="success">Password Changed Successfully</div>';
	}
}

?>


<title>Change Password</title>
<style type="text/css">
#body-bg
{
	
	background: url("images/community.jpg") center no-repeat fixed;
	
	background-color: #efefef;
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
.box
{
	border: 1px solid gray;
	padding: 20px;
	border-radius: 5px;
	box-shadow: 3px 3px 3px gray;
	background-color: lightyellow;
}

</style>
</head>
<body id="body-bg">
<div class='container' style='background-color: #fff; padding-top: 50px; margin-top: 20px; margin-bottom: 20px; width: 1300px; height: 700px;'>
<a href="profile.php"><button class='btn btn-outline-danger' style='float: right;'>Back to Profile</button></a>
<div class='col-md-4 offset-md-4'>
<div class='box'>
<h2 align='center'>Change Password</h2>
<center><?php echo $msg1;?></center>
<br />
<form method='post'>
	<div class='form-group'>
	<label>Enter New Password</label>
	<input type='password' name='pass' class='form-control' placeholder='Enter New Password'>
	<?php echo $msg; ?>
	</div>
	<div class='form-group'>
	<label>Confirm New Password</label>
	<input type='password' name='cpass' class='form-control' placeholder='Confirm New Password'>
	<?php echo $msg2; ?>
	</div>
	<center><button name='submit' class='btn btn-success'>Submit</button></center>
</div>
</div>
</div>
</form>
</body>
</html>
<?php
}
else
{
	header("location: login.php");
}
?>
