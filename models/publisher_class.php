<?php
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
		$pub_name = UNKNOWN_STR;
		$address_id = UNKNOWN_INT;
		$editor_id = UNKNOWN_INT;
	}

	function __construct($args) {
		$pub_name = $args['pub_name'];
		$address_id = $args['address_id'];
		$editor_id = $args['editor_id'];
	}

	function __construct($index, $args) {
		$id = $index;
		$pub_name = $args['pub_name'];
		$address_id = $args['address_id'];
		$editor_id = $args['editor_id'];
	}

	function __construct($pubName, $addressId, $editorId) {
		$pub_name = $pubName;
		$address_id = $addressId;
		$editor_id = $editorId;
	}

	function __construct($index, $pubName, $addressId, $editorId) {
		$id = $index;
		$pub_name = $pubName;
		$address_id = $addressId;
		$editor_id = $editorId;
	}
	public function getId() {
		return $id;
	}

	public function setId($value) {
		$id = $value;
	}

	public function getPubName() {
		return $pub_name;
	}

	public function setPubName($value) {
		$pub_name = $value;
	}

	public function getAddressId() {
		return $address_id;
	}

	public function setAddressId($value) {
		$address_id = $value;
	}

	public function getEditorId() {
		return $editor_id;
	}

	public function setEditorId($value) {
		$editor_id = $value;
	}

	public function select($order = null) {
		$con = getConnector();
		$sqlQuery = "SELECT `p`.`id`, `p`.`pub_name`, CONCAT_WS(', ',c.country, a.city,a.home,a.post_index) AS 'address', CONCAT_WS(' ',e.name,e.surname) AS `editor` FROM `publishers` `p` JOIN `editors` `e`, `addresses` `a`, `countries` `c` WHERE  `e`.`id`=`p`.`editor_id` AND `a`.`id`=`p`.`address_id` AND `c`.`id`=`a`.`country_id`".$order;
		$result = getQueryResult($con, $sqlQuery);
		print("<table border=1><tr><th>Id</th><th>Publisher</th><th>Address</th><th>Editor</th></tr>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print(Support::rowsGen($row));
		}
		print("</table>");
		closeConnection($result, $con);
	}

	public function insert() {
		$con = getConnector();
		$sqlQuery = "INSERT INTO `publishers`(`pub_name`,`address_id`,`editor_id`)
				VALUES('".$value['pub_name']."', ".intval($this->address_id).", ".intval($this->editor_id).")";		
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function insert($value) {
		$con = getConnector();
		$sqlQuery = "INSERT INTO `publishers`(`pub_name`,`address_id`,`editor_id`)
				VALUES('".$value['pub_name']."', ".intval($value['address_id']).", ".intval($value['editor_id']).")";		
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function update() {
		$con = getConnector();
		$sqlQuery = "UPDATE `publishers` SET `pub_name`='".$this->pub_name."',`address_id`=".$this->address_id.",`editor_id`=".$this->editor_id." WHERE `id`=".intval($this->id);
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function update($index, $value) {
		$con = getConnector();
		$sqlQuery = "UPDATE `publishers` SET `pub_name`='".$value['pub_name']."',`address_id`=".$value['address_id'].",`editor_id`=".$value['editor_id']." WHERE `id`=".intval($index);
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function delete() {
		$con = getConnector();
		$sqlQuery = "DELETE FROM `publishers` WHERE `id`=".intval($this->id);
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function delete($index) {
		$con = getConnector();
		$sqlQuery = "DELETE FROM `publishers` WHERE `id`=".intval($index);
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function search($part_of_word) {
		$con = getConnector();
		$sqlQuery = "SELECT `p`.`id`, `p`.`pub_name`, CONCAT_WS(', ',c.country, a.city,a.home,a.post_index) AS 'address', CONCAT_WS(' ',e.name,e.surname) AS `editor` FROM `publishers` `p` JOIN `editors` `e`, `addresses` `a`, `countries` `c` WHERE  `e`.`id`=`p`.`editor_id` AND `a`.`id`=`p`.`address_id` AND `c`.`id`=`a`.`country_id` AND `p`.`pub_name` LIKE '%".$part_of_word."%'";
		$result = getQueryResult($con, $sqlQuery);
		print("<table border=1><tr><th>Id</th><th>Publisher</th><th>Address</th><th>Editor</th></tr>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print(Support::rowsGen($row));
		}
		print("</table>");
		closeConnection($result, $con);
	}

	public static function getList() {
		$con = getConnector();
		$sqlQuery = "SELECT `id`, `pub_name` FROM `publishers`";
		$result = getQueryResult($con, $sqlQuery);
		print("<select name='publishers'>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print("<option value=".$row['id'].">".$row['pub_name']."</option>");
		}
		print("</select>");
		closeConnection($result, $con);
	}

}
?>