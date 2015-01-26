<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Dostawy</title>
	<script type="text/javascript" src="options.js"></script>
</head>
<body>
<div class="baza_bg">
	<?php
		include 'klasy/Create.php';
		Create::backButton($_GET['lastPage']);
	?>
	<h1 style="text-align: center;">RAPORT</h1>
	<p style="text-align: center;">Przedział czasowy: <?php echo $_POST['dataod'].' - '.$_POST['datado']; ?></p>
	<?php
		include 'klasy/klasa_dostawy.php';
		$d = new Dostawy('
			SELECT dostawy.data AS "Data odbioru", dostawy.dostawca AS "Dostawca", czesci.nazwa AS "Część", SUM(dostawy.ilosc) AS "Ilość"
			FROM dostawy INNER JOIN czesci
			ON dostawy.czesc = czesci.id_czesci
			GROUP BY dostawy.dostawca, czesci.nazwa
			HAVING dostawy.data BETWEEN "'.$_POST['dataod'].'" AND "'.$_POST['datado'].'"
			ORDER BY dostawy.dostawca, czesci.nazwa
		');
		/*
		SELECT dostawy.id_dostawa as "id", dostawy.data AS "Data odbioru", dostawy.dostawca AS "Dostawca", czesci.nazwa AS "Część", SUM(dostawy.ilosc) AS "Ilość"
			FROM dostawy INNER JOIN czesci
			ON dostawy.czesc = czesci.id_czesci
			WHERE dostawy.data BETWEEN "'.$_POST['dataod'].'" AND "'.$_POST['datado'].'"
			ORDER BY dostawy.dostawca
		*/
		$d->showTableWithoutOptions();
		$d->close();
	?>
</div>
</body>
</html>