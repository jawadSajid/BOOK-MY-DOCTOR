<?php

require('../connect.php');

$fname = $_GET['fname'];
$lname = $_GET['lname'];
$phone_no =$_GET['phone-no'];
$dob = $_GET['dob'];
$email = $_GET['email'];

$sql = "update Admin set fname='$fname',lname='$lname',dob='$dob',email='$email',phone_no='$phone_no';";

$r = $conn->query($sql);


header("Location: admin-panel.php");

?>