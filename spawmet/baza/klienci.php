<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script type="text/javascript" src="options.js"></script>
	<title>Klienci</title>
</head>
<body>
<div class="baza_bg">
	<?php
		include 'klasy/Create.php';
		Create::backButton('menu.php');
	?>
	<h1 style="text-align: center;">KLIENCI</h1>
	<div id="menu">
		<a href="dodaj_klienta.php?lastPage=klienci.php"><span class="menu_button">Dodaj</span></a>
		<a href="" style="position: relative; left: 0px;"><span class="menu_button">Sortuj</span></a>
	</div>
	<?php
		include 'klasy/klasa_klienci.php';
		/*$k = new Klienci();
		$k->connect();
		$k->showTable();
		//$k->wypelnijTestowymiDanymi();
		$k->close();*/
		$t = new Klienci('
			SELECT id_klient AS "id", nazwa AS "Nazwa", miejscowosc AS "Miejscowość", telefon AS "Telefon", 
			email AS "Email", nip AS "NIP", wojewodztwo AS "Województwo", ulica AS "Ulica", kod_pocztowy AS "Kod pocztowy" 
			FROM klienci
			ORDER BY nazwa
		');
		$t->showTable();
		//$t->insert('nazwa', 'miejscowość', '4545668', 'mail.com', 'pomorskie', 'smutna 19', '85-999');
		$t->close();
	?>
</div>
</body>
</html>