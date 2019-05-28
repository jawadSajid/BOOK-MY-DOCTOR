<?php
require('connect.php');

if(!isset($_SESSION['username']))
{
	header("Location: signin.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet"name="changecss" type="text/css" href="../css/search-doc.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script type="text/javascript" src="../js/search-doc.js"></script>
	<link rel="icon" href="../images/title.png" type="image/png">
	<title>Search Doctor</title>
</head>
<body>
	<header>
		<div class="header-body">
			<div class="logo">
				<a href="../main.php"><img src="../images/logo.png"></a>
			</div>
			<div class="sign-in-up">
				<div class="sign-up">
					<a href="signup.html"><img src="../images/signup.png"><p>Welcome <?php if(isset($_SESSION['username'])){echo $_SESSION['username'];} ?></p></a>					
				</div>
				<div class="sign-in">
					<a href="logout.php"><img src="../images/signin.png"><p>Logout</p></a>					
				</div>

			</div>
		</div>
	</header>
				
			<?php

				if($_GET['speciality']=='default'&& $_GET['doc-gender']=='default' &&  $_GET['symptom']=='default' && empty($_GET['city']))
				{
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
						<img src="../images/profile.png">				
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
						<form action="../calendar.php" method="get">
							<input id="did" type="text" name="doctor-id" placeholder="Book Now" 
							value="<?php echo $doctorID; ?>" >
							</input>
							<input type="submit" value="Book Doctor">
						</form>
						</div>
					</div>

					<?php
					}

				}

				?>

				</section>

				<?php	
				}

				else
				{

				$speciality = $_GET['speciality'];
				$gender = $_GET['doc-gender'];
				$city = $_GET['city'];
				$symptom = $_GET['symptom'];

				$a1 = array();
				$a2 = array();
				$symp_spec="";

				if($symptom!='default')
				{
					$sqlx= "select sp_name from Symptoms where symp_name = '$symptom';";

					$rx = $conn->query($sqlx);

					if ($rx->num_rows > 0) 
					{
					    while($row = $rx->fetch_assoc()) 
						{
							$symp_spec = $row['sp_name'];
						}

					}

					$noSymptom=false;
				}
				else
					$noSymptom=true;


				if($speciality!='default')
				{
					$sql = "select doc_ids from Doc_Spec_Name where sp_name='$speciality' or sp_name='$symp_spec';";

					$r1 = $conn->query($sql);

					if ($r1->num_rows > 0) 
					{
					    while($row = $r1->fetch_assoc()) 
						{
							$a1[] = $row['doc_ids'];
						}

					}

					$noSpeciality=false;
				}
				else if($speciality=='default' && $noSymptom==false)
				{
					$sql = "select doc_ids from Doc_Spec_Name where sp_name='$symp_spec';";

					$r1 = $conn->query($sql);

					if ($r1->num_rows > 0) 
					{
					    while($row = $r1->fetch_assoc()) 
						{
							$a1[] = $row['doc_ids'];
						}

					}

					$noSpeciality=false;
				}
				else
				{
					$noSpeciality=true;
				}


				if(!empty($_GET['city']) && $noSpeciality==false)
				{
					$sql2 = "select DA.doc_ida as did from Addresses A join Doctor_Addresses DA where
						A.aid = DA.add_id and A.city_town = '$city';";
					
					$r2 = $conn->query($sql2);

					if ($r2->num_rows > 0) 
					{
					    while($row = $r2->fetch_assoc()) 
						{
							if(in_array($row['did'], $a1))
							{
								$a2[] = $row['did'];
							}
						}

					}


					$noCity=false;
				}
				else if(!empty($_GET['city']) && $noSpeciality==true)
				{

					$sql2 = "select DA.doc_ida as did from Addresses A join Doctor_Addresses DA where
						A.aid = DA.add_id and A.city_town = '$city';";
					
					$r2 = $conn->query($sql2);

					if ($r2->num_rows > 0) 
					{
						while($row = $r2->fetch_assoc()) 
						{
							$a2[] = $row['did'];
						}
					}

					$noCity=false;
				}

				else if(empty($_GET['city']))
				{
					$noCity=true;
				}


				if($noCity==false)
				{
					if($gender!='default')
					{
						$sql3 = "SELECT * 
	      				    FROM Doctor
	       				  WHERE did IN (".implode(',',$a2).") and (sex = '$gender');";
       				}

       				else
       				{
       					$sql3 = "SELECT * 
	      				    FROM Doctor
	       				  WHERE did IN (".implode(',',$a2).");";
       				}
       			}
       			else if($noCity==true && $noSpeciality==false)
       			{

       				if($gender!='default')
					{
						$sql3 = "SELECT * 
	      				    FROM Doctor
	       				  WHERE did IN (".implode(',',$a1).") and (sex = '$gender');";
       				}

       				else
       				{
       					$sql3 = "SELECT * 
	      				    FROM Doctor
	       				  WHERE did IN (".implode(',',$a1).");";
       				}

       			}

       			else
       			{

       				$sql3 = "Select * from Doctor where sex='$gender';";
       			}

       			if ($conn->query($sql3) == TRUE)
				{	
					$r3 = $conn->query($sql3);
					$noDoc=false;
				}

				else
					goto end;

				?>

				<section class="search-doctor">

				<?php
				if ($r3->num_rows > 0) 
				{
				    while($row = $r3->fetch_assoc()) 
					{

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
						<img src="../images/profile.png">				
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
							
						</div>

						<div class="but">
						<form action="../calendar.php" method="get">
							<input id="did" type="text" name="doctor-id" placeholder="Book Now" 
							value="<?php echo $doctorID; ?>" >
							</input>
							<input type="submit" value="Book Doctor">
						</form>
						</div>
					</div>

					<?php
					}

				}
			}
				?>

				</section>
			

			<p class="p"><?php 
			goto skip; 
			end: echo "No Doctor Found!";
			skip: ?></p>


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