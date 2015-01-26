<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Zamówienia</title>
</head>
<body>
<div class="baza_bg">
	<?php
		include 'klasy/Create.php';
		Create::backButton($_GET['lastPage']);

		include 'klasy/klasa_zamowienia.php';
		$z = new Zamowienia('SELECT * FROM zamowienia');
		$z->setDate($_GET['orderID'], $_POST['data']);
		$z->close();
	?>
</div>
</body>
</html>