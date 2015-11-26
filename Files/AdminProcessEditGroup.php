<?php
/* Updated by Dan S. */

//Starts the session for the page
//session_start();

//Set up Session variables
//$_SESSION["GroupApp"] = $_POST["GroupApp"];
//$_SESSION["Delete"] = false;

//Delete the appointment
if ($_POST["next"] == "Delete Appointment"){
	//$_SESSION["Delete"] = true;
	//$_SESSION["advisor"] = $_POST["next"];
	header('Location: AdminConfirmEditGroup.php');
}

//Edit the appointment
elseif ($_POST["next"] == "Edit Appointment"){
	header('Location: AdminProceedEditGroup.php');
}

?>