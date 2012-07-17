<?php
class database
{
	
private $server="localhost";
private $user="dlb";
private $pass="password";
private $database="dlbdatabase";
private $result;
public $error="E-x000";
public $count=-1;




	function querySR($query)
	{
		$con=@mysql_connect($this->server,$this->user,$this->pass) or $this->error="E-x001"; 	// Server Connection
		$sel=@mysql_select_db($this->database,$con) or $this->error="E-x002";					// DB Selection
		$this->result=@mysql_query($query,$con) or $this->error="E-x003";						// Query Execution
		$this->count=@mysql_num_rows($this->result);											// Count Rows
		$this->result=@mysql_fetch_assoc($this->result);										// Fetch Value(s) to an array
		@mysql_close($con);																		// Close DB
		return $this->result;			
	}
	
}


?>
