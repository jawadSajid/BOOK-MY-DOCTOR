<?php

require('connect.php');

$pid = $_GET['patient-id'];

echo $pid;

$sql7 ="select address_id from Patient_Addresses where patient_id ='$pid';";
$r7 =$conn->query($sql7);

while($row=$r7->fetch_assoc())
{
	$add_id = $row['address_id'];
}

$sql8 = "delete from Addresses where aid = '$add_id';";
$r8 = $conn->query($sql8);

$sql9 ="delete from Patient_Addresses where patient_id ='$pid';";
$r9 =$conn->query($sql9);

$sql11= "delete from Appointments where pid ='$pid'";
$r11 = $conn->query($sql11);

$sql10 = "delete from Patient where pid ='$pid';";
$r10 =$conn->query($sql10);




header("Location: admin/admin-panel.php")

?>