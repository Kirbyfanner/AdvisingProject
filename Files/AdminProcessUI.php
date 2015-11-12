<?php
/* Updated by Douglas Lueben */

//Start the session for this page
session_start();

//Schedule Appt.
if($_POST["next"] == 'Schedule appointments'){
	header('Location: AdminScheduleApp.php');
}

//Print Schedule
elseif($_POST["next"] == 'Print schedule for a day'){
	header('Location: AdminPrintSchedule.php');
}

//Edit Appt.
elseif($_POST["next"] == 'Edit appointments'){
	header('Location: AdminEditApp.php');
}

//Search for an appt
elseif($_POST["next"] == 'Search for an appointment'){
	header('Location: AdminSearchApp.php');
}

//Create new Advisor
elseif($_POST["next"] == 'Create new Admin Account'){
	header('Location: AdminCreateNewAdv.php');
}

?>