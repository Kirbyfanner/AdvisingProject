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
		
		<!-- Display a "Sorry" message -->
	    <div class="statusMessage">
		Someone JUST took that appointment before you. Please find another available appointment.
        </div>
		
		<!-- Go home -->
		<form action="02StudHome.php" method="post" name="complete">
		<div class="returnButton">
			<input type="submit" name="return" class="button large go" value="Return to Home">
	    </div>
		</div>
		</form>
  </body>
</html>