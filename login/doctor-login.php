<html>

<head><title>Doctor Sign-in</title></head>

<body>

<?php
require('connect.php');
$checkUsername = $_POST["email"];
$checkPassword = $_POST["password"];

if($checkUsername&&$checkPassword)
{
$sql = "SELECT * from Doctor";
$result = $conn->query($sql);

if ($result->num_rows > 0) 
{
    // output data of each row
    while($row = $result->fetch_assoc()) 
	{
		$dbusername = $row['email'];
		$dbpassword = $row['password'];
		
		if($checkUsername==$dbusername&&$checkPassword==$dbpassword)
		{
			$_SESSION['username'] = $row['fname'];
			$_SESSION['userid'] = 2;
			$_SESSION['doctor-id']=$row['did'];
			$_SESSION['doctor-diary']=false;
			$_SESSION['password']=$row['password'];
			
			header("Location: ../main.php");
			echo 'You are logged in!';
			goto found;
		}
    }
	echo 'User does not exist!';
	goto notFound;
} 
else 
{
    echo "No records found";
	goto notFound;
}

found:
$conn->close();
goto end;
}

else
	echo 'Invalid username or password!';
?>

<?php notFound: ?>
<br /><br />
<a href="../html/doctor-signin.html">Click here to proceed!</a>
<?php goto skip;?>
<?php end: ?>
<br /><br />
<a href="../main.php">Click here to proceed!</a>
<?php skip:?>
</body>
</html>