<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Klienci</title>
</head>
<body>
<div class="baza_bg">
	<?php
		include 'klasy/Create.php';
		Create::backButton($_GET['lastPage']);

		include 'klasy/klasa_klienci.php';
		$k = new Klienci('
			SELECT nazwa AS "Nazwa", miejscowosc AS "Miejscowość", telefon AS "Telefon",
			email AS "Email", wojewodztwo AS "Województwo", ulica AS "Ulica",
			kod_pocztowy AS "Kod pocztowy"
			FROM klienci
			WHERE id_klient = '.$_GET['customerID'].'
		');
		echo '<h2>Czy na pewno chcesz usunąć danego klienta?<br />Spowoduje to usunięcie wszystkich zamówień 
		powiązanych z klientem.</h2>';
		$k->showTableWithoutOptions();
		$k->deleteQuestionCommunicate($_GET['customerID']);
		$k->close();
	?>
</div>
</body>
</html>