<?php
/* Updated by Douglas Lueben */

//Start the session on the current page
session_start();

//Connect to the database
$debug = false;
include('CommonMethods.php');
$COMMON = new Common($debug);

/* Get the student's information */

//Prepare the SQL query
$sql = "SELECT * FROM `Proj2Students` WHERE (`StudentID` = '";
$sql .= $_SESSION["studID"];
$sql .= "')";

//Fetch the row
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

//Parse the row for information
$row = (mysql_fetch_row($rs));
$_SESSION["firstN"] = $row[1];
$_SESSION["lastN"] = $row[2];
$_SESSION["email"] = $row[4];
$_SESSION["major"] = $row[5];

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
				<input id="firstN" size="30" maxlength="50" type="text" name="firstN" required value=<?php echo $_SESSION["firstN"]?>>
			</div>
			
			<!-- Last Name -->
			<div class="field">
			  <label for="lastN">Last Name</label>
			  <input id="lastN" size="30" maxlength="50" type="text" name="lastN" required value=<?php echo $_SESSION["lastN"]?>>
			</div>
			
			<!-- Student ID -->
			<div class="field">
				<label for="studID">Student ID</label>
				<input id="studID" size="30" maxlength="7" type="text" pattern="[A-Za-z]{2}[0-9]{5}" title="AB12345" name="studID" disabled value=<?php echo $_SESSION["studID"]?>>
			</div>
			
			<!-- Email -->
			<div class="field">
				<label for="email">E-mail</label>
				<input id="email" size="30" maxlength="255" type="email" name="email" required value=<?php echo $_SESSION["email"]?>>
			</div>
			
			<!-- Major -->
			<div class="field">
				  <label for="major">Major</label>
				  <select id="major" name = "major">
					<option <?php if($_SESSION["major"] == 'CMPE'){echo("selected");}?> value="CMPE">Computer Engineering</option>
					<option <?php if($_SESSION["major"] == 'CMSC'){echo("selected");}?> value="CMSC">Computer Science</option>
					<option <?php if($_SESSION["major"] == 'MENG'){echo("selected");}?>value="MENG">Mechanical Engineering</option>
					<option <?php if($_SESSION["major"] == 'CENG'){echo("selected");}?>value="CENG">Chemical Engineering</option>
					</select>
			</div>
			<div class="nextButton">
				<input type="submit" name="save" class="button large go" value="Save">
			</div>
			</div>
		</form>
  </body>
  
</html>
