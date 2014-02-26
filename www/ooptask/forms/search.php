<?php 
	function actionSearch() {
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
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Searching</title>
</head>
<body>
	<fieldset>
		<legend> Input a value</legend>
		<form name='search' method="post" id="sForm">
			From table <select name='sTable'">
				<option value="Book">Book</option>
				<option value="Author">Author</option>
				<option value="Publisher">Publisher</option>
				<option value="Editor">Editor</option>
				<option value="Genre">Genre</option>
				<option value="Address">Address</option>
				<option value="Country">Country</option>
			</select>
			Value <input type='text' class='field' name='value' />
			<input type='submit' class='submit' name='submitValue' value='Search'/>
		</form>		
	</fieldset>
	<?php actionSearch(); ?>
</body>
</html>
