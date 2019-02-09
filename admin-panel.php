<?php
include ("includes/header.php");
include ("includes/config.php");
session_start();
$name = $_SESSION['name'];
if(isset($name))
{
	$result = mysqli_query($con, "SELECT id, fname, lname, mail, dob, img FROM users");
	$row = mysqli_num_rows($result);
	echo "<div class='container'>";
	echo "<h3><br />Welcome to Admin Panel</h3>";
	echo "Total Registered Users : ".$row;
	echo "<a href='admin-logout.php'><button class='btn btn-primary' style='float:right; margin-left:50px;'>Logout</button></a>";
	echo "</br></br>";
	echo "<table class='table table-striped table-bordered table-responsive'>";
	echo "<tr align='center'>";
	echo "<th>S.No</th>";
	echo "<th>First Name</th>";
	echo "<th>Last Name</th>";
	echo "<th>Email</th>";
	echo "<th>Date of Birth</th>";
	echo "<th>Profile Image</th>";
	echo "<th>Delete Users</th>";
	echo "<th>Edit Users Details</th>";
	echo "</tr>";
	$i = 0;
	while($retrive=mysqli_fetch_array($result))
	{	
		$id = $retrive['id'];
		$firstname = $retrive['fname'];
		$lastname = $retrive['lname'];
		$email = $retrive['mail'];
		$date = $retrive['dob'];
		$image = $retrive['img'];
		echo "<tr align='center'>";
		echo "<th>".$i=$i+1;"</th>";
		echo "<th>$firstname</th>";
		echo "<th>$lastname</th>";
		echo "<th>$email</th>";
		echo "<th>$date</th>";
		echo "<th><img src='images/$image' height='100px' width='100px'></th>";
		echo "<th><a href='delete-admin.php?del=$id'><button class='btn btn-danger'>Delete</button></a></th>";
		echo "<th><a href='update-admin.php?user=$id'><button class='btn btn-success'>Edit</button></a></th>";
	echo "</tr>";
	}
	echo "</table>";
}
else
{
	header("location: admin.php");
}
?>
<title></title>
</head>
<body>