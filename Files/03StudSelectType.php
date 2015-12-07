<?php
/* Updated by Douglas Lueben */

//Start the session for this page
session_start();
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Select Advising Type</title>
	<link rel='stylesheet' type='text/css' href='css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		
		<!-- Choose the type of appointment you want (Group/Individual) -->
		<h1>Schedule Appointment</h1>
		<h2>What kind of advising appointment would you like?</h2><br>
	<form action="StudProcessType.php" method="post" name="SelectType">
	<div class="nextButton">
	
		<!-- Individual -->
		<center>
		<input type="submit" name="type" class="button large go" value="Individual">
		<br/>
		
		<!-- Next Available (added by Douglas Lueben) -->
		<input type="submit" name="type" class="button large go" value="Next Available">
		<br/>
		
		<!-- Group -->
		<input type="submit" name="type" class="button large go" value="Group">
		</center>
	    </div>
		</div>
		</form>


<br>
<br>

		<!-- Cancel -->
		<div>		
		<form method="link" action="02StudHome.php">
		<input type="submit" name="home" class="button large" value="Cancel">
		</form>
		</div>
  </body>
  <?php include("footer.html"); ?>
</html>