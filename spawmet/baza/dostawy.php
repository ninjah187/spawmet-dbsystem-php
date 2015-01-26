<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Dostawy</title>
	<script type="text/javascript" src="options.js"></script>
</head>
<body>
<div class="baza_bg">
	<?php
		include 'klasy/Create.php';
		Create::backButton('menu.php');
	?>
	<h1 style="text-align: center;">DOSTAWY</h1>
	<div id="menu">
		<a href="dodaj_dostawe.php?lastPage=dostawy.php"><span class="menu_button">Dodaj</span></a>
		<a href="dostawy_raport.php?lastPage=dostawy.php"><span class="menu_button">Raport</span></a>
		<a href="sortuj.php" style="position: relative; top: 0px;"><span class="menu_button">Sortuj</span></a>
	</div>
	<?php
		include 'klasy/klasa_dostawy.php';
		/*$t = new Dostawy('
			SELECT dostawy.data AS "Data odbioru", dostawy.dostawca AS "Dostawca", czesci.nazwa AS "Część", dostawy.ilosc AS "Ilość"
			FROM dostawy, czesci
			WHERE dostawy.czesc = czesci.id_czesci
		');*/
		$t = new Dostawy('
			SELECT dostawy.id_dostawa as "id", dostawy.data AS "Data odbioru", dostawy.dostawca AS "Dostawca", czesci.nazwa AS "Część", dostawy.ilosc AS "Ilość"
			FROM dostawy INNER JOIN czesci
			ON dostawy.czesc = czesci.id_czesci
			ORDER BY dostawy.data, dostawy.dostawca, czesci.nazwa
		');
		$t->showTable();
		$t->close();
	?>
</div>
</body>
</html>