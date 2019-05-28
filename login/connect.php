<?php
//We start sessions
session_start();

/******************************************************
------------------Required Configuration---------------
Please edit the following variables so the members area
can work correctly.
******************************************************/
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "BookMyDoctor";
//We log to the DataBase
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) 
{
    die("Connection failed: " . mysqli_connect_error());
}


//Webmaster Email
$mail_webmaster = 'query@bookmydoc.com';

//Top site root URL
$url_root = 'localhost/bookymdoc/main.php';

/******************************************************
-----------------Optional Configuration----------------
******************************************************/

//Home page file name
$url_home = 'main.php';

//Design Name
$design = 'default';
?>