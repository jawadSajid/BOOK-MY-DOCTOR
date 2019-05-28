<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookmydoctor";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) 
{
    die("Connection failed: " . mysqli_connect_error());
}

//Webmaster Email
$mail_webmaster = 'query@bookmydoc.com';

//Top site root URL
$url_root = 'localhost/bookymdoc/main.php';

//Home page file name
$url_home = 'main.php';

//Design Name
$design = 'default';
?>