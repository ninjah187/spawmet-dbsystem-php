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
		include 'klasy/klasa_maszyny.php';
		$m = new Maszyny('SELECT * FROM maszyny');
		$m->insert($_POST['nazwa'], $_POST['cena']);
		$m->close();
	?>
</div>
</body>
</html>