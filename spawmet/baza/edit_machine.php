<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Maszyny</title>
</head>
<body>
<div class="baza_bg">
	<?php
		include 'klasy/Create.php';
		Create::backButton($_GET['lastPage']);

		include 'klasy/klasa_maszyny.php';
		$m = new Maszyny('SELECT * FROM maszyny');
		$m->edit($_GET['machineID'], $_POST['nazwa'], $_GET['oldName'], $_POST['cena']);
		$m->close();
	?>
</div>
</body>
</html>