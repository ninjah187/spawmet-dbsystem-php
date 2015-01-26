<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Dostawy</title>
</head>
<body>
<div class="baza_bg">
	<?php
		include 'klasy/Create.php';
		Create::backButton($_GET['lastPage']);

		include 'klasy/klasa_dostawy.php';
		$c = new Dostawy('
			SELECT dostawy.data AS "Data odbioru", dostawy.dostawca AS "Dostawca", czesci.nazwa AS "Część", dostawy.ilosc AS "Ilość"
			FROM dostawy INNER JOIN czesci
			ON dostawy.czesc = czesci.id_czesci
			WHERE dostawy.id_dostawa = '.$_GET['supplyID'].'
		');
		echo '<h2>Czy na pewno chcesz usunąć dany rekord?</h2>';
		$c->showTableWithoutOptions();
		$c->deleteQuestionCommunicate($_GET['supplyID']);
		$c->close();
	?>
</div>
</body>
</html>