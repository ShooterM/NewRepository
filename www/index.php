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
			<a href="index.php?lang=ua">[ UA </a>| 
			<a href="index.php?lang=en">EN ]</a>
		</div>
	</div>
	<div id='menu'>
		<ul id='navigator'>
			<li>
				<a href=''>Biography</a>
			</li>
			<li>
				<a href=''>Contacts</a>
			</li>
		</ul>
	</div>
	<div id='content'>
		<div id='foto'>
			<img src="images/foto.jpg" id='base-image' onMouseMove="imageSizeOn()" onMouseOut="imageSizeOff()" />
		</div>
		<div id='bio'>
		
		<?php
			if(isset($_REQUEST["lang"]) && $_GET["lang"] === "ua") {
				print('Доброго часу дня, шановний відвідувач! Дана веб-сторінка була розроблена для відображення
				моїх робіт по php, воно ж, одразу й помітно :) 
				Але спочатку, хочу коротко розповісти про себе. Звуть мене, Бойчук Михайло, народився взимку
				1992 року в славному місті Чернівці. До чотирьох чи пяти років, проживав на вулиці Хортицькій,
				згодом з батьками переїхали на Руську, де я проживаю й до теперішнього часу. Моє навчання розпочалось
				в загальноосвітній школі №28, яка знаходилась в шести хвилинах ходьби від мого дому, навчатись мені
				подобалось, тому батьки не переймались з цього приводу і не контролювали мене, даючи мені змогу 
				навчатись буквально "для себе". В старших класах наш клас став з поглибленим вивченням географії,
				тому, спочатку я хотів вступити до геофаку поки не обміркував перспективи та поступив в коледж ЧНУ,
				після дев\'ятого класу. Саме там розпочалось моє справжнє знайомство з "дорослим світом", програмуванням
				та і взагалі почав частіше задумуватись над майбутнім. Також займався і займаюсь декількома видами спорту:
				в основному екстремальними та підтримую здоровий спосіб життя. Після коледжу вступив на факультет прикладної 
				математики Чернівецького Національного Університету імені Юрія Федьковича, на третій курс, 
				на однойменну спеціальність "прикладна математика" (однойменна тому, що в коледжі теж на такій навчався), 
				де я і продовжую навчатись. Також в мене є кіт Батік - це мій домашній улюбленець, ця нагла кошача морда 
				цілий день відсипається, а вночі мені спати не дає. Так вот, якщо що, то я виконую лаби вранці, і тому, по 
				зрозумілим причинам вони можуть бути не дуже в хорошому стані), тому пpошу, не сваріться, я не винен - мене 
				підставили. Але, сподіваюсь, такого не станеться. Ну все, годі про мене, бажаю вам приємного перегляду та 
				часопроведення та памятайте прислів\'я про "любопытну варвару" чи "нос и вопрос"). Хай щастить.		
				');
			} else {
				print('Good time of day, dear visitor! This web page was developed to display my laboratory in php, it is 
				immediately noticeable on the main menu and title above) But first , I want to briefly tell you about myself. 
				My name , Michael Boychuk , was born in the winter of 1992 in the glorious city of Chernivtsi. Until four or 
				five years old, living on the streets Khortitskiy later moved with his parents to n , where I live and up to 
				date. My education began in secondary school number 28 , which was six minutes away from my house, I liked to 
				study because parents cared about this and did not control me, giving me the opportunity to study literally " 
				for yourself ." In high school , our class began with in-depth study of geography, because at first I wanted to 
				go to heofaku not yet contemplated prospects and enrolled in college CNU after ninth grade. From there began my 
				real introduction to "adult world" programming and in general began to reflect more on the future . Also 
				involved and engaged in several sports : mostly extreme and maintain a healthy lifestyle. After college he 
				entered the Department of Applied Mathematics, Chernivtsi National University , handicrafts , in the third year , 
				on the same specialty "Applied Mathematics" ( the same name that is also in college at such a studied ), where I 
				continue to learn. Also I have a cat Batik - this is my pet , the required haste koshacha muzzle slept all day , 
				and at night I sleep does not. So here , if that, then I do Elbe in the morning, and because for obvious reasons 
				they can not be very well maintained ), so pposhu not quarrel, I\'m not guilty - I was framed. But hopefully this 
				will not happen . All right , enough about me , I wish you a nice time and time spending and remember the adage 
				about " curious barbarians" or "nose and question" ). Good Luck .
				');
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
