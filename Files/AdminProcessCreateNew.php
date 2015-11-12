<?php
/* Updated by Douglas Lueben */

//Start the session on this page
session_start();

//Turn the post variables into session variables
$_SESSION["AdvF"] = $_POST["firstN"];
$_SESSION["AdvL"] = $_POST["lastN"];
$_SESSION["AdvUN"] = $_POST["UserN"];
$_SESSION["AdvPW"] = $_POST["PassW"];
$_SESSION["OfficeL"] = $_POST["OfficeL"];
$_SESSION["PassCon"] = false;

//If the passwords match, go create the advisor
if($_POST["PassW"] == $_POST["ConfP"]){
	header('Location: AdminCreateNew.php');
}

//If the passwords don't match, go back and fix it
elseif($_POST["PassW"] != $_POST["ConfP"]){
	$_SESSION["PassCon"] = true;
	header('Location: AdminCreateNewAdv.php');
}

?>