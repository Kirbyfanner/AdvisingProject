<?php
/* Updated by Douglas Lueben */

//Start the session on this page
session_start();

//Redirect to Group Advising
if ($_POST["next"] == "Group"){
	header('Location: AdminScheduleGroup.php');
}

//Redirect to Individual Advising
elseif ($_POST["next"] == "Individual"){
	header('Location: AdminScheduleInd.php');
}

?>