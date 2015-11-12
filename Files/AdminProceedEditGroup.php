<?php
/* Updated by Douglas Lueben */

//Start the session for the page
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Edit Group Appointment</title>
	<link rel='stylesheet' type='text/css' href='css/standard.css'/>
  </head> 
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
          <h1>Edit Group Appointment</h1>
		  <div class="field">
          <?php
		  
			//Connect to the database
            $debug = false;
            include('CommonMethods.php');
            $COMMON = new Common($debug);

			//Store GroupApp
            $group = $_SESSION["GroupApp"];
            parse_str($group);

			//Form to change values
            echo("<form action=\"AdminConfirmEditGroup.php\" method=\"post\" name=\"Edit\">");
            echo("Time: ". date('l, F d, Y g:i A', strtotime($row[0])). "<br>");
			
			//Majors allowed at the appt.
            echo("Majors included: ");
            if($row[1]){
              echo("$row[1]<br>"); 
            }
            else{
              echo("Available to all majors<br>"); 
            }
            echo("Number of students enrolled: $row[2] <br>");
			
			//Limit of enrolled students
            echo("Student limit: ");
            echo("<input type=\"number\" id=\"stepper\" name=\"stepper\" min=\"$row[2]\" max=\"$row[3]\" value=\"$row[3]\" />");

            echo("<br><br>");

			//Submit button
            echo("<div class=\"nextButton\">");
            echo("<input type=\"submit\" name=\"next\" class=\"button large go\" value=\"Submit\">");
            echo("</div>");
            echo("</div>");
            echo("<div class=\"bottom\">");
			
			//Warn the advisor if they try to lower the student limit below the number of students already signed up
            if($row[2] > 0){
              echo "<p style='color:red'>Note: There are currently $row[2] students enrolled in this appointment. <br>
                    The student limit cannot be changed to be under this amount.</p>";
            }
            echo("</div>");
          ?>
		  </div>
  </div>
  </div>
  </form>
  </body>
  
</html>
