<?php
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
		$country_id = UNKNOWN_INT;
		$city = UNKNOWN_STR;
		$street = UNKNOWN_STR;
		$house = UNKNOWN_STR;
		$index = UNKNOWN_INT;
	}

	function __construct($args) {
		$country_id = $args['country_id'];
		$city = $args['city'];
		$street = $args['street'];
		$house = $args['house'];
		$index = $args['index'];
	}

	function __construct($num, $args) {
		$id = $num;
		$country_id = $args['country_id'];
		$city = $args['city'];
		$street = $args['street'];
		$house = $args['house'];
		$index = $args['index'];
	}

	public function getId() {
		return $id;
	}

	public function setId($value) {
		$id = $value;
	}

	public function getCountryId() {
		return $country_id;
	}

	public function setCountryId($value) {
		$country_id = $value;
	}

	public function getCity() {
		return $city;
	}

	public function setCity($value) {
		$city = $value;
	}

	public function getStreet() {
		return $street;
	}

	public function setStreet($value) {
		$street = $value;
	}

	public function getHouse() {
		return $house;
	}

	public function setHouse($value) {
		$house = $value;
	}

	public function getIndex() {
		return $index;
	}

	public function setIndex($value) {
		$index = $value;
	}

	public function select($order = null) {
		$con = getConnector();
		$sqlQuery = "SELECT `a`.`id`, `c`.`country`, `a`.`city`, `a`.`street`, `a`.`home`, `a`.`post_index` FROM `addresses` `a`,`countries` `c`  WHERE `a`.`country_id`=`c`.`id`".$order;
		$result = getQueryResult($con, $sqlQuery);
		print("<table border=1><tr><th>Id</th><th>Country</th><th>City</th><th>Street</th><th>House</th><th>Post index</th></tr>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print(Support::rowsGen($row));
		}
		print("</table>");
		closeConnection($result, $con);
	}

	public function insert($value) {
		$con = getConnector();
		$sqlQuery = "INSERT INTO `addresses`(`country_id`, `city`, `street`, `home`, `post_index`)
				VALUES (".intval($value['country_id']).", '".$value['city']."', '".$value['street']."', '".$value['house']."', '".$value['index']."')";
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function update($id, $value) {
		$con = getConnector();
		$sqlQuery = "UPDATE `addresses` SET `country_id`=".intval($value['country_id']).",`city`='".$value['city']."',`street`='".$value['street']."',`home`='".$value['house']."',`post_index`='".$value['index']."' WHERE `id`=".intval($id);
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function delete($id) {
		$con = getConnector();
		$sqlQuery = "DELETE FROM `addresses` WHERE `id`=".intval($id);
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function search($part_of_word) {
		$con = getConnector();
		$sqlQuery = "SELECT `a`.`id`, CONCAT_WS(', ',c.country, a.city,a.home,a.post_index) AS 'address' FROM `addresses` `a` JOIN `countries` `c` WHERE  `c`.`id`=`a`.`country_id` AND CONCAT_WS(', ',c.country, a.city,a.home,a.post_index) LIKE '%".$part_of_word."%'";
		$result = getQueryResult($con, $sqlQuery);
		print("<table border=1><tr><th>Id</th><th>Address</th></tr>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print(Support::rowsGen($row));
		}
		print("</table>");
		closeConnection($result, $con);
	}

	public static function getList() {
		$con = getConnector();
		$sqlQuery = "SELECT `a`.`id`, CONCAT_WS(', ',c.country, a.city,a.home,a.post_index) AS 'address' FROM `addresses` `a` JOIN `countries` `c` WHERE  `c`.`id`=`a`.`country_id`";
		$result = getQueryResult($con, $sqlQuery);
		print("<select name='addresses'>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print("<option value=".$row['id'].">".$row['address']."</option>");
		}
		print("</select>");
		closeConnection($result, $con);
	}
}
?>