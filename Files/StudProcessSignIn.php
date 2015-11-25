<?php
/* PROJ2: Updated by Douglas Lueben */

/* Since we no longer use Session vars (hah)
we need to update the database with all of this
information so that we can just run a query on
every single page to meet the project's
requirements. */

//Though we're totally saving the studID at least
session_start();
$_SESSION["studID"] = strtoupper($_POST["studID"]);

//See if we already have a student in the database.
include('CommonMethods.php');
$COMMON = new Common($debug);

$id = $_SESSION["studID"];
$sql = "select * from Proj2Students where `StudentID` = '$id'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);

//If the row is empty, then the student hasn't logged in before
if(empty($row))
{
	//So, update the db with their information
	$firstName = strtoupper($_POST["firstN"]);
	$lastName = strtoupper($_POST["lastN"]);
	$email = $_POST["email"];
	$major = $_POST["major"];
	
	$insertSql = "insert into `Proj2Students` (`FirstName`, `LastName`,
	`StudentId`, `Email`, `Major`) VALUES ('$firstName', 
	'$lastName', '$id', '$email', '$major')";
	$COMMON->executeQuery($insertSql, $_SERVER["SCRIPT_NAME"]);
}


//Redirect to 02StudHome.php
header('Location: 02StudHome.php');
?>