<?php
/* Updated by Dan S. */

//Start the session for this page
//session_start();

//Redirect to Group Advising
if ($_POST["next"] == "Group"){
	//$_SESSION["advisor"] = $_POST["next"]; //Set the advisor name to "Group"
	header('Location: AdminEditGroup.php');
}

//Redirect to Individual Advising
elseif ($_POST["next"] == "Individual"){
	header('Location: AdminEditInd.php');
}

?>