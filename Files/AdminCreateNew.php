<?php
/* Updated by Douglas Lueben */

//Start the session on this page
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Create New Admin</title>
    <link rel='stylesheet' type='text/css' href='css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		<h2>New Advisor has been created:</h2>

		<?php
			//Store local copies of the session variables
			$first = $_SESSION["AdvF"];
			$last = $_SESSION["AdvL"];
			$user = $_SESSION["AdvUN"];
			$pass = $_SESSION["AdvPW"];
			$off = $_SESSION["OfficeL"];

			//Connect to the database
			include('CommonMethods.php');
			$debug = false;
			$Common = new Common($debug);

			//Check if the advisor exists
      $sql = "SELECT * FROM `Proj2Advisors` WHERE `Username` = '$user' AND `FirstName` = '$first' AND  `LastName` = '$last'";
      $rs = $Common->executeQuery($sql, "Advising Appointments");
      $row = mysql_fetch_row($rs);
	  
	  //If they do exist, let the user know
      if($row){
        echo("<h3>Advisor $first $last already exists</h3>");
      }
	  
	  //If they don't exist, add them to the database
      else{
  			$sql = "INSERT INTO `Proj2Advisors`(`FirstName`, `LastName`, `Username`, `Password`, `Office`) 
  			VALUES ('$first', '$last', '$user', '$pass', '$off')";
        echo ("<h3>$first $last<h3>");
        $rs = $Common->executeQuery($sql, "Advising Appointments");
      }
		?>
		
		<!-- Back to UI -->
		<form method="link" action="AdminUI.php">
			<input type="submit" name="next" class="button large go" value="Return to Home">
		</form>
	</div>
	</div>
	</div>
	</form>
  </body>
  <?php include("footer.html"); ?>
  
</html>
