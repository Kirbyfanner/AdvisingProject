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

//Get the fake session vars from the previous page
$appTime = $_POST["appTime"];
$advisor = $_POST["advisor"];
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Confirm Appointment</title>
	<link rel='stylesheet' type='text/css' href='css/standard.css'/>  </head>
  <body>
	<div id="login">
      <div id="form">
        <div class="top">
		<h1>Confirm Appointment</h1>
	    <div class="field">
		<form action = "StudProcessSch.php" method = "post" name = "SelectTime">
		
	    <?php
			
			//If we're overwriting an appointment, notify the user
			if($_SESSION["resch"] == true){
				$sql = "select * from Proj2Appointments where `EnrolledID` like '%$studid%'";
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
				
				echo "<h2>Previous Appointment</h2>";
				echo "<label for='info'>";
				echo "Advisor: ", $oldAdvisorName, "<br>";
				echo "Appointment: ", date('l, F d, Y g:i A', $oldDatephp)." in " .$row[7], "</label><br>";
			}
			
			//Confirm this is the appt the user wants by displaying the info
			$currentAdvisorName;
			$currentAdvisorID = $advisor;
			$currentDatephp = strtotime($appTime);
			if($currentAdvisorID != 0){
				$sql2 = "select * from Proj2Advisors where `id` = '$currentAdvisorID'";
				$rs2 = $COMMON->executeQuery($sql2, $_SERVER["SCRIPT_NAME"]);
				$row2 = mysql_fetch_row($rs2);
				$currentAdvisorName = $row2[1] . " " . $row2[2] . " (Office at: " . $row2[5] . ")";
			}
			else{$currentAdvisorName = "Group";}
			
			$sql = "select * from Proj2Appointments where `Time` = '$appTime'";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			$row = mysql_fetch_row($rs);

			echo "<h2>Current Appointment</h2>";
			echo "<label for='newinfo'>";
			echo "Advisor: ",$currentAdvisorName,"<br>";
			echo "Appointment: ",date('l, F d, Y g:i A', $currentDatephp)." in ".$row[7],"</label>";
		?>
        </div>
	    <div class="nextButton">
						
		<!-- My secret post, session replacement -->
		<input type="hidden" name="advisor" value="<?php echo $advisor; ?>" />
		<input type="hidden" name="appTime" value="<?php echo $appTime; ?>" />
		
		<?php
			//If we're rescheduling, display the reschedule button
			if($_SESSION["resch"] == true){
				echo "<input type='submit' name='finish' class='button large go' value='Reschedule'>";
			}
			
			//If we're creating a new appointment, display the submit button
			else{
				echo "<input type='submit' name='finish' class='button large go' value='Submit'>";
			}
		?>
			<input style="margin-left: 50px" type="submit" name="finish" class="button large" value="Cancel">
	    </div>
		
		</form>
		</div>
  </body>
  <?php include("footer.html"); ?>
</html>