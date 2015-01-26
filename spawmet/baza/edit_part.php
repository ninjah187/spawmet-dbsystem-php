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

		include 'klasy/klasa_czesci.php';
		$c = new Czesci('SELECT * FROM czesci');
		$c->edit($_GET['partID'], $_POST['nazwa'], $_GET['oldName'], $_POST['ilosc'], $_POST['pochodzenie']);
		$c->close();
	?>
</div>
</body>
</html>