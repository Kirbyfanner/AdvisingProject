<?php
/* Updated by Douglas Lueben */

//Start the session on this page
session_start();

//Redirect to Select Type
if($_POST["selection"] == 'Signup'){
	header('Location: 03StudSelectType.php');
}

//Redirect to view appointment
elseif($_POST["selection"] == 'View'){
	header('Location: 04StudViewApp.php');
}

//Redirect to reschedule appt.
elseif($_POST["selection"] == 'Reschedule'){
	$_SESSION["resch"] = true;
	header('Location: 03StudSelectType.php');
}

//Redirect to cancel appointment
elseif($_POST["selection"] == 'Cancel'){
	header('Location: 05StudCancelApp.php');
}

//Redirect to search appointment
elseif($_POST["selection"] == 'Search'){
	header('Location: 09StudSearchApp.php');
}

//Redirect to edit appointment
elseif($_POST["selection"] == 'Edit'){
	header('Location: 06StudEditInfo.php');
}

?>