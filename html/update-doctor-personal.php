<?php require('connect.php'); ?>
<html>
<head><title>Doctor Personal-Info-Update</title></head>

<body>
<?php 


$fname = $_POST['fname'];
$lname = $_POST['lname'];
$mobile = $_POST['mobile'];
$dob = $_POST['dob'];
$ad1 = $_POST['address-line-1'];
$ad2 = $_POST['address-line-2'];
$ad3 = $_POST['address-line-3'];
$pc = $_POST['postal-code'];
$city = $_POST['city'];
$state = $_POST['state'];
$country = $_POST['country'];
$did = $_SESSION['doctor-id'];
$aid = $_SESSION['doctor-aid'];

$sql = "update Doctor set fname='$fname',lname='$lname',phone_no='$mobile',dob='$dob',email='$email' where did='$did' ;";

if ($conn->query($sql) == TRUE)
{echo "Doctor Done!<>";}

$sql2 = "update Addresses set a_line1='$ad1',a_line2='$ad2',a_line3='$ad3',city_town='$city',postal_code='$pc',state='$state',country='$country' where aid = '$aid';";
if ($conn->query($sql2) == TRUE)
{echo "Addresses Done!<>";}

header("Location: doctor-profile/doctor-profile.php");

?>

</body>
</html>