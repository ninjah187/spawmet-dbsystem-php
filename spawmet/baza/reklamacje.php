<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Reklamacje</title>
	<script type="text/javascript" src="options.js"></script>
</head>
<body>
<div class="baza_bg">
	<?php
		include 'klasy/Create.php';
		Create::backButton('menu.php');
	?>
	<h1 style="text-align: center;">REKLAMACJE</h1>
	<div id="menu">
		<a href="dodaj_reklamacje.php?lastPage=dostawy.php"><span class="menu_button">Dodaj</span></a>
		<a href="sortuj.php" style="position: relative; top: 0px;"><span class="menu_button">Sortuj</span></a>
	</div>
	<?php
		include 'klasy/klasa_reklamacje.php';
		$r = new Reklamacje('
			SELECT id_reklamacja AS "id", klient AS "Klient", adres AS "Adres", uwagi AS "Uwagi", zrealizowano AS "Zrealizowano"
			FROM reklamacje
		');
		$r->showTable();
		$r->close();
	?>
</div>
</body>
</html>