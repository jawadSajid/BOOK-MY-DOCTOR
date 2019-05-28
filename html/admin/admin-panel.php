<?php
require('../connect.php');

if(!isset($_SESSION['admin']))
{
	header("Location: ../admin-signin.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet"name="changecss" type="text/css" href="../../css/admin/admin-panel.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script type="text/javascript" src="../../js/admin/admin-panel.js"></script>
	<link rel="icon" href="../../images/title.png" type="image/png">
	<title>Admin Panel</title>
</head>
<body>
	<header>
		<div class="header-body">
			<div class="logo">
				<a href="../../main.php"><img src="../../images/logo.png"></a>
			</div>
			<div class="sign-in-up">
				<div class="sign-up">
					<a href="../patient-profile/patient-profile.php"><img src="../../images/signup.png"><p>Welcome <?php if(isset($_SESSION['username'])){echo $_SESSION['username'];} ?></p></a>					
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
				<img src="../../images/docpng.png">
				<p>
					View All Doctors
				</p>
			</button>
			<button id="btn7">
				<img src="../../images/paitpng.png">
				<p>
					View All Patients
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
			<div id="show-docs">

				<?php

					$sql3 = "SELECT * 
      				    FROM Doctor";

					$r3 = $conn->query($sql3);
				?>

				<section class="search-doctor">

				<?php
				if ($r3->num_rows > 0) 
				{
				    while($row = $r3->fetch_assoc()) 
					{
						$doctorID = $row['did'];

						$sqlT = "select * from Doc_Qualification where doc_id = '".$row['did']."';";


						$rsqlT = $conn->query($sqlT);

						$sqlT2 = "select * from Doc_Experience where doc_ide = '".$row['did']."';";

						$rsqlT2 = $conn->query($sqlT2);

						$sqlT3 = "select * from Doc_Spec_Name where doc_ids = '".$row['did']."';";

						$rsqlT3 = $conn->query($sqlT3);


						?>
						<div class="doctors">
						<div class="personal-info">
						<div class="profile">
						<img src="../../images/profile.png">				
						</div>

						<h1>
						<?php echo $row['fname']." ".$row['lname']; ?>
						</h1>

						<div>
						<p class="p">Sex:</p>
						<p class="a"><?php 

						if($row['sex']=='M')
							echo  "Male";
						else
							echo "Female";
							 ?></p>
						</div>



						<div>
						<p class="p">Email:</p>
						<p class="a"><?php echo $row['email'] ?>  </p>
						</div>

						<div>
						<p class="p">Contact No:</p>
						<p class="a"><?php echo $row['phone_no'] ?></p>
						</div>

						

							</div>
						<div class="career-info">
							<h3>
								Career Info:
							</h3>

						<div>
						<p class="p">Consultant Fee:</p>
						<p class="a"><?php echo $row['fee']." Rs."?></p>
						</div>

							<div>
								<p class="p">Qualification:</p>
								<p class="a"><?php
								if ($rsqlT->num_rows > 0) 
								{
								    while($row = $rsqlT->fetch_assoc()) 
									{
										echo $row['degree'];
									}

								}?></p>
							</div>

							<div>
								<p class="p">Specialization:</p>
								<p class="a"><?php
								if ($rsqlT3->num_rows > 0) 
								{
								    while($row = $rsqlT3->fetch_assoc()) 
									{
										echo $row['sp_name']."<br>";

									}

								}?>
									
								</p>
							</div>

							<div>
								<p class="p">Experience:</p>
								<p class="a"><?php
								if ($rsqlT2->num_rows > 0) 
								{
								    while($row = $rsqlT2->fetch_assoc()) 
									{
										$d1 = new DateTime($row['practicing_since']);

										$d2 = new DateTime(date("Y-m-d"));

										$diff = $d2->diff($d1);

										echo $diff->y." Years";
									}

								}?></p>
							</div>

							
						</div>

						<div class="but">
							<form action="../delete-doctor.php" method="get">
								<input type="text" value="<?php echo $doctorID; ?>" name="doc-id" style="display: none;">
								<input type="submit" value="Delete User">
							</form>
						</div>
					</div>

					<?php
					}

				}

				?>

				</section>


			</div>
			<div id="show-pait">
				<section class="search-doctor">

				<?php

					$sql3 = "SELECT * 
      				    FROM Patient";

					$r3 = $conn->query($sql3);
				?>

				<section class="search-doctor">

				<?php
				if ($r3->num_rows > 0) 
				{
				    while($row = $r3->fetch_assoc()) 
					{	
						$pid = $row['pid'];

						?>

					<div class="patients">
						<div class="personal-info">
							<div class="profile">
								<img src="../../images/p-profile.png">				
							</div>

							<h1>
								<?php echo $row['fname']." ".$row['lname'] ?>
							</h1>
								<div>
								<p class="p">Sex:</p>
								<p class="a"><?php 

								if($row['sex']=='M')
									echo  "Male";
								else
									echo "Female";
									 ?></p>
								</div>



								<div>
								<p class="p">Email:</p>
								<p class="a"><?php echo $row['email'] ?>  </p>
								</div>

								<div>
								<p class="p">Contact No:</p>
								<p class="a"><?php echo $row['phone_no'] ?></p>
								</div>
								</div>
		
						<div class="but">
							<form action= "../delete-patient.php" method="get">
								<input type="text" value="<?php echo $pid; ?>" name="patient-id" style="display: none;">
								<input type="submit" value="Delete User">
							</form>
						</div>
					
					</div>

					<?php
				}
			}
			?>

				</section>
			</div>

			<div id="settings">
				<div>
					<div class="setting-tabs">
						<button id="btn4">Edit Personal Info.</button>
						<button id="btn5">Change Password</button>
					</div>
					<div class="settings-show">
						<div id="personal-info">
							<div class="change-info">
								<h2>
									Change Personal Information:
								</h2>
								<form action="update-admin.php" method="get">
									<div class="personal-info">
										<h2>
											Personal Information:
											<?php

											$sql = "select * from Admin";
											$r = $conn->query($sql);

											while($row=$r->fetch_assoc())
											{
												$fname = $row['fname'];
												$lname = $row['lname'];
												$email = $row['email'];
												$phone = $row['phone_no'];
												$dob = $row['dob'];
											}



											?>

										</h2>
										<div class="name">
											<h3>Name:</h3>
											<input id="fname" value="<?php echo $fname; ?>" type="input" placeholder="First Name" name="fname" required>
											<input id="lname" value="<?php echo $lname; ?>" type="input" placeholder="Last Name" name="lname" required>						
										</div>
										<div class="mob-num">
											<h3>
												Mobile Number:
											</h3>
											<input id="mobile" value="<?php echo $phone; ?>" type="tel" placeholder="Mobile" name="phone-no" required>
										</div>
										<div class="date-of-birth">
											<h3>Date of Birth:</h3>
											<input type="date" value="<?php echo $dob; ?>" id="dob" name="dob" required>
										</div>
										<div class="email-pass">
											<div class="email">
												<h3>
													Email Address:
												</h3>
												<input id="email" value="<?php echo $email; ?>" type="email" name="email" placeholder="Email-id" required>
											</div>
											
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
								<form action="change-passadmin.php" method="post">
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
					<a href="../search by/doc name.html">Doctor Name</a>
				</li>
				<li>
					<a href="../search by/doc gender.html">Doctor Gender</a>
				</li>
				<li>
					<a href="../search by/doc location.html">Location</a>
				</li>
				<li>
					<a href="../search by/doc experience.html">Experience</a>
				</li>
			</ul>
		</div>
		<div class="search-speciality">
			<h1>
				Speciality :
			</h1>
			<ul>
				<li>
					<a href="../search by/doc speciality.html">Neurology</a>
				</li>
				<li>
					<a href="../search by/doc speciality.html">Cardiology</a>
				</li>
				<li>
					<a href="../search by/doc speciality.html">Allergists</a>
				</li>
				<li>
					<a href="../search by/doc speciality.html">Heart</a>
				</li>
			</ul>
		</div>
	</footer>

</body>
</html>