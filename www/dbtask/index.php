<?php

include("../../config/config.php");
include("../../config/db_lib.php");
include("f_lib.php");

/**
 * 
 * Load content
 * @param string contentPath
 */ 
function load_content($contentPath) {
	$homepage = file_get_contents($contentPath);
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
				<a href='?pageContent=Select'>Database</a>
				<ul>
					<li>
						<a href='?pageContent=Authors'>Authors</a>
					</li>
					<li>
						<a href='?pageContent=Books'>Books</a>
					</li>
					<li>
						<a href='?pageContent=Publishers'>Publishers</a>
					</li>
					<li>
						<a href='?pageContent=all'>Small tables</a>
					</li>
					<li>
						<a href='?pageContent=search'>Search</a>
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
				<a href='mailto:shooterm@mail.ru'>Contacts</a>
			</li>
		</ul>
	</div>
	<div id='content'>	
		<div id='left-side'>		
			<?php 
				$table = $_GET['pageContent'];
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
			<hr />
			<?php 	 			
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
				
				if ($_GET['pageContent'] === "Authors") {
					print("<h3>".$_GET['pageContent']."</h3>");
					//print("<h3>".$_POST['tableSelector']."</h3>");
					showAuthors($order);					
				} else {
					if ($_GET['pageContent'] === "Publishers") {
						print("<h3>".$_GET['pageContent']."</h3>");
						//print("<h3>".$_POST['tableSelector']."</h3>");									
						showPublishers($order);
					} else {					
						if ($_GET['pageContent'] === "Books") {
							print("<h3>".$_GET['pageContent']."</h3>");									
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
