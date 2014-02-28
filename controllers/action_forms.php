<?php

function actionAuthor() {
	$flag = true;
	if(isset($_REQUEST['submitAuthor']) || isset($_REQUEST['updateAuthor'])) {
		$author['name'] = $_POST['name'];
		$author['surname'] = $_POST['surname'];
		$author['birth_date'] = Support::getCorrectDate($_POST['birth_date']);
		$author['country_id'] = $_POST['countries'];
		foreach ($author as $value) {
			if (empty($value)) {
				$flag = false;
				break;
			}
		}
		if($_POST['death_date'] === "") {
			$author['death_date'] = NULL;
		} else {
			$author['death_date'] = Support::getCorrectDate($_POST['death_date']);
		}
	}

	if(isset($_REQUEST['submitAuthor'])) {
		if($flag && Support::isName($author['name']) || Support::isName($author['surname']) || Support::isDigit($author['countries'])) {
			$obj = new Author();
			$obj->insertValue($author);
		}
	}
	if(isset($_REQUEST['updateAuthor'])) {
		if($flag && Support::isName($author['name']) || Support::isName($author['surname']) || Support::isDigit($author['countries'])) {
			$id = $_POST['author_u_id'];
			if(!empty($id) && Support::isDigit($id)) {
				$obj = new Author();
				$obj->updateValue($id, $author);
			}
		}
	}
	if(isset($_REQUEST['deleteAuthor'])) {
		$id = $_POST['author_id'];
		if(!empty($id) && Support::isDigit($id)) {
			$obj = new Author();
			$obj->deleteById($id);
		}
	}
}

function actionBook() {
	$flag = true;
	if(isset($_REQUEST['submitBook']) || isset($_REQUEST['updateBook'])) {
		$book['author_id'] = $_POST['authors'];
		$book['title'] = $_POST['title'];
		$book['year'] = $_POST['year'];
		$book['publisher_id'] = $_POST['publishers'];
		$book['page_count'] = $_POST['page_count'];
		$book['receipt_date'] = Support::getCorrectDate($_POST['date']);
		$book['genre_id'] = $_POST['genres'];
		foreach ($book as $value) {
			if (empty($value)) {
				$flag = false;
				break;
			}
		}
	}
	if(isset($_REQUEST['submitBook'])) {
		if($flag && Support::isYear($book['year']) && Support::isName($book['title']) && Support::isDigit($book['publisher_id'])&& Support::isDigit($book['genre_id']) && Support::isDigit($book['author_id']) && Support::isYear($book['year'])) {
			$obj = new Book();
			$obj->insertValue($book);
		}
	}
	if(isset($_REQUEST['updateBook'])) {
		if($flag && Support::isYear($book['year']) && Support::isName($book['title']) && Support::isDigit($book['publisher_id'])&& Support::isDigit($book['genre_id']) && Support::isDigit($book['author_id']) && Support::isYear($book['year'])) {
			$id = $_POST['book_u_id'];
			if(!empty($id) && Support::isDigit($id)) {
				$obj = new Book();
				$obj-> updateValue($id, $book);
			}
		}
	}
	if(isset($_REQUEST['deleteBook'])) {
		$id = $_POST['book_id'];
		if(!empty($id) && Support::isDigit($id)) {
			$obj = new Book();
			$obj->deleteById($id);
		}
	}
}

function actionGenre() {
	if(isset($_REQUEST['submitGenre'])) {
		$genre = $_POST['genre'];
		if (!empty($genre) && Support::isName($genre)) {
			$genreObj = new Genre();
			$genreObj->insertValue($genre);
		}
	}
	if(isset($_REQUEST['deleteGenre'])) {
		$id = $_POST['genre_id'];
		if(!empty($id) && Support::isDigit($id)) {
			$genreObj = new Genre();
			$genreObj->deleteById($id);
		}
	}
}

