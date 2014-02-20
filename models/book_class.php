<?php
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
		$author_id = UNKNOWN_INT;
		$title = UNKNOWN_STR;
		$year = UNKNOWN_INT;
		$publisher_id = UNKNOWN_INT;
		$page_count = UNKNOWN_INT;
		$receipt_date = UNKNOWN_DAT;
		$genre_id = UNKNOWN_INT;
	}

	function __construct($args) {
		$author_id = $args['author_id'];
		$title = $args['title'];
		$year = $args['year'];
		$publisher_id = $args['publisher_id'];
		$page_count = $args['page_count'];
		$receipt_date = $args['receipt_date'];
		$genre_id = $args['genre_id'];
	}

	function __construct($index, $args) {
		$id = $index;
		$author_id = $args['author_id'];
		$title = $args['title'];
		$year = $args['year'];
		$publisher_id = $args['publisher_id'];
		$page_count = $args['page_count'];
		$receipt_date = $args['receipt_date'];
		$genre_id = $args['genre_id'];
	}

	function __construct($authorId, $bTitle, $bYear, $publisherId, $pageCount, $receiptDate, $genreId) {
		$author_id = $authorId;
		$title = $bTitle;
		$year = $bYear;
		$publisher_id = $publisherId;
		$page_count = $pageCount;
		$receipt_date = $receiptDate;
		$genre_id = $genreId;
	}

	function __construct($index, $authorId, $bTitle, $bYear, $publisherId, $pageCount, $receiptDate, $genreId) {
		$id = $index;
		$author_id = $authorId;
		$title = $bTitle;
		$year = $bYear;
		$publisher_id = $publisherId;
		$page_count = $pageCount;
		$receipt_date = $receiptDate;
		$genre_id = $genreId;
	}

	public function getId() {
		return $id;
	}

	public function setId($value) {
		$id = $value;
	}

	public function getAuthorId() {
		return $author_id;
	}

	public function setAuthorId($value) {
		$author_id = $value;
	}

	public function getTitle() {
		return $title;
	}

	public function setTitle($value) {
		$title = $value;
	}

	public function getYear() {
		return $year;
	}

	public function setYear($value) {
		$year = $value;
	}

	public function getPublisherId() {
		return $publisher_id;
	}

	public function setPublisherId($value) {
		$publisher_id = $value;
	}

	public function getPageCount() {
		return $page_count;
	}

	public function setPageCount($value) {
		$page_count = $value;
	}

	public function getReceiptDate() {
		return $receipt_date;
	}

	public function setReceiptDate($value) {
		$receipt_date = $value;
	}

	public function getGenreId() {
		return $genre_id;
	}

	public function setGenreId($value) {
		$genre_id = $value;
	}

	public function select($order = null) {
		$con = getConnector();
		$sqlQuery = "SELECT `b`.`id`, `b`.`title`, `a`.`name`, `a`.`surname`, `p`.`pub_name`, `b`.`year`, `b`.`receipt_date`, `g`.`genre` FROM `books` `b` JOIN `authors` `a`, `publishers` `p`, `genres` `g` WHERE `a`.`id`=`b`.`author_id` AND `p`.`id`=`b`.`publisher_id` AND `g`.`id`=`b`.`genre_id`".$order;
		$result = getQueryResult($con, $sqlQuery);
		print("<table border=1><tr><th>Id</th><th>Title</th><th>Name</th><th>Surname</th><th>Publisher</th><th>Year</th><th>Receipt date</th><th>Genre</th></tr>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print(Support::rowsGen($row));
		}
		print("</table>");
		closeConnection($result, $con);
	}

	public function insert() {
		$con = getConnector();
		$sqlQuery = "INSERT INTO `books`(`author_id`,`title`,`year`,`publisher_id`,`page_count`,`receipt_date`,`genre_id`) VALUES(".intval($this->author_id).", '".$this->title."', ".intval($this->year).", ".intval($this->publisher_id).", ".intval($this->page_count).", '".$this->date."' ,".intval($this->genre_id).")";
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function insert($value) {
		$con = getConnector();
		$sqlQuery = "INSERT INTO `books`(`author_id`,`title`,`year`,`publisher_id`,`page_count`,`receipt_date`,`genre_id`) VALUES(".intval($value['author_id']).", '".$value['title']."', ".intval($value['year']).", ".intval($value['publisher_id']).", ".intval($value['page_count']).", '".$value['date']."' ,".intval($value['genre_id']).")";
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function update() {
		$con = getConnector();
		$sqlQuery = "UPDATE `books` SET `author_id`=".intval($this->author_id).",`title`='".$this->title."',`year`=".intval($this->year).",`publisher_id`=".intval($this->publisher_id).",`page_count`=".intval($this->page_count).",`receipt_date`='".$this->receipt_date."',`genre_id`=".intval($this->genre_id)." WHERE `id`=".intval($this->id);
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function update($index, $value) {
		$con = getConnector();
		$sqlQuery = "UPDATE `books` SET `author_id`=".intval($value['author_id']).",`title`='".$value['title']."',`year`=".intval($value['year']).",`publisher_id`=".intval($value['publisher_id']).",`page_count`=".intval($value['page_count']).",`receipt_date`='".$value['receipt_date']."',`genre_id`=".intval($value['genre_id'])." WHERE `id`=".intval($index);
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function delete() {
		$con = getConnector();
		$sqlQuery = "DELETE FROM `books` WHERE `id`=".intval($this->id);
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function delete($index) {
		$con = getConnector();
		$sqlQuery = "DELETE FROM `books` WHERE `id`=".intval($index);
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function search($part_of_word) {
		$con = getConnector();
		$sqlQuery = "SELECT `b`.`id`, `b`.`title`, `a`.`name`, `a`.`surname`, `p`.`pub_name`, `b`.`year`, `b`.`receipt_date`, `g`.`genre` FROM `books` `b` JOIN `authors` `a`, `publishers` `p`, `genres` `g` WHERE `a`.`id`=`b`.`author_id` AND `p`.`id`=`b`.`publisher_id` AND `g`.`id`=`b`.`genre_id` AND `title` LIKE '%".$part_of_word."%'";
		$result = getQueryResult($con, $sqlQuery);
		print("<table border=1><tr><th>Id</th><th>Title</th><th>Name</th><th>Surname</th><th>Publisher</th><th>Year</th><th>Receipt date</th><th>Genre</th></tr>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print(Support::rowsGen($row));
		}
		print("</table>");
		closeConnection($result, $con);
	}

	public static function getList() {
		$con = getConnector();
		$sqlQuery = "SELECT `id`, `title` FROM `books`";
		$result = getQueryResult($con, $sqlQuery);
		print("<select name='books'>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print("<option value='".$row['id']."'>".$row['title']."</option>");
		}
		print("</select>");
		closeConnection($result, $con);
	}
}
?>