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
		$r = new Reklamacje('
			SELECT id_reklamacja AS "id", klient AS "Klient", adres AS "Adres", uwagi AS "Uwagi", zrealizowano AS "Zrealizowano"
			FROM reklamacje
			WHERE id_reklamacja = '.$_GET['complaintID'].'
		');
		echo '<h2>Czy na pewno chcesz usunąć daną reklamację?</h2>';
		$r->showTableWithoutOptions();
		$r->deleteQuestionCommunicate($_GET['complaintID']);
		$r->close();
	?>
</div>
</body>
</html>