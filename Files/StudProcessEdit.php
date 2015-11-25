<?php
/* Updated by Douglas Lueben */

//Start the session on this page
session_start();

//Make local copies of the variables
$firstn = strtoupper($_POST["firstN"]);
$lastn = strtoupper($_POST["lastN"]);
$studid = $_SESSION["studID"];
$email = $_POST["email"];
$major = $_POST["major"];

//Connect to the database
$debug = false;
include('CommonMethods.php');
$COMMON = new Common($debug);

//If the student exists, update them!
if($_SESSION["studExist"] == true){
	$sql = "update `Proj2Students` set `FirstName` = '$firstn', `LastName` = '$lastn', `Email` = '$email', `Major` = '$major' where `StudentID` = '$studid'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
}

header('Location: 02StudHome.php');
?>