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
		include 'klasy/klasa_reklamacje.php';
		$c = new Reklamacje('SELECT * FROM reklamacje WHERE id_reklamacja = -1');
		$c->insert($_POST['klient'], $_POST['adres'], $_POST['uwagi'], "Nie");
		$c->close();
	?>
</div>
</body>
</html>