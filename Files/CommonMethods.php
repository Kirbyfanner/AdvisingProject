<?php 
/* Updated by Douglas Lueben */

/* A class to simplify the connection and access of a MySQL database */
class Common
{	
	var $conn; //this stores the connection information to the db
	var $debug; // this is set by a initiated value in the constructor
			
	function Common($debug) //Constructor
	{
		//Save whether this is debug mode
		$this->debug = $debug; 
		
		//Attempt to connect to the db
		$rs = $this->connect("studentdb-maria.gl.umbc.edu");
		
		//Return this connection
		return $rs;
	}

// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% */
	
	function connect($db)// connect to MySQL
	{
		//Connect to the server
		$conn = @mysql_connect("studentdb-maria.gl.umbc.edu", "dlueben1", "js)ZJ*k=e)/jnts8") or die("<br> Could not connect to MySQL <br>");
		
		//Select the database
		$rs = @mysql_select_db("dlueben1", $conn) or die("<br> Could not connect to $db database <br>");
		
		//Store the connection to the database
		$this->conn = $conn; 
	}

// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% */
	
	function executeQuery($sql, $filename) // execute a SQL query
	{
		//If this is debug mode, echo the SQL query
		if($this->debug == true) { echo("$sql <br>\n"); }
		
		//Run the SQL query
		$rs = mysql_query($sql, $this->conn) or die("<br> Could not execute query '$sql' in $filename <br>"); 
		
		//Return the result of the query
		return $rs;
	}			

} // ends class, NEEDED!!

?>
