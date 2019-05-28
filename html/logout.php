<html>
<head><title>Logout User </title></head>
<body>
<?php require('connect.php') ?>

<?php
//If the user is logged, we log him out
if(isset($_SESSION['patient-id']))
{
	//We log him out by deleting the username and userid sessions
	unset($_SESSION['username'], $_SESSION['userid'],$_SESSION['patient-id'],$_SESSION['password']);
	header("Location: ../main.php");
}

if(isset($_SESSION['doctor-id']))
{
	//We log him out by deleting the username and userid sessions
	unset($_SESSION['username'], $_SESSION['userid'],$_SESSION['doctor-id'],$_SESSION['password']);
	header("Location: ../main.php");
}

if(isset($_SESSION['admin']))
{
	//We log him out by deleting the username and userid sessions
	unset($_SESSION['admin'],$_SESSION['username'], $_SESSION['userid'],$_SESSION['password']);
	header("Location: ../main.php");
}

?>
</body>
</html>