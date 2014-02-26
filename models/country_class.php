<?php
include_once("db_class.php");
include_once("interface.php");
/**
 *
 * Class 'Country'
 * @author Misha
 *
 */
class Country extends Database implements IDatabaseFunction {
	private $id;
	private $country;
	
	const UNKNOWN_STR = "Unknown";

	function __construct() {
		$this->country = self::UNKNOWN_STR;		
	}

	function write($countryName) {
		$this->country = $countryName;
	}

	function writeForId($index, $countryName) {
		$this->id = $index;
		$this->country = $countryName;
	}

	public function getId() {
		return $this->id;
	}

	public function setId($value) {
		$this->id = $value;
	}

	public function getCountry() {
		return $this->country;
	}

	public function setCountry($value) {
		$this->country = $value;
	}

	public function select($order = null) {
		$con = $this->getConnector();
		$sqlQuery = "SELECT `id`, `country` FROM `countries`".$order;
		$result = $this->getQueryResult($con, $sqlQuery);
		print("<table border=1><tr><th>Id</th><th>Country</th></tr>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print(Support::rowsGen($row));
		}
		print("</table");
		$this->closeConnection($result, $con);
	}

	public function insert() {
		$con = $this->getConnector();
		$sqlQuery = "INSERT INTO `countries`(`country`) VALUES('".$this->country."')";
		$this->getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function insertValue($value) {
		$con = $this->getConnector();
		$sqlQuery = "INSERT INTO `countries`(`country`) VALUES('".$value."')";
		$this->getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function update() {
		$con = $this->getConnector();
		$sqlQuery = "UPDATE `countries` SET `country`='".$this->country."' WHERE `id`=".intval($this->id);
		$this->getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function updateValue($index, $value) {
		$con = $this->getConnector();
		$sqlQuery = "UPDATE `countries` SET `country`='".$value."' WHERE `id`=".intval($index);
		$this->getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function delete() {
		$con = $this->getConnector();
		$sqlQuery = "DELETE FROM `countries` WHERE `id`=".intval($this->id);
		$this->getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function deleteById($index) {
		$con = $this->getConnector();
		$sqlQuery = "DELETE FROM `countries` WHERE `id`=".intval($index);
		$this->getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function search($part_of_word) {
		$con = $this->getConnector();
		$sqlQuery = "SELECT `id`, `country` FROM `countries` WHERE `country` LIKE '%".$part_of_word."%'";
		$result = $this->getQueryResult($con, $sqlQuery);
		print("<table border=1><tr><th>Id</th><th>Country</th></tr>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print(Support::rowsGen($row));
		}
		print("</table");
		$this->closeConnection($result, $con);
	}

	public static function getList() {
		$db = new Database();
		$con = $db->getConnector();		
		$sqlQuery = "SELECT `id`, `country` FROM `countries`";
		$result = $db->getQueryResult($con, $sqlQuery);
		print("<select name='countries'>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print("<option value='".$row['id']."'>".$row['country']."</option>");
		}
		print("</select>");
		$db->closeConnection($result, $con);
	}
}
?>