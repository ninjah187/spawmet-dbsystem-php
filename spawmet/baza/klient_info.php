<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Info</title>
</head>
<body>
<div class="baza_bg">
	<?php
		include 'klasy/Create.php';
		Create::backButton($_GET['lastPage']);
	?>
	<h1 style="text-align: center;">INFO NT. <?php echo $_GET['customerName']; ?></h1>
	<?php
		include 'klasy/Table.php';
		$t = new Table('
			SELECT nazwa AS "Nazwa", miejscowosc AS "Miejscowość", telefon AS "Telefon", 
			email AS "Email", wojewodztwo AS "Województwo", ulica AS "Ulica", kod_pocztowy AS "Kod pocztowy" 
			FROM klienci
			WHERE nazwa = "'.$_GET['customerName'].'"
		');
		$t->showTableWithoutOptions();
		$t->close();
	?>
</div>
</body>
</html>