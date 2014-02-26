<?php
include_once("db_class.php");
include_once("interface.php");
/**
 *
 * Class 'Address'
 * @author Misha
 *
 */
class Address extends Database implements IDatabaseFunction {
	private $id;
	private $country_id;
	private $city;
	private $street;
	private $house;
	private $index;

	const UNKNOWN_STR = "Unknown";
	const UNKNOWN_INT = 0;

	function __construct() {
		$this->country_id = self::UNKNOWN_INT;
		$this->city = self::UNKNOWN_STR;
		$this->street = self::UNKNOWN_STR;
		$this->house = self::UNKNOWN_STR;
		$this->index = self::UNKNOWN_INT;		
	}

	function writeArray($args) {
		$this->country_id = $args['country_id'];
		$this->city = $args['city'];
		$this->street = $args['street'];
		$this->house = $args['house'];
		$this->index = $args['index'];
	}

	function writeArrayForId($num, $args) {
		$this->id = $num;
		$this->country_id = $args['country_id'];
		$this->city = $args['city'];
		$this->street = $args['street'];
		$this->house = $args['house'];
		$this->index = $args['index'];
	}

	public function getId() {
		return $this->id;
	}

	public function setId($value) {
		$this->id = $value;
	}

	public function getCountryId() {
		return $this->country_id;
	}

	public function setCountryId($value) {
		$this->country_id = $value;
	}

	public function getCity() {
		return $this->city;
	}

	public function setCity($value) {
		$this->city = $value;
	}

	public function getStreet() {
		return $this->street;
	}

	public function setStreet($value) {
		$this->street = $value;
	}

	public function getHouse() {
		return $this->house;
	}

	public function setHouse($value) {
		$this->house = $value;
	}

	public function getIndex() {
		return $this->index;
	}

	public function setIndex($value) {
		$this->index = $value;
	}

	public function select($order = null) {
		$con = $this->getConnector();
		$sqlQuery = "SELECT `a`.`id`, `c`.`country`, `a`.`city`, `a`.`street`, `a`.`home`, `a`.`post_index` FROM `addresses` `a`,`countries` `c`  WHERE `a`.`country_id`=`c`.`id`".$order;
		$result = $this->getQueryResult($con, $sqlQuery);
		print("<table border=1><tr><th>Id</th><th>Country</th><th>City</th><th>Street</th><th>House</th><th>Post index</th></tr>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print(Support::rowsGen($row));
		}
		print("</table>");
		$this->closeConnection($result, $con);
	}

	public function insert() {
		$con = $this->getConnector();
		$sqlQuery = "INSERT INTO `addresses`(`country_id`, `city`, `street`, `home`, `post_index`)
				VALUES (".intval($this->country_id).", '".$this->city."', '".$this->street."', '".$this->house."', '".$this->index."')";
		$this->getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function insertValue($value) {
		$con = $this->getConnector();
		$sqlQuery = "INSERT INTO `addresses`(`country_id`, `city`, `street`, `home`, `post_index`)
				VALUES (".intval($value['country_id']).", '".$value['city']."', '".$value['street']."', '".$value['house']."', '".$value['index']."')";
		$this->getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function update() {
		$con = $this->getConnector();
		$sqlQuery = "UPDATE `addresses` SET `country_id`=".intval($this->country_id).",`city`='".$this->city."',`street`='".$this->street."',`home`='".$this->house."',`post_index`='".$this->index."' WHERE `id`=".intval($this->id);
		$this->getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function updateValue($ind, $value) {
		$con = $this->getConnector();
		$sqlQuery = "UPDATE `addresses` SET `country_id`=".intval($value['country_id']).",`city`='".$value['city']."',`street`='".$value['street']."',`home`='".$value['house']."',`post_index`='".$value['index']."' WHERE `id`=".intval($ind);
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function delete() {
		$con = getConnector();
		$sqlQuery = "DELETE FROM `addresses` WHERE `id`=".intval($this->id);
		$this->getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function deleteById($ind) {
		$con = $this->getConnector();
		$sqlQuery = "DELETE FROM `addresses` WHERE `id`=".intval($ind);
		$this->getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function search($part_of_word) {
		$con = $this->getConnector();
		$sqlQuery = "SELECT `a`.`id`, CONCAT_WS(', ',c.country, a.city,a.home,a.post_index) AS 'address' FROM `addresses` `a` JOIN `countries` `c` WHERE  `c`.`id`=`a`.`country_id` AND CONCAT_WS(', ',c.country, a.city,a.home,a.post_index) LIKE '%".$part_of_word."%'";
		$result = $this->getQueryResult($con, $sqlQuery);
		print("<table border=1><tr><th>Id</th><th>Address</th></tr>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print(Support::rowsGen($row));
		}
		print("</table>");
		$this->closeConnection($result, $con);
	}

	public static function getList() {
		$db = new Database();
		$con = $db->getConnector();
		$sqlQuery = "SELECT `a`.`id`, CONCAT_WS(', ',c.country, a.city,a.home,a.post_index) AS 'address' FROM `addresses` `a` JOIN `countries` `c` WHERE  `c`.`id`=`a`.`country_id`";
		$result = $db->getQueryResult($con, $sqlQuery);
		print("<select name='addresses'>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print("<option value=".$row['id'].">".$row['address']."</option>");
		}
		print("</select>");
		$db->closeConnection($result, $con);
	}
}
?>