<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Części</title>
</head>
<body>
<div class="baza_bg">
	<?php
		include 'klasy/Create.php';
		Create::backButton($_GET['lastPage']);

		include 'klasy/klasa_zestawy_czesci.php';
		$z = new ZestawyCzesci('SELECT nr_zestawu FROM zestawy_czesci');
		$z->deletePartFromSet($_GET['setID']);
		$z->close();
	?>
</div>
</body>
</html>