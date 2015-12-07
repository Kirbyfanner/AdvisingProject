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
    <title>View Appointment</title>
	<link rel='stylesheet' type='text/css' href='css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		<h1>View Appointment</h1>
	    <div class="field">
	    <?php
		
			//Pull the appointment from the db
			$sql = "select * from Proj2Appointments where `EnrolledID` like '%$studID%'";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			// if for some reason there really isn't a match, (something got messed up, tell them there really isn't one there)
			$num_rows = mysql_num_rows($rs);

			if($num_rows > 0)
			{
				$row = mysql_fetch_row($rs); // get legit data
				$advisorID = $row[2];
				$datephp = strtotime($row[1]);
				
				if($advisorID != 0){
					$sql2 = "select * from Proj2Advisors where `id` = '$advisorID'";
					$rs2 = $COMMON->executeQuery($sql2, $_SERVER["SCRIPT_NAME"]);
					$row2 = mysql_fetch_row($rs2);
					$advisorName = $row2[1] . " " . $row2[2] . " (Office at: " . $row2[5] . ")";
				}
				else{$advisorName = "Group";}
				
				$sql = "select * from Proj2Appointments where `EnrolledID` = '$studID'";
				$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
				$row = mysql_fetch_row($rs);
			
				echo "<label for='info'>";
				echo "Advisor: ", $advisorName, "<br>";
				echo "Appointment: ", date('l, F d, Y g:i A', $datephp)." in ".$row[7], "</label>";
			}
			else // something is up, and there DB table needs to be fixed
			{
				echo("No appointment was detected. It may have been cancelled. Please make another appointment.");
				$sql = "update `Proj2Students` set `Status` = 'N' where `StudentID` = '$studID'";
				$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			}

		?>
        </div>
		
		<!-- Return Home -->
	    <div class="finishButton">
			<button onclick="location.href = '02StudHome.php'" class="button large go" >Return to Home</button>
	    </div>
		
		</div>
		</form>
  </body>
</html>