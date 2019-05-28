<?php
session_start();

include('php/connect.php'); 


if(isset($_POST['slots_booked'])) $slots_booked = mysqli_real_escape_string($link, $_POST['slots_booked']);
if(isset($_POST['name'])) $name = mysqli_real_escape_string($link, $_POST['name']);
if(isset($_POST['email'])) $email = mysqli_real_escape_string($link, $_POST['email']);
if(isset($_POST['phone'])) $phone = mysqli_real_escape_string($link, $_POST['phone']);
if(isset($_POST['booking_date'])) $booking_date = mysqli_real_escape_string($link, $_POST['booking_date']);
if(isset($_POST['cost_per_slot'])) $cost_per_slot = mysqli_real_escape_string($link, $_POST['cost_per_slot']);
if(isset($_POST['doc-id'])) $did=mysqli_real_escape_string($link,$_POST['doc-id']);
if(isset($_POST['patient-id'])) $pid=mysqli_real_escape_string($link,$_POST['patient-id']);

$booking_array = array(
	"slots_booked" => $slots_booked,	
	"booking_date" => $booking_date,
	"cost_per_slot" => number_format($cost_per_slot, 2),
	"name" => $name,
	"email" => $email,
	"phone" => $phone,
);

$explode = explode('|', $slots_booked);

foreach($explode as $slot) {

	if(strlen($slot) > 0) {

		$stmt = $link->prepare("INSERT INTO appointments (pid,did, date, start, name, email, phone) VALUES ('$pid','$did', ?, ?, ?, ?, ?)"); 
		$stmt->bind_param('sssss', $booking_date, $slot, $name, $email, $phone);
		$stmt->execute();
		
	} // Close if
	
} // Close foreach

print_r('<pre>');
print_r($booking_array);
print_r('</pre>');

header("Location: calendar.php");

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Booking Confirmed</title>
<link href="style.css" rel="stylesheet" type="text/css">

<link href="http://fonts.googleapis.com/css?family=Droid+Serif" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>

</head>

<body>

<div class='success'>The booking has been made into the database.</div>

<p style='font-family:courier; font-size:13px; margin-top:25px'>
The booking has been inserted into the database.<br>
The array above shows you details of the $_POST.<br>
</p>

<p style='font-family:courier; font-size:13px; margin-top:25px'>
You might want to use this page to: 
</p>

<ul style='font-family:courier; font-size:13px'>
	<li>Redirect the user to a payment gateway (Paypal)</li>
	<li>Simply show a confirmation page</li>
	<li>Integrate with your basket</li>
</ul>

</body>

</html>
