<?php
/* Updated by Douglas Lueben */

//Start the session for this page
session_start();

//Connect to the database
$debug = false;
include('CommonMethods.php');
$COMMON = new Common($debug);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
	<link rel='stylesheet' type='text/css' href='css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		
		<!-- List the created appointments -->
		<h2>Appointments Created</h2><br>
		<?php
			//Create local copies of the post variables
			$date = $_POST["Date"];
			$times = $_POST["time"];
			$majors = $_POST["major"];
			$repeatDays = $_POST["repeat"];
			$repeatWeek = $_POST["stepper"];
			$studentLimit = 1;
			
			//one week with given start date (Ex. Thur - Wed) ['Thursday']=>[########]
			$d0 = $date;
			$d1 = '+1 day ' . $date;
			$d2 = '+2 day ' . $date;
			$d3 = '+3 day ' . $date;
			$d4 = '+4 day ' . $date;
			$d5 = '+5 day ' . $date;
			$d6 = '+6 day ' . $date;
			$oneweek = array(date('l', strtotime($d0)) => strtotime($d0),
							date('l', strtotime($d1)) => strtotime($d1),
							date('l', strtotime($d2)) => strtotime($d2),
							date('l', strtotime($d3)) => strtotime($d3),
							date('l', strtotime($d4)) => strtotime($d4),
							date('l', strtotime($d5)) => strtotime($d5),
							date('l', strtotime($d6)) => strtotime($d6)); 
			
			//initialize the first wk
			$dates = array();
			array_push($dates, date('Y-m-d',strtotime($date)));
			if(!empty($repeatDays)){
				foreach($repeatDays as $day){
					if($day != date("l", strtotime($date))){
						array_push($dates, date('Y-m-d',$oneweek[$day]));
					}
				}
			}
			//repeat weeks based on initial wk
			$countDates = count($dates);
			for($i=0; $i < $repeatWeek; $i++){
				for($j=0; $j < $countDates; $j++){
					$newDateStr = "+1 week " . $dates[$j + ($i * $countDates)];
					$newDate = date('Y-m-d',strtotime($newDateStr));
					array_push($dates, $newDate);
				}
			}
			
			//pair dates and times to make datetime things YYYY-MM-DD hh:mm:ss
			$datetimes = array();
			foreach($dates as $aDate){
				foreach($times as $time){
					$newDatetime = $aDate . " " . $time;
					array_push($datetimes, $newDatetime);
				}
			}
			
			//major stuff
			$majorDB = "";
			$majorPrint = "All";
			if(!empty($majors)){
				$majorPrint = "";
				foreach($majors as $m){
					$majorDB .= $m . " ";
					$majorPrint .= $m . ", ";
				}
				$majorPrint = substr($majorPrint, 0, -2);
			}
			
			//get advisor id
			$id = $_SESSION["UserId"];
		/* Loop through $datetimes and create the "SELECT" query */
		  $selectQuery = "SELECT * from `Proj2Appointments` WHERE ";
		  $sentinel = 0;
		  foreach($datetimes as $dt)
		  {
			  // If this is the first time, don't print 'OR...'
			  if($sentinel != 0)
			  {
				  $selectQuery .= "OR ";
			  }
			  
			  // Start with the parenthesises
			  $selectQuery .= "(";
			  
			  //Check for Time
			  $selectQuery .= "`Time` = '";
			  $selectQuery .= $dt;
			  $selectQuery .= "'";
			  
			  //Check for Group ID
			  $selectQuery .= " AND `AdvisorID` = '";
			  $selectQuery .= $id;
			  $selectQuery .= "') ";
			  $sentinel += 1;
		  }
		  
		  //Run the select query
		  $rs = $COMMON->executeQuery($selectQuery, $_SERVER["SCRIPT_NAME"]);
		  
		  //Store the result in an array
		  $duplicateAppts = array();
		  while($row = mysql_fetch_array($rs))
		  {
			  array_push($duplicateAppts,$row);
		  }
		  
		  //Print the results, insert any cleared appointments
		  $insertQuery = "INSERT INTO `Proj2Appointments` (`Time`, `AdvisorID`, `Major`, `Max`) VALUES ";
		  $numToInsert = 0;
		  foreach($datetimes as $dt)
		  {
			//Print the date, allowed majors, and number of seats:
			echo date('l, F d, Y g:i A', strtotime($dt)), "<br>Majors included: ", $majorPrint;
            echo("<br>Number of seats: $studentLimit");
			
			//Go through and see if the current date/time slot has already been taken
			$beenTaken = false;
			foreach($duplicateAppts as $dA)
			{
				//If the times match...
				if($dA[1] == $dt)
				{
					//...this appt can't be created
					$beenTaken = true;
				}
			}
			
			//If it's been taken, display the red !!
            if($beenTaken == true){
              echo "<br><span style='color:red'>!!</span>";
            }
			
			//Otherwise, insert this appointment
            else{
				$numToInsert += 1;
				$insertQuery .= "('$dt', '$id', '$majorDB','$studentLimit'),";
            }
            echo "<br><br>";
		  }
		  
		  //Trim the last comma
		  if(substr($insertQuery, -1) == ",")
		  {
			  $insertQuery = substr($insertQuery, 0, -1);
		  }
		  
		  //If there are no queries, then do not run
		  if($numToInsert != 0)
		  {
			$rs = $COMMON->executeQuery($insertQuery, $_SERVER["SCRIPT_NAME"]);
		  }
		  
		?>
		<br>
		
		<!-- Return to UI -->
		<form method="link" action="AdminUI.php">
			<input type="submit" name="next" class="button large go" value="Return to Home">
		</form>
	</div>
	<div class="bottom">
		<p><span style="color:red">!!</span> indicates that this appointment already exists. A repeat appointment was not made.</p>
	</div>
	</div>
	</div>
	</form>
  </body>
  
</html>
