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

	<header>
		<div class="header-body">
			<div class="logo">
				<a href="main.html"><img src="images/logo.png"></a>
			</div>
			<div class="sign-in-up">
				<div class="sign-up">
					<a href="#"><img src="images/signup.png"><p>Sign Up</p></a>					
				</div>
				<div class="sign-in">
					<a href="html/signin.html"><img src="images/signin.png"><p>Sign In</p></a>					
				</div>

			</div>
		</div>
	</header>

	<section class="back">	
	</section>

	<section class="find-doc">
		<div class="find-doc-title">
			<div class="its-free">
				<p>It's Free !</p>
			</div>
			<div class="title">
				<h1>Find a Doctor and shedule an appointment</h1>
			</div>			
		</div>
		<div class="find-doc-body">
			
			<div class="selection">
				<div class="get-start">
					<h2>
						Get Started
					</h2>
				</div>
				<form>
					<div>
						<div class="speciality">
							<select name="speciality">
								<option value="speciality">Speciality</option>
								<option value="a">a</option>
								<option value="b">b</option>
								<option value="c">c</option>
							</select>
						</div>
						<div class="doc-gender">
							<select name="doc-gender">
								<option value="doctorgender">Doctor's Gender</option>
								<option value="a">a</option>
								<option value="b">b</option>
								<option value="c">c</option>
							</select>
						</div>
					</div>

					<div>					
						<div class="reason">
							<select name="reason">
								<option value="reason">Reason to Visit</option>
								<option value="a">a</option>
								<option value="b">b</option>
								<option value="c">c</option>
							</select>
						</div>
						<div class="location">
							<label for="loc">In:</label>
							<input id="loc" type="text" name="city" placeholder="City Name">
						</div>
					</div>

					<div>
						<input type="submit">
					</div>

				</form>
			</div>
		</div>
	</section>

	<section class="slider">
		<div class="w3">
			<img class="mySlides w3-animate-right" src="images/1.jpg">
			<img class="mySlides w3-animate-left" src="images/2.jpg">
			<img class="mySlides w3-animate-top" src="images/5.jpg">
			<img class="mySlides w3-animate-bottom" src="images/4.jpg">
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
						<img src="images/mail.png">	
					</td>
					<td>
						<p>book_my_doctor@gmail.com</p>
					</td>
				</tr>
				<tr>
					<td>
						<img src="images/phone.png">
					</td>
					<td>
						<p>+92324-4545454</p>
					</td>
				</tr>
				<tr>
					<td>
						<img src="images/home.png">
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
					<a href="#">Doctor Name</a>
				</li>
				<li>
					<a href="#">Doctor Gender</a>
				</li>
				<li>
					<a href="#">Location</a>
				</li>
				<li>
					<a href="#">Experience</a>
				</li>
			</ul>
		</div>
		<div class="search-speciality">
			<h1>
				Speciality :
			</h1>
			<ul>
				<li>
					<a href="#">Neurology</a>
				</li>
				<li>
					<a href="#">Cardiology</a>
				</li>
				<li>
					<a href="#">Allergists</a>
				</li>
				<li>
					<a href="#">Heart</a>
				</li>
			</ul>
		</div>
	</footer>


</body>
</html>

