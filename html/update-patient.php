<?php require('connect.php'); ?>
<html>
<head><title>Patient Info-Update</title></head>

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
$pid = $_SESSION['patient-id'];
$aid = $_SESSION['patient-aid'];

echo $pid;
echo $aid;


$sql = "update Patient set fname='$fname',lname='$lname',phone_no='$mobile',dob='$dob',email='$email' where pid='$pid' ;";

if ($conn->query($sql) == TRUE)
{echo "Patient Done!<>";}

$sql2 = "update Addresses set a_line1='$ad1',a_line2='$ad2',a_line3='$ad3',city_town='$city',postal_code='$pc',state='$state',country='$country' where aid = '$aid';";
if ($conn->query($sql2) == TRUE)
{echo "Addresses Done!<>";}

header("Location: patient-profile/patient-profile.php");

?>

</body>
</html>