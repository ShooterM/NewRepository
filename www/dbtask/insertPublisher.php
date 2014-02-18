<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
</head>
<body>
	<form name='addPublisher' id='booksFrm' method="post">
		Name
		<br />
		<input type='text' class='field' name='pub_name' />					
		Address
		<br />
		<select name='address_id'>
			<?php getAddresses(); ?>					
		</select>
		Editor
		<br />
		<select name='editor_id'>
			<?php getEditors(); ?>
		</select>
		<input type='submit' name='submitPublisher' class='button' value='Insert' />
		<hr />
		<input type='text' class='field' name='publisher_id' />
		<input type='submit' name='deletePublisher' class='button' value='Delete' />
	</form> 
	<?php
		if(isset($_REQUEST['submitPublisher'])) {
			$publisher['address_id'] = intval($_POST['address_id']);
			$publisher['editor_id'] = intval($_POST['editor_id']);
			$publisher['pub_name'] = $_POST['pub_name'];		
			$flag = true;
			foreach ($publisher as $value) {
				if (empty($value) || is_null($value)) {
					$flag = false;
					break;
				}
			}
			if($flag) {					
				addPublisher($publisher);
			}
		}
		if(isset($_REQUEST['deletePublisher'])) {
			$id = $_POST['publisher_id'];
			if(!empty($id)) {
				removePublisher($id);
			}
		}
	?>
</body>
</html>