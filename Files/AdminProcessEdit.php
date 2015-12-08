<?php
/* Updated by Douglas Lueben */

//Start the session for this page
session_start();

//Redirect to Group Advising
if ($_POST["next"] == "Group"){
	header('Location: AdminEditGroup.php');
}

//Redirect to Individual Advising
elseif ($_POST["next"] == "Individual"){
	header('Location: AdminEditInd.php');
}

?>