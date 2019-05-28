<html>

<?php

require('../connect.php');

$password =$_SESSION['password'];
$pid = $_SESSION['patient-id'];
$oldpass = $_POST['old-pass'];
$newpass = $_POST['new-pass'];
$confirmpass =$_POST['confirm-pass'];

if($password==$oldpass && $newpass==$confirmpass)
{
	$sql = "update Patient set password = '$newpass' where pid='$pid';";
	$r = $conn->query($sql);
	header("Location: patient-profile.php");
}

else
{
	echo "Invalid credentials, please try again!";
}


?>

<br /><br />
<a href="patient-profile.php">Click here to proceed!</a>

</html>