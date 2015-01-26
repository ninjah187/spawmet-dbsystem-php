<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Zamówienia</title>
</head>
<body>
<div class="baza_bg">
	<?php
		include 'klasy/Create.php';
		Create::backButton($_GET['lastPage']);
	?>
	<h1 style="text-align: center;">Zmień status:</h1>
	<?php
		include 'klasy/klasa_zamowienia.php';
		$z = new Zamowienia('
			SELECT zamowienia.id_zamowienie AS "id", klienci.nazwa AS "Klient", maszyny.nazwa AS "Maszyna", zamowienia.status AS "Status",
			zamowienia.data_zlozenia AS "Data złożenia", zamowienia.data_wysylki AS "Wysyłka", zamowienia.uwagi AS "Uwagi"
			FROM (klienci INNER JOIN zamowienia ON klienci.id_klient = zamowienia.klient)
				  INNER JOIN maszyny ON maszyny.id_maszyna = zamowienia.maszyna
			WHERE zamowienia.id_zamowienie = '.$_GET['orderID'].'
		');
		$z->showTableWithoutOptions();
		$z->close();
	?>
	<div style="width: 220px; margin-left: auto; margin-right: auto; margin-top: 30px;">
		<form action="change_status.php?orderID=<?php echo $_GET['orderID']; ?>&lastPage=zamowienia.php" method="POST" class="form">
			<select name=status>
				<option>Niezaakceptowane</option>
				<option>W produkcji</option>
				<option>Do wysyłki</option>
				<option>Załadunek</option>
				<option>Wysłane</option>
				<option>Zakończone</option>
			</select>
			<input type=submit name=accept value="Gotowe">
		</form>
	</div>
</div>
</body>
</html>