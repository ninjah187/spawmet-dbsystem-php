<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Dostawy</title>
</head>
<body>
<div class="baza_bg">
	<?php
		include 'klasy/Create.php';
		Create::backButton($_GET['lastPage']);

		include 'klasy/klasa_dostawy.php';
		$c = new Dostawy('SELECT id_dostawa FROM dostawy WHERE id_dostawa = '.$_GET['supplyID']);
		$c->delete($_GET['supplyID']);
		$c->close();
	?>
</div>
</body>
</html>