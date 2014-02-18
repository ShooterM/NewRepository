<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
</head>
<body>
			<form name='addBook' id='booksFrm' method="post">
				Name
				<br />
				<select name='author_id'>
					<?php getAuthors(); ?>
				</select>
				Title
				<br />
				<input type='text' class='field' name='title' />
				Year
				<br />
				<input type='text' class='field' name='year' />
				Publisher
				<br />
				<select name='publisher_id'>
					<?php getPublishers(); ?>
				</select>
				Page count
				<br />
				<input type='text' class='field' name='page_count' />
				Date
				<br />
				<input type='text' class='field' id='datepicker' name='date' />
				Genre
				<br />
				<select name='genre_id'>
					<?php getGenres(); ?>
				</select>
				<input type='submit' name='submitBook' class='button' value='Insert'>
				<hr />
				<input type='text' class='field' name='book_id' />
				<input type='submit' name='deleteBook' class='button' value='Delete'>
			</form> 
			<?php 
				if(isset($_REQUEST['submitBook'])) {
					$book['author_id'] = $_POST['author_id'];
					$book['title'] = $_POST['title'];
					$book['year'] = $_POST['year'];
					$book['publisher_id'] = $_POST['publisher_id'];
					$book['page_count'] = $_POST['page_count'];
					$book['date'] = getCorectDate($_POST['date']);					
					$book['genre_id'] = $_POST['genre_id'];
					$flag = true;
					foreach ($book as $value) {
						if (empty($value)) {
							$flag = false;
							break;
						}
					}
					if($flag) {					
						addBook($book);
					}
				}
				if(isset($_REQUEST['deleteBook'])) {
					$id = $_POST['book_id'];
					if(!empty($id)) {
						removeAuthor($id);
					}
				}
			?>
</body>
</html>