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
		$k = new Klienci('SELECT id_klient FROM klienci WHERE id_klient = '.$_GET['customerID']);
		$k->delete($_GET['customerID']);
		$k->close();
	?>
</div>
</body>
</html>