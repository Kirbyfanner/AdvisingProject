<?php
/* Updated by Douglas Lueben */

//Start the session on this page
session_start();

//Connect to the database
$debug = false;
include('CommonMethods.php');
$COMMON = new Common($debug);

//Get the fake session vars from the previous page
$appTime = $_POST["appTime"];
$advisor = $_POST["advisor"];
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Select Advisor</title>
	<link rel='stylesheet' type='text/css' href='css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		<h1>Individual Advising</h1>
		<h2>Select Advisor</h2>
	    <div class="field">
		
		<!-- Select the advisor you want to go to -->
		<form action="08StudSelectTime.php" method="post" name="SelectAdvisor">
	    <?php
			$sql = "select * from Proj2Advisors";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			while($row = mysql_fetch_row($rs)){
				echo "<label for='",$row[0],"'><input id='",$row[0],"' type='radio' name='advisor' required value='", $row[0],"'>", $row[1]," ", $row[2],"</label><br>";
			}
		?>
        </div>
		
		<!-- Confirm Selection -->
	    <div class="nextButton">
			<input type="submit" name="next" class="button large go" value="Next">
	    </div>
		</div>
		
		<input type="hidden" name="appTime" value="<?php echo $appTime; ?>" />
		
		</form>
		<div>
		
		<!-- Cancel selection -->
		<form method="link" action="02StudHome.php">
		<input type="submit" name="home" class="button large" value="Cancel">
		</form>
		</div>
  </body>
  <?php include("footer.html"); ?>
</html>