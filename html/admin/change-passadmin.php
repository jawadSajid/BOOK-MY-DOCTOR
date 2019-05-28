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
	$sql = "update Admin set password = '$newpass';";
	$r = $conn->query($sql);
	header("Location: admin-panel.php");
}

else
{
	echo "Invalid credentials, please try again!";
}


?>

<br /><br />
<a href="admin-panel.php">Click here to proceed!</a>

</html>