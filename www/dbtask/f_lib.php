<?php

function getCorectDate($date) {
	return  str_replace("/", "-", $date);
}

function loadSubPages($page) {
	if ($page === "all") {
		require("smallTables.php");
	} else {
		require("search.php");
	}
}

function rowsGen($row) {
	$newRow = "<tr>";
	foreach ($row as $col) {
		if (!is_null($col)) {
			$newRow = $newRow."<td>".$col."</td>";
		} else {
			$newRow = $newRow."<td>-</td>";
		}
	}
	return $newRow."</tr>";
}

function showBooks($order = NULL) {
	$con = getConnector();	
	$sqlQuery = "SELECT `b`.`id`, `b`.`title`, `a`.`name`, `a`.`surname`, `p`.`pub_name`, `b`.`year`, `b`.`receipt_date`, `g`.`genre` FROM `books` `b` JOIN `authors` `a`, `publishers` `p`, `genres` `g` WHERE `a`.`id`=`b`.`author_id` AND `p`.`id`=`b`.`publisher_id` AND `g`.`id`=`b`.`genre_id`".$order;
	$result = getQueryResult($con, $sqlQuery);
	print("<table border=1><tr><th>Id</th><th>Title</th><th>Name</th><th>Surname</th><th>Publisher</th><th>Year</th><th>Receipt date</th><th>Genre</th></tr>");
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
		print(rowsGen($row));
	}
	print("</table>");
	closeConnection($result, $con);
}

function showAuthors($order = NULL) {
	$con = getConnector();
	$sqlQuery = "SELECT `a`.`id`, `a`.`name`, `a`.`surname`, `a`.`birth_date`, `a`.`death_date`, `c`.`country` FROM `authors` `a` JOIN `countries` `c` ON `a`.`country_id`=`c`.`id`".$order;
	$result = getQueryResult($con, $sqlQuery);
	print("<table border=1><tr><th>Id</th><th>Name</th><th>Surname</th><th>Birth date</th><th>Death date</th><th>Country</th></tr>");
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
		print(rowsGen($row));
	}
	print("</table>");
	closeConnection($result, $con);
}

function showPublishers($order = NULL) {
	$con = getConnector();
	$sqlQuery = "SELECT `p`.`id`, `p`.`pub_name`, CONCAT_WS(', ',c.country, a.city,a.home,a.post_index) AS 'address', CONCAT_WS(' ',e.name,e.surname) AS `editor` FROM `publishers` `p` JOIN `editors` `e`, `addresses` `a`, `countries` `c` WHERE  `e`.`id`=`p`.`editor_id` AND `a`.`id`=`p`.`address` AND `c`.`id`=`a`.`country_id`".$order;
	$result = getQueryResult($con, $sqlQuery);
	print("<table border=1><tr><th>Id</th><th>Publisher</th><th>Address</th><th>Editor</th></tr>");
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
		print(rowsGen($row));
	}
	print("</table>");
	closeConnection($result, $con);
}

function showCountries() {
	$con = getConnector();
	$sqlQuery = "SELECT `id`, `country` FROM `countries`";
	$result = getQueryResult($con, $sqlQuery);
	print("<table border=1><tr><th>Id</th><th>Country</th></tr>");
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
		print(rowsGen($row));
	}
	print("</table>");
	closeConnection($result, $con);
}

function showEditors() {
	$con = getConnector();
	$sqlQuery = "SELECT `id`, `name`, `surname` FROM `editors`";
	$result = getQueryResult($con, $sqlQuery);
	print("<table border=1><tr><th>Id</th><th>Name</th><th>Surname</th></tr>");
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
		print(rowsGen($row));
	}
	print("</table>");
	closeConnection($result, $con);
}

