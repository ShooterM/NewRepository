<?php
include_once("db_class.php");
include_once("interface.php");
/**
 *
 * Class 'Author'
 * @author Misha
 *
 */
class Author extends Database implements IDatabaseFunction {
	private $id;
	private $name;
	private $surname;
	private $birth_date;
	private $death_date;
	private $country_id;

	const UNKNOWN_STR = "Unknown";
	const UNKNOWN_DAT = "0000-00-00";
	const UNKNOWN_INT = 0;

	function __construct() {		
		$this->name = UNKNOWN_STR;
		$this->surname = UNKNOWN_STR;
		$this->birth_date = UNKNOWN_DAT;
		$this->death_date = UNKNOWN_DAT;
		$this->country_id = UNKNOWN_INT;
	}

	function writeArray($args) {
		$this->name = $args['name'];
		$this->surname = $args['surname'];
		$this->birth_date = $args['birth_date'];
		$this->death_date = $args['death_date'];
		$this->country_id = $args['country_id'];
	}

	function writeArrayForId($index, $args) {
		$this->id = $index;
		$this->name = $args['name'];
		$this->surname = $args['surname'];
		$this->birth_date = $args['birth_date'];
		$this->death_date = $args['death_date'];
		$this->country_id = $args['country_id'];
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

	public function getBirthDate() {
		return $this->birth_date;
	}

	public function setBirthDate($value) {
		$this->birht_date = $value;
	}

	public function getDeathDate() {
		return $this->death_date;
	}

	public function setDeathDate($value) {
		$this->death_date = $value;
	}

	public function getCountryId() {
		return $this->country_id;
	}

	public function setCountryId($value) {
		$this->country_id = $value;
	}

	public function select($order = null) {
		$con = $this->getConnector();
		$sqlQuery = "SELECT `a`.`id`, `a`.`name`, `a`.`surname`, `a`.`birth_date`, `a`.`death_date`, `c`.`country` FROM `authors` `a` JOIN `countries` `c` ON `a`.`country_id`=`c`.`id`".$order;
		$result = $this->getQueryResult($con, $sqlQuery);
		print("<table border=1><tr><th>Id</th><th>Name</th><th>Surname</th><th>Birth date</th><th>Death date</th><th>Country</th></tr>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print(Support::rowsGen($row));
		}
		print("</table>");
		$this->closeConnection($result, $con);
	}


	public function insert() {
		$con = $this->getConnector();
		$sqlQuery = "INSERT INTO `authors`(`name`,`surname`,`birth_date`,`death_date`,`country_id`)
				VALUES('".$this->name."', '".$this->surname."', '".$this->birth_date."', '".$this->death_date."', ".intval($this->country_id).")";
		$this->getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function insertValue($value) {
		$con = $this->getConnector();
		$sqlQuery = "INSERT INTO `authors`(`name`,`surname`,`birth_date`,`death_date`,`country_id`)
				VALUES('".$value['name']."', '".$value['surname']."', '".$value['birth_date']."', '".$value['death_date']."', ".intval($value['country_id']).")";
		$this->getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function update() {
		$con = $this->getConnector();
		$sqlQuery = "UPDATE `authors` SET `name`='".$this->name."',`surname`='".$this->surname."',`birth_date`='".$this->birth_date."',`death_date`='".$this->death_date."',`country_id`=".intval($this->country_id)." WHERE `id`=".intval($this->id);
		$this->getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function updateValue($index, $value) {
		$con = $this->getConnector();
		$sqlQuery = "UPDATE `authors` SET `name`='".$value['name']."',`surname`='".$value['surname']."',`birth_date`='".$value['birth_date']."',`death_date`='".$value['death_date']."',`country_id`=".intval($value['country_id'])." WHERE `id`=".intval($index);
		$this->getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function delete() {
		$con = $this->getConnector();
		$sqlQuery = "DELETE FROM `authors` WHERE `id`=".intval($this->id);
		$this->getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function deleteById($index) {
		$con = $this->getConnector();
		$sqlQuery = "DELETE FROM `authors` WHERE `id`=".intval($index);
		$this->getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function search($part_of_word) {
		$con = $this->getConnector();
		$sqlQuery = "SELECT `a`.`id`, `a`.`name`, `a`.`surname`, `a`.`birth_date`, `a`.`death_date`, `c`.`country` FROM `authors` `a` JOIN `countries` `c` ON `a`.`country_id`=`c`.`id` WHERE CONCAT_WS(' ',`a`.`name`, `a`.`surname`) LIKE '%".$part_of_word."%'";
		$result = $this->getQueryResult($con, $sqlQuery);
		print("<table border=1><tr><th>Id</th><th>Name</th><th>Surname</th><th>Birth date</th><th>Death date</th><th>Country</th></tr>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print(Support::rowsGen($row));
		}
		print("</table>");
		$this->closeConnection($result, $con);
	}

	public static function getList() {
		$db = new Database();
		$con = $db->getConnector();
		$sqlQuery = "SELECT `a`.`id`, CONCAT_WS(' ',a.name,a.surname) AS `author`  FROM `authors` `a`";
		$result = $db->getQueryResult($con, $sqlQuery);
		print("<select name='authors'>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print("<option value=".$row['id'].">".$row['author']."</option>");
		}
		print("</select>");
		$db->closeConnection($result, $con);
	}
}
?>