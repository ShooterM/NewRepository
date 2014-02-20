<?php
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
		$name = UNKNOWN_STR;
		$surname = UNKNOWN_STR;
		$birth_date = UNKNOWN_DAT;
		$death_date = UNKNOWN_DAT;
		$country_id = UNKNOWN_INT;
	}

	function __construct($args) {
		$name = $args['name'];
		$surname = $args['surname'];
		$birth_date = $args['birth_date'];
		$death_date = $args['death_date'];
		$country_id = $args['country_id'];
	}

	function __construct($index, $args) {
		$id = $index;
		$name = $args['name'];
		$surname = $args['surname'];
		$birth_date = $args['birth_date'];
		$death_date = $args['death_date'];
		$country_id = $args['country_id'];
	}

	function __construct($aName, $aSurname, $aBirth_date, $aDeath_date, $countryId) {
		$name = $aName;
		$surname = $aSurname;
		$birth_date = $aBirth_date;
		$death_date = $aDeath_date;
		$country_id = $countryId;
	}

	function __construct($index, $aName, $aSurname, $aBirth_date, $aDeath_date, $countryId) {
		$id = $index;
		$surname = $aSurname;
		$birth_date = $aBirth_date;
		$death_date = $aDeath_date;
		$country_id = $countryId;
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

	public function getBirthDate() {
		return $birth_date;
	}

	public function setBirthDate($value) {
		$birht_date = $value;
	}

	public function getDeathDate() {
		return $death_date;
	}

	public function setDeathDate($value) {
		$death_date = $value;
	}

	public function getCountryId() {
		return $country_id;
	}

	public function setCountryId($value) {
		$country_id = $value;
	}

	public function select($order = null) {
		$con = getConnector();
		$sqlQuery = "SELECT `a`.`id`, `a`.`name`, `a`.`surname`, `a`.`birth_date`, `a`.`death_date`, `c`.`country` FROM `authors` `a` JOIN `countries` `c` ON `a`.`country_id`=`c`.`id`".$order;
		$result = getQueryResult($con, $sqlQuery);
		print("<table border=1><tr><th>Id</th><th>Name</th><th>Surname</th><th>Birth date</th><th>Death date</th><th>Country</th></tr>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print(Support::rowsGen($row));
		}
		print("</table>");
		closeConnection($result, $con);
	}

	public function insert($value) {
		$con = getConnector();
		$sqlQuery = "INSERT INTO `authors`(`name`,`surname`,`birth_date`,`death_date`,`country_id`)
				VALUES('".$value['name']."', '".$value['surname']."', '".$value['birth_date']."', '".$value['death_date']."', ".intval($value['country_id']).")";
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function update($id, $value) {
		$con = getConnector();
		$sqlQuery = "UPDATE `authors` SET `name`='".$value['name']."',`surname`='".$value['surname']."',`birth_date`='".$value['birth_date']."',`death_date`='".$value['death_date']."',`country_id`=".intval($value['country_id'])." WHERE `id`=".intval($id);
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function delete($id) {
		$con = getConnector();
		$sqlQuery = "DELETE FROM `authors` WHERE `id`=".intval($id);
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function search($part_of_word) {
		$con = getConnector();
		$sqlQuery = "SELECT `a`.`id`, `a`.`name`, `a`.`surname`, `a`.`birth_date`, `a`.`death_date`, `c`.`country` FROM `authors` `a` JOIN `countries` `c` ON `a`.`country_id`=`c`.`id` WHERE CONCAT_WS(' ',`a`.`name`, `a`.`surname`) LIKE '%".$part_of_word."%'";
		$result = getQueryResult($con, $sqlQuery);
		print("<table border=1><tr><th>Id</th><th>Name</th><th>Surname</th><th>Birth date</th><th>Death date</th><th>Country</th></tr>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print(Support::rowsGen($row));
		}
		print("</table>");
		closeConnection($result, $con);
	}

	public static function getList() {
		$con = getConnector();
		$sqlQuery = "SELECT `a`.`id`, CONCAT_WS(' ',a.name,a.surname) AS `author`  FROM `authors` `a`";
		$result = getQueryResult($con, $sqlQuery);
		print("<select name='authors'>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print("<option value=".$row['id'].">".$row['author']."</option>");
		}
		print("</select>");
		closeConnection($result, $con);
	}
}
?>