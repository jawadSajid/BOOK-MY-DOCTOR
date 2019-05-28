<?php
session_start();

if(isset($_GET['doctor-id']))
{
	$_SESSION['doc-id'] = $_GET['doctor-id'];
	$p = $_SESSION['doc-id'];
}


header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

require('php/connect.php'); 
include('classes/class_calendar.php');


$calendar = new booking_diary($link);

if(isset($_GET['month'])) $month = $_GET['month']; else $month = date("m");
if(isset($_GET['year'])) $year = $_GET['year']; else $year = date("Y");
if(isset($_GET['day'])) $day = $_GET['day']; else $day = 0;

// Unix Timestamp of the date a user has clicked on
$selected_date = mktime(0, 0, 0, $month, 01, $year); 

// Unix Timestamp of the previous month which is used to give the back arrow the correct month and year 
$back = strtotime("-1 month", $selected_date); 

// Unix Timestamp of the next month which is used to give the forward arrow the correct month and year 
$forward = strtotime("+1 month", $selected_date);

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Calendar</title>
<link href="style.css" rel="stylesheet" type="text/css">

<link href="http://fonts.googleapis.com/css?family=Droid+Serif" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>

<script type="text/javascript">

var check_array = [];

$(document).ready(function(){

	$(".fields").click(function(){
	
		dataval = $(this).data('val');
	
		// Show the Selected Slots box if someone selects a slot
		if($("#outer_basket").css("display") == 'none') { 
			$("#outer_basket").css("display", "block");
		}

		if(jQuery.inArray(dataval, check_array) == -1) {
			check_array.push(dataval);
		} else {
			// Remove clicked value from the array
			check_array.splice($.inArray(dataval, check_array) ,1);	
		}
		
		slots=''; hidden=''; basket = 0;
		
		cost_per_slot = $("#cost_per_slot").val();
		//cost_per_slot = parseFloat(cost_per_slot).toFixed(2)

		for (i=0; i< check_array.length; i++) {
			slots += check_array[i] + '\r\n';
			hidden += check_array[i].substring(0, 8) + '|';
			basket = (basket + parseFloat(cost_per_slot));
		}
		
		// Populate the Selected Slots section
		$("#selected_slots").html(slots);
		
		// Update hidden slots_booked form element with booked slots
		$("#slots_booked").val(hidden);		

		// Update basket total box
		basket = basket.toFixed(2);
		$("#total").html(basket);	

		// Hide the basket section if a user un-checks all the slots
		if(check_array.length == 0)
		$("#outer_basket").css("display", "none");
		
	});
	
	
	$(".classname").click(function(){
	
		msg = '';
	
		if($("#name").val() == '')
		msg += 'Please enter a Name\r\n';

		if($("#email").val() == '')
		msg += 'Please enter an Email address\r\n';

		if($("#phone").val() == '')
		msg += 'Please enter a Phone number\r\n';	

		if(msg != '') {
			alert(msg);
			return false;
		}

	});

	// Firefox caches the checkbox state.  This resets all checkboxes on each page load 
	$('input:checkbox').removeAttr('checked');
	
});


</script>

<link rel="stylesheet"name="changecss" type="text/css" href="css/main.css"/>
	
	<link rel="icon" href="images/title.png" type="image/png">
	<title>Doctor's Booking</title>
</head>
<body>
<header>
	<div class="header-body">
		<div class="logo">
			<a href="main.php"><img src="images/logo.png"></a>
		</div>
		<div class="sign-in-up">
			<div class="sign-up">

				<?php if($_SESSION['userid'] == 1){}
						else {goto doc;}
				 ?>
						
				<a href="html/patient-profile/patient-profile.php"><img src="images/signup.png"><p>Welcome <?php if(isset($_SESSION['username'])){echo $_SESSION['username'];} ?></p>
				</a>	
				<?php goto skip1; ?>

				<?php doc: ?>
				<a href="html/doctor-profile/doctor-profile.php"><img src="images/signup.png"><p>Welcome <?php if(isset($_SESSION['username'])){echo $_SESSION['username'];} ?></p>
				</a>	
				<?php skip1: ?>				
			</div>
			<div class="sign-in">
				<a href="html/logout.php"><img src="images/signin.png"><p>Logout</p></a>					
			</div>

		</div>
	</div>
</header>
<?php     
        
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $calendar->after_post($month, $day, $year);  
}   

// Call calendar function
$calendar->make_calendar($selected_date, $back, $forward, $day, $month, $year);

?>
</body>
</html>
