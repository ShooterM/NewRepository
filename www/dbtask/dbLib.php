<?php

function getConnector(){
	require("../../config/config.php");
	$connection = mysql_connect($hostName,$userName,$password);
	mysql_select_db($dbName,$connection);
	return $connection;
}

function getQueryResult($connection ,$sqlQuery) {
	return mysql_query($sqlQuery);
}

function closeConnection($result, $connection) {
	mysql_free_result($result);
	mysql_close($connection);
}

?>