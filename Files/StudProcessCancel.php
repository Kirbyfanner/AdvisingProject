<?php
/* PROJ2: Updated by Douglas Lueben */

session_start(); //Here for the student ID

/* Pull the "session variables"
This is a simple fix, and could definitely be done with less
repetition if an entire re-write of the website was possible.
But, to save time, we'll pull all of the information at the top
of the page to save time */
$debug = false;

//Connect to the database
include('CommonMethods.php');
$COMMON = new Common($debug);

$studID = $_SESSION["studID"];

$sql = "select * from Proj2Students where `StudentID` = '$studID'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);

$firstN = $row[1];
$lastN = $row[2];
$email = $row[4];
$major = $row[5];
$status = $row[6];

//If we're cancelling the appt...
if($_POST["cancel"] == 'Cancel'){
	
	//remove stud from EnrolledID
	$sql = "select * from Proj2Appointments where `EnrolledID` like '%$studID%'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	$row = mysql_fetch_row($rs);
	$oldAdvisorID = $row[2];
	$oldAppTime = $row[1];
	$newIDs = str_replace($studID, "", $row[4]);
	
	//Remove the student from the appointment
	$sql = "update `Proj2Appointments` set `EnrolledNum` = EnrolledNum-1, `EnrolledID` = '$newIDs' where `AdvisorID` = '$oldAdvisorID' and `Time` = '$oldAppTime'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	
	//update stud status to noApp
	$sql = "update `Proj2Students` set `Status` = 'N' where `StudentID` = '$studID'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	
	$_SESSION["status"] = "cancel";
}

//Otherwise, we kept it woo
else{
	$_SESSION["status"] = "keep";
}

//Redirect to 12StudExit.php
header('Location: 12StudExit.php');
?>