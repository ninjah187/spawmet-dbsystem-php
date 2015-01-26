<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Reklamacje</title>
</head>
<body>
<div class="baza_bg">
	<?php
		include 'klasy/Create.php';
		Create::backButton($_GET['lastPage']);

		include 'klasy/klasa_reklamacje.php';
		$r = new Reklamacje('SELECT id_reklamacja FROM reklamacje WHERE id_reklamacja = -1');
		$r->edit($_GET['complaintID'], $_POST['klient'], $_POST['adres'], $_POST['uwagi'], $_POST['zrealizowano']);
		$r->close();
	?>
</div>
</body>
</html>