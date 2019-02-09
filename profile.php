<?php
include ("includes/header.php");
include ("includes/config.php");
session_start();
include ("includes/functions.php");


if(logged_in())
{
	header('location: login.php');
}
else if(isset($_COOKIE['name']))
{
	// echo 'You are logged in through cookies';
$email = $_COOKIE['name'];
$result = mysqli_query($con, "SELECT id, fname, lname, img FROM users WHERE mail='$email'");
$retrive = mysqli_fetch_array($result);
//print_r($retrive );
$id = $retrive['id'];
$firstname = $retrive['fname'];
$lastname = $retrive['lname'];
$image = $retrive['img'];
?>


<title>Profile Page</title>
<style type="text/css">
#body-bg
{
	background-color: #efefef;
}

</style>
</head>
<body id="body-bg">
<div class='container' style='background-color: #fff; padding-top: 10px; margin-top: 20px; margin-bottom: 20px; width: 1300px; height: 700px;'>
<h2 align='center'>Welcome <?php echo ucfirst($firstname)." ".ucfirst($lastname); ?></h2>
<a href='logout.php'><button class='btn btn-outline-success' style='float: right; '>Logout</button></a><br />
<a href='change-password.php?id=<?php echo $id; ?>'><button class='btn btn-outline-primary' style='float: left; '>Change Password</button></a><br />
<center><img src='images/<?php echo $image; ?>' class='img-fluid img-thumbnail' style='width: 180px;'></center>

</body>
</html>
<?php
}
else
{
 // echo 'You are logged in through session';
$email = $_SESSION['mail'];
	 
$result = mysqli_query($con, "SELECT id, fname, lname, img FROM users WHERE mail='$email'");
$retrive = mysqli_fetch_array($result);
//print_r($retrive );
$id = $retrive['id'];
$firstname = $retrive['fname'];
$lastname = $retrive['lname'];
$image = $retrive['img'];
?>


<title>Profile Page</title>
<style type="text/css">
#body-bg
{
	background-color: #efefef;
}

</style>
</head>
<body id="body-bg">
<div class='container' style='background-color: #fff; padding-top: 10px; margin-top: 20px; margin-bottom: 20px; width: 1300px; height: 700px;'>
<h2 align='center'>Welcome <?php echo ucfirst($firstname)." ".ucfirst($lastname); ?></h2>
<a href='logout.php'><button class='btn btn-outline-success' style='float: right; '>Logout</button></a>
<a href='change-password.php?id=<?php echo $id; ?>'><button class='btn btn-outline-primary' style='float: left; '>Change Password</button></a><br />
<center><img src='images/<?php echo $image; ?>' class='img-fluid img-thumbnail' style='width: 180px;'></center>

</body>
</html>
<?php
}

?>