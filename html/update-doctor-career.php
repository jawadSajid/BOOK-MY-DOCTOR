<?php require('connect.php'); ?>
<html>
<head><title>Doctor Personal-Info-Update</title></head>

<body>
<?php 


$degree = $_POST['degree'];
$college = $_POST['college'];
$dop = $_POST['year'];

/*
$sp1 = $_POST['speciality1'];
$sp2 = $_POST['speciality2'];
$psp1 = $_POST['pspeciality1'];
$psp2 = $_POST['pspeciality2'];
*/

$med = $_POST['medical-reg'];
$pc = $_POST['practicing-since'];

/*
$w1 = $_POST['workplace1'];
$w2 = $_POST['workplace2'];
$pw1 = $_SESSION['pworkplace1'];
$pw2 = $_SESSION['pworkplace2'];
*/

$a1 = $_POST['award1'];
$a2 = $_POST['award2'];
$pa1 = $_SESSION['paward1'];
$pa2 = $_SESSION['paward2'];



$did = $_SESSION['doctor-id'];
$aid = $_SESSION['doctor-aid'];



$sql = "update Doc_Qualification set degree='$degree',date_of_pass='$dop',college='$college' where doc_id='$did' ;";
$r =$conn->query($sql);

$sql2 = "update Doc_Experience set practicing_since='$pc' where doc_ide='$did';";
$r2 = $conn->query($sql2);

$sql3 = "update Doc_MedReg set med_regNo='$med' where doc_idm='$did';";
$r3 =$conn->query($sql3);

header("Location: doctor-profile/doctor-profile.php");

?>

</body>
</html>