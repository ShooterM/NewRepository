<?php
/**
 * 
 * Base class that work with database
 * @author Admin
 *
 */
class Database {
	/**
	 *
	 * Open connection
	 */
	public function getConnector() {
		require("../config.php");
		$connection = mysql_connect($hostName,$userName,$password);
		mysql_select_db($dbName,$connection);
		return $connection;
	}

	/**
	 * 
	 * Open connection
	 * @param string $host
	 * @param string $user
	 * @param string $pass
	 */
	public function getConnector($host, $user, $pass) {
		return mysql_connect($host,$user,$pass);		
	}
	
	/**
	 * 
	 * Use database
	 * @param string $database
	 */
	public function selectDatabase($database) {
		mysql_select_db($database);
	}	
	
	/**
	 *
	 * Execute sql query
	 * @param mysql_connection $connection
	 * @param string $sqlQuery
	 */
	public function getQueryResult($connection ,$sqlQuery) {
		return mysql_query($sqlQuery);
	}

	/**
	 *
	 * Close coonection and result
	 * @param mixed $result
	 * @param mysql_connection $connection
	 */
	public function closeConnection($result, $connection) {
		mysql_free_result($result);
		mysql_close($connection);
	}
}
?>