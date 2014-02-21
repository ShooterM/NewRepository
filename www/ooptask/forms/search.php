<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
</head>
<body>
	<fieldset>
		<legend> Input a value</legend>
		<form name='search' method="post" id="sForm">
			From table <select name='sTable' form="sForm">
				<option value="books">Book</option>
				<option value="authors">Author</option>
				<option value="publishers">Publisher</option>
			</select>
			Value <input type='text' class='field' name='value' />
			<input type='submit' class='submit' name='submitValue' value='Search'/>
		</form>		
	</fieldset>
	<?php search(); ?>
</body>
</html>
