<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
</head>
<body>
<form name='addBook' id='authorsFrm' method="post">
				Name
				<br />
				<input type='text' class='field' name='name' />
				Surname
				<br />
				<input type='text' class='field' name='surname' />
				Birth date
				<br />
				<input type='text' class='field' id='datepicker' name='dateB' />
				Death date
				<br />
				<input type='text' class='field'  id='datepicker1' name='dateD' />
				Country
				<br />
				<select name='country_id'>
					<?php getCountries(); ?>
				</select>
				<input type='submit' name='submitAuthor' class='button' value='Insert'>
				<hr />
				<input type='text' class='field' name='author_id' />
				<input type='submit' name='deleteAuthor' class='button' value='Delete'>
			</form> 
			<?php 
				if(isset($_REQUEST['submitAuthor'])) {
					$author['name'] = $_POST['name'];
					$author['surname'] = $_POST['surname'];
					$author['birth_date'] = getCorectDate($_POST['dateB']);					
					$author['country_id'] = $_POST['country_id'];
					$flag = true;
					foreach ($author as $value) {
						if (empty($value)) {
							$flag = false;
							break;
						}
					}
					$author['death_date'] = getCorectDate($_POST['dateD']);
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