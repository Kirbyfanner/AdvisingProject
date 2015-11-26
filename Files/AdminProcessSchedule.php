<?php
/* Updated by Dan S. */

//Start the session on this page
//session_start();

//Redirect to Group Advising
if ($_POST["next"] == "Group"){
	//$_SESSION["advisor"] = $_POST["next"]; //Set the advisor name to "Group"
	header('Location: AdminScheduleGroup.php');
}

//Redirect to Individual Advising
elseif ($_POST["next"] == "Individual"){
	header('Location: AdminScheduleInd.php');
}

?>