<?php
include_once("../../controllers/action_contents.php");
include_all();
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
				<a href='../ooptask/index.php?page=Select'>OOP</a>
				<ul>
					<li>
						<a href='../ooptask/index.php?page=Authors'>Authors</a>
					</li>
					<li>
						<a href='../ooptask/index.php?page=Books'>Books</a>
					</li>
					<li>
						<a href='../ooptask/index.php?page=Publishers'>Publishers</a>
					</li>
					<li>
						<a href='../ooptask/index.php?page=All'>Small tables</a>
					</li>
					<li>
						<a href='../ooptask/index.php?page=Search'>Search</a>
					</li>					
				</ul>
			</li>
			<li> 
				<a href='?action=about'>MVC</a>
				<ul>
					<li>
						<a href='?action=author'>Authors</a>
					</li>
					<li>
						<a href='?action=book'>Books</a>
					</li>
					<li>
						<a href='?action=publisher'>Publishers</a>
					</li>
					<li>
						<a href='?action=address'>Addresses</a>
					</li>
					<li>
						<a href='?action=country'>Countries</a>
					</li>
					<li>
						<a href='?action=genre'>Genres</a>
					</li>
					<li>
						<a href='?action=editor'>Editors</a>
					</li>
					<li>
						<a href='?action=search'>Search</a>
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
			<div class='field' id='title' 
				 style="letter-spacing: 1px; 
				 		margin: auto; 
				 		text-align: center; 
				 		font-weight: bold; 
				 		padding-bottom: 5px;
				 		font-family: Arial, fantasy" >			
				<?php 
					$form = "about";
					if (isset($_REQUEST['action']) && !empty($_GET['action'])) {
						$form = $_GET['action'];
					}
					if(!is_null($form)) {
						print(trim(ucfirst($form)));	
					}
					if (isset($_GET['order']) && !empty($_GET['order']) && Support::isDigit($_GET['order'])) {					
						$order = " ORDER BY ".$_GET['order'];	
					} else {
						$order = "";
					}
				?>
			</div>
			<div class='orders'>
				<?php if ($form != "about") {?>
				[ <a href='<?php print($_SERVER['REQUEST_URI']);?>&order=1'>id</a> |
				<a href='<?php print($_SERVER['REQUEST_URI']);?>&order=2'>name</a> ]
				<?php }?>										
			</div>
			<hr />
			<?php load_form($form); ?>
		</div>
		<div id='right-side'>
			<?php 			
				load_table($form, $order); 
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
