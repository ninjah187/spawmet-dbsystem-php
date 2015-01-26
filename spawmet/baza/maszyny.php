<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script type="text/javascript" src="options.js"></script>
	<title>Maszyny</title>
</head>
<body>
<div class="baza_bg">
	<?php
		include 'klasy/Create.php';
		Create::backButton('menu.php');
	?>
	<h1 style="text-align: center;">MASZYNY</h1>
	<div id="menu">
		<a href="dodaj_maszyne.php?lastPage=maszyny.php"><span class="menu_button">Dodaj</span></a>
		<a href="sortuj.php" style="position: relative; top: 0px;"><span class="menu_button">Sortuj</span></a>
	</div>
	<?php
		include 'klasy/klasa_maszyny.php';
		/*$m = new Maszyny();
		$m->connect();
		//$m->wypelnijTestowymiDanymi();
		$m->showTable();
		$m->close();*/
		$t = new Maszyny('
			SELECT id_maszyna AS "id", nazwa AS "Nazwa", cena AS "Cena" FROM maszyny
			ORDER BY nazwa
		');
		$t->showTable();
		$t->close();
	?>
</div>
</body>
</html>