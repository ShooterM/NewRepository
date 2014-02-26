<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Books</title>
</head>
<body>
	<form name='addBook' id='booksFrm' method="post">
		Name
		<br />
			<?php Author::getList(); ?>
		Title
		<br />
		<input type='text' class='field' name='title' />
		Year
		<br />
		<input type='text' class='field' name='year' />
		Publisher
		<br />		
			<?php Publisher::getList(); ?>		
		Page count
		<br />
		<input type='text' class='field' name='page_count' />
		Date
		<br />
		<input type='text' class='field' id='datepicker' name='date' />
		Genre
		<br />
			<?php Genre::getList(); ?>
		<input type='submit' name='submitBook' class='button' value='Insert' />
		<hr />
		<input type='text' class='field' name='book_id' />
		<input type='submit' name='deleteBook' class='button' value='Delete' />
	</form>
	<?php 
		if(isset($_REQUEST['submitBook'])) {
			$book['author_id'] = $_POST['authors'];
			$book['title'] = $_POST['title'];
			$book['year'] = $_POST['year'];
			$book['publisher_id'] = $_POST['publishers'];
			$book['page_count'] = $_POST['page_count'];
			$book['receipt_date'] = Support::getCorrectDate($_POST['date']);					
			$book['genre_id'] = $_POST['genres'];
			$flag = true;
			foreach ($book as $value) {
				if (empty($value)) {
					$flag = false;
					break;
				}
			}			
			if($flag && Support::isYear($book['year']) && Support::isName($book['title']) && Support::isDigit($book['publisher_id'])&& Support::isDigit($book['genre_id']) && Support::isDigit($book['author_id']) && Support::isYear($book['year'])) {					
				$obj = new Book();
				$obj->insertValue($book);
			}
		}
		if(isset($_REQUEST['deleteBook'])) {
			$id = $_POST['book_id'];
			if(!empty($id) && Support::isDigit($id)) {
				$obj = new Book();
				$obj->deleteById($id);
			}
		}
	?>
</body>
</html>