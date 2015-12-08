<?php
/* Updated by Douglas Lueben */

//Start the session on the page
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Create New Admin</title>
	<link rel='stylesheet' type='text/css' href='css/standard.css'/>
  </head>
   <body>
    <div id="login">
      <div id="form">
        <div class="top">
		<h2>Create New Advisor Account</h2>
	
		<!-- Create Account Form -->
		<form action="AdminProcessCreateNew.php" method="post" name="Create">
		<div class="field">
		
				<!-- First Name -->
	      		<label for="firstN">First Name</label>
	      		<input id="firstN" size="20" maxlength="50" type="text" name="firstN" required autofocus>
	    	</div>

				<!-- Last Name -->
	    	<div class="field">
	     		<label for="lastN">Last Name</label>
	      		<input id="lastN" size="20" maxlength="50" type="text" name="lastN" required>
	   	</div>	

				<!-- User name -->
		<div class="field">
	     		<label for="UserN">Username</label>
	      		<input id="UserN" size="20" maxlength="50" type="text" name="UserN" required>
	   	</div>	 

				<!-- Password -->
		<div class="field">
	     		<label for="PassW">Password</label>
	      		<input id="PassW" size="20" maxlength="50" type="password" name="PassW" required>
	   	</div>	

				<!-- Confirm password -->
		<div class="field">
	     		<label for="ConfP">Confirm Password</label>
	      		<input id="ConfP" size="20" maxlength="50" type="password" name="ConfP" required>
	   	</div>	
		
		<div class ="field">
				<label for="UserN">Office Location</label>
	      		<input id="UserN" size="20" maxlength="50" type="text" name="OfficeL" required>
		</div>
		<br>

		<!-- Create advisor -->
		<div class="nextButton">
			<input type="submit" name="next" class="button large go" value="Submit">
	    </div>
		</form>
		
		<!-- Cancel -->
		<form method="link" action="AdminUI.php">
			<input type="submit" name="home" class="button large" value="Cancel">
		</form>

	</div>
	</div>
	</div>
  </body>
  <?php include("footer.html"); ?>
</html>
