<?php
/* PROJ2: Updated by Dan S */

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
    <title>Cancel Appointment</title>
	<link rel='stylesheet' type='text/css' href='css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		<h1>Cancel Appointment</h1>
	    <div class="field">
	    <?php			
			//Select the student's appointment
			$sql = "select * from Proj2Appointments where `EnrolledID` like '%$studID%'";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			$row = mysql_fetch_row($rs);
			$oldAdvisorID = $row[2];
			$oldDatephp = strtotime($row[1]);				
				
			if($oldAdvisorID != 0){
				$sql2 = "select * from Proj2Advisors where `id` = '$oldAdvisorID'";
				$rs2 = $COMMON->executeQuery($sql2, $_SERVER["SCRIPT_NAME"]);
				$row2 = mysql_fetch_row($rs2);					
				$oldAdvisorName = $row2[1] . " " . $row2[2];
			}
			else{$oldAdvisorName = "Group";}
			
			$sql = "select * from Proj2Appointments where `EnrolledID` = '$studID'";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			$row = mysql_fetch_row($rs);
			
			//Display the information
			echo "<h2>Current Appointment</h2>";
			echo "<label for='info'>";
			echo "Advisor: ", $oldAdvisorName, "<br>";
			echo "Appointment: ", date('l, F d, Y g:i A', $oldDatephp)." in ".$row[7], "</label><br>";
		?>		
        </div>
	    <div class="finishButton">
			<form action = "StudProcessCancel.php" method = "post" name = "Cancel">
			
			<!-- Allow the user to cancel the appointment -->
			<input type="submit" name="cancel" class="button large go" value="Cancel">
			
			<!-- Allow the user to back out of cancelling -->
			<input type="submit" name="cancel" class="button large" value="Keep">
			
			</form>
	    </div>
		</div>
		<div class="bottom">
			<p>Click "Cancel" to cancel appointment. Click "Keep" to keep appointment.</p>
		</div>
		</form>
  </body>
</html>