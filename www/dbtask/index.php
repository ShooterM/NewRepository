<?php

include("../../config/config.php");
include("../../config/db_lib.php");
include("f_lib.php");

/**
 * 
 * Load content
 * @param string contentPath
 */ 
function load_content($str) {
	$homepage = file_get_contents($str);
	print($homepage);
}

?>

<!DOCTYPE html>

<html>
<head>
	<title>
		My Biography
	</title>
	<link rel="stylesheet" href="../css/style.css" type="text/css" />
	<link rel="stylesheet" href="../css/small_table_style.css" type="text/css" />
	<link rel="stylesheet" href="../css/table_style.css" type="text/css" />
	<link rel="shortcut icon" href="../images/ico.jpg" type="image/x-icon" />
	<link href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" rel="stylesheet" />
	<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
	<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
	<script src="../js/script.js"></script>
</head>
<body>
	<div id='header'>
		<div id='logo-img'>
			<img src="../images/ico.jpg" />
		</div>
		<div id='logo-txt'>
			Welcome to my web page :)
		</div>
		<div id='lang'>
			Language:
			<a href="index.php?lang=ua">[ UA </a>| 
			<a href="index.php?lang=en">EN ]</a>
		</div>
	</div>
	<div id='menu'>
		<ul id='navigator'>
			<li>
				<a href='../'>Home</a>
			</li>
			<li>
				<a href=''>Database</a>
				<ul>
					<li>
						<a href='?pageContent=all'>Small tables</a>
					</li>
					<li>
						<a href='?pageContent=search'>Search</a>
					</li>
				</ul>
			</li>
			<li>
				<a href='mailto:shooterm@mail.ru'>Contacts</a>
			</li>
		</ul>
	</div>
	<div id='content'>	
		<div id='left-side'>			
			<form name='mainFrm' id='mainFrm' method='post'>
			Table
			<br />
			<select name='tableSelector' form='mainFrm'>
				<option value='Books'>Books</option>
				<option value='Authors'>Authors</option>
				<option value='Publishers'>Publishers</option>				
			</select>		
			<input class="button" type='submit' name='submitTable' value='Select' />
			<hr />
			Sort			
				<input type='radio' value='1' name='order' />
				Id
				<input type='radio' value='2' name='order' />
				Name
			</form> 
			<hr />
			<?php 

				$table = $_POST['tableSelector'];			
				if($table === "Books") {
					require ("insertBook.php");					
				} else {
					if($table === "Authors") {												
						require ("insertAuthor.php");					
					} else {
						if($table === "Publishers") {												
							require("insertPublisher.php");					
						}
					}					
				}			
			?>
		</div>
		<div id='right-side'>
			<?php			
				if (isset($_POST['submitTable']) && !empty($_POST['order'])) {					
					$order = " ORDER BY ".$_POST['order'];	
				} else {
					$order = "";
				}
				
				if (isset($_POST['submitTable']) && $_POST['tableSelector'] === "Authors") {
					print("<h3>".$_POST['tableSelector']."</h3>");
					showAuthors($order);					
				} else {
					if (isset($_POST['submitTable']) && $_POST['tableSelector'] === "Publishers") {
						print("<h3>".$_POST['tableSelector']."</h3>");									
						showPublishers($order);
					} else {					
						if (isset($_POST['submitTable']) && $_POST['tableSelector'] === "Books") {
							print("<h3>".$_POST['tableSelector']."</h3>");									
							showBooks($order);
						} else {
							if(isset($_REQUEST) && !is_null($_GET['pageContent'])){
								loadSubPages($_GET['pageContent']);
							}					
						}					
					}
				}				
			?>
		</div>
	</div>
	<div id='footer'>
		<div class='contacts'>
			Design by shooterm <br /> Chernivtsi, 2014
		</div>
	</div>
</body>
</html>
