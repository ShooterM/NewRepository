<?php
include_once("db_class.php");
include_once("interface.php");
/**
 *
 * Class 'Book'
 * @author Misha
 *
 */
class Book extends Database implements IDatabaseFunction {
	private $id;
	private $author_id;
	private $title;
	private $year;
	private $publisher_id;
	private $page_count;
	private $receipt_date;
	private $genre_id;

	const UNKNOWN_STR = "Unknown";
	const UNKNOWN_DAT = "0000-00-00";
	const UNKNOWN_INT = 0;

	function __construct() {
		$this->author_id = UNKNOWN_INT;
		$this->title = UNKNOWN_STR;
		$this->year = UNKNOWN_INT;
		$this->publisher_id = UNKNOWN_INT;
		$this->page_count = UNKNOWN_INT;
		$this->receipt_date = UNKNOWN_DAT;
		$this->genre_id = UNKNOWN_INT;
	}

	function writeArray($args) {
		$this->author_id = $args['author_id'];
		$this->title = $args['title'];
		$this->year = $args['year'];
		$this->publisher_id = $args['publisher_id'];
		$this->page_count = $args['page_count'];
		$this->receipt_date = $args['receipt_date'];
		$this->genre_id = $args['genre_id'];
	}

	function writeArrayForId($index, $args) {
		$this->id = $index;
		$this->author_id = $args['author_id'];
		$this->title = $args['title'];
		$this->year = $args['year'];
		$this->publisher_id = $args['publisher_id'];
		$this->page_count = $args['page_count'];
		$this->receipt_date = $args['receipt_date'];
		$this->genre_id = $args['genre_id'];
	}

	public function getId() {
		return $this->id;
	}

	public function setId($value) {
		$this->id = $value;
	}

	public function getAuthorId() {
		return $this->author_id;
	}

	public function setAuthorId($value) {
		$this->author_id = $value;
	}

	public function getTitle() {
		return $this->title;
	}

	public function setTitle($value) {
		$this->title = $value;
	}

	public function getYear() {
		return $this->year;
	}

	public function setYear($value) {
		$this->year = $value;
	}

	public function getPublisherId() {
		return $this->publisher_id;
	}

	public function setPublisherId($value) {
		$this->publisher_id = $value;
	}

	public function getPageCount() {
		return $this->page_count;
	}

	public function setPageCount($value) {
		$this->page_count = $value;
	}

	public function getReceiptDate() {
		return $this->receipt_date;
	}

	public function setReceiptDate($value) {
		$this->receipt_date = $value;
	}

	public function getGenreId() {
		return $this->genre_id;
	}

	public function setGenreId($value) {
		$this->genre_id = $value;
	}

	public function select($order = null) {
		$con = $this->getConnector();
		$sqlQuery = "SELECT `b`.`id`, `b`.`title`, `a`.`name`, `a`.`surname`, `p`.`pub_name`, `b`.`year`, `b`.`receipt_date`, `g`.`genre` FROM `books` `b` JOIN `authors` `a`, `publishers` `p`, `genres` `g` WHERE `a`.`id`=`b`.`author_id` AND `p`.`id`=`b`.`publisher_id` AND `g`.`id`=`b`.`genre_id`".$order;
		$result = $this->getQueryResult($con, $sqlQuery);
		print("<table border=1><tr><th>Id</th><th>Title</th><th>Name</th><th>Surname</th><th>Publisher</th><th>Year</th><th>Receipt date</th><th>Genre</th></tr>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print(Support::rowsGen($row));
		}
		print("</table>");
		$this->closeConnection($result, $con);
	}

	public function insert() {
		$con = $this->getConnector();
		$sqlQuery = "INSERT INTO `books`(`author_id`,`title`,`year`,`publisher_id`,`page_count`,`receipt_date`,`genre_id`) VALUES(".intval($this->author_id).", '".$this->title."', ".intval($this->year).", ".intval($this->publisher_id).", ".intval($this->page_count).", '".$this->date."' ,".intval($this->genre_id).")";
		$this->getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function insertValue($value) {
		$con = $this->getConnector();
		$sqlQuery = "INSERT INTO `books`(`author_id`,`title`,`year`,`publisher_id`,`page_count`,`receipt_date`,`genre_id`) VALUES(".intval($value['author_id']).", '".$value['title']."', ".intval($value['year']).", ".intval($value['publisher_id']).", ".intval($value['page_count']).", '".$value['date']."' ,".intval($value['genre_id']).")";
		$this->getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function update() {
		$con = getConnector();
		$sqlQuery = "UPDATE `books` SET `author_id`=".intval($this->author_id).",`title`='".$this->title."',`year`=".intval($this->year).",`publisher_id`=".intval($this->publisher_id).",`page_count`=".intval($this->page_count).",`receipt_date`='".$this->receipt_date."',`genre_id`=".intval($this->genre_id)." WHERE `id`=".intval($this->id);
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function updateValue($index, $value) {
		$con = $this->getConnector();
		$sqlQuery = "UPDATE `books` SET `author_id`=".intval($value['author_id']).",`title`='".$value['title']."',`year`=".intval($value['year']).",`publisher_id`=".intval($value['publisher_id']).",`page_count`=".intval($value['page_count']).",`receipt_date`='".$value['receipt_date']."',`genre_id`=".intval($value['genre_id'])." WHERE `id`=".intval($index);
		$this->getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function delete() {
		$con = $this->getConnector();
		$sqlQuery = "DELETE FROM `books` WHERE `id`=".intval($this->id);
		$this->getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function deleteById($index) {
		$con = $this->getConnector();
		$sqlQuery = "DELETE FROM `books` WHERE `id`=".intval($index);
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function search($part_of_word) {
		$con = $this->getConnector();
		$sqlQuery = "SELECT `b`.`id`, `b`.`title`, `a`.`name`, `a`.`surname`, `p`.`pub_name`, `b`.`year`, `b`.`receipt_date`, `g`.`genre` FROM `books` `b` JOIN `authors` `a`, `publishers` `p`, `genres` `g` WHERE `a`.`id`=`b`.`author_id` AND `p`.`id`=`b`.`publisher_id` AND `g`.`id`=`b`.`genre_id` AND `title` LIKE '%".$part_of_word."%'";
		$result = $this->getQueryResult($con, $sqlQuery);
		print("<table border=1><tr><th>Id</th><th>Title</th><th>Name</th><th>Surname</th><th>Publisher</th><th>Year</th><th>Receipt date</th><th>Genre</th></tr>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print(Support::rowsGen($row));
		}
		print("</table>");
		$this->closeConnection($result, $con);
	}

	public static function getList() {
		$db = new Database();
		$con = $db->getConnector();
		$sqlQuery = "SELECT `id`, `title` FROM `books`";
		$result = $db->getQueryResult($con, $sqlQuery);
		print("<select name='books'>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print("<option value='".$row['id']."'>".$row['title']."</option>");
		}
		print("</select>");
		$db->closeConnection($result, $con);
	}
}
?>