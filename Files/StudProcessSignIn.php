<?php
/* Updated by Douglas Lueben */

//Start the session on the page
session_start();

//Convert post variables to session variables 
$_SESSION["firstN"] = strtoupper($_POST["firstN"]);
$_SESSION["lastN"] = strtoupper($_POST["lastN"]);
$_SESSION["studID"] = strtoupper($_POST["studID"]);
$_SESSION["email"] = $_POST["email"];
$_SESSION["major"] = $_POST["major"];

//Redirect to 02StudHome.php
header('Location: 02StudHome.php');
?>