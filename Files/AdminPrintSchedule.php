<?php
/* Updated by Douglas Lueben */

//Start the session for this page
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Print Schedule</title>
	<link rel = 'stylesheet' type='text/css' href='css/standard.css' />
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		      <h1>Print Schedule</h1>
          <form action="AdminPrintResults.php" method="post" name="Confirm">
		  
			<!-- Select date to see schedule for -->
	         <div class="field">
	     	     <label for="date">Date</label>
             <input id="date" type="date" name="date" placeholder="mm/dd/yyyy" required autofocus> (mm/dd/yyyy)
	         </div>

			 <!-- Select type of appt. Group/Individual -->
	         <div class="field">
        		<label for="Type">Type of Appointment</label>
            <select id="type" name = "type">
					<option>Both</option>
        			<option>Individual</option>
        			<option>Group</option>
        		</select>
	         </div>

	         <br>

    	    <div class="nextButton">
    			<input type="submit" name="next" class="button large go" value="Next">
        </form>
	</div>
	</div>
	<?php include('./workOrder/workButton.php'); ?>

  </body>
  <?php include("footer.html"); ?>
</html>
