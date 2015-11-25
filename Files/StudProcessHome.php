<?php
/* PROJ2: Updated by Douglas Lueben */

//Start the session on this page
session_start();

//Redirect to Select Type - UPDATED for Proj2
if($_POST["selection"] == 'Signup'){
	header('Location: 03StudSelectType.php');
}

//Redirect to view appointment - UPDATED for Proj2
elseif($_POST["selection"] == 'View'){
	header('Location: 04StudViewApp.php');
}

//Redirect to reschedule appt. - UPDATED for Proj2
elseif($_POST["selection"] == 'Reschedule'){
	
	/* I'm going to justify the usage of $_SESSION["resch"],
	because rescheduling an appointment is currently decided
	simply by if the user clicked the "reschedule" button
	on the home page. If I were to remove this, then we would
	have to do an additional query to Proj2Appointments to see
	if the student has an appointment on EVERY page in the
	create/reschedule section. This would lead to costly hits of
	the mysql server, and simply isn't worth it. */
	$_SESSION["resch"] = true;
	header('Location: 03StudSelectType.php');
}

//Redirect to cancel appointment - UPDATED for Proj2
elseif($_POST["selection"] == 'Cancel'){
	header('Location: 05StudCancelApp.php');
}

//Redirect to search appointment - UPDATED for Proj2
elseif($_POST["selection"] == 'Search'){
	header('Location: 09StudSearchApp.php');
}

//Redirect to edit appointment - UPDATED for Proj2
elseif($_POST["selection"] == 'Edit'){
	header('Location: 06StudEditInfo.php');
}

?>