function showAddresses() {
	$con = getConnector();
	$sqlQuery = "SELECT `a`.`id`, `c`.`country`, `a`.`city`, `a`.`street`, `a`.`home`, `a`.`post_index` FROM `addresses` `a`,`countries` `c`  WHERE `a`.`country_id`=`c`.`id`";
	$result = getQueryResult($con, $sqlQuery);
	print("<table border=1><tr><th>Id</th><th>Country</th><th>City</th><th>Street</th><th>House</th><th>Post index</th></tr>");
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
		print(rowsGen($row));
	}
	print("</table>");
	closeConnection($result, $con);
}

function showGenres() {
	$con = getConnector();
	$sqlQuery = "SELECT `id`, `genre` FROM `genres`";
	$result = getQueryResult($con, $sqlQuery);
	print("<table border=1><tr><th>Id</th><th>Genre</th></tr>");
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
		print(rowsGen($row));
	}
	print("</table>");
	closeConnection($result, $con);
}

function addBook($book) {
	$con = getConnector();
	$sqlQuery = "INSERT INTO `books`(`author_id`,`title`,`year`,`publisher_id`,`page_count`,`receipt_date`,`genre_id`) 
				VALUES(".intval($book['author_id']).", '".$book['title']."', ".intval($book['year']).", ".intval($book['publisher_id']).", ".intval($book['page_count']).", '".$book['receipt_date']."', ".intval($book['genre_id']).")";
	getQueryResult($con, $sqlQuery);
	mysql_close($con);
}

function addAuthor($author) {
	$con = getConnector();
	$sqlQuery = "INSERT INTO `authors`(`name`,`surname`,`birth_date`,`death_date`,`country_id`) 
				VALUES('".intval($author['name'])."', '".$author['surname']."', '".$author['birth_date']."', '".$author['death_date']."', ".intval($author['country_id']).")";
	getQueryResult($con, $sqlQuery);
	mysql_close($con);
}

function addPublisher($publisher) {
	$con = getConnector();
	$sqlQuery = "INSERT INTO `publishers`(`pub_name`,`address`,`editor_id`) 
				VALUES('".$publisher['pub_name']."', ".intval($publisher['address_id']).", ".intval($publisher['editor_id']).")";
	getQueryResult($con, $sqlQuery);
	mysql_close($con);
}

function addCountry($country) {
	$con = getConnector();
	$sqlQuery = "INSERT INTO `countries`(`country`) VALUES('".$country."')";
	getQueryResult($con, $sqlQuery);
	mysql_close($con);
}

function addEditor($editor) {
	$con = getConnector();
	$sqlQuery = "INSERT INTO `editors`(`name`,`surname`) VALUES('".$editor['name']."', '".$editor['surname']."')";
	getQueryResult($con, $sqlQuery);
	mysql_close($con);
}

function addAddress($address) {
	$con = getConnector();
	$sqlQuery = "INSERT INTO `addresses`(`country_id`, `city`, `street`, `home`, `post_index`) 
				VALUES (".intval($address['country_id']).", '".$address['city']."', '".$address['street']."', '".$address['house']."', '".$address['index']."')";
	getQueryResult($con, $sqlQuery);
	mysql_close($con);
}

function addGenre($genre) {
	$con = getConnector();
	$sqlQuery = "INSERT INTO `genres`(`genre`) VALUES('".$genre."')";
	getQueryResult($con, $sqlQuery);
	mysql_close($con);
}

function removeBook($id){
	$con = getConnector();
	$sqlQuery = "DELETE FROM `books` WHERE `id`=".intval($id);
	getQueryResult($con, $sqlQuery);	
	mysql_close($con);
}

function removeAuthor($id) {
	$con = getConnector();
	$sqlQuery = "DELETE FROM `authors` WHERE `id`=".intval($id);
	getQueryResult($con, $sqlQuery);	
	mysql_close($con);
}

function removePublisher($id) {
	$con = getConnector();
	$sqlQuery = "DELETE FROM `publishers` WHERE `id`=".intval($id);
	getQueryResult($con, $sqlQuery);	
	mysql_close($con);
}

