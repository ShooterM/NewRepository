<?php
include_once("db_class.php");
include_once("interface.php");
/**
 *
 * Class 'Publisher'
 * @author Misha
 *
 */
class Publisher extends Database implements IDatabaseFunction {
	private $id;
	private $pub_name;
	private $address_id;
	private $editor_id;

	const UNKNOWN_STR = "Unknown";
	const UNKNOWN_INT = 0;

	function __construct() {
		$this->pub_name = self::UNKNOWN_STR;
		$this->address_id = self::UNKNOWN_INT;
		$this->editor_id = self::UNKNOWN_INT;
	}

	function writeArray($args) {
		$this->pub_name = $args['pub_name'];
		$this->address_id = $args['address_id'];
		$this->editor_id = $args['editor_id'];
	}

	function writeArrayForId($index, $args) {
		$this->id = $index;
		$this->pub_name = $args['pub_name'];
		$this->address_id = $args['address_id'];
		$this->editor_id = $args['editor_id'];
	}

	public function getId() {
		return $this->id;
	}

	public function setId($value) {
		$this->id = $value;
	}

	public function getPubName() {
		return $this->pub_name;
	}

	public function setPubName($value) {
		$this->pub_name = $value;
	}

	public function getAddressId() {
		return $this->address_id;
	}

	public function setAddressId($value) {
		$this->address_id = $value;
	}

	public function getEditorId() {
		return $this->editor_id;
	}

	public function setEditorId($value) {
		$this->editor_id = $value;
	}

	public function select($order = null) {
		$con = $this->getConnector();
		$sqlQuery = "SELECT `p`.`id`, `p`.`pub_name`, CONCAT_WS(', ',c.country, a.city,a.home,a.post_index) AS 'address', CONCAT_WS(' ',e.name,e.surname) AS `editor` FROM `publishers` `p` JOIN `editors` `e`, `addresses` `a`, `countries` `c` WHERE  `e`.`id`=`p`.`editor_id` AND `a`.`id`=`p`.`address_id` AND `c`.`id`=`a`.`country_id`".$order;
		$result = $this->getQueryResult($con, $sqlQuery);
		print("<table border=1><tr><th>Id</th><th>Publisher</th><th>Address</th><th>Editor</th></tr>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print(Support::rowsGen($row));
		}
		print("</table>");
		$this->closeConnection($result, $con);
	}

	public function insert() {
		$con = $this->getConnector();
		$sqlQuery = "INSERT INTO `publishers`(`pub_name`,`address_id`,`editor_id`)
				VALUES('".$value['pub_name']."', ".intval($this->address_id).", ".intval($this->editor_id).")";
		print($sqlQuery);		
		$this->getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function insertValue($value) {
		$con = $this->getConnector();
		$sqlQuery = "INSERT INTO `publishers`(`pub_name`,`address_id`,`editor_id`)
				VALUES('".$value['pub_name']."', ".intval($value['address_id']).", ".intval($value['editor_id']).")";		
		$this->getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function update() {
		$con = getConnector();
		$sqlQuery = "UPDATE `publishers` SET `pub_name`='".$this->pub_name."',`address_id`=".$this->address_id.",`editor_id`=".$this->editor_id." WHERE `id`=".intval($this->id);
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function updateValue($index, $value) {
		$con = $this->getConnector();
		$sqlQuery = "UPDATE `publishers` SET `pub_name`='".$value['pub_name']."',`address_id`=".$value['address_id'].",`editor_id`=".$value['editor_id']." WHERE `id`=".intval($index);
		$this->getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function delete() {
		$con = $this->getConnector();
		$sqlQuery = "DELETE FROM `publishers` WHERE `id`=".intval($this->id);
		$this->getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function deleteById($index) {
		$con = $this->getConnector();
		$sqlQuery = "DELETE FROM `publishers` WHERE `id`=".intval($index);
		$this->getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function search($part_of_word) {
		$con = $this->getConnector();
		$sqlQuery = "SELECT `p`.`id`, `p`.`pub_name`, CONCAT_WS(', ',c.country, a.city,a.home,a.post_index) AS 'address', CONCAT_WS(' ',e.name,e.surname) AS `editor` FROM `publishers` `p` JOIN `editors` `e`, `addresses` `a`, `countries` `c` WHERE  `e`.`id`=`p`.`editor_id` AND `a`.`id`=`p`.`address_id` AND `c`.`id`=`a`.`country_id` AND `p`.`pub_name` LIKE '%".$part_of_word."%'";
		$result = $this->getQueryResult($con, $sqlQuery);
		print("<table border=1><tr><th>Id</th><th>Publisher</th><th>Address</th><th>Editor</th></tr>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print(Support::rowsGen($row));
		}
		print("</table>");
		$this->closeConnection($result, $con);
	}

	public static function getList() {
		$db = new Database();
		$con = $db->getConnector();
		$sqlQuery = "SELECT `id`, `pub_name` FROM `publishers`";
		$result = $db->getQueryResult($con, $sqlQuery);
		print("<select name='publishers'>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print("<option value=".$row['id'].">".$row['pub_name']."</option>");
		}
		print("</select>");
		$db->closeConnection($result, $con);
	}

}
?>