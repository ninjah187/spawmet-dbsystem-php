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
		$k = new Klienci('SELECT * FROM klienci');
		$k->edit($_GET['customerID'], $_POST['nazwa'], $_GET['oldName'], $_POST['miejscowosc'],
		$_POST['telefon'], $_POST['email'], $_POST['nip'], $_POST['wojewodztwo'], $_POST['ulica'], $_POST['kodPocztowy']);
		$k->close();
	?>
</div>
</body>
</html>