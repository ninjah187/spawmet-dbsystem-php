<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Strona</title>
</head>
<body>
<div class="baza_bg">
	<?php
		include 'klasy/Create.php';
		Create::backButton($_GET['lastPage']);
	?>
	<?php
		include 'klasy/klasa_zamowienia.php';
		$z = new Zamowienia('SELECT * FROM zamowienia');
		$z->insert($_POST['nazwa'], $_POST['maszyna'], "Niezaakceptowane", date('Y-m-d G:i:s'), $_POST['uwagi'],
					$_POST['telefon'], $_POST['email'], $_POST['miejscowosc'], $_POST['ulica'], $_POST['kodPocztowy'],
					$_POST['wojewodztwo']);
		$z->close();
	?>
</div>
</body>
</html>