<?php

require('connect.php');

if(isset($_SESSION['username']))
{
	header("Location: ../main.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet"name="changecss" type="text/css" href="../css/signup.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script type="text/javascript" src="../js/signup.js"></script>
	<link rel="icon" href="../images/title.png" type="image/png">
	<title>Sign Up</title>
</head>
<body>
	<header>
		<div class="header-body">
			<div class="logo">
				<a href="../main.php"><img src="../images/logo.png"></a>
			</div>
			<div class="sign-in-up">
				<div class="sign-up">
					<a href="signup.php"><img src="../images/signup.png"><p>Sign Up</p></a>					
				</div>
				<div class="sign-in">
					<a href="signin.php"><img src="../images/signin.png"><p>Sign In</p></a>					
				</div>

			</div>
		</div>
	</header>


	<section>
		<div class="join-now">
			<h2>
				Join Now
			</h2>
			<img src="../images/doc.png">
		</div>
		<div class="pat-doc">
			<div class="patient">
				<h2>
					I'am a new Patient
				</h2>
				<p>
					Find a doctor and book an appointmentonline for free !
				</p>
				<a href="patient-signup.php"><button>Join Now</button></a>
			</div>
			<div class="doctor">
				<h2>
					I'am a new Doctor
				</h2>
				<p>
					Quicker way for your patient to schedule an appointment, register with Book My Doctor !
				</p>
				<a href="doctor-signup.php"><button>Join Now</button></a>
			</div>
		</div>
	</section>




	<footer>
		<div class="about">
			<h1>
				Our Location :
			</h1>

			<table>
				<tr>
					<td>
						
					</td>
					<td>
						<p>Make appointments on the go, right from this web</p>
						<p>Mobile app coming soon !</p>
					</td>
				</tr>
				<tr>
					<td>
						<img src="../images/mail.png">	
					</td>
					<td>
						<p>book_my_doctor@gmail.com</p>
					</td>
				</tr>
				<tr>
					<td>
						<img src="../images/phone.png">
					</td>
					<td>
						<p>+92324-4545454</p>
					</td>
				</tr>
				<tr>
					<td>
						<img src="../images/home.png">
					</td>
					<td>
						<p>Address: 123, ABC street, XYZ town, Pakistan</p>
					</td>
				</tr>
			</table>

		</div>
		<div class="search-by">
			<h1>
				Search By :
			</h1>
			<ul>
				<li>
					<a href="search by/doc experience.php">Doctor Name</a>
				</li>
				<li>
					<a href="search by/doc gender.php">Doctor Gender</a>
				</li>
				<li>
					<a href="search by/doc location.php">Location</a>
				</li>
				<li>
					<a href="search by/doc experience.php">Experience</a>
				</li>
			</ul>
		</div>
		<div class="search-speciality">
			<h1>
				Speciality :
			</h1>
			<ul>
				<li>
					<a href="search by/doc speciality.php">Neurology</a>
				</li>
				<li>
					<a href="search by/doc speciality.php">Cardiology</a>
				</li>
				<li>
					<a href="search by/doc speciality.php">Allergists</a>
				</li>
				<li>
					<a href="search by/doc speciality.php">Heart</a>
				</li>
			</ul>
		</div>
	</footer>
</body>
</html>