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
		include 'klasy/klasa_zestawy_czesci.php';
		$z = new ZestawyCzesci('SELECT nr_zestawu FROM zestawy_czesci');
		$z->joinPart($_GET['setNumber'], $_POST['czesc'], $_POST['iloscCzesci']);
		$z->close();
	?>
</div>
</body>
</html>