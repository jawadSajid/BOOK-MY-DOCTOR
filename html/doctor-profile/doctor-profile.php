<?php
	require('../../connect.php');

if(!isset($_SESSION['doctor-id']))
{
	header("Location: ../doctor-signin.php");
}


?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet"name="changecss" type="text/css" href="../../css/doctor-profile/doctor-profile.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script type="text/javascript" src="../../js/doctor-profile/doctor-profile.js"></script>
	<link rel="icon" href="../../images/title.png" type="image/png">
	<title>Doctor Profile</title>
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
					<a> Appointments </a>
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
				$did = $_SESSION['doctor-id'];

				$sql = "select * from Appointments where did = '$did';";

				$r = $conn->query($sql);

				while($row=$r->fetch_assoc())
				{
					echo "<br>Patient ID: ".$row['pid']."<br>";
					echo "Date: ".$row['date']."<br>";
					echo "Time: ".$row['start']."<br><br><br><br><br>";
				}


			?>
			</div>
			<div id="settings">
				<div>
					<div class="setting-tabs">
						<button id="btn4">Edit Personal Info.</button>
						<button id="btn6">Edit Career Info.</button>
						<button id="btn5">Change Password</button>
					</div>
					<div class="settings-show">
						<div id="personal-info">
							<div class="change-info">
								<h2>
									Change Personal Information:
								</h2>
								<form action="../update-doctor-personal.php" method="post">
									<div class="personal-info">
										<h2>
											Personal Information:
										</h2>
										<div class="name">
											<h3>Name:</h3>

											<?php 
											$did = $_SESSION['doctor-id'];
											$sql = "select * from Doctor where did = '$did';";
											$rquery = $conn->query($sql);

											$a_line1='Empty';
											$a_line2='Empty';
											$a_line3='Empty';
											$postal_code='Empty';
											$city_town='Empty';
											$state='Empty';
											$country='Empty';

											while($row = $rquery->fetch_assoc()) 
											{
											   $fname = $row['fname'];
											   $lname = $row['lname'];
											   $dob = $row['dob'];
											   $phone_no = $row['phone_no'];
											   $email = $row['email'];
											}

											$sql2 = "select * from Doctor_Addresses DA join Addresses A ON DA.add_id = A.aid where DA.doc_ida='$did';";
											$rquery2 = $conn->query($sql2);

											while($row = $rquery2->fetch_assoc()) 
											{
											   $_SESSION['doctor-aid']=$row['aid'];
											   $a_line1 = $row['a_line1'];
											   $a_line2 = $row['a_line2'];
											   $a_line3 = $row['a_line3'];
											   $city_town = $row['city_town'];
											   $postal_code = $row['postal_code'];
											   $state = $row['state'];
											   $country = $row['country'];

											}

											$sql3="select * from Doc_Qualification where doc_id = '$did';";
											$rquery3 = $conn->query($sql3);

											while($row=$rquery3->fetch_assoc())
											{
												$degree = $row['degree'];
												$dop = $row['date_of_pass'];
												$college = $row['college'];
											}

											$sql4="select * from Doc_Experience where doc_ide ='$did';";
											$rquery4 = $conn->query($sql4);

											while($row = $rquery4->fetch_assoc())
											{
												$pc=$row['practicing_since'];
												$tc=$row['total_years'];
											}

											$awards=array();
									//		$workplace[0] = 'NULL';
									//		$workplace[1] = 'NULL';

											$sql10= "select * from Doc_Awards where doc_ida='$did';";

											$rquery10 = $conn->query($sql10);

											while($row=$rquery10->fetch_assoc())
											{
												$awards[] = $row['award'];

											}

											$workplace=array();
									//		$workplace[0] = 'NULL';
									//		$workplace[1] = 'NULL';

											$sql6= "select * from Doc_Workplace where doc_idw='$did';";

											$rquery6 = $conn->query($sql6);

											while($row=$rquery6->fetch_assoc())
											{
												$workplace[] = $row['workplace'];

											}

											$specs = array();
									//		$specs[0] = 'Select a Speciality';
								//			$specs[1] = 'Select a Speciality';
											$sql7 = "select * from Doc_Spec_Name where doc_ids = '$did';";

											$rquery7 = $conn->query($sql7);

											while($row=$rquery7->fetch_assoc())
											{
												$specs[] = $row['sp_name'];

											}

											$sql8 = "select * from Doc_MedReg where doc_idm = '$did'; ";
											$rquery8 = $conn->query($sql8);

											while($row=$rquery8->fetch_assoc())
											{
												$medreg = $row['med_regNo'];
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
										<div class="email">
											<h3>
												Email Address:
											</h3>
											<input id="email" type="email" name="email" placeholder="Email-id" value="<?php echo $email; ?>" required>
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
						<div id="career-info">
							<div class="career-info">
								<h2>
									Career Information:
								</h2>
								<form action="../update-doctor-career.php" method="post">
									<div class="qualification">
										<h3>
											Qualification details:
										</h3>
										<input id="degree" value="<?php echo $degree; ?>" type="text" name="degree" placeholder="Degree" required>
										<input id="college" value="<?php echo $college; ?>" type="college" name="college" placeholder="College" required>
										<label for="year-of-pass">Passing Year:</label>
										<input id="year-of-pass" value="<?php echo $dop; ?>" type="date" name="year" placeholder="Passing Year" required>
									</div>
									<div class="doc-speciality">
										<h3>
											Speciality:
										</h3>

								<?php

								$query = "select spec_name from Specializations";
								$result = $conn->query($query);

								echo '<select name="speciality1">'; 

								if(isset($specs[0]))
								{	echo '<option value="default">'.$specs[0].'</option>' ;
									$_SESSION['pspeciality1'] = $specs[0];
								}

								else
									echo '<option value="default">Select a speciality</option>' ;


								 while($row = $result->fetch_assoc()) 
								{
								   echo '<option value="'.$row['spec_name'].'">'.$row['spec_name'].'</option>';
								}

								echo '</select>';
								?>


								<?php

								$query = "select spec_name from Specializations";
								$result = $conn->query($query);

								echo '<select name="speciality2">'; 

								if(isset($specs[1]))
								{	echo '<option value="default">'.$specs[1].'</option>' ;
									$_SESSION['pspeciality2'] = $specs[1];
								}

								else
									echo '<option value="default">Select a speciality</option>' ;


								while($row = $result->fetch_assoc()) 
								{
								   echo '<option value="'.$row['spec_name'].'">'.$row['spec_name'].'</option>';
								}

								echo '</select>';
								?>


									</div>
									<div class="practicing">
										<h3>
											Experience:
										</h3>
										<label for="practicing-since">
											Practicing Since:
										</label>
										<input id="practicing-since" type="date" value="<?php echo $pc; ?>" name="practicing-since" placeholder="Practicing Since" required>
										<label for="medical-reg">
										Medical Registration Number:
										</label>
										<input id="medical-reg" type="text" value="<?php echo $medreg; ?>" name="medical-reg" placeholder="Medical Registration Number" required>
									</div>
									<div class="prev-worked">
										<h3>
											Previously Worked at:
										</h3>
										<input id="workplace1" type="text" name="workeplace1" placeholder="Work Place 1" value="<?php 

										if(isset($workplace[0]))
										{	
											echo $workplace[0];
											$_SESSION['pworkplace1'] = $workplace[0];
										}

										 ?>">
										<input id="workplace2" type="text" name="workeplace2" placeholder="Work Place 2" value="<?php 

										if(isset($workplace[1]))
										{	
											echo $workplace[1];
											$_SESSION['pworkplace12'] =$workplace[1];
										}
										 ?>">
									</div>
									<div class="awards">
										<h3>
											Awards:
										</h3>
										<input id="award1" type="text" name="award1" placeholder="Award 1" value="<?php
										 
										 if(isset($awards[0]))
										{
											echo $awards[0]; 
											$_SESSION['paward1'] =$awards[0];
										}

										?>" required>
										<input id="award2" type="text" name="award2" placeholder="Award 2" value="<?php 
										
										if(isset($awards[1]))
										{	echo $awards[1]; 
											$_SESSION['paward2'] =$awards[1];
										}

										?>">
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
								<form action="change-passdoc.php" method="post">
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