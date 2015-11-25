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

$studID = $_SESSION["studID"];

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
    <title>Student Advising Home</title>
	<link rel='stylesheet' type='text/css' href='css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		<h2>Hello 
		<?php
			//Greet user
			echo $firstN;
		?>
        </h2>
	    <div class="selections">
		<form action="StudProcessHome.php" method="post" name="Home">
	    <?php			
			/* Setup variables to pull from the database */
			$adminCancel = false;
			$noApp = false;

			/* Pull this student's information from the DB */
			$sql = "select * from Proj2Students where `StudentID` = '$studID'";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			$row = mysql_fetch_row($rs);
			
			/* If the row is empty, then the student has never made an appointment before,
			and therefore doesn't exist in Proj2Students. Otherwise, pull the student's information */
			if (!empty($row)){
				
				/* If 'C', then the advisor cancelled */
				if($row[6] == 'C'){
					$adminCancel = true;
				}
				
				/* If 'N', then there is no appointment */
				if($row[6] == 'N'){
					$noApp = true;
				}
			}

			/* If there isn't a proper appointment, allow the user to signup for an appointment */
			if ($adminCancel == true || $noApp == true){
				if($adminCancel == true){
					echo "<p style='color:red'>The advisor has cancelled your appointment! Please schedule a new appointment.</p>";
				}
				echo "<button type='submit' name='selection' class='button large selection' value='Signup'>Signup for an appointment</button><br>";
			}
			
			/* Show the user information about their appointment */
			else{
				echo "<button type='submit' name='selection' class='button large selection' value='View'>View my appointment</button><br>";
				echo "<button type='submit' name='selection' class='button large selection' value='Reschedule'>Reschedule my appointment</button><br>";
				echo "<button type='submit' name='selection' class='button large selection' value='Cancel'>Cancel my appointment</button><br>";
			}
			echo "<button type='submit' name='selection' class='button large selection' value='Search'>Search for appointment</button><br>";
			echo "<button type='submit' name='selection' class='button large selection' value='Edit'>Edit student information</button><br>";
		?>
		</form>
        </div>
		<!-- Log out of the page -->
		<form action="Logout.php" method="post" name="Logout">
	    <div class="logoutButton">
			<input type="submit" name="logout" class="button large go" value="Logout">
	    </div>
		</div>
		</form>
  </body>
</html>