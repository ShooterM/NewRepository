<?php
/**
 *
 * Class 'Editor'
 * @author Misha
 *
 */
class Editor extends Database implements IDatabaseFunction {
	private $id;
	private $name;
	private $surname;

	const UNKNOWN_STR = "Unknown";

	function __construct() {
		$name = UNKNOWN_STR;
		$surname = UNKNOWN_STR;
	}

	function __construct($full_name) {
		$parts = explode(" ", $full_name);
		$name = $parts[0];
		$surname = $parts[1];
	}

	function __construct($index, $full_name) {
		$id = $index;
		$parts = explode(" ", $full_name);
		$name = $parts[0];
		$surname = $parts[1];
	}

	function __construct($index, $vName, $vSurname) {
		$id = $index;
		$name = $vName;
		$surname = $vSurname;
	}

	public function getId() {
		return $id;
	}

	public function setId($value) {
		$id = $value;
	}
	public function getName() {
		return $name;
	}

	public function setName($value) {
		$name = $value;
	}

	public function getSurname() {
		return $surname;
	}

	public function setSurname($value) {
		$surname = $value;
	}

	public function select($order = null) {
		$con = getConnector();
		$sqlQuery = "SELECT `id`, `name`, `surname` FROM `editors`".$order;
		$result = getQueryResult($con, $sqlQuery);
		print("<table border=1><tr><th>Id</th><th>Name</th><th>Surname</th></tr>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print(Support::rowsGen($row));
		}
		print("</table>");
		closeConnection($result, $con);
	}

	public function insert() {
		$con = getConnector();
		$sqlQuery = "INSERT INTO `editors`(`name`,`surname`) VALUES('".$this->name."', '".$this->surname."')";
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function insert($value) {
		$con = getConnector();
		$sqlQuery = "INSERT INTO `editors`(`name`,`surname`) VALUES('".$value['name']."', '".$value['surname']."')";
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function update() {
		$con = getConnector();
		$sqlQuery = "UPDATE `editors` SET `name`='".$this->name."' ,`surname`='".$this->surname."' WHERE `id`=".inval($this->id);
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function update($index, $value) {
		$con = getConnector();
		$sqlQuery = "UPDATE `editors` SET `name`='".$value['name']."' ,`surname`='".$value['surname']."' WHERE `id`=".inval($index);
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function delete() {
		$con = getConnector();
		$sqlQuery = "DELETE FROM `editors` WHERE `id`=".intval($this->id);
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function delete($index) {
		$con = getConnector();
		$sqlQuery = "DELETE FROM `editors` WHERE `id`=".intval($index);
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}


	public function search($part_of_word) {
		$con = getConnector();
		$sqlQuery = "SELECT `id`, CONCAT_WS(' ', `name`, `surname`) AS `editor` FROM `editors` WHERE CONCAT_WS(' ', `name`, `surname`) LIKE '%".$part_of_word."%'";
		$result = getQueryResult($con, $sqlQuery);
		print("<table border=1><tr><th>Id</th><th>Name</th><th>Surname</th></tr>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print(Support::rowsGen($row));
		}
		print("</table>");
		closeConnection($result, $con);
	}


	public static function getList() {
		$con = getConnector();
		$sqlQuery = "SELECT `id`, CONCAT_WS(' ',name,surname) AS `editor`  FROM `editors`";
		$result = getQueryResult($con, $sqlQuery);
		print("<select name='editors'>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print("<option value=".$row['id'].">".$row['editor']."</option>");
		}
		print("</select>");
		closeConnection($result, $con);
	}
}
?>