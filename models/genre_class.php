<?php
/**
 *
 * Class 'Genre'
 * @author Misha
 *
 */
class Genre extends Database implements IDatabaseFunction {
	private $id;
	private $genre;

	const UNKNOWN_STR = "Unknown";

	function __construct() {
		$genre = UNKNOWN_STR;
	}

	function __construct($genreName) {
		$genre = $genreName;
	}

	function __construct($index, $genreName) {
		$id = $index;
		$genre = $genreName;
	}

	public function getId() {
		return $id;
	}

	public function setId($value) {
		$id = $value;
	}

	public function getGenre() {
		return $genre;
	}

	public function setGenre($value) {
		$genre = $value;
	}

	public function select($order = null) {
		$con = getConnector();
		$sqlQuery = "SELECT `id`, `genre` FROM `genres`".$order;
		$result = getQueryResult($con, $sqlQuery);
		print("<table border=1><tr><th>Id</th><th>Genre</th></tr>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print(Support::rowsGen($row));
		}
		print("</table>");
		closeConnection($result, $con);
	}

	public function insert($value) {
		$con = getConnector();
		$sqlQuery = "INSERT INTO `genres`(`genre`) VALUES('".$value."')";
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function update($id, $value) {
		$con = getConnector();
		$sqlQuery = "UPDATE `genres` SET `genre`='".$value."' WHERE `id`=".intval($id);
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function delete($id) {
		$con = getConnector();
		$sqlQuery = "DELETE FROM `genres` WHERE `id`=".intval($id);
		getQueryResult($con, $sqlQuery);
		mysql_close($con);
	}

	public function search($part_of_word) {
		$con = getConnector();
		$sqlQuery = "SELECT `id`, `genre` FROM `genres` WHERE `genre` LIKE '%".$part_of_word."%'";
		$result = getQueryResult($con, $sqlQuery);
		print("<table border=1><tr><th>Id</th><th>Genre</th></tr>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print(Support::rowsGen($row));
		}
		print("</table>");
		closeConnection($result, $con);
	}

	public static function getList() {
		$con = getConnector();
		$sqlQuery = "SELECT `id`, `genre` FROM `genres`";
		$result = getQueryResult($con, $sqlQuery);
		print("<select name='genres'>");
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			print("<option value=".$row['id'].">".$row['genre']."</option>");
		}
		print("</select>");
		closeConnection($result, $con);
	}
}
?>