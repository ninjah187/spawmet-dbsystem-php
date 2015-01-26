<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Info</title>
</head>
<body>
<div class="baza_bg">
	<?php
		include 'klasy/Create.php';
		Create::backButton($_GET['lastPage']);
	?>
	<h1 style="text-align: center;">INFO</h1>
	<?php
		include 'klasy/Table.php';
		$t = new Table('SELECT nazwa AS "Nazwa", ilosc AS "Ilość" FROM czesci WHERE id_czesci = '.$_GET['partID']);
		$t->showTableWithoutOptions();
		$t->close();
	?>
</div>
</body>
</html>