<?php
/* Updated by Douglas Lueben - Proj 2
The original version was poorly written and
didn't work when it was supposed to.
So...Here comes a re-write.
 */

//Start the session on this page
session_start();

//Connect to the database
$debug = false;
include('CommonMethods.php');
$COMMON = new Common($debug);

//Get what used to be session vars
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
    <title>Search for Appointment</title>
	<link rel='stylesheet' type='text/css' href='css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		<h1>Search Results</h1>
		<h3>Showing open appointments only that accept <i>YOUR</i> major!</h3>
		<h3>Group Appointments that are almost full will be <font color="red">RED</font>, get them while you can!</h3>
		<hr />
	    <div class="field">
			<?php
				/* Time for a proper re-write */
				
				//The vars we need
				$date = $_POST["date"];
				$times = $_POST["time"];
				$advisor = $_POST["advisor"];
				$results = array();
				
				//Step 1: Create the SQL statement
				$sql = "SELECT `Time`, `AdvisorID`, `EnrolledNum`, `Max`, `Location` FROM `Proj2Appointments` WHERE `EnrolledNum` < `Max` AND `Time` > '".date('Y-m-d H:i:s')."'";
				
				//First the date - is it null?
				if($date != '')
				{
					//No? Add it to the SQL statement
					$date = date('Y-m-d',strtotime($_POST["date"])); //format it
					$sql .= " AND `Time` BETWEEN '$date 00:00:00' AND '$date 23:59:59'";
				}
				
				//Time - is it empty?
				if(!empty($times))
				{
					//No? Let's add each to our SQL statement
					$sql .= " AND (";
					$first = 0;
					foreach($times as $time)
					{
						if($first != 0)
						{
							$sql .= " OR ";
						}
						$sql .= "`Time` LIKE '%$time%'";
						$first = 1;
					}
					$sql .= ")";
				}
				
				//And finally, advisor?
				if($advisor != '')
				{
					$sql .= " AND `AdvisorID` = $advisor";
				}
				
				$sql .= " ORDER BY `AdvisorID` ASC, `Time` ASC";
				
				//Step 2: Fetch Data
				$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
				
				//If we get nothing, stop
				if(mysql_num_rows($rs) == 0)
				{
					echo "<h2><i>Sorry, nothing matched your search criteria</i></h2>";
					exit();
				}
				
				//Step 3: Display Data
				echo "<br><table>";
				$currentId = -1;
				while($row = mysql_fetch_row($rs))
				{
					//Are we on a new advisor? If so, display their name!
					if($currentId != $row[1])
					{
						$currentId = $row[1];
						if($row[1] == 0)
						{
							echo "<tr id='tableHeader'><td>";
							echo "Appointments for: ";
							echo "<b>Group Appointments</b>";
							echo "</td></tr>";
						}
						else
						{
							//Get the advisor's name
							$sql2 = "SELECT `FirstName`, `LastName` FROM `Proj2Advisors` WHERE `id` = $row[1]";
							$nameRs = $COMMON->executeQuery($sql2, $_SERVER["SCRIPT_NAME"]);
							$nameRow = mysql_fetch_row($nameRs);
							
							//Display the row
							echo "<tr id='tableHeader'><td>";
							echo "Appointments for: ";
							echo "<b>$nameRow[0] $nameRow[1]</b>";
							echo "</td></tr>";
						}
						
						echo "<tr>";
						echo "<td>Time</td>";
						echo "<td>Open?</td>";
						echo "<td>Location</td>";
						echo "</tr>";
					}
					
					//Step 4: Print the appointment
					
					//Print Time
					echo "<tr>";
					echo "<td>$row[0]</td>";
					
					//If it's a group appt, print num seats
					if($row[1] == 0)
					{
						echo "<td>";
						if($row[2] == ($row[3] - 1))
						{
							echo "<font color = 'red'>";
						}
						$sum = $row[3] - $row[2];
						echo "$sum seat";
						if($row[2] == ($row[3] - 1))
						{
							echo "</font>";
						}
						else
						{
							echo "s";
						}
						echo "</td>";
					}
					else
					{
						echo "<td>Yes!</td>";
					}
					
					//Print location
					echo "<td>$row[4]</td>";
					echo "</tr>";
				}
				echo "</table>";
			?>
			</label>
        </div>
		<form action="02StudHome.php" method="link">
	    <div class="nextButton">
			<input type="submit" name="done" class="button large go" value="Done">
	    </div>
		</form>
		</div>
  </body>
</html>