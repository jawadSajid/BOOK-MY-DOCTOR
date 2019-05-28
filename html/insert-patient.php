<?php require('connect.php'); ?>
<html>
<head><title>Patient Sign-up</title></head>

<body>
<?php 


$fname = $_POST['fname'];
$lname = $_POST['lname'];
$mobile = $_POST['mobile'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$password = $_POST['password'];
$ad1 = $_POST['address-line-1'];
$ad2 = $_POST['address-line-2'];
$ad3 = $_POST['address-line-3'];
$pc = $_POST['postal-code'];
$city = $_POST['city'];
$state = $_POST['state'];
$country = $_POST['country'];


$sql0 = "SELECT * from Patient";
$result = $conn->query($sql0);

if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
	{
		$dbusername = $row['email'];
		
		if($email==$dbusername)
		{
			echo 'Email already registered!<br>';
			goto end;
		}
    }
} 


$sql = "insert into Patient(fname,lname,dob,sex,phone_no,email,password) values('$fname','$lname','$dob','$gender','$mobile','$email','$password');";

if ($conn->query($sql) === TRUE)
{echo "Patient Done!<>";}

$sql2 = "insert into Addresses(a_line1,a_line2,a_line3,city_town,postal_code,state,country) values('$ad1','$ad2','$ad3','$city','$pc','$state','$country');";
if ($conn->query($sql2) === TRUE)
{echo "Addresses Done!<>";}

$sql3 = "select max(aid) as aid from Addresses;";
if ($conn->query($sql3) === TRUE)
{echo "max(aid) Done!<>";}
$r1 = $conn->query($sql3);

$sql4 = "select max(pid) as pid from Patient;";
if ($conn->query($sql4) === TRUE)
{echo "max(pid) Done!<>";}
$r2 = $conn->query($sql4);

while($row = $r1->fetch_assoc()) 
{
	$t1 = $row['aid'];
}

while($row = $r2->fetch_assoc()) 
{
	$t2 = $row['pid'];
}

$sql5="insert into Patient_Addresses values('$t2','$t1');";

if ($conn->query($sql5) === TRUE) 
{
    echo "<br><br><br>You have successfully registered an account!";
}
 else 
 {
    echo "Error: " . $sql5 . "<br>" . $conn->error;
}


?>

<?php end: ?>
<br /><br />
<a href="patient-signin.html">Click here to Login!</a>

</body>


</html>