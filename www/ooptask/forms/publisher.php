<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Publishers</title>
</head>
<body>
	<form name='addPublisher' id='booksFrm' method="post">
		Name
		<br />
		<input type='text' class='field' name='pub_name' />					
		Address
		<br />
			<?php Address::getList(); ?>
		Editor
		<br />
			<?php Editor::getList(); ?>
		<input type='submit' name='submitPublisher' class='button' value='Insert' />
		<hr />
		<input type='text' class='field' name='publisher_id' />
		<input type='submit' name='deletePublisher' class='button' value='Delete' />
	</form> 
	<?php
		if(isset($_REQUEST['submitPublisher'])) {
			$publisher['address_id'] = intval($_POST['addresses']);
			$publisher['editor_id'] = intval($_POST['editors']);
			$publisher['pub_name'] = $_POST['pub_name'];		
			$flag = true;
			foreach ($publisher as $value) {
				if (empty($value) || is_null($value)) {
					$flag = false;
					break;
				}
			}
			if($flag && Support::isDigit($publisher['address_id']) && Support::isDigit($publisher['editor_id']) && Support::isName($publisher['pub_name'])) {	
				$obj = new Publisher();
				$obj->insertValue($publisher);
			}
		}
		if(isset($_REQUEST['deletePublisher'])) {
			$id = $_POST['publisher_id'];
			if(!empty($id) && Support::isDigit($id)) {
				$obj = new Publisher();
				$obj->deleteById($id);
			}
		}
	?>
</body>
</html>