
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Authors</title>
</head>
<body>
	<form name='addAuthor' id='authorsFrm' method="post">
		Name
		<br />
		<input type='text' class='field' name='name' />
		Surname
		<br />
		<input type='text' class='field' name='surname' />
		Birth date
		<br />
		<input type='text' class='field' id='datepicker' name='birth_date' />
		Death date
		<br />
		<input type='text' class='field'  id='datepicker1' name='death_date' />
		Country
		<br />
			<?php			
				Country::getList();				 
			?>
		<input type='submit' name='submitAuthor' class='button' value='Insert' />
		<hr />
		<input type='text' class='field' name='author_id' />
		<input type='submit' name='deleteAuthor' class='button' value='Delete' />
		</form>
		<?php			
			if(isset($_REQUEST['submitAuthor'])) {
				$author['name'] = $_POST['name'];
				$author['surname'] = $_POST['surname'];
				$author['birth_date'] = Support::getCorrectDate($_POST['birth_date']);					
				$author['country_id'] = $_POST['countries'];					
				$flag = true;
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
				if($flag && Support::isName($author['name']) || Support::isName($author['surname']) || Support::isDigit($author['country_id'])) {
					$obj = new Author();
					$obj->insertValue($author);
				}				
			}
			if(isset($_REQUEST['deleteAuthor'])) {
				$id = $_POST['author_id'];				
				if(!empty($id) && Support::isDigit($id)) {
					$obj = new Author();
					$obj->deleteById($id);
				}
			}
		?>
</body>
</html>