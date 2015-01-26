<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script type="text/javascript" src="options.js"></script>
	<title>Części</title>
</head>
<body>
<div class="baza_bg">
	<?php
		include 'klasy/Create.php';
		Create::backButton('menu.php');
	?>
	<h1 style="text-align: center;">CZĘŚCI</h1>
	<div id="menu">
		<a href="dodaj_czesc.php?lastPage=czesci.php"><span class="menu_button">Dodaj</span></a>
		<a href="sortuj.php" style="position: relative; top: 0px;"><span class="menu_button">Sortuj</span></a>
	</div>
	<?php
		include 'klasy/klasa_czesci.php';
		$t = new Czesci('
			SELECT id_czesci AS "id", nazwa AS "Nazwa", ilosc AS "Ilość", pochodzenie AS "Pochodzenie"
			FROM czesci
			ORDER BY nazwa
		');
		$t->showTable();
		//$t->insert('Zębatka', 9);
		$t->close();
	?>
</div>
</body>
</html>