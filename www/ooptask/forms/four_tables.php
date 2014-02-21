<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
</head>
<body>
	<fieldset>
	<legend>
		Add a country
	</legend>
	<?php // showCountries(); ?>
	<form name='countries' method="post">
		Country <input class='fields' type='text' name='country' />
		<input class='submit' type='submit' name='submitCountry' value='Add country' />
	</form>
	</fieldset>
	<?php 
		if(isset($_REQUEST['submitCountry'])) {
			$country = $_POST['country'];
			if(!empty($country)) {
				addCountry($country);
			}
		}
	?>
	<fieldset>
	<legend>
		Add an editor
	</legend>
	<?php // showEditors(); ?>	
	<form name='editors' method="post">
		Name <input class='fields' type='text' name='name' />
		Surname <input class='fields' type='text' name='surname' />		
		<input class='submit' type='submit' name='submitEditor' value='Add editor' />
	</form>
	</fieldset>
	<?php 
		if(isset($_REQUEST['submitEditor'])) {
			$editor['name'] = $_POST['name'];
			$editor['surname'] = $_POST['surname'];
			if (!empty($editor['name']) &&  !empty($editor['surname'])) {
				addEditor($editor);
			}
		}
	?>
	<fieldset>
	<legend>
		Add a genre
	</legend>
	<?php // showGenres(); ?>
	<form name='genres' method="post">
		Genre <input class='fields' type='text' name='genre' />		
		<input class='submit' type='submit' name='submitGenre' value='Add genre' />
	</form>
	</fieldset>
	<?php 
		if(isset($_REQUEST['submitGenre'])) {
			$genre = $_POST['genre'];
			if (!empty($genre)) {				
				addGenre($genre);
			}
		}
	?>
	<fieldset>
	<legend>
		Add an address
	</legend>
	<?php // showAddresses(); ?>
	<form name='addressFrm' method="post">
		Country <select name='country_id' id='selectOne'>
			<?php getCountries(); ?>
		</select>
		City <input class='fields' type='text' name='city' />
		Street <input class='fields' type='text' name='street' />
		House <input class='fields' type='text' name='house' />
		Post index <input class='fields' type='text' name='index' />		
		<input class='submit' type='submit' name='submitAddress' value='Add address' />
	</form>
	</fieldset>
	<?php 
		if(isset($_REQUEST['submitAddress'])) {		
			if (!empty($_POST['city']) && !empty($_POST['street']) && !empty($_POST['house']) && !empty($_POST['index'])) {			
				$address['country_id'] = intval($_POST['country_id']);			
				$address['city'] = $_POST['city'];
				$address['street'] = $_POST['street'];
				$address['house'] = $_POST['house'];
				$address['index'] = $_POST['index'];
				addAddress($address);
			}			
		}
	?>
</body>
</html>
