<?php
/* Updated by Douglas Lueben */

//Starts the session on this page
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Schedule Appointment</title>
	<link rel='stylesheet' type='text/css' href='css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
	<h1>Schedule Appointments</h1>
	<h2>Select advising type</h2><br>
	
	<form method="post" action="AdminProcessSchedule.php">
	
	<!-- Individual or Group? -->
	<div class="nextButton">
		<input type="submit" name="next" class="button large go" value="Individual">
		<input type="submit" name="next" class="button large go" value="Group" style="float: right;">
	</div>
	</form>
        </div>
	</div>
		</form>
		
		<!-- Cancel -->
		<form method="link" action="AdminUI.php">
		<input type="submit" name="home" class="button large" value="Cancel">
		</form>
   	</div>
	</div>

		
  </body>
  
</html>
