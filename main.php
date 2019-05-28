<?php
require('connect.php');

if(isset($_SESSION['doctor-id']))
{
	header("Location: html/doctor-profile/doctor-profile.php");
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet"name="changecss" type="text/css" href="css/main.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
	<script type="text/javascript" src="js/main.js"></script>
	<link rel="icon" href="images/title.png" type="image/png">
	<title>Book My Doctor</title>
</head>
<body>

<?php
if(!isset($_SESSION['username']))
{
	goto notLogged;
}
?>

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
<?php goto skip?>
<?php notLogged:?>
	<header>
		<div class="header-body">
			<div class="logo">
				<a href="main.php"><img src="images/logo.png"></a>
			</div>
			<div class="sign-in-up">
				<div class="sign-up">
					<a href="html/signup.php"><img src="images/signup.png"><p>Sign Up</p></a>					
				</div>
				<div class="sign-in">
					<a href="html/signin.php"><img src="images/signin.png"><p>Sign In</p></a>					
				</div>

			</div>
		</div>
	</header>
<?php skip:?>
	
	<section class="back">	
	</section>

	<section class="find-doc">
		<div class="find-doc-title">
			<div class="its-free">
				<p>It's Free !</p>
			</div>
			<div class="title">
				<h1>Find a Doctor and Schedule an Appointment</h1>
			</div>			
		</div>
		<div class="find-doc-body">
			
			<div class="selection">
				<div class="get-start">
					<h2>
						Get Started
					</h2>
				</div>
				<form action="html/search-doc.php" method="get">
					<div>
						<div class="speciality">
							<?php

								$query = "select spec_name from Specializations";
								$result = $conn->query($query);

								echo '<select name="speciality">'; 
								echo '<option value="default">Select Speciality</option>' ;

								 while($row = $result->fetch_assoc()) 
								{
								   echo '<option value="'.$row['spec_name'].'">'.$row['spec_name'].'</option>';
								}

								echo '</select>';
							?>
						</div>
						<div class="doc-gender">
							<select name="doc-gender">
								<option value="default">Doctor's Gender</option>
								<option value="M">Male</option>
								<option value="F">Female</option>
							</select>
						</div>
					</div>

					<div>					
						<div class="reason">
								<?php
								$query = "select symp_name from Symptoms";
								$result = $conn->query($query);

								echo '<select name="symptom">';
								echo '<option value="default">Select Symptom</option>' ;
								 while($row = $result->fetch_assoc()) 
								{
								   echo '<option value="'.$row['symp_name'].'">'.$row['symp_name'].'</option>';
								}

								echo '</select>';
							?>
						</div>
						<div class="location">
							<label for="loc">In:</label>
							<input id="loc" type="text" name="city" placeholder="City Name">
						</div>
					</div>

					<div>
						<input type="submit" value="Find Doctor">
					</div>

				</form>
			</div>
		</div>
	</section>

	<section class="slider">
		
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
					
				</tr>
				<tr>
					<td>
						<img src="images/mail.png">	
					</td>
					<td>
						<p>bookmydoc@gmail.com</p>
					</td>
				</tr>
				<tr>
					<td>
						<img src="images/phone.png">
					</td>
					<td>
						<p>+92-320-1498318</p>
					</td>
				</tr>
				<tr>
					<td>
						<img src="images/home.png">
					</td>
					<td>
						<p>Address: Rehman Arcade, Near UCP</p>
					</td>
					
					
				</tr>
				<tr>
				
						
					
			</table>
			<p>Site Developed by: Mujadad Rao (Back-end) & Bilal Sajid (Front-end)</p>
			<p>Mobile app coming in next course (MAD) !</p>

		</div>
		<div class="search-by">
			<h1>
				Search By :
			</h1>
			<ul>
				<li>
					<a href="html/search by/doc name.php">Doctor Name</a>
				</li>
				<li>
					<a href="html/search by/doc gender.php">Doctor Gender</a>
				</li>
				<li>
					<a href="html/search by/doc location.php">Location</a>
				</li>
				<li>
					<a href="html/search by/doc experience.php">Experience</a>
				</li>
			</ul>
		</div>
		<div class="search-speciality">
			<h1>
				Speciality :
			</h1>
			<ul>
				<li>
					<a href="html/search by/doc speciality.php">Cardiologist</a>
					<?php $_SESSION['doc-spec']='Cardiologist (Heart Doctor)'?>
				</li>
				<li>
					<a href="html/search by/doc speciality.php">Dentist</a>
					<?php $_SESSION['doc-spec']='Dentist'?>
				</li>
				<li>
					<a href="html/search by/doc speciality.php">Dermatologist</a>
					<?php $_SESSION['doc-spec']='Dermatologist'?>
				</li>
				<li>
					<a href="html/search by/doc speciality.php">Allergist</a>
					<?php $_SESSION['doc-spec']='Allergist (Immunologist)'?>
				</li>
			</ul>
		</div>
	</footer>


</body>
</html>

