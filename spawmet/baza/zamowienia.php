<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script type="text/javascript" src="options.js"></script>
	<title>Zamówienia</title>
</head>
<body>
<div class="baza_bg">
	<?php
		include 'klasy/Create.php';
		Create::backButton('menu.php');
	?>
	<h1 style="text-align: center;">ZAMÓWIENIA</h1>
	<div id="menu">
		<a href="dodaj_zamowienie.php?lastPage=zamowienia.php"><span class="menu_button">Dodaj</span></a>
		<a href="sortuj.php" style="position: relative; top: 0px;"><span class="menu_button">Sortuj</span></a>
	</div>
	<?php
		include 'klasy/klasa_zamowienia.php';
		/*$z = new Zamowienia();
		$z->connect();
		//$z->wypelnijTestowymiDanymi();
		$z->showTable();
		$z->close();*/
		/*$t = new Table('
			SELECT * FROM maszyny
		');*/
		$z = new Zamowienia('
			SELECT zamowienia.id_zamowienie AS "id", klienci.nazwa AS "Klient", maszyny.nazwa AS "Maszyna", zamowienia.status AS "Status",
			zamowienia.data_zlozenia AS "Data złożenia", zamowienia.data_wysylki AS "Wysyłka", zamowienia.uwagi AS "Uwagi"
			FROM (klienci INNER JOIN zamowienia ON klienci.id_klient = zamowienia.klient)
				  INNER JOIN maszyny ON maszyny.id_maszyna = zamowienia.maszyna
		');
		$z->showTable();
		$z->close();
	?>
</div>
</body>
</html>