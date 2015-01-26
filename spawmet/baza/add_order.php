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
		include 'klasy/klasa_zamowienia.php';
		$z = new Zamowienia('SELECT * FROM zamowienia');
		$z->insertIntoBase($_POST['klient'], $_POST['maszyna'], "Niezaakceptowane", date('Y-m-d'), $_POST['uwagi']);
		$z->close();
	?>
</div>
</body>
</html>