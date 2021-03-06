<?php
/**
 * @param string contentPath
 */ 
function load_content($str) {
	$homepage = file_get_contents($str);
	print($homepage);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML//EN" "url">

<html>
<head>
	<title>
		My Biography
	</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" />
	<link rel="shortcut icon" href="images/ico.jpg" type="image/x-icon" />
	<script src="js/script.js"></script>
</head>
<body>
	<div id='header'>
		<div id='logo-img'>
			<img src="images/ico.jpg" />
		</div>
		<div id='logo-txt'>
			Welcome to my web page :)
		</div>
		<div id='lang'>
			Language:
			<a href="?lang=ua">[ UA </a>| 
			<a href="?lang=en">EN ]</a>
		</div>
	</div>
	<div id='menu'>
		<ul id='navigator'>
			<li>
				<a href='#'>Home</a>
			</li>
			<li>
				<a href='dbtask/index.php?pageContent=Select'>Database</a>
				<ul>
					<li>
						<a href='dbtask/index.php?pageContent=Authors'>Authors</a>
					</li>
					<li>
						<a href='dbtask/index.php?pageContent=Books'>Books</a>
					</li>
					<li>
						<a href='dbtask/index.php?pageContent=Publishers'>Publishers</a>
					</li>
					<li>
						<a href='dbtask/index.php?pageContent=all'>Small tables</a>
					</li>
					<li>
						<a href='dbtask/index.php?pageContent=search'>Search</a>
					</li>					
				</ul>				
			</li>
			<li>
				<a href='ooptask/index.php?page=Select'>OOP</a>
				<ul>
					<li>
						<a href='ooptask/index.php?page=Authors'>Authors</a>
					</li>
					<li>
						<a href='ooptask/index.php?page=Books'>Books</a>
					</li>
					<li>
						<a href='ooptask/index.php?page=Publishers'>Publishers</a>
					</li>
					<li>
						<a href='ooptask/index.php?page=All'>Small tables</a>
					</li>
					<li>
						<a href='ooptask/index.php?page=Search'>Search</a>
					</li>					
				</ul>
			</li>
			<li> 
				<a href='mvctask/index.php?action=about'>MVC</a>
				<ul>
					<li>
						<a href='mvctask/index.php?action=author'>Authors</a>
					</li>
					<li>
						<a href='mvctask/index.php?action=book'>Books</a>
					</li>
					<li>
						<a href='mvctask/index.php?action=publisher'>Publishers</a>
					</li>
					<li>
						<a href='mvctask/index.php?action=address'>Addresses</a>
					</li>
					<li>
						<a href='mvctask/index.php?action=country'>Countries</a>
					</li>
					<li>
						<a href='mvctask/index.php?action=genre'>Genres</a>
					</li>
					<li>
						<a href='mvctask/index.php?action=editor'>Editors</a>
					</li>
					<li>
						<a href='mvctask/index.php?action=search'>Search</a>
					</li>					
				</ul>
			</li>
			<li>
				<a href='mailto:shooterm@mail.ru'>Contacts</a>
			</li>
		</ul>
	</div>
	<div id='content'>			
		<?php
			if(isset($_REQUEST["lang"]) && $_GET["lang"] === "ua") {
				load_content("content/bio-ua.html");
			} else {
				load_content("content/bio-en.html");
			}
		?>
	</div>
	<div id='footer'>
		<div class='contacts'>
			Design by shooterm <br /> Chernivtsi, 2014
		</div>
	</div>
</body>
</html>
