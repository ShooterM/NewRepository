<?php

 // ÎÑÜ ÒÓÒ Ï²ÄÊËÞ×ÀÞ
 include("../../models/country_class.php");
 
 /*
 include("../../models/author_class.php");
 include("../../models/editor_class.php");
 include("../../models/genre_class.php");
 include("../../models/publisher_class.php");
 include("../../models/book_class.php");
 include("../../models/address_class.php");
 include("../../models/support_class.php");
 */
 
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
	<style>
		#title:hover {
			color: #00BFFF;
			transition: color 2.1s linear;
		}
	</style>
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
				<a href='../dbtask/index.php?pageContent=Select'>Database</a>
				<ul>
					<li>
						<a href='../dbtask/index.php?pageContent=Authors'>Authors</a>
					</li>
					<li>
						<a href='../dbtask/index.php?pageContent=Books'>Books</a>
					</li>
					<li>
						<a href='../dbtask/index.php?pageContent=Publishers'>Publishers</a>
					</li>
					<li>
						<a href='../dbtask/index.php?pageContent=all'>Small tables</a>
					</li>
					<li>
						<a href='../dbtask/index.php?pageContent=search'>Search</a>
					</li>					
				</ul>
			</li>
			<li>
				<a href='index.php?page=Select'>OOP</a>
				<ul>
					<li>
						<a href='index.php?page=Authors'>Authors</a>
					</li>
					<li>
						<a href='index.php?page=Books'>Books</a>
					</li>
					<li>
						<a href='index.php?page=Publishers'>Publishers</a>
					</li>
					<li>
						<a href='index.php?page=All'>Small tables</a>
					</li>
					<li>
						<a href='index.php?page=Search'>Search</a>
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
			<?php 
				$table = $_GET['page'];
			?>
			<div class='field' id='title' 
				 style="letter-spacing: 1px; 
				 		margin: auto; 
				 		text-align: center; 
				 		font-weight: bold; 
				 		padding-bottom: 5px;
				 		font-family: Arial, fantasy" >			
				<?php print($table); ?>
			</div>
			<div class='orders'>
				[ <a href='<?php print($_SERVER['REQUEST_URI']);?>&order=1'>id</a> |
				<a href='<?php print($_SERVER['REQUEST_URI']);?>&order=2'>name</a> ]											
			</div>
			<hr />
			<?php
				if(isset($_REQUEST['page']) && $_GET['page'] === "Authors") {									
/* ÒÓÒ ÂÈÊËÈÊÀÞ ÔÎÐÌÓ */					include("forms/author.php");
				} else {
					
				}
			?>
		</div>
		<div id='right-side'>
			<?php			
				// right block
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
