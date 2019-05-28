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
	<link rel="stylesheet"name="changecss" type="text/css" href="../css/doctor-signup.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script type="text/javascript" src="../js/doctor-signup.js"></script>
	<link rel="icon" href="../images/title.png" type="image/png">
	<title>Doctor Sign Up</title>
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
		<div class="doctor-sign-up">
			<div>
				<h1>
					Doctor Sign Up
				</h1>
			</div>
			<h2>Join Now</h2>
			<form action="insert-doctor.php" method="post">
				
				<div class="personal-info">
					<h2>
						Personal Information:
					</h2>
					<div class="name">
						<h3>Name:</h3>
						<input id="fname" type="input" placeholder="First Name" name="fname" required>
						<input id="lname" type="input" placeholder="Last Name" name="lname" required>						
					</div>
					<div class="mob-num">
						<h3>
							Mobile Nunber::
						</h3>
						<input id="mobile" type="tel" placeholder="Mobile" name="mobile" required>
					</div>
					<div class="date-of-birth">
						<h3>Date of Birth:</h3>
						<input type="date" id="dob" name="dob" required>						
					</div>
					<div class="sex">
						<h3>Sex:</h3>
						<input id="male" type="radio" name="gender" value="male" checked><label for="male">Male</label>
	  					<input id="female" type="radio" name="gender" value="female"><label for="female">Female</label>
					</div>
					<div class="email-pass">
						<div class="email">
							<h3>
								Email Address:
							</h3>
							<input id="email" type="email" name="email" placeholder="Email-id" required>
						</div>
						<div class="pass">
							<h3>
								Create a Password:
							</h3>
							<input id="password" type="password" name="password" placeholder="Password" required>
						</div>
					</div>
				</div>

				<div class="address">
					<h2>
						Adresses: 
					</h2>
					<div class="address-lines">
						<h3>
							Address Lines: 
						</h3>
						<input id="add-line-1" type="text" name="address-line-1" placeholder="Address Line 1" required>
						<input id="add-line-2" type="text" name="address-line-2" placeholder="Address Line 2">
						<input id="add-line-3" type="text" name="address-line-3" placeholder="Address Line 3">
					</div>
					<div class="post">
						<h3>
							Postal Code:
						</h3>
						<input id="postal-code" name="postal-code" placeholder="Postal Code" type="text" required>
					</div>
					<div class="town">
						<h3>
							City:
						</h3>
						<input id="city" name="city" placeholder="city" type="text" required>
						<h3>
							State/Province:
						</h3>
						<input id="state" name="state" placeholder="State" type="text" required>
						<h3>
							Country:
						</h3>
						<input id="country" name="country" placeholder="Country" type="text" required>
					</div>
				</div>

				<div class="career-info">
					<h2>
						Career Information:
					</h2>
					<div class="qualification">
						<h3>
							Qualification details:
						</h3>
						<input id="degree" type="text" name="degree" placeholder="Degree" required>
						<input id="college" type="college" name="college" placeholder="College" required>
						<label for="year-of-pass">Passing Year:</label>
						<input id="year-of-pass" type="date" name="year" placeholder="Passing Year" required>
					</div>
					<div class="doc-speciality">
						<h3>
							Speciality:
						</h3>

							<?php
								$conn = mysqli_connect("localhost", "root", "", "bookmydoctor");
								if (!$conn) 
								{
									die("Connection failed: " . mysqli_connect_error());
								}

								$query = "select spec_name from Specializations";
								$result = $conn->query($query);?>

								<select name="sp1">
								<?php
								 while($row = $result->fetch_assoc()) 
								{
								   echo '<option value="'.$row['spec_name'].'">'.$row['spec_name'].'</option>';
								}
								?>
								</select>
							
								<?php
								$conn = mysqli_connect("localhost", "root", "", "bookmydoctor");
								if (!$conn) 
								{
									die("Connection failed: " . mysqli_connect_error());
								}

								$query = "select spec_name from Specializations";
								$result = $conn->query($query);?>

								<select name="sp2">
								<?php
								 while($row = $result->fetch_assoc()) 
								{
								   echo '<option value="'.$row['spec_name'].'">'.$row['spec_name'].'</option>';
								}
								?>
								</select>
					</div>
					<div class="practicing">
						<h3>
							Experience:
						</h3>
						<label for="practicing-since">
							Practicing Since:
						</label>
						<input id="practicing-since" type="date"name="practicing-since" placeholder="Practicing Since" required>
						<input id="medical-reg" type="text" name="medical-reg" placeholder="Medical Registration Number" required>
						<input id="total-years" type="text" name="total-years" placeholder="Total Experience" required>
					</div>
					<div class="prev-worked">
						<h3>
							Previously Worked at:
						</h3>
						<input id="workplace1" type="text" name="workeplace1" placeholder="Work Place 1">
						<input id="workplace2" type="text" name="workeplace2" placeholder="Work Place 2">
					</div>
					<div class="awards">
						<h3>
							Awards:
						</h3>
						<input id="award1" type="text" name="award1" placeholder="Award 1">
						<input id="award2" type="text" name="award2" placeholder="Award 2">
					</div>

					<div class="awards">
						<h3>
							Consultation Fee:
						</h3>
						<input id="fee" type="text" name="fee" placeholder="Amount">
					</div>
				</div>

				<div class="submit">
					<input type="submit" value="Continue">	
				</div>
			</form>
		</div>
		<div class="image">
			<img src="../images/thumbs up.png">
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