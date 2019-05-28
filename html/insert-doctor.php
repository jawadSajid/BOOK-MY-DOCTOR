<?php require('connect.php'); ?>
<html>
<head><title>Doctor Sign-up</title></head>

<body>
<?php 

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$mobile = $_POST['mobile'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$password = $_POST['password'];
$ad1 = $_POST['address-line-1'];
$ad2 = $_POST['address-line-2'];
$ad3 = $_POST['address-line-3'];
$pc = $_POST['postal-code'];
$city = $_POST['city'];
$state = $_POST['state'];
$country = $_POST['country'];
//Qualification Details
$degree=$_POST['degree'];
$college=$_POST['college'];
$yop = $_POST['year'];
//Speciality
$spe1 = $_POST['sp1'];
$spe2 = $_POST['sp2'];
//EXP
$exp = $_POST['practicing-since'];
$med_reg=$_POST['medical-reg'];
$total_yrs=$_POST['total-years'];
//PREV WORKED AT
$w1 = $_POST['workeplace1'];
$w2 = $_POST['workeplace2'];
//AWARDS
$a1 = $_POST['award1'];
$a2 = $_POST['award2'];
//FEE
$fee = $_POST['fee'];

$sql0 = "SELECT * from Doctor";
$result = $conn->query($sql0);

if ($result->num_rows > 0) 
{
    // output data of each row
    while($row = $result->fetch_assoc()) 
	{
		$dbusername = $row['email'];
		
		if($email==$dbusername)
		{
			echo 'Email already registered!<br>';
			goto end;
		}
    }
} 


$sql = "insert into Doctor(fname,lname,dob,sex,phone_no,email,password,fee) values('$fname','$lname','$dob','$gender','$mobile','$email','$password','$fee');";

if ($conn->query($sql) === TRUE)
{echo "Doctor Done!<>";}


$sql2 = "insert into Addresses(a_line1,a_line2,a_line3,city_town,postal_code,state,country) values('$ad1','$ad2','$ad3','$city','$pc','$state','$country');";
if ($conn->query($sql2) === TRUE)
{echo "Addresses Done!<>";}

$sql3 = "select max(aid) as aid from Addresses;";
if ($conn->query($sql3) === TRUE)
{echo "max(aid) Done!<>";}
$r1 = $conn->query($sql3);

$sql4 = "select max(did) as did from Doctor;";
if ($conn->query($sql4) === TRUE)
{echo "max(did) Done!<>";}
$r2 = $conn->query($sql4);


while($row = $r1->fetch_assoc()) 
{
	$t1 = $row['aid'];
}

while($row = $r2->fetch_assoc()) 
{
	$t2 = $row['did'];
}

echo $t1."<br>".$t2;


$sql5="insert into Doctor_Addresses values('$t1','$t2');";
if ($conn->query($sql5) === FALSE)
{echo "Error: " . $sql5 . "<br>" . $conn->error;}

$sql6="insert into Doc_Qualification values('$t2','$degree','$yop','$college');";
if ($conn->query($sql6) === TRUE)
{echo "Doc_Qualification Done!<>";}

$sql7="insert into Doc_Spec_name values('$t2','$spe1');";
if ($conn->query($sql7) === TRUE)
{echo "Doc_Spec_name1 Done!<>";}

$sql8="insert into Doc_Spec_name values('$t2','$spe2');";
if ($conn->query($sql8) === TRUE)
{echo "Doc_Spec_name2 Done!<>";}

$sql9="insert into Doc_Experience values('$t2','$exp','$total_yrs');";
if ($conn->query($sql9) === TRUE)
{echo "Doc_Experience Done!<>";}

$sql10="insert into Doc_MedReg values('$t2','$med_reg');";
if ($conn->query($sql10) === TRUE)
{echo "Doc_MedReg Done!<>";}

$sql11="insert into Doc_Awards values('$t2','$a1');";
if ($conn->query($sql11) === TRUE)
{echo "Doc_Awards Done!<>";}

$sql12="insert into Doc_Awards values('$t2','$a2');";
if ($conn->query($sql12) === TRUE)
{echo "Doc_Awards Done!<>";}

$sql13="insert into Doc_Workplace values('$t2','$w1');";
if ($conn->query($sql13) === TRUE)
{echo "Doc_Workplace Done!<>";}

$sql14="insert into Doc_Workplace values('$t2','$w2');";
if ($conn->query($sql14) === TRUE)
{echo "Doc_Workplace Done!<>";}


  echo "<br><br><br>You have successfully registered an account!";

?>

<?php end: ?>
<br /><br />
<a href="doctor-signin.php">Click here to Login!</a>


</body>


</html>