<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script type="text/javascript" src="options.js"></script>
	<title>Wyznacz trasę</title>
	<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
	<script src="path_finding.js" type="text/javascript"></script>
</head>
<body onLoad="mapaStart()">
<div class="baza_bg">
	<?php
		include 'klasy/Create.php';
		Create::backButton('menu.php');
	?>
	<h1 style="text-align: center;">WYZNACZ TRASĘ</h1>
	<!--<div id="menu">
		<a href="dodaj_zestaw.php?lastPage=zestawy_czesci.php"><span class="menu_button">Dodaj</span></a>
		<a href="usun_po_nazwie.php"><span class="menu_button">Usuń po nazwie</span></a>
		<a href="usun_po_numerze.php"><span class="menu_button">Usuń po numerze</span></a>
		<a href="modyfikuj_po_nazwie.php"><span class="menu_button">Modyfikuj po nazwie</span></a>
		<a href="modyfikuj_po_numerze.php"><span class="menu_button">Modyfikuj po numerze</span></a>
		<a href="sortuj.php" style="position: relative; top: 25px;"><span class="menu_button">Wyświetl posortowane</span></a>
	</div>-->
	<div id="map" style="width: 700px; height: 500px; border: 1px solid black; background: gray; margin-left: auto; margin-right: auto;">
	</div>
	<div style="margin-top: 15px;">
	<?php
		include 'klasy/Table.php';
		
		$z = new Table('
			SELECT zamowienia.id_zamowienie AS "id", klienci.nazwa AS "Klient", maszyny.nazwa AS "Maszyna",
			CONCAT(klienci.ulica, ", ", klienci.kod_pocztowy, " ",
			klienci.miejscowosc, ", ", klienci.wojewodztwo) AS "Adres"
			FROM (klienci INNER JOIN zamowienia ON klienci.id_klient = zamowienia.klient)
				  INNER JOIN maszyny ON maszyny.id_maszyna = zamowienia.maszyna
			WHERE zamowienia.status = "Do wysyłki"
		');
		//WHERE zamowienia.status = "Zakończone"
		$z->showTableWithoutOptions();
		$z->close();
	?>
	</div>
	<div id="text_blocks" style="margin-top: 20px; margin-left: auto; margin-right: auto; font-family: Arial; color: white;">
		<script type="text/javascript">
			addOriginAndDestinationBlocks();
		</script>
		<p>Przez:</p>
		<div id="waypts_blocks">
		
		</div>
		<div style="display: inline-flex; margin-top: 10px;">
			<!--<div onclick="addWaypoint()" id="add_box_btn" style="width: 30px; height: 30px; background-color: black;">+</div>
			<div onclick="removeWaypoint()" id="delete_box_btn" style="width: 30px; height: 30px; background-color: black; margin-left: 10px;">-</div>-->
			<div onclick="addWaypoint()" id="add_box_btn" class="trace_btns">
				<span style="position: relative; top: 9px;">+</span>
			</div>
			<div onclick="removeWaypoint()" id="delete_box_btn" class="trace_btns" style="margin-left: 20px;">
				<span style="position: relative; top: 9px;">-</span>
			</div>
		</div>
		<div style="margin-top: 15px">
			<input onclick="showRoute()" type=button value="Wyznacz">
		</div>
	</div>
</div>
</body>
</html>