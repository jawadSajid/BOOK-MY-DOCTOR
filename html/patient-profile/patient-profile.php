<?php
	require('../../connect.php');

	if(!isset($_SESSION['patient-id']))
{
	header("Location: ../patient-signin.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet"name="changecss" type="text/css" href="../../css/patient-profile/patient-profile.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script type="text/javascript" src="../../js/patient-profile/patient-profile.js"></script>
	<link rel="icon" href="../../images/title.png" type="image/png">
	<title>Patient Profile</title>
</head>
<body>
<header>
	<div class="header-body">
		<div class="logo">
			<a href="../../main.php"><img src="../../images/logo.png"></a>
		</div>
		<div class="sign-in-up">
			<div class="sign-up">

				<?php if($_SESSION['userid'] == 1){}
						else {goto doc;}
				 ?>
						
				<a href="../patient-profile/patient-profile.php"><img src="../../images/signup.png"><p>Welcome <?php if(isset($_SESSION['username'])){echo $_SESSION['username'];} ?></p>
				</a>	
				<?php goto skip1; ?>

				<?php doc: ?>
				<a href="../doctor-profile/doctor-profile.php"><img src="../../images/signup.png"><p>Welcome <?php if(isset($_SESSION['username'])){echo $_SESSION['username'];} ?></p>
				</a>	
				<?php skip1: ?>				
			</div>
			<div class="sign-in">
				<a href="../logout.php"><img src="../../images/signin.png"><p>Logout</p></a>					
			</div>

		</div>
	</div>
</header>
	<section>
		<div class="main-tabs">
			<button id="btn1">
				<img src="../../images/calendar.png">
				<p>
					Appointments
				</p>
			</button>
			<button id="btn2">
				<img src="../../images/settings.png">
				<p>
					Settings
				</p>
			</button>
			<button id="btn3">
				<img src="../../images/logout.png">
				<p>
					Logout
				</p>
			</button>
		</div>
		<div class="to-show">
			<div id="appointment">
				<?php
				$pid = $_SESSION['patient-id'];

				$sql = "select * from Appointments where pid = '$pid';";

				$r = $conn->query($sql);

				while($row=$r->fetch_assoc())
				{
					echo "<br>Doctor ID: ".$row['did']."<br>";
					echo "Date: ".$row['date']."<br>";
					echo "Time: ".$row['start']."<br><br><br><br><br>";
				}
			?>
			</div>
			<div id="settings">
				<div>
					<div class="setting-tabs">
						<button id="btn4">Edit Personal Info</button>
						<button id="btn5">Change Password</button>
					</div>
					<div class="settings-show">
						<div id="personal-info">
							<div class="change-info">
								<h2>
									Change Personal Information:
								</h2>
								<form action="../update-patient.php" method="post">
									<div class="personal-info">
										<div class="name">
											<h3>Name:</h3>

											<?php 
											$pid = $_SESSION['patient-id'];
											$sql = "select * from Patient where pid = '$pid';";
											$rquery = $conn->query($sql);

											while($row = $rquery->fetch_assoc()) 
											{
											   $fname = $row['fname'];
											   $lname = $row['lname'];
											   $dob = $row['dob'];
											   $phone_no = $row['phone_no'];
											   $email = $row['email'];
											}

											$sql2 = "select * from Patient_Addresses PA join Addresses A ON PA.patient_id = A.aid where PA.patient_id='$pid';";
											$rquery2 = $conn->query($sql2);

											while($row = $rquery2->fetch_assoc()) 
											{
											   $_SESSION['patient-aid']=$row['aid'];
											   $a_line1 = $row['a_line1'];
											   $a_line2 = $row['a_line2'];
											   $a_line3 = $row['a_line3'];
											   $city_town = $row['city_town'];
											   $postal_code = $row['postal_code'];
											   $state = $row['state'];
											   $country = $row['country'];

											}

											 ?>

											<input id="fname" type="input" placeholder="First Name" name="fname" value= "<?php echo $fname; ?>">
											<input id="lname" type="input" placeholder="Last Name" name="lname" value="<?php echo $lname; ?>" required>						
										</div>
										<div class="mob-num">
											<h3>
												Mobile Nunber:
											</h3>
											<input id="mobile" type="text" placeholder="Mobile" name="mobile" value="<?php echo $phone_no; ?>" required>
										</div>
										<div class="date-of-birth">
											<h3>Date of Birth:</h3>
											<input type="date" id="dob" name="dob" value="<?php echo $dob; ?>" required>
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
											<input id="add-line-1" type="text" name="address-line-1" placeholder="Address Line 1" value="<?php echo $a_line1; ?>" required>
											<input id="add-line-2" type="text" name="address-line-2" placeholder="Address Line 2" value="<?php echo $a_line2; ?>">
											<input id="add-line-3" type="text" name="address-line-3" placeholder="Address Line 3" value="<?php echo $a_line3; ?>">
										</div>
										<div class="post">
											<h3>
												Postal Code:
											</h3>
											<input id="postal-code" name="postal-code" placeholder="Postal Code" type="text" value="<?php echo $postal_code; ?>"required>
										</div>
										<div class="town">
											<h3>
												City:
											</h3>
											<input id="city" name="city" placeholder="city" type="text" value="<?php echo $city_town; ?>" required>
											<h3>
												State/Province:
											</h3>
											<input id="state" name="state" placeholder="State" type="text" value="<?php echo $state; ?>" required>
											<h3>
												Country:
											</h3>
											<input id="country" name="country" placeholder="Country" type="text" value="<?php echo $country; ?>" required>
										</div>
									</div>
									<div class="submit">
										<input type="submit" value="Save And Update Information">	
									</div>
								</form>
							</div>
						</div>
						<div id="password">
							<div class="change-pass">
								<h2>
									Change Password:
								</h2>
								<form action="change-passpatient.php" method="post">
									<div>
										<label for="old-pass">Old Password:</label>
										<input id="old-pass" placeholder="Old Password" name="old-pass" type="password">
									</div>
									<div>
										<label for="new-pass">New Password:</label>
										<input id="new-pass" placeholder="New Password" name="new-pass" type="password">
									</div>
									<div>
										<label for="confirm-pass">Confirm Password</label>
										<input id="confirm-pass" placeholder="Confirm Password" name="confirm-pass" type="password">
									</div>
									<div>
										<input type="submit" value="Change Password">
									</div>
								</form>	
							</div>

						</div>
					</div>
				</div>

			</div>
			<div id="logout">
				<div>
					<h3>Logout</h3>
					<p>
						<a href="../logout.php"><label for="log">Are you sure you want to logout: </label><button id="log">Logout</button></a>
					</p>					
				</div>

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
						<img src="../../images/mail.png">	
					</td>
					<td>
						<p>book_my_doctor@gmail.com</p>
					</td>
				</tr>
				<tr>
					<td>
						<img src="../../images/phone.png">
					</td>
					<td>
						<p>+92324-4545454</p>
					</td>
				</tr>
				<tr>
					<td>
						<img src="../../images/home.png">
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
					<a href="../search by/doc name.php">Doctor Name</a>
				</li>
				<li>
					<a href="../search by/doc gender.php">Doctor Gender</a>
				</li>
				<li>
					<a href="../search by/doc location.php">Location</a>
				</li>
				<li>
					<a href="../search by/doc experience.php">Experience</a>
				</li>
			</ul>
		</div>
		<div class="search-speciality">
			<h1>
				Speciality :
			</h1>
			<ul>
				<li>
					<a href="../search by/doc speciality.php">Neurology</a>
				</li>
				<li>
					<a href="../search by/doc speciality.php">Cardiology</a>
				</li>
				<li>
					<a href="../search by/doc speciality.php">Allergists</a>
				</li>
				<li>
					<a href="../search by/doc speciality.php">Heart</a>
				</li>
			</ul>
		</div>
	</footer>
</body>
</html>	