function actionPublisher() {
	$flag = true;
	if(isset($_REQUEST['submitPublisher']) || isset($_REQUEST['updatePublisher'])) {
		$publisher['address_id'] = intval($_POST['addresses']);
		$publisher['editor_id'] = intval($_POST['editors']);
		$publisher['pub_name'] = $_POST['pub_name'];
		foreach ($publisher as $value) {
			if (empty($value) || is_null($value)) {
				$flag = false;
				break;
			}
		}
	}
	if(isset($_REQUEST['submitPublisher'])) {
		if($flag && Support::isDigit($publisher['address_id']) && Support::isDigit($publisher['editor_id']) && Support::isName($publisher['pub_name'])) {
			$obj = new Publisher();
			$obj->insertValue($publisher);
		}
	}
	if(isset($_REQUEST['updatePublisher'])) {
		if($flag && Support::isDigit($publisher['address_id']) && Support::isDigit($publisher['editor_id']) && Support::isName($publisher['pub_name'])) {
			$id = $_POST['publisher_u_id'];
			if(!empty($id) && Support::isDigit($id)) {
				$obj = new Publisher();
				$obj-> updateValue($id, $publisher);
			}
		}
	}
	if(isset($_REQUEST['deletePublisher'])) {
		$id = $_POST['publisher_id'];
		if(!empty($id) && Support::isDigit($id)) {
			$obj = new Publisher();
			$obj->deleteById($id);
		}
	}
}


function actionEditor() {
	if(isset($_REQUEST['submitEditor'])) {
		$editor['name'] = $_POST['name'];
		$editor['surname'] = $_POST['surname'];
		if (!empty($editor['name']) &&  !empty($editor['surname']) && Support::isName($editor['name']) && Support::isName($editor['surname'])) {
			$editorObj = new Editor();
			$editorObj->insertValue($editor);
		}
	}
	if(isset($_REQUEST['deleteEditor'])) {
		$id = $_POST['editor_id'];
		if(!empty($id) && Support::isDigit($id)) {
			$editorObj = new Editor();
			$editorObj->deleteById($id);
		}
	}
}


function actionCountry() {
	if(isset($_REQUEST['submitCountry'])) {
		$country = $_POST['country'];
		if(!empty($country) && Support::isName($country)) {
			$countryObj = new Country();
			$countryObj->insertValue($country);
		}
	}
	if(isset($_REQUEST['deleteCountry'])) {
		$id = $_POST['country_id'];
		if(!empty($id) && Support::isDigit($id)) {
			$countryObj = new Country();
			$countryObj->deleteById($id);
		}
	}
}


function actionAddress() {
	if(isset($_REQUEST['submitAddress'])) {
		if (!empty($_POST['city']) && !empty($_POST['street']) && !empty($_POST['house']) && !empty($_POST['index'])) {
			$address['country_id'] = intval($_POST['countries']);
			$address['city'] = $_POST['city'];
			$address['street'] = $_POST['street'];
			$address['house'] = $_POST['house'];
			$address['index'] = $_POST['index'];
			if (Support::isDigit($address['country_id']) && Support::isDigit($address['index']) && Support::isName($address['city']) && Support::isName($address['street'])) {
				$addressObj = new Address();
				$addressObj->insertValue($address);
			}
		}
	}
	if(isset($_REQUEST['deleteAddress'])) {
		$id = $_POST['address_id'];
		if(!empty($id) && Support::isDigit($id)) {
			$addressObj = new Address();
			$addressObj->deleteById($id);
		}
	}
}


function load_form($form) {
	switch($form) {
		case "about" : {
			// require_once("../../views/about.html");
			break;
		}
		case "search" : {
			require_once("../../views/search.html");
			break;
		}
		case "author" : {
			require_once("../../views/authors.html");
			actionAuthor();
			break;
		}
		case "book" : {
			require_once("../../views/books.html");
			actionBook();
			break;
		}
		case "publisher" : {
			require_once("../../views/publishers.html");
			actionPublisher();
			break;
		}
		case "address" : {
			require_once("../../views/addresses.html");
			actionAddress();
			break;
		}
		case "editor" : {
			require_once("../../views/editors.html");
			actionEditor();
			break;
		}
		case "genre" : {
			require_once("../../views/genres.html");
			actionGenre();
			break;
		}
		case "country" : {
			require_once("../../views/countries.html");
			actionCountry();
			break;
		}
		default: {
			require_once("../../views/about.html");
			break;
		}
	}
}

?>