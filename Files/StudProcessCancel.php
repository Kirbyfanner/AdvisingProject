<?php
/* Updated by Douglas Lueben */

//Start the session on this page
session_start();

//Connect to the database
$debug = false;
include('CommonMethods.php');
$COMMON = new Common($debug);

//If we're cancelling the appt...
if($_POST["cancel"] == 'Cancel'){
	
	//Store local copies of session vars
	$firstn = $_SESSION["firstN"];
	$lastn = $_SESSION["lastN"];
	$studid = $_SESSION["studID"];
	$major = $_SESSION["major"];
	$email = $_SESSION["email"];
	
	//remove stud from EnrolledID
	$sql = "select * from Proj2Appointments where `EnrolledID` like '%$studid%'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	$row = mysql_fetch_row($rs);
	$oldAdvisorID = $row[2];
	$oldAppTime = $row[1];
	$newIDs = str_replace($studid, "", $row[4]);
	
	//Remove the student from the appointment
	$sql = "update `Proj2Appointments` set `EnrolledNum` = EnrolledNum-1, `EnrolledID` = '$newIDs' where `AdvisorID` = '$oldAdvisorID' and `Time` = '$oldAppTime'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	
	//update stud status to noApp
	$sql = "update `Proj2Students` set `Status` = 'N' where `StudentID` = '$studid'";
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