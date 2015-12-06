<?php
/* Updated by Douglas Lueben - Project 2 */

//Start the session on this page
session_start();

/* For who knows what reason, we're removing session variables
and have to use inferior methods of data passing, so instead of
passing these variables as session variables, i'll go ahead and
pass them as post variables using javascript + invisible form. */

//Replaces $_SESSION["advisor"]
$advisor = "";
//Replaces $_SESSION["appTime"]
$appTime = "";
//Replaces the header redirects
$redirect = "";

//Group
if ($_POST["type"] == "Group"){
	$advisor = $_POST["type"];
	$redirect = "08StudSelectTime.php";
}

//Individual
elseif ($_POST["type"] == "Individual"){
	$redirect = "07StudSelectAdvisor.php";
}

//Next Available (section created by Douglas Lueben)
elseif ($_POST["type"] == "Next Available")
{
	//Connect to the database
	include('CommonMethods.php');
	$COMMON = new Common($debug);
	
	//Create the query
	$sql = "SELECT * FROM `Proj2Appointments` WHERE (`Time` > NOW()) AND `EnrolledNum` < `Max` ORDER BY `Time` LIMIT 1";
	
	//Get the appointment
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	$row = mysql_fetch_row($rs);
	
	//If we got it...
	if(isset($row))
	{
		//Get the advisor's id
		$advisor = $row[2];
		
		//Get the appointment time
		$appTime = $row[1];
		
		//Redirect!
		$redirect = "10StudConfirmSch.php";
	}
	//If we didn't, there must be NO more appointments! Redirect to 12
	else
	{
		$redirect = "13StudDenied.php";
	}
}

?>

<!-- The invisible form, to POST the "session variables" -->
<form action="<?php echo $redirect; ?>" method="post" id="fakeSession">

<input type="hidden" name="advisor" value="<?php echo $advisor; ?>" />
<input type="hidden" name="appTime" value="<?php echo $appTime; ?>" />

</form>

<!-- The JS that auto triggers this form -->
<script type="text/javascript">
	document.getElementById('fakeSession').submit();
</script>