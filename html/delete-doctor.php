<?php
require('connect.php');

$did = $_GET['doc-id'];


$sql1="delete from Doc_MedReg where doc_idm ='$did' ;";
$r1 = $conn->query($sql1);

$sql2="delete from Doc_Experience where doc_ide ='$did' ;";
$r2 = $conn->query($sql2);

$sql3="delete from Doc_Qualification where doc_id ='$did' ;";
$r3 = $conn->query($sql3);

$sql4="delete from Doc_Awards where doc_ida ='$did' ;";
$r4 = $conn->query($sql4);

$sql5="delete from Doc_Workplace where doc_idw ='$did' ;";
$r5 = $conn->query($sql5);

$sql6="delete from Doc_Spec_Name where doc_ids ='$did' ;";
$r6 = $conn->query($sql6);

$sql11="delete from Doc_Slots where doc_idd ='$did' ;";
$r11 = $conn->query($sql11);

$sql12="delete from Doc_NA where doc_idn ='$did' ;";
$r12 = $conn->query($sql12);

$sql13="delete from Doc_Specializations where doc_ids ='$did' ;";
$r13 = $conn->query($sql13);

$sql7 ="select add_id from Doctor_Addresses where doc_ida ='$did';";
$r7 =$conn->query($sql7);

while($row=$r7->fetch_assoc())
{
	$add_id = $row['add_id'];
}


$sql8 = "delete from Addresses where aid = '$add_id';";
$r8 = $conn->query($sql8);

$sql9 ="delete from Doctor_Addresses where doc_ida ='$did';";
$r9 =$conn->query($sql9);

$sql11= "delete from Appointments where did ='$did'";
$r11 = $conn->query($sql11);

$sql10 = "delete from Doctor where did ='$did';";
$r10 =$conn->query($sql10);

header("Location: admin/admin-panel.php");

?>