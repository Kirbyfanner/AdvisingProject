<?php
/* Updated by Douglas Lueben */
/* Get Session Variables */
session_start();
$flag = false;

/* If a student is logged in, redirect them to 01StudSignIn.html 
	Otherwise, they'll go to StudentAdminSignIn.html */
if(isset($_SESSION['studID'])) { $flag = true; }

/* Release the session, clearing all $_SESSION variables */
session_unset();
session_destroy();

/* Redirect to where the user should go based on if they're a student */
if($flag) { header("Location: 01StudSignIn.html"); }
else { header("Location: StudentAdminSignIn.html"); }

?>