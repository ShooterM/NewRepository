<?php
include_once("db_class.php");
include_once("interface.php");
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
		$this->name = UNKNOWN_STR;
		$this->surname = UNKNOWN_STR;
	}

	function write($full_name) {
		$this->parts = explode(" ", $full_name);
		$this->name = $parts[0];
		$this->surname = $parts[1];
	}

	function writeForId($index, $full_name) {
		$this->id = $index;
		$this->parts = explode(" ", $full_name);
		$this->name = $parts[0];
		$this->surname = $parts[1];
	}

	public function getId() {
		return $this->id;
	}

	public function setId($value) {
		$this->id = $value;
	}
	public function getName() {
		return $this->name;
	}

	public function setName($value) {
		$this->name = $value;
	}

	public function getSurname() {
		return $this->surname;
	}

	public function setSurname($value) {
		$this->surname = $value;
	}

	public function select($order = null) {
		$con = $this->getConnector();
		$sqlQuery = "SELECT `id`, `name`, `surname` FROM `editors`".$order;
		$result = $this->getQueryResult($con, $sqlQuery);
		print("<table border=1><tr><th>Id</th><th>Name</th><th>Surname</th></tr>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print(Support::rowsGen($row));
		}
		print("</table>");
		$this->closeConnection($result, $con);
	}

	public function insert() {
		$con = $this->getConnector();
		$sqlQuery = "INSERT INTO `editors`(`name`,`surname`) VALUES('".$this->name."', '".$this->surname."')";
		$this->getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function insertValue($value) {
		$con = $this->getConnector();
		$sqlQuery = "INSERT INTO `editors`(`name`,`surname`) VALUES('".$value['name']."', '".$value['surname']."')";
		$this->getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function update() {
		$con = $this->getConnector();
		$sqlQuery = "UPDATE `editors` SET `name`='".$this->name."' ,`surname`='".$this->surname."' WHERE `id`=".inval($this->id);
		$this->getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function updateValue($index, $value) {
		$con = $this->getConnector();
		$sqlQuery = "UPDATE `editors` SET `name`='".$value['name']."' ,`surname`='".$value['surname']."' WHERE `id`=".inval($index);
		$this->getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function delete() {
		$con = $this->getConnector();
		$sqlQuery = "DELETE FROM `editors` WHERE `id`=".intval($this->id);
		$this->getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function deleteById($index) {
		$con = $this->getConnector();
		$sqlQuery = "DELETE FROM `editors` WHERE `id`=".intval($index);
		$this->getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}


	public function search($part_of_word) {
		$con = $this->getConnector();
		$sqlQuery = "SELECT `id`, CONCAT_WS(' ', `name`, `surname`) AS `editor` FROM `editors` WHERE CONCAT_WS(' ', `name`, `surname`) LIKE '%".$part_of_word."%'";
		$result = $this->getQueryResult($con, $sqlQuery);
		print("<table border=1><tr><th>Id</th><th>Name</th><th>Surname</th></tr>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print(Support::rowsGen($row));
		}
		print("</table>");
		$this->closeConnection($result, $con);
	}


	public static function getList() {
		$db = new Database();
		$con = $db->getConnector();
		$sqlQuery = "SELECT `id`, CONCAT_WS(' ',name,surname) AS `editor`  FROM `editors`";
		$result = $db->getQueryResult($con, $sqlQuery);
		print("<select name='editors'>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print("<option value=".$row['id'].">".$row['editor']."</option>");
		}
		print("</select>");
		$db->closeConnection($result, $con);
	}
}
?>