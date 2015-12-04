<?php
/* Completely Re-written by Douglas Lueben for Project 2 */

//Pull the session variable we're allowed to have.
session_start();

//Setup the redirect to denied, until proven otherwise
$redirect = "13StudDenied.php";

$debug = false;
include('CommonMethods.php');
$COMMON = new Common($debug);

//If the student cancelled, forget the rest
$aStatus = "";
if($_POST["finish"] == 'Cancel')
{ $aStatus = "none"; }

$studID = $_SESSION["studID"]; //The student's ID

//Get the fake session variables that were stored as post variables
$appTime = $_POST["appTime"];
$advisor = $_POST["advisor"];

//pull what used to be session variables
$sql = "select * from Proj2Students where `StudentID` = '$studID'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);

$firstN = $row[1];
$lastN = $row[2];
$email = $row[4];
$major = $row[5];
$status = $row[6];

//regular new schedule
if($_POST["finish"] == 'Submit'){
	
	if($advisor == 'Group')  // student scheduled for a group session
	{
		$sql = "select * from Proj2Appointments where `Time` = '$appTime' and `AdvisorID` = 0";
		$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		$row = mysql_fetch_row($rs);
		$groupids = $row[4];
		$sql = "update `Proj2Appointments` set `EnrolledNum` = EnrolledNum+1, `EnrolledID` = '$groupids $studID' where `Time` = '$appTime' and `AdvisorID` = 0";
		$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		$redirect = "12StudExit.php";
	}
	else // student scheduled for an individual session
	{
		$sql = "update `Proj2Appointments` set `EnrolledNum` = EnrolledNum+1, `EnrolledID` = '$studID' where `AdvisorID` = '$advisor' and `Time` = '$appTime'";
		$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		$redirect = "12StudExit.php";
	}
	

	$status = "complete";
}
elseif($_POST["finish"] == 'Reschedule'){
	//remove stud from EnrolledID
	$sql = "select * from Proj2Appointments where `EnrolledID` like '%$studID%'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	$row = mysql_fetch_row($rs);
	$oldAdvisorID = $row[2];
	$oldAppTime = $row[1];
	$newIDs = str_replace($studID, "", $row[4]);
	
	$sql = "update `Proj2Appointments` set `EnrolledNum` = EnrolledNum-1, `EnrolledID` = '$newIDs' where `AdvisorID` = '$oldAdvisorID' and `Time` = '$oldAppTime'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	
	//schedule new app
	if($advisor == 'Group'){
		$sql = "select * from Proj2Appointments where `Time` = '$appTime' and `AdvisorID` = 0";
		$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		$row = mysql_fetch_row($rs);
		$groupids = $row[4];
		$sql = "update `Proj2Appointments` set `EnrolledNum` = EnrolledNum+1, `EnrolledID` = '$groupids $studID' where `Time` = '$appTime' and `AdvisorID` = 0";
		$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	}
	else{
		$sql = "update `Proj2Appointments` set `EnrolledNum` = EnrolledNum+1, `EnrolledID` = '$studID' where `Time` = '$appTime' and `AdvisorID` = '$advisor'";
		$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	}

	$status = "resch";
}

//update stud status to ''
$sql = "update `Proj2Students` set `Status` = '' where `StudentID` = '$studID'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
?>

<!-- The invisible form, to POST the "session variables" -->
<form action="<?php echo $redirect; ?>" method="post" id="fakeSession">

<input type="hidden" name="advisor" value="<?php echo $advisor; ?>" />
<input type="hidden" name="appTime" value="<?php echo $appTime; ?>" />
<input type="hidden" name="status" value="<?php echo $status; ?>" />

</form>

<!-- The JS that auto triggers this form -->
<script type="text/javascript">
	document.getElementById('fakeSession').submit();
</script>