function removeCountry($id) {
	$con = getConnector();
	$sqlQuery = "DELETE FROM `countries` WHERE `id`=".intval($id);
	getQueryResult($con, $sqlQuery);	
	mysql_close($con);
}

function removeEditor($id) {
	$con = getConnector();
	$sqlQuery = "DELETE FROM `editors` WHERE `id`=".intval($id);
	getQueryResult($con, $sqlQuery);	
	mysql_close($con);
}

function removeAddress($id) {
	$con = getConnector();
	$sqlQuery = "DELETE FROM `addresses` WHERE `id`=".intval($id);
	getQueryResult($con, $sqlQuery);	
	mysql_close($con);
}

function removeGenre($id) {
	$con = getConnector();
	$sqlQuery = "DELETE FROM `genres` WHERE `id`=".intval($id);
	getQueryResult($con, $sqlQuery);	
	mysql_close($con);
}

function search() {
	if(isset($_REQUEST['submitValue']) && !empty($_POST['value'])) {
		$queryPart = " AND ";
		$table = $_POST['sTable'];
		$value = $_POST['value'];
		if ($table === "books") {
			$queryPart = $queryPart . "`b`.`title` LIKE '%".$value."%'";
			showBooks($queryPart);
		} else {
			if ($table === "authors") {
				$queryPart = $queryPart . "CONCAT_WS(' ',`a`.`name`,`a`.`surname`) LIKE '%".$value."%'";
				showAuthors($queryPart);
			} else {
				$queryPart = $queryPart . "`p`.`pub_name` LIKE '%".$value."%'";
				showPublishers($queryPart);
			}
		}
	} else {
		print('Input value!');
	}
}

function getAuthors(){
	$con = getConnector();
	$sqlQuery = "SELECT `a`.`id`, CONCAT_WS(' ',a.name,a.surname) AS `author`  FROM `authors` `a`";
	$result = getQueryResult($con, $sqlQuery);
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
		print("<option value=".$row['id'].">".$row['author']."</option>");
	}
	closeConnection($result, $con);
}

function getPublishers() {
	$con = getConnector();
	$sqlQuery = "SELECT `id`, `pub_name` FROM `publishers`";
	$result = getQueryResult($con, $sqlQuery);
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
		print("<option value=".$row['id'].">".$row['pub_name']."</option>");
	}
	closeConnection($result, $con);
}

function getGenres() {
	$con = getConnector();
	$sqlQuery = "SELECT `id`, `genre` FROM `genres`";
	$result = getQueryResult($con, $sqlQuery);
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
		print("<option value=".$row['id'].">".$row['genre']."</option>");
	}
	closeConnection($result, $con);
}

function getCountries() {
	$con = getConnector();
	$sqlQuery = "SELECT `id`, `country` FROM `countries`";
	$result = getQueryResult($con, $sqlQuery);
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
		print("<option value='".$row['id']."'>".$row['country']."</option>");
	}
	closeConnection($result, $con);
}

function getAddresses() {
	$con = getConnector();
	$sqlQuery = "SELECT `a`.`id`, CONCAT_WS(', ',c.country, a.city,a.home,a.post_index) AS 'address' FROM `addresses` `a` JOIN `countries` `c` WHERE  `c`.`id`=`a`.`country_id`";;
	$result = getQueryResult($con, $sqlQuery);
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
		print("<option value=".$row['id'].">".$row['address']."</option>");
	}
	closeConnection($result, $con);
}

function getEditors(){
	$con = getConnector();
	$sqlQuery = "SELECT `id`, CONCAT_WS(' ',name,surname) AS `editor`  FROM `editors`";
	$result = getQueryResult($con, $sqlQuery);
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
		print("<option value=".$row['id'].">".$row['editor']."</option>");
	}
	closeConnection($result, $con);
}

?>