<?php

//Start Session for this page
session_start();

//Set up a connection to the database
include('CommonMethods.php');
$debug = false;
$Common = new Common($debug);

//Turn the $_POST variables into $_SESSION variables
$_SESSION["UserN"] = strtoupper($_POST["UserN"]);
$_SESSION["PassW"] = strtoupper($_POST["PassW"]);
$_SESSION["FirstN"] = "";
$_SESSION["UserVal"] = false;

//Make local copies of the $_SESSION variables
$user = $_SESSION["UserN"];
$pass = $_SESSION["PassW"];

//See if the advisor login actually works
$sql = "SELECT * FROM `Proj2Advisors` WHERE `Username` = '$user' AND `Password` = '$pass'";
$rs = $Common->executeQuery($sql, "Advising Appointments");
$row = mysql_fetch_row($rs);

//If we found a match, login!
if($row){
	
	//Store the advisor's name
	$_SESSION["FirstN"] = $row[1];
	
	//Dump vars if in debug
	if($debug) { echo("<br>".var_dump($_SESSION)."<- Session variables above<br>"); }
	
	//Forward to AdminUI.php
	else { header('Location: AdminUI.php'); }
}

//If there was no match, go back to the login page
else{
	$_SESSION["UserVal"] = true;
	header('Location: AdminSignIn.php'); 
}

?>