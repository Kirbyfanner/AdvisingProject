<?php
/* Updated by Dan S */

//Start the session for this page
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Schedule Individual Appointment</title>
	<link rel='stylesheet' type='text/css' href='css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		    <h1>Schedule Individual Appointments</h1>
        <form action="AdminConfirmScheIndApp.php" method="post" name="Confirm">
	    <div class="field">
	      <label for="Date">Date</label>

		<!-- Remember to change the min for each semester! -->
	      <input id="Date" type="date" name="Date" placeholder="mm/dd/yyyy" min="2015-08-01" required autofocus> (mm/dd/yyyy)
	    </div>

	    <div class="field">
		
		<!-- Time of the appointment -->
	      <label for="Time">Times</label>
        <input type="checkbox" name="time[]" value="08:00:00"> 8:00AM - 8:30AM <br>
        <input type="checkbox" name="time[]" value="08:30:00"> 8:30AM - 9:00AM <br>
        <input type="checkbox" name="time[]" value="09:00:00"> 9:00AM - 9:30AM <br>
        <input type="checkbox" name="time[]" value="09:30:00"> 9:30AM - 10:00AM <br>
        <input type="checkbox" name="time[]" value="10:00:00"> 10:00AM - 10:30AM <br>
        <input type="checkbox" name="time[]" value="10:30:00"> 10:30AM - 11:00AM <br> 
        <input type="checkbox" name="time[]" value="11:00:00"> 11:00AM - 11:30AM <br>
        <input type="checkbox" name="time[]" value="11:30:00"> 11:30AM - 12:00PM <br>
        <input type="checkbox" name="time[]" value="12:00:00"> 12:00PM - 12:30PM <br>
        <input type="checkbox" name="time[]" value="12:30:00"> 12:30PM - 1:00PM <br>
        <input type="checkbox" name="time[]" value="13:00:00"> 1:00PM - 1:30PM <br>
        <input type="checkbox" name="time[]" value="13:30:00"> 1:30PM - 2:00PM <br>
        <input type="checkbox" name="time[]" value="14:00:00"> 2:00PM - 2:30PM <br>
        <input type="checkbox" name="time[]" value="14:30:00"> 2:30PM - 3:00PM <br>
        <input type="checkbox" name="time[]" value="15:00:00"> 3:00PM - 3:30PM <br>
        <input type="checkbox" name="time[]" value="15:30:00"> 3:30PM - 4:00PM <br>
	     
	    </div>

      <div class="field">
	  <!-- Majors allowed for the appointment -->
        <label for="Majors">Majors</label>
          <input type="checkbox" name="major[]" value="CMPE" checked>Computer Engineering
          <input type="checkbox" name="major[]" value="CMSC" checked>Computer Science
          <input type="checkbox" name="major[]" value="MENG" checked>Mechanical Engineering
          <input type="checkbox" name="major[]" value="CENG" checked>Chemical Engineering
      </div>

        <div class="field">
		<!-- What days a week it repeats for -->
            <label for="Repeat">Repeat Weekly</label>
            <input type="checkbox" name="repeat[]" value="Monday">Monday
            <input type="checkbox" name="repeat[]" value="Tuesday">Tuesday
            <input type="checkbox" name="repeat[]" value="Wednesday">Wednesday
            <input type="checkbox" name="repeat[]" value="Thursday">Thursday
            <input type="checkbox" name="repeat[]" value="Friday">Friday
        </div>

        <div class="field">
		<!-- How many weeks this repeats for -->
        	<h3>Repeat for
        	<input type="number" id="stepper" name="stepper" min="0" max="4" value="0" />
		      more week(s)</h3>
        </div>
		
		<div class="field">
		<!-- Meeting Location  -->
        	<h3>Meeting Location<br>
        	<input type="text" id="room" name="room" /></h3>
        </div>
		
	    <div class="nextButton">
		<!-- Create the appointment -->
			<input type="submit" name="next" class="button large go" value="Create">
	</div>
	</div>
	</form>
	
	<!-- Back Out -->
	<form method="link" action="AdminUI.php" name="home">
		<input type="submit" name="next" class="button large go" value="Return to Home">
	</form>
	<?php include('./workOrder/workButton.php'); ?>

  </body>
  <?php include("footer.html"); ?>
  
</html>
