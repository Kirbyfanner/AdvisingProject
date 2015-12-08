<?php
/* Updated by Dan S. */

//Start the session on this page
session_start();//used for data validation

//If the passwords match, go create the advisor
if($_POST["PassW"] == $_POST["ConfP"]){
	//Connect to the database
			include('CommonMethods.php');
			$debug = false;
			$Common = new Common($debug);
	
			//Check if the advisor exists
      $sql = "SELECT * FROM `Proj2Advisors` WHERE `Username` = '{$_POST["UserN"]}' AND `FirstName` = '{$_POST["firstN"]}' AND  `LastName` = '{$_POST["lastN"]}'";
	  $rs = $Common->executeQuery($sql, "Advising Appointments");
      $row = mysql_fetch_row($rs);
	  
	  $first = $_POST["firstN"];
	  $last = $_POST["lastN"];
	  
	  //If they do exist, let the user know
      if($row){

		$_SESSION["Exists"] = true;
		header('Location: AdminCreateNew.php');
      }
	  //If they don't exist, add them to the database
      else{
			$_SESSION["Exists"] = false;
  			$sql = "INSERT INTO `Proj2Advisors`(`FirstName`, `LastName`, `Username`, `Password`, `Office`) 
				VALUES ('{$_POST["firstN"]}', '{$_POST["lastN"]}', '{$_POST["UserN"]}', '{$_POST["PassW"]}', '{$_POST["OfficeL"]}')";
			$rs = $Common->executeQuery($sql, "Advising Appointments");
			header('Location: AdminCreateNew.php');
      }
}

//If the passwords don't match, go back and fix it
elseif($_POST["PassW"] != $_POST["ConfP"]){
	header('Location: AdminCreateNewAdv.php');
}

?>