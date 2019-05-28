<html>

<?php

require('../connect.php');

$password =$_SESSION['password'];
$did = $_SESSION['doctor-id'];
$oldpass = $_POST['old-pass'];
$newpass = $_POST['new-pass'];
$confirmpass =$_POST['confirm-pass'];

if($password==$oldpass && $newpass==$confirmpass)
{
	$sql = "update Doctor set password = '$newpass' where did='$did';";
	$r = $conn->query($sql);
	header("Location: doctor-profile.php");
}

else
{
	echo "Invalid credentials, please try again!";
}


?>

<br /><br />
<a href="doctor-profile.php">Click here to proceed!</a>

</html>