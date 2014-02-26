<?php

function include_all() {
	include_once("../../models/country_class.php");
	include_once("../../models/author_class.php");
	include_once("../../models/editor_class.php");
	include_once("../../models/genre_class.php");
	include_once("../../models/publisher_class.php");
	include_once("../../models/book_class.php");
	include_once("../../models/address_class.php");
	include_once("../../models/support_class.php");
	include_once("../../models/db_class.php");
	include_once("../../models/interface.php");
	include_once("../../controllers/action_forms.php");
}

function getAboutPage() {
	require_once("../../views/about.html");
}

function searchInTables() {
	if(isset($_REQUEST['submitValue']) && !empty($_REQUEST['value'])) {
		$word = $_POST['value'];
		switch($_POST['sTable']) {
			case "Book": {
				$book = new Book();
				$book->search($word);
				break;
			}
			case "Author": {
				$author = new Author();
				$author->search($word);
				break;
			}
			case "Publisher": {
				$publisher = new Publisher();
				$publisher->search($word);
				break;
			}
			case "Address": {
				$address = new Address();
				$address->search($word);
				break;
			}
			case "Editor": {
				$editor = new Editor();
				$editor->search($word);
				break;
			}
			case "Genre": {
				$genre = new Genre();
				$genre->search($word);
				break;
			}
			case "Country": {
				$country = new Country();
				$country->search($word);
				break;
			}
			default: break;
		}
	}
}

function load_table($table, $order = NULL) {
	switch($table) {
		case "about" : {
			getAboutPage();
			break;
		}
		case "search" : {
			searchInTables();
			break;
		}
		case "author" : {
			$author = new Author();
			$author->select($order);
			// actionAuthor($author);
			break;
		}
		case "book" : {
			$book = new Book();
			$book->select($order);
			// actionBook();
			break;
		}
		case "publisher" : {
			$publisher = new Publisher();
			$publisher->select($order);
			// actionPublisher();
			break;
		}
		case "address" : {
			$address = new Address();
			$address->select($order);
			// actionAddress();
			break;
		}
		case "editor" :{
			$editor = new Editor();
			$editor->select($order);
			// actionEditor();
			break;
		}
		case "genre" :{
			$genre = new Genre();
			$genre->select($order);
			// actionGenre();
			break;
		}
		case "country" :{
			$country = new Country();
			$country->select($order);
			// actionCountry();
			break;
		}
		default: {
			getAboutPage();
			break;
		}
	}
}

?>