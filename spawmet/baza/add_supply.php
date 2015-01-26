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
		include 'klasy/klasa_dostawy.php';
		$d = new Dostawy('SELECT * FROM dostawy');
		$d->insert($_POST['data'], $_POST['dostawca'], $_POST['czesc'], $_POST['ilosc']);
		$d->close();
	?>
</div>
</body>
</html>