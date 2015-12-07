<?php
/* PROJ2: Updated by Douglas Lueben */

session_start(); //Here for the student ID

/* Pull the "session variables"
This is a simple fix, and could definitely be done with less
repetition if an entire re-write of the website was possible.
But, to save time, we'll pull all of the information at the top
of the page to save time */
$debug = false;

//Connect to the database
include('CommonMethods.php');
$COMMON = new Common($debug);

$studID = $studID;

$sql = "select * from Proj2Students where `StudentID` = '$studID'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);

$firstN = $row[1];
$lastN = $row[2];
$email = $row[4];
$major = $row[5];
$status = $row[6];

?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>TEST - Edit Student Information</title>
	<link rel='stylesheet' type='text/css' href='css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
	  
			<!-- Edit your student information -->
			<div class="top">
			<h2>Edit Student Information<span class="login-create"></span></h2>
			<form action="StudProcessEdit.php" method="post" name="Edit">
			
			<!-- First Name -->
			<div class="field">
				<label for="firstN">First Name</label>
				<input id="firstN" size="30" maxlength="50" type="text" name="firstN" required value=<?php echo $firstN?>>
			</div>
			
			<!-- Last Name -->
			<div class="field">
			  <label for="lastN">Last Name</label>
			  <input id="lastN" size="30" maxlength="50" type="text" name="lastN" required value=<?php echo $lastN?>>
			</div>
			
			<!-- Student ID -->
			<div class="field">
				<label for="studID">Student ID</label>
				<input id="studID" size="30" maxlength="7" type="text" pattern="[A-Za-z]{2}[0-9]{5}" title="AB12345" name="studID" disabled value=<?php echo $studID?>>
			</div>
			
			<!-- Email -->
			<div class="field">
				<label for="email">E-mail</label>
				<input id="email" size="30" maxlength="255" type="email" name="email" required value=<?php echo $email?>>
			</div>
			
			<!-- Major -->
			<div class="field">
				  <label for="major">Major</label>
				  <select id="major" name = "major">
					<option <?php if($major == 'CMPE'){echo("selected");}?> value="CMPE">Computer Engineering</option>
					<option <?php if($major == 'CMSC'){echo("selected");}?> value="CMSC">Computer Science</option>
					<option <?php if($major == 'MENG'){echo("selected");}?>value="MENG">Mechanical Engineering</option>
					<option <?php if($major == 'CENG'){echo("selected");}?>value="CENG">Chemical Engineering</option>
					</select>
			</div>
			<div class="nextButton">
				<input type="submit" name="save" class="button large go" value="Save">
			</div>
			</div>
		</form>
  </body>
  <?php include("footer.html"); ?>
  
</html>
