<?php
/* Updated by Douglas Lueben */

//Start the session on this page
session_start();
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Exit Message</title>
	<link rel='stylesheet' type='text/css' href='css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
	    <div class="statusMessage">
	    <?php
			$_SESSION["resch"] = false;			
			
			//The appt. went through
			if($_SESSION["status"] == "complete"){
				echo "You have completed your sign-up for an advising appointment.";
			}
			
			//The student decided not to
			elseif($_SESSION["status"] == "none"){
				echo "You did not sign up for an advising appointment.";
			}
			
			//The appointment was cancelled
			if($_SESSION["status"] == "cancel"){
				echo "You have cancelled your advising appointment.";
			}
			
			//The appt. was changed
			if($_SESSION["status"] == "resch"){
				echo "You have changed your advising appointment.";
			}
			
			//The appt. was left alone
			if($_SESSION["status"] == "keep"){
				echo "No changes have been made to your advising appointment.";
			}
		?>
        </div>
		<form action="02StudHome.php" method="post" name="complete">
		
		<!-- Return Home -->
	    <div class="returnButton">
			<input type="submit" name="return" class="button large go" value="Return to Home">
	    </div>
		</div>
		</form>
  </body>
</html>