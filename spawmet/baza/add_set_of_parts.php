<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Dodaj zestaw części</title>
</head>
<body>
<div class="baza_bg">
	<?php
		include 'klasy/Create.php';
		Create::backButton($_GET['lastPage']);
	?>
	<?php
		include 'klasy/klasa_zestawy_czesci.php';
		$z = new ZestawyCzesci('SELECT * FROM zestawy_czesci');
		$z->insert($_POST['nrZestawu'], $_POST['maszyna'], $_POST['czesc'], $_POST['iloscCzesci']);
		$z->close();
	?>
</div>
</body>
</html>