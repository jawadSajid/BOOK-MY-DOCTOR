<?php
	require('../connect.php');

	if(!isset($_SESSION['patient-id']))
{
	header("Location: ../patient-signin.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet"name="changecss" type="text/css" href="../../css/search by/doc speciality.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script type="text/javascript" src="../../js/search by/doc speciality.js"></script>
	<link rel="icon" href="../../images/title.png" type="image/png">
	<title>Search by Doctor Speciality</title>
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
		<h2>
			Find Doctors by Speciality
		</h2>
		
		<div class="search-by-speciality">
			<form method="get">
				<div class="speciality">
				<h3>
				Search by Speciality:
				</h3>
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
				<div class="search">
					<input type="submit" value="Search">
				</div>
			</form>
		</div>


		<div>
		<section class="search-doctor">
			 <?php
			 	if(empty($_GET['speciality']))
			 	{
			 		goto end;

			 	}

				if($_GET['speciality']!='default')
				{

					$temp = array();
					$spec=$_GET['speciality'];
					$sqlx = "SELECT doc_ids as did from Doc_Spec_Name where sp_name='$spec';";
					
					$rsqlx = $conn->query($sqlx);

					if ($rsqlx->num_rows > 0) 
					{
					    while($row = $rsqlx->fetch_assoc()) 
						{

							$temp[] = $row['did'];
						}
					}	

					$sql = "SELECT * from Doctor where did IN (".implode(',',$temp).");";

					$r3 = $conn->query($sql);

				if ($r3->num_rows > 0) 
				{
				    while($row = $r3->fetch_assoc()) 
					{
						$doctorID =$row['did'];

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

						<form action="../../calendar.php" method="get">
							<input id="did" type="text" name="doctor-id" style="display:none;" placeholder="Book Now" 
							value="<?php echo $doctorID; ?>" >
							
							<input type="submit" value="Book Doctor">
						</form>
					</div>

					<?php
					}

				}

			}
			end:
			?>

				</section>
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
					<a href="doc name.php">Doctor Name</a>
				</li>
				<li>
					<a href="doc gender.php">Doctor Gender</a>
				</li>
				<li>
					<a href="doc location.php">Location</a>
				</li>
				<li>
					<a href="doc experience.php">Experience</a>
				</li>
			</ul>
		</div>
		<div class="search-speciality">
			<h1>
				Speciality :
			</h1>
			<ul>
				<li>
					<a href="doc speciality.php">Neurology</a>
				</li>
				<li>
					<a href="doc speciality.php">Cardiology</a>
				</li>
				<li>
					<a href="doc speciality.php">Allergists</a>
				</li>
				<li>
					<a href="doc speciality.php">Heart</a>
				</li>
			</ul>
		</div>
	</footer>
</body>
</html>	