<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Insert title here</title>
	<style>
		select {
			width: 70px;
		}
	</style>
</head>
<body>
	<?php 
		if(isset($_REQUEST['display']) && !empty($_GET['display'])) {
			$display = $_GET['display'];
		} else {
			$display = null;
		}
	?>
	<fieldset>
	<legend>
		Add a country
	</legend>
	<form name='countries' method="post">
		Country <input class='fields' type='text' name='country' />
		<input class='submit' type='submit' name='submitCountry' value='Add country' />
	</form>
	<a href='?page=All&display=countries' class='show-link'>Show countries</a>	
	<?php		
		if(isset($_REQUEST['submitCountry'])) {
			$country = $_POST['country'];
			if(!empty($country) && Support::isName($country)) {
				$countryObj = new Country();				
				$countryObj->insertValue($country);
			}
		}
		if($display === "countries") {
			$countryObj = new Country();
			$countryObj->select();
			print("<a href='?page=All' class='hide-link'>Hide table</a>");
		}
	?>
	</fieldset>
	<fieldset>
	<legend>
		Add an editor
	</legend>
	<form name='editors' method="post">
		Name <input class='fields' type='text' name='name' />
		Surname <input class='fields' type='text' name='surname' />		
		<input class='submit' type='submit' name='submitEditor' value='Add editor' />
	</form>
	<a href='?page=All&display=editors' class='show-link'>Show editors</a>	
	<?php		
		if(isset($_REQUEST['submitEditor'])) {
			$editor['name'] = $_POST['name'];
			$editor['surname'] = $_POST['surname'];
			if (!empty($editor['name']) &&  !empty($editor['surname']) && Support::isName($editor['name']) && Support::isName($editor['surname'])) {				
				$editorObj = new Editor();
				$editorObj->insertValue($editor);
			}
		}
		if($display === "editors") {
			$editorObj = new Editor();
			$editorObj->select();
			print("<a href='?page=All' class='hide-link'>Hide table</a>");
		}
	?>
	</fieldset>
	<fieldset>
	<legend>
		Add a genre
	</legend>
	<form name='genres' method="post">
		Genre <input class='fields' type='text' name='genre' />		
		<input class='submit' type='submit' name='submitGenre' value='Add genre' />
	</form>
	<a href='?page=All&display=genres' class='show-link'>Show genres</a>	
	<?php 		
		if(isset($_REQUEST['submitGenre'])) {
			$genre = $_POST['genre'];
			if (!empty($genre) && Support::isName($genre)) {				
				$genreObj = new Genre();
				$genreObj->insertValue($genre);
			}
		}
		if($display === "genres") {
			$genreObj = new Genre();
			$genreObj->select();
			print("<a href='?page=All' class='hide-link'>Hide table</a>");
		}
	?>
	</fieldset>
	<fieldset>
	<legend>
		Add an address
	</legend>	
	<form name='addressFrm' method="post">
		Country 	
		<?php Country::getList(); ?>
		City <input class='fields' type='text' name='city' />
		Street <input class='fields' type='text' name='street' />
		House <input class='fields' type='text' name='house' />
		Post index <input class='fields' type='text' name='index' />		
		<input class='submit' type='submit' name='submitAddress' value='Add address' />
	</form>
	<a href='?page=All&display=addresses' class='show-link'>Show addresses</a>	
	<?php 
		if(isset($_REQUEST['submitAddress'])) {		
			if (!empty($_POST['city']) && !empty($_POST['street']) && !empty($_POST['house']) && !empty($_POST['index'])) {			
				$address['country_id'] = intval($_POST['country_id']);			
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
		if($display === "addresses") {
			$addressObj = new Address();
			$addressObj->select();
			print("<a href='?page=All' class='hide-link'>Hide table</a>");
		}
	?>
	</fieldset>
</body>
</html>
