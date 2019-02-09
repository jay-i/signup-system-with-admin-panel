<?php
include ("includes/header.php");
include ("includes/config.php");
include ("includes/functions.php");
$msg='';$msg2='';$msg3='';$msg4='';$msg5='';$msg6='';$msg7='';$msg8='';$msg9='';
$firstname =''; $lastname =''; $email= ''; $date =''; 
$id=$_GET['user'];
	
	if(isset($id))
	{
	$result = mysqli_query($con, "SELECT fname, lname, mail, dob FROM users WHERE id='$id'");
	$retrive = mysqli_fetch_array($result);
	$fname = $retrive['fname'];
	$lname = $retrive['lname'];
	$emails = $retrive['mail'];
	$dates = $retrive['dob'];
	}
	if(isset($_POST['submit']))
	{
	$firstname = mysqli_real_escape_string($con, $_POST['firstname']);
	$lastname = mysqli_real_escape_string($con, $_POST['lastname']);
	$email = mysqli_real_escape_string($con, $_POST['mail2']);
	$date = $_POST['dob2'];
	
	if(strlen($firstname) < 3)
	{
		$msg = "<div class='error'>First name must contain at least 3 characters</div>";
	}
	else if(strlen($lastname) < 3)
	{
		$msg2 = "<div class='error'>Last name must contain at least 3 characters</div>";
	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		$msg3 = "<div class='error'>Enter a Valid Email</div>";
	}
	
	else if(empty($date))
	{
		$msg4 = "<div class='error'>Please Enter Your Date of Birth</div>";
	}
	
	else 
	{		
		mysqli_query($con, "UPDATE users SET fname='$firstname', lname='$lastname', mail='$email', dob='$date' WHERE id='$id'");
		header("location: admin-panel.php");
		$firstname =''; $lastname =''; $email= ''; $date =''; 
	}
	
}

?>
<title>Update User</title>
</head>
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
	}
</style>

<body id="body-bg">
	<div class="container">
		<div class="login-form col-md-6 offset-md-3">
			<div class="jumbotron" style="margin-top:10px; padding-top:20px; padding-bottom: 20px;">
		<h3 align="center">Update User Details</h3>
		
		<?php echo $msg9; ?>
		<form method="post">
		<div class="form-group">
		<label>First Name :</label>
		<input type="text" name="firstname" placeholder="Your First Name" class="form-control" value='<?php echo $fname; ?>'>
		<?php echo $msg; ?>
		</div>
		<div class="form-group">
		<label>Last Name :</label>
		<input type="text" name="lastname" placeholder="Your Last Name" class="form-control" value='<?php echo $lname; ?>'>
		<?php echo $msg2; ?>
		</div>
		<div class="form-group">
		<label>Email :</label>
		<input type="email" name="mail2" placeholder="Your Email" class="form-control" value='<?php echo $email; ?>'>
		<?php echo $msg3; ?>
		</div>
		<div class="form-group">
		<label>Date of Birth :</label>
		<input type="date" name="dob2" class="form-control" value='<?php echo $date; ?>'>
		<?php echo $msg4; ?>
		</div>	
		<center><input type="submit" name="submit" value="Update" class="btn btn-success" /></center><br>
		</div>
		
		</form>
		</div>
		</div>
	</div>
</body>
</html>