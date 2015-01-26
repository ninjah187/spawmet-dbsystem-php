<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script type="text/javascript" src="options.js"></script>
	<title>Zestawy części</title>
</head>
<body>
<div class="baza_bg">
	<?php
		include 'klasy/Create.php';
		Create::backButton('menu.php');
	?>
	<h1 style="text-align: center;">ZESTAWY CZĘŚCI</h1>
	<div id="menu">
		<a href="dodaj_zestaw.php?lastPage=zestawy_czesci.php"><span class="menu_button">Nowy zestaw</span></a>
	</div>
	<?php
		include 'klasy/klasa_zestawy_czesci.php';
		$t = new ZestawyCzesci('
			SELECT zestawy_czesci.id_zestaw_czesci AS "id",
			zestawy_czesci.nr_zestawu AS "Numer zestawu",
			maszyny.nazwa AS "Maszyna",
			czesci.nazwa AS "Część",
			zestawy_czesci.ilosc_potrzebnych_cz AS "Potrzebna ilość"
			FROM zestawy_czesci, maszyny, czesci
			WHERE zestawy_czesci.maszyna = maszyny.id_maszyna && zestawy_czesci.czesc = czesci.id_czesci
			ORDER BY zestawy_czesci.nr_zestawu
		');
		$t->showTable();
		$t->close();
	?>
</div>
</body>
</html>