<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Insert title here</title>
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
		<select name='country_id'>
			<?php getCountries(); ?>
		</select>
		<input type='submit' name='submitAuthor' class='button' value='Insert' />
		<hr />
		<input type='text' class='field' name='author_id' />
		<input type='submit' name='deleteAuthor' class='button' value='Delete' />
		</form>
		<?php 
			if(isset($_REQUEST['submitAuthor'])) {
				$author['name'] = $_POST['name'];
				$author['surname'] = $_POST['surname'];
				$author['birth_date'] = getCorrectDate($_POST['birth_date']);					
				$author['country_id'] = $_POST['country_id'];
				
				print($author['birth_date']);
				
				$flag = true;
				foreach ($author as $value) {					
					if (empty($value)) {
						$flag = false;
						break;
					}
				}
				if ($_POST['death_date'] === "") {
					$author['death_date'] = NULL;
				} else {
					$author['death_date'] = getCorrectDate($_POST['death_date']);
				}
				if($flag) {					
					addAuthor($author);
				}
			}
			if(isset($_REQUEST['deleteAuthor'])) {
				$id = $_POST['author_id'];
				if(!empty($id)) {
					removeAuthor($id);
				}
			}
		?>
</body>
</html>