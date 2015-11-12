<?php 
//Start a session for this page
session_start();
$debug = false;

//Dump all session variables if we're in debug mode
if($debug) { echo("Session variables-> ".var_dump($_SESSION)); }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Admin Home</title>
	<link rel='stylesheet' type='text/css' href='css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
	<h2> Hello 
	<?php

	if(!isset($_SESSION["UserN"])) // someone landed this page by accident
	{
		return;
	}		
	
		//Print the advisor's name as a greeting
		echo $_SESSION["FirstN"];
	?>
	</h2>
	
	<!-- Options -->
	<form action="AdminProcessUI.php" method="post" name="UI">
		<!-- Schedule Appt. -->
		<input type="submit" name="next" class="button large selection" value="Schedule appointments"><br>
		
		<!-- Print Sched. -->
		<input type="submit" name="next" class="button large selection" value="Print schedule for a day"><br>
		
		<!-- Edit Appt. -->
		<input type="submit" name="next" class="button large selection" value="Edit appointments"><br>
		
		<!-- Search Appt. -->
		<input type="submit" name="next" class="button large selection" value="Search for an appointment"><br>
		
		<!-- Create Admin -->
		<input type="submit" name="next" class="button large selection" value="Create new Admin Account"><br>
	</form>
	<br>

	<!-- Logout button -->
	<form method="link" action="Logout.php">
		<input type="submit" name="next" class="button large go" value="Log Out">
	</form>
          
        </div>
	</div>

	<?php include('./workOrder/workButton.php'); ?>

</body>
  
</html>
