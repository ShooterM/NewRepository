<?php


/**
 * 
 * Open connection
 */
function getConnector() {
	require("config.php");
	$connection = mysql_connect($hostName,$userName,$password);
	mysql_select_db($dbName,$connection);
	return $connection;
}

/**
 * 
 * Execute sql query
 * @param mysql_connection $connection
 * @param string $sqlQuery
 */
function getQueryResult($connection ,$sqlQuery) {
	return mysql_query($sqlQuery);
}

/**
 * 
 * Close coonection and result
 * @param mixed $result
 * @param mysql_connection $connection
 */
function closeConnection($result, $connection) {
	mysql_free_result($result);
	mysql_close($connection);
}

?>