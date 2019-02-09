<?php
include ("includes/header.php");
include ("includes/config.php");
include ("includes/functions.php");
$msg='';$msg2='';$msg3='';$msg4='';$msg5='';$msg6='';$msg7='';$msg8='';$msg9='';
$firstname =''; $lastname =''; $email= ''; $date =''; $password =''; $confirm_pass =''; $image = '';

if(isset($_POST['submit']))
{
	$firstname = mysqli_real_escape_string($con, $_POST['fname']);
	$lastname = mysqli_real_escape_string($con, $_POST['lname']);
	$email = mysqli_real_escape_string($con, $_POST['mail']);
	$date = $_POST['dob'];
	$password = $_POST['pass'];
	$confirm_pass = $_POST['cpass'];
	$image = $_FILES['image']['name'];
	$tmp_image = $_FILES['image']['tmp_name'];
	$size_image = $_FILES['image']['size'];
	$checkbox = isset($_POST['check']);
	
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
	else if(email_exists($email, $con))
	{
		$msg3 = "<div class='error'>Email Already Exist</div>";
	}
	else if(empty($date))
	{
		$msg4 = "<div class='error'>Please Enter Your Date of Birth</div>";
	}
	else if(empty($password))
	{
		$msg5 = "<div class='error'>Please Enter Your Password</div>";
	}
	else if(strlen($password) <6)
	{
		$msg5 = "<div class='error'>Password must contain at least 6 characters</div>";
	}
	else if($password!==$confirm_pass)
	{
		$msg6 =  "<div class='error'>Password did not match</div>";
	}
	else if($image == '')
	{
		$msg7 = "<div class='error'>Please Upload Your Profile Image</div>";
	}
	else if($size_image >= 1000000)
	{
		$msg7 = "<div class='error'>Please Upload Image less than 1 MB</div>";
	}
	else if($checkbox!= 'on')
	{
		$msg8 = "<div class='error'>Please Agree our Terms and Conditions</div>";
	}
	else 
	{
		$password = md5($password);
		$img_ext = explode(".",$image);
		$image_ext = $img_ext[1];
		// change image name if image has the same name.
		$image = rand(1, 100).rand(1, 100).time().".".$image_ext;
		if($image_ext == 'jpg' || $image_ext == 'png' || $image_ext == 'PNG' || $image_ext == 'JPEG')
		{
			move_uploaded_file($tmp_image, "images/$image");
		
		
		mysqli_query($con, "INSERT INTO users(fname, lname, mail, dob, pass, img) VALUES ('$firstname', '$lastname', '$email', '$date', '$password', '$image')");
		$msg9 = '<div class="alert alert-success">Registration Successful</div>';
		$firstname =''; $lastname =''; $email= ''; $date =''; $password =''; $confirm_pass = ''; $image = '';
	}
	else
	{
		$msg7 = "<div class='error'>Please Upload an Image File</div>";
	}
	header('location: login.php');
	
}
}
?>
<title>Sign Up</title>
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
		<h3 align="center">Sign Up Form</h3>
		
		<?php echo $msg9; ?>
		<form method="post" enctype="multipart/form-data">
		<div class="form-group">
		<label>First Name :</label>
		<input type="text" name="fname" placeholder="Your First Name" class="form-control" value='<?php echo $firstname; ?>'>
		<?php echo $msg; ?>
		</div>
		<div class="form-group">
		<label>Last Name :</label>
		<input type="text" name="lname" placeholder="Your Last Name" class="form-control" value='<?php echo $lastname; ?>'>
		<?php echo $msg2; ?>
		</div>
		<div class="form-group">
		<label>Email :</label>
		<input type="email" name="mail" placeholder="Your Email" class="form-control" value='<?php echo $email; ?>'>
		<?php echo $msg3; ?>
		</div>
		<div class="form-group">
		<label>Date of Birth :</label>
		<input type="date" name="dob" class="form-control" value='<?php echo $date; ?>'>
		<?php echo $msg4; ?>
		</div>
		<div class="form-group">
		<label>Password :</label>
		<input type="password" name="pass" placeholder="Your Password" class="form-control" value='<?php echo $password; ?>'>
		<?php echo $msg5; ?>
		</div>
		<div class="form-group">
		<label>Confirm Password :</label>
		<input type="password" name="cpass" placeholder="Confirm Your Password" class="form-control" value='<?php echo $confirm_pass; ?>'>
		<?php echo $msg6; ?>
		</div>
		<div class="form-group">
		<label>Profile Image :</label>
		<input type="file" name="image" value='<?php echo $image; ?>' />
		<?php echo $msg7; ?>
		</div><br />
		<div class="form-group">
		<input type="checkbox" name="check" />
		I Agree the terms and conditions
		<?php echo $msg8; ?>
		</div><br />
		<center><input type="submit" name="submit" value="Submit" class="btn btn-success" /></center><br>
		<center>Already Registered! <a href="login.php">Login Here</a></center>
		</div>
		
		</form>
		</div>
		</div>
	</div>
</body>
</html>