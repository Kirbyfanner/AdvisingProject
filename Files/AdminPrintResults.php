<?php
/* Updated by Dan S */

//Start the session for the current page
session_start();
$debug = false;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Print Schedule</title>
	<link rel='stylesheet' type='text/css' href='css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">

<?php
	//Make local copies post + session vars
	$date = $_POST["date"];
	$type = $_POST["type"];
	$User = $_SESSION["UserId"];
			
	//Reference CommonMethods.php
	include('CommonMethods.php');
	$COMMON = new Common($debug);


	//Setup the query to fetch all
      $sql = "SELECT `id`, `firstName`, `lastName` FROM `Proj2Advisors` WHERE `id` = '$User'";
      $rs = $COMMON->executeQuery($sql, "Advising Appointments");
      $row = mysql_fetch_row($rs);
      $id = $row[0];
      $FirstName = $row[1];
      $LastName = $row[2];
		
			echo("<h2>Schedule for $FirstName $LastName<br>$date</h2>");
      $date = date('Y-m-d', strtotime($date));
	
	//Display both the group & individual appts
	if($_POST["type"] == 'Both')
	{
		displayGroup($id, $date);
		displayIndividual($id, $date);
	}
	
	//Display just the individual appts
	elseif($_POST["type"] == 'Individual') { displayIndividual($id, $date); }
	
	//Display just the group appts
	elseif($_POST["type"] == 'Group') { displayGroup($id, $date); }
	
	//Error
	else { echo("Selection invalid"); }

?>
	<form method="link" action="AdminUI.php">
	
	<!-- Finish -->
	<input type="submit" name="next" class="button large go" value="Return to Home">
	
	<!-- Attempt to print your schedule -->
	<input type="button" name="print" class="button large go" value="Print" onClick="window.print()">
	</form>

	</div>
	</div>
	<?php include('./workOrder/workButton.php'); ?>
	</div>

  </body>
  <?php include("footer.html"); ?>
  
</html>


<?php

//Displays all group appointments
function displayGroup($id, $date)
{
	global $debug; global $COMMON;

	$sql = "SELECT `Time`, `Major`, `EnrolledID`, `EnrolledNum`, `Max`, `Location` FROM `Proj2Appointments` 
	WHERE `Time` LIKE '$date%' AND `AdvisorID` = 0 AND `MAX` > 1 ORDER BY `Time` ";

	// ******************************************************************
	// Why is Advisor ID 0 above?? (and not id)
	// This is so everyone on staff can see it when viewing a schedule
	// Then only one advisor can schedule the group sessions
	// Lupoli - 8/18/15
	// ******************************************************************


    $rs = $COMMON->executeQuery($sql, "Advising Appointments");
	$matches = mysql_num_rows($rs); // see how many rows were collected by the query
	if($debug) { echo("matches was $matches"); }
	if($matches == 0) { return; }

	echo("<h3>Group Appointments:</h3>");
	echo("<table border='1'><th colspan='5'>Group Appointments</th>\n");
	echo("<tr><td width='60px'>Time:</td><td>Majors Included:</td><td>students enrolled</td><td>Number of seats</td><td>Location</td></tr>\n");

        while ($row = mysql_fetch_array($rs, MYSQL_NUM)) 
	{
		echo("<tr>");
		echo("<td>".date('g:i A', strtotime($row[0]))."</td>");
                 echo("<td>".$row[1]."</td>");
		echo("<td>(".$row[3].")".$row[2]."</td>");
		echo("<td>".$row[4]."</td>");
		echo("<td>".$row[5]."</td>");
		echo("</tr>\n");
	}
        echo("</table><br><br>\n");
}

//Display all individual appointments
function displayIndividual($id, $date)
{
	global $debug; global $COMMON;

        $sql = "SELECT `Time`, `Major`, `EnrolledID`, `Location` FROM `Proj2Appointments` 
        WHERE `Time` LIKE '$date%' AND `AdvisorID` = $id AND `MAX` = 1 ORDER BY `Time`";
        $rs = $COMMON->executeQuery($sql, "Advising Appointments");
	$matches = mysql_num_rows($rs); // see how many rows were collected by the query
	if($debug) { echo("matches was $matches"); }
	if($matches == 0) { return; }

	echo("<h3>Individual Appointments:</h3>");
	echo("<table border='1'><th colspan='5'>Individual Appointments</th>\n");
	echo("<tr><td width='60px'>Time:</td><td>Majors Included:</td><td>Student's name</td><td>Student ID</td><td>Location</td></tr>\n");

        while ($row = mysql_fetch_array($rs, MYSQL_NUM)) 
	{
		echo("<tr>");
		echo("<td>".date('g:i A', strtotime($row[0]))."</td>");
                echo("<td>".$row[1]."</td>");
	        $trdsql = "SELECT `FirstName`, `LastName` FROM `Proj2Students` WHERE `StudentID` = '$row[2]'";
        		$trdrs = $COMMON->executeQuery($trdsql, "Advising Appointments");
		$trdrow = mysql_fetch_row($trdrs);
		echo("<td>".$trdrow[0]." ".$trdrow[1]."</td>");
		echo("<td>".$row[2]."</td>");
		echo("<td>".$row[3]."</td>");
		echo("</tr>");
	}
        echo("</table><br><br>");
}
?>
