<?php
/* Updated by Douglas Lueben */

//Start the session on this page
session_start();

//Group
if ($_POST["type"] == "Group"){
	$_SESSION["advisor"] = $_POST["type"];
	header('Location: 08StudSelectTime.php');
}

//Individual
elseif ($_POST["type"] == "Individual"){
	header('Location: 07StudSelectAdvisor.php');
}

//Next Available (section created by Douglas Lueben)
elseif ($_POST["type"] == "Next Available")
{
	//Connect to the database
	include('CommonMethods.php');
	$COMMON = new Common($debug);
	
	//Create the query
	$sql = "SELECT * FROM `Proj2Appointments` WHERE (`Time` > NOW()) ORDER BY `Time` LIMIT 1";
	
	//Get the appointment
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	$row = mysql_fetch_row($rs);
	
	//If we got it...
	if(isset($row))
	{
		//Get the advisor's id
		$_SESSION["advisor"] = $row[2];
		
		//Get the appointment time
		$_SESSION["appTime"] = $row[1];
		
		//Redirect!
		header('Location: 10StudConfirmSch.php');
	}
	//If we didn't, there must be NO more appointments! Redirect to 12
	else
	{
		header('Location: 13StudDenied.php');
	}
}

?>