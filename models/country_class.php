<?php
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
		$country = UNKNOWN_STR;
	}

	function __construct($countryName) {
		$country = $countryName;
	}

	function __construct($index, $countryName) {
		$id = $index;
		$country = $countryName;
	}

	public function getId() {
		return $id;
	}

	public function setId($value) {
		$id = $value;
	}

	public function getCountry() {
		return $country;
	}

	public function setCountry($value) {
		$country = $value;
	}

	public function select($order = null) {
		$con = getConnector();
		$sqlQuery = "SELECT `id`, `country` FROM `countries`".$order;
		$result = getQueryResult($con, $sqlQuery);
		print("<table border=1><tr><th>Id</th><th>Country</th></tr>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print(Support::rowsGen($row));
		}
		print("</table");
		closeConnection($result, $con);
	}

	public function insert() {
		$con = getConnector();
		$sqlQuery = "INSERT INTO `countries`(`country`) VALUES('".$this->country."')";
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function insert($value) {
		$con = getConnector();
		$sqlQuery = "INSERT INTO `countries`(`country`) VALUES('".$value."')";
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function update() {
		$con = getConnector();
		$sqlQuery = "UPDATE `countries` SET `country`='".$this->country."' WHERE `id`=".intval($this->id);
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function update($index, $value) {
		$con = getConnector();
		$sqlQuery = "UPDATE `countries` SET `country`='".$value."' WHERE `id`=".intval($index);
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function delete() {
		$con = getConnector();
		$sqlQuery = "DELETE FROM `countries` WHERE `id`=".intval($this->id);
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function delete($index) {
		$con = getConnector();
		$sqlQuery = "DELETE FROM `countries` WHERE `id`=".intval($index);
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function search($part_of_word) {
		$sqlQuery = "SELECT `id`, `country` FROM `countries` WHERE `country` LIKE '%".$part_of_word."%'";
		$result = getQueryResult($con, $sqlQuery);
		print("<table border=1><tr><th>Id</th><th>Country</th></tr>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print(Support::rowsGen($row));
		}
		print("</table");
		closeConnection($result, $con);
	}

	public static function getList() {
		$con = getConnector();
		$sqlQuery = "SELECT `id`, `country` FROM `countries`";
		$result = getQueryResult($con, $sqlQuery);
		print("<select name='countries'>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print("<option value='".$row['id']."'>".$row['country']."</option>");
		}
		print("</select>");
		closeConnection($result, $con);
	}
}
?>